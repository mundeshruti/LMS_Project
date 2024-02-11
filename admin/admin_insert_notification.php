<?php
// Retrieve data from the AJAX request
//TODO: Pass the logged in user_id(admin_id) from session.
$adminId = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$courseId = $_POST['course_id'];
$message = $_POST['message'];



// Log received data for debugging
error_log("Received data: admin_id=$adminId, course_id=$courseId, message=$message");

// Insert data into the notification_records table (replace 'your_connection_details' with your actual database connection details)
$conn = new mysqli("localhost", "root", "", "lms_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO notification_records (admin_id, course_id, message, is_createdby_admin, created_at, updated_at) 
        VALUES ('$adminId', '$courseId', '$message', 1, NOW(), NOW() )";

if ($conn->query($sql) === TRUE) {
    echo "Notification inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
