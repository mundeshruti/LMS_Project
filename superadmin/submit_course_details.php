<?php
include 'connect_db.php';

// Retrieve form data
$course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
$course_day = mysqli_real_escape_string($conn, $_POST['course_day']);
$course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
$course_link = mysqli_real_escape_string($conn, $_POST['course_link']);
$practical_link = mysqli_real_escape_string($conn, $_POST['practical_link']);

// Check if data for this course day already exists
$existing_data_query = "SELECT * FROM course_details WHERE course_name = '$course_name' AND course_day = '$course_day'";
$existing_data_result = mysqli_query($conn, $existing_data_query);

if (!$existing_data_result) {
    // Error handling if the query fails
    echo "Error: " . mysqli_error($conn);
    exit;
}

if (mysqli_num_rows($existing_data_result) > 0) {
    // If data for this course day already exists
    echo "<script>alert('Data for Day $course_day already exists.');</script>";
} else {
    // Insert the submitted data into the course_details table
    $insert_query = "INSERT INTO course_details (course_name, course_day, course_description, course_link, practical_link)
                     VALUES ('$course_name', '$course_day', '$course_description', '$course_link', '$practical_link')";

    if (mysqli_query($conn, $insert_query)) {
        // Success message
        echo "<script>alert('Course details submitted successfully.');</script>";
    } else {
        // Error handling if the insertion fails
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>

<script>
    // Redirect to course_details.php
    window.location.href = "course_details.php";
</script>
