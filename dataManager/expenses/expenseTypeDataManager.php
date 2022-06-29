<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once '../script/php/dbAccess/BudgetDbInfo.php';
    require '../script/php/dbAccess/MySqliClasses.php';
    require '../script/php/dbAccess/BudgetdbAccess.php';
    require '../script/php/htmlProcessing/crudMessageBox.php';

    $crudMessageBox = new CRUD_ResultContentPopulator();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Type Data Manager</title>
</head>
<body>
    <nav>

    </nav>

    <header>
        <div class="header-container">
            <h2>
                Expense Type Data Manager
            </h2>
        </div>
    </header>



    <main>
        <?php
        session_start();
        $crudMessageBox->DisplaySessionMessage();
        ?>
        <div class="main-container dashboard">
            <nav>

                <ul>
                    <li><a href="#">Add Item</a></li>    
                </ul>
            </nav>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Date Modifed</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usersDbAccess = new UsersDBAccess($budgetDBInfo,"readAll");
                    $crudMessageBox->DisplayCRUDDataRow($usersDbAccess->ReadAll(),"","");
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>