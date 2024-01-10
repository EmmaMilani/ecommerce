<?php
require_once "../../classes/Class_product.php";
$product = new Product();
?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettaglio Prodotto</title>
    <style>
        /* Stili CSS per la pagina */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .product-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
        }
        .product-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .product-info {
            text-align: left;
        }
        .product-info h2 {
            margin-top: 0;
        }
        .product-info p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="product-container">
    <img class="product-img" src="" alt="Prodotto">
    <div class="product-info">
        <h2>Dettagli Prodotto</h2>
        <p>Nome: <?php $product->GetNome(); ?></span></p>
        <div class="quantity-container">
            <button id="decreaseBtn">-</button>
            <input type="number" id="quantityInput" value="1" min="1" max="10">
            <button id="increaseBtn">+</button>
        </div>
        <p>Marca: <?php $product->GetMarca(); ?></span></p>
    </div>
</div>
</body>
</html>
