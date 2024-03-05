<?php
// Start the session
session_start();

// Include the database connection file
include 'connect_db.php';

$errors = array(); // Initialize an array to store validation errors

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Validate inputs
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Additional validation (you can customize this based on your requirements)
   if (empty($email) || empty($password)) {
      $errors[] = "All fields are required.";
   }

   if (count($errors) === 0) { // Only proceed with database operations if validation is successful
      // Sanitize inputs before using in SQL query
      global $conn; // Access the global connection object
      $email = $conn->real_escape_string($email);

      // Use prepared statement to prevent SQL injection
      $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result) {
         if ($result->num_rows == 1) {
            // User credentials are correct
            $row = $result->fetch_assoc();
            $admin_id = $row['id'];

            // Verify the entered password
            $trimmedPassword = trim($password);
            echo "<script>console.log( $trimmedPassword)</script>";
            $hashedPassword = password_hash($row['password'], PASSWORD_DEFAULT);

            if (password_verify($trimmedPassword, $hashedPassword)) {
               $_SESSION['superadmin_id'] = $row['id'];
               $_SESSION['superadmin_email'] = $row['email'];
               echo "<script>console.log(" . $row['id'] . ")</script>";

               // Add session_regenerate_id() for improved session security
               session_regenerate_id();

               echo "<script>alert('Logged in successfully!');</script>";
               echo "<script>window.location = 'home.php';</script>";
               exit();
            } else {
               $error_message = "Wrong username or password";
            }
         } else {
            $error_message = "Wrong username or password";
         }
      } else {
         $errors[] = "Error executing the query: " . $conn->error;
      }
   }

   // Display validation errors using JavaScript alert
   //  echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
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
            <h3>Super Admin login</h3>
            <br>
            <?php if (!empty($error_message)): ?>
               <div class="alert alert-danger" role="alert">
                  <p id="error-message" style="color: red;">
                     <?php echo $error_message; ?>
                  </p>
               </div>
            <?php endif; ?>
            <p><strong style="color: black">User Email</strong><span>*</span></p>
            <input type="email" name="email" id="email" placeholder="enter your email" required maxlength="50"
               class="box">
            <p> <strong style="color: black">User Password </strong> <span>*</span></p>
            <div class="password-field">
               <input type="password" name="password" id="passwordInput" placeholder="enter your password"
                  maxlength="20" required class="box">
               <span class="toggle-password fas fa-eye-slash" onclick="togglePasswordVisibility()">
               </span>
            </div>

            <input type="submit" value="login now" name="submit" class="btn">

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
            setTimeout(function() {
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