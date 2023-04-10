<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>products</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>


 <!-- add products -->

<section class="addProducts">
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="flex">
      <div class="iBoxes">
      <span>Product Name - REQUIRED</span>
      <input type="text" placeholder="enter name of product" class="box" name="name" maxlength="100" required>
    </div>

    <div class="iBoxes">
      <span>Price - REQUIRED</span>
      <input type="number" min="0" max="999999999" placeholder="enter price of product" class="box" name="price" onkeypress="if(this.value.length == 9) return false;" required>
    </div>

    <div class="iBoxes">
      <span>image 1 (required)</span>
      <input type="file" name="image01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
    </div>

    <div class="iBoxes">
      <span>image 2</span>
      <input type="file" name="image02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
    </div>

    <div class="iBoxes">
      <span>image 3</span>
      <input type="file" name="image03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
    </div>

    <div class="iBoxes">
      <span> product details</span>
      <textarea name="details" class="box" placeholder="enter product details here!" cols="30" rows="10" maxlength="500" required></textarea>
    </div>

    <input type="submit" value="confirm" name="confirmAddProduct" class="btn">


    </div>
  </form>




</section>






  <script src="../javascript/admin.js"></script>

</body>

</html>