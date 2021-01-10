<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300">

    <link rel="icon" type="image/png" href="img/fcb.png" />

    <link rel="stylesheet" type="text/css" href="dist/css/style.css" />


</head>

<body>

    <header>
        <nav>
            <ul class="topnav">

                <li><a class="<?php if ($page == 'index') {
                                    echo 'active';
                                } ?>" href="index.php">Home</a></li>
                <li><a class="<?php if ($page == 'product') {
                                    echo 'active';
                                } ?>" href="product.php">Products</a></li>
                <li><a class="<?php if ($page == 'stripe') {
                                    echo 'active';
                                } ?>" href="stripe.php">Payment</a></li>
                <li><a class="<?php if ($page == 'customers') {
                                    echo 'active';
                                } ?>" href="customers.php">A list of Customers</a></li>
                <li><a class="<?php if ($page == 'transactions') {
                                    echo 'active';
                                } ?>" href="transactions.php">A list of Transactions</a></li>


                <?php

                if (isset($_SESSION['loggedin'])) {
                    echo '<form action="includes/logout.inc.php" method="post">
                    <input type="submit" style="float:right; width:200px; height: 50px" name="logout_submit" value="Logout">
                </form>';
                } else {
                ?>

                <li style="float:right"><a class="<?php if ($page == 'login') {
                                                            echo 'active';
                                                        } ?>" href="login.php">Login</a> </li>

                <?php
                }

                ?>




            </ul>

        </nav>
    </header>


    <script src="https://js.stripe.com/v3/"></script>

</body>