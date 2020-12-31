<?php
$page = 'login';
require_once('header.php');
?>


<main>
    <div class="loginbox">
        <img src="img/avatar.png" class="avatar">
        <h1>Login</h1>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p">Fill in all fields!</p>';
            } else if ($_GET['error'] == "wrongpwd") {
                echo '<p>Wrong password</p>';
            } else if ($_GET['error'] == "nouser") {
                echo '<p>There is not a user with that username on the database!</p>';
            }
        } else if (isset($_GET['signup'])) {
            if ($_GET['signup'] == "success") {
                echo '<p>Signup successful!</p>';
            }
        }

        ?>

        <form action="includes/signin.inc.php" method="post">
            <label for="uid"><b>Username</b></label>
            <input type="text" name="uid" placeholder="Enter Username">

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter Password">

            <input type="submit" name="login_submit" value="Login">
        </form>
        <?php
        if (isset($_GET['newpwd'])) {
            if ($_GET['newpwd'] == "passwordupdated") {
                echo "<p>Your password has been reset! </p>";
            }
        }
        ?>
        <a href="reset_password.php">Forgot your password?</a><br>
        <a href="signup.php">Don't have an account?</a>

    </div>
</main>

<?php

require "footer.php"
?>