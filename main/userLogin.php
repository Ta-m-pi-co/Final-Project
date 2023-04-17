<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
}

if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $email = filter_var($name, FILTER_SANITIZE_STRING);

  $password = sha1($_POST['password']);
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $selectUser = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
  $selectUser->execute([$email, $password]);
  $row = $selectUser->fetch(PDO::FETCH_ASSOC);

  if ($selectUser->rowCount() > 0) {
    $_SESSION['userID'] = $row['id'];
    header('location:home.php');
  } else {
    $message[] = 'Incorrect email or Password! Try Again.';
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
      <h3>Login</h3>
      <input type="email" class="box" placeholder="enter email" name="email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" required>
      <input type="password" class="box" placeholder="enter password" name="password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')" required>
      <input type="submit" value="login" class="btn" name="submit">


      <p>Are You New Here?</p>
      <a href="userRegister.php" class="optionBtn">sign-up!</a>
    </form>





  </section>








  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>