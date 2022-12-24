<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- LINK TO SUPER RESET CSS -->
<link rel="stylesheet" href="./economics/css/super-reset.css" />
<!-- LINK TO PAGE ICON -->
<link rel="icon" href="./economics/assets/img/logo.png">
<!-- LINK TO MAIN CSS -->
<link rel="stylesheet" href="./economics/css/main.css" />
<!-- LINK TO SWEET ALERT CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<!-- LINK TO ANIMATE CSS CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- LINK TO SCROLLREVEAL JS CDN -->
<script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

<!-- Display title depending on page the user is -->

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