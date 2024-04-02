<?php
include 'connect_db.php';

$errors = array(); // Initialize an array to store validation errors

if (isset($_GET['key'])) {
    $reset_key = $_GET['key'];

    // Check if reset key exists and is not expired
    $current_time = time();
    $stmt = $conn->prepare("SELECT * FROM password_reset WHERE reset_key = ? AND expiry_timestamp > ?");
    $stmt->bind_param("si", $reset_key, $current_time);

    // $stmt = $conn->prepare("SELECT * FROM password_reset WHERE reset_key = ? AND expiry_timestamp > ?");
    // $stmt->bind_param("si", $reset_key, time());
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows == 1) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];

            // Validate password (you can add additional validation if needed)
            if (empty($password)) {
                $errors[] = "Password is required.";
            } elseif (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long.";
            }

            if (count($errors) === 0) {
                // Update user's password in the database
                $row = $result->fetch_assoc();
                $email = $row['email'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE admins SET password = ? WHERE email = ?");
                $stmt->bind_param("ss", $hashed_password, $email);
                $stmt->execute();

                // Delete reset key from database
                $stmt = $conn->prepare("DELETE FROM password_reset WHERE reset_key = ?");
                $stmt->bind_param("s", $reset_key);
                $stmt->execute();

                // Redirect user to login page with success message
                header("Location: index.php?reset_success=true");
                exit();
            }
        }
    }
} else {
    $errors[] = "Reset key not provided.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Custom CSS file links -->
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        .error-message {
            color: red;
        }

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

        /* Add bold style for labels */
        .form-container p strong {
            font-weight: bold;
            color: black;
        }

        .password-field {
            position: relative;
        }

        #passwordInput {
            padding-right: 30px;
            /* Make space for the icon */
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: small;
        }

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
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
            font-size: 14px;
        }

        .password-info-container {
            position: absolute;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 10px;
            max-width: 200px;
            /* Adjust as needed */
            z-index: 999;
            /* Ensure it appears above other elements */
        }
    </style>
</head>

<body>
    <?php
    session_start();

    include 'connect_db.php';

    $errors = array(); // Initialize an array to store validation errors
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $password = validatePassword($_POST['pass']);
        $confirmPassword = validatePassword($_POST['cpass']);

        // Additional validation (you can customize this based on your requirements)
        if (empty($password) || empty($confirmPassword)) {
            $errors[] = "All fields are required.";
            $isValid = false; // Set validation status to false
        }

        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
            $isValid = false; // Set validation status to false
        }
    }
    function validateInput($input)
    {
        // Remove any numbers from the input using regular expression
        $validatedInput = preg_replace('/[0-9]+/', '', $input);
        // Trim any leading or trailing whitespace
        $validatedInput = trim($validatedInput);
        // Return the validated input
        return $validatedInput;
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
        <section class="form-container">

            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <h3>Reset Password</h3>
                <div class="flex">
                    <div class="col">
                        <div class="col">
                            <!-- Password input field with toggle icon -->
                            <p><strong>New Password</strong> <span>*</span></p>
                            <!-- Password input field -->
                            <div class="password-field" class="col">
                                <input type="password" name="pass" id="passwordInput" placeholder="Enter your password"
                                    required maxlength="20" class="box">
                                <i class="toggle-password fas fa-eye-slash" onclick="togglePasswordVisibility()"></i>
                            </div>
                            <p><strong>Confirm Password </strong> <span>*</span>
                            </p>
                            <div class="password-field" class="col">
                                <input type="password" name="cpass" id="confirm-password" placeholder="Confirm password"
                                    maxlength="20" required class="box">
                                <!-- <i class="toggle-password fas fa-eye-slash" onclick="togglePasswordVisibility()"></i> -->
                                <i class="toggle-password fas fa-eye-slash" onclick="togglePassword('confirm-password')"
                                    onclick="togglePasswordVisibility()" id="confirm-eye-icon"></i>
                                <span class="confirm-password-error" style="color: red;"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="Reset password" class="btn">
            </form>
        </section>
        <script src="js/admin_script.js"></script>
    </body>
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
    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId === 'password' ? 'eye-icon' : 'confirm-eye-icon');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
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

</html>