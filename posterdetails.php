<?php
// page title
$page_title = "Poster Details";

// get nav and database
require_once ('includes/nav.php');
require_once ('includes/database.php');

//retrieve user id from a query string
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: movie id was not found.";
    require_once ('includes/footer.php');
    exit();
}
$movie_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// SELECT statement to retrieve movies record
$sql = "SELECT movies.*, genres.genre FROM movies 
        INNER JOIN genres ON movies.genre_id = genres.genre_id 
        WHERE movie_id = " . $movie_id;


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

// pull a row from the $query, only one is pulled
$row = $query->fetch_assoc();
//var_dump($row);

?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>

    <h2 class="poster-header-txt">Poster Details</h2>

    <div class="poster-details-container">
        <div class="poster-img">
            <img src="<?= $row['movie_poster_img'] ?>" width="240" height="360">
        </div>
        <div class="poster-details-wrapper">
            <table>
                <tr>
                    <th>Title:</th>
                    <td><?= $row['movie_name'] ?></td>
                </tr>
                <tr>
                    <th>Year Released:</th>
                    <td><?= $row['movie_year'] ?></td>
                </tr>
                <tr>
                    <th>Directed By:</th>
                    <td><?= $row['movie_director'] ?></td>
                </tr>
                <tr>
                    <th>Genre:</th>
                    <td><?= $row['genre'] ?></td>
                </tr>
                <tr>
                    <th>Poster Size:</th>
                    <td><?= $row['movie_poster_size'] ?></td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td><?= $row['movie_poster_price'] ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="poster-btn">
                            <a href="editposter.php?id=<?php echo $row['movie_id'] ?>">Edit</a>
                        </button>
                        <button class="poster-btn" onclick="confirmDelete(<?php echo $row['movie_id'] ?>)">Delete</button>

                        <button class="poster-btn">
                            <a href="addtocart.php?id=<?php echo $row['movie_id'] ?>">Add to Cart</a>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="back-to-posters">
        <p><a href="posters.php">Back to Posters</a></p>
    </div>
    <script>
        function confirmDelete(movie_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it.'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "deleteposter.php?id=" + movie_id;
                }
            });
        }
    </script>



<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>