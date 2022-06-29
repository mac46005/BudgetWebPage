<?php
require './MySqliClasses.php';
require './BudgetdbAccess.php';

$dataMode = (isset($_REQUEST['dataMode']) == TRUE)? $_REQUEST['dataMode'] : "";
$id = (isset($_REQUEST['id']))? $_REQUEST['id'] : "";
$username = (isset($_REQUEST['username']) == TRUE)? $_REQUEST['username'] : "";
$password = (isset($_REQUEST['password']))? $_REQUEST['password'] : "";
$firstName = (isset($_REQUEST['firstName']))? $_REQUEST['firstName'] : "";
$lastName = (isset($_REQUEST['lastName']))? $_REQUEST['lastName'] : "";
$dob = (isset($_REQUEST['dob']))? $_REQUEST['dob'] : "";
$ssn = (isset($_REQUEST['ssn']))? $_REQUEST['ssn'] : "";


$user = new User($id,$username, $password, $firstName, $lastName, $dob, $ssn);


$usersDBAccess = new UsersDBAccess($budgetDBInfo,$dataMode,$user);



$crudResult = $usersDBAccess->ManipulateData();
session_start();
$_SESSION['crudResult'] = $crudResult;
if($crudResult != NULL){
    switch($crudResult->crudType){
        case "readOne":
            break;
        case "readAll":
            break;
        case "write":
            if($crudResult->isComplete == FALSE){
                header("location:../dataManager/addEditUser.php");
            }else{
                header("location:../dataManager/usersDataManager.php");
            }
            break;
        case "update":
            if($crudResult->isComplete == FALSE){
                header("location:../dataManager/addEditUser.php?dataMode=update&id=$crudResult->dataObject->id");
            }else{
                header("location:../dataManager/usersDataManager.php");
            }
            break;
        case "delete":
            header("location:../datamanager/usersDataManager.php");
    }
    
}

?>