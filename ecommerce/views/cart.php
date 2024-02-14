<?php

require_once "../DBManager.php";
require_once "../classes/cart_product.php";
require_once "../classes/product.php";
require_once "../classes/user.php";

session_start();

$current_user = $_SESSION['current_user'];

if (!$current_user) {
    header("Location: ../views/login.php");
    exit();
}
$products = Cart_product::fetchAll($current_user);
?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Carrello</title>
</head>
<body>
    <h1>Carrello</h1>
    <button style="position: fixed ; right: 20px"><a href="products.php">Catalogo</a></button>
    <br><br>
    <button style=" position: fixed ; right: 20px"><a href="../actions/logout.php">Logout</a></button>

    <?php if($products != null){
    foreach ($products as $product) { ?>
        <ul>
            <li><?= $product->GetProduct()->GetId(); ?></li>
            <li><?= $product->GetProduct()->GetNome(); ?></li>
            <li><?= $product->GetProduct()->GetMarca(); ?></li>
            <li><?= $product->GetProduct()->GetPrezzo(); ?></li>
            <li><?= $product->GetQuantita(); ?></li>
            <li><?= $product->GetQuantita() * $product->GetProduct()->getPrezzo(); ?></li>
            <form action="../actions/delete_product.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $product->GetProduct()->GetId(); ?>"><br>
                <input type="submit" value="Elimina prodotto">
            </form>
        </ul>
    <?php } } else {?>
        <p>Carrello vuoto.</p>
    <?php } ?>
</body>
</html>
