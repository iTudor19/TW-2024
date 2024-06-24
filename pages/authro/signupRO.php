<?php
session_start();
include ("connection.php");
include ("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted 
    $username = $_POST['Nume'];
    $email = $_POST['Email'];
    $password = $_POST['Parola'];
    $confirm = $_POST['Confirma'];
    //$confirmpassword = $_POST['Confirm Password'];
    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm) && $password == $confirm) {
        //save to database 
        $user_id = random_num(20);
        $query = "insert into users (user_id,username,email,password) values ('$user_id','$username','$email','$password')";
        mysqli_query($con, $query);
        header("Location: signinRO.php");
        die;
    } else {
        echo "Va rugam introduceti date valide!";
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
        <a href="signup.html" style="text-decoration: none;">
            <button class="lang-button">ro</button>
        </a>
    </header>

    <div class="background-container">
        <p class="p0">Creeaza cont</p>
        <p class="p1">Deja ai cont?</p>
        <a href="signinRO.php" style="text-decoration: none;">
            <p class="p2">Conecteaza-te!</p>
        </a>

        <form method="post">
            <input type="text" class="input-field" name="Nume"><br></br>
            <input type="email" class="input-field" name="Email"><br></br>
            <input type="password" class="input-field" name="Parola"><br></br>
            <input type="password" class="input-field" name="Confirma"><br></br>
            <!--<input type="password" class="input-field" name="Confirm"><br></br>-->
            <input id="button" type="submit" value="Inregistreaza-te"><br></br>
            <!--<div class="signup-card"></div>-->
        </form>

    </div>

</body>

</html>