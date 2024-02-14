<?php
session_start();

// Assuming you have a database connection established in 'db_connection.php'
include 'connect_db.php';

$st_id = $_SESSION['st_id'];
$st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
$user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';
$user_image = isset($_SESSION['st_image']) ? $_SESSION['st_image'] : '';
$st_admin_id = isset($_SESSION['st_admin_id']) ? $_SESSION['st_admin_id'] : '';
$st_course_id = isset($_SESSION['st_course_id']) ? $_SESSION['st_course_id'] : '';

// Fetch admin data from the database
$notification_query = "SELECT nr.message,
CASE
    WHEN a.name IS NULL THEN 'All Admins'
    WHEN a.id > 0 THEN a.name
END AS admin_name,
CASE
	WHEN c.coursename IS NULL THEN 'All Courses'
    WHEN c.id > 0 THEN c.coursename
END AS course_name
FROM notification_records nr
LEFT JOIN admins a ON nr.admin_id = a.id
LEFT JOIN courses c ON nr.course_id = c.id
WHERE nr.admin_id In ('$st_admin_id', 0) AND nr.course_id IN ('$st_course_id', 0)
order by nr.id desc;";

$notification_result = $conn->query($notification_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Practicals</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'header.php'; ?>

<section class="practical">

   <div class="box-container">

      <div class="box offer">
         <h3>Notifications</h3>
         <p></p>
         <div id="notification-container">
    <?php
            if ($notification_result->num_rows > 0) {
                // Start building the HTML for notifications
                $notifications_html = '<div class="notification-container">';
                
                // Loop through the result set and add each notification to the HTML
                while ($row = $notification_result->fetch_assoc()) {
                    $message = $row['message'];
                    $admin_name = $row['admin_name'];
                    $course_name = $row['course_name'];
                    
                    // Add HTML for the current notification to the $notifications_html string
                    $notifications_html .= "<div class='notification'><strong> $admin_name : </strong> <strong> ($course_name) </strong> $message </div>";
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
    </div>

      </div>
</section> 
<!-- custom js file link  -->
<script src="js/script.js"></script>
   <script src="js/header.js"></script>
   
<?php include 'sidebar.php'; ?>

   
</body>
</html>