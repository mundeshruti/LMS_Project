<?php
session_start();

// Retrieve data from the AJAX request
// if user_id is not found from sessin he will set the adminid as 1
$st_id = isset($_SESSION['st_id']) ? $_SESSION['st_id'] : '';

// Log received data for debugging
error_log("Received data: student_id=$st_id");

// Insert data into the notification_records table (replace 'your_connection_details' with your actual database connection details)
$conn = new mysqli("localhost", "root", "root123", "lms_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "update notification_records set is_read = 1 where student_id = $st_id and is_read = 0;";

$conn->query($query);

$conn->close();
?>
