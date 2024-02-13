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
                <input type="text" id="course_duration" name="course_duration" required>

                <button class="inline-btn" type="submit" name="create_course">Create Course</button>

            </div>
        </form>
        
        <?php
       
        
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_course'])) {
            // Include your database connection code here
            // For example: include 'db_connection.php';

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

        // Fetch and display the list of courses by course_id
        
        ?>

        <?php include 'sidebar.php'; ?>
    </div>

    <script src="js/script.js"></script>

</body>

</html>
