<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/super-reset.css" />
<link rel="icon" href="../assets/img/logo.png">
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<title>
    <?php
    if ($page == "dashboard") {
        echo "Dashboard";
    } else if ($page == "mywallets") {
        echo "Wallets";
    } else if ($page == "categories") {
        echo "Categories";
    } else if ($page == "transactions") {
        echo "Transactions";
    } else if ($page == "editcategory") {
        echo "Edit Category";
    } else if ($page == "edittransaction") {
        echo "Edit Transaction";
    } else if ($page == "editwallet") {
        echo "Edit Wallet";
    } else if ($page == "landing") {
        echo "Economics";
    } else if ($page == "login") {
        echo "Login";
    } else if ($page == "signup") {
        echo "Sign Up";
    } else if ($page == "newcategory") {
        echo "New Category";
    } else if ($page == "newtransaction") {
        echo "New Transaction";
    } else if ($page == "newwallet") {
        echo "New Wallet";
    }
    ?>
</title>