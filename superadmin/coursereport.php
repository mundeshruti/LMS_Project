<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u105084344_LMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Handle search functionality
if (isset($_POST['search_tutor'])) {
   $search_query = $_POST['search_box'];
   $search_sql = "SELECT * FROM create_course WHERE course_name LIKE '%$search_query%'";
   $result = $conn->query($search_sql);
} else {
   $sql = "SELECT * FROM create_course";
   $result = $conn->query($sql);
}


// Handle search functionality
// if (isset($_POST['search_tutor'])) {
//    $search_query = $_POST['search_box'];
//    $search_sql = "SELECT *, DATE_ADD(start_date, INTERVAL course_duration DAY) AS end_date FROM create_course WHERE course_name LIKE '%$search_query%'";
//    $result = $conn->query($search_sql);
// } else {
//    $sql = "SELECT *, DATE_ADD(start_date, INTERVAL course_duration DAY) AS end_date FROM create_course";
//    $result = $conn->query($sql);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Course Report</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

   <style>
      /* Header Styles */
      /* Add styles for header if needed */

      /* Sidebar Styles */
      /* Add styles for sidebar if needed */

      /* Main Content Styles */
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

      /* Options Section Styles */
      .options {
         margin-bottom: 20px;
      }

      .options .row {
         display: flex;
         flex-wrap: wrap;
         align-items: center;
      }

      .options .col-md-4 {
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

      /* Search Form Styles */
      .search-tutor {
         display: flex;
         margin-bottom: 15px;
      }

      .search-tutor input[type="text"] {
         width: 70%;
         padding: 8px;
         border: 1px solid #ccc;
         border-radius: 5px 0 0 5px;
         font-size: 16px;
      }

      .search-tutor button {
         width: 30%;
         background-color: #007bff;
         color: #fff;
         border: 1px solid #007bff;
         border-radius: 0 5px 5px 0;
         font-size: 16px;
         cursor: pointer;
      }

      .search-tutor button:hover {
         background-color: #0056b3;
      }

      .search-tutor input[type="text"]:focus,
      .search-tutor button:focus {
         outline: none;
      }

      /* Download Button Styles */
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

      /* Table Styles */
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

      /* Error Message Styles */
      .error-message {
         color: red;
         font-size: 14px;
         margin-top: 5px;
      }
   </style>
</head>

<body>
   <?php include 'header.php'; ?>
   <div class="main-content hide-content" id="studentReport">
      <h1>Course Report</h1>

      <div class="options">
         
      </div>
      <div class="table-responsive">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Sr No.</th>
                  <th>Course Name</th>
                  <th>Course Description</th>
                  <th>Course Duration</th>
                  <!-- <th>Start Date</th>
                  <th>End Date</th> -->

               </tr>
            </thead>
            <tbody>
               <?php
               if ($result && $result->num_rows > 0) {
                  $count = 1;
                  while ($row = $result->fetch_assoc()) {
                     echo "<tr>";
                     echo "<td>" . $count . "</td>";
                     echo "<td>" . $row['course_name'] . "</td>";

                     echo "<td>" . $row['course_description'] . "</td>";
                     echo "<td>" . $row['course_duration'] .' Days ' ."</td>";
                     // echo "<td>" . $row['start'] . "</td>";
                     // echo "<td>" . $row['end_date'] . "</td>";
                     echo "</tr>";
                     $count++;
                  }
               } else {
                  echo "<tr><td colspan='4'>No courses found</td></tr>";
               }
               ?>
            </tbody>
         </table>
      </div>
   </div>
   <?php include 'sidebar.php'; ?>
</body>
<script>
   document.getElementById("searchForm").addEventListener("submit", function (event) {
      var searchInput = document.getElementById("search_box").value;
      if (!searchInput) {
         document.getElementById("searchError").innerHTML = "Please enter a search query.";
         event.preventDefault();
      } else {
         document.getElementById("searchError").innerHTML = "";
      }
   });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
   function downloadPDF() {
      // Initialize jsPDF
      var doc = new jsPDF();

      // Get the table element
      var table = document.querySelector('.table');

      // Convert table to PDF
      doc.autoTable({ html: table });

      // Download the PDF
      doc.save('course_report.pdf');
   }
</script>

</html>