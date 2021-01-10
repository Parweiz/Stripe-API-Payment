<?php

// require_once('../vendor/autoload.php');
require "../vendor/autoload.php";

$stripe = [
    "publishable_key" => "pk_test_51HmPsTArNppioXnx7eMPo9WrVdbmEVlLzT542PvPOdqTNkGr0jtMQSRaB5JaUhO0mvQ7kbs5kDib8d1STOutR9hY00JyBGkPlw",
    "secret_key"      => "sk_test_51HmPsTArNppioXnxL4J48Xsy3Iu0au1UcViYsUVkcKmkvXRzB4ap0xuzJ1ziFNl8OFDvGnjiY3jgXteCQ2e8XZeK00JbELNUB1",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);