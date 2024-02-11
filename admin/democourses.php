<?php
include 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission and update course record
    // $id = $_POST['id'];
    $updateFields = array();

    // Update the name if provided
    if (isset($_POST['coursename'])) {
        $updateFields[] = "coursename = '" . $_POST['coursename'] . "'";
    }

    // Update the date if provided
    if (isset($_POST['date'])) {
        $updateFields[] = "date = '" . $_POST['date'] . "'";
    }

    // Update the description if provided
    if (isset($_POST['coursedescription'])) {
        $updateFields[] = "coursedescription = '" . $_POST['coursedescription'] . "'";
    }

    // Update the link if provided
    if (isset($_POST['courselink'])) {
        $updateFields[] = "courselink = '" . $_POST['courselink'] . "'";
    }

    // Update the practical link if provided
    if (isset($_POST['practicallink'])) {
        $updateFields[] = "practicallink = '" . $_POST['practicallink'] . "'";
    }

    // Construct the SQL query
    $updateSql = "UPDATE courses SET " . implode(", ", $updateFields) . "";

    if ($conn->query($updateSql) === TRUE) {
        // After successful update
        echo '<script>';
        echo 'alert("Course updated successfully.");';
        echo 'window.location.href = "courses.php";';
        echo '</script>';
    } else {
        echo "Error updating course: " . $conn->error;
    }
} else {
    
            $coursename = $row['coursename'];
            $date = $row['date'];
            $coursedescription = $row['coursedescription'];
            $courselink = $row['courselink'];
            $practicallink = $row['practicallink'];

            // Display a form with pre-filled data for editing
            echo '<div id="courseAssignment">';
            echo '<h2>Edit Course</h2>';
            echo '<form action="assign_course_std.php" id="assignmentForm" method="POST">'; // Corrected form tag
            echo '<div id="course-form">';
            echo '<label for="coursename">Course Name:</label>';
            echo '<input type="text" name="coursename" id="coursename" value="' . $coursename . '" required>';
            echo '<br>';
            echo '<label for="date">Course Date:</label>';
            echo '<input type="date" name="date" id="date" value="' . $date . '" required>';
            echo '<br>';
            echo '<label for="coursedescription">Course Description:</label>';
            echo '<textarea name="coursedescription" id="coursedescription" required>' . $coursedescription . '</textarea>';
            echo '<br>';
            echo '<label for="courselink">Course Link:</label>';
            echo '<input type="text" name="courselink" id="courselink" value="' . $courselink . '" required>';
            echo '<br>';
            echo '<label for="practicallink">Practical Link:</label>';
            echo '<input type="text" name="practicallink" id="practicallink" value="' . $practicallink . '" required>';
            echo '<br>';
            echo '<input type="hidden" name="id" value="' . $id . '">'; // Hidden field to carry course ID
            echo '<button type="submit" class="inline-btn">Update Course</button>';
            echo '</div>';
            echo '</form>';
            echo '</div>';
        } 

// Close the database connection
$conn->close();
?>
