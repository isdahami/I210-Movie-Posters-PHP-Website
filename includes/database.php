<?php
// define parameters to connect database
$host = "localhost:3306";
$login = "phpuser";
$password = "phpuser";
$database = "movieposter_db";

// connect to the database
$conn = @new mysqli($host, $login, $password, $database);

// connection to error handler
if ($conn->connect_errno){
    $errno = $conn->connect_errno;
    $errmsg = $conn->connect_error;
    die("Connection to database failed: ($errno) $errmsg");
}
?>

