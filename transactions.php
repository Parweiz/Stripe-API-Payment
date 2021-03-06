<?php
$page = 'transactions';
require_once('config/dbConfig.php');
require_once('vendor/autoload.php');
require_once('lib/pdo_db.php');
require_once('models/Transaction.php');
require_once('header.php');

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php?error=loginfirst");
    exit();
} else {
    $stripe = new \Stripe\StripeClient(
        'sk_test_51HmPsTArNppioXnxL4J48Xsy3Iu0au1UcViYsUVkcKmkvXRzB4ap0xuzJ1ziFNl8OFDvGnjiY3jgXteCQ2e8XZeK00JbELNUB1'
    );
    $transactions = $stripe->charges->all([
        'limit' => 20,
    ]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>View Transactions</title>
</head>

<body>
    <div class="container mt-4">
        <!-- <div class="btn-group" role="group">
            <a href="customers.php" class="btn btn-secondary">Customers</a>
            <a href="transactions.php" class="btn btn-primary">Transactions</a>
        </div> 

        <hr> -->
        <h2>Transactions</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction) : $regDate = $transaction->created; ?>
                <tr>
                    <td><?php echo $transaction->id; ?></td>
                    <td><?php echo $transaction->customerID; ?></td>
                    <td><?php echo $transaction->product; ?></td>
                    <td><?php echo sprintf('%.2f', $transaction->amount / 100); ?>
                        <?php echo strtoupper($transaction->currency); ?></td>
                    <td><?php echo date('r', $regDate) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <p><a href="index.php">Back to Payment Page</a></p>
    </div>
</body>

</html>


<?php

require_once("footer.php")
?>