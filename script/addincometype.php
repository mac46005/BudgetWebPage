<?php
// Income Type Data Manager
$name = $_GET['name'];
function OpenConnection() {
    $serverName = "tcp:myserver.database.windows.net,1433";
    $connectionOptions = array("Database" => "", "Uid" =>"User", "PWD"=>"");
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if($conn == false){
        die(FormatErrors(sqlsrv_errors()));

        return $conn;
    }
}

function writeData(){
    try{
        $conn = OpenConnection();
        $tsql = "INSERT INTO [IncomeTypes] (name) VALUES($name)";

        
    }catch(Exception $e){
        echo("Error!");
    }
}
?>