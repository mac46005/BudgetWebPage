<?php


interface IManipulateData{
    public function ManipulateData($dataMode,$item);
}
abstract class ManipulateData implements IManipulateData{
    const dataManipOptions = [
        "readOne",
        "readAll",
        "write",
        "update",
        "delete"
    ];
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

class CRUD_Result{
    private $message;
    private $item;


    function __construct(){

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



class UsersDBAccess extends AccessBudgetDBMySql implements IDb_CRUD{

    private $dataMode;
    private User $item;

    function __construct($dataMode,User $item){
        $this->dataMode = $dataMode;
        $this->item = $item;
        echo "In UsersDbAccess Constructor";
        $this->ManipulateData($dataMode,$item);
    }


    public function Write($item){
        $conn;
        $isSuccessfull = FALSE;
        try{
            $conn = $this->Connect();

            $today = date("Y-m-d");
            $sql = "INSERT INTO users (username,password,firstName,lastName,dob,ssn,dateCreated,dateModified) VALUES('$item->username','$item->password','$item->firstName','$item->lastName','$item->dob','$item->ssn','$today','$today')";

            if($conn->query($sql)){
                $isSuccessfull = TRUE;
            }else{
                throw new Exception($conn->error);
            }
        }catch(\Exception $e){
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
            case self::dataManipOptions[0]:
                echo "readone";
                $this->ReadOne($this->item->id);
                break;
            case self::dataManipOptions[1]:
                echo "readAll";
                $this->ReadAll();
                break;
            case self::dataManipOptions[2]:
                echo "write";
                $this->Write($this->item);
            case self::dataManipOptions[3]:
                echo "update";
                $this->Update($this->item);
                break;
            case self::dataManipOptions[4]:
                echo "delete";
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

    function __construct($username = 0, $password = "", $firstName = "", $lastName = "", $dob = "", $ssn = "", $dateCreated = "", $dateModified = ""){
        

        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->ssn = $ssn;
        $this->dateCreated = $dateCreated;
        $this->dateModified = $dateModified;
    }

    function __toString(){
        $brk = "<br/>";
        $toString = "";
        $toString .= $this->username . $brk;
        $toString .= $this->password . $brk;
        $toString .= $this->firstName . $brk;
        $toString .= $this->lastName . $brk;
        $toString .= $this->dob . $brk;
        $toString .= $this->ssn . $brk;
        $toString .= $this->dateCreated . $brk;
        $toString .= $this->dateModified . $brk;

        return $toString;
    }
}





?>