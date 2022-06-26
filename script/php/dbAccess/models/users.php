<?php

/**
 * Budget app user class
 * @author Marco Preciado
 */
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