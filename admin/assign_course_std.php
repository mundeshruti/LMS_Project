<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

        // Insert the student ID and course name into the admin_student_course table
        $sql = "INSERT INTO admin_student_course (student_id, name, course_name) VALUES ('$student_id', '$name', '$course_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('The course assigned to this student.')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
