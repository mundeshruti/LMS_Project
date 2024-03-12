<?php
 $servername = "localhost";
  // $username = "u105084344_LMS";
  // $password = "Lms@4321";
  $username="root";
$password="";
  $dbname = "u105084344_LMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>