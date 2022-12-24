<?php

$page = "login";

$message = '';

session_start();

// Send user to dashboard if there a session

if (isset($_SESSION['user_id'])) {
    header("Location: ./dashboard.php");
}

include_once("./api/connection.php");

// Login

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {

        // Retrieve data from DB to validate that the user exists

        $sql = "SELECT id, email, password FROM users WHERE email = '$email'";

        $result = mysqli_query($con, $sql);

        $result_data = mysqli_fetch_assoc($result);

        // verify if the credentials are correct

        if ($result_data > 0 && password_verify($password, $result_data['password'])) {
            $_SESSION['user_id'] = $result_data['id'];
            header('Location: ./dashboard.php');
        } else {
            $message = 'Sorry these credentials do not match or do not exist';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("./economics/includes/head.php") ?>
    <link rel="stylesheet" href="./economics/css/log-sign_up.css">
</head>

<body>
    <div class="nav__btn-open" style="display:none;"></div>
    <div class="nav__btn-close" style="display:none;"></div>
    <a href="./" class="nav__logo">Economics</a>
    <div class="dark_light" id="toggle-theme">
        <a href="#" class="" id="toggle-theme">
            <iconify-icon class="dark_light-icon" icon="carbon:sun"></iconify-icon>Dark / Light
        </a>
    </div>
    <div class="logsignup">
        <h1 class="logsignup_title">Log in</h1>
        <form class="logsignup__form" action="./login.php" method="POST" autocomplete="off">
            <!-- Email input -->
            <input class="logsignup__email logsignup__input" autofocus type="text" value="<?php if (isset($email)) echo $email ?>" name="email" placeholder="Enter your email">
            <!-- Password input -->
            <input class="logsignup__password logsignup__input" type="password" value="<?php if (isset($password)) echo $password ?>" name="password" placeholder="Enter your password">
            <?php if (!empty($message)) : ?>
                <!-- paragraph to show message in case of error -->
                <p class="logsignup_message"> <?= $message ?></p>
            <?php endif; ?>
            <input class="logsignup__button" type="submit" value="Sign in" name="login">
        </form>
        <a class="logsignup__or" href="./signup.php">Or create a new account</a>
    </div>

    <?php include_once("./economics/includes/scripts.php") ?>

</body>

</html>