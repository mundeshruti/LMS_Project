<?php
// Example of fetching admin data from the database
$conn = new mysqli("localhost", "root", "root123", "lms_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch admin data from the database
$sql = "SELECT id, name FROM admins";
$result = $conn->query($sql);

// Fetch admin data from the database
$course_query = "SELECT id, coursename FROM courses";
$course_result = $conn->query($course_query);

// Fetch admin data from the database
$notification_query = "SELECT
nr.message,
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
WHERE is_createdby_superadmin = 1";

$notification_result = $conn->query($notification_query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
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
    </style>

</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Notification Form and Container Section -->
    <div id="notification-form">
        <h2>Send Notification</h2>
        <label for="recipient-type">Select Recipient Type:</label>
        <select id="recipient-type">
            <option value="alladmins">All Admins</option>
            <div id="notification-container" class="notification-container">
            <?php
            // Loop through the results and generate options dynamically
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['name'] . " - " .  $row['id'] . '</option>';      
            }
            ?>
        </select>
        <br>
        <label for="recipient">Select Recipient:</label>
        <select id="recipient">
            <option value="All-Course">All Course</option>
            <?php
            
            // Loop through the results and generate options dynamically
            while ($row = $course_result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['coursename'] . '</option>'; 
            }
            ?>
            </div>
        </select>
        <br>
        <label for="notification-message">Notification Message:</label>
        <textarea id="notification-message" rows="5"></textarea>
        <br>
        <button onclick="sendNotificationBySuperadmin()" class="inline-btn">Send Notification</button>
    </div>

    <div id="unread-count" class="unread-count"></div>
    <div id="notification-container">
            <?php
            if ($notification_result->num_rows > 0) {
                // Start building the HTML for notifications
                $notifications_html = '<div class="notification-container">';
                
                // Loop through the result set and add each notification to the HTML
                while ($row = $notification_result->fetch_assoc()) {
                    $adminName = $row['admin_name'];
                    $message = $row['message'];
                    $courseName = $row['course_name'];
                    
                    // Add HTML for the current notification to the $notifications_html string
                    $notifications_html .= "<div class='notification'><strong> Super Admin: </strong> $adminName: ($courseName) $message</div>";
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

    <!-- Custom JS file link -->
    <script src="js/script.js"></script>
    <?php include 'sidebar.php'; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
