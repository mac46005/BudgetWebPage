<!DOCTYPE html>
<?php
session_start();
require '../script/BudgetdbAccess.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Type Data Manager</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/components/_nav.css">
    <link rel="stylesheet" href="../css/components/_dashboard.css">
    <link rel="stylesheet" href="../css/sections/incomeTypeData.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="./DataManagerHome.html">Data Manager</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>
    <header>
        <div class="header-container">
            <h1>Income Type Data Manager</h1>
        </div>
    </header>
    <main>
        <?php


        ?>
        <div class="main-container dashboard">
            <form action="">
                <nav>
                    <input type="text" name="search-box" id="" placeholder="search...">
                    <ul>
                        <li><a href="./addEditIncomeType.php?formTypeName=Add">Add Item</a></li>
                        <li><a href="#">Income Sub Types</a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </nav>

                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>Date Created</th>
                            <th>Date Modified</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../script/BudgetDbInfo.php';
                        $incomeTypesDBAccess = new IncomeTypesDBAccess($budgetDBInfo,"readAll");
                        $crudTableResult = $incomeTypesDBAccess->ReadAll();
                        if($crudTableResult->isComplete == TRUE){
                            while($row = $crudTableResult->object->fetch_row()){
                                $rowString = <<<ROW
                                <tr>
                                    <td>$row[0]</td>
                                    <td>$row[1]</td>
                                    <td><a class="btn btn-edt" href="../datamanager/addeditIncomeType.php?formTypeName=Edit&id=$row[0]">Edit</a></td>
                                    <td><a class="btn btn-dlt" href="../datamanager/incomeTypeDBAccess.php?dataMode=delete&id=$row[0]">Delete</a></td>
                                </tr>
                                ROW;
                            }
                        }else{
                            $crudTableMessage = <<<MESSAGE
                            <section class="crud-table-message">
                                
                            </section>
                            MESSAGE;
                        }
                        ?>
                    </tbody>
                </table>

            </form>
        </div>
    </main>
</body>
</html>