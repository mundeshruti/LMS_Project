<?php
include 'connect_db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if course ID is provided
    if (isset($_POST['course_id'])) {
        $courseId = $_POST['course_id'];

        // Prepare and bind the SQL query with a placeholder for the course ID
        $sql = "SELECT * FROM course_details WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $courseId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display the form with the existing file details
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit File</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
                <link rel="stylesheet" href="css/style.css">
                <style>
                    .container {
                        width: 50%;
                        margin: 50px auto;
                        padding: 20px;
                        background-color: #f9f9f9;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }

                    .form-group {
                        margin-bottom: 20px;
                    }

                    label {
                        display: block;
                        margin-bottom: 5px;
                    }

                    input[type="file"] {
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        width: 100%;
                    }

                    button[type="submit"] {
                        background-color: #04AA6D;
                        border: none;
                        color: white;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        border-radius: 5px;
                        cursor: pointer;
                    }

                    button[type="submit"]:hover {
                        background-color: #45a049;
                    }
                </style>
            </head>

            <body>
            <?php include 'header.php'; ?>
                <div class="container">
                    <h2>Edit File</h2>
                    <form action="update_course.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <!-- <label for="uploadfile">Upload File:</label> -->
                            <input type="file" id="uploadfile" name="uploadfile" required>
                        </div>
                        <button type="submit">Update</button>
                    </form>
                </div>
              
            </body>
            </html>
            <?php
        } else {
            echo "No course found with the provided ID.";
        }
    } else {
        echo "Course ID is missing.";
    }
} else {
    echo "Invalid request method.";
}
?>
 <?php include 'sidebar.php'; ?>
