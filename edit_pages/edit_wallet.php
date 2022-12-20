<?php
$page = "editwallet";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once('../includes/head.php')
    ?>
    <link rel="stylesheet" href="../css/new_wallet.css" />
</head>

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login/index.php");
}

include_once("../../api/connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM wallets WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $current_name = $row['name'];
        $type = $row['type'];
        $balance = $row['balance'];
        $color = $row['color'];
    }
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $balance = $_POST['balance'];
    $color = $_POST['color'];
    if (!empty($name) && !empty($type) && !empty($color) && !empty($balance)) {

        $sql = "UPDATE wallets SET type = '$type', name = '$name', balance = '$balance', color = '$color' WHERE id = '$id'";
        $result = mysqli_query($con, $sql);

        $sql_stuff = "UPDATE transactions SET wallet = '$name' WHERE user_id = '$user_id' and wallet = '$current_name'";
        $result_2 = mysqli_query($con, $sql_stuff);

        header('Location:../pages/my_wallets.php');
    } else {
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM wallets WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Query failed");
    }
    header('Location:../pages/my_wallets.php');
}
?>

<body>
    <?php include_once('../includes/header.php') ?>
    <main>

        <div class="form">
            <form id="form" action="" method="post" autocomplete="off">
                <div class="form__elements">
                    <div class="wallet__card">
                        <div class="wallet__top">
                            <select class="form__select wallet__p-gray" name="type" id="type" required>
                                <option value="<?php echo $type; ?>"> <?php echo $type; ?> </option>
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                                <option value="Cash">Cash</option>
                            </select>
                            <input class="form__input form__name wallet__p" type="text" value="<?php echo $current_name; ?>" name="name" id="name" required placeholder="Name">
                        </div>
                        <p class="wallet__p wallet__initial">Initial balance</p>
                        <input class="form__input wallet__p-price" value="<?php echo $balance; ?>" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" step=".01" name="balance" id="balance" autocomplete="off" required placeholder="$0">
                        <div class="select__color">
                            <input class="form__input form__color" value="<?php echo $color; ?>" type="color" name="color" id="color">
                        </div>
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

    <!-- LINK TO MY NEW WALLET JS FILE -->
    <script src="../js/new_wallet.js" type="module"></script>
</body>

<script>
    $('.form__button-delete').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Do you want to delete this wallet?",
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
                    title: "The wallet wasn't deleted",
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