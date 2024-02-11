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
   <title>Program Details></title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      h2{
         text-align: left;
         font-size: 2rem;
      }
   </style>

</head>
<body>
<?php include 'header.php'; ?> 

<section class="contact">
   <div class="row">
<div class="box">
      <form action="" method="post">
         <h3 style=" background:#8e44ad; color: #ffffff;"> 6 Month Internship with RSL Solution Private Limited.</h3>
         <h2> Month 1: Fundamentals of Programming. (Min 3 Assignment Per Month)<br><br>
            Month 2: Object-Oriented Programming<br><br>
            Month 3: Front End & Web Development Fundamentals ( Java, PHP, Angular, React, Flutter (Any one))<br><br>
            Month 4: Backend Development (Node.js, SQL, My SQL, Django)<br><br>
            Month 5: Live Project 1<br><br>
            Month 6: Live Project 2 <br><br></h2>
         
      </form>
   </div>
   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>phone number</h3>
         <a href="tel:1234567890">123-456-7890</a>
      </div>
      
      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>email address</h3>
         <a href="info@rslsolution.com">info@rslsolution.com</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>office address</h3>
         <a href="#">Chinchwad, Pune, India</a>
      </div>

   </div>

</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="js/header.js"></script>
<?php include 'sidebar.php'; ?>

   
</body>
</html>