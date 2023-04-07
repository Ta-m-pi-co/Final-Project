<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

if (isset($_POST['submit'])) {

  $username = $_POST['name'];
  $username = filter_var($username, FILTER_SANITIZE_STRING);
  $updateUsername = $conn->prepare("UPDATE `adminUsers` SET name = ? WHERE id = ?");
  $updateUsername->execute([$username, $admin_id]);

  $dumpPassword = '123da39a3ee5e6b4b0d3255bfef95601890afd80709';
  $selectOPassword = $conn->prepare("SELECT password FROM `adminUsers` WHERE id = ?");

  $selectOPassword->execute([$admin_id]);
  $fetchPreviousPassword = $selectOPassword->fetch(PDO::FETCH_ASSOC);
  echo $previousPassword = $fetchPreviousPassword['password'];

  echo sha1('');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Update Profile</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>

  <?php include '../components/headerAdmin.php'; ?>

  <section class=" form-container">

    <form action="" method="POST">
      <h3>Update Account</h3>

      <input type="hidden" name="cPassword" value="<?= $fetchProfile['password']; ?>">

      <input type="text" name="name" maxlength="20" placeholder="enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<? $fetchProfile['name']; ?>" required>

      <input type="password" name="oPassword" maxlength="20" placeholder="enter current password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" required>

      <input type="password" name="nPassword" maxlength="20" placeholder="enter new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" required>

      <input type="password" name="confirmnPassword" maxlength="20" placeholder="confirm new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" required>

      <input type="submit" value="Update" name="submit" class="btn">

    </form>

  </section>






  <script src="../javascript/admin.js"></script>

</body>

</html>