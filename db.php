<?php
$host = "localhost";
$user = "root"; // default XAMPP user
$pass = "";     // default XAMPP password
$dbname = "user_form";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
