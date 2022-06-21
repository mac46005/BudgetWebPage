<?php
include("./accessMySql.php");
include("./dbCRUD_Interface.php");
class UsersDataDbAccess implements IDB_CRUD{
    private $manipOption = "";

    function __constructor($manipOption){
        $this->manipOption = $manipOption;
    }

    public function Write($userName,$password,$firstName,$lastName,$dob,$ssn){
        try {
            $conn = $this->createConnection()->Connect();

            $today = date("Y-m-d");
            $sql = "INSERT INTO users (username,password,firstName,lastName,dob,ssn,dateCreated,dateModified) VALUES ('$userName','$password','$firstName','$lastName','$dob','$ssn','$today','$today')";

            if($conn->query($sql)){
                throw new Exception("successfully added user");
            }else{
                throw new Exception($conn->error);
            }
        } catch (\Throwable $e) {
            echo $e;
        }finally{
            $conn->close();
        }
        
    }

    


    private function createConnection(){
        return new AccessMySql();
    }
}

?>