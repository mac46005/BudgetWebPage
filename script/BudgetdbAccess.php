<?php
/**
 * A CRUD Operations Result object
 * @version ${1:1.0.0}
 * @author Marco Preciado
 */
class CRUD_Result{
    public $crudType = "";
    public $title;
    public $message;
    public $object = NULL;
    public $isComplete = FALSE;

    function __construct($title = "",$message = "",$crudType = "",$object = NULL,$isComplete = FALSE){
        $this->crudType = $crudType;
        $this->title = $title;
        $this->message = $message;
        $this->object = $object;
        $this->isComplete = $isComplete;
    }


}

interface IManipulateData{
    public function ManipulateData() : CRUD_Result;
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
                throw new Exception($conn->connect_error);
            }
        } catch (\Exception $th) {
            throw $th;
        }
    }



}







interface IDb_CRUD{
    //@param T $object
    public function Write($object): CRUD_Result;

    public function ReadAll(): CRUD_Result;

    public function ReadOne($id): CRUD_Result;

    public function Update($object): CRUD_Result;

    public function Delete($id): CRUD_Result;
}



class UsersDBAccess extends AccessBudgetDBMySql implements IDb_CRUD{

    private $dataMode;
    private $object;
    const tableName = "users";
    private CRUD_Result $crudResult;
    function __construct($dataMode,$object = NULL){
        $this->dataMode = $dataMode;
        $this->object = $object;
        $this->crudResult = new CRUD_Result("UsersDBAccess","",$dataMode,$object);
    }

    public function Write($object): CRUD_Result{
        $conn = NULL;
        try{
            $conn = $this->Connect();

            $today = date("Y-m-d");
            $sql = "INSERT INTO users (username,password,firstName,lastName,dob,ssn,dateCreated,dateModified) VALUES('$object->username','$object->password','$object->firstName','$object->lastName','$object->dob','$object->ssn','$today','$today')";

            if($conn->query($sql)){
                $this->crudResult->isComplete = TRUE;
                $this->crudResult->message = "UsersDBAccess successfully WRITE to database";
            }else{
                throw new Exception($conn->error);
            }
        }catch(\Exception $e){
            $this->crudResult->isComplete = FALSE;
            $this->crudResult->message = $conn->error;
        }finally{
            $conn->close();
        }

        return $this->crudResult;

    }



    
    public function ReadAll(): CRUD_Result{
        $conn = NULL;
        try {
            $conn = $this->Connect();
            
            $sql = "SELECT id,username,password,firstName,lastName, dob,ssn,dateCreated,dateModified FROM users";

            if($result = $conn->query($sql)){
                $this->crudResult->object = $result;
                $this->crudResult->isComplete = TRUE;
            }else{
                throw new Exception($conn->error);
            }
            
        } catch (\Throwable $th) {
            $this->crudResult->message = $th;
            $this->crudResult->isComplete = FALSE;
        }finally{
            $conn->close();
        }
        return $this->crudResult;
    }

    public function ReadOne($id): CRUD_Result{
        $conn = NULL;
        try {
            if($conn = $this->Connect()){
                $sql = "SELECT id, username, password, firstName, lastName, dob, ssn, dateCreated, dateModified WHERE id = $id";
                if($result = $conn->query($sql)){
                    $row = $result->fetch_row();
                    $user = new User($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]);
                    $this->crudResult->object = $user;
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->isComplete = FALSE;
                    $this->crudResult->message = $conn->error;
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $this->crudResult;

    }

    public function Update($object): CRUD_Result{
        return $this->crudResult;
    }

    public function Delete($id):CRUD_Result{
        $conn = NULL;
        try {
            $conn = $this->Connect();
            $readOneResult = $this->ReadOne($id);

            $sql = "DELETE FROM users WHERE id = '$id'";
            if($conn->query($sql)){
                $this->crudResult->message = "Successfully DELETE item from database";
                $this->crudResult->isComplete = TRUE;
                $this->crudResult->object = $readOneResult->object;
            }else{
                $this->crudResult->message = $conn->error;
                $this->crudResult->isComplete = FALSE;
            }

        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }finally{
            $conn->close();
        }
        return $this->crudResult;
    }

    public function ManipulateData(): CRUD_Result{
        // dataManipOptions = readOne,readAll,write,update,delete
        switch($this->dataMode){
            case self::dataManipOptions[0]:
                return $this->ReadOne($this->object->id);
            case self::dataManipOptions[1]:
                return $this->ReadAll();
            case self::dataManipOptions[2]:
                return $this->Write($this->object);
            case self::dataManipOptions[3]:
                return $this->Update($this->object);
            case self::dataManipOptions[4]:
                return $this->Delete($this->object->id);
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

    function __construct($id = "",$username = "", $password = "", $firstName = "", $lastName = "", $dob = "", $ssn = "", $dateCreated = "", $dateModified = ""){
        
        $this->id = $id;
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
        $toString .= "id: " . $this->id . $brk;
        $toString .= "username: " . $this->username . $brk;
        $toString .= "password: " . $this->password . $brk;
        $toString .= "first name: " . $this->firstName . $brk;
        $toString .= "last name: " . $this->lastName . $brk;
        $toString .= "dob: " . $this->dob . $brk;
        $toString .= "ssn: " . $this->ssn . $brk;
        $toString .= "date created: " . $this->dateCreated . $brk;
        $toString .= "date modified: " . $this->dateModified . $brk;

        return $toString;
    }
}





?>