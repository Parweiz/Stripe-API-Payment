<?php

require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');
require_once('../models/User.php');

// Checks whether the user has reached the signup page by pressing the signup button or not. In this case we check for error first
if (!isset($_POST['reset_request_submit'])) {
    header("Location: ../signin.php");
    exit();
} else {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];

    /* 
    We will be using 2 different tokens. 1st token will be used to authenticate the user and the 2nd token will be
    used to looking inside the db to "pinpoint" the token that we need to check the user with, when they get back
    to website. 
    
    One of the benefits of using 2 different tokens is that we avoid something called "timing attacks"
    TLDR: Timing attack is a way for a hacker to brute force her/his way to the website
    */

    // Token 1
    $selector = bin2hex(random_bytes(8));

    // Token 2
    $token = random_bytes(32);

    // The link that we're going to send to user by email 
    $link = "http://localhost/php_lessons/php_stripe_payment/";
    $url = $link . "create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    // date("U") "spits" the todays date and time in epoch timestamp and 3600 is illustration of an hour in seconds
    $expireTime = date("U") + 3600;

    $userData = [
        'email' => $email,
        'selector' => $selector,
        'token' => $token,
        'url' => $url,
        'expireTime' => $expireTime
    ];

    $user = new User();
    $user->ResetRequest($userData);

    if(true) {
        $toWhomEmail = $email;
        $subject = "Reset your password";
        $message = 'We received a password reset request. The link to reset your password is below. If you did not
    make this request, you can ignore this mail. </b></b> Here is your password reset link: </b>';
        $message .= '<a href=' . $url . '">' . $url . '</a></p> P.S.: You have to copy the link and paste it into your browser';

        $headers = "From: <thefewsue@gmail.com>\r\n";
        $headers .= "Reply-To: thefewsue@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        $mail = mail($toWhomEmail, $subject, $message, $headers);

        if ($mail) {
            header("Location: ../reset_password.php?reset=success");
        } else {
            header("Location: ../reset_password.php?reset=failed");
        }
    }
}