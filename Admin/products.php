<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};

if (isset($_POST['confirmAddProduct'])) {

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $price = $_POST['price'];
  $price = filter_var($price, FILTER_SANITIZE_STRING);

  $details = $_POST['details'];
  $details = filter_var($details, FILTER_SANITIZE_STRING);

  $image1 = $_FILES['image1']['name'];
  $image1 = filter_var($image1, FILTER_SANITIZE_STRING);
  $image1Size = $_FILES['image1']['size'];
  $image1TmpName = $_FILES['image1']['tmp_name'];
  $image1Folder = '../images/' .$image1;

  $image2 = $_FILES['image2']['name'];
  $image2 = filter_var($image2, FILTER_SANITIZE_STRING);
  $image2Size = $_FILES['image2']['size'];
  $image2TmpName = $_FILES['image2']['tmp_name'];
  $image2Folder = '../images/' .$image2;

  $image3 = $_FILES['image3']['name'];
  $image3 = filter_var($image3, FILTER_SANITIZE_STRING);
  $image3Size = $_FILES['image3']['size'];
  $image3TmpName = $_FILES['image3']['tmp_name'];
  $image3Folder = '../images/' .$image3;

  $selectProducts = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
  $selectProducts->execute([$name]);

  if ($selectProducts->rowCount() > 0) {
    $message[] = "Product name already exists!";
  } else {

    if ($image1Size > 2000000 or $image2Size > 2000000 or $image3Size > 2000000) {

      $message[] = 'image is too large';
    } else {

      move_uploaded_file($image1TmpName, $image1Folder);
      move_uploaded_file($image2TmpName, $image2Folder);
      move_uploaded_file($image3TmpName, $image3Folder);

      $insertProduct = $conn->prepare("INSERT INTO `products` (name, details, price, image1, image2, image3) VALUES(?,?,?,?,?,?)");

      $insertProduct->execute([$name, $details, $price, $image1, $image2, $image3]);

      $message[] = 'new product added successfully';
    }
  }
}

if (isset($_GET['delete'])) {

  $deleteId = $_GET['delete'];
  $deleteProductImage = $conn->prepare("SELECT * FROM `products` WHERE id =?");
  $deleteProductImage->execute([$deleteId]);
  $fetchDeleteImage = $deleteProductImage->fetch(PDO::FETCH_ASSOC);
  unlink('../images/' . $fetchDeleteImage['image1']);
  unlink('../images/' . $fetchDeleteImage['image2']);
  unlink('../images/' . $fetchDeleteImage['image3']);

  $deleteProduct = $conn->prepare("DELETE FROM `products` WHERE id = ?");
  $deleteProduct->execute([$deleteId]);

  $deleteCart = $conn->prepare("DELETE FROM `cart` WHERE productID = ?");
  $deleteCart->execute([$deleteId]);

  $deleteWishlist = $conn->prepare("DELETE FROM `wishlist` WHERE productID = ?");
  $deleteWishlist->execute([$deleteId]);

  header('location:products.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>products</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />


  <link rel="stylesheet" href="../css/styleAdmin.css">

</head>

<body>

  <?php include '../components/headerAdmin.php'; ?>

  <!-- add products -->

  <section class="addProducts">
    <h1 class="heading">Add Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
        <div class="iBoxes">
          <span>Product Name - REQUIRED</span>
          <input type="text" placeholder="enter name of product" class="box" name="name" maxlength="100" required>
        </div>

        <div class="iBoxes">
          <span>Price (£) - REQUIRED</span>
          <input type="number" min="0" max="999999999" placeholder="enter price of product" class="box" name="price" onkeypress="if(this.value.length == 9) return false;" required>
        </div>

        <div class="iBoxes">
          <span>image 1 (required)</span>
          <input type="file" name="image1" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
        </div>

        <div class="iBoxes">
          <span>image 2</span>
          <input type="file" name="image2" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
        </div>

        <div class="iBoxes">
          <span>image 3</span>
          <input type="file" name="image3" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
        </div>

        <div class="iBoxes">
          <span> product details</span>
          <textarea name="details" class="box" placeholder="enter product details here!" cols="30" rows="10" maxlength="500" required></textarea>
        </div>

        <input type="submit" value="confirm" name="confirmAddProduct" class="btn">


      </div>
    </form>

  </section>

  <section class="displayProducts">

  <h1 class="heading" style="padding-top: 0;">Added Products</h1>


    <div class="box-container">

      <?php
      $displayProducts = $conn->prepare("SELECT * FROM `products`");
      $displayProducts->execute();

      if ($displayProducts->rowCount() > 0) {

        while ($fetchProducts = $displayProducts->fetch(PDO::FETCH_ASSOC)) {

      ?>

          <div class="box">
            <img src="../images/<?= $fetchProducts['image1']; ?>" alt="">
            <div class="name"><?= $fetchProducts['name']; ?></div>
            <div class="price">£<?= $fetchProducts['price']; ?>/-</div>
            <div class="details"><?= $fetchProducts['details']; ?></div>
            <div class="flexBtn"></div>
            <a href="updateProduct.php?update=<?= $fetchProducts['id']; ?>" class="optionBtn">update products</a>
            <a href="products.php?delete=<?= $fetchProducts['id']; ?>" class="deleteBtn" onclick="return confirm('delete this?')">delete product</a>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">no products to display</p>';
      }



      ?>




    </div>




  </section>





  <script src="../javascript/admin.js"></script>

</body>

</html>