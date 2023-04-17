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
  <title>View</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

  <link rel="stylesheet" href="../css/styleMain.css">
</head>

<body>

  <?php include '../components/headerUser.php'; ?>

  <section class="itemView">




    <?php
    $productID = $_GET['productID'];
    $selectProducts = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $selectProducts->execute([$productID]);

    if ($selectProducts->rowCount() > 0) {
      while ($fetchProducts = $selectProducts->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <h1 class="heading"><?= $fetchProducts['name']; ?></h1>
        <form action="" method="POST" class="box">
          <input type="hidden" name="productID" value="<?= $fetchProducts['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetchProducts['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetchProducts['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetchProducts['image1']; ?>">


          <div class="imageContainer">
            <div class="mainImage">
              <img src="../images/<?= $fetchProducts['image1']; ?>" alt="">
            </div>
            <div class="subImage">
              <img src="../images/<?= $fetchProducts['image1']; ?>" alt="">
              <img src="../images/<?= $fetchProducts['image2']; ?>" alt="">
              <img src="../images/<?= $fetchProducts['image3']; ?>" alt="">
            </div>
          </div>


          <div class="content">

            <div class="name"><?= $fetchProducts['name']; ?></div>

            <div class="flex">

              <div class="price">£<span><?= $fetchProducts['price']; ?></div>

              <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false">

            </div>

            <div class="details">
              <?= $fetchProducts['details']; ?>
            </div>


            <div class="flexBtn">
              <input type="submit" value="add to basket" name="addToBasket" class="btn">
              <input type="submit" value="add to wishlist" name="addToWishlist" class="optionBtn">
            </div>
          </div>

        </form>
    <?php
      }
    } else {
      echo '<p class="empty">no products</p>';
    }


    ?>




  </section>








  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>