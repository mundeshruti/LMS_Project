<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Add your styles here */
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
    </style>

</head>

<body>
    <?php include 'header.php'; ?>

    <section class="form-container">
        <form action="register_user.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <h3>Register Now</h3>

            <p><strong>Your Name</strong> <span>*</span></p>
            <input type="text" name="name" id="name" placeholder="Enter your name" required maxlength="50" class="box" oninput="this.value = this.value.replace(/[^a-zA-Z\s'’]/g, '');">
            <span id="nameError" class="error-message"></span>


            <p><strong>Your Email</strong> <span>*</span></p>
            <input type="email" name="email" id="email" placeholder="Enter your email" required maxlength="50"
                class="box"  style="width: 100%; box-sizing: border-box;  overflow: hidden;">
            <span id="emailError" class="error-message"></span>

            <p><strong>Your Password</strong> <span>*</span></p>
            <!-- Password input field -->
            <div class="password-field">
                <input type="password" name="pass" id="passwordInput" placeholder="Enter your password" required
                    maxlength="20" class="box">
                <i class="toggle-password fas fa-eye-slash" onclick="togglePasswordVisibility()"></i>
            </div>
            <span id="passwordError" class="error-message"></span>

            <p><strong>Select Profile Image</strong> <span>*</span></p>
            <!-- <label for="file" class="file-label">Select Profile Image</label> -->
            <input type="file" name="file" id="file" accept="image/*" required class="box">

            <input type="submit" value="Register Now" name="submit" class="btn">
        </form>

        <script>
            function validateForm() {
                // Reset error messages
                document.getElementById('nameError').innerText = '';
                document.getElementById('emailError').innerText = '';
                document.getElementById('passwordError').innerText = '';

                // Validate name (name and surname)
                const nameInput = document.getElementById('name');
                const nameValue = nameInput.value.trim();
                const containsNumber = /\d/.test(nameValue); // Check if name contains a number
                if (containsNumber) {
                    document.getElementById('nameError').innerText = 'Name should not contain numbers';
                    return false;
                } else if (!nameValue.includes(' ')) {
                    document.getElementById('nameError').innerText = 'Please enter your full name (including surname)';
                    return false;
                }


                // Validate email
                const emailInput = document.getElementById('email');
                const emailValue = emailInput.value.trim();
                if (!emailValue.includes('@') || (emailValue.indexOf('@') === emailValue.length - 1)) {
                    document.getElementById('emailError').innerText = 'Please enter a valid email address';
                    return false;
                }
                // Validate email
                const emailInput = document.getElementById('email');
                const emailError = document.getElementById('emailError');
                emailInput.addEventListener('input', function () {
                    const emailValue = this.value.trim();
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression for email validation
                    if (!emailPattern.test(emailValue)) {
                        emailError.innerText = 'Please enter a valid email address';
                    } else {
                        emailError.innerText = '';
                    }
                });


                // Validate password (should contain at least one lowercase, one uppercase, and one digit)
                const passwordInput = document.getElementById('pass');
                const passwordValue = passwordInput.value;
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
                if (!passwordRegex.test(passwordValue)) {
                    document.getElementById('passwordError').innerText = 'Password should contain at least one lowercase letter, one uppercase letter, and one digit';
                    return false;
                }

                // Form is valid
                return true;
            }
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
    </section>

    <?php include 'sidebar.php'; ?>
    <script src="js/script.js"></script>


</body>

</html>