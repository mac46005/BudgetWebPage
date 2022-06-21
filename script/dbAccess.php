<?php


interface IManipulateData{
    public function ManipulateData();
}
abstract class ManipulateData implements IManipulateData{
    const dataManipOptions = [
        "readOne",
        "readAll",
        "write",
        "update",
        "delete"
    ];
    public abstract function ManipulateData();
}



abstract class AccessBudgetDBMySql extends ManipulateData{
    protected $serverName = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbName = "budgetdb";

    protected function Connect(){
        try {
            if($conn = new mysqli($this->serverName,$this->username,$this->password,$this->dbName)){
                return $conn;
            }
            else{
                echo FormatErrors($conn->errors());
            }
        } catch (\Exception $th) {
            
        }
    }



}






interface IDb_CRUD{
    //@param T $item
    public function Write($item);

    public function ReadAll();

    public function ReadOne($id);

    public function Update($item);

    public function Delete($id);
}



class UsersDBAccess extends AccessMySql{

    private $dataMode;
    private User $item;

    function __contructor($dataMode,User $item){
        $this->dataMode = $dataMode;
        $this->item = $item;

        $this->ManipulateData($dataMode,$item);
    }


    public function Write($item){
        $conn;
        $isSuccessfull = FALSE;
        try{
            $conn = $this->Connect();

            $sql = "INSERT INTO users (username,password,firstName,lastName,dob,ssn,dateCreated,dateModified) VALUES('$item->username','$item->password','$item->firstName',$item->lastName','$item->dob','$item->ssn','$item->dateCreated','$item->dateModified')";

            if($conn->query($sql)){
                $isSuccessfull = TRUE;
                console.log("UsersDBAccess Successfully WRITES to database");
            }else{
                throw new Exception($conn->errors);
            }
        }catch(\Exception $e){
            console.danger($e);
            $isSuccessfull = FALSE;
        }finally{
            $conn->close();
        }

        return $isSuccessfull;

    }
    public function ReadAll(){

    }

    public function ReadOne($id){

    }

    public function Update($item){

    }

    public function Delete($id){

    }

    public function ManipulateData($dataMode,$item){
        // dataManipOptions = readOne,readAll,write,update,delete
        switch($dataMode){
            case $this->dataManipOptions[0]:
                $this->ReadOne($this->item->id);
                break;
            case $this->dataManipOptions[1]:
                $this->ReadAll();
                break;
            case $this->dataManipOptions[2]:
                $this->Write($this->item);
            case $this->dataManipOptions[3]:
                $this->Update($this->item);
                break;
            case $this->dataManipOptions[4]:
                $this->Delete($this->item->id);
                break;
        }
    }
}



// OBJECTS
class User{
    public $id;
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $dob;
    public $ssn;
    public $dateCreated;
    public $dateModified;

    function __contructor($username = 0, $password = "", $firstName = "", $lastName = "", $dob = "", $ssn = "", $dateCreated = "", $dateModified = ""){
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->ssn = $ssn;
        $this->dateCreated = $dateCreated;
        $this->dateModified = $dateModified;
    }
}





?>