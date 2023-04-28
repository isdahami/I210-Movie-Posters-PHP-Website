<?php

$page_title = "Delete Poster";

require_once('includes/nav.php');
require_once('includes/database.php');

//retrieve user id from a querystring
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: movie id was not found.";
    require_once('includes/footer.php');
    exit();
}

$movie_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//define the MySQL delete statement
$sql = "DELETE FROM movies WHERE movie_id=$movie_id";

//execute the query
$query = @$conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    exit;
}
?>


    <div class="delete-container">
        <p class="delete-txt">The poster has been deleted.</p>
    </div>
    <div class="back-to-home">
        <p><a href="index.php">Back to Home</a></p>
    </div>


<?php
include ('includes/mailoffer.php');
// close the connection.
$conn->close();

include('includes/footer.php');
?>