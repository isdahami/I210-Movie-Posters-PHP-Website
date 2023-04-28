<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// empty the shopping cart
$_SESSION['cart'] = '';

// set page title
$page_title = "Poster Checkout";
// display the header
require_once ('includes/nav.php');
?>

<span class='checkout-txt'>Checkout Successful!</span><br><br>
<p class='checkout-txt-two'>Thank you for shopping with us, your business is greatly appreciated!<br> You will be notified once your items have shipped.</p>
<div class="back-to-home">
    <p><a href="index.php">Back to Home</a></p>
</div>


<?php
include ('includes/mailoffer.php');

include ('includes/footer.php');
?>
