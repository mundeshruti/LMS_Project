<?php
include 'connect_db.php';

$errors = array(); // Initialize an array to store validation errors

if (isset($_GET['key'])) {
    $reset_key = $_GET['key'];

    // Check if reset key exists and is not expired
    $stmt = $conn->prepare("SELECT * FROM password_reset WHERE reset_key = ? AND expiry_timestamp > ?");
    $stmt->bind_param("si", $reset_key, time());
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
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
                $stmt->bind_param("ss", $hashed_password, $email);
                $stmt->execute();

                // Delete reset key from database
                $stmt = $conn->prepare("DELETE FROM password_reset WHERE reset_key = ?");
                $stmt->bind_param("s", $reset_key);
                $stmt->execute();

                // Redirect user to login page with success message
                header("Location: login.php?reset_success=true");
                exit();
            }
        }
    } else {
        $errors[] = "Invalid or expired reset key.";
    }
} else {
    $errors[] = "Reset key not provided.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
