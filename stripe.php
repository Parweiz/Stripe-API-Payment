<?php
$page = 'stripe';
require_once("header.php")
?>

<main>

    <div class="container">
        <h2 class="my-4 text-center">Intro To React Course [$50]</h2>
        <form action="includes/charge.inc.php" method="post" id="payment-form">
            <div class="form-row">
                <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty"
                    placeholder="First Name">
                <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty"
                    placeholder="Last Name">
                <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty"
                    placeholder="Email Address">
                <div id="card-element" class="form-control">
                    <!-- a Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors -->
                <div id="card-errors" role="alert"></div>

                <input type="hidden" name="dosubmit" value="1" />

            </div>
            <button name="payment_submit">Submit Payment</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="./js/charge.js"></script>

</main>

<?php

require_once("footer.php")
?>