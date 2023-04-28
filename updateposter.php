<?php

$page_title = "Update Poster Details";

// get nav and database
require_once ('includes/nav.php');
require_once ('includes/database.php');

//retrieve, sanitize, and escape all fields from the form
$movie_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$movie_name = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_name', FILTER_SANITIZE_STRING)));
$movie_year = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_year', FILTER_SANITIZE_STRING)));
$movie_director = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_director', FILTER_SANITIZE_STRING)));
//var_dump($movie_id, $movie_name, $movie_year, $movie_director);

//define MySQL update statement
$sql = "UPDATE movies SET movie_name='$movie_name', movie_year='$movie_year', movie_director='$movie_director' WHERE movie_id=$movie_id";

//echo $sql;

//Execute the query.
$query = @$conn->query($sql);



//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Connection Failed with: $errno, $errmsg<br/>\n";
    include ('includes/footer.php');
    exit;
}

?>

<div class="update-container">
    <p class="update-txt">The poster has been updated!</p>
</div>
<div class="back-to-home">
    <p><a href="index.php">Back to Home</a></p>
</div>

<?php
include ('includes/mailoffer.php');
// close the connection.
$conn->close();

include ('includes/footer.php');
?>


