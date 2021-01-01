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
    </h1>

</main>

<?php

require "footer.php"
?>