<?php
session_start();
include ("connection.php");
include ("functions.php");

$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoXhome</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header>
        <h1>MoX</h1>
        <a href="../signuppageUser/signup.html">
            <button class="signup-button">Sign Up</button>
        </a>
        <a href="../homePageRo/homeRo.html" style="text-decoration: none;">
            <button class="lang-button">en</button>
        </a>
    </header>

    <div class="content">
        <p>Unlimited movies, TV shows, and more...</p>
        <a>Watch anywhere. Cancel anytime.</a>
    </div>

    <a href="../getstartedpage/getstarte.html" style="text-decoration: none;">
        <button class="getstarted-button">Get Started</button>
    </a>

    <div class="centered-img"></div>

</body>

</html>