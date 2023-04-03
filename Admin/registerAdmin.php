<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};


if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $password = $_POST['password'];
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $confirmPassword = $_POST['confirmPassword'];
  $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_STRING);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  
  
  $select_admin = $conn->prepare("SELECT * FROM `adminUsers` WHERE name = ?");
  $select_admin->execute([$name]);
  
  if ($select_admin->rowCount() > 0) {
    $message[] = 'username already exists';
  } else {
      if($password != $confirmPassword) {
        $message[] = 'passwords do not match';
  } else{
    $insert_admin = $conn->prepare("INSERT INTO `adminUsers`(name, email, password) VALUES(?,?,?)");

    $insert_admin->execute([$name, $email, $confirmPassword]);

    $message[] = 'new admin created successfully';
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
  <title>Register Admin Account</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>

<?php include '../components/headerAdmin.php'; ?>
 

<section class=" form-container">

    <form action="" method="POST">
      <h3>Register</h3>
      <p>default username = <span>admin2</span> & password = <span>111</span></p>

      <input type="text" name="name" maxlength="20" required placeholder="enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="email" name="email" maxlength="30" required placeholder="enter email" class="box" oninput="this.value = this.value.replace(/\s/g, '') " required>

      <input type="password" name="password" maxlength="20" required placeholder="enter password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="confirmPassword" maxlength="20" required placeholder="confirm password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="register" name="submit" class="btn">

    </form>

  </section>




  <script src="../javascript/admin.js"></script>

</body>

</html>