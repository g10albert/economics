<?php

$page = "login";

$message = '';

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../pages/dashboard.php");
}

include_once("../../api/connection.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {

        // $encrypted_password = password_hash($password,PASSWORD_BCRYPT);

        $sql = "SELECT id, email, password FROM users WHERE email = '$email'";

        $result = mysqli_query($con, $sql);

        $result_data = mysqli_fetch_assoc($result);

        if ($result_data > 0 && password_verify($password, $result_data['password'])) {
            $_SESSION['user_id'] = $result_data['id'];
            header('Location: ../pages/dashboard.php');
        } else {
            $message = 'Sorry these credentials do not match or do not exist';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../includes/head.php") ?>
    <link rel="stylesheet" href="../css/log-sign_up.css">
</head>

<body>
    <div class="nav__btn-open" style="display:none;"></div>
    <div class="nav__btn-close" style="display:none;"></div>
    <a href="./index.php" class="nav__logo">Economics</a>
    <div class="dark_light" id="toggle-theme">
        <a href="#" class="" id="toggle-theme">
            <iconify-icon class="dark_light-icon" icon="carbon:sun"></iconify-icon>Dark / Light
        </a>
    </div>
    <div class="logsignup">
        <h1 class="logsignup_title">Log in</h1>
        <form class="logsignup__form" action="./login.php" method="POST" autocomplete="off">
            <input class="logsignup__email logsignup__input" type="text" value="<?php if (isset($email)) echo $email ?>" name="email" placeholder="Enter your email">
            <input class="logsignup__password logsignup__input" type="password" value="<?php if (isset($password)) echo $password ?>" name="password" placeholder="Enter your password">
            <?php if (!empty($message)) : ?>
                <p class="logsignup_message"> <?= $message ?></p>
            <?php endif; ?>
            <input class="logsignup__button" type="submit" value="Sign in" name="login">
        </form>
        <a class="logsignup__or" href="./signup.php">Or create a new account</a>
    </div>

    <?php include_once("../includes/scripts.php") ?>

</body>

</html>