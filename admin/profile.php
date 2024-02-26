<!-- <?php

$user_id = $_SESSION['user_id'];
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
$user_image = isset($_SESSION['user_image']) ? $_SESSION['user_image'] : '';
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php include 'header.php'; ?>
<section class="tutor-profile" style="min-height: calc(100vh - 19rem);"> 

   <h1 class="heading">Profile details</h1>

   <?php if (!empty($user_name) && !empty($user_email)) : ?>
       <div class="details">
          <div class="tutor">
          <?php
             $imagePath = "../superadmin/uploads/" . basename($user_image);
             if (file_exists($imagePath)) {
                 echo "<img src=\"$imagePath\" class=\"image\" alt=\"$user_name's Profile Image\">";
             } else {
                 echo "Image not found.";
             }?>
             <h3><?php echo $user_name; ?></h3>
             <span><?php echo $user_email; ?></span>
          </div>
       </div>
   <?php else : ?>
       <p>Error: User information not available.</p>
   <?php endif; ?>

</section>

<script src="js/admin_script.js"></script>
<script src="js/script.js"></script>

<?php include 'sidebar.php'; ?>

</body>
</html>