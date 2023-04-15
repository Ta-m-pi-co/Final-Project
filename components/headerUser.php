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

<header class="header">


  <section class="flex">
    <a href="home.php" class="logo">Crown<span>Stores</span></a>

    <nav class="navbar">
      <a href="home.php">Home</a>
      <a href="productDisplay.php">Products</a>
      <a href="orders.php">Orders</a>
      <a href="contact.php">Contact</a>
      <a href="about.php">About</a>

    </nav>

    <div class="icons">

      <?
      $countWishlistItems = $conn->prepare("SELECT * FROM `wishlist` WHERE userID = ?");
      $countWishlistItems->execute([$userID]);

      $totalWishlistItems = $countWishlistItems->rowCount();


      $countBasketItems = $conn->prepare("SELECT * FROM `cart` WHERE userID = ?");
      $countBasketItems->execute([$userID]);

      $totalBasketItems = $countBasketItems->rowCount();

      ?>
      <div id="menuBtn" class="fas fa-bars"></div>
      <a href="search.php"><i class="fa-light fa-magnifying-glass"></i><span>Search</span></a>
      <a href="wishlist.php"><i class="fa-sharp fa-light fa-heart"></i><span>Saved (<?= $totalWishlistItems; ?>)</span></a>
      <a href="basket.php"><i class="fa-regular fa-basket-shopping"></i><span>(<?= $totalBasketItems; ?>)</span></a>
      <div id="userBtn" class="fas fa-user"></div>
    </div>

    <div class="profile">
      <?php

      $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");

      $select_profile->execute([$userID]);

      if ($select_profile->rowCount() > 0) {
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

      ?>

        <p><?= $fetch_profile['name']; ?></p>
        <a href="../main/userUpdate.php" class="btn">Update Profile</a>

        <<div class="flexBtn">
          <a href="../main/userLogin.php" class="optionBtn">Login</a>

          <a href="../main/userRegister.php" class="optionBtn">Register</a>

    </div>

    <a href="../components/logoutUser.php" onclick=" return confirm('Are you sure you want to logout?');" class="deleteBtn">Logout</a>

  <?php
      } else {



  ?>

    <p>please Login!</p>
    <div class="flexBtn">
      <a href="../main/userLogin.php" class="optionBtn">Login</a>

      <a href="../main/userRegister.php" class="optionBtn">Register</a>

    </div>

  <?php
      }

  ?>

  </div>





  </section>

</header>