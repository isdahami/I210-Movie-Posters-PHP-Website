<?php

function validateEmail ($email){
    $result;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function passwordMatch ($password, $passwordRepeat) {
    $result;
    if ($password !== $passwordRepeat) { //checks for matching passwords
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function userExists ($conn, $userName, $email) { //checks if user already exists
    $sql = "SELECT * FROM users WHERE userName = ? or email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: login.php?error=stmtFailed");
        exit();
    }
    // executes statement
    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);//get result from statement

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $userName, $firstName, $lastName, $email, $password) {
    $sql = "INSERT INTO USERS VALUES (NULL, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: login.php?error=stmtFailed");
        exit();
    }

    //hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $userName, $firstName, $lastName,  $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: index.php");
}

function login($conn, $userName, $password) {
    $userExists = userExists($conn, $userName, $userName);

    if ($userExists === false) {//if user doesn't exist, go back to login page
        header("location: login.php?error=incorrectlogin");
        exit();
    }

    $hashedPassword = $userExists["password"];
    $checkPassword = password_verify($password, $hashedPassword);

    if ($checkPassword === false) {
        header("location: login.php?error=wronglogin");
        exit();
    } else if ($checkPassword === true) {
        session_start();
        $_SESSION["user_id"] = $userExists["user_id"];
        header("location: index.php");
        exit();
    }
}