<?php
require_once('../vendor/autoload.php');
require_once('../config/stripeConfig.php');
require_once('../lib/pdo_db.php');
require_once('../models/Product.php');


// Array that holds the 3 different products id - From Stripe API
$products = array(
    "ProductID" => ["1", "2", "3"],
    "1" => "price_1I7sWGArNppioXnxWXmQz1Mm",
    "2" => "price_1I7sWRArNppioXnxeGjsigOl",
    "3" => "price_1I7sWgArNppioXnxECJ8RBWu"

);

$stripe = new \Stripe\StripeClient(
    'sk_test_51HmPsTArNppioXnxL4J48Xsy3Iu0au1UcViYsUVkcKmkvXRzB4ap0xuzJ1ziFNl8OFDvGnjiY3jgXteCQ2e8XZeK00JbELNUB1'
);


if (!isset($_GET['productid']) || !in_array($_GET['productid'], $products['ProductID']) || !isset($_POST['stripeToken']) || !isset($_POST['stripeEmail'])) {
    // COME UP WITH BETTER ERRORHANDLING
    header('Location: ../index.php');
    exit();
}

$productID = $_GET['productid'];
$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];

// Create customer in Stripe 
$customer = $stripe->customers->create([
    'email' => $email,
    'source'  => $token,
    "description" => "A new customer by the email of (" . $email . ") has been created in the system"
]);

// Create subscription in Stripe 
$subscriptions = $stripe->subscriptions->create([
    'customer' => $customer->id,
    "items" => [
        [
            "plan" => $products[$productID],
        ],
    ]
]);

// Creating a password
$allCharactersAndInts = "qwertyuiopasdfghjklzxcvbnm1234567890";
$shuffled = str_shuffle($allCharactersAndInts);
$password = strtoupper(substr($shuffled, 0, 12));
$hashedPwd = password_hash($password, PASSWORD_BCRYPT);

$paymentData = [
    'email' => $email,
    'productID' => $productID,
    'hashedPwd' => $hashedPwd
];

$payment = new Product();
$payment->SubscribeToProduct($paymentData);

// Send an email with login info to the user's mail if the subscription went through
if (true) {

    $toWhomEmail = $email;
    $subject = "Your login details... ";
    $body = "<h2>Login details</h2>
            <p>Thank you for the purchase. In connection with that we have made an account with following login infos 
            for you which you can use to browser throughout our website: </p>
            <b>username</b>: $email<br>
            <b>password</b>: $password<br><br>

        <a href='http://localhost/php_lessons/php_stripe_payment/login.php'>Click Here To Login</a><br><br>

        Thanks,<br>
        Parweiz H.
    
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: " . $email . "\r\n";

    $mail = mail($toWhomEmail, $subject, $body, $headers);

    if ($mail) {
        header("Location: ../thank_you.php?order=success&productid=" . $productID);
    } else {
        header("Location: ../product.php?order=failed");
    }
} else {
    echo '<h1>Somethign went wrong</h1>';
}