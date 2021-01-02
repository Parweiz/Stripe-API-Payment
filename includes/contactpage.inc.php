<?php

require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');

// Checks whether the user has reached the Contact page by pressing the submit button or not. In this case we check for error first
if (!isset($_POST['submit'])) {
    header("Location: ../contact.php");
    exit();
} else {
    // Filtering / Sanitize the POST Array to make sure that IF ppls put something harmful, then it will sanitize it as string
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    // Fetching all the datas that the user has passed on from the signup form
    $fullname = $_POST['name'];
    $mail = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];

    $receiver  = "parweizh6@gmail.com";
    $headers = "From: " . $mail;
    $body = "You have received an e-mail from $fullname <$mail> \n\n Message:" . $msg . ".\n\n E-mail: " . $mail;

    $mail = mail($receiver, $subject, $body, $headers);

    if ($mail) {
        echo "Email successfully sent to $receiver...";
    } else {
        echo "Email sending failed...";
    }

    // echo "<br>" . $fullname . "<br>" . "<br>" . $mail . "<br>" . "<br>" . $subject . "<br>" . "<br>" . $msg . "<br>" . "<br>";
    echo "<br>" . $mail;
    echo $headers;
    // header("Location: ../contact.php?mailsend=success");
}