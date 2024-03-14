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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

</head>

<body>

    <?php include 'header.php'; ?>

    <!-- Menu Section -->
    <div id="courseAssignment">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="assignmentForm" method="post">
            <h2>Create Course</h2>
            <div id="course-form">
                <label for="course_name"><b>Course Name :</b></label>
                <input type="text" id="course_name" name="course_name" required>

                <br>

                <label for="course_description"><b>Course Description:</b></label>
                <textarea id="course_description" name="course_description" rows="4" required></textarea>

                <label for="course_duration"><strong>Course Duration:</strong></label>
                <select id="course_duration" name="course_duration" required>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                        echo "<option value='$i'>$i day" . ($i > 1 ? "s" : "") . "</option>";
                    }
                    ?>
                </select>
                <p id="selected_duration"></p>

                <button class="inline-btn" type="submit" name="create_course"
                    style="display: block; margin: 0 auto;">Create Course</button>


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
            $sql = "INSERT INTO create_course (course_name, course_description, course_duration) VALUES ('$courseName', '$courseDescription', '$courseDuration')";

            if ($conn->query($sql) === TRUE) {
                // Course added successfully, display a JavaScript alert
                $successMessage = "Course created successfully";
                echo "<script>
                        $(document).ready(function() {
                            var popup = $('<div class=\"success-popup\">$successMessage</div>');
                            $('body').prepend(popup);
                            setTimeout(function() {
                                popup.fadeOut();
                                window.location.href = 'home.php'; // Redirect to home.php
                            }, 3000); // 1000 milliseconds = 1 second, adjust as needed
                        });
                      </script>";
            
                // Include sidebar.php outside the JavaScript string
                include 'sidebar.php';
            
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

        courseDurationSelect.addEventListener('change', function () {
            const selectedDuration = this.value;
            // selectedDurationDisplay.textContent = `${selectedDuration} day${selectedDuration > 1 ? 's' : ''}`;
        });
    </script>
    
    <?php include 'sidebar.php'; ?>

</body>

</html>