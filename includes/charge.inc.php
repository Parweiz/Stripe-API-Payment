<?php
require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');
require_once('../models/Customer.php');
require_once('../models/Transaction.php');

$stripe = new \Stripe\StripeClient('sk_test_51HmPsTArNppioXnxL4J48Xsy3Iu0au1UcViYsUVkcKmkvXRzB4ap0xuzJ1ziFNl8OFDvGnjiY3jgXteCQ2e8XZeK00JbELNUB1');

// Filtering / Sanitize the POST Array to make sure that IF ppls put something harmful, then it will sanitize it as string    
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

// Fetching all the datas that the user has passed on on the charge.php site
$firstName = $POST['first_name'];
$lastName = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];
$fullName = $firstName . " " . $lastName;

// Create customer in Stripe 
$customer = $stripe->customers->create([
  "email" => $email,
  "source" => $token,
  "name" => $fullName,
  "description" => "A new customer by the name of (" . $fullName . ") has been created in the system"
]);

// Charge the customer
$charge = $stripe->charges->create([
  "amount" => 5000,
  "currency" => "usd",
  "description" => "'Intro to React Course' payment",
  "customer" => $customer->id
]);


// Customer data array
$customerData = [
  'customerID' => $charge->customer,
  'first_name' => $firstName,
  'last_name' => $lastName,
  'email' => $email
];

// Instantiate the Customer class
$customer = new Customer();
$customer->addCustomer($customerData);


// Transaction Data
$transactionData = [
  'transactionID' => $charge->id,
  'customerID' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
];

// Instantiate Transaction
$transaction = new Transaction();
$transaction->addTransaction($transactionData); 

// Redirect to success
header('Location: ../success.php?transactionId=' . $charge->id . '&product=' . $charge->description);