<?php
require "header.php"
?>

<main>
    <div class="registernewpwd">

        <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request!";
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
        ?>

        <p>Create a new password!</p> <br>

        <form action="includes/reset_password_inc.php" method="POST">

            <input type="hidden" name="selector" value="<?php echo $selector ?>">
            <input type="hidden" name="validator" value="<?php echo $validator ?>">
            <input type="password" name="password" placeholder="Enter a new password">
            <input type="password" name="password_repeat" placeholder="Repeat the new password">
            <input type="submit" name="reset_password_submit" value="Reset Password">
        </form>

        <?php
            }
        }

        ?>

    </div>
</main>

<?php

require "footer.php"
?>