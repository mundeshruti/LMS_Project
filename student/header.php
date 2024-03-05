<?php
include 'connect_db.php';


// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
   // Redirect to login page if admin is not logged in
   header("Location: index.php");
   exit();
}

// session_start();
//  $st_id = $_SESSION['st_id'];
$st_name = isset($_SESSION['st_name']) ? $_SESSION['st_name'] : '';
$user_email = isset($_SESSION['st_email']) ? $_SESSION['st_email'] : '';
$user_image = isset($_SESSION['st_image']) ? $_SESSION['st_image'] : '';
$st_admin_id = isset($_SESSION['st_admin_id']) ? $_SESSION['st_admin_id'] : '';
$st_course_id = isset($_SESSION['st_course_id']) ? $_SESSION['st_course_id'] : '';
$st_id = isset($_SESSION['st_id']) ? $_SESSION['st_id'] : '';

$fetch_unread_notification = "SELECT n.message,
a.name AS admin_name,
a.course_name AS course_name
from notification_records as nr
left join admin_student_course as a
on nr.student_id = a.student_id
left join notification as n
on nr.notification_id = n.id
where a.completed = 0 and a.admin_id in ('$st_admin_id', 0) and a.student_id = $st_id and nr.is_read = 0
group by a.course_name, nr.id, a.student_id
ORDER BY nr.id DESC";

$fetch_unread_notification_result = $conn->query($fetch_unread_notification);

// Check if the query was successful
if ($fetch_unread_notification_result) {
   $total_notifications = $fetch_unread_notification_result->num_rows;
} 
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">RSL Solution Pvt.Ltd</a>


      <div class="icons">

         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="notifications-btn" class="fa-solid fa-bell">
            <!-- Before using $total_records -->
            <?php if (isset($total_notifications)): ?>
               <span class="icon-button__badge">
                  <?php echo $total_notifications; ?>
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