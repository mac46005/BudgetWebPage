<!DOCTYPE html>
<?php
require '../script/BudgetdbAccess.php';
session_start();
$crudResult = NULL;
if(isset($_SESSION['crudResult'])){
    $crudResult = $_SESSION['crudResult'];
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Type Data Manager</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/components/_nav.css">
    <link rel="stylesheet" href="../css/components/_dashboard.css">
    <link rel="stylesheet" href="../css/sections/incomeTypeData.css">
</head>

<body>
    <nav>
        <div class="nav-container">
            <h4><a href="../dashBoard.php">BudgetApp</a></h4>

            <ul class="nav-menu">
                <li><a href="./DataManagerHome.html">Data Manager</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>
    <header>
        <div class="header-container">
            <h1>Users Data Manager</h1>
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

    session_destroy();
    ?>
    <script src="../script/crudResultMessage.js"></script>
        <div class="main-container dashboard">
            <form action="">
                <nav>
                    <input type="text" name="search-box" id="" placeholder="search...">
                    <ul>
                        <li><a href="../dataManager/addedituser.php?formTypeName=Add">Add User</a></li>
                        <li>
                    </ul>
                </nav>

                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>username</th>
                            <th>password</th>
                            <th>firstName</th>
                            <th>lastName</th>
                            <th>dob</th>
                            <th>ssn</th>
                            <th>dateCreated</th>
                            <th>dateModified</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../script/BudgetDbInfo.php';
                        $usersDataDBAccess = new UsersDBAccess($budgetDBInfo,"readAll");

                        $tableCrudResult = $usersDataDBAccess->ManipulateData();
                        
                        if($tableCrudResult->isComplete == TRUE){
                            while($row = $tableCrudResult->object->fetch_row()){
                                $rowString = <<<ROW
                                <tr>
                                    <td>$row[0]</td>
                                    <td>$row[1]</td>
                                    <td>$row[2]</td>
                                    <td>$row[3]</td>
                                    <td>$row[4]</td>
                                    <td>$row[5]</td>
                                    <td>$row[6]</td>
                                    <td>$row[7]</td>
                                    <td>$row[8]</td>
                                    <td><a class="btn btn-edt" href="../datamanager/addedituser.php?formTypeName=Edit&id=$row[0]">Edit</a></td>
                                    <td><a class="btn btn-dlt" href="../script/usersDataDBAccess.php?dataMode=delete&id=$row[0]">Delete</a></td>
                                </tr>
                                ROW;
                                echo $rowString;
                            }
                        }
                        else{
                            $crudMessageBox = <<<MESSAGE
                            <section class="crud-table-message failed">
                                <h2>$tableCrudResult->title</h2>
                                <p>$tableCrudResult->message</p>
                                <hr/>
                                <h4>Extra Information:</h4>
                                <p></p>
                                <button type="button" id="closeCrudTableMessage">Continue</button>
                            </section>
                            MESSAGE;

                            echo $crudMessageBox;
                        }
                        ?>
                        <script src="../script/crudTableMessage.js"></script>
                    </tbody>
                </table>
            </form>
        </div>
    </main>
</body>

</html>