<?php

$page_title = "Log In";

// get nav and database
require_once ('includes/nav.php');
require_once ('includes/database.php');
?>
    <div class="signup_form_wrapper">

        <div class="signup_header">
            <h2>login</h2>
        </div>

        <div class="signup_form">
            <form action="loginscript.php" method="post">
                <div class="signup_input">
                    <input type="text" name="userName" placeholder="Username/Email" required> </br>
                    <input type="password" name="password" placeholder="Password" required> </br>
                    <?php //error message
                    if(isset($_GET["error"])) {
                        if ($_GET["error"] == "incorrectlogin") {
                            echo "<p class='error_msg'>login information is incorrect</p>";
                        }
                    }
                    ?>
                    <button type="submit" name="submit" >Login</button> </br>
                </div>
            </form>
            <p class="linkto">need an account? <a href="signup.php">sign up</a></p>
        </div>
    </div>
<?php
include_once 'includes/footer.php';