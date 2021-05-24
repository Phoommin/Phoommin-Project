<?php
session_start();
$servername = "it2.sut.ac.th";
$username = "cms61_g07";
$password = "414877";
$database = "cms61_g07";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($conn,"utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>