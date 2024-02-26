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
<style>
    #assign-btn{
        margin-left: 40%;
    }
    
</style>
<body>

    <?php include 'header.php'; ?>
    <div id="courseAssignment">
        <form action="assign_course_std.php" method="post">
            <h2>Course Assign to Student</h2>

            <label for="name">Student Name:</label>
            <select id="name" name="name">
            <option value="">Select Student Name</option> <!-- Default option -->
                <?php
                // Include the file to establish database connection
                include 'connect_db.php';

                // SQL query to select all courses
                $sql = "SELECT * FROM register_student";

                // Execute the query
                $result = $conn->query($sql);

                // If there are rows in the result, generate dropdown options
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No Student found</option>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>



            <label for="course_name">Course Name:</label>
            <select id="course_name" name="course_name">
            <option value="">Select Course Name</option> <!-- Default option -->
                <?php
                // Include the file to establish database connection
                include 'connect_db.php';

                // Get the admin's user_id from the session
                session_start();
                $admin_id = $_SESSION['user_id'];

                // SQL query to select all students assigned to the admin
                $sql = "SELECT * FROM assign_admin WHERE admin_id = '$admin_id'";

                // Execute the query
                $result = $conn->query($sql);

                // If there are rows in the result, generate dropdown options
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Fetch the course name assigned to the admin
                        $course_name = $row['course_name'];
                        // Display the course name as an option in the dropdown
                        echo "<option value='" . $course_name . "'>" . $course_name . "</option>";
                    }
                } else {
                    echo "<option value=''>No courses found</option>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>

            <button type="submit" class="inline-btn" id="assign-btn">Assign</button>
        </form>

    </div>
    <?php include 'sidebar.php'; ?>
</body>

</html>
