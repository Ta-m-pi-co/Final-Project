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
  <title>Register Admin Account</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>

<?php include '../components/headerAdmin.php'; ?>
 

<section class=" form-container">

    <form action="" method="POST">
      <h3>Register</h3>
      <p>default username = <span>admin</span> & password = <span>111</span></p>

      <input type="text" name="name" maxlength="20" required placeholder="enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="password" maxlength="20" required placeholder="enter password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="Login" name="submit" class="btn">

    </form>

  </section>




  <script src="../javascript/admin.js"></script>

</body>

</html>