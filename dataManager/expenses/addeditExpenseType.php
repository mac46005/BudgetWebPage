<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require '../../script/php/dbAccess/MySqliClasses.php';
    require '../../script/php/dbAccess/BudgetdbAccess.php';
    require '../../script/php/dbAccess/models/expenseType.php';
    require '../../script/php/htmlProcessing/crudMessageBox.php';
    require_once '../../script/php/dbAccess/BudgetDbInfo.php';

    $dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "write";
    $id = (isset($_GET['id']))? $_GET['id'] : 0;
    $name = (isset($_GET['name']))? $_GET['name'] : "";

    $formNameType = ($dataMode == "update")? "Edit" : "Add";

    $crudMessageBox = new CRUD_ResultContentPopulator();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $formNameType;?> Expense Type</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/_nav.css">
    <link rel="stylesheet" href="../../css/components/_forms.css">
</head>

<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="../DataManagerHome.html">Manage Types</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>

    <header>
        <div class="header-container">
            <h1>
                <?php echo $formNameType;?> Expense Type
            </h1>
        </div>
    </header>

    <main>
        <?php
        session_start();
        $crudMessageBox->DisplaySessionMessage();

        $dataObject = NULL;
        if($dataMode == "update"){
            $dataObject = $crudMessageBox->DisplayUpdateErrorMessage(new ExpenseTypesDBAccess($budgetDBInfo,"readOne"),$id);
        }
        ?>
        <div class="main-container">
            <form action="../../script/php/dbAccess/controllers/" method="post">
                <input class="hide" type="text" name="dataMode" id="dateMode">
                <input class="hide" type="text" name="id" id="id">

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input type="submit" value="<?php echo $formNameType?>">
            </form>
        </div>
    </main>

    <footer>
        <div class="footer-container">

        </div>
    </footer>

</body>

</html>