<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        h3 {
            align-items: left;
            text-align: left;
        }

        .icon-container {
            display: flex;
            align-items: center;
        }

        .icon-container a,
        .icon-container form {
            margin-right: 10px;
            /* Adjust as needed for spacing */
        }


        /* Style for tutor div */
        .tutor {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
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

        .success-popup {
            position: fixed;
            font-size: 20px;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: green;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999;

        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="teacher-profile">
        <h1 class="heading">Course Details</h1>
        <div class="details">
            <div class="tutor">
                <?php
                if (isset($_GET['id'])) {
                    $courseId = $_GET['id'];

                    include 'connect_db.php';

                    // // Check if the form is submitted for deletion
                    if (isset($_POST['delete_course_day'])) {
                        $courseDayIdToDelete = $_POST['course_day_id_to_delete'];

                        $sql = "DELETE FROM course_details WHERE id = $courseDayIdToDelete";
                        $result = $conn->query($sql);

                        if ($result) {
                            $successMessage = "Course day deleted successfully.";
                        } else {
                            $errorMessage = "Error deleting course day: " . $conn->error;
                        }
                    }

                    // Query to fetch course details
                    $courseSql = "SELECT * FROM create_course WHERE course_id = $courseId";
                    $courseResult = $conn->query($courseSql);

                    if ($courseResult->num_rows > 0) {
                        $courseDetails = $courseResult->fetch_assoc();
                        ?>
                        <h3>Course Name: <span>
                                <?php echo $courseDetails['course_name']; ?>
                            </span></h3>
                        <h3>Course Description:<span>
                                <?php echo $courseDetails['course_description']; ?>
                            </span></h3>
                        <h3>Course Duration:<span>
                                <?php echo $courseDetails['course_duration'] . "<span> Days<span/p>"; ?>
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
                                                <td>
                                                    <span class="icon-container">
                                                        <a href="edit_course_day.php?id=<?php echo $details['id']; ?>"><i
                                                                class="fas fa-edit"></i></a>

                                                        <form method="post" class="delete-form"
                                                            onsubmit="return confirm('Are you sure you want to delete this course day?')">
                                                            <input type="hidden" name="course_day_id_to_delete"
                                                                value="<?php echo $details['id']; ?>">
                                                            <button type="submit" name="delete_course_day" class="fa-solid fa-trash"
                                                                value="<?php echo $details['id']; ?>"></button>
                                                        </form>

                                                        <script>
                                                            // Check if the request is a POST request and contains a parameter indicating a successful deletion
                                                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_course_day'])) {
                                                                // Display the pop-up message after successful deletion
                                                                $successMessage = "Course deleted successfully";
                                                            }
                                                        </script>
                                                    </span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var successMessage = "<?php echo isset($successMessage) ? $successMessage : '' ?>";
        var errorMessage = "<?php echo isset($errorMessage) ? $errorMessage : '' ?>";

        if (successMessage.trim() !== "") {
            var popup = $('<div class="success-popup">' + successMessage + '</div>');
            $('body').prepend(popup);
            setTimeout(function () {
                popup.fadeOut();
                // Redirect to the page after displaying the success message
            }, 3000);
        }

        if (errorMessage.trim() !== "") {
            alert(errorMessage); // Display error message using alert for now, you can customize this as needed
        }
    });
</script>
