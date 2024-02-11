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

$coursename = $_POST['coursename'];
$date = $_POST['date'];
$coursedescription = $_POST['coursedescription'];
$courselink = $_POST['courselink'];
$practicallink = $_POST['practicallink'];

// Check if the course already exists in stdcourse table
$check_sql = "SELECT id FROM stdcourse WHERE coursename = '$coursename' LIMIT 1";
$check_result = $conn->query($check_sql);

// Fetch student IDs with the selected course name
$sql = "SELECT id FROM register_student WHERE profession = '$coursename'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['id'];
        // Insert course details for each student with the selected course name
        $insert_sql = "INSERT INTO stdcourse (student_id, coursename, date, coursedescription, courselink, practicallink) VALUES ('$student_id', '$coursename', '$date', '$coursedescription', '$courselink', '$practicallink')";
        if ($conn->query($insert_sql) !== TRUE) {
            echo "Error assigning course: " . $conn->error;
        }
    }
} else {
    echo "No students found for the selected course name.";
}

$conn->close();
?>
<script>
   alert("Course assigned to students successfully.");
   window.location.href = "stdcourses.php";
</script>
