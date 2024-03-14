<?php
include 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission and update student record
    $studentId = $_POST['id'];
    $updateFields = array();

    // Update the name if provided
    if (isset($_POST['name'])) {
        $updateFields[] = "name = '" . $_POST['name'] . "'";
    }

    // Update the profession if provided
    if (isset($_POST['profession'])) {
        $updateFields[] = "profession = '" . $_POST['profession'] . "'";
    }

    // Update the image if a new one is provided
    if ($_FILES['image']['size'] > 0) {
        $uploadDir = 'uploads/'; // Specify your upload directory
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $updateFields[] = "image_path = '$uploadFile'";
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Update the password if a new one is provided
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $trimmedPassword = trim($_POST['password']);
        $hashedPassword = password_hash($trimmedPassword, PASSWORD_BCRYPT);
        $updateFields[] = "password = '$hashedPassword'";
    }

    // Construct the SQL query
    $updateSql = "UPDATE register_student SET " . implode(", ", $updateFields) . " WHERE id = $studentId";

    if ($conn->query($updateSql) === TRUE) {
        // After successful update
        echo '<script>';
        echo 'alert("Student updated successfully.");';
        echo 'window.location.href = "students.php";';
        echo '</script>';
    } else {
        echo "Error updating student: " . $conn->error;
    }
} else {
    // Display the form for editing
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $studentId = $_GET['id'];

        // Fetch student data based on the ID
        $selectSql = "SELECT * FROM register_student WHERE id = $studentId";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            // Student found, retrieve data
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $selectedProfession = $row['profession']; // Added line to get the existing profession

            // Display a form with pre-filled data for editing
            ?>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Student</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                    }

                    form {
                        max-width: 400px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    h2 {
                        text-align: center;
                        margin-bottom: 20px;
                    }

                    label {
                        display: block;
                        margin-bottom: 10px;
                    }

                    input,
                    select,
                    textarea {
                        width: 100%;
                        padding: 8px;
                        margin-bottom: 15px;
                        box-sizing: border-box;
                    }

                    input[type="submit"] {
                        background-color: #4caf50;
                        color: #fff;
                        border: none;
                        padding: 10px 15px;
                        cursor: pointer;
                        border-radius: 5px;
                    }

                    input[type="submit"]:hover {
                        background-color: #45a049;
                    }

                    .password-field {
                        position: relative;
                    }

                    #passwordInput {
                        padding-right: 30px;
                        /* Make space for the icon */
                    }

                    .toggle-password {
                        position: absolute;
                        top: 50%;
                        font-size: small;
                        right: 10px;
                        transform: translateY(-50%);
                        cursor: pointer;
                    }
                    img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
                </style>
                <script src="https://kit.fontawesome.com/999c289fc3.js" crossorigin="anonymous"></script>
            </head>

            <body>
                <h2>Edit Student</h2>
                <form action="edit_student.php" method="post" enctype="multipart/form-data">
                    <label for="name"><strong>Name:</strong></label>
                    <input type="text" id="name" name="name" value="<?= $name ?>"
                        oninput="this.value = this.value.replace(/[0-9]/g, '');" required>

                    <label for="profession"><strong>Profession:</strong></label>
                    <select name="profession" id="profession" class="box" required>
                        <option value="" disabled>-- select your skill</option>
                        <option value="developer" <?= ($selectedProfession === 'developer') ? 'selected' : '' ?>>Web Developer</option>
                        <option value="front end developer" <?= ($selectedProfession === 'front end developer') ? 'selected' : '' ?>>
                            Front End Developer</option>
                        <option value="backend developer" <?= ($selectedProfession === 'backend developer') ? 'selected' : '' ?>>Back
                            End Developer</option>
                        <option value="full stack developer" <?= ($selectedProfession === 'full stack developer') ? 'selected' : '' ?>>
                            Full Stack Developer</option>
                        <option value="ML" <?= ($selectedProfession === 'ML') ? 'selected' : '' ?>>Machine Learning</option>
                        <option value="Analyst" <?= ($selectedProfession === 'Analyst') ? 'selected' : '' ?>>Analyst</option>
                    </select>

                    <label for="image"><strong>Image:</strong></label>
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

                            $imagePath = $row['image_path'];

                            // Display student details with a 50px image size
                            echo '<img src="' . $imagePath . '" alt="' . $name . '">';
                            ?>
                    <input type="file" id="image" name="image">

                    <div class="password-field">
                        <label for="password"><strong>New Password:</strong></label>
                        <input type="password" id="password" name="password">
                        <span class="toggle-password fas fa-eye-slash" onclick="togglePasswordVisibility()"></span>
                    </div>

                    <input type="hidden" name="id" value="<?= $studentId ?>">
                    <input type="submit" value="Update">
                </form>
                <script>
                    function togglePasswordVisibility() {
                        const passwordInput = document.getElementById("password");
                        const togglePassword = document.querySelector(".toggle-password");
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            togglePassword.classList.remove("fa-eye-slash");
                            togglePassword.classList.add("fa-eye");
                        } else {
                            passwordInput.type = "password";
                            togglePassword.classList.remove("fa-eye");
                            togglePassword.classList.add("fa-eye-slash");
                        }
                    }
                </script>
            </body>

            </html>
            <?php
                        } else {
                            echo "Student not found.";
                        }
                    } else {
                        echo "Invalid student ID.";
                    }
        }

        // Close the database connection
        $conn->close();
    }
}
?>