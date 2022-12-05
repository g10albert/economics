<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php') ?>
    <link rel="stylesheet" href="../css/new_transaction.css" />
</head>


<body>
    <?php include_once('../includes/header.php') ?>

    <main>
        <?php
        session_start();
        include_once('../../api/connection.php');
        ?>

        <div class="form">
            <form action="../php/new_transaction_sql.php" method="post" autocapitalize="off">
                <div class="form__elements">
                    <div class="form__amount form__wrapper">
                        <label class="form__label" for="amount">Amount</label>
                        <input class="form__input" type="number" name="amount" id="amount" required min="0">
                    </div>
                    <div class="form__category form__wrapper">
                        <label class="form__label" for="category">Category</label>
                        <?php
                        if ($con) {
                            $sql = "SELECT `name` FROM `categories`";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                $category = mysqli_fetch_all($result);
                            }
                        } else {
                            echo "Database connection failed";
                        }
                        ?>
                        <select class="form__select" name="category" id="category" required>
                            <option value="">Select category</option>
                            <?php
                            foreach ($category as $option) {
                            ?>
                                <option><?php echo $option[0]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form__description form__wrapper">
                        <label class="form__label" for="description">Description</label>
                        <input class="form__input" type="text" name="description" id="description" autocomplete="off">
                    </div>
                    <div class="form__date form__wrapper">
                        <label class="form__label" for="date">Date</label>
                        <input placeholder="" class="form__input" type="datetime-local" name="date" id="date" required>
                    </div>
                    <div class="form__wallet form__wrapper">
                        <label class="form__label" for="wallet">Wallet</label>
                        <?php
                        if ($con) {
                            $sql = "SELECT `name` FROM `wallets`";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                $wallet = mysqli_fetch_all($result);
                            }
                        } else {
                            echo "Database connection failed";
                        }
                        ?>
                        <select class="form__select" name="wallet" id="wallet" required>
                            <option value="">Select wallet</option>
                            <?php
                            foreach ($wallet as $option) {
                            ?>
                                <option><?php echo $option[0]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form__incomeorexpense form__wrapper">
                        <label class="form__label" for="income_or_expense">Income or Expense</label>
                        <select class="form__select" name="income_or_expense" id="income_or_expense" required>
                            <option value="">Select one option</option>
                            <option value="1">Income</option>
                            <option value="0">Expense</option>
                        </select>
                    </div>
                    <div class="form__save form__wrapper">
                        <button class="form__button" type="submit" name="save">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </main>



    <?php
    include_once('../includes/footer.php');
    include_once('../includes/scripts.php')
    ?>

    <!-- LINK TO MY TRANSACTIONS JS FILE -->
    <script src="../js/new_transaction.js" type="module"></script>
</body>

</html>