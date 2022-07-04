<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require '../../script/php/dbAccess/models/expenseSubType.php';
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
    <title><?php echo $formName; ?> Expense SubType</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/_nav.css">
    <link rel="stylesheet" href="../../css/components/_forms.css">
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
            <h1>
                <?php echo $formName; ?> Expense Sub Type
            </h1>
        </div>
    </header>

    <main>
        <?php
        $crudMessageBox = new CRUD_ResultContentPopulator();

        session_start();
        $crudMessageBox->DisplaySessionMessage();

        $dataObject = NULL;
        if($dataMode == "update"){
            $dataObject = $crudMessageBox->DisplayUpdateErrorMessage(new ExpenseSubTypesDBAccess($budgetDBInfo,"readOne"),$id);
        }
        ?>
        <div class="main-container">
            <form action="../../script/php/dbAccess/controllers/expenseSubTypeDBController.php">
                <input type="text" name="dataMode" id="dataMode" class="hide" value="<?php echo $dataMode; ?>">
                <input type="text" name="id" id="id" class="hide" value="<?php echo $id; ?>" >

                <label for="Name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo (isset($dataObject))? $dataObject->name : ""; ?>">

                <label for="expenseType_Id">Expense Type:</label>
                <select name="expenseType_Id" id="expenseType_Id">
                    <?php
                    $expenseTypeDB = new ExpenseTypesDBAccess($budgetDBInfo);
                    $crudResult = $expenseTypeDB->QuerySql("SELECT id,name FROM expenseTypes");
                    if($crudResult->isComplete == FALSE){
                        $crudMessageBox->CRUDMessageBox($crudResult,"failed");
                    }else{
                        while($row = $crudResult->dataObject->fetch_row()){
                            $isSelected = "";
                            if($dataObject->expenseType_Id == $row[0]){
                                $isSelected = "selected";
                            }
                            echo <<<OPTION
                            <option value="$row[0]" $isSelected>$row[1]</option>
                            OPTION;
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="<?php echo $formName; ?>">
            </form>
        </div>
    </main>
    <script src="../../script/js/crudResultMessage.js"></script>
</body>
</html>