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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['course_id'])) {
   $course_id = $_GET['course_id'];
   $student_id = $_SESSION['st_id'];

   // Check if the course belongs to the logged-in student
   $sql = "SELECT * FROM stdcourse WHERE id = $course_id AND student_id = $student_id";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      // Course found, display edit form
      $row = $result->fetch_assoc();
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
         <meta charset="UTF-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Edit Course</title>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
         <link rel="stylesheet" href="css/style.css">
         <style>
            .button {
               background-color: #04AA6D;
               border: none;
               color: white;
               padding: 5px 10px;
               text-align: center;
               text-decoration: none;
               display: inline-block;
               font-size: 12px;
               cursor: pointer;
            }
         </style>
      </head>
      <body>
         <?php include 'header.php'; ?>
         <section>
            <h1 style="font-size:x-large">Edit Course</h1>
            <br>
            <form action="update_course.php" method="post" enctype="multipart/form-data">
               <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
               <label for="uploadfile">Select file to upload:</label>
               <input type="file" id="uploadfile" name="uploadfile" required>
               <button class="button" type="submit">Submit</button>
            </form>
         </section>
         <?php include 'sidebar.php'; ?>
      </body>
      </html>
      <?php
   } else {
      echo "You are not authorized to edit this course.";
   }
} else {
   echo "Invalid request.";
}

$conn->close();
?>
