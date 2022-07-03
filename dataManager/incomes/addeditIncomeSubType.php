<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // ! ADD CLASS IncomeSUbTYPE
    require '../../script/php/dbAccess/models/expenseType.php';
    require '../../script/php/dbAccess/MySqliClasses.php';
    require '../../script/php/dbAccess/BudgetdbAccess.php';
    require '../../script/php/htmlProcessing/crudMessageBox.php';
    require_once '../../script/php/dbAccess/BudgetDbInfo.php';

    $dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "write";
    $id = (isset($_GET['id']))? $_GET['id'] : 0;

    $formName = ($dataMode == "update")? "Edit" : "Add";
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $formName;?> Income SubType</title>
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
                <?php echo $formName; ?> Income Sub Type
            </h1>
        </div>
    </header>

    <main>
        <?php

        ?>
        <div class="main-container">
            <form action="">

            </form>
        </div>
    </main>
    <script src="../../script/js/crudResultMessage.js"></script>
</body>

</html>