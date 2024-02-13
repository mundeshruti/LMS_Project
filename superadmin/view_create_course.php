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
                /* /* width: 50%; */
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

                        <h3>Course Name: <span>
                                <?php echo $courseDetails['course_name']; ?>
                            </span>
                        </h3>
                        <h3>Course Description:<span>
                                <?php echo $courseDetails['course_description']; ?>
                            </span>
                        </h3>
                        <h3>
                            Course Duration:<span>
                                <?php echo $courseDetails['course_duration']; ?>
                            </span>
                        </h3>
                    </div>
                    <div class="flex">
                        <?php
                        // Query to fetch associated course details based on the course_name
                        $courseName = $courseDetails['course_name'];
                        $detailsSql = "SELECT * FROM course_details WHERE course_name = '$courseName'";
                        $detailsResult = $conn->query($detailsSql);

                        if ($detailsResult->num_rows > 0) {
                            while ($details = $detailsResult->fetch_assoc()) {
                                ?>

                                <div class="table-container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Course Description</th>
                                                <th>Course Link</th>
                                                <th>Practical Link</th>
                                            </tr>
                                        </thead>
                                        <!-- Display course details -->
                                        <!-- <h3>course Name:<span><?php echo $details['course_name']; ?></span></h3> -->
                                        <tr>
                                            <td>
                                                <?php echo $details['course_day']; ?>
                                            </td>
                                            <td>
                                                <?php echo $details['course_description']; ?>
                                            </td>
                                            <td><a href="<?php echo $details['course_link']; ?>" target="_blank">
                                                    <?php echo $details['course_link']; ?>
                                                </a></td>
                                            <td><a href="<?php echo $details['practical_link']; ?>" target="_blank">
                                                    <?php echo $details['practical_link']; ?>
                                                </a></td>
                                        </tr>

                                    <?php
                            }
                        } else {
                            echo "<p>No details found for the course: $courseName</p>";
                        }
                        ?>
                        </div>
                        </tbody>
                        </table>
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