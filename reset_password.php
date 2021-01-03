<?php
require "header.php"
?>

<main>

    <div class="resetpassword">
        <img src="img/avatar.png" class="avatar">

        <h1>Reset your password</h1>
        <p>Don't worry. Just enter your email address below and we will send you instructions.</p> <br>

        <form action="includes/reset_request.inc.php" method="POST">
            <input type="text" name="email" placeholder="Enter your e-mail adresse">
            <input type="submit" name="reset_request_submit" value="Send">
        </form>

        <?php

        if (isset($_GET["mailsent"])) {
            if ($_GET["mailsent"] == "success") {
                echo '<p class="green">Check your email!</p>';
            } else if ($_GET['mailsent'] == "failed") {
                echo '<p class="mailnotsent">The request could not be sent. Please try again in a few minutes</p>';
            }
        } elseif (isset($_GET["error"])) {
            if ($_GET["error"] == "emaildoesntexist") {
                echo '<p class="emailnotexist">The email you provided does not exist in DB! Please provide the right email</p>';
            }
        }

        ?>

    </div>
</main>

<?php

require "footer.php"
?>