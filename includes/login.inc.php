<?php

require_once('../config/dbConfig.php');
require_once('../lib/pdo_db.php');
require_once('../models/User.php');

// Checks whether the user has reached the signup page by pressing the signup button or not. In this case we check for error first
if (!isset($_POST['login_submit'])) {
    header("Location: ../login.php");
    exit();
} else {
    // Filtering / Sanitize the POST Array to make sure that IF ppls put something harmful, then it will sanitize it as string    
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $userData = [
        'Email' => $email,
        'Password' => $password
    ];

    $user = new User();
    $user->Signin($userData);
}