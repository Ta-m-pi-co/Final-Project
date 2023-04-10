<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

if (isset($_POST['update'])) {

  $productId = $_POST['productId'];

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $price = $_POST['price'];
  $price = filter_var($price, FILTER_SANITIZE_STRING);

  $details = $_POST['details'];
  $details = filter_var($details, FILTER_SANITIZE_STRING);

  $updateProduct = $conn->prepare("UPDATE `products` SET name = ?, price = ?, details = ? WHERE id = ?");
  $updateProduct->execute([$name, $price, $details, $productId]);

  $message[] = 'Item updated successfully';





  $oldImage1 = $_POST['oldImage1'];
  $image1 = $_FILES['image1']['name'];
  $image1 = filter_var($image1, FILTER_SANITIZE_STRING);
  $image1Size = $_FILES['image1']['size'];
  $image1TmpName = $_FILES['image1']['tmp_name'];
  $image1Folder = '../images/' . $image1;

  if (!empty($image1)) {
    if ($image1Size > 2000000) {
      $message[] = 'image is too large!';
    } else {
      $updateImage1 = $conn->prepare("UPDATE `products` SET image1 = ? WHERE id = ?");
      $updateImage1->execute([$image1, $productId]);
      move_uploaded_file($image1TmpName, $image1Folder);
      unlink('../images/' . $oldImage1);
      $message[] = 'image 1 updated successfully!';
    }
  }

  $oldImage2 = $_POST['oldImage2'];
  $image2 = $_FILES['image2']['name'];
  $image2 = filter_var($image2, FILTER_SANITIZE_STRING);
  $image2Size = $_FILES['image2']['size'];
  $image2TmpName = $_FILES['image2']['tmp_name'];
  $image2Folder = '../images/' . $image2;

  if (!empty($image2)) {
    if ($image2Size > 2000000) {
      $message[] = 'image is too large!';
    } else {
      $updateImage2 = $conn->prepare("UPDATE `products` SET image2 = ? WHERE id = ?");
      $updateImage2->execute([$image2, $productId]);
      move_uploaded_file($image2TmpName, $image2Folder);
      unlink('../images/' . $oldImage2);
      $message[] = 'image 2 updated successfully!';
    }
  };

  $oldImage3 = $_POST['oldImage3'];
  $image3 = $_FILES['image3']['name'];
  $image3 = filter_var($image3, FILTER_SANITIZE_STRING);
  $image3Size = $_FILES['image3']['size'];
  $image3TmpName = $_FILES['image3']['tmp_name'];
  $image3Folder = '../images/' . $image3;

  if (!empty($image3)) {
    if ($image3Size > 2000000) {
      $message[] = 'image is too large!';
    } else {
      $updateImage3 = $conn->prepare("UPDATE `products` SET image3 = ? WHERE id = ?");
      $updateImage3->execute([$image3, $productId]);
      move_uploaded_file($image3TmpName, $image3Folder);
      unlink('../images/' . $oldImage3);
      $message[] = 'image 3 updated successfully!';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Update Products</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>


  <?php include '../components/headerAdmin.php'; ?>


  <section class="updateProduct">

    <h1 class="heading">update product</h1>

    <?php
    $updateId = $_GET['update'];


    $selectProducts = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $selectProducts->execute([$updateId]);

    if ($selectProducts->rowCount() > 0) {
      while ($fetchProducts = $displayProducts->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="productId" value="<?= $fetchProducts['id']; ?>">
          <input type="hidden" name="oldImage1" value="<?= $fetchProducts['image1']; ?>">
          <input type="hidden" name="oldImage2" value="<?= $fetchProducts['image2']; ?>">
          <input type="hidden" name="oldImage3" value="<?= $fetchProducts['image3']; ?>">

          <div class="imageContainer">
            <div class="mainImage">
              <img src="../images/<?= $fetchProducts['image1']; ?>" alt="">
            </div>

            <div class="subImages">
              <img src="../images/<?= $fetchProducts['image1']; ?>" alt="">
              <img src="../images/<?= $fetchProducts['image2']; ?>" alt="">
              <img src="../images/<?= $fetchProducts['image3']; ?>" alt="">
            </div>
          </div>

          <span>Update Product Name</span>
          <input type="text" placeholder="enter name of product" class="box" name="name" maxlength="100" value="<?= $fetchProducts['name']; ?>">

          <span>Update Product Price</span>
          <input type="number" min="0" max="999999999" placeholder="enter price of product" class="box" name="price" onkeypress="if(this.value.length == 9) return false;" value="<?= $fetchProducts['price']; ?>">

          <span>Update Product Details</span>
          <textarea name="details" class="box" placeholder="enter product details here!" cols="30" rows="10" maxlength="500" value="<?= $fetchProducts['details']; ?>"></textarea>

          <span>Update Product Images</span>
          <input type="file" name="image1" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
          <input type="file" name="image2" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
          <input type="file" name="image3" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">

          <div class="flexBtn">
            <input type="submit" value="update" class="btn" name="update">
            <a href="products.php" class="optionBtn">Back</a>
          </div>
        </form>
    <?php
      }
    } else {
      echo '<p class="empty">no products to display</p>';
    }
    ?>

  </section>






  <script src="../javascript/admin.js"></script>

</body>

</html>