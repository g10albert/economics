<?php
$page = "edittransaction";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once('../includes/head.php')
    ?>
    <link rel="stylesheet" href="../css/new_transaction.css" />
</head>

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/index.php");
}

$user_id = $_SESSION['user_id'];

include_once("../../api/connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_get_data = "SELECT * FROM transactions WHERE id = $id";
    $result_get_data = mysqli_query($con, $sql_get_data);
    if (mysqli_num_rows($result_get_data) == 1) {
        $row = mysqli_fetch_array($result_get_data);
        $amount_data = $row['amount'];
        $income_or_outcome_data = $row['income_or_outcome'];
        $date = $row['date'];
        $category_data = $row['category'];
        $description = $row['description'];
        $wallet_data = $row['wallet'];
        $amount_transaction = $row['amount'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $amount = $_POST['amount'];
    $newAmount = preg_replace('/[$,]/', '', $amount);
    $income_or_outcome = $_POST['income_or_expense'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $wallet = $_POST['wallet'];
    if (!empty($amount) && !empty($income_or_outcome) && !empty($date) && !empty($category) && !empty($wallet)) {

        $sql_update_transaction = "UPDATE transactions SET `amount` = '$newAmount', `income_or_outcome` = '$income_or_outcome', `date` = '$date', `category` = '$category', `description` = '$description' , `wallet` = '$wallet' WHERE id = '$id'";
        $result_update_transaction = mysqli_query($con, $sql_update_transaction);

        if ($wallet_data != $wallet && $income_or_outcome_data == 1 && $newAmount > $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance - '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance + '$newAmount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$newAmount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 1 && $newAmount < $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance - '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance + '$newAmount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$amount_data' - $newAmount)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 2 && $newAmount > $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance + '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance - '$newAmount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$newAmount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 2 && $newAmount < $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance + '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance - '$newAmount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$newAmount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 1) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance - '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance + '$newAmount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 2) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance + '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance - '$newAmount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
        }

        if ($income_or_outcome_data == 2 && $income_or_outcome == 1) {
            $sql_update_wallet_ioo = "UPDATE `wallets` SET `balance` = (balance + ('$amount_data' * 2)) WHERE `name` = '$wallet'";
            $result_update_wallet_ioo = mysqli_query($con, $sql_update_wallet_ioo);
        } else if ($income_or_outcome_data == 1 && $income_or_outcome == 2) {
            $sql_update_wallet_ioo = "UPDATE `wallets` SET `balance` = (balance - ('$amount_data' * 2)) WHERE `name` = '$wallet'";
            $result_update_wallet_ioo = mysqli_query($con, $sql_update_wallet_ioo);
        }

        if ($amount_data != $newAmount && $income_or_outcome == 1 && $newAmount > $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$newAmount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($amount_data != $newAmount && $income_or_outcome == 1 && $newAmount < $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$amount_data' - $newAmount)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($amount_data != $newAmount && $income_or_outcome == 2 && $newAmount > $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$newAmount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($amount_data != $newAmount && $income_or_outcome == 2 && $newAmount < $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$newAmount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        }

        header('Location:../pages/transactions.php');
    } else {
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['delete'])) {

    if ($income_or_outcome == 1) {
        $sql_return_money = "UPDATE `wallets` SET `balance` = (balance - '$amount_transaction') WHERE `name` = '$wallet_data'";
    } else {
        $sql_return_money = "UPDATE `wallets` SET `balance` = (balance + '$amount_transaction') WHERE `name` = '$wallet_data'";
    }

    $result_return_money = mysqli_query($con, $sql_return_money);


    $sql_delete_transaction = "DELETE FROM transactions WHERE id = $id";
    $result_delete_transaction = mysqli_query($con, $sql_delete_transaction);

    header('Location:../pages/transactions.php');
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
                            <select class="form__select" name="category" id="category" required>
                                <option value="<?php echo $category_data; ?>"><?php echo $category_data; ?></option>
                                <?php
                                foreach ($category as $option) {
                                ?>
                                    <option><?php echo $option[0]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </p>
                        <input class="form__input transaction__amount" value="<?php echo '$'.$amount_data; ?>" step=".01" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" name="amount" id="amount" required min="0">
                    </div>
                    <div class="transaction__description">
                        <input class="form__input" value="" placeholder="<?php echo 'No description'; ?>" type="text" name="description" id="description" autocomplete="off">
                    </div>
                    <div class="transaction__date">
                        <input placeholder="yyyy-mm-dd hh:mm" value="<?php echo $date; ?>" class="form__input" type="datetime-local" name="date" id="date" required>
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
                        <select class="form__select" name="wallet" id="wallet" required>
                            <option value="<?php echo $wallet_data; ?>"><?php echo $wallet_data; ?></option>
                            <?php
                            foreach ($wallet as $option) {
                            ?>
                                <option><?php echo $option[0]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <select class="form__select description" name="income_or_expense" id="income_or_expense" required>
                            <?php
                            if ($income_or_outcome_data == 1) {
                                $income_or_outcome_show = 'Income';
                            } else {
                                $income_or_outcome_show = 'Expense';
                            }
                            ?>
                            <option value="<?php echo $income_or_outcome_data; ?>"><?php echo $income_or_outcome_show; ?></option>
                            <option value="1">Income</option>
                            <option value="2">Expense</option>
                        </select>
                    </div>
                </div>
                <div class="form__elements">
                    <div class="form__save form__wrapper">
                        <button class="form__button" type="submit" name="update">Update</button>
                    </div>
                    <div class="form__delete form__wrapper">
                        <button class="form__button form__button-delete" type="submit" name="">Delete</button>
                        <button class="actually__delete" style="display: none" type="submit" name="delete">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php
    include_once('../includes/footer.php');
    include_once('../includes/scripts.php')
    ?>
</body>

<!-- LINK TO MY TRANSACTIONS JS FILE -->
<script src="../js/new_transaction.js" type="module"></script>

<script>
    $('.form__button-delete').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Do you want to delete this transaction?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: "module",
                actions: "btns-wrapper",
                confirmButton: "confirmButton",
                denyButton: "denyButton",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $('.actually__delete').click();
            } else if (result.isDenied) {
                Swal.fire({
                    title: "The transactions wasn't deleted",
                    customClass: {
                        popup: "module",
                        confirmButton: "resultBtn",
                    }
                });
            }
        });
    })
</script>

</html>