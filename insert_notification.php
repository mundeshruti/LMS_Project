<?php
// Retrieve data from the AJAX request
$adminId = $_POST['admin_id'];
$courseId = $_POST['course_id'];
$message = $_POST['message'];

// Insert data into the notification_records table (replace 'your_connection_details' with your actual database connection details)
$servername = "localhost";
$username = "u105084344_LMS";
$password = "Lms@4321";
$dbname = "u105084344_LMS";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO notification_records (admin_id, course_id, message) VALUES ('$adminId', '$courseId', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Notification inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
