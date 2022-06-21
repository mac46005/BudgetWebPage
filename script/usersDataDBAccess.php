<?php
require "../script/BudgetdbAccess.php";
echo "UsersDataDbAccess <br>";
$dataMode = $_REQUEST['dataMode'];
echo $dataMode . "<br>";
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$dob = $_REQUEST['dob'];
$ssn = $_REQUEST['ssn'];


$brk = "<br>";
echo $username . $brk ;
echo $password . $brk;
echo $firstName . $brk;
echo $lastName . $brk;
echo $dob . $brk;
echo $ssn . $brk;

$user = new User($username, $password, $firstName, $lastName, $dob, $ssn);


echo "PERSON CLASS PROPERTY VALUES";
echo $user;
echo "END OF PERSON CLASS PROP VALS";


$usersDBAccess = new UsersDBAccess($dataMode,$user);

?>