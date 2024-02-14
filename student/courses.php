<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "lms_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['st_id'])) {
   $student_id = $_SESSION['st_id'];
   
   // Select the first unfinished course for the student
   $unfinished_sql = "SELECT * FROM stdcourse WHERE student_id = '$student_id' AND is_completed = 0 ORDER BY date LIMIT 1";
   $unfinished_result = $conn->query($unfinished_sql);

   // Select all completed courses for the student
   $completed_sql = "SELECT * FROM stdcourse WHERE student_id = '$student_id' AND is_completed = 1 ORDER BY date";
   $completed_result = $conn->query($completed_sql);

   if ($unfinished_result->num_rows > 0) {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
         <meta charset="UTF-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>courses</title>
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
            table {
               width: 100%;
               border-collapse: collapse;
               font-size: medium;
            }
            th, td {
               border: 1px solid #ddd;
               padding: 8px;
               text-align: left;
            }
            th {
               background-color: #f2f2f2;
            }
            form {
               margin: 0;
            }
            input[type="file"] {
               display: inline-block;
               margin-bottom: 10px;
            }
            input[type="submit"] {
               background-color: #4caf50;
               color: white;
               padding: 8px 12px;
               border: none;
               border-radius: 4px;
               cursor: pointer;
            }
            input[type="submit"]:hover {
               background-color: #45a049;
            }
            @media screen and (max-width: 600px) {
               table {
                  border: 0;
               }
               table thead {
                  display: none;
               }
               table tbody tr {
                  border: 1px solid #ddd;
                  margin-bottom: 10px;
                  display: block;
               }
               table tbody td {
                  display: block;
                  text-align: center;
               }
               input[type="file"], input[type="submit"] {
                  width: 100%;
               }
            }
         </style>
         <script>
    function editCourse(courseId) {
       // Redirect to edit_course.php with the course ID as a URL parameter
       window.location = 'edit_course.php?course_id=' + courseId;
    }
</script>

      </head>
      <body>
         <?php include 'header.php'; ?>
         <section>
            <h1 style="font-size:x-large">Courses</h1>
            <br>
            <table>
               <thead>
                  <tr>
                     <th scope="col">Course Name</th>
                     <th scope="col">Course Day</th>
                     <th scope="col">Course Description</th>
                     <th scope="col">Course Link</th>
                     <th scope="col">Practical</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  // Display the first unfinished course
                  while ($row = $unfinished_result->fetch_assoc()) {
                     echo "<tr>
                           <td>" . $row["coursename"] . "</td>
                           <td>" . $row["date"] . "</td>
                           <td>" . $row["coursedescription"] . "</td>
                           <td><a href='" . $row["courselink"] . "' target='_blank'>" . $row["courselink"] . "</a></td>
                           <td><a href='" . $row["practicallink"] . "' target='_blank'>" . $row["practicallink"] . "</a></td>";
                     echo "<td>
                              <form action='submit_course.php' method='post' enctype='multipart/form-data'>
                                 <input type='hidden' name='course_id' value='" . $row["id"] . "'> <!-- Add hidden input for course_id -->
                                 <input type='file' id='uploadfile' name='uploadfile' required />
                                 <button class='button'>Submit</button>
                              </form>
                           </td>";
                     echo "</tr>";
                  }
                  
                  // Display all completed courses
                  while ($row = $completed_result->fetch_assoc()) {
                     echo "<tr>
                           <td>" . $row["coursename"] . "</td>
                           <td>" . $row["date"] . "</td>
                           <td>" . $row["coursedescription"] . "</td>
                           <td><a href='" . $row["courselink"] . "' target='_blank'>" . $row["courselink"] . "</a></td>
                           <td><a href='" . $row["practicallink"] . "' target='_blank'>" . $row["practicallink"] . "</a></td>";
                     echo "<td>Completed <button class='button' onclick='editCourse(" . $row['id'] . ")'>Edit</button></td>";
                     echo "</tr>";
                  }
                  ?>
               </tbody>
            </table>
         </section>
         <?php include 'sidebar.php'; ?>
      </body>
      </html>
      <?php
   } else {
      echo "<script>window.location = 'courses.php';</script>";
      echo "<script>alert('No unfinished courses found for the logged-in student.');</script>";
    
   }
} else {
   echo "Student ID not set in session.";
}

$conn->close();
?>
