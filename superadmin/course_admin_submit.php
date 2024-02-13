<?php
include 'connect_db.php';
$admins_name = $_POST['admins_name'];
$course_name = $_POST['course_name'];


$sql="INSERT INTO assign_admin(admins_name, course_name) VALUES ('".$admins_name."', '".$course_name."')";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

mysqli_close($conn);
?>
<script> 
alert("Assign Course sucessfully.");
window.location.href = "assign_course_admin.php";
</script>
