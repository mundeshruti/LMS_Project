<?php
// Start the session
session_start();

// Include the database connection file
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
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            if ($result->num_rows == 1) {
                // User credentials are correct
                $row = $result->fetch_assoc();
                $admin_id = $row['id'];

                // Fetch coursename from stdcourse table for the particular student
                $coursename_query = "SELECT course_name FROM create_course WHERE admin_id = '$admin_id'";
                $coursename_result = $conn->query($coursename_query);

                if ($coursename_result && $coursename_result->num_rows == 1) {
                    // Coursename found, set it in the session
                      // Coursename found, set it in the session
                $coursename_row = $coursename_result->fetch_assoc();
                $coursename = $coursename_row['course_name'];
                $_SESSION['course_name'] = $coursename;
                echo "Coursename retrieved: " . $coursename; // Debug statement
                } else {
                    // Coursename not found for the student
                    $errors[] = "No courses found for the student.";
                    echo "No courses found for the student."; // Debug statement
                }
       

                // Verify the entered password
                $trimmedPassword = trim($password);
                if (password_verify($trimmedPassword, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_image'] = 'uploads/' . $row['profile_image'];

                    // Add session_regenerate_id() for improved session security
                    session_regenerate_id();

                    echo "<script>alert('Logged in successfully!');</script>";
                    echo "<script>window.location = '../admin/dashboard.php';</script>";
                    exit();
                } else {
                    $errors[] = "Incorrect password.";
                }
            } else {
                $errors[] = "User not found with the provided email.";
            }
        } else {
            $errors[] = "Error executing the query: " . $conn->error;
        }
    }

    // Display validation errors using JavaScript alert
    echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
}
// Redirect in case of errors
echo "<script>window.location = 'index.html';</script>";
?>