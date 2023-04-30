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
  $deleteMessage = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
  $deleteMessage->execute([$deleteId]);
  header('location:messages.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Messages</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>
  <?php include '../components/headerAdmin.php'; ?>
  <section class="messages">

    <h1 class="heading">Messages</h1>


    <div class="box-container">

      <?php
      $selectMessages = $conn->prepare("SELECT * FROM `messages`");
      $selectMessages->execute();

      if ($selectMessages->rowCount() > 0) {

        while ($fetchMessages = $selectMessages->fetch(PDO::FETCH_ASSOC)) {


      ?>

          <div class="box">
            <p>ID: <span><?= $fetchMessages['id']; ?></span> </p>
            <p>Username: <span><?= $fetchMessages['name']; ?></span> </p>
            <p>Email: <span><?= $fetchMessages['email']; ?></span> </p>
            <p>Telephone: <span><?= $fetchMessages['telephone']; ?></span> </p>
            <p>Message: <span><?= $fetchMessages['message']; ?></span> </p>
            <a href="messages.php?delete=<?= $fetchMessages['id']; ?>" class="deleteBtn" onclick="return confirm('delete this?')">Delete</a>
          </div>

      <?php
        }
      } else {
        echo '<p class="empty">no messages</p>';
      }
      ?>

    </div>



  </section>








  <script src="../javascript/admin.js"></script>

</body>

</html>