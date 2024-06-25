<?php
session_start();
include ("connection.php");
include ("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Parola'];
    if (!empty($email) && !empty($password)) { 
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: indexRO.php");
                    die;
                }
            }
        }
        echo "parola sau mail gresit!";
    } else {
        echo "Va rugam introduceti un mail valid!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoXhome</title>
    <link rel="stylesheet" href="signinstyles.css">
</head>

<body>

    <header>
        <a href="../homepage/home.html" style="text-decoration: none;">
            <h1>MoX</h1>
        </a>
        <a href="/signinRo.php" style="text-decoration: none;">
            <button class="lang-button">en</button>
        </a>
    </header>

    <div class="background-container">
        <p class="p0">Conecteaza-te!</p>
        <p class="p1">Nu ai cont?</p>
        <a href="signupRO.php" style="text-decoration: none;">
            <p class="p2">Inregistreaza-te!</p>
        </a>
        <form method="post">
            <input type="email" class="input-field" name="Email"><br></br>
            <input type="password" class="input-field" name="Parola"><br></br>
            <input id="button" type="submit" value="Conecteaza-te"><br></br>
        </form>
    </div>


</body>

</html>