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
<style>
   .search-form {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
   }

   .search-box {
      width: 50rem;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
   }


   
</style>

<body>

   <?php include 'header.php'; ?>

   <section class="teachers">

      <h1 class="heading">Students List</h1><!--Newly created-->

      <form action="" method="post" class="search-form">
         <input type="text" name="search_box" placeholder="Search Student" required maxlength="100" class="search-box">
         <button type="submit" name="search_student"></button>
         <div>
            <a href="register.php" class="inline-btn">Add New Student</a>
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
         if (content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
      });
   </script>

</body>

</html>