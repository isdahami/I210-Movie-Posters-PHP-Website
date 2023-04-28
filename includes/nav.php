<?php
// At the end of the PHP code block, type the following line of code start a new session.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$count = 0;

//retrieve cart content
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    if ($cart) {
        $count = array_sum($cart);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link type="text/css" rel="stylesheet" href="www/css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="nav-bar">
    <div class="nav-logo">
        <a href="index.php">
            <img src="www/img/mplogo.png" alt="logo">
            <span class="nav-logo-txt">movieposters</span>
        </a>
    </div>
    <form action="searchposterresults.php" method="get">
        <div class="search-box">
            <input type="text" name="terms" size="40" placeholder="Search Posters..." required />
            <button type="submit" name="Submit" id="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9.5 3C5.36 3 2 6.36 2 10.5s3.36 7.5 7.5 7.5c1.52 0 2.93-.45 4.12-1.23l5.83 5.83c.2.2.51.2.71 0l1.46-1.46c.2-.2.2-.51 0-.71l-5.83-5.83c.78-1.19 1.23-2.6 1.23-4.12 0-4.14-3.36-7.5-7.5-7.5zm0 12c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/></svg>
            </button>
        </div>
    </form>
    <div class="nav-links">
        <a href="index.php">home</a>
        <a href="posters.php">posters</a>
        <a href="showcart.php">
            <span>cart: <?php echo $count ?></span>
        </a>
        <?php // if user is logged in, nav will display 'account' and 'logout'
        if (isset($_SESSION["user_id"])) {
            echo "<a href='account.php'>account</a>";
            echo "<a href='logout.php' onclick='return confirm()'>logout</a>";
        } else { // if user is NOT logged in, 'login' and 'signup' will display
            echo "<a href='login.php'>login</a>";
            echo "<a href='signup.php'>sign-up</a>";
        }
        ?>
    </div>
</nav>


</body>
</html>
