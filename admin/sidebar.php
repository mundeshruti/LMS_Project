<link rel="stylesheet" href="css/admin_style.css">
<link rel="stylesheet" href="css/style.css">
<?php
// session_start();
?>
<div class="side-bar">
    <div class="profile">
    <?php
             $imagePath = "../superadmin/uploads/" . basename($user_image);
             if (file_exists($imagePath)) {
                 echo "<img src=\"$imagePath\" class=\"image\" alt=\"$user_name's Profile Image\">";
             } else {
                 echo "Image not found.";
             }?>
        <?php $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';?>
       <h3><?php echo $user_name; ?></h3>
       <span>Admin </span>
    </div>
    <nav class="navbar">

        <a href="dashboard.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="students.php"><i class="fa-solid fa-graduation-cap"></i><span>Students</span></a>
        <a href="courses.php"><i class="fa-solid fa-book-open"></i></i><span>Courses</span></a>
        <a href="report.php"><i class="fa-solid fa-file-lines"></i><span>Report</span></a>
        <a href="notification.php"><i class="fa-solid fa-bell"></i><span>Notification</span></a>
       
    </nav>
</div>