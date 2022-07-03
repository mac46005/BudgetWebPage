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
        $crudMessageBox = new CRUD_ResultContentPopulator();
        
        session_start();
        $crudMessageBox->DisplaySessionMessage();
        $dataObject = NULL;
        if($dataMode == "update"){
            
        }
        ?>
        <div class="main-container">
            <form action="">
                <input type="text" name="dataMode" id="dataMode" class="hide" value="<?php echo $dataMode; ?>">
                <input type="text" name="id" id="id" class="hide" value="<?php echo $id;?>">

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo (isset($dataObject))? $dataObject->name : ""; ?>">


                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" value="<?php echo (isset($dataObject))? $dataObject->amount : 0;?>">

                <select>
                    <?php
                    $incomeTypeDB = new IncomeTypesDBAccess($budgetDBInfo);
                    $crudResult = $incomeTypeDB->QuerySql("SELECT id,name FROM incometypes");
                    if($crudResult->isComplete == FALSE){
                        $crudMessageBox->CRUDMessageBox($crudResult);
                    }else{
                        while($row = $crudResult->dataObject->fetch_row()){
                            $isSelected = "";
                            $isSelected = (isset($dataObject) && $dataObject->incomeType_Id == $row[0])? "selected" : "";
                            $rowString = <<<ROW
                            <option value="$row[0]" $isSelected>$row[1]</option>
                            ROW;

                            echo $rowString;
                        }
                    }
                    ?>
                </select>
            </form>
        </div>
    </main>
    <script src="../../script/js/crudResultMessage.js"></script>
</body>

</html>