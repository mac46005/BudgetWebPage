<?php
require "../script/BudgetdbAccess.php";

$dataMode = $_REQUEST['dataMode'];
echo $dataMode . "<br>";
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$dob = $_REQUEST['dob'];
$ssn = $_REQUEST['ssn'];

$user = new User($username, $password, $firstName, $lastName, $dob, $ssn);



$usersDBAccess = new UsersDBAccess($dataMode,$user);



$crudResult = $usersDBAccess->ManipulateData();
session_start();
$_SESSION['crudResult'] = $crudResult;
if($crudResult != NULL){
    if($crudResult->isComplete == FALSE){
        header("location:../dataManager/addEditUser.php");
    }else{
        header("location:../dataManager/usersDataManager.php");
    }
}

?>