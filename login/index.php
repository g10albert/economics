<?php
session_start();

require_once "./database.php";

if (isset($_SESSION['user_id'])) {

    $id = $_SESSION['user_id'];

    $sql = "SELECT id, email, password FROM users WHERE id = '$id'";

    $result = mysqli_query($con, $sql);

    $result_data = mysqli_fetch_assoc($result);

    $user = null;

    if ($result_data > 0) {
        $user = $result_data;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../includes/head.php") ?>
</head>

<body>
    <?php if (!empty($user)) : ?>
        <?php header("Location: ../pages/dashboard.php") ?>
    <?php else : ?>
        <h1>Economics</h1>
        <a href="./login.php">Log in</a>
        <p>or</p>
        <a href="./signup.php">Sign up</a>
    <?php endif; ?>
</body>

</html>