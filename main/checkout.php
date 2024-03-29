<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
  header('location:userLogin.php');
}
if (isset($_POST['order'])) {

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $telephone = $_POST['telephone'];
  $telephone = filter_var($telephone, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $method = $_POST['method'];
  $method = filter_var($method, FILTER_SANITIZE_STRING);
  $address = $_POST['address1'] . ', ' . $_POST['address2'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['postCode'];
  $address = filter_var($address, FILTER_SANITIZE_STRING);
  $totalProducts = $_POST['totalProducts'];

  $totalPrice = $_POST['totalPrice'];


  $checkBasket = $conn->prepare("SELECT * FROM `cart` WHERE userID = ?");
  $checkBasket->execute([$userID]);

  if ($checkBasket->rowCount() > 0) {
    $insertOrder = $conn->prepare("INSERT INTO `orders`(userID, name, telephone, email, method, address, totalProducts, totalPrice) VALUES(?,?,?,?,?,?,?,?)");
    $insertOrder->execute([$userID, $name, $telephone, $email, $method, $address, $totalProducts, $totalPrice]);


    $deleteBasket = $conn->prepare("DELETE FROM `cart` WHERE userID = ?");
    $deleteBasket->execute([$userID]);

    $message[] = 'order placed';
  } else {
    $message[] = 'the basket is empty';
  }
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



  <section class="checkout">
    <h1 class="heading">Checkout</h1>


    <form action="" method="post">
      <h1 class="heading">Basket</h1>
      <div class="displayOrders">

        <?php
        $basketItems[] = '';

        $totalPrice = 0;
        $selectBasket = $conn->prepare("SELECT * FROM `cart` WHERE userID = ?");
        $selectBasket->execute([$userID]);

        if ($selectBasket->rowCount() > 0) {

          while ($fetchBasket = $selectBasket->fetch(PDO::FETCH_ASSOC)) {
            $totalPrice += ($fetchBasket['price'] * $fetchBasket['qty']);
            $basketItems[] = $fetchBasket['name'] . ' (' . $fetchBasket['qty'] . ') /';
            $totalProducts = implode($basketItems);
        ?>
            <p> <?= $fetchBasket['name']; ?> <span>£<?= $fetchBasket['price']; ?> x<?= $fetchBasket['qty'] ?> </span></p>


        <?php

          }
        } else {
          echo '<p class="empty">Nothing in Basket. </p>';
        }
        ?>



      </div>
      <p class="totalPrice">Grand Total : £<span><?= $totalPrice; ?></span></p>
      <h1 class="heading">Checkout Details</h1>
      <input type="hidden" name="totalProducts" value="<?= $totalProducts; ?>">
      <input type="hidden" name="totalPrice" value="<?= $totalPrice; ?>">
      <div class="flex">
        <div class="inputBox">
          <span>Name</span>
          <input type="text" name="name" maxlength="20" class="box" placeholder="enter your name">
        </div>

        <div class="inputBox">
          <span>Phone Number:</span>
          <input type="number" name="telephone" min="0" max="9999999999999" required onkeypress="if(this.value.length == 13) return false;" class="box" placeholder="enter telephone number">
        </div>

        <div class="inputBox">
          <span>Email:</span>
          <input type="email" name="email" maxlength="30" required class="box" placeholder="enter your email">
        </div>

        <div class="inputBox">
          <span>Address line 1:</span>
          <input type="text" name="address1" maxlength="50" required class="box" placeholder="enter your Address">
        </div>
        <div class="inputBox">
          <span>Address line 2:</span>
          <input type="text" name="address2" required maxlength="50" class="box">
        </div>
        <div class="inputBox">
          <span>City:</span>
          <input type="text" name="city" required maxlength="50" class="box">
        </div>
        <div class="inputBox">
          <span>Country:</span>
          <input type="text" name="country" required maxlength="50" class="box">
        </div>
        <div class="inputBox">
          <span>Post Code: </span>
          <input type="text" name="postCode" required maxlength="10" class="box">
        </div>

        <div class="inputBox">
          <span>Payment Method: </span>
          <select name="method" class="box">
            <option value="debit">Debit</option>
            <option value="credit">Credit</option>
            <option value="paypal">paypal</option>
          </select>
        </div>

      </div>
      <input type="submit" value="place order" class="btn" name="order">
    </form>


  </section>






  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>