<?php

session_start();

include_once("../../api/connection.php");

$con = mysqli_connect("localhost", "root", "", "economics");


if (isset($_POST['save'])) {
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $wallet = $_POST['wallet'];
    $income_or_expense = $_POST['income_or_expense'];

    if (!empty($amount) && !empty($category) && !empty($date) && !empty($wallet)) {
        $sql = "INSERT INTO `transactions` (`name`, `amount`, `income_or_outcome`, `date`, `category`, `description`) VALUES ('$name', '$amount', '$income_or_expense', '$date', '$category', '$description')";

        if ($income_or_expense == 0) {
            $sql2 = "UPDATE `wallets` SET `balance` = (balance - '$amount') WHERE `name` = '$wallet'";
        } else {
            $sql2 = "UPDATE `wallets` SET `balance` = (balance + '$amount') WHERE `name` = '$wallet'";
        }

        $result = mysqli_query($con, $sql);
        $result2 = mysqli_query($con, $sql2);

        header('Location:../pages/dashboard.php');
    } else {
        echo $amount;
        echo $category;
        echo $date;
        echo $wallet;
    }
}
