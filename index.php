<?php
$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


    // Perform your authentication logic here
    // For demonstration, I'm assuming authentication failed
    if ($email !== "superadmin@gmail.com" || $password !== "12345678") {
        $error_message = "Wrong username or password";
    } else {
        // Clear the error message if authentication succeeds
        $error_message = "";

        // Redirect to superadmin home page
        header("Location: superadmin/home.php");
        exit(); // Ensure script stops executing after redirection
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
    <link rel="stylesheet" href="./admin/css/login.css">
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
                <span>
                    <p class="link">If you're an admin, <a href="./admin/index.php" target="_blank">login here</a>.</p>
                    <p class="link">if you're student <a href="./student/index.php" target="_blank">login here</a></p>
                </span>
            </form>
        </section>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Perform your authentication logic here
            // For demonstration, I'm assuming authentication failed
            if (email !== "superadmin@gmail.com" || password !== "12345678") {
                document.getElementById("error-message").innerText = "Wrong username or password";
                return false; // Prevent form submission
            }

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