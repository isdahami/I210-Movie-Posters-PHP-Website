<?php
// page title
$page_title = "Create Poster";

// get nav and database
require_once ('includes/nav.php');
require_once ('includes/database.php');



?>



<h2 class="new-poster-header-txt">Create Poster</h2>

<div class="new-poster-details-container">
    <form class="new-poster-form"  action="createposter.php" method="get" enctype="text/plain">
        <div class="new-poster-img">
            <p class="new-poster-txt">Your<br>Poster<br>Here</p>
            <label for="poster-upload" class="new-upload-poster-btn">Upload Image</label>
            <input id="poster-upload" type="file" style="display:none;" name="movie_poster_img">
        </div>


        <div class="new-poster-details-wrapper">
            <table>
                <tr>
                    <th>Title:</th>
                    <td><input name="movie_name" type="text" required /></td>
                </tr>
                <tr>
                    <th>Year Released:</th>
                    <td><input name="movie_year" type="text" required /></td>
                </tr>
                <tr>
                    <th>Directed By:</th>
                    <td><input name="movie_director" type="text" required /></td>
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
<!--                        <button class="new-poster-btn">Edit</button>-->
                        <button class="new-poster-btn" type="submit" name="Submit" id="Submit" value="Register" >Create Poster</button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>

<div class="back-to-posters">
    <p><a href="index.php">Back to Home</a></p>
</div>

<?php

require_once ('includes/footer.php');

?>

