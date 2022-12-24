<?php
$page = "newwallet";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./economics/includes/head.php') ?>
    <link rel="stylesheet" href="./economics/css/new_wallet.css" />
</head>

<?php

session_start();

// Send the user to landing page if there's no session

if (!isset($_SESSION['user_id'])) {
    header("Location: ./index.php");
}

$user_id = $_SESSION['user_id'];

include_once("./api/connection.php");

// Save wallet

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $balance = $_POST['balance'];
    $newBalance = preg_replace('/[$,]/', '', $balance);
    $color = $_POST['color'];

    if (!empty($name) && !empty($type) && !empty($color) && !empty($balance)) {


        $sql = "INSERT INTO `wallets` (`type`, `name`, `balance`, `color`, `user_id`) VALUES ('$type', '$name', '$newBalance', '$color', '$user_id')";

        $result = mysqli_query($con, $sql);

        header('Location:./wallets.php');
    } else {
    }
}
?>

<body>
    <?php include_once('./economics/includes/header.php') ?>
    <main>

        <div class="form">
            <form action="" method="post" autocomplete="off">
                <div class="form__elements">
                    <div class="wallet__card">
                        <div class="wallet__top">
                            <select class="form__select wallet__p-gray" name="type" id="type" required>
                                <!-- Select type -->
                                <option value="">Type</option>
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                                <option value="Cash">Cash</option>
                            </select>
                            <!-- input name -->
                            <input class="form__input form__name wallet__p" autofocus type="text" name="name" id="name" required placeholder="Name">
                        </div>
                        <p class="wallet__p wallet__initial">Initial balance</p>
                        <!-- input initial balance -->
                        <input class="form__input wallet__p-price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" min="1" step=".01" name="balance" id="balance" autocomplete="off" required placeholder="$0">
                        <div class="select__color">
                            <!-- input color -->
                            <input class="form__input form__color" type="color" name="color" id="color">
                        </div>
                    </div>
                    <div class="form__save form__wrapper">
                        <button class="form__button" type="submit" name="save">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </main>

    <?php
    include_once('./economics/includes/footer.php');
    include_once('./economics/includes/scripts.php')
    ?>
    <!-- Link to new wallet js File -->
    <script src="./economics/js/new_wallet.js"></script>
</body>

</html>