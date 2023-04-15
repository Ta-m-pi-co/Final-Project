<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userId'])) {

  $userId = $_SESSION['userId'];
} else {
  $userId = '';
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








  <script src="../javascript/main.js"></script>
</body>

</html>