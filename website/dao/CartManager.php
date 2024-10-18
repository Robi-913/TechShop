<?php

require_once '../models/Cart.php';
require_once '../models/TaxableProduct.php';
require_once '../models/Product.php';
require_once '../connection/Database.php';

class CartManager {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance(); 
    }

    public function addCartItem(Cart $item) {
        $query = "INSERT INTO cart_items (product_id, product_name, quantity) 
                  VALUES (" . $item->getProductId() . ", '" . $item->getProductName() . "', " . $item->getQuantity() . ")
                  ON DUPLICATE KEY UPDATE quantity = quantity + " . $item->getQuantity(); 
    
        $this->db->query($query);
    }

    public function clearCart() {
        $this->db->query('DELETE FROM cart_items'); 
        unset($_SESSION['cart']);
    }

    public function removeCartItem($productId) {
        $query = "DELETE FROM cart_items WHERE product_id = :product_id";
        $this->db->query($query, [':product_id' => $productId]);
    }

    public function updateCartItem(Cart $item) {
        $query = "UPDATE cart_items SET quantity = :quantity WHERE product_id = :product_id";
        $this->db->query($query, [
            ':product_id' => $item->getProductId(),
            ':quantity' => $item->getQuantity()
        ]);
    }

    public function getCartItems() {
        $query = "SELECT ci.product_id, ci.product_name, ci.quantity, p.price, p.is_taxable 
                  FROM cart_items ci 
                  JOIN products p ON ci.product_id = p.id";
        
        $cartItems = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($cartItems as &$item) {
            // Aplică impozitul doar dacă produsul este marcat ca impozabil
            if ($item['is_taxable']) {
                $item['price'] = TaxableProduct::PriceWithTax($item['price']);
            } else {
                // Altfel, păstrează prețul fără taxe
                $item['price'] = number_format($item['price'], 2); // Păstrează formatul în 2 zecimale
            }
        }
        
        return $cartItems;
    }
    

    public function getCartQuantity() {
        $query = "SELECT ci.product_id, ci.quantity 
                  FROM cart_items ci 
                  JOIN products p ON ci.product_id = p.id";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateTotalPrice() {
        $query = "SELECT SUM(p.price * ci.quantity) AS total 
                  FROM cart_items ci 
                  JOIN products p ON ci.product_id = p.id";
        
        $stmt = $this->db->query($query);
        $result = $stmt->fetch();

        return $result['total'] ?? 0; 
    }

    public function getProductName($productId) {
        $query = "SELECT title FROM products WHERE id = :product_id";
        $stmt = $this->db->query($query, [':product_id' => $productId]);

        $result = $stmt->fetch();
        return $result['title']; 
    }

    // Metoda pentru a obține ID-urile produselor din cart
    public function getProductIdsInCart() {
        $query = "SELECT product_id FROM cart_items";
        return $this->db->query($query)->fetchAll(PDO::FETCH_COLUMN);
    }

    // Metoda pentru a obține cantitățile produselor din cart
    public function getQuantitiesInCart() {
        $query = "SELECT quantity FROM cart_items";
        return $this->db->query($query)->fetchAll(PDO::FETCH_COLUMN);
    }
}

?>
