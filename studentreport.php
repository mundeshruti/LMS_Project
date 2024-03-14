<?php

// Include your database connection file
include 'connect_db.php';

// Fetch data from the register_student table
$sql = "SELECT * FROM register_student";
$result = mysqli_query($conn, $sql);

if (isset($_POST['submit'])) {
   $from = $_POST['startDateSuperAdmin'];
   $to = $_POST['endDateSuperAdmin'];
   $sql = "SELECT * FROM register_student WHERE created_at >= '$from' AND created_at <= '$to'";
   $result = mysqli_query($conn, $sql);
}

if (isset($_POST['clear'])) {
   $sql = "SELECT * FROM register_student";
   $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Super Admin Report</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
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

   .options {
      display: flex;
      flex-wrap: wrap;
   }

   .options .col-md-4 {
      flex: 1;
      /* Each column takes up equal space */
      margin-right: 20px;
      /* Add some spacing between columns */
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
      margin-bottom: 20px;
      /* Add some spacing between rows */
   }

   .col-md-4 {
      width: calc(33.333% - 20px);
      /* Adjust width to fit three columns in a row */
      margin-right: 20px;
      /* Add some spacing between columns */
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
      margin-top: 21px;
    margin-left: -16px
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

   .btn {
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 18px;
      transition: all 0.3s ease;
   }

   .btn-primary {
      background-color: purple;
      color: #fff;
   }

   .btn-secondary {
      background-color: #6c757d;
      color: #fff;
   }

   .btn:hover {
      opacity: 0.8;
   }

   .button-container {
      display: flex;
      /* Use flexbox layout */
      justify-content: space-between;
      /* Distribute space between the buttons */
      align-items: flex-end;
   }

   .btn {
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
   }

   .btn-primary {

      color: #fff;
   }

   .btn-secondary {
      background-color: #6c757d;
      color: #fff;
   }

   .btn:hover {
      opacity: 0.8;
   }
</style>

<body>
   <?php include 'header.php'; ?>
   <!-- Super Admin Report -->
   <div class="main-content hide-content" id="studentReport">
      <!-- Include common report form -->
      <h1>Student Report</h1>
      <div class="row">
         <div class="col-md-4">
            <label for="search" class="form-label"><h2>Search:</h2></label>
            <div style="position: relative;">
               <input type="text" class="form-control" id="search" placeholder="Search..." onkeyup="searchAdmin()">
               <i class="fas fa-search"
                  style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
            </div>
         </div>
         <!-- <div class="download-btn">
            <a class="btn btn-primary" style="background-color: #FF033E"
               href="generate_pdf.php?from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>"
               target="_blank"><i class="fas fa-file-pdf";></i> </a>
         </div>
         <div class="download-btn">
            <a class="btn btn-success"
            style="background-color: #03C03C"
               href="generate_excel.php?from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>"
               target="_blank"><i class="fas fa-file-excel"></i> </a>
         </div> -->
      </div>

      <div class="options">
         <!-- Date Range Selector -->
         <form method="post" class="col-md-4" style="display: flex; gap: 20px" >
            <div>
               <label for="startDateSuperAdmin" class="form-label"><h2>Start Date:</h2></label>
               <input type="date" class="form-control" name="startDateSuperAdmin">
            </div>
            <div>
               <label for="endDateSuperAdmin" class="form-label"><h2>End Date:</h2></label>
               <input type="date" class="form-control" name="endDateSuperAdmin">
            </div>
            <br>
            <div class="button-container" style="gap: 5px;">
               <input type="submit" name="submit" value="Filter" class="btn btn-primary">
               <input type="submit" name="clear" value="Clear" class="btn btn-secondary">
            </div>

            <div class="download-btn"style=" margin-left: 27%;">
            <a class="btn btn-primary" style="background-color: #FF033E"
               href="generate_student_report.php?from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>"
               target="_blank"><i class="fas fa-file-pdf";></i> </a>
         </div>
         <div class="download-btn">
            <a class="btn btn-success"
            style="background-color: #03C03C"
               href="generate_excel.php?from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>"
               target="_blank"><i class="fas fa-file-excel"></i> </a>
         </div>

           
      </div>
      </form>
      <!-- Table -->
      <div class="table-responsive">
         <table class="table table-bordered" id="adminTable">
            <thead>
               <tr>
                  <th>Sr No.</th>
                  <th>Student Name</th>
                  <th>Student Email</th>
               </tr>
            </thead>
            <tbody>
               <?php

               // Initialize a variable to keep track of the serial number
               $serialNumber = 1;

               // Check if there are any rows returned
               
               if (mysqli_num_rows($result) > 0) {
                  // Loop through each row and populate the table
                  while ($row = mysqli_fetch_assoc($result)) {
                     echo "<tr>";
                     echo "<td>" . $serialNumber . "</td>";
                     echo "<td>" . $row['name'] . "</td>";
                     echo "<td>" . $row['email'] . "</td>";
                     echo "</tr>";

                     // Increment the serial number for the next row
                     $serialNumber++;
                  }
               } else {
                  // If no rows are returned
                  echo "<tr><td colspan='4'>No records found</td></tr>";
               }

               // Close the database connection
               mysqli_close($conn);
               ?>
            </tbody>
         </table>
      </div>
   </div>
   <?php include 'sidebar.php'; ?>
   <script>
      function searchAdmin() {
         var input, filter, table, tr, td, i, txtValue;
         input = document.getElementById("search");
         filter = input.value.toUpperCase();
         table = document.getElementById("adminTable");
         tr = table.getElementsByTagName("tr");
         for (i = 0; i < tr.length; i++) {
            tdName = tr[i].getElementsByTagName("td")[1]; // index 1 for name column
            tdEmail = tr[i].getElementsByTagName("td")[2]; // index 2 for email column
            if (tdName || tdEmail) {
               txtValueName = tdName.textContent || tdName.innerText;
               txtValueEmail = tdEmail.textContent || tdEmail.innerText;
               if (txtValueName.toUpperCase().indexOf(filter) > -1 || txtValueEmail.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
               } else {
                  tr[i].style.display = "none";
               }
            }
         }
      }
      window.onload = function () {
         searchAdmin();
      };

      // Function to download report
      function downloadReport(format, tableId) {
         var table = document.getElementById(tableId);
         var startDate = document.getElementById('startDateSuperAdmin').value;
         var endDate = document.getElementById('endDateSuperAdmin').value;

         if (format === 'pdf') {
            window.location.href = 'generate_pdf.php?from=' + startDate + '&to=' + endDate;
         } else if (format === 'excel') {
            window.location.href = 'generate_excel.php?from=' + startDate + '&to=' + endDate;
         }
      }
   </script>
   <script src="js/script.js"></script>

   </script>
</body>

</html>