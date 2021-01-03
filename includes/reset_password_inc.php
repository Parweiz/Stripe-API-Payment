<?php

require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');
require_once('../models/User.php');

// Checks whether the user has reached the signup page by pressing the signup button or not. In this case we check for error first
if (!isset($_POST['reset_password_submit'])) {
    header("Location: ../index.php");
    exit();
} else {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password_repeat'];
    $currentDate = date("U");

    $userData = [
        'selector' => $selector,
        'validator' => $validator,
        'password' => $password,
        'passwordRepeat' => $passwordRepeat,
        'currentDate' => $currentDate
    ];

    $user = new User();
    $user->ResetPassword($userData);
}