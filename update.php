<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'header.php'; ?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <p>update name</p>
      <input type="text" name="name" placeholder="Enter your name" maxlength="50" class="box">
      <p>update email</p>
      <input type="email" name="email" placeholder="Enter the email" maxlength="50" class="box">
      <p>previous password</p>
      <input type="password" name="old_pass" placeholder="enter your old password" maxlength="8" class="box">
      <p>new password</p>
      <input type="password" name="new_pass" placeholder="enter your old password" maxlength="8" class="box">
      <p>confirm password</p>
      <input type="password" name="c_pass" placeholder="confirm your new password" maxlength="8" class="box">
      <p>update pic</p>
      <input type="file" accept="image/*" class="box">
      <input type="submit" value="update profile" name="submit" class="btn">
   </form>

</section>

<script src="js/script.js"></script>

<?php include 'sidebar.php'; ?>
   
</body>
</html>