<?php

$page_title = "Poster Search Results";
require 'includes/nav.php';
require_once('includes/database.php');

// Get search terms from user input
$term_string = filter_input(INPUT_GET, "terms", FILTER_SANITIZE_STRING);
$terms = explode(" ", $term_string);


// Construct SQL query statement
$sql = "SELECT * FROM movies WHERE 1 ";
foreach ($terms as $term) {
    $sql .= "AND movie_name LIKE '%$term%'";
}

// Execute the query
$query = $conn->query($sql);

// handle errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}
?>

<div class="posters-results-container">
    <div class="posters-txt" style="margin-top: 50px">
        Search Results:
    </div>

    <?php
    if ($query->num_rows == 0) {
        // If no results were found, display a message to the user
        echo "<p class='poster-results-txt'>No results found.</p>";
        echo '<div class="back-to-home">
                    <p><a href="index.php">Back to Home</a></p>
               </div>';
        require 'includes/mailoffer.php';
    } else {
        // Otherwise, display the search results
        echo "<table class='posters-table'>";
        echo "<tr>";
        $count = 0;
        while(($row = $query->fetch_assoc()) !== NULL) {
            echo "<td>";
            echo "<img src='" . $row['movie_poster_img'] . "'>";
            echo "<span class='poster-movie-name'>" . $row['movie_name'] . "</span>";
            echo "<a href='posterdetails.php?id=" . $row['movie_id'] . "'>";
            echo "<button>Buy Now</button>";
            echo "</a>";
            echo "</td>";
            $count++;
            if ($count == 3) {
                echo "</tr><tr>";
                $count = 0;
            }
        }
        echo "</tr>";
        echo "</table>";
    }
    ?>
</div>


<?php
require 'includes/footer.php';
?>
