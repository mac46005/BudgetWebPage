<?php
include("../script/dbAccess.php");

$dataMode = $_GET['dateMode'];


$username = $_GET['username'];
$password = $_GET['password'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
$dob = $_GET['dob'];
$ssn = $_GET['ssn'];
$dateCreated = $_GET['dateCreated'];
$dateModified = $_GET['dateModified'];

$user = new User($username, $password, $firstName, $lastName, $dob, $ssn, $dateCreated, $dateModified);

$usersDBAccess = new UsersDBAccess($dataMode,$user);

?>