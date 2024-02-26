

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>records</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'header.php'; ?>
<section class="teachers">

    <h1 class="heading">Students Report</h1><!--Newly created-->
 
    <form action="" method="post" class="search-form" style="margin: 15px; display: flex; gap: 2rem;">
       <input type="text" name="search_box" placeholder="search student" required maxlength="100" style="width: 50rem;
       border-radius: .5rem;
       display: flex;
       align-items: center;
       gap: 2rem;
       padding: 1.5rem 2rem;">
       <button type="submit" class="fas fa-search" name="search_student"></button>

       <label>from:</label>
  <input type="date">
 
  <label style="font-size: 10px;">to:</label>
  <input type="date" >
  <input type="submit" class="btn" style="width: 25%;">
  <i class="fa-solid fa-file-pdf" style="font-size: 40px;"></i>
  <i class="fa-solid fa-file-word" style="font-size: 40px;"></i>
    </form>
    
 
    <div class="box-container" style="display: grid;
    grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
    align-items: flex-start;
    justify-content: center;
    gap: 1.5rem;">

<table>
    <tr>
      <th>sr no</th>
      <th>name</th>
      <th>location</th>
      <th>address</th>
      <th>date time</th>
      <th>action</th>
    </tr>
    <tr>
      <td>01</td>
      <td>Maria Anders</td>
      <td>Germany</td>
      <td>pune</td>
      <td>9.25</td>
      <td><button class="option-btn">delete</button></td>
      
    </tr>
    <tr>
      <td>02</td>
      <td>Francisco Chang</td>
      <td>Mexico</td>
      <td>pune</td>
      <td>9.25</td>
      <td><button class="option-btn">delete</button></td>
    </tr>
    <tr>
      <td>03</td>
      <td>Roland Mendel</td>
      <td>Austria</td>
      <td>pune</td>
      <td>9.25</td>
      <td><button class="option-btn">delete</button></td>
    </tr>
    <tr>
      <td>04</td>
      <td>Helen Bennett</td>
      <td>UK</td>
      <td>pune</td>
      <td>9.25</td>
      <td><button class="option-btn">delete</button></td>
    </tr>
    <tr>
      <td>05</td>
      <td>Yoshi Tannamuri</td>
      <td>Canada</td>
      <td>pune</td>
      <td>9.25</td>
      <td><button class="option-btn">delete</button></td>
    </tr>
    <tr>
      <td>06</td>
      <td>Giovanni Rovelli</td>
      <td>Italy</td>
      <td>pune</td>
      <td>9.25</td>
      <td><button class="option-btn">delete</button></td>
    </tr>
  </table>


    </div>
</section>








      

<script src="js/admin_script.js"></script>

<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

<?php include 'sidebar.php'; ?>
</body>
</html>