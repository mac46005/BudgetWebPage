<?php
// Income Type Data Manager
session_start();
$dbManipType = $_GET['dbManipulationType'];



$name = $_GET['name'];
$redirectPage = "location:../typeDataManager/incomeTypeData.php";
function OpenConnection() {
    $serverName = "tcp:myserver.database.windows.net,1433";
    $connectionOptions = array("Database" => "", "Uid" =>"User", "PWD"=>"");
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if($conn == false){
        die(FormatErrors(sqlsrv_errors()));

        return $conn;
    }
}

function readData(){

}

function writeData(){
    try{
        $conn = OpenConnection();
        $tsql = "INSERT INTO [IncomeTypes] (name) VALUES($name)";
        $insertIncomeType = sqlsrv_query($conn, $tsql);
        if($insertIncomeType == FALSE){
            echo "failed to write to sql server";
            die(FormatErrors($sqlsrv_errors()));
        }else{
            echo "Successfully added income item";
            $_SESSION["addedNew"] = TRUE;
            $_SESSION["itemName"] = $name;
        }
        
    }catch(Exception $e){
        echo("Error!");
    }
}

function updateData(){

}
function IncomeManipulation(){
    switch($dbManipType){
        case "Read":
            readData();
            break;
        case "Add":
            writeData();
            break;
        case "Edit":
            updateData();
            break;
    }
}


?>