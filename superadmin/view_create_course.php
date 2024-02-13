<?php
include 'connect_db.php';

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];

    // Query to fetch course details
    $courseSql = "SELECT * FROM create_course WHERE course_id = $courseId";
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
            h3 {
                align-items: left;
                text-align: left;
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
        </style>

        <body>
            <?php include 'header.php'; ?>

            <section class="teacher-profile">
                <h1 class="heading">Course Details</h1>
                <div class="details">
                    <div class="tutor">
                        <?php
                        $tableName = "course_details";

                        // Check if the form is submitted for deletion
                        if (isset($_POST['delete_course_day'])) {
                            $courseDayIdToDelete = $_POST['course_day_id_to_delete'];

                            $sql = "DELETE FROM $tableName WHERE id = $courseDayIdToDelete";
                            $result = $conn->query($sql);

                            if ($result) {
                                $successMessage = "Course day deleted successfully.";
                            } else {
                                $errorMessage = "Error deleting course day: " . $conn->error;
                            }
                        }
                        ?>

                        <h3>Course Name: <span><?php echo $courseDetails['course_name']; ?></span></h3>
                        <h3>Course Description:<span><?php echo $courseDetails['course_description']; ?></span></h3>
                        <h3>Course Duration:<span><?php echo $courseDetails['course_duration']; ?></span></h3>
                    </div>
                    <div class="flex">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Day</th>
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
                                    $detailsSql = "SELECT * FROM course_details WHERE course_name = '$courseName'";
                                    $detailsResult = $conn->query($detailsSql);

                                    if ($detailsResult->num_rows > 0) {
                                        while ($details = $detailsResult->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $details['course_day']; ?></td>
                                                <td><?php echo $details['course_description']; ?></td>
                                                <td><a href="<?php echo $details['course_link']; ?>" target="_blank"><?php echo $details['course_link']; ?></a></td>
                                                <td><a href="<?php echo $details['practical_link']; ?>" target="_blank"><?php echo $details['practical_link']; ?></a></td>
                                                <td>
                                                    <form method="post" class="delete-form">
                                                        <input type="hidden" name="course_day_id_to_delete" value="<?php echo $details['id']; ?>">
                                                        <button type="submit" name="delete_course_day" class="inline-delete-btn" onclick="return confirm('Are you sure you want to delete this course day?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No details found for the course: $courseName</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </section>

            <script src="js/script.js"></script>

            <?php include 'sidebar.php'; ?>
        </body>

        </html>
<?php
    }
}
?>
