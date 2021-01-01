<?php
$page = 'contact';
require "header.php"
?>

<main>

    <div class="container-contact100">
        <div class="wrap-contact100">
            <span class="contact100-form-title">
                Send Us A Message
            </span>
            <form action="includes/contactpage.inc.php" method="POST">
                <div class="wrap-input100">
                    <input class="input100" type="text" name="name" placeholder="Full Name">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="email" placeholder="E-mail">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="subject" placeholder="Subject">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100">
                    <textarea class="input100" name="message" placeholder="Your Message"></textarea>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn" type="submit" name="submit">
                        <span>
                            <i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
                            Send Mail
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>


</main>

<?php

require "footer.php"
?>