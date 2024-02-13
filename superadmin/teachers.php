<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teachers</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include 'header.php'; ?>
    <section class="teachers">

        <h1 class="heading">Prominent Admin</h1><!--Newly created-->

        <form action="" method="post" class="search-tutor">
            <input type="text" name="search_box" placeholder="search Admin..." maxlength="100">
            <button type="submit" class="fas fa-search" name="search_tutor"></button>
        </form>


        <div class="box-container">

            <div class="box offer">
                <h3>Add a Admins</h3><!--Newly created-->
                <p>..........</p>
                <a href="register.php" class="inline-btn">Add Admin</a>
            </div>


            <?php
            include 'connect_db.php';

            $tableName = "admins";

            // Check if the form is submitted for deletion
            if (isset($_POST['delete_admin'])) {
                $adminIdToDelete = $_POST['admin_id_to_delete'];

                // SQL query to delete admin
                $sql = "DELETE FROM $tableName WHERE id = $adminIdToDelete";
                $result = $conn->query($sql);

                if ($result) {
                    $successMessage = "Admin deleted successfully.";
                } else {
                    $errorMessage = "Error deleting admin: " . $conn->error;
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
                            <img src="<?php echo $row['profile_image']; ?>" alt="">
                            <div>
                                <h3>
                                    <?php echo $row['name']; ?>
                                </h3>
                                <span>
                                    <?php echo $row['email']; ?>
                                </span>
                            </div>
                        </div>

                        <!-- View Profile link -->


                        <!-- Delete form -->
                        <div class="tutor">
                            <a href="teacher_profile.php?id=<?php echo $row['id']; ?>" class="inline-btn">View</a>
                            <form method="post" class="delete-form">
                                <input type="hidden" name="admin_id_to_delete" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_admin" class="inline-delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                $errorMessage = "No admins created by the super admin";
            }
            ?>



        </div>
    </section>


    <?php if (isset($successMessage)): ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($errorMessage)): ?>
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>


    <script src="js/script.js"></script>

    <?php include 'sidebar.php'; ?>

</body>

</html>