<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

if (isset($_GET['delete'])) {

  $deleteId = $_GET['delete'];
  $deleteAdminAccount = $conn->prepare("DELETE FROM `adminUsers` WHERE id = ?");
  $deleteAdminAccount->execute([$deleteId]);
  header('location:adminUserAccounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Admin Accounts</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>

  <?php include '../components/headerAdmin.php'; ?>

  <section class="accounts">

    <h1 class="heading">Admin Accounts</h1>
    <div class="box-container">

      <div class="box">
        <p>Register New Admin?</p>
        <a href="../Admin/registerAdmin.php" class="optionBtn"></a>
      </div>

      <?php
      $selectAccount = $conn->prepare("SELECT * FROM `adminUsers`");
      $selectAccount->execute();
      if ($selectAccount->rowCount() > 0) {
        while ($fetchAccounts = $selectAccount->fetch(PDO::FETCH_ASSOC)) {
        }

      ?>
        <div class="box">
          <p>ID: <span><?= $fetchAccounts['id']; ?></span> </p>
          <p>Admin Username: <span><?= $fetchAccounts['name']; ?></span> </p>
          <div class="flexBtn">
            <a href="adminUserAccounts.php?delete=<?= $fetchAccounts['id']; ?>" class="deleteBtn" onclick="return confirm('delete this?')">Remove Account</a>

            <?php
            if ($fetchAccounts['id'] == $admin_id) {
              echo '<a href="updateProfile.php" class="optionBtn">Update</a>';
            }


            ?>
          </div>

        </div>
      <?php

      } else {
        echo '<p class="empty">no admin accounts</p>';
      }
      ?>

    </div>

  </section>






  <script src="../javascript/admin.js"></script>

</body>

</html>