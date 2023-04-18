<?php
include '../components/connect.php';

session_start();

if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $password = sha1($_POST['password']);
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $select_admin = $conn->prepare("SELECT * FROM `adminUsers` WHERE name = ? AND password = ?");
  $select_admin->execute([$name, $password]);
  $row = $select_admin->fetch(PDO::FETCH_ASSOC);

  if ($select_admin->rowCount() > 0) {
    $_SESSION['admin_id'] = $row['id'];
    header('location:dashboard.php');
  } else {
    $message[] = 'Incorrect Username or Password! Try Again.';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>login</title>
  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

  <!-- admin css file-->
  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>


  <!-- display and remove message -->

  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '

      <div class="message">
        <span>' . $message . '</span>
        <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
      </div>

    ';
    }
  }
  ?>
  <!-- admin login form -->

  <section class=" form-container">

    <form action="" method="POST">
      <h3>Login Now</h3>

      <input type="text" name="name" maxlength="20" required placeholder="enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="password" maxlength="20" required placeholder="enter password" class="box" oninput="this.value = this.value.replace(/\s/g, '')" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{7,16}$">

      <input type="submit" value="Login" name="submit" class="btn">

    </form>



  </section>






</body>

</html>