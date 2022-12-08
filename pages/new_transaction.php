<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php') ?>
    <link rel="stylesheet" href="../css/new_transaction.css" />
</head>

<?php

session_start();

include_once("../../api/connection.php");

$con = mysqli_connect("localhost", "root", "", "economics");


if (isset($_POST['save'])) {
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $wallet = $_POST['wallet'];
    $income_or_expense = $_POST['income_or_expense'];

    if (!empty($amount) && !empty($category) && !empty($date) && !empty($wallet)) {
        $sql = "INSERT INTO `transactions` (`name`, `amount`, `income_or_outcome`, `date`, `category`, `description`) VALUES ('$name', '$amount', '$income_or_expense', '$date', '$category', '$description')";

        if ($income_or_expense == 0) {
            $sql2 = "UPDATE `wallets` SET `balance` = (balance - '$amount') WHERE `name` = '$wallet'";
        } else {
            $sql2 = "UPDATE `wallets` SET `balance` = (balance + '$amount') WHERE `name` = '$wallet'";
        }

        $result = mysqli_query($con, $sql);
        $result2 = mysqli_query($con, $sql2);

        header('Location:../pages/dashboard.php');
    } else {
    }
}
?>

<body>
    <?php include_once('../includes/header.php') ?>

    <main>

        <div class="form">
            <form action="" method="post" autocomplete="off">
                <div class="form__elements">
                    <div class="form__amount form__wrapper">
                        <label class="form__label" for="amount">Amount</label>
                        <input class="form__input" type="number" name="amount" id="amount" required min="0">
                    </div>
                    <div class="form__category form__wrapper">
                        <label class="form__label" for="category">Category</label>
                        <?php
                        if ($con) {
                            $sql = "SELECT `name` FROM `categories`";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                $category = mysqli_fetch_all($result);
                            }
                        } else {
                            echo "Database connection failed";
                        }
                        ?>
                        <select class="form__select" name="category" id="category" required>
                            <option value="">Select category</option>
                            <?php
                            foreach ($category as $option) {
                            ?>
                                <option><?php echo $option[0]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form__description form__wrapper">
                        <label class="form__label" for="description">Description</label>
                        <input class="form__input" type="text" name="description" id="description" autocomplete="off">
                    </div>
                    <div class="form__date form__wrapper">
                        <label class="form__label" for="date">Date</label>
                        <input placeholder="" class="form__input" type="datetime-local" name="date" id="date" required>
                    </div>
                    <div class="form__wallet form__wrapper">
                        <label class="form__label" for="wallet">Wallet</label>
                        <?php
                        if ($con) {
                            $sql = "SELECT `name` FROM `wallets`";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                $wallet = mysqli_fetch_all($result);
                            }
                        } else {
                            echo "Database connection failed";
                        }
                        ?>
                        <select class="form__select" name="wallet" id="wallet" required>
                            <option value="">Select wallet</option>
                            <?php
                            foreach ($wallet as $option) {
                            ?>
                                <option><?php echo $option[0]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form__incomeorexpense form__wrapper">
                        <label class="form__label" for="income_or_expense">Income or Expense</label>
                        <select class="form__select" name="income_or_expense" id="income_or_expense" required>
                            <option value="">Select one option</option>
                            <option value="1">Income</option>
                            <option value="0">Expense</option>
                        </select>
                    </div>
                    <div class="form__save form__wrapper">
                        <button class="form__button" type="submit" name="save">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </main>



    <?php
    include_once('../includes/footer.php');
    include_once('../includes/scripts.php')
    ?>

    <!-- LINK TO MY TRANSACTIONS JS FILE -->
    <script src="../js/new_transaction.js" type="module"></script>
</body>

</html>