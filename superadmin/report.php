<!DOCTYPE html>
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
   <?php include 'header.php'; ?>

   <!-- Student Report -->
   <div class="main-content hide-content" id="studentReport">
      <!-- Include common report form -->
      <h1>Admin Report</h1>
      <div class="options">
         <!-- Date Range Selector -->
         <div class="row">
            <div class="col-md-4">
               <label for="startDateStudent" class="form-label">Start Date:</label>
               <input type="date" class="form-control" id="startDateStudent" name="startDateStudent">
            </div>
            <div class="col-md-4">
               <label for="endDateStudent" class="form-label">End Date:</label>
               <input type="date" class="form-control" id="endDateStudent" name="endDateStudent">
            </div>
            <div class="download-btn">
               <button class="btn btn-primary" onclick="downloadReport('pdf', 'adminReport')"><i
                     class="fas fa-file-pdf"></i></button>
            </div>
            <br>
            <div class="download-btn">
               <button class="btn btn-success" onclick="downloadReport('excel', 'adminReport')"><i
                     class="fas fa-file-excel"></i></button>
            </div>
            <br>
            <br>
            <br>
            <div class="col-md-4">
               <label for="search" class="form-label">Search:</label>
               <input type="text" class="form-control" id="search" placeholder="Search...">
            </div>
         </div>
      </div>

      <!-- Table -->
      <div class="table-responsive">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Sr No.</th>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Address</th>
                  <th>Date Time</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               // Your PHP code to populate table rows with actual data goes here
               ?>
            </tbody>
         </table>
      </div>
   </div>

   <?php include 'sidebar.php'; ?>
</body>

</html>