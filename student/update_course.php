<?php

include 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if course ID and student ID are provided
    if (isset($_POST['course_id']) && isset($_POST['student_id'])) {
        $courseId = $_POST['course_id'];
        $studentId = $_POST['student_id'];

        // Fetch course name based on course ID and student ID
        $sql_course_name = "SELECT course_name FROM admin_student_course WHERE course_id = '$courseId' AND student_id = '$studentId'";
        $result_course_name = $conn->query($sql_course_name);

        if ($result_course_name->num_rows > 0) {
            $row = $result_course_name->fetch_assoc();
            $courseName = $row['course_name'];

            // Check if a file was uploaded
            if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] === UPLOAD_ERR_OK) {
                // Define the directory where the files will be stored
                $targetDirectory = "uploads/";

                // Get the file name
                $fileName = basename($_FILES['uploadfile']['name']);

                // Generate a unique name to avoid overwriting existing files
                $filePath = $targetDirectory . uniqid() . '_' . $fileName;

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $filePath)) {
                    // Update the database with the new file path
                    $sql = "UPDATE admin_student_course SET uploaded_file = '$filePath', completed = 1 WHERE course_id = '$courseId' AND student_id = '$studentId'";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('File updated successfully.'); window.location.href = 'view_create_course.php?name=$courseName';</script>";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "No file uploaded.";
            }
        } else {
            echo "Course name not found.";
        }
    } else {
        echo "Course ID or Student ID is missing.";
    }
} else {
    echo "Invalid request method.";
}
?>
