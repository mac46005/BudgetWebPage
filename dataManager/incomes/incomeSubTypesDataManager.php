<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require '../../script/php/dbAccess/models/incomeType.php';
    require '../../script/php/dbAccess/MySqliClasses.php';
    require '../../script/php/dbAccess/BudgetdbAccess.php';
    require '../../script/php/htmlProcessing/crudMessageBox.php';
    require_once '../../script/php/dbAccess/BudgetDbInfo.php';
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
        $crud_ResultContentPopulator->DisplaySessionMessage();
        ?>
        <script src="../../script/js/crudResultMessage.js"></script>
        <div class="main-container dashboard">
            <form action="">
                <nav>
                    <input type="text" name="search-box" id="" placeholder="search...">
                    <ul>
                        <li><a href="./addEditIncomeType.php?dataMode=write">Add Item</a></li>
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
                        
                        ?>
                    </tbody>
                </table>

            </form>
        </div>
    </main>
    <script src="../script/js/crudResultMessage.js"></script>
</body>
</html>