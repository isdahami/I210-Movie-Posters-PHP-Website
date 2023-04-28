<?php
$page_title = "Created New Poster";

require_once 'includes/nav.php';
require_once 'includes/database.php';

//retrieve, sanitize, and escape user's input from a form
$movie_name = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_name', FILTER_SANITIZE_STRING)));
$movie_year = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_year', FILTER_SANITIZE_STRING)));
$movie_director = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_director', FILTER_SANITIZE_STRING)));
$genre_id = trim(filter_input(INPUT_GET, 'genre_id', FILTER_SANITIZE_NUMBER_INT)); // modified to sanitize as integer

// validate genre_id value
$valid_genres = array(); // array to hold valid genre_id values
$sql = "SELECT genre_id FROM genres";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $valid_genres[] = $row['genre_id']; // populate array with valid genre_id values
    }
}
if (!in_array($genre_id, $valid_genres)) {
    // handle invalid input
    echo "Invalid genre_id value. Please choose a valid genre.<br/>\n";
    include 'includes/footer.php';
    exit;
}

$movie_poster_size = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_poster_size', FILTER_SANITIZE_STRING)));
$movie_poster_price = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_poster_price', FILTER_SANITIZE_STRING)));
$movie_poster_img = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'movie_poster_img', FILTER_SANITIZE_STRING)));

// Add the file path to $movie_poster_img
$movie_poster_img = "www/img/" . $movie_poster_img;


//define the MySQL insert statement
$sql = "INSERT INTO movies VALUES (NULL, '$movie_name', '$movie_year', '$movie_director',
'$genre_id', '$movie_poster_size', '$movie_poster_price', '$movie_poster_img')";


//execute the query
$query = @$conn->query($sql);

//handle error
if(!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Insertion failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    include 'includes/footer.php';
    exit;
}
?>

    <div class="create-container">
        <p class="create-txt">Your poster has been made!</p>
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