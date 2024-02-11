<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>courses</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
   body.dark {
      --light-color: #aaa;
      --light-bg: #333;
      --black: #fff;
      --white: #222;
      --border: .1rem solid rgba(255, 255, 255, .2);
   }

   body {
      font-family: 'Nunito', sans-serif;
      font-size: large;
   }

   #courseAssignment {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 500px;
      margin: 20px auto;
   }

   #courseAssignment h2 {
      text-align: center;
      color: #333;
   }

   #assignmentForm {
      display: flex;
      flex-direction: column;
   }

   label {
      margin-bottom: 8px;
   }

   select,
   input,
   button {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
   }

   button {
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
      border: none;
      border-radius: 4px;
   }

   button:hover {
      background-color: #45a049;
   }

   #course-form h2 {
      text-align: center;
   }

   select,
   input,
   button {
      margin-top: 10px;
   }

   #course-form label {
      display: block;
      margin-bottom: 8px;
   }

   #course-form select,
   #course-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
   }

   #assign-admin {
      border: 1px solid black;
   }

   #link {
      border: 1px solid black;
   }

   #course-form button {
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
   }

   #course-form button:hover {
      background-color: #0056b3;
   }
</style>

<body>

   <?php include 'header.php'; ?>

   <!-- Menu Section -->
   <div id="courseAssignment">
      <h2>Assign Courses to Admin</h2>
      <br>
      <form action="assign_course.php" id="assignmentForm" method="Post">
         <div id="course-form">
            <label for="link">Course:</label>
            <!-- <input type="text" name="coursename" id="link" placeholder="Enter Course Name here.."> -->
            <select name="coursename" id="link" required>
               <option value="" disabled selected>select your course</option>
               <option value="web developer">web developer</option>
               <option value="full stack developer">full stack developer</option>
               <option value="java developer">Java developer</option>

            </select>
            <br>
            <label for="link">Course description:</label>
            <textarea type="textarea" name="coursedescription" id="link"
               placeholder="Enter Course link here.."></textarea>
            <br>
            <label for="link">Date</label>
            <input type="date" name="date" id="link" placeholder="Enter Course date here..">
            <br>
            <!-- <label for="link">End Date</label>
            <input type="date" name="date" id="link" placeholder="Enter Course date here..">
            <br> -->
            <label for="link">Courses Link:</label>
            <input type="text" name="courselink" id="link" placeholder="Enter Course link here..">
            <br>
            <label for="link">Practical Link:</label>
            <input type="text" id="link" name="practicallink" placeholder="Enter Practical link here..">
            <br>
            <button class="inline-btn">Assign Course</button>
         </div>
      </form>

      <?php include 'sidebar.php'; ?>
</body>
<script src="js/script.js"></script>

</html>