<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require '../script/php/htmlProcessing/crudMessageBox.php';
    require '../script/php/dbAccess/models/incomeType.php';

    $dataMode = (isset($_GET['id']))? $_GET['id'] : NULL;
    $id = (isset($_GET['id']))? $_GET['id'] : 0;
    $formTitle = ($dataMode == "write" || $dataMode == NULL)? "Add" : "Update";

    ?>
    <script src="../script/crudResultMessage.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fomTitle; ?> Income Type</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/components/_nav.css">
    <link rel="stylesheet" href="../css/components/_forms.css">
    <link rel="stylesheet" href="../css/sections/addeditincometype.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="./manageTypeIndex.html">Manage Types</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>
    <header>
        <div class="header-container">
            <h1><?php echo $formTitle; ?> Income Type</h1>
        </div>
    </header>
    <main>
        <?php
        $crudMessageBox = new CRUD_ResultContentPopulator();

        $crudMessageBox->DisplaySessionMessage();

        $object = NULL;
        if($dataMode == "update"){
            require_once '../script/dbAccess/BudgetDbInfo.php';
            $object = $crudMessageBox->DisplayUpdateErrorMessage(new IncomeTypesDBAccess($budgetDBInfo,$dataMode),$id);
        }
        ?>
        <script src="../script/js/crudResultMessage.js"></script>


        <div class="main-container">
            <form action="../script/incomeTypeDBAccess.php">
                <input class="hide" type="text" name="dataMode" id="dataMode" value="<?php echo $dataMode; ?>">

                <input class="hide" type="text" name="id" id="id" placeholder="0" value="<?php echo (isset($object))? $object->id : ""; ?>" disabled>

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo (isset($object))? $object->name : ""; ?>">

                <input type="submit" value="Add/Edit Item">
            </form>
        </div>
    </main>
</body>
</html>