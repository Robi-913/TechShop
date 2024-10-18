<?php
// Include controller-ul pentru produse
require_once '../controllers/ProductController.php';

// Creează instanța controller-ului și obține lista de produse
$productController = new ProductController();
$products = $productController->listProducts();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Store Page</h1>
    <nav class="navbar">
        <ul>
            <li><a href="../views/home.php">Home</a></li>
            <li><a href="../views/cart.php">Cart</a></li>
            <li><a href="../views/report.php">Report</a></li>
        </ul>
    </nav>

    <div class="product-list">
        <?php foreach ($products as $product) : ?>
            <div class="product-item">
                <h2><?= $product->getTitle(); ?></h2>
                <p>Preț: <?= number_format($product->getPriceWithTax(), 2); ?> RON</p>
                <a href="product.php?id=<?= $product->getId(); ?>" class="btn">Vezi detalii</a>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>