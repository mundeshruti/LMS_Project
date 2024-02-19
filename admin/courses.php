<?php
session_start();
// Assuming you have a database connection established in 'connect_db.php'
include 'connect_db.php';

// Retrieve user session data
$user_id = $_SESSION['user_id'] ?? '';
$st_name = $_SESSION['st_name'] ?? '';
$user_email = $_SESSION['st_email'] ?? '';
$user_image = $_SESSION['st_image'] ?? '';

// Define search query
$search_query = isset($_POST['search_tutor']) ? $_POST['search_box'] : '';

// Construct SQL query
if ($search_query) {
    $sql = "SELECT * FROM assign_admin WHERE admin_id = '$user_id' AND course_name LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM assign_admin WHERE admin_id = '$user_id'";
}

// Execute SQL query
$result = $conn->query($sql);

// Include database connection file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Header Section Starts Here -->
    <?php include 'header.php'; ?>
    <section class="teachers">
        <div class="box-container">
            <form action="" method="post" class="search-tutor">
                <input type="text" name="search_box" placeholder="Search Courses Here..." maxlength="100">
                <button type="submit" class="fas fa-search" name="search_tutor"></button>
            </form>
        </div>
        <div class="box-container">
            <?php
            // Check if the result is valid
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="box">
                        <div class="tutor">
                            <div>
                                <h3>
                                    <?php echo htmlspecialchars($row['course_name']); ?>
                                </h3>
                                <p>
                                    <?php
                                    // Retrieve the course duration for the current course
                                    $course_name = $row['course_name'];
                                    $sql_duration = "SELECT course_duration FROM create_course WHERE course_name = '$course_name'";
                                    $result_duration = $conn->query($sql_duration);

                                    // Check if the result is valid
                                    if ($result_duration && $result_duration->num_rows > 0) {
                                        $row_duration = $result_duration->fetch_assoc();
                                        $course_duration = $row_duration['course_duration'];
                                        echo "Duration: " . htmlspecialchars($course_duration) . "<span> Days</span>";
                                    } else {
                                        echo "Duration: N/A"; // If no duration found
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="tutor">
                            <!-- Open the view file on click -->
                            <a href="view_create_course.php?name=<?php echo $row['course_name']; ?>" class="inline-btn">View</a>
                            <!-- If you want to assign the course, you should provide a link to the assign page -->
                            <a href="stdcourses.php" class="inline-btn">Assign</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error-message'>No courses found.</div>";
            }
            ?>
        </div>
    </section>

    <script src="js/script.js"></script>
    <?php include 'sidebar.php'; ?>
</body>

</html>
