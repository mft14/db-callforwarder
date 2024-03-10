<?php
$servername = "localhost";
$username = "3cx";
$password = "password";
$dbname = "3cx";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
