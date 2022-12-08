<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php') ?>
    <link rel="stylesheet" href="../css/new_wallet.css" />
</head>

<?php

session_start();

include_once("../../api/connection.php");

$con = mysqli_connect("localhost", "root", "", "economics");

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $balance = $_POST['balance'];
    $color = $_POST['color'];

    if (!empty($name) && !empty($type) && !empty($color) && !empty($balance)) {

        
        $sql = "INSERT INTO `wallets` (`type`, `name`, `balance`, `color`) VALUES ('$type', '$name', '$balance', '$color')";
        
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
                    <div class="form__name form__wrapper">
                        <label class="form__label" for="name">Name</label>
                        <input class="form__input" type="text" name="name" id="name" required>
                    </div>
                    <div class="form__type form__wrapper">
                        <label class="form__label" for="type">Type</label>
                        <select class="form__select" name="type" id="type" required>
                            <option value="">Select type</option>
                            <option value="Credit">Credit</option>
                            <option value="Debit">Debit</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                    <div class="form__balance form__wrapper">
                        <label class="form__label" for="balance">Initial balance</label>
                        <input class="form__input" type="number" name="balance" id="balance" autocomplete="off" required>
                    </div>
                    <div class="form__color form__wrapper">
                        <label class="form__label" for="color">Color</label>
                        <input class="form__input form__color" type="color" name="color" id="color">
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
    <!-- <script src="../js/new__wallet.js" type="module"></script> -->
</body>

</html>