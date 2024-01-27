<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <header class="header">
      <section class="flex">
         <a href="home.php" class="logo">RSL Solution</a>
         <form action="" method="post" class="search-form">
            <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
            <button type="submit" class="fas fa-search"></button>
         </form>
         <div class="icons">
            <div id="notification-btn" class="fa-regular fa-bell"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
         </div>

         <div class="profile">
            <img src="images/pic-5.jpg" class="image" alt="">
            <p class="role">RSL Student</p>
            <a href="profile.php" class="btn">view profile</a>
            <div class="flex-btn">
               <a href="../index.php" class="option-btn">logout</a>
            </div>
         </div>

      </section>

   </header>

   <div class="side-bar">
      <div id="close-btn">
         <i class="fas fa-times"></i>
      </div>

   </div>
   <section class="home-grid">
      <h1 class="heading">quick options</h1>
         
      <div class="box-container">
   
         <div class="box">
            <a href="#" class="inline-btn">view Enroll courses</a>
         </div>
         <div class="box">
            <a href="#" class="inline-btn">Completed courses</a>
         </div>
         <div class="box">
            <a href="#" class="inline-btn">view Progress</a>
         </div>
      </div>
      </div>
   </section>
   <section class="courses">
      <h1 class="heading">our courses</h1>
      <div class="more-btn">
         <a href="courses.php" class="inline-option-btn">Web Development</a>
         <a href="courses.php" class="inline-option-btn">Full Stack Development</a>
        
         <a href="courses.php" class="inline-option-btn">view all courses</a>
      </div>
   </section>
   
   </section>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>
   
   <?php include 'sidebar.php'; ?>


</body>

</html>