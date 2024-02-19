<?php
include 'connect_db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $courseId = $_POST["course_id"]; // Assuming you have a hidden input field in your form with name 'course_id'
    $courseName = ""; // Variable to store the course name

    // Fetch the course name associated with the submitted course ID
    $sql = "SELECT course_name FROM course_details WHERE id = '$courseId'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseName = $row['course_name'];
    } else {
        echo "Error: Could not fetch course name.";
        exit(); // Stop further execution
    }
    
    // Handle file upload
    $targetDirectory = "uploads/"; // Directory where uploaded files will be saved
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
        echo "Sorry, only PDF, DOC, DOCX, JPG, JPEG and PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now update the database
            $updateSql = "UPDATE course_details SET uploaded_file = '$targetFile', completed = 1 WHERE id = $courseId";

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
