<?php


class IncomeTypesDBAccess extends AccessMySqliDB implements IDb_CRUD{
    function __construct(MySqliServerInfo $sqlInfo,$dataMode = "",$object = "")
    {
        parent::__construct($sqlInfo,$dataMode,$object);

        $this->crudResult->title = "IncomeTypesDBAccess";
        
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
                $sql = "SELECT id, name,dateCreated, dateModified FROM incomeTypes";
                if($result = $conn->query($sql)){
                    $this->crudResult->object = $result;
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->isComplete = FALSE;
                    $this->crudResult->message = $conn->error;
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
                $today = date("Y-m-d");
                $sql = "INSERT INTO incomeTypes (name,dateCreated,dateModified) VALUES ('$object->name','$today','$today')";
                if($conn->query($sql)){
                    $this->crudResult->isComplete = TRUE;
                    $this->crudResult->message = "Successfully WRITE into database.";
                }else{
                    $this->crudResult->isComplete = FALSE;
                    $this->crudResult->message = "Sql failed to process information: <br/> $conn->error <b/";
                }
            }
        } catch (\Throwable $th) {
            
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

?>