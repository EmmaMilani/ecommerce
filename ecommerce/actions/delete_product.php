<?php

require_once "../DBManager.php";
require_once "../classes/cart.php";
require_once "../classes/cart_product.php";
require_once "../classes/product.php";
require_once "../classes/user.php";

session_start();
$current_user = $_SESSION['current_user'];

if($current_user==null){
    header("Location: ../views/login.php");
    exit;
}

$product_id = $_POST['id'];
$product = Product::find($product_id);
$cart = Cart::find_cart($current_user->getId());
$lineitem = Cart::find_product($_POST['id'], $cart->getId());//trova il prodotto nel carrello
$lineitem->delete_product();

header('Location: ../views/products.php');
exit;

