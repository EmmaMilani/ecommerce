<?php
require_once "../DBManager.php";
require_once "../classes/cart.php";
require_once "../classes/cart_product.php";
require_once "../classes/product.php";
require_once "../classes/user.php";

session_start();
$current_user = $_SESSION['current_user'];

if($current_user == null){
    header("Location: ../views/login.php");
    exit;
}

$product_id = $_POST['id'];

$cart = Cart::find_cart($current_user->getId());

if(!$cart)//controllo che l'utente abbia un carrello
{
    $cart = Cart::Create($current_user->getId());
}
//$product = Product::find($product_id);
$lineitem = Cart::find_product($_POST['id'], $cart->getId());//trova il prodotto nel carrello

if (!$lineitem) {
    $cart_id = $cart->getId();
    Cart_product::add_to_cart_products($cart_id, $_POST["id"], $_POST['quantita']); //associo il prodotto al carrello
} else {
    $lineitem->setQuantita($lineitem->getQuantita() + $_POST['quantita']);
    $lineitem->save();
}

header('Location: ../views/products.php');
exit;

?>