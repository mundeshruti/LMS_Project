<?php
include 'connect_db.php';
$coursename = $_POST['coursename'];
$coursedescription = $_POST['coursedescription'];
$courselink=$_POST['courselink'];
$practicallink=$_POST['practicallink'];

$sql="INSERT INTO courses(coursename,coursedescription,courselink,practicallink) VALUES ('".$coursename."', '".$coursedescription."','".$courselink."', '".$practicallink."')";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

mysqli_close($conn);
?>
<script> 
alert("Course Assign to admin sucessfully.");
window.location.href = "courses.php";
</script>

