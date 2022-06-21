<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $formTypeName = $_GET['formTypeName'];
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
                <li><a href="./manageTypeIndex.html">Manage Types</a></li>
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
        <div class="main-container">
            <form action="../script/usersDataDBAccess.php?manipOption=write">
                <input class="hide" type="text" name="dataMode" id="dataMode" value="write" >
                <input class="hide" type="text" name="id" id="id">

                <label for="username">Username:</label>
                <input type="text" name="username" id="username">

                <label for="password">Password:</label>
                <input type="password" name="password" id="password">

                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName">

                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName">

                <label for="dob">DOB:</label>
                <input type="date" name="dob" id="dob">

                <label for="ssn">SSN:</label>
                <input type="text" name="ssn" id="ssn">

                <input type="submit" value="<?php echo $formTypeName?> User" class="btn submit">
            </form>
        </div>
    </main>
</body>
</html>