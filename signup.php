<?php
$page = 'register';
require_once('header.php')
?>

<main>
    <div class="registerbox">
        <img src="img/avatar.png" class="avatar">

        <h1>Sign Up</h1>


        <form action="includes/signup.inc.php" method="post">
            <label for="fullname"><b>FullName</b></label>
            <input type="text" name="fullname" placeholder="Enter your fullname">

            <label for="username"><b>Username</b></label>
            <input type="text" name="username" placeholder="Enter username">


            <label for="email"><b>Email</b></label>
            <input type="text" name="email" placeholder="Enter email">


            <label for="password"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter password">


            <label for="password_repeat"><b>Repeat Password</b></label>
            <input type="password" name="password_repeat" placeholder="Repeat password">

            <input type="submit" name="signup_submit" value="Sign Up">

        </form>

        <a href="signin.php">Have An Account Already?</a>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p class="red">Fill in all fields!</p>';
            } else if ($_GET['error'] == "invalidmailAndusername") {
                echo '<p class="red">Invalid username and e-mail!</p>';
            } else if ($_GET['error'] == "invalidmail") {
                echo '<p class="red">Invalid email!</p>';
            } else if ($_GET['error'] == "invalidusername") {
                echo '<p class="red"">Invalid username!</p=>';
            } else if ($_GET['error'] == "passwordcheckfailed") {
                echo '<p class="red">Your passwords do not match!</p>';
            } else if ($_GET['error'] == "usernametaken") {
                echo '<p class="red">The username is already taken!</p>';
            }
            
        } else if (isset($_GET['signup'])) {
            if ($_GET['signup'] == "success") {
                echo '<p class="green">Signup successful!</p>';
            }
        }

        ?>

    </div>
</main>


<?php

require "footer.php"
?>