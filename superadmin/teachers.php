<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Other meta tags and stylesheets -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
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

        .email-container {
            width: 200px;
            /* Adjust the width as needed */
            overflow: hidden;
            text-overflow: ellipsis;
            /* Display ellipsis (...) for overflowing text */
            white-space: nowrap;
            /* Prevent text from wrapping */
        }
    </style>


</head>

<body>
    <?php include 'header.php'; ?>
    <section class="teachers">
        <h1 class="heading">Prominent Admin</h1><!--Newly created-->

        <form action="" method="post" class="search-tutor">
            <input type="text" name="search_box" placeholder="Search Courses Here..." maxlength="100">
            <button type="submit" class="fas fa-search" name="search_tutor"></button>
        </form>

        <!-- <div id="searchResult"></div> -->

        <script>
            $(document).ready(function () {
                $('#searchBox').on('input', function () {
                    $('#searchForm').submit();
                });

                $('#searchForm').on('submit', function (e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'search.php', // Your PHP script to handle search
                        data: formData,
                        success: function (response) {
                            $('#searchResult').html(response);
                        }
                    });
                });
            });
        </script>
        <div class="box-container">

            <div class="box offer">
                <h3>Add Admin</h3><!--Newly created-->
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
                    echo "<script>
                            $(document).ready(function() {
                                var popup = $('<div class=\"success-popup\">$successMessage</div>');
                                $('body').prepend(popup);
                                setTimeout(function() {
                                    popup.fadeOut();
                                }, 3000); // 3000 milliseconds = 3 seconds, adjust as needed
                            });
                          </script>";

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
                                <div class="email-container">
                                    <span>
                                        <?php echo $row['email']; ?>
                                    </span>
                                </div>
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

    <?php if (isset($errorMessage)): ?>
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>


    <script src="js/script.js"></script>


    <?php include 'sidebar.php'; ?>

</body>

</html>