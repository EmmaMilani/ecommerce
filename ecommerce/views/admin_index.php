<?php

require_once "../classes/product.php";
require_once "../DBManager.php";
require_once "../classes/user.php";

session_start();
$current_user = $_SESSION['current_user'];

if($current_user == null || $current_user->getRoleId() != 2){ //controllo se l'utente si è loggato e se è un admin
    $current_user = null;
    header("Location: ../views/login.php");
    exit;
}

$products = [];
$products = Product::fetchAll();

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Pagina admin</title>
</head>
<body>

<h1>Prodotti</h1>
<button style="position: fixed ; right: 20px"><a href="products.php">Catalogo</a></button>
<br><br>
<button style=" position: fixed ; right: 20px"><a href="../actions/logout.php">Logout</a></button>
<?php foreach ($products as $product) { ?>
    <ul>
        <li><?php echo $product->GetNome() ?></li>
        <li><?php echo $product->GetMarca() ?></li>
        <li><?php echo $product->GetPrezzo() ?></li>
    </ul>
    <form action="admin_update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
        <input type="submit" value="Modifica prodotto">
    </form>
<?php } ?>
<br><br>
<h3>Crea prodotto</h3>
<form action="../actions/admin_create.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" required><br><br>

    <label for="prezzo">Prezzo:</label>
    <input type="number" step="0.01" name="prezzo" required><br><br>
    <button type="submit">Crea</button>
</form>

</body>
</html>