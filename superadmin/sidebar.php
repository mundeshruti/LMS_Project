
<div class="side-bar">
    <div id="close-btn">
        <i class="fas fa-times"></i>
    </div>
    <div class="profile">
        <img src="images/pic-1.jpg" class="image" alt="">
        <p class="role">Super Admin</p>
    </div>
    <nav class="navbar">
        <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>Admins</span></a>
        <a href="create_courses_display.php"><i class="fa-solid fa-book-open"></i><span>Courses</span></a>
        <a button class="dropdown-btn"><i class="fa-solid fa-file-lines"></i><span> Report ▼</button></span></a>

        <div class="dropdown-container">
           
            <a href="report.php" onclick="showReport('adminReport')"><i class="fas fa-user-cog"></i> Admin Report</a>
            
            <a href="studentreport.php" onclick="showReport('studentReport')"><i class="fas fa-user-graduate"></i> Student Report</a>
        </div>


        <a href="notification.php"><i class="fa-regular fa-bell"></i><span>Notification</span></a>
       
    </nav>
</div>
<script src="js/script.js"></script>

<!-- Bootstrap JS (optional, if needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
   function showReport(reportType) {
      // Hide all reports
      $('.main-content').addClass('hide-content');

      // Show the selected report
      $('#' + reportType).removeClass('hide-content');
   }

   function downloadReport(format, reportType) {
      // Retrieve start and end dates based on the report type
      const startDate = $('#' + 'startDate' + reportType).val();
      const endDate = $('#' + 'endDate' + reportType).val();

      // Code to handle download logic based on the selected format (pdf or excel)
      console.log('Download ' + format + ' for ' + reportType + ' from ' + startDate + ' to ' + endDate);
   }
</script>
<script>
   document.querySelector(".dropdown-btn").addEventListener("click", function () {
       document.querySelector(".dropdown-container").classList.toggle("active");
   });
</script>
