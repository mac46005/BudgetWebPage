<?php

class ExpenseSubTypesDBAccess extends AccessMySqliDB implements IDb_CRUD{
    function __construct(MySqliServerInfo $sqlInfo, $dataMode = "",$dataObject = "")
    {
        parent::__construct($sqlInfo,$dataMode,$dataObject);
        $this->crudResult->title = "ExpenseSubTypesDBAccess";
    }
    public function ReadOne($id): CRUD_Result
    {
        $conn = new mysqli();
        try {
            if($conn = $this->Connect()){
                $sql = <<<SQL
                SELECT id, name, expenseType_Id, dateCreated, dateModified
                FROM expenseSubTypes
                WHERE id = $id
                SQL;
                
                if($result = $conn->query($sql)){
                    $row = $result->fetch_row();
                    $expenseSubType = new ExpenseSubType($row[0],$row[1],$row[2],$row[3],$row[4]);
                    $this->crudResult->dataObject = $expenseSubType;
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failed to connect to database.<br/>
                    $conn->connect_error
                    MESSAGE;
                }

            }else{
                $this->crudResult->message = <<<MESSAGE
                Failed to connect to sql database.<br/>
                $conn->connect_error
                MESSAGE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }
        return $this->crudResult;
    }
    public function ReadAll(): CRUD_Result
    {
        return $this->crudResult;
    }
    public function Write($object): CRUD_Result
    {
        return $this->crudResult;
    }
    public function Update($dataObject): CRUD_Result
    {
        return $this->crudResult;
    }
    public function Delete($id): CRUD_Result
    {
        return $this->crudResult;
    }


}

class ExpenseTypesDBAccess extends AccessMySqliDB implements IDb_CRUD{
    function __construct(MySqliServerInfo $sqlInfo, $dataMode = "", $dataObject = "")
    {
        parent::__construct($sqlInfo,$dataMode,$dataObject);
        $this->crudResult->title = "ExpenseTypesDBAccess";
    }
    public function ReadOne($id): CRUD_Result
    {
        $conn = new mysqli();
        try {
            if($conn = $this->Connect()){
                $sql = <<<SQL
                SELECT id, name, dateCreated, dateModified FROM expenseTypes WHERE id = '$id'
                SQL;

                if($result = $conn->query($sql)){
                    $row = $result->fetch_row();
                    $expenseType = new ExpenseType($row[0],$row[1],$row[2],$row[3]);
                    $this->crudResult->dataObject = $expenseType;
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failed to load sql query<br/>
                    $conn->error<br/>
                    MESSAGE;
                }
            }else{
                $this->crudResult->message = <<<MESSAGE
                Failed to connect to sql database<br/>
                $conn->error
                MESSAGE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }finally{
            $conn->close();
        }

        return $this->crudResult;
    }
    public function ReadAll(): CRUD_Result
    {
        $conn = new mysqli();
        try {
            if($conn = $this->Connect()){
                $sql = <<<SQL
                SELECT id, name, dateCreated, dateModified
                FROM expenseTypes
                SQL;
                if($result = $conn->query($sql)){
                    $this->crudResult->dataObject = $result;
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failed to run query on sql database<br/>
                    $conn->error<br/>
                    MESSAGE;
                }
            }else{
                $this->crudResult->message = <<<MESSAGE
                Failed to connect to database<br/>
                $conn->error<br/>
                MESSAGE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }finally{
            $conn->close();
        }
        return $this->crudResult;
    }
    public function Write($dataObject): CRUD_Result
    {
        $conn = new mysqli();
        try {
            if($conn = $this->Connect()){
                $today = date("Y-m-d");
                $sql = <<<SQL
                INSERT INTO expenseTypes (name,dateCreated,dateModified)
                VALUES ('$dataObject->name','$today','$today')
                SQL;

                $this->crudResult->dataObject->dateCreated = $today;
                $this->crudResult->dataObject->dateModified = $today;

                if($conn->query($sql)){
                    $this->crudResult->message = <<<MESSAGE
                    Successfully WRITE in database<br/>
                    MESSAGE;
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failed to run query on sql<br/>
                    $conn->error<br/>
                    MESSAGE;
                }
            }else{
                $this->crudResult->message = <<<MESSAGE
                Failed to connect to database<br/>
                $conn->error<br/>
                MESSAGE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }finally{
            $conn->close();
        }

        return $this->crudResult;
    }
    public function Update($dataObject): CRUD_Result
    {
        $today = date("Y-m-d");
        $conn = new mysqli();
        try {
            if($conn = $this->Connect()){
                $sql = <<<SQL
                UPDATE expenseTypes
                SET 
                name = '$dataObject->name',
                dateModified = '$today'
                WHERE id = '$dataObject->id'
                SQL;
                if($conn->query($sql)){
                    $this->crudResult->message = <<<MESSAGE
                    Successfully UPDATE item in database
                    MESSAGE;
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failed to UPDATE using sql<br/>
                    $conn->error
                    MESSAGE;
                }
            }else{
                $this->crudResult->message = <<<MESSAGE
                Failed to connect to sql database<br/>
                $conn->error<br/>
                MESSAGE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }finally{
            $conn->close();
        }
        return $this->crudResult;
    }
    public function Delete($id): CRUD_Result
    {
        $conn = new mysqli();
        try {
            if($conn = $this->Connect()){
                $sql = <<<SQL
                DELETE FROM expenseTypes
                WHERE id = $id
                SQL;
                if($conn->query($sql)){
                    $this->crudResult->message = <<<MESSAGE
                    Successfully DELETE item from database
                    MESSAGE;
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failed to DELETE item<br/>
                    $conn->error<br/>
                    MESSAGE;
                }
            }else{
                $this->crudResult->message = <<<MESSAGE
                Failed to connect to database.<br/>
                $conn->error<br/>
                MESSAGE;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }finally{
            $conn->close();
        }

        return $this->crudResult;
    }
}





























/**
 * An income type can represent a whole class type of income.
 * e.g. self-employed, wages, ssn, etc.
 */
class IncomeTypesDBAccess extends AccessMySqliDB implements IDb_CRUD{
    function __construct(MySqliServerInfo $sqlInfo,$dataMode = "",$dataObject = "")
    {
        parent::__construct($sqlInfo,$dataMode,$dataObject);

        $this->crudResult->title = "IncomeTypesDBAccess";
        
    }

    public function ReadOne($id): CRUD_Result
    {
        $conn = new mysqli();
        try{
            if($conn = $this->Connect()){
                $sql = "SELECT id,name,dateCreated,dateModified FROM incomeTypes WHERE id = '$id'";
                if($result = $conn->query($sql)){
                    if($row = $result->fetch_row()){
                        $incomeType = new IncomeType($row[0],$row[1],$row[2],$row[3]);
                        $this->crudResult->dataObject = $incomeType;
                        $this->crudResult->isComplete = TRUE;
                    }else{
                        $errorMessage = <<<ERROR
                        Failed load row data from ReadOne.<br/>
                        $conn->error;
                        ERROR;
                        $this->crudResult->message = $errorMessage;
                    }
                }else{
                    $this->crudResult->message = $conn->error;
                }
            }else{
                $errorMessage = <<<ERROR
                $this->crudResult->title failed to connect<br/>
                $conn->error;
                ERROR;

                $this->crudResult->message = $errorMessage;
            }
        }catch(\Exception $ex){
            $this->crudResult->message .= "$ex->getMeesage()";
        }
        finally{
            $conn->close();
        }
        return $this->crudResult;
    }

    public function ReadAll(): CRUD_Result
    {
        $conn = NULL;
        try {
            if($conn = $this->Connect()){
                $sql = "SELECT id, name,dateCreated, dateModified FROM incomeTypes";
                if($result = $conn->query($sql)){
                    $this->crudResult->dataObject = $result;
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

    public function Write($dataObject): CRUD_Result
    {
        $conn = NULL;
        try {
            if($conn = $this->Connect()){
                $today = date("Y-m-d");
                $sql = "INSERT INTO incomeTypes (name,dateCreated,dateModified) VALUES ('$dataObject->name','$today','$today')";
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
        $conn = new mysqli();
        try {
            if($conn = $this->Connect()){
                $sql = <<<SQL
                DELETE FROM incomeTypes WHERE id = '$id'
                SQL;
                if($conn->query($sql)){
                    $this->crudResult->isComplete = TRUE;
                    $this->crudResult->message = "Successfully DELETE item from database.";
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failes to UPDATE<br/>
                    May need to check SQL syntax error<br/>
                    $conn->error
                    MESSAGE;
                }
            }else{
                $this->crudResult->message = $conn->connect_error;
            }
        } catch (\Throwable $th) {
            $this->crudResult->message = $th->getMessage();
        }
        return $this->crudResult;
    }

    public function Update($dataObject): CRUD_Result
    {
        $conn = new mysqli();
        $today = date("Y-m-d");
        try{
            if($conn = $this->Connect()){
                $sql = <<<SQL
                UPDATE incomeTypes
                SET name = '$dataObject->name', dateModified = '$today'
                WHERE id = '$dataObject->id'
                SQL;

                if($conn->query($sql)){
                    $this->crudResult->message = "Successfully UPDATE item in database";
                    $this->crudResult->isComplete = TRUE;
                }else{
                    $this->crudResult->message = <<<MESSAGE
                    Failed to update sql<br/>
                    $conn->errors;
                    MESSAGE;
                }
            
            }else{
                $this->crudResult->message = <<<MESSAGE
                Failes to connect to database<br/>
                $conn->connect_error;
                MESSAGE;
            }
        }catch(\Exception $ex){
            $this->crudResult->message .= $ex->getMessage();
        }
        return $this->crudResult;
    }
}




















class UsersDBAccess extends AccessMySqliDB implements IDb_CRUD{
    const tableName = "users";
    function __construct(MySqliServerInfo $info,$dataMode,$dataObject = NULL){
        parent::__construct($info, $dataMode, $dataObject);
        $this->crudResult = new CRUD_Result("UsersDbAccess","",$dataMode,$dataObject);
    }

    public function Write($dataObject): CRUD_Result{
        $conn = NULL;
        try{
            $conn = $this->Connect();

            $today = date("Y-m-d");
            $sql = "INSERT INTO users (username,password,firstName,lastName,dob,ssn,dateCreated,dateModified) VALUES('$dataObject->username','$dataObject->password','$dataObject->firstName','$dataObject->lastName','$dataObject->dob','$dataObject->ssn','$today','$today')";

            if($conn->query($sql)){
                $this->crudResult->isComplete = TRUE;
                $this->crudResult->message = "UsersDBAccess successfully WRITE to database";
            }else{
                throw new Exception($conn->error);
            }
        }catch(\Exception $e){
            $this->crudResult->isComplete = FALSE;
            $this->crudResult->message = $conn->error;
            $this->crudResult-> message .= "<br/>" . $e->getMessage();
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
                $this->crudResult->dataObject = $result;
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
                    $this->crudResult->dataObject = $user;
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

    public function Update($dataObject): CRUD_Result{
        $conn = NULL;
        try {
            if($conn = $this->Connect()){
                $today = date("Y-m-d");
                $sql = "UPDATE users SET username = '$dataObject->username', password = '$dataObject->password',firstName = '$dataObject->firstName', lastName = '$dataObject->lastName', dob = '$dataObject->dob', ssn = '$dataObject->ssn',dateModified = '$today' WHERE id = '$dataObject->id'";
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
                $this->crudResult->dataObject = $readOneResult->dataObject;
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