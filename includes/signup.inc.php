<?php

require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');
require_once('../models/User.php');

// Checks whether the user has reached the signup page by pressing the signup button or not. In this case we check for error first
if (!isset($_POST['signup_submit'])) {
    header("Location: ../signup.php");
    exit();
} else {
    // Filtering / Sanitize the POST Array to make sure that IF ppls put something harmful, then it will sanitize it as string    
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    // Fetching all the datas that the user has passed on from the signup form
    $fullName = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password_repeat'];

    $userData = [
        'UserName' => $username,
        'FullName' => $fullName,    
        'Email' => $email,
        'Password' => $password,
        'RepeatPassword' => $passwordRepeat
    ];

    $user = new User();
    $user->SignUp($userData);

    if(true) {
        header("Location: ../signin.php?signup=success");
        exit();
    } else {
        header("Location: ../signup.php");
        exit();
    }
}