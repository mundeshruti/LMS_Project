<?php
  $servername = "localhost";
  $username = "u105084344_LMS";
  $password = "Lms@4321";
  $dbname = "u105084344_LMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// upload file

