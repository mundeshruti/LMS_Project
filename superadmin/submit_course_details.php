<?php
include 'connect_db.php';
$course_name = $_POST['course_name'];
$course_day = $_POST['course_day'];
$course_description = $_POST['course_description'];
$course_link = $_POST['course_link'];
$practical_link = $_POST['practical_link'];

$sql="INSERT INTO course_details(course_name,course_description,course_day,course_link,practical_link) VALUES ('".$course_name."', '".$course_description."','".$course_day."','".$course_link."', '".$practical_link."')";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

mysqli_close($conn);
?>
<script> 
alert("Course details fill sucessfully.");
window.location.href = "course_details.php";
</script>
