<?php
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
            <link rel="stylesheet" href="css/course.css">

        </head>
        <style>
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
            
/* Responsive CSS */
@media only screen and (max-width: 768px) {
    /* Adjustments for smaller screens */
    .tutor {
        padding: 5px; /* Reduce padding */
    }

    .table-container {
        font-size: medium; /* Decrease font size */
    }

    .table th,
    .table td {
        padding: 6px; /* Adjust padding */
        font-size: small; /* Decrease font size */
    }
}

          
        </style>

        <body>
            <?php include 'header.php'; ?>

            <section class="teacher-profile">
                <h1 class="heading">Course Details</h1>
                <div class="details">
                    <div class="tutor" style="text-align:left;">
                        <?php
                        $tableName = "course_details";

                        ?>

                        <h3>Course Name: <span>
                                <?php echo $courseDetails['course_name']; ?>
                            </span></h3>
                        <h3>Course Description:<span>
                                <?php echo $courseDetails['course_description']; ?>
                            </span></h3>
                        <h3>Course Duration:<span>
                                <?php echo $courseDetails['course_duration']."<span> Days</span>"; ?>
                            </span></h3>
                    </div>
                    <div class="flex">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Course Day</th>
                                        <th>Course Description</th>
                                        <th>Course Link</th>
                                        <th>Practical Link</th>
                                       
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