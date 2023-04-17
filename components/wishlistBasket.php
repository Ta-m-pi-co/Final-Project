<?php
/*add to wishlist*/
if (isset($_POST['addToWishlist'])) {

  if ($userID == '') {
    header('location:userLogin.php');
  } else {

    $productID = $_POST['productID'];
    $productID = filter_var($productID, FILTER_SANITIZE_STRING);
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $image = $_POST['image'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);

    $checkWishlistNumber = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND userID = ? ");
    $checkWishlistNumber->execute([$name, $userID]);

    $checkBasketNumber = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND userID = ? ");
    $checkBasketNumber->execute([$name, $userID]);

    if ($checkWishlistNumber->rowCount() > 0) {
      $message[] = 'already added to wishlist';
    } elseif ($checkBasketNumber->rowCount() > 0) {
      $message[] = 'already in basket';
    } else {
      $insertWishlist = $conn->prepare("INSERT INTO `wishlist` (userID, productID, name, price, image) VALUES(?,?,?,?,?)");
      $insertWishlist->execute([$userID, $productID, $name, $price, $image]);
      $message[] = 'added to wishlist';
    }
  }
}

/*basket*/
if (isset($_POST['addToBasket'])) {

  if ($userID == '') {
    header('location:userLogin.php');
  } else {

    $productID = $_POST['productID'];
    $productID = filter_var($productID, FILTER_SANITIZE_STRING);
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $image = $_POST['image'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);



    $checkBasketNumber = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND userID = ? ");
    $checkBasketNumber->execute([$name, $userID]);

    if ($checkBasketNumber->rowCount() > 0) {
      $message[] = 'already in basket';
    } else {
      $checkWishlistNumber = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND userID = ? ");
      $checkWishlistNumber->execute([$name, $userID]);

      if($checkWishlistNumber->rowCount() > 0){
        $deleteWishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND userID = ?");
        $deleteWishlist->execute([$name, $userID]);
      }

      $insertBasket = $conn->prepare("INSERT INTO `cart` (userID, productID, name, price, qty, image) VALUES(?,?,?,?,?,?)");
      $insertBasket->execute([$userID, $productID, $name, $price, $qty, $image]);
      $message[] = 'added to basket';
    }
  }
}
?>