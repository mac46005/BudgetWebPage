<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $formTypeName = $_GET['formTypeName'];
    ?>
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