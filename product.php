<?php
$page = 'product';
require_once('header.php')
?>

<main>

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="price"><span class="currency">€</span>27</h2>
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
                        <form action="paymentProcess.php?pid=1" method="POST">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_InwOqy624uXwfN2dgqlCR2gI" data-amount="2700"
                                data-name="CodingPassiveIncome" data-description="Widget"
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
                        <h2 class="price"><span class="currency">€</span>67</h2>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">Product 1</h1>
                        <ul class="list-group">
                            <li class="list-group-item">Feature 1</li>
                            <li class="list-group-item">Feature 2</li>
                            <li class="list-group-item">Feature 3</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form action="paymentProcess.php?pid=2" method="POST">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_InwOqy624uXwfN2dgqlCR2gI" data-amount="6700"
                                data-name="CodingPassiveIncome" data-description="Widget"
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
                        <h2 class="price"><span class="currency">€</span>97</h2>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">Product 1</h1>
                        <ul class="list-group">
                            <li class="list-group-item">Feature 1</li>
                            <li class="list-group-item">Feature 2</li>
                            <li class="list-group-item">Feature 3</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form action="paymentProcess.php?pid=3" method="POST">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_InwOqy624uXwfN2dgqlCR2gI" data-amount="9700"
                                data-name="CodingPassiveIncome" data-description="Widget"
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