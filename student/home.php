<?php
session_start();

// Assuming you have a database connection established in 'db_connection.php'
include 'connect_db.php';

$st_id = $_SESSION['st_id'];
$st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
$user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';
$user_image = isset($_SESSION['st_image']) ? $_SESSION['st_image'] : '';

?><!DOCTYPE html>
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
   <?php include 'header.php'; ?>

   <section class="practical">
      <h1 class="heading">quick options</h1>
      <div id="swap_dashboard" style="display: block;">
         <section class="dashboard">

            <div class="box-container">


               <div class="box">
                  <h3></h3>
                  <p>view your profile</p>
                  <a href="profile.php" class="btn">profile</a>
               </div>
               <div class="box">
                  <p>view Assigned courses</p>
                  <a href="courses.php" class="btn">view courses</a>
               </div>
               <!-- <div class="box">
                  <p>view your Progress</p>
                  <a href="#" class="inline-btn">view Progress</a>
               </div> -->
               <div class="box">
                  <p>view your Program details</p>
                  <a href="program.php" class="btn">view Program details</a>
               </div>
               <div class="box">
                  <p>view your Notifications</p>
                  <a href="notification.php" class="btn">view Notifications</a>
               </div>
            </div>
         </section>
         
         <!-- custom js file link  -->
         <script src="js/script.js"></script>
         <script src="js/header.js"></script>

         <?php include 'sidebar.php'; ?>
</body>

</html>