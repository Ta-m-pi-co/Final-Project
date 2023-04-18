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
  <title>About</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

  <link rel="stylesheet" href="../css/styleMain.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>

<body>

  <?php include '../components/headerUser.php'; ?>
  <!--Video tutorials used to create website can be found here: https://www.youtube.com/@MrWebDesignerAnas/videos  -->


  <section class="about">


    <div class="row">


      <div class="content">
        <h3>want to learn more about us?</h3>
        <p>
          "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
        </p>
        <a href="contact.php" class="btn">Contact Us!</a>
      </div>


    </div>


    <section class="reviews">
      <h1 class="heading">Reviews</h1>

      <div class="swiper reviewSlides">
        <div class="swiper-wrapper">
          <div class="slide swiper-slide">
            <!--Photo by Italo Melo: https://www.pexels.com/photo/portrait-photo-of-smiling-man-with-his-arms-crossed-standing-in-front-of-white-wall-2379004/ -->
            <img src="../images/review-img-1.jpg" alt="">
            <h3>david boe</h3>
            <p>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
            </p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>

          </div>

          <div class="slide swiper-slide">
            <!--Photo by Justin Shaifer: https://www.pexels.com/photo/photography-of-a-guy-wearing-green-shirt-1222271/ -->
            <img src="../images/review-img-2.jpg" alt="">
            <h3>john doe</h3>
            <p>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
            </p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
          </div>

          <div class="slide swiper-slide">
            <!--Photo by Moose Photos: https://www.pexels.com/photo/smiling-woman-wearing-black-sweater-1587009/ -->
            <img src="../images/review-img-3.jpg" alt="">
            <h3>jane doe</h3>
            <p>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
            </p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>

          </div>

          <div class="slide swiper-slide">
            <!--Photo by Daniel Xavier: https://www.pexels.com/photo/close-up-photography-of-man-wearing-sunglasses-1212984/ -->
            <img src="../images/review-img-4.jpg" alt="">
            <h3>alex doe</h3>
            <p>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
            </p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
          </div>

          <div class="slide swiper-slide">
            <!--Photo by Photo by Juan Pablo Serrano Arenas: https://www.pexels.com/photo/portrait-photo-of-man-in-white-crew-neck-t-shirt-with-assorted-hand-tools-in-background-1139743/ -->
            <img src="../images/review-img-5.jpg" alt="">
            <h3>frederick doe</h3>
            <p>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
            </p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>


          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </section>
  </section>

  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <script src="../javascript/main.js"></script>

  <script>
    var swiper = new Swiper(".reviewSlides", {
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        650: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script>
</body>

</html>