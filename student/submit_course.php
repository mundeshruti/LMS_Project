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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Check if student_id is set in $_SESSION
   if (isset($_POST['course_id']) && isset($_SESSION['st_id'])) {
      // Retrieve data from the form
      $course_id = $_POST['course_id'];
      $student_id = $_SESSION['st_id'];
      
      // Process the uploaded file
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
      
      if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
         // File uploaded successfully, update the database
         $sql = "UPDATE stdcourse SET is_completed = 1, submission_file = '$target_file' WHERE id = $course_id AND student_id = $student_id";
         
         if ($conn->query($sql) === TRUE) {
             // Update successful
             echo "<script>alert('Course submitted successfully!');</script>";
             // Redirect to courses.php after showing the alert
             echo "<script>window.location = 'courses.php';</script>";
             exit; // Ensure no more output is sent
         } else {
            echo "Error updating record: " . $conn->error;
         }
      } else {
         echo "Sorry, there was an error uploading your file.";
      }
   } else {
      // Handle case where course_id or student_id is not set
      echo "Course ID or Student ID is not set.";
   }
}

$conn->close();
?>
