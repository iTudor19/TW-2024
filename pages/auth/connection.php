<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "bd_final";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect:(");
}