<?php
require '../models/incomeSubType.php';
require '../MySqliClasses.php';
require '../BudgetdbAccess.php';
require_once '../BudgetDbInfo.php';

$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "";


$id = (isset($_GET['id']))? $_GET['id'] : 0;
$name = (isset($_GET['name']))? $_GET['name'] : "";
$amount = (isset($_GET['amount']))? $_GET['amount'] : 0;
$incomeType_Id = (isset($_GET['incomeType_Id']))? $_GET['incomeType_Id'] : 0;
$note = (isset($_GET['note']))? $_GET['note'] : "";

$incomeSubType = new IncomeSubType($id, $name,$amount,$incomeType_Id,$note);
$incomeSubTypeDB = new IncomeSubTypesDBAccess($budgetDBInfo,$dataMode,$incomeSubType);

$crudResult = $incomeSubTypeDB->ManipulateData();

switch($crudResult->dataMode){
    case "readOne":
        break;
    case "readAll":
        break;
    case "write":
        break;
    case "update":
        break;
    case "delete":
        break;
}
?>