<?php
include 'connect_db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $courseId = $_POST["course_id"];
    $studentId = $_POST["student_id"];
    $courseName = ""; // Variable to store the course name

    // Fetch the course name associated with the submitted course ID
    $sql = "SELECT course_name FROM admin_student_course WHERE id = '$courseId' AND student_id = '$studentId'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseName = $row['course_name'];
    } else {
        echo "Error: Could not fetch course name.";
        exit(); // Stop further execution
    }
    
    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["uploadfile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["uploadfile"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow only certain file formats
    if (!in_array($fileType, array("pdf", "doc", "docx", "jpg", "jpeg", "png"))) {
        // Set the message to display
        $errorMessage = "Sorry, only PDF, DOC, DOCX, JPG, JPEG and PNG files are allowed.";

        // Add JavaScript code to display the error message in a popup
        echo "<script>alert('$errorMessage');</script>";

        // Set $uploadOk to 0 to indicate that the file upload should not proceed
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now update the database
            $updateSql = "UPDATE admin_student_course SET uploaded_file = '$targetFile', completed = 1 WHERE id = $courseId AND student_id = '$studentId'";

            if ($conn->query($updateSql) === TRUE) {
                // Alert user and redirect with course name parameter
                echo "<script>alert('File uploaded successfully.'); window.location.href = 'view_create_course.php?name=$courseName';</script>";
                exit(); // Stop further execution
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
$conn->close();
?>
