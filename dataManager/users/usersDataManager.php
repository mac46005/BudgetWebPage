<!DOCTYPE html>
<?php

require '../../script/php/dbAccess/MySqliClasses.php';
require '../../script/php/dbAccess/BudgetdbAccess.php';
require '../../script/php/dbAccess/models/users.php';
require '../../script/php/htmlProcessing/crudMessageBox.php';
require_once '../../script/php/dbAccess/BudgetDbInfo.php';


$crudMessageBox = new CRUD_ResultContentPopulator();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Type Data Manager</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/_nav.css">
    <link rel="stylesheet" href="../../css/components/_dashboard.css">
    <link rel="stylesheet" href="../../css/sections/incomeTypeData.css">
</head>

<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="./DataManagerHome.html">Data Manager</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>
    <header>
        <div class="header-container">
            <h1>Users Data Manager</h1>
        </div>
    </header>
    
    <main>
    <?php

    //* Display $_SESSION['crudResult'] if exists others nothing is displayed
    session_start();
    $crudMessageBox->DisplaySessionMessage();

    ?>

    <script src="../../script/js/crudResultMessage.js"></script>
        <div class="main-container dashboard">
            <form action="">
                <nav>
                    <input type="text" name="search-box" id="" placeholder="search...">
                    <ul>
                        <li><a href="./addedituser.php?dataMode=write">Add User</a></li>
                        <li>
                    </ul>
                </nav>

                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>username</th>
                            <th>password</th>
                            <th>firstName</th>
                            <th>lastName</th>
                            <th>dob</th>
                            <th>ssn</th>
                            <th>dateCreated</th>
                            <th>dateModified</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // * Display table data otherwise display error message
                        $usersDbAccess = new UsersDBAccess($budgetDBInfo, "readAll");
                        $crudResult = $usersDbAccess->ReadAll();
                        $crudMessageBox->DisplayCRUDDataRow($crudResult,"./addeditUser.php","../../script/php/dbAccess/controllers/usersDataDbAccessController.php")
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </main>
</body>

</html>