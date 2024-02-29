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
$st_id = isset($_SESSION['st_id']) ? $_SESSION['st_id'] : '';

// Pagination parameters
$limit = 5; // Number of notifications per page

$notification_query = "SELECT n.message,
            a.name AS admin_name,
            a.course_name AS course_name
            from notification_records as nr
            left join admin_student_course as a
            on nr.student_id = a.student_id
            left join notification as n
            on nr.notification_id = n.id
            where a.completed = 0 and a.admin_id in ('$st_admin_id', 0) and a.student_id = $st_id and nr.is_read = 1
            group by a.course_name, nr.id, a.student_id
            ORDER BY nr.id DESC";

$notification_result = $conn->query($notification_query);

// Check if the query was successful
if ($notification_result) {
    $total_notifications = $notification_result->num_rows;
    $total_pages = ceil($total_notifications / $limit);
} else {
    $total_pages = 0; // or set a default value
}

// Pagination parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$notification_query .= " LIMIT $limit OFFSET $offset";

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
                    $adminName = isset($row['admin_name']) ? $row['admin_name'] : 'All Admin';
                    $message = $row['message'];
                    $courseName = isset($row['course_name']) ? $row['course_name'] : 'All Course';
                    
                    // Add HTML for the current notification to the $notifications_html string
                    $notifications_html .= "<div class='notification'><strong> $adminName : </strong> <strong> ($courseName) </strong> $message </div>";
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
           
            <div id="pagination-container">
                <!-- Previous Button -->
                <?php if ($page > 1): ?>
                    <a href='notification.php?page=<?php echo ($page - 1); ?>'>&laquo; Previous</a>
                <?php endif; ?>

                <!-- Pagination links -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href='notification.php?page=<?php echo $i; ?>' <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>

                <!-- Next Button -->
                <?php if ($page < $total_pages): ?>
                    <a href='notification.php?page=<?php echo ($page + 1); ?>'>Next &raquo;</a>
                <?php endif; ?>
            </div>
      </div>

</section> 
<!-- custom js file link  -->
<script src="js/script.js"></script>
   <script src="js/header.js"></script>
   
<?php include 'sidebar.php'; ?>

   
</body>
</html>
