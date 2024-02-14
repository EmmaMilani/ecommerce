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

$product = Product::find($_POST["id"]);

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Prodotto</title>
</head>
<body>

<h1>Modifica Prodotto</h1>

<form action="../actions/admin_update.php" method="POST">
    <input type="hidden" name="product_id" value="<?= $product->getId(); ?>">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?= $product->getNome(); ?>" required><br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" value="<?= $product->getMarca(); ?>" required><br>

    <label for="prezzo">Prezzo:</label>
    <input type="number" step="0.01" name="prezzo" value="<?= $product->getPrezzo(); ?>" required><br>

    <input type="submit" value="Modifica Prodotto">
</form>

</body>
</html>
