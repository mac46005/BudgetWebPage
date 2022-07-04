<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require '../../script/php/dbAccess/models/expenseSubType.php';
    require '../../script/php/dbAccess/MySqliClasses.php';
    require '../../script/php/dbAccess/BudgetdbAccess.php';
    require '../../script/php/htmlProcessing/crudMessageBox.php';
    require_once '../../script/php/dbAccess/BudgetDbInfo.php';
    
    
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Sub Type Data Manager</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/_nav.css">
    <link rel="stylesheet" href="../../css/components/_dashboard.css">

</head>
<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="../DataManagerHome.html">Mng System Topics</a></li>
                <li><a href="../incomes/incomeItemsDataManager.php">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>

    <header>
        <div class="header-container">
            <h2>
                Expense Sub Type Data Manager
            </h2>
        </div>
    </header>

    <main>
        <?php
        $crudMessageBox = new CRUD_ResultContentPopulator();

        session_start();
        $crudMessageBox->DisplaySessionMessage();
        ?>
        <div class="main-container dashboard">
            <nav>
                <input type="text" name="searchbox" id="" class="search-box" placeholder="search...">
                <ul>
                    <li><a href="./addeditExpenseSubType.php">Add Item</a></li>
                </ul>
            </nav>

            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>ExpenseType</th>
                        <th>Date Created</th>
                        <th>Date Modified</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $expenseSubTypeDB = new ExpenseSubTypesDBAccess($budgetDBInfo,"readAll");
                    $crudResult = $expenseSubTypeDB->QuerySql("SELECT est.id, est.name, et.id, et.name, est.dateCreated, est.dateModified FROM expensesubtypes est INNER JOIN expensetypes et ON est.expenseType_Id = et.id");
                    if($crudResult->isComplete == FALSE){
                        $crudMessageBox->CRUDMessageBox($crudResult, "failed");
                    }else{
                        $data = [];
                        while($row = $crudResult->dataObject->fetch_row()){
                            $rowOutput = <<<ROW
                            <tr>
                                <td>$row[0]</td>
                                <td>$row[1]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td><a class="btn btn-edt" href="./addeditExpenseSubType.php?dataMode=update&id=$row[0]">Edit</a></td>
                                <td><a class="btn btn-dlt" href="../../script/php/dbAccess/controllers/expenseSubTypeDBController.php?dataMode=delete&id=$row[0]">Delete</a></td>
                            </tr>
                            ROW;
                            echo $rowOutput;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <div class="footer-container">

        </div>
    </footer>
    <script src="../../script/js/crudResultMessage.js"></script>
</body>
</html>