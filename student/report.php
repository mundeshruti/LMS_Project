<?php
session_start();

// Assuming you have a database connection established in 'db_connection.php'
include 'connect_db.php';

$st_id = $_SESSION['st_id'];
$st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
$user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';
$user_image = isset($_SESSION['st_image']) ? $_SESSION['st_image'] : '';

?><!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Report</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* Student Report Styles */
      #studentReport {
         background-color: #ffffff;
         padding: 20px;
         margin-bottom: 20px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      #studentReport h1 {
         font-size: 24px;
         margin-bottom: 20px;
         color: #333;
      }

      .options {
         margin-bottom: 20px;
      }

      .options .row {
         display: flex;
         flex-wrap: wrap;
      }

      .options .row .col-md-4 {
         width: 25%;
         padding: 0 10px;
         margin-bottom: 15px;
      }

      .options label {
         font-weight: bold;
         display: block;
         margin-bottom: 5px;
         color: #555;
      }

      .options input[type="date"],
      .options input[type="text"] {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 16px;
      }

      .table-responsive {
         overflow-x: auto;
      }

      .table {
         width: 100%;
         border-collapse: collapse;
         font-size: 16px;
      }

      .table th,
      .table td {
         padding: 10px;
         border: 1px solid #ccc;
         text-align: center;
      }

      .table th {
         background-color: #343a40;
         color: #fff;
      }

      .table tbody tr:nth-child(even) {
         background-color: #f2f2f2;
      }

      .row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px; /* Add some spacing between rows */
}

.col-md-4 {
    width: calc(33.333% - 20px); /* Adjust width to fit three columns in a row */
    margin-right: 20px; /* Add some spacing between columns */
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.download-btn {
    margin-top: 10px;
}

.download-btn button {
    padding: 8px 15px;
    margin-top: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease;
}

.download-btn button i {
    margin-right: 5px;
}

.download-btn button:hover {
    opacity: 0.8;
}

/* Adjust button colors according to your theme */
.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
}

   </style>
</head>

<body>
<?php
   //session_start();

   // Assuming you have a database connection established in 'db_connection.php'
   include 'connect_db.php';

   // Initialize variables
   $st_id = isset($_SESSION['st_id']) ? $_SESSION['st_id'] : '';
   $st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
   $user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';

   // Handle student search
   if (isset($_POST['search_student'])) {
      $searchKeyword = $_POST['search_box'];
      $sql = "SELECT * FROM admin_student_course WHERE name LIKE '%$searchKeyword%'";
      $result = $conn->query($sql);
   } else {
      // Fetch all student data from the database
      $sql = "SELECT * FROM admin_student_course";
      $result = $conn->query($sql);
   }

   ?>
   <?php include 'header.php'; ?>

   <!-- Student Report -->
   <div class="main-content hide-content" id="studentReport">
      <!-- Include common report form -->
      <h1>Student Report</h1>
      <div class="options">
      </div>

      <!-- Table -->
      <div class="table-responsive">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Sr No.</th>
                  <th>Course Name</th>
                  <th>Course Description</th>
                  <th>Course Duration</th>
                  <th>Course Day</th>
                  <th>Course Status</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $sql = "SELECT * FROM admin_student_course WHERE student_id = '$st_id'";
               $result = $conn->query($sql);

               if ($result && $result->num_rows > 0) {
                  $count = 1;
                  while ($row = $result->fetch_assoc()) {
                     echo "<tr>";
                     echo "<td>" . $count . "</td>";
                     echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
                  
                     echo "<td>" . htmlspecialchars($row['course_description']) . "</td>";
                   

                     // Retrieve the course duration for the current course
                     $course_name = $row['course_name'];
                     $sql_duration = "SELECT course_duration FROM create_course WHERE course_name = '$course_name'";
                     $result_duration = $conn->query($sql_duration);

                     // Display course duration
                     if ($result_duration && $result_duration->num_rows > 0) {
                        $row_duration = $result_duration->fetch_assoc();
                        $course_duration = htmlspecialchars($row_duration['course_duration']) . ' Days';
                        echo "<td>" . $course_duration . "</td>";
                     } else {
                        echo "<td>N/A</td>"; // If no duration found
                     }
                     echo "<td>" .'Day ' . htmlspecialchars($row['course_day']) . "</td>";
                     // echo "<td>" . htmlspecialchars($row['completed']) . "</td>";
                      // Convert 'completed' value to appropriate text
                      $status = ($row['completed'] == 1) ? 'Completed' : 'Pending';
                      echo "<td>" . $status . "</td>";
 
                      // Retrieve the course duration for the current course
                      $course_name = $row['course_name'];
                      $sql_duration = "SELECT course_duration FROM create_course WHERE course_name = '$course_name'";
                      $result_duration = $conn->query($sql_duration);
                      $count++;
                   }
                } else {
                   echo "<tr><td colspan='6'>No courses assigned to this student.</td></tr>";
                }
                ?>
            </tbody>
         </table>
      </div>
   </div>

   <?php include 'sidebar.php'; ?>
</body>

</html>