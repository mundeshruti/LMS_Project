<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        h2 {
            color: #333;
        }

        div {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 300px;
        }

        img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <?php
    include 'connect_db.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $studentId = $_GET['id'];

        // Fetch student data based on the ID
        $selectSql = "SELECT * FROM register_student WHERE id = $studentId";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            // Student found, retrieve data
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $email = $row['email'];
            $profession = $row['profession'];
            $imagePath = $row['image_path'];

            // Display student details with a 50px image size
            echo '<div>';
            echo '<h2>Student Profile</h2>';
            echo '<img src="' . $imagePath . '" alt="' . $name . '">';
            echo '<p><strong>Name:</strong> ' . $name . '</p>';
            echo '<p><strong>Email:</strong> ' . $email . '</p>';
           
            // echo '<p><strong>Profession:</strong> ' . $profession . '</p>';
            echo '</div>';
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Invalid student ID.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
