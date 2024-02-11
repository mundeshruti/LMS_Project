<?php
// session_start();
// Assuming you have a database connection established in 'db_connection.php'
include 'connect_db.php';
// $st_id = $_SESSION['st_id'];
$st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
$user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';
$user_image = isset($_SESSION['st_image']) ? $_SESSION['st_image'] : '';

?>
<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">RSL Solution</a>


      <div class="icons">

         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="notifications-btn" class="fa-solid fa-bell">
            <span class="icon-button__badge">2</span>
         </div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
      <div id="myModal" class="modal">

         <!-- Modal content -->
         <div class="modal-content">
            <span class="close">&times;</span>
            <p style="font-size: 16px;">Some text in the Modal..</p>
            <hr />
            <p style="font-size: 16px;">Some text in the Modal..</p>
         </div>

      </div>
      <div class="profile">
         <img src="images/pic-5.jpg" class="image" alt="">
         <p class="role">
            <?php echo $st_name; ?>
         </p>
         <a href="profile.php" class="btn">view profile</a>
         <a href="index.html" class="btn">logout</a>

      </div>
   </section>
</header>
<script src="js/admin_script.js"></script>
<script src="js/script.js"></script>