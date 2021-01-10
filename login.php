<?php
$page = 'login';
require_once('header.php')
?>

<main>
    <div class="loginbox">
        <img src="img/avatar.png" class="avatar">
        <h1>Login</h1>

        <form action="includes/login.inc.php" method="post">
            <label for="email"><b>Email</b></label>
            <input type="text" name="email" placeholder="Enter your email">

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter your password">

            <input type="submit" name="login_submit" value="Login">
        </form>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p class="signinerror"> Fill in all fields! </p>';
            } else if ($_GET['error'] == "wrongpwd") {
                echo '<p class="signinerror"> Wrong password! </p>';
            } else if ($_GET['error'] == "nouser") {
                echo '<p class="nouser"> There is not a user with that username on the database! </p>';
            } else if ($_GET['error'] == "loginfirst") {
                echo '<p class="loginfirst"> You have to login first before you can see the list! </p>';
            }
        }
        ?>

    </div>
</main>

<?php

require "footer.php"
?>