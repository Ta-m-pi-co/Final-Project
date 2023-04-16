<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['userID'])) {

  $userID = $_SESSION['userID'];
} else {
  $userID = '';
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

  <link rel="stylesheet" href="../css/styleMain.css">



</head>

<!--Video tutorials used to create website can be found here: https://www.youtube.com/@MrWebDesignerAnas/videos  -->

<body>

  <?php include '../components/headerUser.php'; ?>


  <div class="homeBg">

    <section class="home">

      <div class="swiper" id="homeSlider">

        <div class="swiper-wrapper">

          <div class="swiper-slide" id="bannerImg">
            <div class="image">
              <img src="../images/home-img-1.jpg" alt="" width="500" height="500">
            </div>

            <div class="content">
              <span>Sale On Now!</span>
              <h3>Smart Watches</h3>
              <a href="../main/store.php" class="btn">Go!</a>
            </div>
          </div>

          <div class="swiper-slide" id="bannerImg">
            <div class="image">
              <img src="../images/home-img-2.jpg" alt="" width="500" height="500">
            </div>

            <div class="content">
              <span>Up to 30% Off Tablets!</span>
              <h3>Tablets</h3>
              <a href="../main/store.php" class="btn">Go!</a>
            </div>
          </div>

          <div class="swiper-slide" id="bannerImg">
            <div class="image">
              <img src="../images/home-img-3.jpg" alt="" width="500" height="500">
            </div>

            <div class="content">
              <span>Smart Phone and Smart Watch Bundles available</span>
              <h3>Smart Phones</h3>
              <a href="../main/store.php" class="btn">Go!</a>
            </div>
          </div>




        </div>


        <div class="swiper-pagination"></div>

      </div>



    </section>



  </div>
  <!--
  <div class="homeBg">

    <section class="swiper" id="homeSlider">

      <div class="swiper-wrapper">

        <div class="swiper-slide" id="bannerImg">
          <div class="image">
            <img src="../images/home-img-1.jpg" alt="" width="500" height="500">
          </div>
          <div class="content">
            <span>Sale On Now!</span>
            <h3>Smart Watches</h3>
            <a href="../main/store.php" class="btn">Go!</a>
          </div>
      </div>

          <div class="swiper-slide" id="bannerImg">
            <div class="image">
              <img src="../images/home-img-2.jpg" alt="" width="500" height="500">
            </div>
            <div class="content">
              <span>Up to 30% Off Tablets!</span>
              <h3>Tablets</h3>
              <a href="../main/store.php" class="btn">Go!</a>
            </div>
          
          </div>
          
          <div class="swiper-slide" id="bannerImg">
              <div class="image">
                <img src="../images/home-img-3.jpg" alt="" width="500" height="500">
              </div>
              <div class="content">
                <span>Smart Phone and Smart Watch Bundles available</span>
                <h3>Smart Phones</h3>
                <a href="../main/store.php" class="btn">Go!</a>
              </div>
            </div>

          

          <div class="swiper-pagination"></div>


    </section>


  </div>


-->





  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper("#homeSlider", {
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>
  <script src="../javascript/main.js"></script>



</body>

</html>