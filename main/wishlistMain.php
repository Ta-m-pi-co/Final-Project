<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
  header('location:home.php');
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

  <section class="wishlist">
    <h1 class="heading">your wishlist</h1>

    <div class="boxContainer">
      <?
      $selectWishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE userID = ?");
      $selectWishlist->execute([$userID]);

      if ($selectWishlist->rowCount() > 0) {

        while ($fetchWishlist = $selectWishlist->fetch(PDO::FETCH_ASSOC)) {

      ?>

          <form action="" method="post" class="box">
            <a href="itemView.php?productID=<?= $fetchWishlist['productID']; ?>" class="fas fa-eye"></a>
            <button type="submit" name="delete" class="fas fa-heart-broken"></button>
            <a href="itemView.php?productID=<?= $fetchWishlist['productID']; ?>"><img src="../images/<?= $fetchWishlist['image']; ?>" alt="" class="image"></a>
            <div class="name"><?= $fetchWishlist['name']; ?></div>
            <div class="flex">
              <div class="price">£<?= $fetchWishlist['price']; ?></div>
              <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false">
            </div>
            <input type="submit" value="add to basket" name="addToBasket" class="btn">
            <input type="submit" value="delete from wishlist?" name="delete" class="deleteBtn">
          </form>



      <?php
        }
      } else {
        echo '<p class="empty">Nothing Saved to Wishlist</p>';
      }
      ?>

    </div>



  </section>








  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>