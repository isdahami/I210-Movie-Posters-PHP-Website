<?php

// checks to see if a session has stated, will start one if there isn't one
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
}

//retrieve user id from a querystring
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: movie id was not found.";
    die();
}

// retrieve movie id and make sure it has a numeric value
$movie_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!is_numeric($movie_id)) {
    echo "Error: Movie id was not found.<br>Operation can not proceed.";
    die();
}

if (array_key_exists($movie_id, $cart)) {
    $cart[$movie_id] = $cart[$movie_id] + 1;
} else {
    $cart[$movie_id] = 1;
}

// update the session var
$_SESSION['cart'] = $cart;

// redirect to the showcart page
header("Location: showcart.php");