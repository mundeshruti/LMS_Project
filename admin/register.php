<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body style="padding-left: 0;">


   <!-- register section starts  -->

   <section class="form-container">

      <form class="register" action="register_student.php" method="post" enctype="multipart/form-data">
         <h3>register new</h3>
         <div class="flex">
            <div class="col">
               <p>Name <span>*</span></p>
               <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
               <p> Course <span>*</span></p>
               <select name="course" class="box" required>
               <option value="" disabled selected>select Course</option>
                  <!-- <option value="" disabled selected>select Course</option>
                  <option value="developer">web developer</option>
                  <option value="front end developer">front end developer</option>
                  <option value="backend developer">backend developer</option>
                  <option value="full stack developer">full stack developer</option>
                  <option value="ML">ML</option>
                  <option value="Analyst">Analyst</option> -->

                  <?php
                     // Include database connection
                     include 'connect_db.php';

                     // Fetch course options from the database
                     $course_query = "SELECT course_id id, course_name coursename FROM create_course";
                     $course_result = $conn->query($course_query);

                     // Loop through the results and generate options dynamically
                     while ($row = $course_result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['coursename'] . '</option>';
                     }

                     // Close database connection
                     $conn->close();
                  ?>

               </select>
               
               <p>Email <span>*</span></p>
               <input type="email" name="email" placeholder="enter your email" maxlength="40" required class="box">
            </div>
            <div class="col">
               <!-- Confirm Password input field with toggle icon -->
               <p>Password <span>*</span>
                  <span class="toggle-password" onclick="togglePassword('password')">
                     <i class="fas fa-eye" id="eye-icon"></i>
                  </span>
               </p>
               <div class="password-container">
                  <input type="password" name="pass" id="password" placeholder="enter password" maxlength="20" required
                     class="box">

               </div>
               <!-- Confirm Password input field with toggle icon -->
               <p>Confirm Password <span>*</span>

                  <span class="toggle-password" onclick="togglePassword('confirm-password')">
                     <i class="fas fa-eye" id="confirm-eye-icon"></i>
                  </span>
               </p>

               <div class="password-container">
                  <input type="password" name="cpass" id="confirm-password" placeholder="confirm password"
                     maxlength="20" required class="box">

               </div>
               <p>Select Photo <span>*</span></p>
               <input type="file" name="image" accept="image/*" required class="box">
            </div>
         </div>
         <p class="link">already have an account? <a href="login.html">login now</a></p>
         <input type="submit" name="submit" value="register now" class="btn">
      </form>

   </section>

   <!-- registe section ends -->
   <script>

      let darkMode = localStorage.getItem('dark-mode');
      let body = document.body;

      const enabelDarkMode = () => {
         body.classList.add('dark');
         localStorage.setItem('dark-mode', 'enabled');
      }

      const disableDarkMode = () => {
         body.classList.remove('dark');
         localStorage.setItem('dark-mode', 'disabled');
      }

      if (darkMode === 'enabled') {
         enabelDarkMode();
      } else {
         disableDarkMode();
      }


      function togglePassword(fieldId) {
         const passwordField = document.getElementById(fieldId);
         const eyeIcon = document.getElementById(fieldId === 'password' ? 'eye-icon' : 'confirm-eye-icon');

         if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
         } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
         }
      }

   </script>

   <script src="js/admin_script.js"></script>
</body>

</html>