<?php
$page = 'register';
require_once('header.php');
?>

<main class="main">
    <div class="registerbox">
        <img src="img/avatar.png" class="avatar">
    </div>

    <h1>Sign Up</h1>

    <form action="includes/signup.inc.php" method="post">
        <label for="uid"><b>Username</b></label>
        <input type="text" name="uid" placeholder="Enter username">


        <label for="mail"><b>Email</b></label>
        <input type="text" name="mail" placeholder="Enter email">


        <label for="pwd"><b>Password</b></label>
        <input type="password" name="pwd" placeholder="Enter password">


        <label for="pwd_repeat"><b>Repeat Password</b></label>
        <input type="password" name="pwd_repeat" placeholder="Repeat password">

        <input type="submit" name="signup_submit" value="Sign Up">

    </form>

    <a href="signin.php">Have An Account Already?</a>

</main>

<?php

require "footer.php"
?>