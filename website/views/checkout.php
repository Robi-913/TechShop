<?php
require_once '../controllers/OrderController.php';
require_once '../dao/CartManager.php';

// Creăm instanța OrderController și CartManager
$orderController = new OrderController();
$cartManager = new CartManager();

// Obținem totalul comenzii din cart
$totalAmount = $cartManager->calculateTotalPrice();

// Obținem produsele din coș
$products = $cartManager->getCartItems(); // Această metodă returnează un array cu detalii despre produse

$message = ''; // Inițializăm mesajul

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Plasează comanda
    try {
        $orderResponse = $orderController->placeOrder($customerName, $email, $phone, $address, $products);
        $message = "Comanda a fost plasată cu succes! ID Comandă: " . $orderResponse->getId();
        
        // Resetează coșul după plasarea comenzii
        $cartManager->clearCart();
    } catch (Exception $e) {
        $message = "Eroare: " . $e->getMessage();
    }
}    

// Obține toate comenzile pentru a le afișa
$orders = $orderController->getAllOrders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Checkout</h1>

    <nav class="navbar">
        <ul>
            <li><a href="../views/home.php">Home</a></li>
            <li><a href="../views/cart.php">Cart</a></li>
            <li><a href="../views/report.php">Report</a></li>
        </ul>
    </nav>

    <div class="checkout-form">
        <form action="" method="POST">
            <label for="name">Nume:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="phone">Telefon:</label>
            <input type="tel" name="phone" required>

            <label for="address">Adresă:</label>
            <input type="text" name="address" required>

            <h2>Total comanda: <?= number_format($totalAmount, 2); ?> RON</h2>

            <button type="submit" class="btn">Trimite comanda</button>
        </form>
    </div>


    <?php if (!empty($message)): ?>
        <?php if (!empty($message)): ?>
            <div class="message"><?= $message; ?></div>
    <?php endif; ?>

    <?php endif; ?>

    <div class="orders-box">
    <h2>Comenzile Anterioare</h2>
    <?php if (empty($orders)): ?>
        <p>Nu există comenzi anterioare.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID Comandă</th>
                    <th>Nume Client</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Adresă</th>
                    <th>Total (RON)</th>
                    <th>Data Comenzii</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order->getId()); ?></td>
                        <td><?= htmlspecialchars($order->getCustomerName()); ?></td>
                        <td><?= htmlspecialchars($order->getEmail()); ?></td>
                        <td><?= htmlspecialchars($order->getPhone()); ?></td>
                        <td><?= htmlspecialchars($order->getAddress()); ?></td>
                        <td><?= number_format($order->getTotalAmount(), 2); ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d H:i:s', strtotime($order->getOrderDate()))); ?></td> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
