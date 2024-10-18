<?php
require_once '../controllers/ProductController.php';
require_once '../dao/CartManager.php';
require_once '../controllers/CartController.php';

// Verificăm dacă există un ID de produs în cerere
if (!isset($_GET['id'])) {
    echo "Produsul nu a fost găsit.";
    exit;
}

// Creăm instanța ProductController
$productId = $_GET['id'];
$productController = new ProductController();
$product = $productController->getProductById($productId);

// Verificăm dacă produsul este valid
if (!$product) {
    echo "Produsul nu a fost găsit.";
    exit;
}

// Creăm instanța CartManager și CartController
$cartManager = new CartManager();
$cartController = new CartController($cartManager);

// Verificăm dacă s-a trimis formularul pentru adăugarea în coș
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    $quantity = intval($_POST['quantity']);
    
    // Verificăm dacă cantitatea este validă
    if ($quantity > 0) {
        try {
            $cartController->addProductToCart($productId, $quantity);
            echo "<script>alert('Produsul a fost adăugat în coș!'); window.location.href='product.php?id=$productId';</script>";
            exit;
        } catch (Exception $e) {
            echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
        }
    } else {
        echo "<script>alert('Cantitatea trebuie să fie cel puțin 1.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product->getTitle()); ?></title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <h1><?= htmlspecialchars($product->getTitle()); ?></h1>

    <nav class="navbar">
        <ul>
            <li><a href="../views/home.php">Home</a></li>
            <li><a href="../views/cart.php">Cart</a></li>
            <li><a href="../views/report.php">Report</a></li>
        </ul>
    </nav>

    <div class="product-details">
    <h2>Detalii produs</h2>
    <p>Descriere: <?= htmlspecialchars($product->getDescription()); ?></p>
    <p>Categorii: <?= implode(', ', $product->getCategories()); ?></p>
    <p>Preț: <?= number_format($product->getPriceWithTax(), 2); ?> RON</p>

    <form action="" method="POST">
        <label for="quantity">Cantitate:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" required>
        <button type="submit" class="btn">Adaugă în coș</button>
    </form>
</div>

</body>
</html>
