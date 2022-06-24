<?php
/**
 * 
 * @author Marco Preciado
 */
class MySqliServerInfo{
    public $servername = "";
    public $username = "";
    public $password = "";
    public $dbName = "";
    function __construct($servername, $username, $password, $dbName)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }
}


/**
 * @author Marco Preciado
 * @version 1.1.1
 */
interface IDb_CRUD{
    //@param T $object
    public function Write($object): CRUD_Result;

    public function ReadAll(): CRUD_Result;

    public function ReadOne($id): CRUD_Result;

    public function Update($object): CRUD_Result;

    public function Delete($id): CRUD_Result;
}


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

/**
 * Manipulates CRUD operations. Mainly fires CRUD operations according to the dataMode given
 * 
 * 
 * @author Marco Preciado
 */
abstract class ManipulateDataBase implements IManipulateData, IDb_CRUD{
    protected $dataMode;
    protected $object;
    protected CRUD_Result $crudResult;
    function __construct($dataMode = "", $object = NULL)
    {
        $this->dataMode = $dataMode;
        $this->object =$object;
    }
    const dataManipOptions = [
        "readOne",
        "readAll",
        "write",
        "update",
        "delete"
    ];
    abstract function Write($object):CRUD_Result;
    abstract function ReadOne($id):CRUD_Result;
    abstract function ReadAll():CRUD_Result;
    abstract function Update($object):CRUD_Result;
    abstract function Delete($id):CRUD_Result;


    /**
     * Executes the chosen CRUD operations given by the dataMode value
     */
    function ManipulateData(): CRUD_Result{
        switch($this->dataMode){
            case self::dataManipOptions[0]:
                $this->crudResult = $this->ReadOne($this->object->id);
                break;
            case self::dataManipOptions[1]:
                $this->crudResult = $this->ReadAll();
                break;
            case self::dataManipOptions[2]: 
                $this->crudResult = $this->Write($this->object);
                break;
            case self::dataManipOptions[3]:
                $this->crudResult = $this->Update($this->object);
                break;
            case self::dataManipOptions[4]:
                $this->crudResult = $this->Delete($this->object->id);
                break;
        }
        return $this->crudResult;
    }
}


/**
 * Access MySqli Database given a MySqliServerInfo object
 * in order to access the database.
 * 
 * @author Marco Preciado
 */
abstract class AccessMySqliDB extends ManipulateDataBase{
    protected $serverName = "";
    protected $username = "";
    protected $password = "";
    protected $dbName = "";

    
    function __construct(MySqliServerInfo $sqlInfo,$dataMode = "", $object = NULL)
    {
        parent::__construct($dataMode,$object);
        $this->serverName = $sqlInfo->servername;
        $this->username = $sqlInfo->username;
        $this->password = $sqlInfo->password;
        $this->dbName = $sqlInfo->dbName;
    }

    /**
     * Connects to the database given the correct MySqliServerInfo object.
     * Will throw en exception if the connection fails.
     */
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









class IncomeTypesDBAccess extends AccessMySqliDB implements IDb_CRUD{
    function __construct(MySqliServerInfo $sqlInfo,$dataMode = "",$object = "")
    {
        parent::__construct($sqlInfo,$dataMode,$object);
        $this->crudResult = new CRUD_Result("IncomeTypesDBAccess","",$dataMode,$object);
    }

    public function ReadOne($id): CRUD_Result
    {
        return $this->crudResult;
    }

    public function ReadAll(): CRUD_Result
    {
        $conn = NULL;
        try {
            if($conn = $this->Connect()){
                $sql = "SELECT id, name FROM incomeTypes";
                if($result = $conn->query($sql)){
                    $this->crudResult->object = $result;
                    $this->crudResult->isComplete = TRUE;
                }
            }else{
                $this->crudResult->message = $conn->error;
                $this->crudResult->isComplete = FALSE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $conn->error;
            $this->crudResult->isComplete = FALSE;
        } finally{
            $conn->close();
        }
        
        return $this->crudResult;
    }

    public function Write($object): CRUD_Result
    {
        $conn = NULL;
        try {
            if($conn = $this->Connect()){
                $sql = "INSERT INTO incomeTypes (name) VALUES ($object->name)";
                if($conn->query($sql)){
                    $this->crudResult->isComplete = TRUE;
                    $this->crudResult->message = "Successfully WRITE into database.";
                }else{
                    $this->crudResult->isComplete = FALSE;
                    $this->crudResult->message = $conn->error;
                }
            }
        } catch (\Throwable $th) {
            $this->crudResult->isComplete = FALSE;
            $this->crudResult->message = $th;
        }
        return $this->crudResult;
    }
    public function Delete($id): CRUD_Result
    {
        return $this->crudResult;
    }

    public function Update($object): CRUD_Result
    {
        return $this->crudResult;
    }
}






class UsersDBAccess extends AccessMySqliDB implements IDb_CRUD{
    const tableName = "users";
    function __construct(MySqliServerInfo $info,$dataMode,$object = NULL){
        parent::__construct($info, $dataMode, $object);
        $this->crudResult = new CRUD_Result("UsersDbAccess","",$dataMode,$object);
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
                $sql = "SELECT id, username, password, firstName, lastName, dob, ssn, dateCreated, dateModified FROM users WHERE id = $id";
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
            $this->crudResult->message = $th;
        }
        return $this->crudResult;

    }

    public function Update($object): CRUD_Result{
        $conn = NULL;
        try {
            if($conn = $this->Connect()){
                $today = date("Y-m-d");
                $sql = "UPDATE users SET username = '$object->username', password = '$object->password',firstName = '$object->firstName', lastName = '$object->lastName', dob = '$object->dob', ssn = '$object->ssn',dateModified = '$today' WHERE id = '$object->id'";
                if($conn->query($sql)){
                    $this->crudResult->message = "Successfully UPDATE item in database";
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->message = $conn->error;
                    $this->crudResult->isComplete = FALSE;
                }
            }else{
                $this->crudResult->message = $conn->error;
                $this->crudResult->isComplete = FALSE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th;
            $this->crudResult->isComplete = FALSE;
        }
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


class IncomeType{
    public $id = 0;
    public $name = "";
    function __construct($id = 0,$name = "")
    {
        $this->id = $id;
        $this->name = $name;
    }

    function __toString()
    {
        $toString = <<<STRING
        IncomeType
        id: $this->id<br/>
        name: $this->name<br/>
        STRING;
        
        return $toString;
    }
}




?>