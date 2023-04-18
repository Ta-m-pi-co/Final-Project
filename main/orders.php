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



  <section class="displayOrders">
    <h1 class="heading">Your Orders</h1>
    <div class="boxContainer">
      <?php
      $displayOrders = $conn->prepare("SELECT * FROM `orders` WHERE userID = ?");
      $displayOrders->execute([$userID]);

      if ($displayOrders->rowCount() > 0) {

        while ($fetchOrders = $displayOrders->fetch(PDO::FETCH_ASSOC)) {

      ?>
          <div class="box">
            <p>Order Placed: <span><?= $fetchOrders['dateOfOrder']; ?></span></p>
            <p>Name: <span><?= $fetchOrders['name']; ?></span></p>
            <p>Email: <span><?= $fetchOrders['email']; ?></span></p>
            <p>Telephone: <span><?= $fetchOrders['telephone']; ?></span></p>
            <p>Address: <span><?= $fetchOrders['address']; ?></span></p>
            <p>Products Ordered: <span><?= $fetchOrders['totalProducts']; ?></span></p>
            <p>Total Price: <span><?= $fetchOrders['totalPrice'] ?></span></p>
            <p>payment method: <span><?= $fetchOrders['method']; ?></span></p>
            <p>Order Status: <span style="color:<?php if ($fetchOrders['paymentStatus'] == 'pending') {
                                                  echo 'orange';
                                                } elseif ($fetchOrders['paymentStatus'] == 'cancelled') {
                                                  echo 'red';
                                                } else {
                                                  echo 'green';
                                                } ?> "><?= $fetchOrders['paymentStatus']; ?></span></p>
          </div>

      <?php
        }
      } else {
        echo '<p class="empty">No orders Placed</p>';
      }
      ?>

    </div>
  </section>






  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>