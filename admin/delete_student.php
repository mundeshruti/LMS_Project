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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<style>
    /* Button styles */
    .button {
        background-color: var(--main-color);
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .button:focus {
        outline: none;
    }

    .delete-button,
    .delete-form button {
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        background-color: red;
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

    .error-message {
        /* background-color: #f44336; */
        color: black;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 10px;
        text-align: center;
        font-size: 14px;
        /* Center the text horizontally */
    }
</style>

<body>
    <?php
    include 'connect_db.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $studentId = $_GET['id'];

        // Perform the delete operation in the database
        $deleteSql = "DELETE FROM register_student WHERE id = $studentId";
        if ($conn->query($deleteSql) === TRUE) {
            $successMessage = "Student deleted successfully.";
            echo "<script>
                            $(document).ready(function() {
                                var popup = $('<div class=\"success-popup\">$successMessage</div>');
                                $('body').prepend(popup);
                                setTimeout(function() {
                                    popup.fadeOut();
                                    window.location.href = 'students.php';
                                }, 1000); // 3000 milliseconds = 3 seconds, adjust as needed
                            });
                          </script>";

        } else {
            $errorMessage = "Error deleting course: " . $conn->error;
        }

    } else {
        echo "Invalid student ID.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>

</html>