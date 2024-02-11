<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms_db"; 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"]; 

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    
    if ($email === "superadmin@gmail.com" && $password === "12345678") {
        echo "<script>window.location.href = 'superadmin/home.php';</script>";
    } 
    else {
        // $error_message = "Wrong username or password";
        // echo "<p style='color: red;'>Wrong username or password</p>";
        echo '<script>';
        echo 'alert("Wrong username or password");';
        echo 'window.location.href = "index.html";';
        echo '</script>';
        exit();
    }
}

$conn->close();
?>
