<?php
// Example of fetching admin data from the database
$conn = new mysqli("localhost", "root", "", "lms_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch admin data from the database
$course_query = "SELECT id, coursename FROM courses";
$course_result = $conn->query($course_query);

// Check if the query was successful
if (!$course_result) {
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
        <option value="All-Course">All Course</option>
            <?php
            
            // Loop through the results and generate options dynamically
            while ($row = $course_result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['coursename'] . '</option>';
                
            }
            ?>
        </select> 
        <br>
        <label for="notification-message">Notification Message:</label>
        <textarea id="notification-message" rows="5"></textarea>
        <br>
        <button onclick="sendNotificationByAdmin()" class="inline-btn">Send Notification</button>
    </div>

    <!-- Unread Notification Count -->
    <div id="unread-count" class="unread-count"></div>

    <!-- Notification Container -->
    <div id="notification-container" class="notification-container"></div>

    <!-- Custom JS file link -->
   
    <script src="js/admin_script.js"></script>
    
<?php include 'sidebar.php'; ?>

</body>


</html>