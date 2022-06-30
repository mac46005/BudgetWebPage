<?php

require '../models/expenseType.php';
require '../MySqliClasses.php';
require '../BudgetdbAccess.php';
require_once '../BudgetDbInfo.php';

$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "";

$id = (isset($_GET['id']))? $_GET['id'] : 0;
$name = (isset($_GET['name']))? $_GET['name'] : "";

$expenseType = new ExpenseType($id,$name);

$expenseTypesDBAccess = new ExpenseTypesDBAccess($budgetDBInfo,$dataMode,$expenseType);
$crudResult = $expenseTypesDBAccess->ManipulateData();

$sessionDataName = "crudResult";
session_start();
$_SESSION[$sessionDataName] = $crudResult;
switch ($crudResult->dataMode) {
    case "readOne":
        break;
    case "readAll":
        break;
    case "write":
        if($crudResult->isComplete == FALSE){
            header("location:../../../../datamanager/expenses/addeditExpenseType.php");
        }else{
            header("location:../../../../datamanager/expenses/expenseTypeDataManager.php");
        }
        break;
    case "update":
        if($crudResult->isComplete == FALSE){
            header("location:../../../../datamanager/expenses/addeditExpenseType.php?dataMode=update&id=" . $crudResult->dataObject->id);
        }else{
            header("location:../../../../datamanager/expenses/expenseTypeDataManager.php");
        }
        break;
    case "delete":
        header("location:../../../../datamanager/expenses/expenseTypeDataManager.php");
        break;
}
?>