<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require '../../script/php/dbAccess/models/incomeSubType.php';
    require '../../script/php/dbAccess/MySqliClasses.php';
    require '../../script/php/dbAccess/BudgetdbAccess.php';
    require '../../script/php/htmlProcessing/crudMessageBox.php';
    require_once '../../script/php/dbAccess/BudgetDbInfo.php';

    $crudMessageBox = new CRUD_ResultContentPopulator();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income SubTypes Data Manager</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/_nav.css">
    <link rel="stylesheet" href="../../css/components/_dashboard.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="../DataManagerHome.html">Data Manager</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>

    <header>
        <div class="header-container">
            <h1>Income SubType Data Manager</h1>
        </div>
    </header>


    <main>
        <?php
        // * Displays $_SESSION['crudResult'] if found in session.
        session_start();
        $crudMessageBox->DisplaySessionMessage();
        ?>
        <script src="../../script/js/crudResultMessage.js"></script>
        <div class="main-container dashboard">
            <form action="">
                <nav>
                    <input type="text" name="search-box" id="" placeholder="search...">
                    <ul>
                        <li><a href="./addeditIncomeSubType.php">Add Item</a></li>
                    </ul>
                </nav>


                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>Income Type</th>
                            <th>Date Created</th>
                            <th>Date Modified</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $incomeSubTypeDB = new IncomeSubTypesDBAccess($budgetDBInfo);
                        $sql = <<<SQL
                        SELECT ist.id , ist.name, it.id, it.name, ist.dateCreated, ist.dateModified
                        FROM incomesubtypes ist
                        INNER JOIN incometypes it ON ist.incomeType_Id = it.id
                        SQL;
                        $crudResult =  $incomeSubTypeDB->QuerySql($sql);
                        if($crudResult->isComplete == FALSE){
                            $crudMessageBox->CRUDMessageBox($crudResult);
                        }else{
                            while($row = $crudResult->dataObject->fetch_row()){
                                $rowString = <<<ROW
                                <tr>
                                    <td>$row[0]</td>
                                    <td>$row[1]</td>
                                    <td>$row[3]</td>
                                    <td>$row[4]</td>
                                    <td>$row[5]</td>
                                    <td><a class="btn btn-edt" href="./addeditIncomeSubType.php?dataMode=update&id=$row[0]">Edit</a></td>
                                    <td><a class="btn btn-dlt" href="../../script/php/dbAccess/controllers/incomeSubTypeDBController.php?dataMode=delete&id=$row[0]">Delete</a></td>
                                </tr>
                                ROW;
                                echo $rowString;
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </form>
        </div>
    </main>
    <script src="../script/js/crudResultMessage.js"></script>
</body>
</html>