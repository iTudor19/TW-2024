<?php
session_start();
include("connection.php");
include("functions.php");
$message = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    if (!empty($email) && !empty($password)) {
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
                    $_SESSION['id'] = $user_data['id'];
                    header("Location: ../getstartedpage/getstartedlogged.php");
                    die;
                }
            }
        }
        $message = "wrong email or password!";
    } else {
        $message = "Please enter some valid information!";
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
    <script>
        window.onload = function() {
            var message = "<?php echo $message; ?>";
            if (message) {
                alert(message);
            }
        }
    </script>
</head>

<body>

    <header>
        <a href="../homepage/home.php" style="text-decoration: none;">
            <h1>MoX</h1>
        </a>
        <a href="../signinpageUserRo/signinRo.php" style="text-decoration: none;">
            <button class="lang-button">en</button>
        </a>
    </header>

    <div class="background-container">
        <p class="p0">Sign In</p>
        <p class="p1">Don't have an account?</p>
        <a href="../auth/signup.php" style="text-decoration: none;">
            <p class="p2">Sign Up!</p>
        </a>
        <form method="post">
            <input type="email" class="input-field" name="Email" placeholder="Email"><br>
            <input type="password" class="input-field" name="Password" placeholder="Password">
            <input id="button" type="submit" class="signin-button" value="Sign In">
            <div class="signin-card"></div>
        </form>
    </div>

</body>

</html>
