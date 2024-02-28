<?php
session_start();
include 'connect_db.php';

$name = $_POST['name'];
$course_name = $_POST['course_name'];

// Check if the course is already assigned to the student
$sql_check = "SELECT * FROM admin_student_course WHERE name = '$name' AND course_name = '$course_name'";
$result_check = $conn->query($sql_check);

if ($result_check && $result_check->num_rows > 0) {
    // If the course is already assigned to the student, display a message
    echo "<script>alert('The course is already assigned to this student.')</script>";
} else {
    // Get the ID of the student from the register_student table
    $sql_student_id = "SELECT id FROM register_student WHERE name = '$name'";
    $result_student_id = $conn->query($sql_student_id);

    if ($result_student_id->num_rows > 0) {
        $row = $result_student_id->fetch_assoc();
        $student_id = $row['id'];

        // Fetch all course details for the specified course name
        $sql_course_details = "SELECT * FROM course_details WHERE course_name = '$course_name'";
        $result_course_details = $conn->query($sql_course_details);

        if ($result_course_details->num_rows > 0) {
            // Initialize a variable to track if the message has been echoed
            $message_echoed = false;

            // Loop through each course detail
            while ($course_detail = $result_course_details->fetch_assoc()) {
                $course_id = $course_detail['id'];
                $course_description = $course_detail['course_description'];
                $course_day = $course_detail['course_day'];
                $course_link = $course_detail['course_link'];
                $practical_link = $course_detail['practical_link'];

                // Insert course details along with student information
                $sql_insert = "INSERT INTO admin_student_course (course_id, course_description, course_day, course_link, practical_link, completed, uploaded_file, student_id, name, course_name) VALUES ('$course_id', '$course_description', '$course_day', '$course_link', '$practical_link', '0', '', '$student_id', '$name', '$course_name')";

                if ($conn->query($sql_insert) === TRUE && !$message_echoed) {
                    echo "<script>alert('The course assigned to student sucessfully .')</script>";
                    $message_echoed = true; // Set the flag to true after echoing the message
                } elseif (!$message_echoed) {
                    echo "Error: " . $sql_insert . "<br>" . $conn->error;
                }
            }
        } else {
            echo "No course details found for the specified course name.";
        }
    } else {
        echo "Student not found.";
    }
}

$conn->close();
?>
<script>
    window.location.href = "stdcourses.php";
</script>
