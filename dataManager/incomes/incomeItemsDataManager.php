<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Items Data Manager</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/_nav.css">
    <link rel="stylesheet" href="../../css/components/_dashboard.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../../dashBoard.php">BudgetApp</a></h4>
        </div>

        <ul class="nav-menu">
            <li><a href="../DataManagerHome.html">Data Manager</a></li>
            <li><a href="./incomeItemsDataManager.php">Mng Income</a></li>
            <li><a href="#">Mng Expense</a></li>
        </ul>
    </nav>

    <header>
        <div class="header-container">
            <h1>Income Items Data Manager</h1>
        </div>
    </header>
    <main>
        <?php
        //TODO: object class
        //TODO: db class
        //TODO: setup session variables
        //TODO: display session crudResult
        ?>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Frequency</th>
                    <th>Income Type</th>
                    <th>Income SubType</th>
                    <th>Reference Number</th>
                    <th>TimeStamp</th>
                    <th>DateModified</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //TODO: create incomeItemsDB object
                //TODO: call query Sql
                //TODO: display data or error message
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <div class="footer-container">
            
        </div>
    </footer>
</body>
</html>