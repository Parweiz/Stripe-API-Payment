<?php
$page = 'register';
require_once('header.php')
?>

<main>
    <div class="registerbox">
        <img src="img/avatar.png" class="avatar">

        <h1>Sign Up</h1>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p>Fill in all fields!</p>';
            } else if ($_GET['error'] == "invalidmailAnduid") {
                echo '<p>Invalid username and e-mail!</p>';
            } else if ($_GET['error'] == "invalidmail") {
                echo '<p>Invalid email!</p>';
            } else if ($_GET['error'] == "invaliduid") {
                echo '<p="signuperror">Invalid username!</p=>';
            } else if ($_GET['error'] == "passwordcheckfailed") {
                echo '<p>Your passwords do not match!</p>';
            } else if ($_GET['error'] == "usernametaken") {
                echo '<p>The username is already taken!</p>';
            }
        } else if (isset($_GET['signup'])) {
            if ($_GET['signup'] == "success") {
                echo '<p>Signup successful!</p>';
            }
        }

        ?>
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

    </div>
</main>


<?php

require "footer.php"
?>