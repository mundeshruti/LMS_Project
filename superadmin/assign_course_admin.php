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
    <div id="courseAssignment">
        <form action="course_admin_submit.php" method="post">
            <h2>Course Assign to Admin</h2>
            <label for="name">Admin Name:</label>
            <select id="name" name="name">
            <option value="">Select Admin Name</option> <!-- Default option -->
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
                    echo "<option value=''>No courses found</option>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>


            <?php
            session_start();

            // Assuming you have a database connection established in 'connect_db.php'
            include 'connect_db.php';

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $admin_name = $_POST['name'];
                $course_name = $_POST['course_name'];

                // Check if the admin already has the course assigned
                $sql_check = "SELECT * FROM assign_admin WHERE name = '$admin_name' AND course_name = '$course_name'";
                $result_check = $conn->query($sql_check);

                if ($result_check && $result_check->num_rows > 0) {
                    // If the course is already assigned to the admin, display a message
                    echo "<script>alert('The course is already assigned to this admin.')</script>";
                } else {
                    // If the course is not assigned, proceed with the assignment
                    $sql_insert = "INSERT INTO assign_admin (name, course_name) VALUES ('$admin_name', '$course_name')";
                    if ($conn->query($sql_insert) === TRUE) {
                        echo "<script>alert('Course assigned successfully.')</script>";
                    } else {
                        echo "<script>alert('Error assigning course: " . $conn->error . "')</script>";
                    }
                }
            }

            ?>

            <label for="course_name">Course Name:</label>
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

            <button type="submit" class="inline-btn">Assign</button>
        </form>

    </div>
    <?php include 'sidebar.php'; ?>
</body>

</html>