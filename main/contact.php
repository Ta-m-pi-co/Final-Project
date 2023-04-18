<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

  <link rel="stylesheet" href="../css/styleMain.css">
</head>

<body>

  <?php include '../components/headerUser.php'; ?>


<section class="formContainer">
  <form action="" class="box" method="post">
    <input type="text" name="name" placeholder="Enter Name" required maxlength="20" class="box">
    <input type="number" name="telephone" placeholder="Enter Phone Number" max="9999999999" min="0" class="box" onkeypress="if(this.value.length == 10) return false;">
    <input type="email" name="email" placeholder="Enter Email" required maxlength="50" class="box" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">




  </form>

</section>







  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>