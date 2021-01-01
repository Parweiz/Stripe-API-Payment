<?php

require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');
require_once('../models/User.php');

// Checks whether the user has reached the signup page by pressing the signup button or not. In this case we check for error first
if (!isset($_POST['login_submit'])) {
    header("Location: ../signin.php");
    exit();
} else {
    // Filtering / Sanitize the POST Array to make sure that IF ppls put something harmful, then it will sanitize it as string    
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    
    $mailuid = $_POST['uid'];
    $password = $_POST['password'];

    $userData = [
        'UserName' => $mailuid,
        'Password' => $password
    ];

    $user = new User();
    $user->SignIn($userData);
}