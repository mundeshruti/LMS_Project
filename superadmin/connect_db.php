<?php

//session_start();

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     // Redirect to the login page
//     header("Location: index.php");
//     exit(); // Stop further execution
// }

$servername = "localhost";

// $username = "u105084344_LMS";
// $password = "Lms@4321";
$username="root";
$password= "";
$dbname = "u105084344_LMS";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>