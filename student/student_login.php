<?php
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
        $stmt = $conn->prepare("SELECT * FROM register_student WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($result->num_rows == 1) {
                // User credentials are correct
                $row = $result->fetch_assoc();
                $student_id = $row['id'];

                // Fetch coursename from stdcourse table for the particular student
                $coursename_query = "SELECT coursename FROM stdcourse WHERE student_id = '$student_id'";
                $coursename_result = $conn->query($coursename_query);

                if ($coursename_result && $coursename_result->num_rows == 1) {
                    // Coursename found, set it in the session
                      // Coursename found, set it in the session
    $coursename_row = $coursename_result->fetch_assoc();
    $coursename = $coursename_row['coursename'];
    $_SESSION['coursename'] = $coursename;
    echo "Coursename retrieved: " . $coursename; // Debug statement
                } else {
                    // Coursename not found for the student
                    $errors[] = "No courses found for the student.";
                    echo "No courses found for the student."; // Debug statement
                }

                // Verify the entered password
                $trimmedPassword = trim($password);
                if (password_verify($trimmedPassword, $row['password'])) {
                    session_start();
                    $_SESSION['st_id'] = $row['id'];
                    $_SESSION['st_name'] = $row['name'];
                    $_SESSION['st_email'] = $row['email'];
                    $_SESSION['st_image'] = 'admins/uploads/' . $row['image_path'];
                    session_regenerate_id();

                    echo "<script>alert('Logged in successfully!');</script>";
                    echo "<script>window.location = '../student/home.php';</script>";
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

    if (count($errors) > 0) {
        // Display validation errors using JavaScript alert
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    }
}
?>
