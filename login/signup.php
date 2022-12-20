<?php

$page = "signup";

$message = '';
include_once("../../api/connection.php");

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../pages/dashboard.php");
}

$regex_password = "/(?=[A-Za-z0-9@#$%^&+!=]+$)^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,}).*$/";

// if (preg_match_all($regex_password, $str)) {
    
// }

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $message = 'Enter a valid email address';
    } else if (!preg_match_all($regex_password, $password)) {
        $message = 'The password needs at least one number and one capital letter';
    } else if ($password != $confirm_password) {
        $message = 'The passwords do not match';
    } else {
        if (!empty($email) && !empty($password)) {

            $sql_check_unique = "SELECT id, email, password FROM users WHERE email = '$email'";

            $result_check_unique = mysqli_query($con, $sql_check_unique);

            $result_check_unique_data = mysqli_fetch_assoc($result_check_unique);

            if ($result_check_unique_data > 0) {
                if ($email == $result_check_unique_data['email']) {
                    $message = "This email already exists";
                }
            } else {
                $encrypted_password = password_hash($password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$encrypted_password')";

                $result = mysqli_query($con, $sql);

                header('Location: ../login/login.php');
            }
        } else {
            $message = "Looks like you're missing information";
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
        <h1 class="logsignup_title">Sign up</h1>
        <form class="logsignup__form" action="./signup.php" method="POST" autocomplete="off">
            <input class="logsignup__email logsignup__input" type="email" value="<?php if (isset($email)) echo $email ?>" name="email" placeholder="Enter your email">
            <input class="logsignup__password logsignup__input" type="password" value="<?php if (isset($password)) echo $password ?>" name="password" placeholder="Enter your password">
            <input class="logsignup__password logsignup__input" type="password" value="<?php if (isset($confirm_password)) echo $confirm_password ?>" name="confirm_password" placeholder="Confirm password">
            <?php if (!empty($message)) : ?>
                <p class="logsignup_message"> <?= $message ?></p>
            <?php endif; ?>
            <input class="logsignup__button" type="submit" value="Sign up" name="register">
        </form>
        <a class="logsignup__or" href="./login.php">Or log in </a>
    </div>

    <?php include_once("../includes/scripts.php") ?>
</body>

</html>