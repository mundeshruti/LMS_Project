<?php
// Include the file to establish database connection
include 'connect_db.php';

// Check if course_name is sent via POST
if (isset($_POST['course_name'])) {
    // Retrieve course_name from the POST request
    $course_name = $_POST['course_name'];

    // Prepare and execute SQL query to select course duration based on course_name
    $sql = "SELECT course_duration FROM create_course WHERE course_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a result is found
    if ($result->num_rows > 0) {
        // Fetch the course duration
        $row = $result->fetch_assoc();
        $course_duration = $row['course_duration'];

        // Return course duration as JSON response
        echo json_encode(['course_duration' => $course_duration]);
    } else {
        // If no result found, return an empty response
        echo json_encode(['course_duration' => '']);
    }
} else {
    // If course_name is not set in the POST request, return an empty response
    echo json_encode(['course_duration' => '']);
}

// Close the database connection
$stmt->close();
$conn->close();
?>
