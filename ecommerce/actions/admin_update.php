<?php

require_once "../classes/product.php";
require_once "../classes/user.php";

session_start();
$current_user = $_SESSION["current_user"];

if($current_user == null || $current_user->getRoleId() != 2){ //controllo se l'utente si è loggato e se è un admin
    $current_user = null;
    header("Location: ../views/login.php");
    exit;
}

if(Product::UpdateProduct($_POST["product_id"],$_POST["nome"], $_POST["marca"], $_POST["prezzo"])){
    header("Location: ../views/admin_index.php");
    exit;
}
