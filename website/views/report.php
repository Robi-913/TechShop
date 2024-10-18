<?php
require_once '../controllers/OrderController.php';

// Creăm instanța OrderController
$orderController = new OrderController();

// Obține toate comenzile filtrate
try {
    $filteredOrders = $orderController->getFilteredOrders();
} catch (Exception $e) {
    $filteredOrders = []; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport Comenzi</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Report</h1>

    <nav class="navbar">
        <ul>
            <li><a href="../views/home.php">Home</a></li>
            <li><a href="../views/cart.php">Cart</a></li>
            <li><a href="../views/report.php">Report</a></li>
        </ul>
    </nav>

    <?php if (empty($filteredOrders)): ?>
    <div class="report-message">
        <p>Nu există comenzi cu produse mai mici de 100 lei din categoriile cu mai mult de 3 produse.</p>
    </div>
    <?php else: ?>
    <div class="orders-box">
        <table>
            <thead>
                <tr>
                    <th>ID Comandă</th>
                    <th>Data Plasării Comenzii</th>
                    <th>Nume Client</th>
                    <th>Email Client</th>
                    <th>ID Produs</th>
                    <th>Nume Produs</th>
                    <th>Pret Produs</th>
                    <th>Cantitate</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredOrders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']); ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d H:i:s', strtotime($order['order_date']))); ?></td>
                        <td><?= htmlspecialchars($order['customer_name']); ?></td>
                        <td><?= htmlspecialchars($order['email']); ?></td>
                        <td><?= htmlspecialchars($order['product_id']); ?></td>
                        <td><?= htmlspecialchars($order['product_name']); ?></td>
                        <td><?= htmlspecialchars($order['product_price']); ?></td>
                        <td><?= htmlspecialchars($order['quantity']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

</body>
</html>
