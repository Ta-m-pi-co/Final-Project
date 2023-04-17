<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
  header('location:home.php');
}


if (isset($_POST['submit'])) {

  //update username 
  $username = $_POST['name'];
  $username = filter_var($username, FILTER_SANITIZE_STRING);

  //update email
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);


  $updateUser = $conn->prepare("UPDATE `users` SET name = ?, email =? WHERE id = ?");
  $updateUser->execute([$username, $email, $userID]);

  $message[] = 'username and email updated successfully!';
  //update user password
  $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
  //$selectOPassword = $conn->prepare("SELECT password FROM `adminUsers` WHERE id = ?");

  //$selectOPassword->execute([$admin_id]);
  //$fetchpPassword = $selectOPassword->fetch(PDO::FETCH_ASSOC);

  $pPassword = $_POST['pPassword'];

  $oPassword = sha1($_POST['oPassword']);
  $oPassword = filter_var($oPassword, FILTER_SANITIZE_STRING);

  $nPassword = sha1($_POST['nPassword']);
  $nPassword = filter_var($nPassword, FILTER_SANITIZE_STRING);

  $confirmNPassword = sha1($_POST['confirmNPassword']);
  $confirmNPassword = filter_var($confirmNPassword, FILTER_SANITIZE_STRING);

  /* if ($oPassword == $empty_pass) {
    $message[] = 'enter old password';
  } else */
  if ($oPassword != $pPassword) {

    $message[] = 'old password does not match';
  } elseif ($nPassword != $confirmNPassword) {

    $message[] = 'new password does not match';
  } else {

    if ($nPassword != $empty_pass) {


      $updateUserPassword = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");

      $updateUserPassword->execute([$confirmNPassword, $userID]);

      $message[] = "Password Updated!";
    } else {

      $message[] = 'No New Password Entered';
    }
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

  <section class="formContainer">
    <form action="" method="POST">
      <h3>Update Account Details</h3>

      <input type="hidden" name="pPassword" value="<?= $fetch_profile['password']; ?>">

      <input type="text" name="name" maxlength="20" placeholder="enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name']; ?>" required>

      <input type="email" name="email" maxlength="30" placeholder="enter email" class="box" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninput="this.value = this.value.replace(/\s/g, '') " value="<?= $fetch_profile['email']; ?>" required>

      <input type="password" name="oPassword" maxlength="20" placeholder="enter old password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="nPassword" maxlength="20" placeholder="enter new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{7,16}$">

      <input type="password" name="confirmNPassword" maxlength="20" placeholder="confirm new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{7,16}$">

      <input type="submit" value="Update" class="btn" name="submit">



    </form>

  </section>








  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>