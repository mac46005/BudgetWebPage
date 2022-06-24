<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 

    CREATE A CLASS THAT CAN DELEGATE INFORMATION FOR DATA EASILY
    You are doing the same code in different pages
     -->
    <?php
    $formTypeName = (isset($_GET['formTypeName']))? $_GET['formTypeName'] : "";
    $dataMode = ($formTypeName == "Add")? "write" : "update";
    ?>
    <script src="../script/crudResultMessage.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $formTypeName; ?> Income Type</title>
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
            <h1><?php echo $formTypeName; ?> Income Type</h1>
        </div>
    </header>
    <main>
        <?php
        include '../script/BudgetdbAccess.php';
        $crudResult = NULL;
        if(isset($_GET['crudResult'])){
            $crudResult = $_GET['crudResult'];
        }
        else{
            session_abort();
        }


        $crudBackground = "";
        if($crudResult != NULL){
            if($crudResult->isComplete == TRUE){
                $crudBackground = "success";
            }else{
                $crudBackground = "failed";
            }
            $crudMessageBox = <<<MESSAGE
            <section class="crud-result $crudBackground">
                <h2>$crudResult->title</h2>
                <p>$crudResult->message</p>
                <hr/>
                <p>$crudResult->object</p>
                <button id="closeCrudResult">Continue</button>
            </section>
            MESSAGE;
    
            echo $crudMessageBox;
            session_destroy();
        }




        require_once '../script/BudgetDbInfo.php';
       
        $incomeTypesUPDATECRUD_Result = NULL;
        if($dataMode == "update"){
            $incomeTypesDBAccess = new IncomeTypesDBAccess($budgetDBInfo,"readOne");
            $incomeTypesUPDATECRUD_Result = $incomeTypesDBAccess->ReadOne((isset($_GET['id']))? $_GET['id'] : "");
        }

        if($incomeTypesUPDATECRUD_Result != NULL){
            $crudBackground = "";
            if($incomeTypesUPDATECRUD_Result->isComplete == TRUE){
            }else{
                $crudBackground = "failed";
                $updateFailedMessage = <<<MESSAGE
                <section class="crud-message">
                    <h2>$incomeTypesUPDATECRUD_Result->title</h2>
                    <p>$incomeTypesUPDATECRUD_Result->message</p>
                    <hr/>
                    <h2>Extra information:</h2>
                    <p>$incomeTypesUPDATECRUD_Result->object</p>
                    <button id="closeCrudResult">Continue</button>
                </section>
                MESSAGE;
                echo $updateFailedMessage;
            }
        }
        ?>
        <div class="main-container">
            <form action="../script/incomeTypeDBAccess.php">
                <input class="hide" type="text" name="dataMode" id="dataMode" value="<?php echo $dataMode; ?>">

                <input class="hide" type="text" name="id" id="id" placeholder="0" value="<?php echo (isset($incomeTypesUPDATECRUD))? $incomeTypesUPDATECRUD_Result->object->id : ""; ?>" disabled>

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo (isset($incomeTypesUPDATECRUD))? $incomeTypesUPDATECRUD_Result->object->name : ""; ?>">

                <input type="submit" value="Add/Edit Item">
            </form>
        </div>
    </main>
</body>
</html>