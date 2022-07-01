<?php
require '../models/expenseSubType.php';
require '../MySqliClasses.php';
require '../BudgetdbAccess.php';
require_once '../BudgetDbInfo.php';

$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "write";

$id = (isset($_GET['id']))? $_GET['id'] : 0;
$name = (isset($_GET['name']))? $_GET['name'] : "";
$expenseType_Id = (isset($_GET['expenseType_Id']))? $_GET['expenseType_Id'] : 0;

$expenseSubType = new ExpenseSubType($id, $name, $expenseType_Id);

$expenseSubTypeDB = new ExpenseSubTypesDBAccess($budgetDBInfo,$dataMode,$expenseSubType);

$crudResult = $expenseSubTypeDB->ManipulateData();

session_start();
$_SESSION['crudResult'] = $crudResult;
switch($dataMode){
    case "readOne":
        break;
    case "readAll":
        break;
    case "write":
        if($crudResult->isComplete == FALSE){
            header("location:../../../../datamanager/expenses/addeditExpenseSubType.php");
        }else{
            header("location:../../../../datamanager/expenses/expenseSubTypeDataManager.php");
        }
        break;
    case "update":
        break;
    case "delete":
        break;
}
?>