<?php
$page = 'product';
// require_once('config/stripeConfig.php');
require_once('header.php');

?>

<main>

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="price"><span class="currency">€</span>30</h2>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">Product 1</h1>
                        <ul class="list-group">
                            <li class="list-group-item">Feature 1</li>
                            <li class="list-group-item">Feature 2</li>
                            <li class="list-group-item">Feature 3</li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <form action="includes/payment.inc.php?productid=1" method="POST">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_51HmPsTArNppioXnx7eMPo9WrVdbmEVlLzT542PvPOdqTNkGr0jtMQSRaB5JaUhO0mvQ7kbs5kDib8d1STOutR9hY00JyBGkPlw"
                                data-amount="3000" data-name="XXXXXXXXXX" data-description="Rnd Description"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto" data-currency="eur">
                            </script>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="price"><span class="currency">€</span>60</h2>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">Product 2</h1>
                        <ul class="list-group">
                            <li class="list-group-item">Feature 1</li>
                            <li class="list-group-item">Feature 2</li>
                            <li class="list-group-item">Feature 3</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form action="includes/payment.inc.php?productid=2" method="POST">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_51HmPsTArNppioXnx7eMPo9WrVdbmEVlLzT542PvPOdqTNkGr0jtMQSRaB5JaUhO0mvQ7kbs5kDib8d1STOutR9hY00JyBGkPlw"
                                data-amount="6000" data-name="XXXXXXXXXX" data-description="Rnd Description"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto" data-currency="eur">
                            </script>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="price"><span class="currency">€</span>90</h2>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">Product 3</h1>
                        <ul class="list-group">
                            <li class="list-group-item">Feature 1</li>
                            <li class="list-group-item">Feature 2</li>
                            <li class="list-group-item">Feature 3</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form action="includes/payment.inc.php?productid=3" method="POST">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_51HmPsTArNppioXnx7eMPo9WrVdbmEVlLzT542PvPOdqTNkGr0jtMQSRaB5JaUhO0mvQ7kbs5kDib8d1STOutR9hY00JyBGkPlw"
                                data-amount="9000" data-name="XXXXXXXXXX" data-description="Rnd Description"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto" data-currency="eur">
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php

require "footer.php"
?>