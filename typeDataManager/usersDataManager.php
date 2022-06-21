<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['addedItem'])){
    echo "New item added";
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
                <li><a href="./manageTypeIndex.html">Manage Types</a></li>
                <li><a href="#">Mng Income</a></li>
                <li><a href="#">Mng Expense</a></li>
            </ul>
        </div>
    </nav>
    <header>
        <div class="header-container">
            <h1>Income Type Data Manager</h1>
        </div>
    </header>
    <main>
        <div class="main-container dashboard">
            <form action="">
                <nav>
                    <input type="text" name="search-box" id="" placeholder="search...">
                    <ul>
                        <li><a href="./add_edit_incometype.php?formTypeName=Add">Add Item</a></li>
                        <li><a href="#">Income Sub Types</a></li>
                        <li><a href="#"></a></li>
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
                        <tr>
                            <td>1</td>
                            <td>mac46005</td>
                            <td>4600</td>
                            <td>Marco</td>
                            <td>Preciado</td>
                            <td>12-19-1992</td>
                            <td>111-11-1111</td>
                            <td>02-23-2022</td>
                            <td>04-12-2022</td>
                            <td><a href="#" class="btn btn-edt">Edit</a></td>
                            <td><a href="#" class="btn btn-dlt">Delete</a></td>
                        </tr>
                        
                    </tbody>
                </table>

            </form>
        </div>
    </main>
</body>
</html>