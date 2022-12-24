<?php
$page = "newcategory";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./economics/includes/head.php') ?>
    <link rel="stylesheet" href="./economics/css/new_category.css" />
</head>

<?php

session_start();

// Send the user to landing page if there's no session

if (!isset($_SESSION['user_id'])) {
    header("Location: ./index.php");
}

$user_id = $_SESSION['user_id'];

include_once("./api/connection.php");

// Save category

if (isset($_POST['save'])) {
    $name = $_POST['name'];

    if (!empty($name)) {

        $sql = "INSERT INTO `categories` (`name`, `user_id`) VALUES ('$name', '$user_id')";

        $result = mysqli_query($con, $sql);

        header('Location:./categories.php');
    } else {
    }
}
?>

<body>

    <?php include_once('./economics/includes/header.php') ?>

    <main>

        <form action="" method="post" autocomplete="off">
            <div class="form__elements">
                <div class="category__card">
                    <!-- Input category -->
                    <input class="form__input category__p" autofocus type="text" name="name" id="name" required placeholder="Name">
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
</body>

</html>