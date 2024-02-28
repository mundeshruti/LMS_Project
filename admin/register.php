<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/admin_style.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<style>
   .success-popup {
      position: fixed;
      font-size: 20px;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: green;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      z-index: 9999;
   }

   .error-message {
      /* background-color: #f44336; */
      color: black;
      padding: 10px 20px;
      border-radius: 5px;
      margin-bottom: 10px;
      text-align: center;
      font-size: 14px;
      /* Center the text horizontally */
   }
   .password-info-container {
      position: absolute;
      background-color: #ffffff;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      padding: 10px;
      max-width: 200px; /* Adjust as needed */
      z-index: 999; /* Ensure it appears above other elements */
   }


</style>
<body>
<?php
session_start();

include 'connect_db.php';

$errors = array(); // Initialize an array to store validation errors
$isValid = true; // Initialize a variable to track overall validation status

$adminId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '-1';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Validate inputs
   $name = validateInput($_POST['name']);
   $email = validateEmail($_POST['email']);
   $password = validatePassword($_POST['pass']);
   $confirmPassword = validatePassword($_POST['cpass']);
   $course = isset($_POST['course']) ? $_POST['course'] : ''; // Check if course is set

   // Additional validation (you can customize this based on your requirements)
   if (empty($name) || empty($course) || empty($email) || empty($password) || empty($confirmPassword)) {
      $errors[] = "All fields are required.";
      $isValid = false; // Set validation status to false
   }

   if ($password !== $confirmPassword) {
      $errors[] = "Passwords do not match.";
      $isValid = false; // Set validation status to false
   }

   if ($isValid) { // Only proceed with database operations if validation is successful
      // Sanitize inputs before using in SQL query
      global $conn; // Access the global connection object
      $name = $conn->real_escape_string($name);
      $course = $conn->real_escape_string($course);
      $email = $conn->real_escape_string($email);

      $trimmedPassword = trim($_POST['pass']);
      $hashedPassword = password_hash($trimmedPassword, PASSWORD_BCRYPT);

      // Upload image
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES['image']['name']);
      move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

      // Insert user data into the database
      $sql = "INSERT INTO register_student (name, email, password, image_path, created_by, active_course_id) VALUES ('$name', '$email', '$hashedPassword', '$target_file', '$adminId', '$course')";

      if ($conn->query($sql) === TRUE) {
         $successMessage = "Student Register successfully.";
         echo "<script>
                         $(document).ready(function() {
                             var popup = $('<div class=\"success-popup\">$successMessage</div>');
                             $('body').prepend(popup);
                             setTimeout(function() {
                                 popup.fadeOut();
                                 window.location.href = 'students.php';
                             }, 3000); // 3000 milliseconds = 3 seconds, adjust as needed
                         });
                       </script>";

      } else {
         if ($conn->error) {
            $errors[] = "Error: " . $sql . "<br>" . $conn->error;
         } else {
            $errors[] = "Error: " . $sql;
         }
      }
      $conn->close();
   } else {
      // Display validation errors using JavaScript alert
      echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
      echo "<script>window.location = 'register.php';</script>";
   }
}

// Validate input function
function validateInput($input)
{
   // Remove any numbers from the input using regular expression
   $validatedInput = preg_replace('/[0-9]+/', '', $input);
   // Trim any leading or trailing whitespace
   $validatedInput = trim($validatedInput);
   // Return the validated input
   return $validatedInput;
}

// Validate email function
function validateEmail($email)
{
   // Validate email format
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      global $errors; // Access the global errors array
      $errors[] = "Invalid email format.";
      return false;
   }
   return $email;
}

// Validate password function
function validatePassword($password)
{
   // Password should contain at least one uppercase letter, one special character, no numbers,
   // and have a length of at least 8 characters
   if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*()-_+=])[a-zA-Z!@#$%^&*()-_+=]{8,}$/', $password)) {
      global $errors; // Access the global errors array
      $errors[] = "Password should contain at least one uppercase letter, one special character, and have a length of at least 8 characters.";
      return false;
   }
   return $password;
}
?>

