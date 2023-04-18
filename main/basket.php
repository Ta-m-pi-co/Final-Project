<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
}

include '../components/wishlistBasket.php';

if (isset($_POST['delete'])) {
  $basketId = $_POST['basketId'];
  $deleteBasket = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
  $deleteBasket->execute([$basketId]);
  $message[] = 'Removed from Basket!';
}

if (isset($_GET['deleteAll'])) {
  $deleteAll = $_GET['deleteAll'];
  $deleteAllBasketItems = $conn->prepare("DELETE FROM `cart` WHERE userID = ?");
  $deleteAllBasketItems->execute([$userID]);
  header('location:basket.php');
  $message[] = 'All Items Deleted From Basket!';
}

if (isset($_POST['updateQty'])) {
  $basketId = $_POST['basketId'];
  $qty = $_POST['qty'];
  $updateQty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
  $updateQty->execute([$qty, $basketId]);
  $message[] = 'item quantity updated successfully';
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

  <section class="basket">
    <h1 class="heading">Basket</h1>

    <div class="boxContainer">
      <?php
      $TotalPrice = 0;
      $selectBasket = $conn->prepare("SELECT * FROM `cart` WHERE userID = ?");
      $selectBasket->execute([$userID]);

      if ($selectBasket->rowCount() > 0) {

        while ($fetchBasket = $selectBasket->fetch(PDO::FETCH_ASSOC)) {

      ?>

          <form action="" method="post" class="box">

            <input type="hidden" name="basketId" value="<?= $fetchBasket['id']; ?>">

            <a href="itemView.php?productID=<?= $fetchBasket['productID']; ?>" class="fas fa-eye"></a>

            <button type="submit" name="delete" class="fas fa-trash-alt"></button>

            <a href="itemView.php?productID=<?= $fetchBasket['productID']; ?>"><img src="../images/<?= $fetchBasket['image']; ?>" alt="" class="image"></a>
            <div class="name"><?= $fetchBasket['name']; ?></div>
            <div class="flex">
              <div class="price">£<?= $fetchBasket['price']; ?>/-</div>
              <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetchBasket['qty']; ?>" onkeypress="if(this.value.length == 2) return false">
              <button type="submit" class="fas fa-pencil" name="updateQty"></button>
            </div>
            <div class="subTotal">Sub-Total: £<span><?= $subTotal = $fetchBasket['price'] * $fetchBasket['qty'] ?>/-</span></div>

            <input type="submit" value="Remove From Basket?" name="delete" class="deleteBtn">
          </form>



      <?php
          $TotalPrice += $subTotal;
        }
      } else {
        echo '<p class="empty">Nothing in Basket. </p>';
      }
      ?>

    </div>


    <div class="totalPrice">
      <p>Grand Total : £<span><?= $TotalPrice; ?></span></p>
      <a href="store.php" class="optionBtn">Continue Shopping?</a>
      <a href="basket.php?deleteAll" class="deleteBtn <?= ($TotalPrice > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Are you sure you want to remove everything?')">Remove Everything From Basket?</a>
      <a href="checkout.php" class="btn <?= ($TotalPrice > 1) ? '' : 'disabled'; ?>">Checkout</a>
    </div>
  </section>








  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>