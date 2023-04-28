<?php

$page_title = "Shop Movie Posters";

require_once ('includes/nav.php');
require_once('includes/database.php');

// SQL statement for select
$sql = "SELECT movie_id, movie_name, movie_poster_img FROM movies WHERE movie_id BETWEEN 1 AND 1000";

// run the sql statement
$query = $conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}

?>

<!--START OF POSTERS HTML-->
<div class="posters-head-container">
    <div class="posters-head-img">
        <img src="www/img/posterheader.png" alt="Poster Header">
    </div>
</div>

<div class="posters-shop-container">
    <div class="posters-txt">
        Movie Posters:
    </div>
    <table class="posters-table">
        <tr>
            <?php
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
            ?>
        </tr>
    </table>
</div>

<?php
// clean up result sets when we're done with them
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');