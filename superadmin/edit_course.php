<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/course.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
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

<body>
    <?php
    include 'connect_db.php';

    // Check if form is submitted for updating the course
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate course ID
        if (isset($_POST['course_id'])) {
            $courseId = $_POST['course_id'];

            // Validate other form fields as needed
            $courseName = $_POST['course_name'];
            $courseDescription = $_POST['course_description'];
            $courseDuration = $_POST['course_duration'];
            $tableName = "create_course";

            // Update course details in the database
            $updateSql = "UPDATE $tableName SET course_name='$courseName', course_description='$courseDescription', course_duration='$courseDuration' WHERE course_id=$courseId";

            if ($conn->query($updateSql) === TRUE) {
                $successMessage = "Course updated successfully";
            } else {
                $errorMessage = "Error updating course: " . $conn->error;
            }

        } else {
            echo "Course ID is missing.";
        }
    }

    if (isset($_GET['id'])) {
        $courseId = $_GET['id'];
        $tableName = "create_course";

        // Fetch course details from the database
        $sql = "SELECT * FROM $tableName WHERE course_id = $courseId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $courseDetails = $result->fetch_assoc();
        } else {
            echo "Course not found.";
            exit();
        }
    }
    ?>
    <?php include 'header.php'; ?>
    <!-- Menu Section -->
    <div id="courseAssignment">

        <h2>Edit Course</h2>
        <div style="display: flex; justify-content: space-around;">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="flex: 1;">
                <input type="hidden" name="course_id" value="<?php echo $courseDetails['course_id']; ?>">
                <div id="course-form">
                    <label for="course_name">Course Name:</label>
                    <input type="text" id="course_name" name="course_name"
                        value="<?php echo $courseDetails['course_name']; ?>">

                    <br>

                    <label for="course_description">Course Description:</label>
                    <textarea id="course_description" name="course_description" rows="4"
                        required><?php echo $courseDetails['course_description']; ?></textarea>

                    <label for="course_duration">Course Duration:</label>

                    <select id="course_duration" name="course_duration" required>

                        <?php
                        for ($i = 1; $i <= 30; $i++) {
                            $selected = ($i == $courseDetails['course_duration']) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i day" . ($i > 1 ? "s" : "") . "</option>";
                        }
                        ?>
                    </select>
                    <p id="selected_duration"></p>

                    <button type="submit" class="inline-btn" style=" display:block;margin: 0 auto;">Update
                        Course</button>

            </form>
        </div>
            <!-- <div style="inline-size: fit-content;  display: inline-block;">
                <button type="submit" class="inline-btn"
                    onclick="location.href='create_courses_display.php'">Cancel</button>
            </div> -->

        </div>

        <?php include 'sidebar.php'; ?>
    </div>

    <script src="js/script.js"></script>
    <script>
        // JavaScript to display the selected duration
        const courseDurationSelect = document.getElementById('course_duration');
        const selectedDurationDisplay = document.getElementById('selected_duration');

        courseDurationSelect.addEventListener('change', function () {
            const selectedDuration = this.value;
            // selectedDurationDisplay.textContent = `${selectedDuration} day${selectedDuration > 1 ? 's' : ''}`;
        });
    </script>
    <script>
        $(document).ready(function () {
            var successMessage = "<?php echo isset($successMessage) ? $successMessage : '' ?>";
            var errorMessage = "<?php echo isset($errorMessage) ? $errorMessage : '' ?>";

            if (successMessage.trim() !== "") {
                var popup = $('<div class="success-popup">' + successMessage + '</div>');
                $('body').prepend(popup);
                setTimeout(function () {
                    popup.fadeOut();
                    window.location.href = 'create_courses_display.php'; // Redirect to the page after displaying the success message
                }, 1000);
            }

            if (errorMessage.trim() !== "") {
                alert(errorMessage); // Display error message using alert for now, you can customize this as needed
            }
        });
    </script>

</body>

</html>