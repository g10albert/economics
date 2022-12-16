<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once('../includes/head.php')
    ?>
    <link rel="stylesheet" href="../css/new_category.css" />
</head>

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login/index.php");
}

include_once("../../api/connection.php");

$con = mysqli_connect("localhost", "root", "", "economics");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    if (!empty($name)) {

        $sql = "UPDATE categories SET name = '$name' WHERE id = '$id'";
        $result = mysqli_query($con, $sql);

        header('Location:../pages/categories.php');
    } else {
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM categories WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Query failed");
    }
    header('Location:../pages/categories.php');
}
?>

<body>
    <?php include_once('../includes/header.php') ?>
    <main>

        <div class="form">
            <form id="form" action="" method="post" autocomplete="off">
                <div class="form__elements">
                        <div class="category__card">
                            <input class="form__input category__p" value="<?php echo $name; ?>" type="text" name="name" id="name" required placeholder="Name">
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
            title: "Do you want to delete this category?",
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
                Swal.fire("The category wasn't deleted", "", "");
            }
        });
    })
</script>

</html>