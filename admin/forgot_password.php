<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the database connection file
include 'connect_db.php';

// Include PHPMailer autoloader
require 'libraries/PHPMailer/src/Exception.php';
require 'libraries/PHPMailer/src/PHPMailer.php';
require 'libraries/PHPMailer/src/SMTP.php';

$errors = array(); // Initialize an array to store validation errors

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate email input
    $email = $_POST['email'];

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (count($errors) === 0) {
        // Check if the email exists in the database
        global $conn; // Access the global connection object
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Generate reset key
            $reset_key = md5(uniqid(rand(), true));

            // Store reset key in database along with user's email and expiration timestamp
            $expiry_timestamp = time() + (24 * 3600); // Set expiration to 24 hours from now
            $stmt = $conn->prepare("INSERT INTO password_reset (email, reset_key, expiry_timestamp) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $reset_key, $expiry_timestamp);
            $stmt->execute();

            // Construct reset link
            $reset_link = "http://localhost/RSL_LMS_Project/admin/reset_password.php?key=" . $reset_key;

            // Send email to user
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = 'smtp.hostinger.com';     // Specify SMTP server
                $mail->SMTPAuth = true;                  // Enable SMTP authentication
                $mail->Username = 'info@rslsolution.com';   // SMTP username
                $mail->Password = 'Rsl@2015';           // SMTP password
                $mail->SMTPSecure = 'ssl';               // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                       // TCP port to connect to

                //Recipients
                $mail->setFrom('info@rslsolution.com', 'Your Name');
                $mail->addAddress($email); // Add a recipient

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Password Reset';
                $mail->Body = "Click the following link to reset your password: $reset_link";

                $mail->send();
                echo '<p class="success-message">Password reset instructions have been sent to your email.</p>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $errors[] = "Email not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot password</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Custom CSS file links -->
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        /* Add bold style for labels */
        .form-container p strong {
            font-weight: bold;
            color: black;
        }

        .success-message {
         color: green;
         font-weight: bold;
         margin-top: 20px;
         text-align: center;
         font-size: 16px;;
      }
    </style>
</head>

<body style="padding-left: 0;">
    <section class="form-container">

        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <?php if (!empty($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?php echo $error; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <h3>Reset Password</h3>
            <div class="flex">
                <div class="col">
                    <div class="col">
                        <p><strong>Email </strong><span>*</span></p>
                        <input type="email" name="email" id="email" placeholder="Enter your email" maxlength="40"
                            required class="box">
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Reset password" class="btn">
        </form>
    </section>

    <script src="js/admin_script.js"></script>
</body>


</html>