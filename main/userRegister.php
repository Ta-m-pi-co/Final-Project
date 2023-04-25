<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
}

if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $password = sha1($_POST['password']);
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $confirmPassword = sha1($_POST['confirmPassword']);
  $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_STRING);

  $hashPash = password_hash($_POST['confirmPassword'], PASSWORD_DEFAULT);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);


  $selectUser = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
  $selectUser->execute([$email]);
  $row = $selectUser->fetch(PDO::FETCH_ASSOC);

  if ($selectUser->rowCount() > 0) {
    $message[] = 'email already in use!';
  } else {
    if ($password != $confirmPassword) {
      $message[] = 'passwords do not match';
    } else {
      $insertUser = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");

      $insertUser->execute([$name, $email, $hashPash]);

      $message[] = 'Welcome to Crowns';
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
      <h3>Register</h3>

      <input type="text" name="name" maxlength="20" placeholder="enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')" required>

      <input type="email" name="email" maxlength="30" placeholder="enter email" class="box" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninput="this.value = this.value.replace(/\s/g, '') " required>

      <input type="password" name="password" maxlength="20" placeholder="enter password" class="box" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{7,16}$" oninput="this.value = this.value.replace(/\s/g, '')" required>

      <input type="password" name="confirmPassword" maxlength="20" placeholder="confirm password" class="box" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{7,16}$" oninput="this.value = this.value.replace(/\s/g, '')" required>

      <input type="submit" value="register" class="btn" name="submit">


      <p>Already have an account?</p>
      <a href="userLogin.php" class="optionBtn">Login Now</a>
    </form>

  </section>






  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>