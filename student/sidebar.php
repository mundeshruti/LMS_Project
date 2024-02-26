<div class="side-bar">
    <div id="close-btn">
        <i class="fas fa-times"></i>
    </div>
    <div class="profile">
        <?php
        $imagePath = "../admin/uploads/" . basename($user_image);
        if (file_exists($imagePath)) {
            echo "<img src=\"$imagePath\" class=\"image\" alt=\"$st_name's Profile Image\">";
        } else {
            echo "Image not found.";
        } ?>
        <h3>
            <?php echo $st_name; ?>
        </h3>
        <span> Student </span>
    </div>
    <nav class="navbar">
        <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="courses.php"><i class="fa-solid fa-book-open"></i><span>Courses</span></a>
        <!-- <a href="practical.html"><i class="fas fa-chalkboard-user"></i><span>Practicals</span></a> -->
        <a href="program.php"><i class="fas fa-headset"></i><span>Program</span></a>
        <a href="notification.php"><i class="fa-regular fa-bell"></i><span>Notification</span></a>
    </nav>
</div>
<script src="js/script.js"></script>
<script src="js/header.js"></script>