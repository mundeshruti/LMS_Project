<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student List</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="teachers">

    <h1 class="heading">Students List</h1><!--Newly created-->  
 
    <form action="" method="post" class="search-form" style="margin: 15px; display: flex;">
       <input type="text" name="search_box" placeholder="search student" required maxlength="100" style="width: 50rem;
       border-radius: .5rem;
       display: flex;
       align-items: center;
       gap: 2rem;
       padding: 1.5rem 2rem;
       margin-right: 1rem;">
       <button type="submit" class="fas fa-search" name="search_student" style="width: 5rem; border-radius: .5rem; background-color: blueviolet;"></button>
       <div class="box" style="margin-left: auto;">
         <div class="box offer">
           <!-- <h3 style="font-size: 20px;">Add a student</h3>Newly created -->
           <!-- <p>..........</p> -->
           <a href="register.php" class="inline-btn">Add New Student</a>
        </div>
        </div>
       
    </form>

    <?php include 'student_display.php'; ?>
 
    <div class="box-container" style="display: grid;
    grid-template-columns: repeat(auto-fit, minmax(25rem, 2fr));
    align-items: flex-start;
    justify-content: center;
    gap: 1.5rem;">
    


</section>
      

<script src="js/admin_script.js"></script>

<?php include 'sidebar.php'; ?>

<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>