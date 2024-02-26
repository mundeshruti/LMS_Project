<style>
  .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around; /* Adjust as needed */
  }


  .tutor img {
    width: 80px;
    height: 80px;
    border-radius: 50%; /* Make the image circular */
    object-fit: cover; /* Maintain aspect ratio while covering the container */
  }

  .box {
    text-align: center; /* Center the content within the box */
  }

  .stu-box {
    margin-top: 10px; /* Adjust margin as needed */
  }
</style>
<?php
include 'connect_db.php'; // Include your database connection file

// Handle search form submission
if (isset($_POST['search_student'])) {
    $searchKeyword = $_POST['search_box'];
    $sql = "SELECT * FROM register_student WHERE name LIKE '%$searchKeyword%'";
} else {
    // Fetch all student data from the database
    $sql = "SELECT * FROM register_student";
}

$result = $conn->query($sql);

// Check if there are any rows in the result set
if ($result->num_rows > 0) {
    $studentsPerRow = 6; // Adjust this number as needed

    // Loop through each row and display student information
    $counter = 0;
    echo '<div class="row">'; // Start the first row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="box">';
        echo '<div class="tutor">';
        echo '<img src="' . $row['image_path'] . '" alt="" style="width: 80px; height: 80px;">' ;
        echo '<div class="stu-box">';
        echo '<h3>' . $row['name'] . '</h3>';
       
        // echo '<span>' . $row['profession'] . '</span>';
        echo '</div>';
        echo '</div>';
        
        // View Profile Icon
        echo '<a href="student_profile.php?id=' . $row['id'] . '" class="icon-btn"><img src="images/view_icon.png" alt="View Profile" style="width: 20px; height: 20px;"></a>';

        // Delete Icon
        echo '<a href="delete_student.php?id=' . $row['id'] . '" class="icon-btn"><img src="images/delete_icon.png" alt="Delete" style="width: 20px; height: 20px;"></a>';
        
        // Edit Icon
        echo '<a href="edit_student.php?id=' . $row['id'] . '" class="icon-btn"><img src="images/edit_icon.png" alt="Edit" style="width: 20px; height: 20px;"></a>';
        
        echo '</div>';

        $counter++;

        if ($counter % $studentsPerRow === 0) {
            // End the current row and start a new one
            echo '</div>';
            echo '<div class="row">';
        }
    }

    // Check if there are any remaining students not in a complete row
    if ($counter % $studentsPerRow !== 0) {
        // Close the last row
        echo '</div>';
    }
} else {
    echo 'No students found.';
}

// Close the database connection
$conn->close();
?>
