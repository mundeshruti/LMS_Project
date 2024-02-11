<?php
include 'connect_db.php'; // Include the database connection file

error_reporting(E_ALL);
ini_set('display_errors', 1);

$name = $email = $password = "";
$emailError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['pass']), PASSWORD_BCRYPT);

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, '@') === false) {
        $emailError = "Invalid email address.";
    }

    // Handle uploaded profile image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (empty($emailError) && move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $profile_image = mysqli_real_escape_string($conn, $target_file);

        // Insert data into the 'admins' table
        $sql = "INSERT INTO admins (name, email, password, profile_image) VALUES ('$name', '$email', '$password', '$profile_image')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to teachers.php after successful registration
            header("Location: teachers.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>

<!-- HTML Form with JavaScript for Validation -->
<section class="form-container">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
      <h3>register now</h3>
      <p>your name <span>*</span></p>
      <input type="text" name="name" id="name" placeholder="enter your name" required maxlength="50" class="box">
      
      <p>your email <span>*</span></p>
      <input type="email" name="email" id="email" placeholder="enter your email" required maxlength="50" class="box">
      <span id="emailError" style="color: red;"><?php echo $emailError; ?></span>
      
      <p>your password <span>*</span></p>
      <input type="password" name="pass" id="pass" placeholder="enter your password" required maxlength="20" class="box">
      
      <p>select profile <span>*</span></p>
      <label for="file" class="file-label">Select Profile Image</label>
      <input type="file" name="file" id="file" accept="image/*" required class="box">
      
      <input type="submit" value="register new" name="submit" class="btn">
   </form>

   <script>
      function validateForm() {
         // You can add more validation logic here if needed
         var email = document.getElementById('email').value;

         if (!email.includes('@') || !email.endsWith('.com')) {
            document.getElementById('emailError').innerHTML = "Invalid email address.";
            return false;
         }

         return true;
      }
   </script>
</section>
