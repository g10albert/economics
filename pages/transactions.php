<?php
$page = 'transanctions';

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php') ?>
    <link rel="stylesheet" href="../css/transactions.css" />
</head>


<body>

    <?php include_once('../includes/header.php') ?>

    <main>
        <div class="transaction__header">
            <h2 class="transaction__title">My Transactions</h2>
            <a href="../new_pages/new_transaction.php" class="transaction__new">New transaction</a>
        </div>
        <div class="transaction" id="transactions">

            <!-- element that is going to have the category cards -->

        </div>

        <div class="expenses__recents-wrapper">
            <div class="new__transaction-wrapper new__transaction-desktop">
                <a href="../new_pages/new_transaction.php" class="new__transaction">
                    New transaction<iconify-icon icon="grommet-icons:transaction" class="new__transaction"></iconify-icon>
                </a>
            </div>
            <div class="expenses">
                <div class="expenses__top">
                    <div class="">
                        <h3 class="expenses__title">My expenses</h3>
                    </div>
                    <div class="expenses__periods">
                        <p class="expenses__p timeframe expenses__active" value="1" id="expense_day">D</p>
                        <p class="expenses__p timeframe" value="2" id="expense_week">W</p>
                        <p class="expenses__p timeframe" value="3" id="expense_month">M</p>
                    </div>
                </div>
                <div class="graphic__wrapper">
                    <div class="graphic__text">
                        <p class="graphic__p">Total</p>
                        <p class="graphic__p" id="total">

                            <!-- element that is going to have the total amount of expenses depending on period of time -->

                        </p>
                    </div>
                    <canvas id="doughnutChart" class="expenses__graphic"></canvas>
                </div>
            </div>
            <div class="recents">
                <h2 class="recents__title">Recents</h2>
                <div class="recents__divider" id="recents">

                    <!-- element that is going to have the recent transactions -->

                </div>
            </div>
        </div>
    </main>

    <?php
    include_once('../includes/footer.php');
    include_once('../includes/scripts.php')
    ?>

    <!-- LINK TO MY TRANSACTIONS FILE -->
    <script src="../js/transactions.js" type="module"></script>
</body>

</html>