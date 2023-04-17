<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Dashboard</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>
<!--Video tutorials used to create website can be found here: https://www.youtube.com/@MrWebDesignerAnas/videos  -->

  <?php include '../components/headerAdmin.php'; ?>

  <section class="dashboard">
    <h1 class="heading">Dashboard</h1>
    <div class="box-container">
      <div class="box">
        <p><?= $fetch_profile['name']; ?></p>
        <a href="updateProfile.php" class="btn">Update Profile</a>
      </div>

      <!-- boxes start -->
      <div class="box">
        <?php
        $totalPendings = 0;
        $selectPendings = $conn->prepare("SELECT * FROM `orders` WHERE paymentStatus = ?");
        $selectPendings->execute(['pending']);
        while ($fetch_pendings = $selectPendings->fetch(PDO::FETCH_ASSOC)) {
          $totalPendings += $fetch_pendings['totalPrice'];
        }


        ?>

        <h3><span>$</span><?= $totalPendings; ?><span>/-</span></h3>
        <p>total pendings</p>
        <a href="currentOrders.php" class="btn">See Orders</a>

      </div>

      <div class="box">
        <?php
        $totalCompletes = 0;
        $selectCompletes = $conn->prepare("SELECT * FROM `orders` WHERE paymentStatus = ?");
        $selectCompletes->execute(['completed']);
        while ($fetch_completes = $selectCompletes->fetch(PDO::FETCH_ASSOC)) {
          $totalCompletes += $fetch_completes['totalPrice'];
        }
        ?>

        <h3><span>$</span><?= $totalCompletes; ?><span>/-</span></h3>
        <p>total Completes</p>
        <a href="currentOrders.php" class="btn">See Orders</a>

      </div>


      <div class="box">
        <?php
        $selectOrders = $conn->prepare("SELECT * FROM `orders`");
        $selectOrders->execute();
        $numberOfOrders = $selectOrders->rowCount();
        ?>
        <h3><?= $numberOfOrders; ?></h3>
        <p>Total Orders</p>
        <a href="currentOrders.php" class="btn">See Orders</a>

      </div>


      <div class="box">
        <?php
        $selectProducts = $conn->prepare("SELECT * FROM `products`");
        $selectProducts->execute();
        $numberOfProducts = $selectProducts->rowCount();
        ?>
        <h3><?= $numberOfProducts; ?></h3>
        <p>Products Added</p>
        <a href="products.php" class="btn">See Products</a>

      </div>

      <div class="box">
        <?php
        $selectUsers = $conn->prepare("SELECT * FROM `users`");
        $selectUsers->execute();
        $numberOfUsers = $selectUsers->rowCount();
        ?>
        <h3><?= $numberOfUsers; ?></h3>
        <p>User Accounts</p>
        <a href="userAccounts.php" class="btn">See Users</a>

      </div>

      <div class="box">
        <?php
        $selectAdmins = $conn->prepare("SELECT * FROM `adminUsers`");
        $selectAdmins->execute();
        $numberOfAdmins = $selectAdmins->rowCount();
        ?>
        <h3><?= $numberOfAdmins; ?></h3>
        <p>Admin Accounts</p>
        <a href="adminUserAccounts.php" class="btn">See Admins</a>

      </div>

      <div class="box">
        <?php
        $selectMessages = $conn->prepare("SELECT * FROM `messages`");
        $selectMessages->execute();
        $numberOfMessages = $selectMessages->rowCount();
        ?>
        <h3><?= $numberOfMessages; ?></h3>
        <p>New Messages</p>
        <a href="messages.php" class="btn">See Messages</a>

      </div>


    </div>

    <!-- boxes ended -->
  </section>






  <script src="../javascript/admin.js"></script>

</body>

</html>