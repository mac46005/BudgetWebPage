<?php




class AccessMySql{
    private $serverName = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "budgetdb";

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


/**
 * @template T of object
 * 
 */
interface IDb_CRUD{
    //@param T $item
    public function Write($item);

    public function ReadAll();

    public function ReadOne($id);

    public function Update($id);

    public function Delete($id);
}





class UsersDBAccess extends AccessMySql implements IDb_CRUD{
    public function Write($item){
        
    }
    public function ReadAll(){

    }

    public function ReadOne($id){

    }

    public function Update($id){

    }

    public function Delete($id){

    }
}





// OBJECTS
class User{
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $dob;
    public $ssn;
    public $dateCreated;
    public $dateModified;
}

?>