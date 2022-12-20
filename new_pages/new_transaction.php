<?php
$page = "newtransaction";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php') ?>
    <link rel="stylesheet" href="../css/new_transaction.css" />
</head>

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/index.php");
}

$user_id = $_SESSION['user_id'];

include_once("../../api/connection.php");

if (isset($_POST['save'])) {
    $amount = $_POST['amount'];
    $newAmount = preg_replace('/[$,]/', '', $amount);
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $wallet = $_POST['wallet'];
    $income_or_expense = $_POST['income_or_expense'];

    if (!empty($amount) && !empty($category) && !empty($date) && !empty($wallet)) {
        $sql = "INSERT INTO `transactions` (`amount`, `income_or_outcome`, `date`, `category`, `description`, `wallet`, `user_id`) VALUES ('$newAmount', '$income_or_expense', '$date', '$category', '$description', '$wallet', '$user_id')";

        if ($income_or_expense == 2) {
            $sql2 = "UPDATE `wallets` SET `balance` = (balance - '$newAmount') WHERE `name` = '$wallet'";
        } else {
            $sql2 = "UPDATE `wallets` SET `balance` = (balance + '$newAmount') WHERE `name` = '$wallet'";
        }

        $result = mysqli_query($con, $sql);
        $result2 = mysqli_query($con, $sql2);

        header('Location:../pages/transactions.php');
    } else {
    }
}
?>

<body>
    <?php include_once('../includes/header.php') ?>

    <main>
        <div class="form">
            <form action="" method="post" autocomplete="off">
                <div class="transaction__item">
                    <div class="transaction__top">
                        <p class="transaction__category">
                            <?php
                            if ($con) {
                                $sql = "SELECT `name` FROM `categories` WHERE user_id = $user_id";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    $category = mysqli_fetch_all($result);
                                }
                            } else {
                                echo "Database connection failed";
                            }
                            ?>
                            <select class="form__select " name="category" id="category" required>
                                <option value="">Select category</option>
                                <?php
                                foreach ($category as $option) {
                                ?>
                                    <option><?php echo $option[0]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </p>
                        <input class="form__input transaction__amount" placeholder="$0.00" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" step=".01" name="amount" id="amount" required min="0">
                    </div>
                    <div class="transaction__description">
                        <input class="form__input " placeholder="No description" type="text" name="description" id="description" autocomplete="off">
                    </div>
                    <div class="transaction__date">
                        <input placeholder="yyyy-mm-dd hh:mm" class="form__input " type="datetime-local" name="date" id="date" required>
                    </div>
                    <div class="transaction__wallet">
                        <?php
                        if ($con) {
                            $sql = "SELECT `name` FROM `wallets` WHERE user_id = $user_id";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                $wallet = mysqli_fetch_all($result);
                            }
                        } else {
                            echo "Database connection failed";
                        }
                        ?>
                        <select class="form__select " name="wallet" id="wallet" required>
                            <option value="">Select wallet</option>
                            <?php
                            foreach ($wallet as $option) {
                            ?>
                                <option><?php echo $option[0]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <select class="form__select description" name="income_or_expense" id="income_or_expense" required>
                            <option value="" class="">Income or Expense</option>
                            <option value="1">Income</option>
                            <option value="2">Expense</option>
                        </select>
                    </div>
                </div>
                <div class="form__elements">
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