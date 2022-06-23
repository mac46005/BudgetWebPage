<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $formTypeName = $_GET['formTypeName'];
    $dataMode = ($formTypeName == "Add")? "write" : "update";


    require '../script/BudgetdbAccess.php';

    session_start();
    $crudResult = NULL;

    if(isset($_SESSION['crudResult'])){
        $crudResult = $_SESSION['crudResult'];
    }else{
        session_abort();
    }
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
        if($crudResult != NULL){
            $crudBackground = "";
            if($crudResult->isComplete == FALSE){
                $crudBackground = "failed";
            }else{
                $crudBackground = "success";
            }
            $crudMessage = <<<MESSAGE
            <section class="crud-result $crudBackground">
                <h2>$crudResult->title</h2>
                <p>$crudResult->message</p>
                <hr/>
                <h4>Extra Information</h4>
                <p>
                    $crudResult->object
                </p>
                <button id="closeCrudResult">Continue</button>
            </section>
            MESSAGE;

            echo $crudMessage;
        }
        session_abort();
        ?>
        <div class="main-container">
            <?php
            require_once '../script/BudgetDbInfo.php';
            $updateCrud = NULL;
            if($dataMode == "update"){
                if(isset($_GET['id'])){
                    $usersDBAccess = new UsersDBAccess($budgetDBInfo,"readOne");
                    $updateCrud = $usersDBAccess->ReadOne($_GET['id'])->object;
                }
            }
            ?>
            <form method="post" action="../script/usersDataDBAccess.php">
                <input class="hide" type="text" name="dataMode" id="dataMode" value="<?php echo $dataMode; ?>">
                <input class="hide" type="text" name="id" id="id" value="<?php echo (isset($updateCrud))? $updateCrud->id : "";?>">

                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo (isset($updateCrud))? $updateCrud->username : "" ?>">

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="<?php echo (isset($updateCrud))? $updateCrud->password : ""; ?>" >

                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" value="<?php echo (isset($updateCrud))? $updateCrud->firstName : ""?>">

                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" value="<?php echo (isset($updateCrud))? $updateCrud->lastName : ""; ?>">

                <label for="dob">DOB:</label>
                <input type="date" name="dob" id="dob" value="<?php echo (isset($updateCrud))? $updateCrud->dob : ""?>">

                <label for="ssn">SSN:</label>
                <input type="text" name="ssn" id="ssn" value="<?php echo (isset($updateCrud))? $updateCrud->ssn : ""?>">

                <input type="submit" value="<?php echo $formTypeName?> User" class="btn submit">
            </form>
        </div>
    </main>
    <script src="../script/crudResultMessage.js"></script>
</body>

</html>