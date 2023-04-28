<?php

$page_title = "Sign Up";

// get nav and database
require_once ('includes/nav.php');
require_once ('includes/database.php');
?>
    <link rel="stylesheet" href="www/css/styles.css">
    <div class="signup_form_wrapper">
<div class="signup_header">
    <h2>sign up</h2>
</div>

<div class="signup_form">
    <form action="signupscript.php" method="post">
        <div class="signup_input">
        <input type="text" name="firstName" placeholder="first name" required> </br>
        <input type="text" name="lastName" placeholder="last name" required> </br>
        <input type="text" name="userName" placeholder="username" required> </br>
        <input type="text" name="email" placeholder="email@email.com" required> </br>
        <input type="password" name="password" placeholder="password" required> </br>
        <input type="password" name="passwordRepeat" placeholder="repeat password" required> </br>
            <?php //display message corresponding to sign-up issue
            if(isset($_GET["error"])){
                if ($_GET["error"] == "passwordsDontMatch") {
                    echo "<p class='error_msg'>passwords do not match</p>";
                }
                elseif ($_GET["error"] == "userTaken") {
                    echo "<p class='error_msg'>username or email is already taken</p>";
                }
                elseif ($_GET["error"] == "invalidEmail") {
                    echo "<p class='error_msg'>email format invalid</p>";
                }
                elseif ($_GET["error"] == "none") {
                    echo "<p class='success_msg'>you have signed up</p>";
                }
            }
            ?>
        <button type="submit" name="submit">Sign Up</button> </br>
        </div>
    </form>
    <p class="linkto">already have an account? <a href="login.php">log in</a></p>
</div>
    </div>

<?php
include_once 'includes/footer.php';