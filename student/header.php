<?php
include 'connect_db.php';
// session_start();
//  $st_id = $_SESSION['st_id'];
$st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
$user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';
$user_image = isset($_SESSION['st_image']) ? $_SESSION['st_image'] : '';
$st_admin_id = isset($_SESSION['st_admin_id']) ? $_SESSION['st_admin_id'] : '';
$st_course_id = isset($_SESSION['st_course_id']) ? $_SESSION['st_course_id'] : '';
$st_id = isset($_SESSION['st_id']) ? $_SESSION['st_id'] : '';

$count_unread_notification = "SELECT COUNT(*) AS total FROM notification_records nr
LEFT JOIN notification n on nr.notification_id = n.id 
LEFT JOIN admins a ON n.admin_id = a.id
LEFT JOIN create_course c ON n.course_id = c.course_id
WHERE n.admin_id IN ('$st_admin_id', 0) AND n.course_id IN ('$st_course_id', 0) and nr.is_read = 0 and student_id = $st_id";

// $count_unread_notification_result = $conn->query($count_unread_notification);
// $total_records = $count_unread_notification_result->fetch_assoc()['total'];
$count_unread_notification_result = $conn->query($count_unread_notification);
if (!$count_unread_notification_result) {
   // Query execution failed
   echo "Error: " . $conn->error;
} else {
   // Query execution succeeded
   $total_records = $count_unread_notification_result->fetch_assoc()['total'];
}


$fetch_unread_notification = "SELECT
n.message,
a.name AS admin_name,
c.course_name AS course_name
FROM notification_records nr
LEFT JOIN notification n on nr.notification_id = n.id 
LEFT JOIN admins a ON n.admin_id = a.id
LEFT JOIN create_course c ON n.course_id = c.course_id
WHERE n.admin_id IN ('$st_admin_id', 0) AND n.course_id IN ('$st_course_id', 0) and nr.is_read = 0 and student_id = $st_id";

$fetch_unread_notification_result = $conn->query($fetch_unread_notification);

?>
<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">RSL Solution Pvt.Ltd</a>


      <div class="icons">

         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="notifications-btn" class="fa-solid fa-bell">
            <!-- Before using $total_records -->
            <?php if (isset($total_records)): ?>
               <span class="icon-button__badge">
                  <?php echo $total_records; ?>
               </span>
            <?php endif; ?>

         </div>

         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
      <div id="myModal" class="modal">

         <!-- Modal content -->
         <div class="modal-content">
            <button onclick="updateUnreadNotifications()" class="close">&times;</button>
            <div id="notification-container">
               <?php
               if ($fetch_unread_notification_result && $fetch_unread_notification_result->num_rows > 0) {
                  // Start building the HTML for notifications
                  $notifications_html = '<div class="notification-container">';

                  // Loop through the result set and add each notification to the HTML
                  while ($row = $fetch_unread_notification_result->fetch_assoc()) {
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
                  // If no notifications are found or query execution fails, you can display a message or perform any other action
                  echo "No New notifications found";
               }

               ?>
            </div>
            <br>
            <button onclick="updateUnreadNotifications()" class="inline-btn" style="display: block; margin: 0 auto;">Close</button>

         </div>

      </div>
      <div class="profile">
      <?php
             $imagePath = "../admin/uploads/" . basename($user_image);
             if (file_exists($imagePath)) {
                 echo "<img src=\"$imagePath\" class=\"image\" alt=\"$st_name's Profile Image\">";
             } else {
                 echo "Image not found.";
             }?>
         <p class="role">
            <?php echo $st_name; ?>
         </p>
         <a href="profile.php" class="btn">view profile</a>
         <a href="index.php" class="btn">logout</a>

      </div>
   </section>
</header>
<script src="js/admin_script.js"></script>
<script src="js/script.js"></script>