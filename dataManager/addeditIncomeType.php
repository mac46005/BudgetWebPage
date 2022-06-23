<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $formTypeName = (isset($_GET['formTypeName']))? $_GET['formTypeName'] : "";
    $dataMode = ($formTypeName == "Add")? "write" : "update";
    $crudResult = (isset($_GET['crudResult']))? $_GET['crudResult'] : NULL;
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
        if($crudResult != NULL){
            if($crudResult->isComplete == TRUE){
                $crudBackground = "success";
            }else{
                $crudBackground = "failed";
            }
            $crudMessageBox = <<<MESSAGE
            <section>
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
        $incomeTypesDBAccess = new IncomeTypesDBAccess($budgetDBInfo,"readOne");
        $incomeTypesUPDATECRUD_Result = NULL;
        if($dataMode == "update"){
            $incomeTypesUPDATECRUD_Result = $incomeTypesDBAccess->ReadOne($_GET['id']);
        }
        if($incomeTypesUPDATECRUD != NULL){
            $crudBackground = "";
            if($incomeTypesUPDATECRUD->isComplete == TRUE){
            }else{
                $crudBackground = "failed";
                $updateFaileMessage = <<<MESSAGE
                <section class="crud-message">
                    <h2>$incomeTypesUPDATECRUD->title</h2>
                    <p>$incomeTypesUPDATECRUD->message</p>
                    <hr/>
                    <h2>Extra information:</h2>
                    <p>$incomeTypesUPDATECRUD->object</p>
                </section>
                MESSAGE;
            }
        }
        ?>
        <div class="main-container">
            <form action="../script/incomeTypeDBAccess.php">
                <input type="text" name="dbManipulationType" id="" value="<?php echo $formTypeName; ?>" hidden>

                <label for="id">ID:</label>
                <input type="text" name="id" id="id" placeholder="0" disabled>

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input type="submit" value="Add/Edit Item">
            </form>
        </div>
    </main>
</body>
</html>