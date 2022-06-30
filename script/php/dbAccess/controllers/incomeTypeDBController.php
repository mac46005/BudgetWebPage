<?php

require '../models/incomeType.php';
require '../MySqliClasses.php';
require '../BudgetdbAccess.php';
require_once '../BudgetDbInfo.php';


$sessionId = 'crudResult';

$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "";
$id = (isset($_GET['id']))? $_GET['id'] : "";
$name = (isset($_GET['name']))? $_GET['name'] : "";


$incomeType = new IncomeType($id, $name);


$incomeTypesDBAccess = new IncomeTypesDBAccess($budgetDBInfo,$dataMode,$incomeType);


$crudResult = $incomeTypesDBAccess->ManipulateData();


if($crudResult != NULL){
    switch($crudResult->dataMode){
        case "readOne":
            session_start();
            $_SESSION[$sessionId] = $crudResult;
            if($crudResult->isComplete == FALSE){
                header("location:../../datamanager/addeditIncomeType.php?dataMode=update&id=$crudResult->dataObject->id");
            }else{
                header("location../../datamanager/incomeTypeDataManager.php");
            }
            break;
        case "readAll":
            break;
        case "write":
            session_start();
            $_SESSION[$sessionId] = $crudResult;
            if($crudResult->isComplete == FALSE){
                header("location:../../../../datamanager/incomes/addeditIncomeType.php?formTypeName=Add");
            }else{
                header("location:../../../../datamanager/incomes/incomeTypesDataManager.php");
            }
            break;
        case "update":
            session_start();
            $_SESSION[$sessionId] = $crudResult;
            if($crudResult->isComplete == FALSE){
                header("location:../../../../datamanager/incomes/addeditIncomeType.php?dataMode=update&id=" . $crudResult->dataObject->id);
            }else{
                header("location:../../../../datamanager/incomes/incomeTypesDataManager.php");
            }
            break;
        case "delete":
            session_start();
            $_SESSION[$sessionId] = $crudResult;
            header("location:../../../../datamanager/incomes/incomeTypesDataManager.php");
            break;
    }
}

?>