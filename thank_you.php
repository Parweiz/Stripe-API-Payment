<?php
require_once("header.php");
?>

<main>

    <?php

    if (isset($_GET["order"])) {
        if ($_GET["order"] == "success") {
            echo '<p class="mailsent"><br /><br /> Thank you for the purchase! In connection with that we have created an user
            to you - More infos about that in your email!.</p>';
        } else if ($_GET['order'] == "failed") {
            //TODO: Implement ContactPage
            echo '<p class="mailnotsent"><br /><br /> Sorry, your request did not go through. Please try again in a few minutes. 
                Otherwise Contact us with your problem.</p>';
        }
    }
    ?>
</main>

<?php

require_once("footer.php")
?>