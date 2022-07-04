<?php
require '../models/incomeSubType.php';
require '../MySqliClasses.php';
require '../BudgetdbAccess.php';
require_once '../BudgetDbInfo.php';

$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "";


$id = (isset($_GET['id']))? $_GET['id'] : 0;
$name = (isset($_GET['name']))? $_GET['name'] : "";
$incomeType_Id = (isset($_GET['incomeType_Id']))? $_GET['incomeType_Id'] : 0;

$incomeSubType = new IncomeSubType($id,$name,$incomeType_Id);
$incomeSubTypeDB = new IncomeSubTypesDBAccess($budgetDBInfo,$dataMode,$incomeSubType);

$crudResult = $incomeSubTypeDB->ManipulateData();

session_start();
$_SESSION['crudResult'] = $crudResult;
switch($crudResult->dataMode){
    case "readOne":
        break;
    case "readAll":
        break;
    case "write":
        if($crudResult->isComplete == FALSE){
            header("location:../../../../datamanager/incomes/addeditIncomeSubType.php");
        }else{
            header("location:../../../../datamanager/incomes/incomeSubTypesDataManager.php");
        }
        break;
    case "update":
        break;
    case "delete":
        break;
}
?>