<?php
require_once "../../classes/Class_product.php";
?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    <style>
        /* Stili CSS per la pagina */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .product {
            width: calc(33.33% - 20px);
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #fff;
            overflow: hidden;
        }
        .product img {
            width: 100%;
            height: auto;
        }
        .product-info {
            padding: 10px;
        }
        .product h2 {
            margin-top: 0;
        }
        .product p {
            margin-bottom: 0;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Ecommerce</h1>
</header>

<div class="container">
    <?php
    $products = Product::fetchAll();
    $product = new Product();
    foreach ($products as $product){ ?>
    <div class="product">
        <img src="" alt="Prodotto">
        <div class="product-info">
            <p><?php $product->GetId(); ?></p>
            <h2><?php $product->GetNome(); ?></h2>
            <p><?php $product->GetMarca() ?></p>
            <p>Prezzo: <?php $product->GetPrezzo(); ?></p>
            <button>Aggiungi al Carrello</button>
        </div>
    </div>
    <?php } ?>

</div>

<footer>
    <p>&copy; 2024 Ecommerce</p>
</footer>

</body>
</html>
