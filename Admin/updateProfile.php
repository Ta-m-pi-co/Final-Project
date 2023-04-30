<?php
include '../components/connect.php';

session_start();

if (isset($_SESSION['admin_id'])) {

  $admin_id = $_SESSION['admin_id'];
} else {
  $admin_id = '';
  header('location:admin_login.php');
};

if (isset($_POST['submit'])) {

  //update username 
  $username = $_POST['name'];
  $username = filter_var($username, FILTER_SANITIZE_STRING);

  $updateUsername = $conn->prepare("UPDATE `adminUsers` SET name = ? WHERE id = ?");
  $updateUsername->execute([$username, $admin_id]);

  //update admin password
  $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
  //$selectOPassword = $conn->prepare("SELECT password FROM `adminUsers` WHERE id = ?");

  //$selectOPassword->execute([$admin_id]);
  //$fetchpPassword = $selectOPassword->fetch(PDO::FETCH_ASSOC);

  $pPassword = $_POST['pPassword'];

  $oPassword = sha1($_POST['oPassword']);
  $oPassword = filter_var($oPassword, FILTER_SANITIZE_STRING);

  $nPassword = sha1($_POST['nPassword']);
  $nPassword = filter_var($nPassword, FILTER_SANITIZE_STRING);

  $confirmnPassword = sha1($_POST['confirmnPassword']);
  $confirmnPassword = filter_var($confirmnPassword, FILTER_SANITIZE_STRING);

  if ($oPassword == $empty_pass) {
    $message[] = 'enter old password';
  } elseif ($oPassword != $pPassword) {

    $message[] = 'old password does not match';
  } elseif ($nPassword != $confirmnPassword) {

    $message[] = 'new password does not match';
  } else {

    if ($nPassword != $empty_pass) {

      $updateAdminPassword = $conn->prepare("UPDATE `adminUsers` SET password = ? WHERE id = ?");

      $updateAdminPassword->execute([$confirmnPassword, $admin_id]);

      $message[] = "password changed";
    } else {

      $message[] = 'no new password entered';
    }
  }
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

      <input type="hidden" name="pPassword" value="<?= $fetch_profile['password']; ?>">


      <input type="text" name="name" maxlength="20" placeholder="enter new admin username" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name']; ?>" required>

      <input type="password" name="oPassword" maxlength="20" placeholder="enter old password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="nPassword" maxlength="20" placeholder="enter new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{7,16}$">

      <input type="password" name="confirmnPassword" maxlength="20" placeholder="confirm new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{7,16}$">

      <input type="submit" value="Update" name="submit" class="btn">

    </form>

  </section>






  <script src="../javascript/admin.js"></script>

</body>

</html>