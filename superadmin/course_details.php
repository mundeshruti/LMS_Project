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
            <h2>Course Content</h2>
            <label for="course_name">Course Name:</label>
            <select id="course_name" name="course_name">
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


            <label for="course_day">Select Day:</label>
            <select id="course_day" name="course_day" required>
                <?php
                for ($i = 1; $i <= 30; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>

            <label for="course_description">Course Description:</label>
            <textarea id="course_description" name="course_description" rows="4" required></textarea>

            <label for="course_link">Course Link:</label>
            <input type="url" id="course_link" name="course_link" required>

            <label for="practical_link">Practical Link:</label>
            <input type="url" id="practical_link" name="practical_link" required>

            <button type="submit" class="inline-btn">Submit</button>
        </form>

    </div>
    <?php include 'sidebar.php'; ?>
</body>

</html>
