<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courses</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/course.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <!-- Menu Section -->
    <div id="courseAssignment">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="assignmentForm" method="post">
            <h2>Create a Course</h2>
            <div id="course-form">
                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="course_name" required>

                <br>

                <label for="course_description">Course Description:</label>
                <textarea id="course_description" name="course_description" rows="4" required></textarea>

                <label for="course_duration">Course Duration:</label>
<select id="course_duration" name="course_duration" required>
    <?php
                    for ($i = 1; $i <= 30; $i++) {
                        echo "<option value='$i'>$i day" . ($i > 1 ? "s" : "") . "</option>";
                    }
                    ?>
                </select>
                <p id="selected_duration"></p>

                <button class="inline-btn" type="submit" name="create_course">Create Course</button>

            </div>
        </form>
        
        <?php
       
        
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_course'])) {
            

            // Retrieve form data
            $courseName = $_POST["course_name"];
            $courseDescription = $_POST["course_description"];
            $courseDuration = $_POST["course_duration"];

            // Validate and sanitize input (you may want to add more validation)
            $courseName = htmlspecialchars(trim($courseName));
            $courseDescription = htmlspecialchars(trim($courseDescription));
            $courseDuration = htmlspecialchars(trim($courseDuration));
            include 'connect_db.php';
            // Insert data into the Courses table
            $sql = "INSERT INTO Create_course (course_name, course_description, course_duration) VALUES ('$courseName', '$courseDescription', '$courseDuration')";

            if ($conn->query($sql) === TRUE) {
                echo "Course created successfully";
                header("Location: create_courses_display.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();
        }
        
        ?>

        <?php include 'sidebar.php'; ?>
    </div>

    <script src="js/script.js"></script>
    <script>
    // JavaScript to display the selected duration
    const courseDurationSelect = document.getElementById('course_duration');
    const selectedDurationDisplay = document.getElementById('selected_duration');

    courseDurationSelect.addEventListener('change', function() {
        const selectedDuration = this.value;
        // selectedDurationDisplay.textContent = `${selectedDuration} day${selectedDuration > 1 ? 's' : ''}`;
    });
</script>

</body>

</html>
