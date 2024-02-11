<?php
// Retrieve data from the AJAX request
$adminId = $_POST['admin_id'];
$courseId = $_POST['course_id'];
$message = $_POST['message'];

// Insert data into the notification_records table (replace 'your_connection_details' with your actual database connection details)
$conn = new mysqli("localhost", "root", "", "lms_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO notification_records (admin_id, course_id, message) VALUES ('$adminId', '$courseId', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Notification inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
