<?php
// page variable that changes the title
$page_title = "Movie Posters";

// includes the navigation for the index page
include ('includes/nav.php');
include ('includes/database.php');


// SQL statement for select
$sql = "SELECT movie_id, movie_name, movie_poster_img FROM movies WHERE movie_id IN (10,11,12)";

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

<!--START OF INDEX HTML-->
<div class="idx-head-container">
    <div class="idx-head-left">
        <img src="www/img/mpheader1.png" alt="header">
    </div>

    <div class="idx-head-right">
        <div class="idx-head-right-txt">NEW RELEASES!<br>OUT NOW!</div>
        <div class="idx-head-right-txt">
            <a href="posters.php">shop posters now →</a>
        </div>
    </div>
</div>

<div class="idx-trend-container">
    <div class="idx-trend-head-txt">
        Trending Posters:
    </div>
    <table class="idx-trend-table">
        <tr>
            <?php
            while(($row = $query->fetch_assoc()) !== NULL) {
                echo "<td>";
                echo "<img src='" . $row['movie_poster_img'] . "'>";
                echo "<span class='idx-movie-name'>" . $row['movie_name'] . "</span>";
                echo "<a href='posterdetails.php?id=" . $row['movie_id'] . "'>";
                echo "<button>Buy Now</button>";
                echo "</a>";
                echo "</td>";
            }
            ?>
        </tr>
    </table>
</div>

<div class="idx-build-container">
    <table class="idx-table">
        <tr>
            <td>
                <div class="idx-table-poster"  style="width: 240px; height: 360px; text-align: center;">
                    <p class="idx-poster-txt">Your<br>Poster<br>Here!</p>
<!--                    <button class="idx-poster-btn">Upload Image</button>-->
                </div>
            </td>
            <td>
                <div class="idx-table-txt">
                    <p class="idx-poster-txt2">Make Your Own Poster!</p>
                    <p class="idx-poster-txt3">Create a personalized movie poster with our Build Your Own Movie Poster tool! Upload an image of your favorite film and customize the title, director, genre, and poster size to make it uniquely yours.</p>
                    <a href="newposter.php">
                        <button class="idx-table-btn">Buy Now</button>
                    </a>
                </div>
            </td>
        </tr>
    </table>

</div>



<?php
include ('includes/mailoffer.php');
// clean up result sets when we're done with them
$query->close();

// close the connection.
$conn->close();

include ('includes/footer.php');
?>

