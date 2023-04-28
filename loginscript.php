<?php

$page_title = "Log In";

// get nav and database
require_once ('includes/nav.php');
require_once ('includes/database.php');
require_once ('includes/functions.php');

if (isset($_POST["submit"])) {
//retrieve, escape, trim, sanitize
    $userName = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING)));
    $password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
    $email = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));

    login($conn, $userName, $password);

} else {
    header("location: login.php");
    exit();
}

$_SESSION["userName"] = $userName;

include ('includes/footer.php');