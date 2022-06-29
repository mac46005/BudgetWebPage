<?php

$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "";

$id = (isset($_GET['id']))? $_GET['id'] : 0;
$name = (isset($_GET['name']))? $_GET['name'] : "";

$expenseType = new ExpenseType($id,$name);

$expenseTypesDBAccess = new ExpenseTypesDBAccess($budgetInfo,$dataMode,$expenseType);
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
            header("location:../../../datamanager/expenses/addeditExpenseType.php");
        }else{
            header("location:../../../datamanager/expense/expenseTypeDataManager.php");
        }
        break;
    case "update":
        break;
    case "delete":
        break;
}
?>