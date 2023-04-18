<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
}
if (isset($_POST['send'])) {
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $telephone = $_POST['telephone'];
  $telephone = filter_var($telephone, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $messages = $_POST['message'];
  $messages = filter_var($messages, FILTER_SANITIZE_STRING);

  $selectMessages = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND telephone = ? AND message = ?");
  $selectMessages->execute([$name, $email, $telephone, $message]);

  if ($selectMessage->rowCount() > 0) {
    $message[] = 'message sent';
  } else {
    $insertMessages = $conn->prepare("INSERT INTO `messages`(name, email, telephone, message) VALUES(?,?,?,?)");
    $insertMessages->execute([$name, $email, $telephone, $message]);
    $message[] = 'Thank You For The Message!';
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
    <form action="" class="box" method="post">
      <h3>Get in Contact!</h3>
      <input type="text" name="name" placeholder="Enter Name" required maxlength="20" class="box">
      <input type="number" name="telephone" placeholder="Enter Phone Number" max="9999999999" min="0" class="box" onkeypress="if(this.value.length == 10) return false;">
      <input type="email" name="email" placeholder="Enter Email" required maxlength="50" class="box" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

      <textarea name="message" class="box" cols="30" rows="10" placeholder="Leave a Message for us!"></textarea>
      <input type="submit" value="Send message" class="btn" name="send">




    </form>

  </section>







  <?php include '../components/footer.php'; ?>
  <script src="../javascript/main.js"></script>
</body>

</html>