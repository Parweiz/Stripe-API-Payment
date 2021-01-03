<?php
$page = 'index';
require_once("header.php")
?>

<main>

    <h1>
        Well hello there

        <?php
        if (isset($_SESSION['fullname'])) {
            echo $_SESSION['fullname'];
        }
        ?>

        !

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "couldnotgetobject") {
                echo '<p class="red">You need to re-submit your reset request!</p>';
            } else if ($_GET['error'] == "tokenverifyfailed") {
                echo '<p class="red">You need to re-submit your reset request!</p>';
            } else if ($_GET['error'] == "usernamedoesnotexist") {
                echo '<p class="red">There does not exist a username with that mail in db. Register first!</p>';
            }
        }
        ?>


    </h1>

</main>

<?php

require "footer.php"
?>