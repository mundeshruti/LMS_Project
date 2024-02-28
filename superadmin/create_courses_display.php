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

    <?php include 'header.php'; ?>

    <section class="teachers">
        <div class="box-container">
            <form action="" method="post" class="search-tutor">
                <input type="text" name="search_box" placeholder="Search Courses Here..." maxlength="100">
                <button type="submit" class="fas fa-search" name="search_tutor"></button>
            </form>
        </div>
        <div class="box-container">
            <?php
            include 'connect_db.php';
            $tableName = "create_course";
            // Check if the form is submitted for deletion
            if (isset($_POST['delete_course'])) {
                $courseIdToDelete = $_POST['course_id_to_delete'];
                $sql = "DELETE FROM $tableName WHERE course_id = $courseIdToDelete";
                $result = $conn->query($sql);
                if ($result) {
                    $successMessage = "Course deleted successfully.";
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
                    $errorMessage = "Error deleting course: " . $conn->error;
                }
            }

            // Check if the form is submitted for searching
            if (isset($_POST['search_tutor'])) {
                $search_query = $_POST['search_box'];
                $search_sql = "SELECT * FROM $tableName WHERE course_name LIKE '%$search_query%'";
                $result = $conn->query($search_sql);
            } else {
                $sql = "SELECT * FROM $tableName";
                $result = $conn->query($sql);
            }

            // Check if the result is an object
            if ($result instanceof mysqli_result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="box">
                        <div class="tutor">
                            <div>
                                <h3>
                                    <?php echo $row['course_name']; ?>
                                </h3>
                                <span>Duration:
                                    <?php echo $row['course_duration']; ?>
                                    <span>Days</span>
                                </span>
                            </div>
                        </div>
                        <div class="tutor">
                            <a href="view_create_course.php?id=<?php echo $row['course_id']; ?>" class="button">View</a>
                            <a href="edit_course.php?id=<?php echo $row['course_id']; ?>" class="button"
                                style="background-color:var(--main-color);">Edit</a>
                            <form method="post" class="delete-form">
                                <input type="hidden" name="course_id_to_delete" value="<?php echo $row['course_id']; ?>">
                                <button type="submit" name="delete_course" class="delete-button"
                                    onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>

                            </form>

                        </div>
                    </div>
                    <?php
                }
            } else {
                $errorMessage = "No courses found.";
            }
            ?>

        </div>
    </section>

    <!-- <?php if (isset($successMessage)): ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?> -->

    <?php if (isset($errorMessage)): ?>
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <script src="js/script.js"></script>
    <?php include 'sidebar.php'; ?>

</body>
<script>
    // Get the search input element
    var searchBox = document.getElementById('searchBox');
    // Get the search result container
    var searchResult = document.getElementById('searchResult');

    // Add input event listener to the search input
    searchBox.addEventListener('input', function() {
        // Get the value entered in the search input
        var searchText = searchBox.value.trim();
        
        // Check if the search text is not empty
        if (searchText !== '') {
            // Call a function to fetch and display search results
            fetchSearchResults(searchText);
        } else {
            // If the search text is empty, clear the search results
            searchResult.innerHTML = '';
        }
    });

    // Function to fetch and display search results
    function fetchSearchResults(searchText) {
        // Here you can use AJAX to fetch search results from the server based on the searchText
        // For demonstration, let's assume we have searchResults as an array of matching results
        var searchResults = ['Result 1', 'Result 2', 'Result 3'];

        // Generate HTML for displaying search results
        var searchResultsHTML = '';
        searchResults.forEach(function(result) {
            searchResultsHTML += '<div>' + result + '</div>';
        });

        // Display search results in the searchResult container
        searchResult.innerHTML = searchResultsHTML;
    }
</script>


</html>