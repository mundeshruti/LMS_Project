<?php
$servername = "localhost";
$username = "root";
$password = "";
// $username = "u105084344_LMS";
// $password = "Lms@4321";
// $dbname = "u105084344_LMS";
$dbname = "lms_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
