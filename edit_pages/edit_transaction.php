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
    $income_or_outcome = $_POST['income_or_expense'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $wallet = $_POST['wallet'];
    if (!empty($amount) && !empty($income_or_outcome) && !empty($date) && !empty($category) && !empty($wallet)) {

        $sql_update_transaction = "UPDATE transactions SET `amount` = '$amount', `income_or_outcome` = '$income_or_outcome', `date` = '$date', `category` = '$category', `description` = '$description' , `wallet` = '$wallet' WHERE id = '$id'";
        $result_update_transaction = mysqli_query($con, $sql_update_transaction);

        if ($wallet_data != $wallet && $income_or_outcome_data == 1 && $amount > $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance - '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance + '$amount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$amount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 1 && $amount < $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance - '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance + '$amount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$amount_data' - $amount)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 2 && $amount > $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance + '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance - '$amount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$amount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 2 && $amount < $amount_data) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance + '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance - '$amount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$amount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 1) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance - '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance + '$amount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
        } else if ($wallet_data != $wallet && $income_or_outcome_data == 2) {
            $sql_update_wallet_data = "UPDATE `wallets` SET `balance` = (balance + '$amount_data') WHERE `name` = '$wallet_data'";
            $result_update_wallet_data = mysqli_query($con, $sql_update_wallet_data);
            $sql_update_wallet = "UPDATE `wallets` SET `balance` = (balance - '$amount') WHERE `name` = '$wallet'";
            $result_update_wallet = mysqli_query($con, $sql_update_wallet);
        }

        if ($income_or_outcome_data == 2 && $income_or_outcome == 1) {
            $sql_update_wallet_ioo = "UPDATE `wallets` SET `balance` = (balance + ('$amount_data' * 2)) WHERE `name` = '$wallet'";
            $result_update_wallet_ioo = mysqli_query($con, $sql_update_wallet_ioo);
        } else if ($income_or_outcome_data == 1 && $income_or_outcome == 2) {
            $sql_update_wallet_ioo = "UPDATE `wallets` SET `balance` = (balance - ('$amount_data' * 2)) WHERE `name` = '$wallet'";
            $result_update_wallet_ioo = mysqli_query($con, $sql_update_wallet_ioo);
        }

        if ($amount_data != $amount && $income_or_outcome == 1 && $amount > $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance + ('$amount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($amount_data != $amount && $income_or_outcome == 1 && $amount < $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$amount_data' - $amount)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($amount_data != $amount && $income_or_outcome == 2 && $amount > $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$amount' - $amount_data)) WHERE `name` = '$wallet'";
            $result_update_wallet_amount = mysqli_query($con, $sql_update_wallet_amount);
        } else if ($amount_data != $amount && $income_or_outcome == 2 && $amount < $amount_data) {
            $sql_update_wallet_amount = "UPDATE `wallets` SET `balance` = (balance - ('$amount' - $amount_data)) WHERE `name` = '$wallet'";
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
            <form id="form" action="" method="post" autocomplete="off">
                <div class="form__elements">
                    <div class="form__amount form__wrapper">
                        <label class="form__label" for="amount">Amount<?php echo $income_or_outcome_data ?></label>
                        <input class="form__input" value="<?php echo $amount_data; ?>" step=".01" type="number" name="amount" id="amount" required min="0">
                    </div>
                    <div class="form__category form__wrapper">
                        <label class="form__label" for="category">Category</label>
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
                    </div>
                    <div class="form__description form__wrapper">
                        <label class="form__label" for="description">Description</label>
                        <input class="form__input" value="<?php echo $description; ?>" type="text" name="description" id="description" autocomplete="off">
                    </div>
                    <div class="form__date form__wrapper">
                        <label class="form__label" for="date">Date</label>
                        <input placeholder="" value="<?php echo $date; ?>" class="form__input" type="datetime-local" name="date" id="date" required>
                    </div>
                    <div class="form__wallet form__wrapper">
                        <label class="form__label" for="wallet">Wallet</label>
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
                    </div>
                    <div class="form__incomeorexpense form__wrapper">
                        <label class="form__label" for="income_or_expense">Income or Expense</label>
                        <select class="form__select" name="income_or_expense" id="income_or_expense" required>
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

<script>
    $('.form__button-delete').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Do you want to delete this transaction?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                actions: "my-actions",
                confirmButton: "order-2",
                denyButton: "order-3",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $('.actually__delete').click();
            } else if (result.isDenied) {
                Swal.fire("The transaction wasn't deleted", "", "");
            }
        });
    })
</script>

</html>