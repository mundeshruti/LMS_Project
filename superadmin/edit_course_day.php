<?php
// Include database connection
include 'connect_db.php';

// Check if the form is submitted for updating the course day
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_course_day'])) {
    // Retrieve course day ID to edit
    $courseDayIdToEdit = $_POST['course_day_id_to_edit'];

    // Retrieve updated course day details from the form
    // Add necessary validation and sanitization as per your requirements
    $updatedCourseDay = $_POST['updated_course_day'];
    $updatedCourseDescription = $_POST['updated_course_description'];
    $updatedCourseLink = $_POST['updated_course_link'];
    $updatedPracticalLink = $_POST['updated_practical_link'];

    // Update the course day details in the database
    $updateSql = "UPDATE course_details SET course_day='$updatedCourseDay', course_description='$updatedCourseDescription', course_link='$updatedCourseLink', practical_link='$updatedPracticalLink' WHERE id=$courseDayIdToEdit";

    if ($conn->query($updateSql) === TRUE) {
        // Redirect back to the course profile page after successful update
        echo "<script> alert('Course content updated');</script>";
        echo "<script>window.location.href = 'create_courses_display.php';</script>";
        exit();
    } else {
        // Handle database update error
        $errorMessage = "Error updating course day: " . $conn->error;
    }

}

// Check if the course day ID is provided
if (isset($_GET['id'])) {
    // Retrieve the course day ID to edit
    $courseDayIdToEdit = $_GET['id'];

    // Query to fetch the course day details based on the provided ID
    $courseDaySql = "SELECT * FROM course_details WHERE id = $courseDayIdToEdit";
    $courseDayResult = $conn->query($courseDaySql);

    // Check if the course day details are found
    if ($courseDayResult->num_rows > 0) {
        // Fetch the course day details
        $courseDayDetails = $courseDayResult->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Course Day</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/course.css">
        </head>

        <body>
            <?php include 'header.php'; ?>

            <section class="edit-course-day">
                <h1 class="heading">Edit Course Content</h1>
                <div class="form-container">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="course_day_id_to_edit" value="<?php echo $courseDayIdToEdit; ?>">
                        <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
                        <div class="form-group">
                            <label for="updated_course_day">Course Day:</label>
                            <input type="text" id="updated_course_day" name="updated_course_day"
                                value="<?php echo $courseDayDetails['course_day']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="updated_course_description">Course Description:</label>
                            <textarea id="updated_course_description" name="updated_course_description"
                                rows="4"><?php echo $courseDayDetails['course_description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="updated_course_link">Course Link:</label>
                            <input type="text" id="updated_course_link" name="updated_course_link"
                                value="<?php echo $courseDayDetails['course_link']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="updated_practical_link">Practical Link:</label>
                            <input type="text" id="updated_practical_link" name="updated_practical_link"
                                value="<?php echo $courseDayDetails['practical_link']; ?>">
                        </div>
                       
                            <button type="submit" name="edit_course_day" style="display: inline-block; margin: 0 auto;" >Update </button>
                            
                    </form>
                    <button type="submit" name="edit_course_day" style="display: inline-block; margin: 0 auto;" onclick="location.href='create_courses_display.php'">Cancel</button>

                </div>
            </section>

            <?php if (isset($errorMessage)): ?>
                <div class="error-message">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <?php include 'sidebar.php'; ?>
        </body>

        </html>
        <?php
    } else {
        echo "Course day not found.";
    }
} else {
    echo "Course day ID not provided.";
}
?>