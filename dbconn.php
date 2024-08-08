<?php
// Database configuration
$hostname = "localhost";
$username = "root";
$password = "";
$database = "smokedb";

$dbconn = mysqli_connect($hostname, $username, $password, $database);
if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
