<?php
session_start();

// Assuming you have a database connection established in 'db_connection.php'
include 'connect_db.php';

$st_id = $_SESSION['st_id'];
$st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
$user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';
$user_image = isset($_SESSION['st_image']) ? $_SESSION['st_image'] : '';

include 'connect_db.php';

if (isset($_GET['name'])) {
    $courseName = $_GET['name'];

    // Query to fetch course details based on the course name
    $courseSql = "SELECT * FROM create_course WHERE course_name = '$courseName'";
    $courseResult = $conn->query($courseSql);



    if ($courseResult->num_rows > 0) {
        $courseDetails = $courseResult->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Course Profile</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
            <link rel="stylesheet" href="css/style.css">
        </head>
        <style>
            .button {
                background-color: #04AA6D;
                border: none;
                color: white;
                padding: 5px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
                cursor: pointer;
            }

            /* Style for tutor div */
            .tutor {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            /* Style for the table */
            .table-container {
                margin-top: 20px;
                font-size: large;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th,
            .table td {
                padding: 8px;
                border: 1px solid #ddd;
                text-align: left;
            }

            .table th {
                background-color: #f2f2f2;
            }

            /* Responsive CSS */
            @media only screen and (max-width: 768px) {

                /* Adjustments for smaller screens */
                .tutor {
                    padding: 5px;
                    /* Reduce padding */
                }

                .table-container {
                    font-size: medium;
                    /* Decrease font size */
                }

                .table th,
                .table td {
                    padding: 6px;
                    /* Adjust padding */
                    font-size: small;
                    /* Decrease font size */
                }
            }
        </style>

        <body>
            <?php include 'header.php'; ?>
            <section class="teacher-profile">
                <h1 class="heading">Course Details</h1>
                <div class="details">
                    <div class="tutor" style="text-align: left;">
                        <h3>Course Name: <span>
                                <?php echo $courseDetails['course_name']; ?>
                            </span></h3>
                        <h3>Course Description: <span>
                                <?php echo $courseDetails['course_description']; ?>
                            </span></h3>
                        <h3>Course Duration: <span>
                                <?php echo $courseDetails['course_duration'] . ' Days'; ?>
                            </span></h3>
                    </div>
                </div>
                <!-- Table for course details -->
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Day</th>
                                <th>Course Description</th>
                                <th>Course Link</th>
                                <th>Practical Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query to fetch associated course details based on the course_name
                            $courseName = $courseDetails['course_name'];
                            $detailsSql = "SELECT * FROM admin_student_course WHERE course_name = '$courseName' AND student_id = '$st_id' ORDER BY completed ASC, course_day ASC";
                            $detailsResult = $conn->query($detailsSql);

                            // Variable to track if unfinished course detail has been displayed
                            $unfinishedDisplayed = false;

                            if ($detailsResult === false) {
                                echo "Error: " . $conn->error;
                            } elseif ($detailsResult->num_rows > 0) {
                                while ($details = $detailsResult->fetch_assoc()) {
                                    if ($details['completed'] == "0") {
                                        // Display only the first unfinished course detail
                                        if (!$unfinishedDisplayed) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $details['course_day']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $details['course_description']; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo $details['course_link']; ?>" target="_blank">

                                                         <!-- <?php echo $details['course_link']; ?>  -->
                                                        <i class="fa-solid fa-play"></i> Play course video

                                                </td>

                                                <td><a href="<?php echo $details['practical_link']; ?>" target="_blank">
                                                        <?php echo $details['practical_link']; ?>
                                                    </a></td>

                                                <td>
                                                    <form action="submit_course.php" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="course_id" value="<?php echo $details["id"]; ?>">
                                                        <input type="hidden" name="student_id" value="<?php echo $details["student_id"]; ?>">
                                                        <input type="file" id="uploadfile" name="uploadfile" required>
                                                        <button class="button">Submit</button>
                                                    </form>

                                                </td>
                                            </tr>
                                            <?php
                                            $unfinishedDisplayed = true;
                                        }
                                    } else {
                                        // Display completed course details
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $details['course_day']; ?>
                                            </td>
                                            <td>
                                                <?php echo $details['course_description']; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $details['course_link']; ?>" target="_blank">
                                                    <!-- <?php echo $details['course_link']; ?> -->
                                                    <i class="fa-solid fa-play"></i> Play course video
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo $details['practical_link']; ?>" target="_blank">
                                                    <?php echo $details['practical_link']; ?>
                                                </a>
                                            </td>
                                            <td>
                                                Completed
                                                <form action="edit_course.php" method="post" style="display: inline;">
                                                    <input type="hidden" name="course_id" value="<?php echo $details["course_id"]; ?>">
                                                    <input type="hidden" name="student_id" value="<?php echo $details["student_id"]; ?>">
                                                    <button class="button">Edit</button>
                                                </form>
                                                <!-- Display previously uploaded file here -->
                                                <button class="button"
                                                    onclick="openFileInNewTab('<?php echo $details['uploaded_file']; ?>')">View</button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='5'>No details found for the course: $courseName</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <script src="js/script.js"></script>
            <?php include 'sidebar.php'; ?>
        </body>


        <script>
            function openFileInNewTab(filePath) {
                window.open(filePath, '_blank');
            }
        </script>



        </html>
        <?php
    }
}
?>