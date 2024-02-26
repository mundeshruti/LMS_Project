<?php
include 'connect_db.php';

$errors = array(); // Initialize an array to store validation errors

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Validate inputs
   $email = $_POST['email'];
   $password = $_POST['pass'];

   // Additional validation (you can customize this based on your requirements)
   if (empty($email) || empty($password)) {
      $errors[] = "All fields are required.";
   }

   if (count($errors) === 0) { // Only proceed with database operations if validation is successful
      // Sanitize inputs before using in SQL query
      global $conn; // Access the global connection object
      $email = $conn->real_escape_string($email);

      // Use prepared statement to prevent SQL injection
      $stmt = $conn->prepare("SELECT * FROM register_student WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result) {
         if ($result->num_rows == 1) {
            // User credentials are correct
            $row = $result->fetch_assoc();
            $student_id = $row['id'];

            // // Fetch coursename from stdcourse table for the particular student
            // $coursename_query = "SELECT coursename FROM stdcourse WHERE student_id = '$student_id'";
            // $coursename_result = $conn->query($coursename_query);

            // if ($coursename_result && $coursename_result->num_rows == 1) {
            //    // Coursename found, set it in the session
            //    // Coursename found, set it in the session
            //    $coursename_row = $coursename_result->fetch_assoc();
            //    $coursename = $coursename_row['coursename'];
            //    $_SESSION['coursename'] = $coursename;
            //    echo "Coursename retrieved: " . $coursename; // Debug statement
            // } else {
            //    // Coursename not found for the student
            //    $errors[] = "No courses found for the student.";
            //    echo "No courses found for the student."; // Debug statement
            // }

            // Verify the entered password
            $trimmedPassword = trim($password);
            if (password_verify($trimmedPassword, $row['password'])) {
               session_start();
               $_SESSION['st_id'] = $row['id'];
               $_SESSION['st_name'] = $row['name'];
               $_SESSION['st_email'] = $row['email'];
               $_SESSION['st_image'] = 'admins/uploads/' . $row['image_path'];
               $_SESSION['st_admin_id'] = $row['created_by'];
               $_SESSION['st_course_id'] = $row['active_course_id'];

               session_regenerate_id();
               // After successfully setting the session variables and before redirecting to home.php
               $success_message = "Logged in successfully!";
               // Redirect to home.php with success message
               header("Location: home.php?success_message=" . urlencode($success_message));
               exit();

            } else {
               $error_message = "Incorrect password.";
            }
         } else {
            $error_message = "User not found with the provided email.";
         }
      }
   }
}
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Sign In Form</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="./css/login.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <script src="https://kit.fontawesome.com/999c289fc3.js" crossorigin="anonymous"></script>
   <style>
      /* styles.css */

      .password-field {
         position: relative;
      }

      #passwordInput {
         padding-right: 30px;
         /* Make space for the icon */
      }

      .toggle-password {
         position: absolute;
         top: 50%;
         font-size: small;
         right: 10px;
         transform: translateY(-50%);
         cursor: pointer;
      }

      /* login.css */
      .alert-danger {
         background-color: white;
         border-color: #f5c6cb;
         color: #721c24;
         padding: 0.75rem 1.25rem;
         margin-bottom: 1rem;
         border: 1px solid transparent;
         border-radius: 0.25rem;
      }
   </style>
</head>

<body>
   <div class="container">
      <section class="form-container">
         <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <h3>Student login</h3>
            <br>
            <?php if (!empty($error_message)): ?>
               <div class="alert alert-danger" role="alert">
                  <p id="error-message" style="color: red;">
                     <?php echo $error_message; ?>
                  </p>
               </div>
            <?php endif; ?>

            <p><strong style="color: black">User Email</strong><span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="40" required class="box">
            <p> <strong style="color: black">User Password </strong> <span>*</span></p>
            <div class="password-field">
               <input type="password" name="pass" id="passwordInput" placeholder="enter your password" maxlength="20"
                  required class="box">
               <span class="toggle-password fas fa-eye-slash" onclick="togglePasswordVisibility()">
               </span>
            </div>
            <input type="submit" name="submit" value="login now" class="btn">
         </form>
         </form>
      </section>
   </div>

   <script>
      function validateForm() {
         var email = document.getElementById("email").value;
         var password = document.getElementById("passwordInput").value;

         // Perform your authentication logic here
         // For demonstration, the logic is handled on the server-side
         // If there are errors, they will be displayed by PHP
         return true; // Allow form submission
      }
      function removeErrorMessage() {
         var errorMessage = document.getElementById("error-message");
         if (errorMessage) {
            setTimeout(function () {
               errorMessage.style.display = "none";
            }, 3000); // 3000 milliseconds = 3 seconds
         }
      }

      // Call the removeErrorMessage function when the page loads
      window.onload = removeErrorMessage;
   </script>

   <script>
      // script.js
      function togglePasswordVisibility() {
         const passwordInput = document.getElementById("passwordInput");
         const togglePassword = document.querySelector(".toggle-password");

         if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
         } else {
            passwordInput.type = "password";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
         }
      }
   </script>
</body>

</html>