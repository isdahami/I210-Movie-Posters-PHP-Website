<?php

$page_title = "Cart";
require_once ('includes/nav.php');
require_once ('includes/database.php');

?>

<h2 class="poster-header-txt">Checkout</h2>

<?php

if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    echo "<span class='showcart-empty-txt'>Your cart is empty.</span><br><br>";
    echo '<div class="back-to-home">
                    <p><a href="index.php">Back to Home</a></p>
               </div>';
    include ('includes/mailoffer.php');
    include ('includes/footer.php');
    exit();
}

$sql = "SELECT movie_id, movie_name, movie_poster_price, movie_poster_img FROM movies WHERE 0";

foreach (array_keys($cart) as $movie_id) {
    $sql .= " OR movie_id=$movie_id";
}

//execute the query
$query = $conn->query($sql);

//proceed since the cart is not empty
$cart = $_SESSION['cart'];
//var_dump($cart);
?>


    <table class="showcart-table">
        <tr>
            <th></th>
            <th>Title</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php
        //insert code to display the shopping cart content
        //select statement
        $sql = "SELECT movie_id, movie_name, movie_poster_price, movie_poster_img FROM movies WHERE 0";

        foreach (array_keys($cart) as $movie_id) {
            $sql .= " OR movie_id=$movie_id";
        }

        //execute the query
        $query = $conn->query($sql);

        //fetch books and display them in a table
        while ($row = $query->fetch_assoc()) {
            $img = $row['movie_poster_img'];
            $movie_id = $row['movie_id'];
            $title = $row['movie_name'];
            $price = $row['movie_poster_price'];
            $qty = $cart[$movie_id];
            $total = $qty * $price;
            echo "<tr>",
                "<td><img src='".$row['movie_poster_img']."' width='180' height='260'></td>",
            "<td><a href='posterdetails.php?id=$movie_id'>$title</a></td>",
            "<td>$$price</td>",
            "<td>$qty</td>",
            "<td>$$total</td>",
            "<tr/>";
        }

        ?>
    </table>
    <br>
    <div class="showcart-btm-btns">
        <input class="poster-btn" type="button" value="Checkout" onclick="window.location.href = 'checkout.php'"/>
        <input class="poster-btn" type="button" value="Cancel" onclick="window.location.href = 'posters.php'" />
    </div>
    <br><br>




<?php
include ('includes/footer.php');