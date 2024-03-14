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
    echo "<script>
            if (confirm('Data for Day $course_day already exists. Click OK to view course details.')) {
                window.location.href = 'course_details.php'; // Redirect to course details page
            } else {
                window.location.href = 'course_details.php'; // Redirect to course details page
            }
          </script>";

} else {
    // Insert the submitted data into the course_details table
    $insert_query = "INSERT INTO course_details (course_name, course_day, course_description, course_link, practical_link)
                     VALUES ('$course_name', '$course_day', '$course_description', '$course_link', '$practical_link')";

    if (mysqli_query($conn, $insert_query)) {
        // Success message
        $successMessage = "Course detail submitted successfully";
    } else {
        // Error handling if the insertion fails
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>
<style>
    .success-popup {
        position: fixed;
        font-size: 20px;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: green;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 9999;

    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var successMessage = "<?php echo isset($successMessage) ? $successMessage : '' ?>";
        var errorMessage = "<?php echo isset($errorMessage) ? $errorMessage : '' ?>";

        if (successMessage.trim() !== "") {
            var popup = $('<div class="success-popup">' + successMessage + '</div>');
            $('body').prepend(popup);
            setTimeout(function () {
                popup.fadeOut();
                window.location.href = "course_details.php";// Redirect to the page after displaying the success message
            }, 1000);
        }

        if (errorMessage.trim() !== "") {
            alert(errorMessage); // Display error message using alert for now, you can customize this as needed
        }
    });
</script>