<body style="padding-left: 0;">

   <!-- Register section starts -->
   <section class="form-container">

      <form class="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
         enctype="multipart/form-data" onsubmit="return validateForm()">
         <h3>Register Now</h3>
         <div class="flex">
            <div class="col">
               <p>Name <span>*</span></p>
               <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box"
                  oninput="this.value = this.value.replace(/[0-9]/g, '');">
               <p> Course <span>*</span></p>
               <select name="course" class="box" required>
                  <option value="Select Course Name" placeholder="Select Course Name">Select Course Name</option>
                  <!-- Default option -->
                  <?php
                  // Include database connection
                  include 'connect_db.php';

                  // Get the admin's user_id from the session
                  session_start();
                  $admin_id = $_SESSION['user_id'];

                  // SQL query to select all students assigned to the admin
                  $sql = "SELECT * FROM assign_admin WHERE admin_id = '$admin_id'";

                  // Execute the query
                  $result = $conn->query($sql);

                  // If there are rows in the result, generate dropdown options
                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        // Fetch the course name assigned to the admin
                        $course_name = $row['course_name'];
                        // Display the course name as an option in the dropdown
                        echo "<option value='" . $course_name . "'>" . $course_name . "</option>";
                     }
                  } else {
                     echo "<option value=''>No courses found</option>";
                  }

                  // Close database connection
                  $conn->close();
                  ?>
               </select>

               <p>Email <span>*</span></p>
               <input type="email" name="email" placeholder="Enter your email" maxlength="40" required class="box">
            </div>
            <div class="col">
               <!-- Password input field with toggle icon -->
               <p>Password <span>*</span>
                  <span class="toggle-password" onclick="togglePassword('password')">
                     <i class="fas fa-eye" id="eye-icon"></i>
                  </span>
                  <span class="password-info" onclick="togglePasswordInfo()">
        <i class="fas fa-question-circle" id="question-icon"></i>
    </span>
               </p>
               <div class="password-container">
                  <input type="password" name="pass" id="password" placeholder="Enter password" maxlength="20" required
                     class="box">
               </div>
               <div class="password-info-container" id="password-info">
               <p>Password must contain:</p>
               <ul>
                  <li>At least 8 characters</li>
                  <li>At least one uppercase letter</li>
                  <li>At least one special character (!@#$%^&*()-_+=)</li>
               </ul>
            </div>
               <!-- Confirm Password input field with toggle icon -->
               <p>Confirm Password <span>*</span>
                  <span class="toggle-password" onclick="togglePassword('confirm-password')">
                     <i class="fas fa-eye" id="confirm-eye-icon"></i>
                  </span>
               </p>
               <div class="password-container">
                  <input type="password" name="cpass" id="confirm-password" placeholder="Confirm password"
                     maxlength="20" required class="box">
                  <span class="confirm-password-error" style="color: red;"></span>
               </div>
               <p>Select Photo <span>*</span></p>
               <input type="file" name="image" accept="image/*" required class="box">
            </div>
         </div>
         <input type="submit" name="submit" value="Register Now" class="btn">
      </form>
   </section>
   <!-- Register section ends -->

   <!-- Script for password toggle and password match validation -->
   <script>
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
      function togglePasswordInfo() {
        const passwordInfoContainer = document.querySelector('.password-info-container');
        if (passwordInfoContainer.style.display === "none") {
            passwordInfoContainer.style.display = "block";
        } else {
            passwordInfoContainer.style.display = "none";
        }
    }


      // Validate confirm password
      document.querySelector('input[name="cpass"]').addEventListener('input', function () {
         const password = document.querySelector('input[name="pass"]').value;
         const confirmPassword = this.value;
         const errorSpan = document.querySelector('.confirm-password-error');

         if (password !== confirmPassword) {
            errorSpan.textContent = "Passwords do not match.";
         } else {
            errorSpan.textContent = "";
         }
      });

      function validateForm() {
         // Perform your other form validations here
         const confirmPassword = document.querySelector('input[name="cpass"]').value;
         const errorSpan = document.querySelector('.confirm-password-error');

         if (confirmPassword === "") {
            errorSpan.textContent = "Please confirm your password.";
            return false;
         }

         return true; // Allow form submission if all validations pass
      }
   </script>

   <!-- Custom script file link -->
   <script src="js/admin_script.js"></script>
</body>

</html>