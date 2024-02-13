<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>courses</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="teachers">
   <div class="box-container">

      <!-- <div class="box offer">
         <h3>Create Course</h3>
         <p> ....</p>
         <a href="create_course.php" class="inline-btn">create course</a>
      </div> -->

      
      <?php
    include 'connect_db.php';

    $tableName = "create_course";

    // Check if the form is submitted for deletion
    if (isset($_POST['delete_course'])) {
        $courseIdToDelete = $_POST['course_id_to_delete'];

        // SQL query to delete admin
        $sql = "DELETE FROM $tableName WHERE course_id = $courseIdToDelete";
        $result = $conn->query($sql);

        if ($result) {
            $successMessage = "course deleted successfully.";
        } else {
            $errorMessage = "Error deleting course: " . $conn->error;
        }
    }

    // SQL query to fetch admins created by the super admin
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Check if the form is submitted for search
    if (isset($_POST['search_tutor'])) {
        // Get the search query
        $search_query = $_POST['search_box'];

        // SQL query to search for admins
        $search_sql = "SELECT * FROM $tableName WHERE name LIKE '%$search_query%'";
        $result = $conn->query($search_sql);
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <div class="box">
                <!-- Display admin information -->
                <div class="tutor">
                    <!-- Display admin profile image, name, and email -->
                    <div>
                    <h3><?php echo $row['course_name']; ?></h3>
                         
                        <!-- <h3>Description<?php echo $row['course_description']; ?></h3> -->
                        <span>Duration: <?php echo $row['course_duration']; ?></span>
                    </div>
                </div>

                <div class="tutor">
                <a href="view_create_course.php?id= <?php echo $row['course_id']; ?>"class="inline-btn">View</a>
                <form method="post" class="delete-form" >
                    <input type="hidden" name="course_id_to_delete" value="<?php echo $row['course_id']; ?>">
                    <button type="submit" name="delete_course" class="inline-delete-btn" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                 </form>
                </div>
            </div>
<?php
        }
    } else {
        $errorMessage = "No course created by the super admin";
    }
?>



   </div>
</section>


<?php if (isset($successMessage)) : ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <?php if (isset($errorMessage)) : ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php endif; ?>


<script src="js/script.js"></script>

<?php include 'sidebar.php'; ?>
   
</body>
</html>