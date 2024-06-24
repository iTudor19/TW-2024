<?php
session_start();
include ("connection.php");
include ("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted 
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    //$confirmpassword = $_POST['Confirm Password'];
    if (!empty($username) && !empty($email) && !empty($password)) {
        //save to database 
        $user_id = random_num(20);
        $query = "insert into users (user_id,username,email,password) values ('$user_id','$username','$email','$password')";
        mysqli_query($con, $query);
        header("Location: ../parte_TW/index.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoXhome</title>
    <link rel="stylesheet" href="signupstyles.css">
</head>

<body>

    <header>
        <a href="../homepage/home.html" style="text-decoration: none;">
            <h1>MoX</h1>
        </a>
        <a href="../signuppageUserRo/signupRo.html" style="text-decoration: none;">
            <button class="lang-button">en</button>
        </a>
    </header>

    <div class="background-container">
        <p class="p0">Create Account</p>
        <p class="p1">Already have an account?</p>
        <a href="../parte_TW/signin.php" style="text-decoration: none;">
            <p class="p2">Sign In!</p>
        </a>

        <form method="post">
            <input type="text" class="input-field" name="Username"><br></br>
            <input type="email" class="input-field" name="Email"><br></br>
            <input type="password" class="input-field" name="Password"><br></br>
            <!--<input type="password" class="input-field" name="Confirm"><br></br>-->
            <input id="button" type="submit" value="Sign Up"><br></br>
            <!--<div class="signup-card"></div>-->
        </form>

    </div>

</body>

</html>