<?php
require_once '../models/Order.php';
require_once '../dao/OrderManager.php';
require_once '../dao/CartManager.php';

class OrderController {
    private $orderManager;
    private $cartManager;

    public function __construct() {
        $this->orderManager = new OrderManager();
        $this->cartManager = new CartManager(); 
    }

    public function placeOrder($customerName, $email, $phone, $address) {
        try {
            // Calculează totalul din cart
            $totalAmount = $this->cartManager->calculateTotalPrice();

            // Obține ID-urile produselor din cart
            $productIds = $this->cartManager->getProductIdsInCart();
            
            // Obține cantitățile produselor din cart
            $quantities = $this->cartManager->getQuantitiesInCart();

            // Asigură-te că ID-urile și cantitățile au aceeași lungime
            if (count($productIds) !== count($quantities)) {
                throw new Exception("Mismatch between product IDs and quantities.");
            }

            // Plasează comanda
            return $this->orderManager->placeOrder($customerName, $email, $phone, $address, $totalAmount, $productIds, $quantities);
        } catch (Exception $e) {
            throw new Exception("Eroare la plasarea comenzii: " . $e->getMessage());
        }
    }

    public function getAllOrders() {
        try {
            return $this->orderManager->getAllOrders();
        } catch (Exception $e) {
            return ['error' => 'Failed to retrieve orders: ' . $e->getMessage()];
        }
    }

    public function getFilteredOrders() {
        try {
            return $this->orderManager->getFilteredOrders();
        } catch (Exception $e) {
            return ['error' => 'Failed to retrieve orders: ' . $e->getMessage()];
        }
    }
}
?>
