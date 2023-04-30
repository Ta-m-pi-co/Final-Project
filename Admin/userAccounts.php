<?php
include '../components/connect.php';

session_start();

if (isset($_SESSION['admin_id'])) {

  $admin_id = $_SESSION['admin_id'];
} else {
  $admin_id = '';
  header('location:admin_login.php');
};

if (isset($_GET['delete'])) {

  $deleteId = $_GET['delete'];
  $deleteUser = $conn->prepare("DELETE FROM `users` WHERE id = ?");
  $deleteUser->execute([$deleteId]);

  $deleteOrder = $conn->prepare("DELETE FROM `orders` WHERE userID = ?");
  $deleteOrder->execute([$deleteId]);

  $deleteCart = $conn->prepare("DELETE FROM `cart` WHERE userID = ?");
  $deleteCart->execute([$deleteId]);

  $deleteWishlist = $conn->prepare("DELETE FROM `wishlist` WHERE userID = ?");
  $deleteWishlist->execute([$deleteId]);

  $deleteMessage = $conn->prepare("DELETE FROM `messages` WHERE userID = ?");
  $deleteMessage->execute([$deleteId]);

  header('location:userAccounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>User Accounts</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>

  <?php include '../components/headerAdmin.php'; ?>

  <section class="accounts">

    <h1 class="heading">User Accounts</h1>
    <div class="box-container">



      <?php
      $selectAccount = $conn->prepare("SELECT * FROM `users`");
      $selectAccount->execute();
      if ($selectAccount->rowCount() > 0) {
        while ($fetchAccounts = $selectAccount->fetch(PDO::FETCH_ASSOC)) {


      ?>
          <div class="box">
            <p>ID: <span><?= $fetchAccounts['id']; ?></span> </p>
            <p>Username: <span><?= $fetchAccounts['name']; ?></span> </p>
            <p>Email: <span><?= $fetchAccounts['email']; ?></span> </p>

            <a href="userAccounts.php?delete=<?= $fetchAccounts['id']; ?>" class="deleteBtn" onclick="return confirm('delete this?')">Delete</a>




          </div>
      <?php
        }
      } else {
        echo '<p class="empty">no admin accounts</p>';
      }
      ?>

    </div>

  </section>


  <script src="../javascript/admin.js"></script>

</body>

</html>