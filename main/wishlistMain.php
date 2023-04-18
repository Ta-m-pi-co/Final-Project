<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
  header('location:userLogin.php');
}
include '../components/wishlistBasket.php';

if (isset($_POST['delete'])) {
  $wishlistId = $_POST['wishlistId'];
  $deleteWishlist = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
  $deleteWishlist->execute([$wishlistId]);
  $message[] = 'Removed from Wishlist';
}

if (isset($_GET['deleteAll'])) {
  $deleteAll = $_GET['deleteAll'];
  $deleteAllWishlistItems = $conn->prepare("DELETE FROM `wishlist` WHERE userID = ?");
  $deleteAllWishlistItems->execute([$userID]);
  header('location:wishlistMain.php');
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
      <?php
      $TotalPrice = 0;
      $selectWishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE userID = ?");
      $selectWishlist->execute([$userID]);

      if ($selectWishlist->rowCount() > 0) {

        while ($fetchWishlist = $selectWishlist->fetch(PDO::FETCH_ASSOC)) {
          $TotalPrice += $fetchWishlist['price'];

      ?>

          <form action="" method="post" class="box">

            <input type="hidden" name="productID" value="<?= $fetchWishlist['productID']; ?>">
            <input type="hidden" name="name" value="<?= $fetchWishlist['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetchWishlist['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetchWishlist['image']; ?>">
            <input type="hidden" name="wishlistId" value="<?= $fetchWishlist['id']; ?>">

            <a href="itemView.php?productID=<?= $fetchWishlist['productID']; ?>" class="fas fa-eye"></a>
            <button type="submit" name="delete" class="fas fa-heart-broken"></button>
            <a href="itemView.php?productID=<?= $fetchWishlist['productID']; ?>"><img src="../images/<?= $fetchWishlist['image']; ?>" alt="" class="image"></a>
            <div class="name"><?= $fetchWishlist['name']; ?></div>
            <div class="flex">
              <div class="price">£<?= $fetchWishlist['price']; ?>/-</div>
              <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false">
            </div>
            <input type="submit" value="add to basket" name="addToBasket" class="btn">
            <input type="submit" value="Remove From Wishlist?" name="delete" class="deleteBtn">
          </form>



      <?php
        }
      } else {
        echo '<p class="empty">Nothing Saved to Wishlist</p>';
      }
      ?>

    </div>


    <div class="totalPrice">
      <p>Grand Total : £<span><?= $TotalPrice; ?></span></p>
      <a href="store.php" class="optionBtn">Continue Shopping?</a>
      <a href="wishlistMain.php?deleteAll" class="deleteBtn <?= ($TotalPrice > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Are you sure you want to remove everything?')">Remove All Wishlist Items?</a>
    </div>
  </section>








  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>