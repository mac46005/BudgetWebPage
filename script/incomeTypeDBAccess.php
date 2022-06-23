<?php
require "../script/BudgetdbAccess.php";
$dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "";
$id = (isset($_GET['id']))? $_GET['id'] : 0;
$name = (isset($_GET['name']))? $_GET['name'] : "";
require_once '../script/BudgetDbInfo.php';
$incomeType = new IncomeType($id, $name);


$incomeTypesDBAccess = new IncomeTypesDBAccess($budgetDBInfo,$dataMode,$incomeType);


$crudResult = $incomeTypesDBAccess->ManipulateData();


if($crudResult != NULL){
    switch($crudResult->crudType){
        case "readOne":
            break;
        case "readAll":
            break;
        case "write":
            session_start();
            $_SESSION['crudResult'] = $crudResult;
            if($crudResult->isComplete == FALSE){
                header("location:../datamanager/incomeTypesDataManager.php");
            }else{
                header("location:../datamanager/addeditIncomeType.php?formTypeName=Edit&id=$crudRow->id");
            }
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}

?>