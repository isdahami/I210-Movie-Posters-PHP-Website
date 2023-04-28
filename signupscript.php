<?php

$page_title = "Sign Up";

// require nav and database
require_once ('includes/nav.php');
require_once ('includes/database.php');
if (isset($_POST["submit"])) {

    //get input as variables

    $firstName = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING)));
    $lastName = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING)));
    $email = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
    $password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
    $passwordRepeat = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'passwordRepeat', FILTER_SANITIZE_STRING)));
    $userName = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING)));

    require_once ('includes/functions.php');

    //error checks
    if (validateEmail($email)!== true) {
        header("location: signup.php?error=invalidEmail");
        exit();
    }
    if (passwordMatch($password, $passwordRepeat) !== false) { //password match check
        header("location: signup.php?error=passwordsDontMatch");
        exit();
    }
    if (userexists($conn, $userName, $email) !== false) { // check if user/email already exists
        header("location: signup.php?error=userTaken");
        exit();
    }

    //call create user function
    createUser($conn, $userName, $firstName, $lastName, $email, $password);

    //if sign up is successful, back to home page
    header("location: signup.php?error=none");
    exit();

} else {
    header("location: signup.php");
    exit();
}

include ('includes/footer.php');