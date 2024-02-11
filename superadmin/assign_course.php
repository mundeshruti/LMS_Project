<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}
$coursename = $_POST['coursename'];
$date = $_POST['date'];
$coursedescription = $_POST['coursedescription'];
$courselink=$_POST['courselink'];
$practicallink=$_POST['practicallink'];

$sql="INSERT INTO courses(coursename,date,coursedescription,courselink,practicallink) VALUES ('".$coursename."', '".$date."', '".$coursedescription."','".$courselink."', '".$practicallink."')";

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

