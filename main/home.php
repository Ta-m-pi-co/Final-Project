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

  <section class="homeFilter">

    <h1>Filter Products</h1>
    <div class="swiper filterSlider">

      <div class="swiper-wrapper">

        <a href="category.php?category=camera" class="swiper-slide" id="catSlide">
          <img src="../images/icon-camera.png" alt="">
          <h3>cameras</h3>
        </a>

        <a href="category.php?category=watches" class="swiper-slide" id="catSlide">
          <img src="../images/icon-watch.png" alt="">
          <h3>watches</h3>
        </a>

        <a href="category.php?category=tv" class="swiper-slide" id="catSlide">
          <img src="../images/icon-tv.png" alt="">
          <h3>tv</h3>
        </a>
        <a href="category.php?category=laptop" class="swiper-slide" id="catSlide">
          <img src="../images/icon-laptop.png" alt="">
          <h3>laptops</h3>
        </a>
        <a href="category.php?category=mobile" class="swiper-slide" id="catSlide">
          <img src="../images/icon-mobile.png" alt="">
          <h3>smartphones</h3>
        </a>


      </div>

      <div class="swiper-pagination"></div>

    </div>


  </section>



  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper("#homeSlider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
        clickable:true,
      },
    });



    var swiper = new Swiper(".filterSlider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
        clickable:true,
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
        },
        650: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });
  </script>
  <script src="../javascript/main.js"></script>



</body>

</html>