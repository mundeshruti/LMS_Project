<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courses details</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/course.css">

</head>

<body>

    <?php include 'header.php'; ?>
    <div id="courseAssignment">
        <form action="submit_course_details.php" method="post">
            <h2>course content</h2>
            <label for="course_name"><strong>Course Name:</strong></label>
            <select id="course_name" name="course_name">
                <option value="">Select Course Name</option> <!-- Default option -->
                <?php
                // Include the file to establish database connection
                include 'connect_db.php';

                // SQL query to select all courses
                $sql = "SELECT * FROM create_course";

                // Execute the query
                $result = $conn->query($sql);

                // If there are rows in the result, generate dropdown options
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['course_name'] . "'>" . $row['course_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No courses found</option>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>


            <label for="course_day"><strong>Select Day:</strong></label>
            <select id="course_day" name="course_day" required>
                <?php
                // Include the file to establish database connection
                include 'connect_db.php';

                // Check if course_name is set
                if (isset($_POST['course_name'])) {
                    // Retrieve the selected course name
                    $selected_course_name = $_POST['course_name'];

                    // SQL query to fetch course duration for the selected course name
                    $sql = "SELECT course_duration FROM create_course WHERE course_name = '$selected_course_name'";
                    $result = $conn->query($sql);

                    // If the result is found
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $course_duration = $row['course_duration'];

                        // Generate options for course_day dropdown based on course duration
                        for ($i = 1; $i <= $course_duration; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                    }
                }
                ?>
            </select>

            <label for="course_description"><strong>Course Description:</strong></label>
            <textarea id="course_description" name="course_description" rows="4" required></textarea>

            <label for="course_link"><strong>Course Link:</strong></label>
            <input type="url" id="course_link" name="course_link" required pattern="https?://.+">

            <label for="practical_link"><strong>Practical Link:</strong></label>
            <input type="url" id="practical_link" name="practical_link" required>

            <button type="submit" class="inline-btn"   style="display: block; margin: 0 auto;">Submit</button>
        </form>

    </div>
    <?php include 'sidebar.php'; ?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Update course_day dropdown when course_name is selected
        $('#course_name').on('change', function () {
            var selectedCourseName = $(this).val();

            // AJAX request to fetch course duration for the selected course name
            $.ajax({
                url: 'fetch_course_duration.php',
                method: 'POST',
                data: {
                    course_name: selectedCourseName
                },
                success: function (response) {
                    // Parse the JSON response
                    var courseDuration = JSON.parse(response).course_duration;

                    // Generate options for course_day dropdown based on course duration
                    var courseDayDropdown = $('#course_day');
                    courseDayDropdown.empty();
                    for (var i = 1; i <= courseDuration; i++) {
                        courseDayDropdown.append($('<option>', {
                            value: i,
                            text: i
                        }));
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>

</body>

</html>