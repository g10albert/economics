<?php
$page = "newwallet";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php') ?>
    <link rel="stylesheet" href="../css/new_wallet.css" />
</head>

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login/index.php");
}

$user_id = $_SESSION['user_id'];

include_once("../../api/connection.php");

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $balance = $_POST['balance'];
    $color = $_POST['color'];

    if (!empty($name) && !empty($type) && !empty($color) && !empty($balance)) {


        $sql = "INSERT INTO `wallets` (`type`, `name`, `balance`, `color`, `user_id`) VALUES ('$type', '$name', '$balance', '$color', '$user_id')";

        $result = mysqli_query($con, $sql);

        header('Location:../pages/my_wallets.php');
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
                    <div class="wallet__card">
                        <div class="wallet__top">
                            <select class="form__select wallet__p-gray" name="type" id="type" required>
                                <option value="">Type</option>
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                                <option value="Cash">Cash</option>
                            </select>
                            <input class="form__input form__name wallet__p" type="text" name="name" id="name" required placeholder="Name">
                        </div>
                        <p class="wallet__p wallet__initial">Initial balance</p>
                        <input class="form__input wallet__p-price" type="number" min="1" step=".01" name="balance" id="balance" autocomplete="off" required placeholder="$0">
                        <div class="select__color">
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
    include_once('../includes/footer.php');
    include_once('../includes/scripts.php')
    ?>
    <!-- Link to new wallet js File -->
    <script src="../js/new_wallet.js"></script>
</body>

</html>