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
    <a href="dashboard.php" class="logo"> Admin<span>Panel</span></a>

    <nav class="navbar">
      <a href="dashboard.php">Home</a>
      <a href="products.php">Products</a>
      <a href="currentOrders.php">Orders</a>
      <a href="adminUserAccounts.php">Admin</a>
      <a href="userAccounts.php">Users</a>
      <a href="messages.php">Messages</a>

    </nav>

    <div class="icons">
      <div id="menuBtn" class="fas fa-bars"></div>
      <div id="userBtn" class="fas fa-user"></div>


    </div>

    <div class="profile">
      <?php

      $select_profile = $conn->prepare("SELECT * FROM `adminUsers` WHERE id = ?");

      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);


      ?>

      <p><?= $fetch_profile['name']; ?></p>
      <a href="updateProfile.php" class="btn">Update Profile</a>

      <div class="flexBtn">
        <a href="admin_login.php" class="optionBtn">Login</a>
        <a href="registerAdmin.php" class="optionBtn">Register</a>

      </div>

      <a href="../components/logoutAdmin.php" class="deleteBtn">Logout</a>



    </div>





  </section>

</header>