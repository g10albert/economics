<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    use LDAP\Result;

    include_once('../includes/head.php') ?>
    <link rel="stylesheet" href="../css/new_wallet.css" />
</head>

<?php

session_start();

include_once("../../api/connection.php");

$con = mysqli_connect("localhost", "root", "", "economics");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM wallets WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $type = $row['type'];
        $balance = $row['balance'];
        $color = $row['color'];
    }
}
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $balance = $_POST['balance'];
    $color = $_POST['color'];
    if (!empty($name) && !empty($type) && !empty($color) && !empty($balance)) {

        $sql = "UPDATE wallets SET type = '$type', name = '$name', balance = '$balance', color = '$color' WHERE id = '$id'";
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
                        <input class="form__input" type="text" value="<?php echo $name; ?>" name="name" id="name" required>
                    </div>
                    <div class="form__type form__wrapper">
                        <label class="form__label" for="type">Type</label>
                        <select class="form__select" name="type" id="type" required>
                            <option value="<?php echo $type; ?>"> <?php echo $type; ?> </option>
                            <option value="Credit">Credit</option>
                            <option value="Debit">Debit</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                    <div class="form__balance form__wrapper">
                        <label class="form__label" for="balance">Balance</label>
                        <input class="form__input" type="number" value="<?php echo $balance; ?>" name="balance" id="balance" autocomplete="off" required>
                    </div>
                    <div class="form__color form__wrapper">
                        <label class="form__label" for="color">Color</label>
                        <input class="form__input form__color" value="<?php echo $color; ?>" type="color" name="color" id="color">
                    </div>
                    <div class="form__save form__wrapper">
                        <button class="form__button" type="submit" name="update">Update</button>
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