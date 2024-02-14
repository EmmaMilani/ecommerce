<?php

require_once "../classes/product.php";
require_once "../DBManager.php";
require_once "../classes/user.php";

session_start();
$current_user = $_SESSION['current_user'];

if($current_user == null){
    header("Location: ../views/login.php");
    exit;
}

$products = [];
$products = Product::fetchAll();

?>

<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Visualizza Prodotti</title>
</head>
<body>
<h2>Catalogo</h2>

<button style=" position: fixed ; right: 20px"><a href="../actions/logout.php">Logout</a></button>
<br><br>
<button style=" position: fixed ; right: 20px"><a href="cart.php">Carrello</a></button>
<br><br>
<?php
if($current_user->getRoleId() == 2){?>
    <button style=" position: fixed ; right: 20px"><a href="admin_index.php">Pagina admin</a></button>
<?php }

foreach ($products as $product) { ?>
    <ul>
        <li><?php echo $product->GetNome() ?></li>
        <li><?php echo $product->GetMarca() ?></li>
        <li><?php echo $product->GetPrezzo() ?></li>
    </ul>

    <form action="../actions/add_to_cart.php" method="POST">
        <input type="number" name="quantita" placeholder="Quantità">
        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
        <input type="submit" value="Aggiungi al carrello">
    </form>
<?php } ?>

</body>
</html>