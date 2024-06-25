<?php

session_start();

if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}

header('location: ../auth/signin.php');