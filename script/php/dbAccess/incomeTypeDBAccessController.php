<?php


require '../dbAccess/MySqliClasses.php';
require "../dbAccess/BudgetdbAccess.php";



$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "";
$id = (isset($_GET['id']))? $_GET['id'] : "";
$name = (isset($_GET['name']))? $_GET['name'] : "";

require '../dbAccess/models/incomeType.php';
$incomeType = new IncomeType($id, $name);

require_once '../dbAccess/BudgetDbInfo.php';
$incomeTypesDBAccess = new IncomeTypesDBAccess($budgetDBInfo,$dataMode,$incomeType);


$crudResult = $incomeTypesDBAccess->ManipulateData();


if($crudResult != NULL){
    switch($crudResult->dataMode){
        case "readOne":
            break;
        case "readAll":
            break;
        case "write":
            session_start();
            $_SESSION['crudResult'] = $crudResult;
            if($crudResult->isComplete == FALSE){
                header("location:../datamanager/addeditIncomeType.php?formTypeName=Add");
            }else{
                header("location:../datamanager/incomeTypesDataManager.php");
            }
            break;
        case "update":
            session_start();
            $_SESSION['crudResult'] = $crudResult;
            if($crudResult->isComplete == FALSE){
                header("location:../../../datamanager/addeditIncomeType.php?dataMode=update&id=" . $crudResult->dataObject->id);
            }else{
                header("location:../../../datamanager/incomeTypesDataManager.php");
            }
            break;
        case "delete":
            break;
    }
}

?>