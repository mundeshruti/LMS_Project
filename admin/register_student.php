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
    $course = ($_POST['course']);


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
            echo "<script>alert('Registration successful!');</script>";
            echo "<script>window.location = 'students.php';</script>";
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
// 
function validateInput($input) {
    // Remove any numbers from the input using regular expression
    $validatedInput = preg_replace('/[0-9]+/', '', $input);
    // Trim any leading or trailing whitespace
    $validatedInput = trim($validatedInput);
    // Return the validated input
    return $validatedInput;
}
function validateEmail($email) {
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        global $errors; // Access the global errors array
        $errors[] = "Invalid email format.";
        return false;
    }
    return $email;
}
function validatePassword($password) {
    // Password should contain at least one uppercase letter, one special character,
    // no numbers, and have a minimum length of 8 characters
    if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+])(?!.*\d)[A-Za-z\d!@#$%^&*()_+]{8,}$/", $password)) {
        global $errors; // Access the global errors array
        $errors[] = "Password should contain at least one uppercase letter, one special character, no numbers, and have a length of at least 8 characters.";
        return false;
    }
    return true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your meta tags, title, and CSS/JS links here -->
</head>
<body>

    <!-- Your existing HTML content -->

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <!-- Name -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
        <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
        <br>
        
        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
        <br>
        
        <!-- Password -->
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass">
        <span class="error"><?php echo isset($errors['pass']) ? $errors['pass'] : ''; ?></span>
        <br>
        
        <!-- Confirm Password -->
        <label for="cpass">Confirm Password:</label>
        <input type="password" id="cpass" name="cpass">
        <span class="error"><?php echo isset($errors['cpass']) ? $errors['cpass'] : ''; ?></span>
        <br>
        
        <!-- Course -->
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" value="<?php echo isset($_POST['course']) ? $_POST['course'] : ''; ?>">
        <span class="error"><?php echo isset($errors['course']) ? $errors['course'] : ''; ?></span>
        <br>
        
        <!-- Image Upload -->
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <span class="error"><?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
        <br>
        
        <button type="submit">Submit</button>
    </form>

    <!-- Your existing HTML content -->

</body>
</html>
