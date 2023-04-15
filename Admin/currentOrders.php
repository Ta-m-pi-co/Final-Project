<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};

if (isset($_POST['updatePayStatus'])) {
  $orderId = $_POST['orderId'];
  $paymentStatus = $_POST['paymentStatus'];
  $updatePayStatus = $conn->prepare("UPDATE `orders` SET paymentStatus = ? WHERE id = ?");
  $updatePayStatus->execute([$paymentStatus, $orderId]);
  $message[] = 'updated payment status';
}

if (isset($_GET['delete'])) {

  $deleteId = $_GET['delete'];
  $deleteOrder = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
  $deleteOrder->execute([$deleteId]);
  header('location:currentOrders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Current Orders</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>
  <?php include '../components/headerAdmin.php'; ?>

  <section class="currentOrders">
    <h1>Orders</h1>
    <div class="box-container">

      <?php
      $selectOrders = $conn->prepare("SELECT * FROM `orders` WHERE");
      $selectOrders->execute();
      if ($selectOrders->rowCount() > 0) {
        while ($fetchOrders = $selectOrders->fetch(PDO::FETCH_ASSOC)) {

      ?>
          <div class="box">
            <p>user ID: <span><?= $fetchOrders['userID']; ?></span></p>
            <p>order placed: <span><?= $fetchOrders['dateOfOrder']; ?></span></p>
            <p>name: <span><?= $fetchOrders['name']; ?></span></p>
            <p>email: <span><?= $fetchOrders['email']; ?></span></p>
            <p>telephone: <span><?= $fetchOrders['telephone']; ?></span></p>
            <p>address: <span><?= $fetchOrders['address']; ?></span></p>
            <p>products ordered: <span><?= $fetchOrders['totalProducts']; ?></span></p>
            <p>price: <span><?= $fetchOrders['totalPrice'] ?></span></p>
            <p>payment method: <span><?= $fetchOrders['method']; ?></span></p>

            <form action="" method="POST">
              <input type="hidden" name="orderId" value="<?= $fetchOrders['id']; ?>">
              <select name="paymentStatus" class="dropDown">
                <option value="" selected disabled><?= $fetchOrders['paymentStatus'] ?></option>
                <option value="pending">pending</option>
                <option value="completed">completed</option>
                <option value="cancelled">cancelled</option>

              </select>

              <div class="flexBtn">
                <input type="submit" value="update" class="btn" name="updatePayStatus">
                <a href="currentOrders.php?delete=<?= $fetchOrders['id']; ?>" class="deleteBtn" onclick="return confirm('delete this?')">Remove Order</a>
              </div>

            </form>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">no orders placed</p>';
      }

      ?>





    </div>

  </section>






  <script src="../javascript/admin.js"></script>

</body>

</html>