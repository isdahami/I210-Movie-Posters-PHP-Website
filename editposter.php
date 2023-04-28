<?php
$page_title = "Edit Poster Details";

require_once ('includes/nav.php');
require_once('includes/database.php');

//retrieve user id from a query string
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: movie id was not found.";
    require_once ('includes/footer.php');
    exit();
}
$movie_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// SELECT statement to retrieve one users record
$sql = "SELECT * FROM movies WHERE movie_id =" . $movie_id;

// run the SQL statement
$query = @$conn->query($sql);


//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    //include the footer
    require_once ('includes/footer.php');
    exit;
}

// pull a row from the $query
$row = $query->fetch_assoc();

//display results in a table
?>

<h2 class="poster-header-txt">Edit Poster Details</h2>


<div class="new-poster-details-container">
    <form class="new-poster-form"  name="editposter" action="updateposter.php" method="get" >

        <div class="new-poster-img">
            <img src="<?= $row['movie_poster_img'] ?>" width="240" height="360">
        </div>


        <div class="new-poster-details-wrapper">
            <table>
                <input type="hidden" name="id" value="<?php echo $movie_id; ?>">
                <tr>
                    <th>Title:</th>
                    <td><input name="movie_name" value="<?php echo $row['movie_name'] ?>" size="30" required /></td>
                </tr>
                <tr>
                    <th>Year Released:</th>
                    <td><input name="movie_year" value="<?php echo $row['movie_year'] ?>" size="30" required /></td>
                </tr>
                <tr>
                    <th>Directed By:</th>
                    <td><input name="movie_director" value="<?php echo $row['movie_director'] ?>" size="30" required /></td>
                </tr>
                <tr>
                    <label for="size"><th>Genre:</th></label>
                    <td>
                        <select name="genre_id">
                            <option value="10">Comedy</option>
                            <option value="20">Action</option>
                            <option value="30">Thriller</option>
                            <option value="40">Horror</option>
                            <option value="50">Drama</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <label for="size"><th>Poster Size:</th></label>
                    <td>
                        <select name="movie_poster_size">
                            <option value="27x40">27x40</option>
                            <option value="24x36">24x36</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td>
                        <select name="movie_poster_price">
                            <option value="29.99">$29.99</option>
                            <option value="17.99">$17.99</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
<!--                        <button class="poster-btn">-->
                            <input class="poster-btn" type="submit" value="Update">
<!--                        </button>-->
<!--                        <button class="poster-btn">-->
                            <input class="poster-btn2" onclick="window.location.href='posterdetails.php?id=<?php echo $row['movie_id']; ?>'" value="Cancel">
<!--                        </button>-->
<!--                        <button class="new-poster-btn" type="submit" name="Submit" id="Submit" value="Register" >Create Poster</button>-->
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>


<p class="back-to-posters"><a href="posters.php">Back to Posters</a></p>

<?php
// clean up result sets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>
