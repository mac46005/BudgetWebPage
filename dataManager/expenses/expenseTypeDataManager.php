<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require '../../script/php/dbAccess/models/expenseType.php';
    require '../../script/php/dbAccess/MySqliClasses.php';
    require '../../script/php/dbAccess/BudgetdbAccess.php';
    require '../../script/php/htmlProcessing/crudMessageBox.php';
    require_once '../../script/php/dbAccess/BudgetDbInfo.php';

    $crudMessageBox = new CRUD_ResultContentPopulator();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Type Data Manager</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/_nav.css">
    <link rel="stylesheet" href="../../css/components/_dashboard.css">
    <link rel="stylesheet" href="../../css/sections/expenseTypeDataManager.css">
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
                Expense Type Data Manager
            </h2>
        </div>
    </header>



    <main>
        <?php
        session_start();
        $crudMessageBox->DisplaySessionMessage();
        ?>
        <script src="../../script/js/crudResultMessage.js"></script>
        <div class="main-container dashboard">
            <nav>
                <input type="text" name="search-box" id="" placeholder="search...">
                <ul>
                    <li><a href="./addeditExpenseType.php?dataMode=write">Add Item</a></li>
                </ul>
            </nav>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Date Modifed</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usersDbAccess = new ExpenseTypesDBAccess($budgetDBInfo,"readAll");
                    $crudMessageBox->AttemptToDisplayTableData($usersDbAccess->ReadAll(),"./addeditExpenseType.php","../../script/php/dbAccess/controllers/expenseTypeDBController.php");
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>