<?php
session_start();
include 'connect_db.php';

$name = $_POST['name'];
$course_name = $_POST['course_name'];

// Check if the admin already has the course assigned
$sql_check = "SELECT * FROM assign_admin WHERE name = '$name' AND course_name = '$course_name'";
$result_check = $conn->query($sql_check);

if ($result_check && $result_check->num_rows > 0) {
    // If the course is already assigned to the admin, display a message
    echo "<script>alert('The course is already assigned to this admin.')</script>";
} else {
    // Get the ID of the admin from the admins table
    $sql_admin_id = "SELECT id FROM admins WHERE name = '$name'";
    $result_admin_id = $conn->query($sql_admin_id);

    if ($result_admin_id->num_rows > 0) {
        $row = $result_admin_id->fetch_assoc();
        $admin_id = $row['id'];

        // Insert the admin ID and course name into the assign_admin table
        $sql = "INSERT INTO assign_admin(admin_id, name, course_name) VALUES ('$admin_id', '$name', '$course_name')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('course assigned to admin sucessfully.!')</script>";
        } else {
            echo "Error assigning course: " . $conn->error;
        }
    } else {
        echo "Admin not found.";
    }
}
$conn->close();
?>
<script>
    //  alert("course assign to admin sucessfully.!");
    window.location.href = "assign_course_admin.php";
   
</script>