<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once '../script/php/dbAccess/BudgetDbInfo.php';
    require '../script/php/dbAccess/models/users.php';
    require '../script/php/dbAccess/MySqliClasses.php';
    require '../script/php/dbAccess/BudgetdbAccess.php';
    require '../script/php/htmlProcessing/crudMessageBox.php';


    $dataMode = (isset($_GET['dataMode']))? $_GET['dataMode'] : "write";
    $formTypeName = ($dataMode == "update")? "Update" : "Add";
    $id = (isset($_GET['id']))? $_GET['id'] : 0;

    $crudMessageBox = new CRUD_ResultContentPopulator();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $formTypeName; ?> User</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/components/_nav.css">
    <link rel="stylesheet" href="../css/components/_forms.css">
    <link rel="stylesheet" href="../css/sections/addedituser.css">
</head>

<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="../dataManager/DataManagerHome.html">Manage Types</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>

    <header>
        <div class="header-container">
            <h1>
                <?php echo $formTypeName; ?> User
            </h1>
        </div>
    </header>
    <main>
        <?php
        session_start();
        $crudMessageBox->DisplaySessionMessage();
        ?>
        <div class="main-container">
            <?php
            $dataObject = NULL;
            $dataObject = $crudMessageBox->DisplayUpdateErrorMessage(new UsersDBAccess($budgetDBInfo,"readOne"), $id);
            ?>
            <form method="post" action="../script/usersDataDBAccess.php">
                <input class="hide" type="text" name="dataMode" id="dataMode" value="<?php echo $dataMode; ?>">
                <input class="hide" type="text" name="id" id="id" value="<?php echo (isset($_GET['id']))? $_GET['id'] : 0;?>">

                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo (isset($dataObject))? $dataObject->username : ""; ?>">

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="<?php echo (isset($dataObject))? $dataObject->password : ""; ?>" >

                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" value="<?php echo (isset($dataObject))? $dataObject->firstName : ""; ?>">

                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" value="<?php echo (isset($dataObject))? $dataObject->lastName : ""; ?>">

                <label for="dob">DOB:</label>
                <input type="date" name="dob" id="dob" value="<?php echo (isset($dataObject))? $dataObject->dob : ""; ?>">

                <label for="ssn">SSN:</label>
                <input type="text" name="ssn" id="ssn" value="<?php echo (isset($dataObject))? $dataObject->ssn : ""; ?>">

                <input type="submit" value="<?php echo $formTypeName?> User" class="btn submit">
            </form>
        </div>
    </main>
    <script src="../script/crudResultMessage.js"></script>
</body>

</html>