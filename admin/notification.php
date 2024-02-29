<?php
session_start(); 
include 'connect_db.php';

// Fetch admin data from the database
$course_query = "SELECT course_id, course_name coursename FROM create_course";
$course_result = $conn->query($course_query);

// Retrieve data from the AJAX request
$adminId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '-1';

// Pagination parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5; // Number of notifications per page
$offset = ($page - 1) * $limit;

$notification_query = "SELECT
    nr.message,
    a.name AS admin_name,
    c.course_name AS course_name
FROM notification nr
LEFT JOIN admins a ON nr.admin_id = a.id
LEFT JOIN create_course c ON nr.course_id = c.course_id
WHERE is_createdby_admin = 1 AND admin_id = '$adminId'
ORDER BY nr.id DESC LIMIT $limit OFFSET $offset";

$notification_result = $conn->query($notification_query);

// Calculate total number of pages
$sql = "SELECT COUNT(*) AS total FROM notification WHERE is_createdby_admin = 1 and admin_id = '$adminId'";
$result = $conn->query($sql);
if ($result) {
    $total_records = $result->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $limit);
} else {
    $total_pages = 0; // or set a default value
}

// Check if the query was successful
if (!$course_result || !$notification_result) {
    die("Query failed: " . $conn->error);
}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<style>
     body {
            font-family: 'Nunito', sans-serif;
            font-size: large;
            margin: 20;
            padding: 20;
        }

        #notification-form h2 {
            text-align: center;
        }

        #notification-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            position: relative;
        }

        .notification {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .notification:hover {
            background-color: #f9f9f9;
        }

        .notification.unread {
            background-color: #e6f7ff;
        }

        .notification header {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .notification time {
            color: #888;
            font-size: 12px;
        }

        #notification-count {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 50%;
        }

        select,
        button {
            margin-top: 10px;
        }

        #notification-form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        #notification-form label {
            display: block;
            margin-bottom: 8px;
        }

        #notification-form select,
        #notification-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        #recipient-type {
            border: 1px solid black;
        }

        #recipient {
            border: 1px solid black;
        }

        #notification-message {
            border: 1px solid black;
        }

        #notification-form button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        #notification-form button:hover {
            background-color: #0056b3;
        }

        #pagination-container {
            margin-top: 20px;
            text-align: center;
        }   

        #pagination-container a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }

        #pagination-container a.active {
            background-color: #007bff;
            color: #fff;
        }

        #pagination-container a:hover {
            background-color: #f0f0f0;
        }
</style>

<body oncontextmenu='return false' class='snippet-body'>
  
<?php include 'header.php'; ?>
    <!-- <a href="Add_notification.html" class="option-btn">Add Notification</a> -->
    <!-- side bar section ends -->
    <div id="notification-form">
        <h2>Send Notification</h2>
        <br>
        <label for="recipient">Select Recipient:</label>
        <select id="recipient">
        <option value="0">All Course</option>
            <?php
   
   // Include database connection
   include 'connect_db.php';


   // Get the admin's user_id from the session
   session_start();
   $admin_id = $_SESSION['user_id'];

   // SQL query to select all students assigned to the admin
   $sql = "SELECT * FROM assign_admin WHERE admin_id = '$admin_id'";

   // Execute the query
   $result = $conn->query($sql);

   // If there are rows in the result, generate dropdown options
   if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
         // Fetch the course name assigned to the admin
         $course_name = $row['course_name'];
         $course_id = $row['course_id'];
         // Display the course name as an option in the dropdown
         echo "<option value='" . $course_id . "'>" . $course_name . "</option>";
      }
   } else {
      echo "<option value=''>No courses found</option>";
   }
   ?>

            ?>
        </select> 
        <br>
        <label for="notification-message">Notification Message:</label>
        <textarea id="notification-message" rows="5"></textarea>
        <br>
        <button onclick="sendNotificationByAdmin()" class="inline-btn" style="display: block; margin: 0 auto;">Send Notification</button>
    </div>

    <!-- Unread Notification Count -->
    <div id="unread-count" class="unread-count"></div>
    <div id="notification-container">
    <?php
            if ($notification_result->num_rows > 0) {
                // Start building the HTML for notifications
                $notifications_html = '<div class="notification-container">';
                
                // Loop through the result set and add each notification to the HTML
                while ($row = $notification_result->fetch_assoc()) {
                    $adminName = isset($row['admin_name']) ? $row['admin_name'] : 'All Admin';
                    $message = $row['message'];
                    $courseName = isset($row['course_name']) ? $row['course_name'] : 'All Course';
                    
                    // Add HTML for the current notification to the $notifications_html string
                    $notifications_html .= "<div class='notification'><strong> $adminName: </strong> ($courseName) $message</div>";
                }
                
                // Close the notification container
                $notifications_html .= '</div>';
                
                // Output the complete HTML for notifications
                echo $notifications_html;
            } else {
                // If no notifications are found, you can display a message or perform any other action
                echo "No notifications found";
            }
            ?>

        <!-- Pagination links -->
        <div id="pagination-container">
            <?php if ($page > 1): ?>
                <a href='notification.php?page=<?php echo ($page - 1); ?>'>&laquo; Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href='notification.php?page=<?php echo $i; ?>' <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href='notification.php?page=<?php echo ($page + 1); ?>'>Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>

<!-- Custom JS file link -->
<script src="js/admin_script.js"></script>
<?php include 'sidebar.php'; ?>

</body>
</html>