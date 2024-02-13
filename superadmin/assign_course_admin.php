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
        <form action="course_admin_submit.php" method="post">
            <h2>Course Assign to Admin</h2>

            <label for="admins_name">Admin Name</label>
            <select id="admins_name" name="admins_name">
                <?php
                // Include the file to establish database connection
                include 'connect_db.php';

                // SQL query to select all courses
                $sql = "SELECT * FROM admins";

                // Execute the query
                $result = $conn->query($sql);

                // If there are rows in the result, generate dropdown options
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No admin found</option>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>



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


            <button type="submit" class="inline-btn">Submit</button>
        </form>

    </div>
    <?php include 'sidebar.php'; ?>
</body>

</html>