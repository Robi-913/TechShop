<?php
require_once '../controllers/CartController.php';

$cartController = new CartController();

// Verificăm dacă este o cerere de ștergere
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $productId = $_POST['product_id'];
    $cartController->removeProductFromCart($productId); // Apelăm metoda de ștergere
    header("Location: " . $_SERVER['PHP_SELF']); // Reload pagina curentă
    exit;
}

// Verificăm dacă este o cerere de actualizare
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_item'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $cartController->updateProductInCart($productId, $quantity); // Apelăm metoda de actualizare
    header("Location: " . $_SERVER['PHP_SELF']); // Reload pagina curentă
    exit;
}

// Obținem articolele din coș
$cartItems = $cartController->getCartItems();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Shopping Cart</h1>
    <nav class="navbar">
        <ul>
            <li><a href="../views/home.php">Home</a></li>
            <li><a href="../views/cart.php">Cart</a></li>
            <li><a href="../views/report.php">Report</a></li>
        </ul>
    </nav>

    <div class="cart-items">
        <?php if (empty($cartItems)): ?>
            <p>Coșul este gol!</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Număr de ordine</th>
                        <th>Produs</th>
                        <th>Cantitate</th>
                        <th>Preț (cu TVA)</th>
                        <th>Total</th>
                        <th>Acțiune</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalCartValue = 0; // Calculăm totalul
                    foreach ($cartItems as $index => $item): 
                        $itemTotal = $item['price'] * $item['quantity']; 
                        $totalCartValue += $itemTotal; 
                    ?>
                        <tr>
                            <td><?= $index + 1 ?></td> <!-- Numărul de ordine -->
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td>
                                <form action="" method="post" class="update-item-form">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" required>
                                    <button type="submit" name="update_item" class="btn btn-update">Actualizează</button>
                                </form>
                            </td>
                            <td><?= number_format($item['price'], 2) ?> RON</td>
                            <td><?= number_format($itemTotal, 2) ?> RON</td> <!-- Afișăm totalul pentru articol -->
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <button type="submit" name="remove_item" class="btn btn-remove">Șterge</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right;"><strong>Total Coș:</strong></td>
                        <td><?= number_format($totalCartValue, 2) ?> RON</td> <!-- Totalul coșului -->
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="checkout">
                <a href="../views/checkout.php" class="btn">Finalizare Comandă</a> <!-- Buton de finalizare comandă -->
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
