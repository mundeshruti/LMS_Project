<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <title>Super admin report</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
    body {
      font-family: Arial, sans-serif;
      font-size: medium;
      /* margin: 0;
      padding: 0;
      background-color: #f4f4f4; */
    }

    header {
      background-color: #943278;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    section {
      display: flex;
      justify-content: space-around;
      padding: 20px;
    }

    .report-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 45%;
    }

    .download-options {
      margin-top: 20px;
    }

    button {
      padding: 10px;
      margin: 5px;
      cursor: pointer;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 4px;
    }

    .download-options label {
      margin-right: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f14bc2;
      color: #fff;
    }
  </style>
</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo">RSL Learning Management System </a>

      <!-- <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form> -->

      <div class="icons">
         <div id="notification-btn" class="fa-regular fa-bell"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

     
   <div class="profile">
      <img src="images/pic-1.jpg" class="image" alt="">
      <p class="role">Super Admin </p>
         <a href="profile.php" class="btn">view profile</a>
         <div class="flex-btn">
          <a href="../index.php" class="option-btn">logout</a>
         </div>
      </div>

   </section>

</header>   

<section class="practical">

 <section>
    <div class="report-container">
      <h1>Admin Wise Report</h1>
      <label for="adminDate">Select Date:</label>
      <input type="date" id="adminDate" onchange="loadAdminReport()">
      <div id="adminReportTable"></div>
      <div class="download-options">
        <label>Download as:</label>
        <button onclick="downloadReport('admin', 'pdf')"class="btn">Download as PDF</button>
        <button onclick="downloadReport('admin', 'excel')"class="btn">Download as Excel</button>
      </div>
    </div>

    <div class="report-container">
      <h3>Student Report</h3>
      <label for="studentDate">Select Date:</label>
      <input type="date" id="studentDate" onchange="loadStudentReport()">
      <div id="studentReportTable"></div>
      <div class="download-options">
        <label>Download as:</label>
        <button onclick="downloadReport('student', 'pdf')"class="btn">Download as PDF</button>
        <button onclick="downloadReport('student', 'excel')"class="btn">Download as Excel</button>
      </div>
    </div>
  </section>

  <script>
    // Simulated data
    const adminReportData = [
      { id: 1, name: 'Admin 1', date: '2024-01-12', value: 100 },
      { id: 2, name: 'Admin 2', date: '2024-01-12', value: 150 },
      // Add more data as needed
    ];

    const studentReportData = [
      { id: 1, name: 'Student 1', date: '2024-01-12', grade: 'A' },
      { id: 2, name: 'Student 2', date: '2024-01-12', grade: 'B' },
      // Add more data as needed
    ];

    function loadAdminReport() {
      const selectedDate = document.getElementById('adminDate').value;
      const filteredData = adminReportData.filter(entry => entry.date === selectedDate);
      displayReportTable(filteredData, 'adminReportTable');
    }

    function loadStudentReport() {
      const selectedDate = document.getElementById('studentDate').value;
      const filteredData = studentReportData.filter(entry => entry.date === selectedDate);
      displayReportTable(filteredData, 'studentReportTable');
    }

    function displayReportTable(data, tableId) {
      const tableContainer = document.getElementById(tableId);
      if (data.length > 0) {
        const table = document.createElement('table');
        const headerRow = table.insertRow(0);
        for (const key in data[0]) {
          const th = document.createElement('th');
          th.textContent = key.toUpperCase();
          headerRow.appendChild(th);
        }
        for (const entry of data) {
          const row = table.insertRow(-1);
          for (const key in entry) {
            const cell = row.insertCell(-1);
            cell.textContent = entry[key];
          }
        }
        tableContainer.innerHTML = '';
        tableContainer.appendChild(table);
      } else {
        tableContainer.innerHTML = '<p>No data available for the selected date.</p>';
      }
    }

    function downloadReport(type, format) {
      const selectedDate = type === 'admin' ? document.getElementById('adminDate').value : document.getElementById('studentDate').value;
      const data = type === 'admin' ? adminReportData : studentReportData;
      const filteredData = data.filter(entry => entry.date === selectedDate);

      if (filteredData.length > 0) {
        const filename = `${type}_report_${selectedDate}.${format}`;
        if (format === 'pdf') {
          // Use third-party library (e.g., jsPDF) to convert HTML to PDF
          alert(`Downloading ${type} report as PDF: ${filename}`);
        } else if (format === 'excel') {
          const sheetData = [Object.keys(filteredData[0])].concat(filteredData.map(entry => Object.values(entry)));
          const sheet = XLSX.utils.aoa_to_sheet(sheetData);
          const workbook = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(workbook, sheet, 'Report');
          XLSX.writeFile(workbook, filename);
        }
      } else {
        alert('No data available for the selected date.');
      }
    }
  </script>


<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'sidebar.php'; ?>

   
</body>
</html>