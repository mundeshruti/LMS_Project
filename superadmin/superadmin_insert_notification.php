<?php
// Retrieve data from the AJAX request
//TODO: Pass the logged in user_id(admin_id) from session.
$adminId = $_POST['admin_id'];
$courseId = $_POST['course_id'];
$message = $_POST['message'];

// Log received data for debugging
error_log("Received data: admin_id=$adminId, course_id=$courseId, message=$message");

// Insert data into the notification_records table (replace 'your_connection_details' with your actual database connection details)
$conn = new mysqli("localhost", "root", "", "lms_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($adminId == 0 && $courseId == 0){
    $student_ids_query = "SELECT id FROM register_student;";
}
else if ($adminId == 0 && $courseId != 0){
    $student_ids_query = "SELECT id FROM register_student WHERE active_course_id = $courseId;";
}
else if ($adminId != 0 && $courseId == 0){
    $student_ids_query = "SELECT id FROM register_student WHERE created_by = $adminId;";
}else if($adminId != 0 && $courseId != 0){
    $student_ids_query = "SELECT id FROM register_student WHERE created_by = $adminId and active_course_id = $courseId;";
}
$student_ids_result = $conn->query($student_ids_query);


if ($student_ids_result) {
    // Insert into the notification table
    $sql = "INSERT INTO notification (admin_id, course_id, message, is_createdby_superadmin, created_at, updated_at) 
            VALUES ('$adminId', '$courseId', '$message', 1, NOW(), NOW() )";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the ID of the inserted notification
        $notification_id = $conn->insert_id;

        // Loop through student IDs and insert into notification_records
        while ($row = $student_ids_result->fetch_assoc()) {
            $student_id = $row['id'];
            $notification_record_sql = "INSERT INTO notification_records (notification_id, student_id) 
                                        VALUES ('$notification_id', '$student_id')";

            // Execute the query to insert into notification_records
            if (!$conn->query($notification_record_sql)) {
                echo "Error inserting notification record: " . $conn->error;
                // Rollback the transaction if an error occurs
                $conn->rollback();
                exit(); // Exit the script
            }
        }

        echo "Notification send successfully";
    } else {
        echo "Error inserting notification: " . $conn->error;
    }
} else {
    echo "Error fetching student IDs: " . $conn->error;
}

$conn->close();
?>
