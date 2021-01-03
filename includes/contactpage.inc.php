<?php

require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');
require_once('../models/Contact.php');

// Checks whether the user has reached the Contact page by pressing the submit button or not. In this case we check for error first
if (!isset($_POST['submit'])) {
    header("Location: ../contact.php");
    exit();
} else {
    // Filtering / Sanitize the POST Array to make sure that IF ppls put something harmful, then it will sanitize it as string
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $fullname = $_POST['name'];
    $mail = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];

    $contactData = [
        'fullname' => $fullname,
        'email' => $mail,
        'subject' => $subject,
        'msg' => $msg
    ];

    $contact = new Contact();
    $contact->Contact($contactData);

    
}