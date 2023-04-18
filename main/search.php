<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
}
include '../components/wishlistBasket.php'

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

  <section class="searchForm">
    <form action="" method="post">
      <input type="text" class="box" maxlength="100" placeholder="search here..." name="searchBox" required>
      <button type="submit" class="fas fa-search" name="searchBtn"></button>

    </form>

  </section>

  <section class="products" style="padding-top: 0; min-height: 100vh; ">

    <div class="boxContainer">

      <?php
      if (isset($_POST['searchBox']) or isset($_POST['searchBtn'])) {

        $searchBox  = $_POST['searchBox'];

        $selectProducts = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$searchBox}%'");
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
              <a href="itemView.php?productID=<?= $fetchProducts['id']; ?>"><img src="../images/<?= $fetchProducts['image1']; ?>" alt="" class="image"></a>
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
          echo '<p class="empty">No Products Found! Try Again.</p>';
        }
      }

      ?>
    </div>

  </section>








  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>