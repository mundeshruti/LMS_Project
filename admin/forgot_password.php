<?php
// Include database connection and PHPMailer
include 'connect_db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$errors = array(); // Initialize an array to store validation errors
$success_message = ""; // Initialize the success message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Validate email (you can add additional validation if needed)
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (count($errors) === 0) {
        // Generate reset key
        $reset_key = md5(uniqid(rand(), true));

        // Store reset key in database along with user's email and expiration timestamp
        // $expiry_timestamp = time() + (24 * 3600); // Set expiration to 24 hours from now
        // $stmt = $conn->prepare("INSERT INTO password_reset (email, reset_key, expiry_timestamp) VALUES (?, ?, ?)");
        // $stmt->bind_param("sss", $email, $reset_key, $expiry_timestamp);
        // $stmt->execute();
        $stmt = $conn->prepare("INSERT INTO password_reset (email, reset_key, expiry_timestamp) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Error: " . $conn->error); // Output the specific error message
        }

        $stmt->bind_param("sss", $email, $reset_key, $expiry_timestamp);
        if (!$stmt->execute()) {
            die("Error: " . $stmt->error); // Output the specific error message
        }
        // Construct reset link
        $reset_link = "http://localhost/RSL_LMS_Project/student/reset_password.php?key=" . $reset_key;

        // Construct email body
        $email_body = "Click the following link to reset your password: " . $reset_link;

        // Send email to user
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail = new PHPMailer();
            $mail->IsSMTP(); // send via SMTP
            $mail->Host = 'smtp@gmail.com'; // SMTP servers
            $mail->Port = 465; // SMTP servers
            $mail->SMTPAuth = true; // turn on SMTP authentication
            $mail->Username = 's19_munde_shrutika@mgmcen.ac.in'; // SMTP username
            $mail->Password = 'xihenxwwitjxvkuy'; // SMTP password
            $mail->From = 's19_munde_shrutika@mgmcen.ac.in';
            $mail->FromName = 'reset password';

            //Recipients
            $mail->setFrom('smtp@gmail.com', 'Mailer');
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body = $email_body;

            $mail->send();
            $success_message = "Password reset instructions have been sent to your email.";
        } catch (Exception $e) {
            $errors[] = "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Reset default margin and padding */
        * {
            margin-top: 0;
            padding-left: 0;
            padding-right: 100px;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            font-size: larger;
        }

        /* Container styles */
        .form-container {
            /*            
            margin: 50px auto; */
            /* background-color: #fff; */
            /* padding: 20px; */
            /* border-radius: 10px; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            /* border: 2px solid #ccc; */
        }

        /* Heading styles */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form styles */
        form {
            text-align: center;
        }

        /* Input field styles */
        input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Button styles */
        button[type="submit"] {
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #34495e;
        }

        /* Error message styles */
        .error {
            color: #FF0000;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <section class="form-container">
        <form method="post" action="">
            <?php if (!empty($success_message)): ?>
                <div class="success">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p>
                            <?php echo $error; ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <br>
            <h2>  Reset  Password</h2>
            <span>
                <label for="email" style="display: inline-block; width: 80px;">Email:</label>
                <input type="email" id="email" name="email" style="display: inline-block; width: calc(100% - 100px);"
                    required>

                <button type="submit">Reset Password</button>
        </form>
    </section>

</body>

</html>