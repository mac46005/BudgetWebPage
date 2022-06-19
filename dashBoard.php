<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/components/_nav.css">
    <link rel="stylesheet" href="./css/sections/dashboard.css">
</head>

<body>
    <nav>
        <div class="nav-container">
            <h4><a href="#">BudgetApp</a></h4>
        </div>
        <ul class="nav-menu">
            <li><a href="#">Mng Income</a></li>
            <li><a href="#">Mng Expense</a></li>
        </ul>
    </nav>

    <header>
        <div class="header-container">
            <h1>Monthly Budget</h1>
        </div>
    </header>

    <div class="container-grid">
        
        <main id="montly-summary" class="index-main-summary col-4">
            <table>
                <tr>
                    <th colspan="2">Monthly Summary</th>
                </tr>
                <tr>
                    <td>Total Montly Income</td>
                    <td class="positive">$60,0000</td>
                </tr>
                <tr>
                    <td>Total Monthly Expense</td>
                    <td class="negative">$44,343.33</td>
                </tr>
                <tr>
                    <td>Total Monthly Balance</td>
                    <td class="positive">$33,222.22</td>
                </tr>
            </table>
        </main>

        <section id="user-income" class="index-sub-summary col-1">
            <table>
                <tr>
                    <th colspan="2">User Income</th>
                </tr>
                <tr>
                    <td>Danielle</td>
                    <td class="negative">$33.33</td>
                </tr>
                <tr>
                    <td>Marco</td>
                    <td class="negative">$22.33</td>
                </tr>
            </table>
        </section>

        <section id="user-expense" class="index-sub-summary col-1">
            <table>
                <tr>
                    <th colspan="2">User Expense</th>
                </tr>
                <tr>
                    <td>Marco</td>
                    <td>$45.55</td>
                </tr>
                <tr>
                    <td>Danielle</td>
                    <td>$233.33</td>
                </tr>
            </table>
        </section>

        <section id="dti" class="index-sub-summary col-1">
            <h4>DTI: <span>34.4</span></h4>
            <h4>GOAL: <span>50</span></h4>
            <h4>DIFF: <span>1.9</span></h4>
        </section>

        <div class="item-summary">

        </div>
    </div>

    <footer>
        <div class="footer-container">

        </div>
    </footer>
</body>

</html>