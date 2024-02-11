<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>courses</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
   body {
      font-family: 'Nunito', sans-serif;
      font-size: large;
   }

   #courseAssignment {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 500px;
      margin: 20px auto;
   }

   #courseAssignment h2 {
      text-align: center;
      color: #333;
   }

   #assignmentForm {
      display: flex;
      flex-direction: column;
   }

   label {
      margin-bottom: 8px;
   }

   select,
   input,
   button {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
   }

   button {
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
      border: none;
      border-radius: 4px;
   }

   button:hover {
      background-color: #45a049;
   }

   #course-form h2 {
      text-align: center;
   }

   select,
   input,
   button {
      margin-top: 10px;
   }

   #course-form label {
      display: block;
      margin-bottom: 8px;
   }

   #course-form select,
   #course-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
   }

   #assign-admin {
      border: 1px solid black;
   }

   #link {
      border: 1px solid black;
   }

   #course-form button {
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
   }

   #course-form button:hover {
      background-color: #0056b3;
   }
</style>

<body>

<?php include 'header.php'; ?>

    <!-- Menu Section -->
    <div id="courseAssignment">
      <h2>Assign Courses to Students</h2>
      <br>
      <form action="assign_course_std.php" id="assignmentForm" method="POST">
         <div id="course-form">
         <label for="coursename">Course Name:</label>
            <select name="coursename" id="link" required>
               <option value="" disabled selected>-- Select Course Name --</option>
               <?php
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "lms_db";

               // Create connection
               $conn = new mysqli($servername, $username, $password, $dbname);
               // Check connection
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               }

               // Fetch unique course names from register_students table
               $sql = "SELECT DISTINCT profession FROM register_student";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                   while ($row = $result->fetch_assoc()) {
                       echo "<option value='" . $row['profession'] . "'>" . $row['profession'] . "</option>";
                   }
               }

               $conn->close();
               ?>
            </select>
            <br>
            <label for="link">Course Date:</label>
            <input type="date" name="date" id="link" required>
            <br>
            <label for="link">Course Description:</label>
            <textarea name="coursedescription" id="link" placeholder="Enter Course Description" required></textarea>
            <br>
            <label for="link">Course Link:</label>
            <input type="text" name="courselink" id="link" placeholder="Enter Course Link" required>
            <br>
            <label for="link">Practical Link:</label>
            <input type="text" name="practicallink" id="link" placeholder="Enter Practical Link" required>
            <br>
            <button type="submit" class="inline-btn">Assign Course</button>
         </div>
      </form>

      <?php include 'sidebar.php'; ?>



</body>

</html>