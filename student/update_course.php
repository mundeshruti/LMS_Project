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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
   $course_id = $_POST['course_id'];
   $student_id = $_SESSION['st_id'];

   // Check if the course belongs to the logged-in student
   $sql = "SELECT * FROM stdcourse WHERE id = $course_id AND student_id = $student_id";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      // Course found, process the uploaded file
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);

      if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
         // File uploaded successfully, update the database
         $sql_update = "UPDATE stdcourse SET submission_file = '$target_file' WHERE id = $course_id AND student_id = $student_id";

         if ($conn->query($sql_update) === TRUE) {
            // Update successful
            echo "<script>alert('Course updated successfully!');</script>";
            echo "<script>window.location = 'courses.php';</script>";
         } else {
            echo "Error updating record: " . $conn->error;
         }
      } else {
         echo "Sorry, there was an error uploading your file.";
      }
   } else {
      echo "You are not authorized to update this course.";
   }
} else {
   echo "Invalid request.";
}

$conn->close();
?>
