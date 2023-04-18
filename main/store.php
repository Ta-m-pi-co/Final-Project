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


  <section class="products">


    <h1 class="heading">
      All Products
    </h1>

    <div class="boxContainer">

      <?php
      $category = $_GET['category'];
      $selectProducts = $conn->prepare("SELECT * FROM `products`");
      $selectProducts->execute();

      if ($selectProducts->rowCount() > 0) {
        while ($fetchProducts = $selectProducts->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <form action="" method="POST" class="box">
            <input type="hidden" name="productID" value="<?= $fetchProducts['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetchProducts['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetchProducts['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetchProducts['image1']; ?>">

            <button type="submit" name="addToWishlist" class="far fa-heart"></button>
            <a href="itemView.php?productID=<?= $fetchProducts['id']; ?>" class="fas fa-eye"></a>
            <img src="../images/<?= $fetchProducts['image1']; ?>" alt="" class="image">
            <div class="name"><?= $fetchProducts['name']; ?></div>
            <div class="flex">


              <div class="price">£<span><?= $fetchProducts['price']; ?></div>
              <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false">

            </div>

            <input type="submit" value="add to basket" name="addToBasket" class="btn">

          </form>
      <?php
        }
      } else {
        echo '<p class="empty">No products in stock</p>';
      }


      ?>
    </div>

  </section>







  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>