<link rel="stylesheet" href="css/admin_style.css">
<link rel="stylesheet" href="css/style.css">
<?php
// session_start();
?>
<div class="side-bar">
    <div class="profile">
        <img src="images/pic-1.jpg" class="image" alt="">
       
        <?php $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';?>
       <h3><?php echo $user_name; ?></h3>
       <span>Admin </span>
    </div>
    <nav class="navbar">

        <a href="dashboard.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="students.php"><i class="fa-solid fa-graduation-cap"></i><span>Students</span></a>
        <a href="courses.php"><i class="fa-solid fa-book-open"></i></i><span>Courses</span></a>
        <!-- <a href="stdcourses.php"><i class="fa-solid fa-book-open"></i></i><span>Assign Courses</span></a> -->
        <a href="report.php"><i class="fa-solid fa-file-lines"></i><span>Report</span></a>
        <a href="notification.php"><i class="fa-solid fa-bell"></i><span>Notification</span></a>
        <!-- <a href="login.html"><i class="fa-solid fa-right-to-bracket"></i><span>Student Login</span></a> -->

    </nav>
</div>