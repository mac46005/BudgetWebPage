<?php

use CRUD_Result as GlobalCRUD_Result;

/**
 * Carries properties needed to access MySqli
 */
class MySqliServerInfo{
    public $servername = "";
    public $username = "";
    public $password = "";
    public $dbName = "";

    function __construct($servername,$username,$password,$dbName)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }
}


/**
 * An object with after results of a CRUD operation
 * Includes flags that details the type of CRUD operation performed. It also includes the object that was used for the attempted operation. Main purpose is to carry the result of the crud operation.
 * @author Marco Preciado
 */
class CRUD_Result{

    public $dataMode = "";

    public $title = "";

    public $object = NULL;

    public $isComplete = FALSE;

    function __construct($title = "", $message = "", $dataMode = "", $object = NULL, $isComplete = FALSE)
    {
        $this->dataMode = $dataMode;
        $this->title = $title;
        $this->message = $message;
        $this->object = $object;
        $this->isComplete = $isComplete;
    }
}

interface IWrite{
    /**
     * Writes an object to the database
     */
    function Write($object) : CRUD_Result;
}
interface IReadOne{
    /**
     * Reads one data from database
     */
    function ReadOne($id) : CRUD_Result;
}
interface IReadAll{
    /**
     * Reads all data from database
     */
    function ReadAll() : CRUD_Result;
}
interface IUpdate{
    /**
     * Updates a single object in database
     */
    function Update($object) : CRUD_Result;
}
/**
 * Deletes a single object from the database
 */
interface IDelete{
    function Delete($id) : CRUD_Result;
}

/**
 * Basic database operations. ReadOne, ReadAll, Write, Update, Delete
 * 
 * @author Marco Preciado
 */
interface IDb_CRUD extends IWrite, IReadOne, IReadAll, IUpdate, IDelete{
    public function Write($object) : CRUD_Result;
    public function ReadOne($id) : CRUD_Result;
    public function ReadAll() : CRUD_Result;
    public function Update($object) : CRUD_Result;
    public function Delete($id) : CRUD_Result;
}


interface IManipulateData{
    public function ManipulateData() : CRUD_Result;
}


/**
 * Base class resposible for Manipulating data depending on the dataMode
 * @author Marco Preciado
 */
abstract class ManipulateDataBase implements IManipulateData, IDb_CRUD{
    protected CRUD_Result $crudResult;
    const dataManipOptions = [
        "readOne",
        "readAll",
        "write",
        "update",
        "delete"
    ];

    function __construct($dataMode = "", $object = NULL)
    {
        $this->crudResult = new CRUD_Result("","",$dataMode,$object);
    }

    abstract function Write($object) : CRUD_Result;
    abstract function ReadOne($id) : CRUD_Result;
    abstract function ReadAll() : CRUD_Result;
    abstract function Update($object) : CRUD_Result;
    abstract function Delete($id) : CRUD_Result;


    /**
     * Fires the CRUD operation needed depending on the dataMode given.
     * @return CRUD_Result
     */
    function ManipulateData(): CRUD_Result
    {
        switch($this->crudResult->dataMode){
            case self::dataManipOptions[0]:
                $this->crudResult = $this->ReadOne($this->crudResult->object->id);
                break;
            case self::dataManipOptions[1]:
                $this->crudResult = $this->ReadAll();
                break;
            case self::dataManipOptions[2]:
                $this->crudResult = $this->Write($this->crudResult->object);
                break;
            case self::dataManipOptions[3]:
                $this->crudResult = $this->Update($this->crudResult->object);
                break;
            case self::dataManipOptions[4]:
                $this->crudResult = $this->Delete($this->crudResult->object->id);
                break;
        }
        return $this->crudResult;
    }
}

/**
 * The main base abstract class to access and manipulate data from using mysqli.
 * CRUD operations can be overwritten depending on your use.
 * Every CRUD operation results an CRUD_Result object.
 */
abstract class AccessMySqliDB extends ManipulateDataBase{
    private MySqliServerInfo $sqlInfo;
    function __construct(MySqliServerInfo $sqlInfo, $dataMode, $object = NULL)
    {
        parent::__construct($dataMode, $object);
        $this->sqlInfo = $sqlInfo;
    }

    /**
     * Returns a mysqli object
     */
    protected function Connect() : mysqli{
        try{
            if($conn = new mysqli($this->sqlInfo->servername,$this->sqlInfo->username,$this->sqlInfo->password,$this->sqlInfo->dbName)){
                return $conn;
            }else{
                throw new Exception($conn->connect_error);
            }
        }catch(\Exception $th){
            $this->crudResult->message = $th->getMessage();
        }
    }
}
?>