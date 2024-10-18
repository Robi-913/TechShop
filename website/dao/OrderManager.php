<?php
require_once '../models/Order.php';
require_once '../connection/Database.php';

class OrderManager {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function placeOrder($customerName, $email, $phone, $address, $totalAmount, $productIds, $quantities) {
        // Verifică dacă toate câmpurile necesare sunt completate
        if (empty($customerName) || empty($email) || empty($phone) || empty($address) || empty($totalAmount) || empty($productIds) || empty($quantities)) {
            throw new InvalidArgumentException("All fields must be filled out, including cart items.");
        }
        
        if (count($productIds) !== count($quantities)) {
            throw new InvalidArgumentException("The number of product IDs must match the number of quantities.");
        }
    
        try {
            // Start the transaction
            $this->db->beginTransaction();
    
            // Insert the order into the `orders` table
            $this->db->query('INSERT INTO orders (customer_name, email, phone, address, total) VALUES (?, ?, ?, ?, ?)', [
                $customerName,
                $email,
                $phone,
                $address,
                $totalAmount
            ]);
            $orderId = $this->db->getLastInsertId();
    
            // Loop through the product IDs and quantities to insert into `order_items`
            for ($i = 0; $i < count($productIds); $i++) {
                $this->db->query('INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)', [
                    $orderId,
                    $productIds[$i],
                    $quantities[$i]
                ]);
            }
    
            // Get the order date (optional)
            $orderDate = $this->getOrderDate($orderId);
    
            // Commit the transaction
            $this->db->commit();
    
            return new Order($orderId, $customerName, $email, $phone, $address, $totalAmount, $orderDate);
        } catch (Exception $e) {
            // Roll back the transaction in case of failure
            $this->db->rollBack();
            throw new Exception("Failed to place order: " . $e->getMessage());
        }
    }
    
    

    private function getOrderDate($orderId) {
        $stmt = $this->db->query('SELECT order_date FROM orders WHERE id = ?', [$orderId]);
        
        if ($stmt->rowCount() > 0) { 
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            return $result['order_date']; 
        }
        
        return null;
    }
    

    public function getAllOrders() {
        try {
            $results = $this->db->query('SELECT * FROM orders');
    
            $orders = [];
            foreach ($results as $row) {
                $orders[] = new Order($row['id'], $row['customer_name'], $row['email'], $row['phone'], $row['address'], $row['total'], $row['order_date']);
            }
            return $orders;
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve orders: " . $e->getMessage());
        }
    }

    public function getFilteredOrders() {
        $query = "
                    SELECT 
                        o.id AS order_id,
                        o.order_date,
                        o.customer_name,
                        o.email,
                        COUNT(oi.product_id) AS total_products,
                        oi.product_id,
                        p.title AS product_name,
                        p.price AS product_price,
                        oi.quantity
                    FROM 
                        orders o
                    JOIN 
                        order_items oi ON o.id = oi.order_id
                    JOIN 
                        products p ON oi.product_id = p.id
                    JOIN 
                        product_categories pc ON p.id = pc.product_id
                    JOIN 
                        categories c ON pc.category_id = c.id
                    WHERE 
                        p.price < 100
                        AND c.id IN (
                            SELECT 
                                category_id
                            FROM 
                                product_categories
                            GROUP BY 
                                category_id
                            HAVING 
                                COUNT(product_id) > 3
                        )
                    GROUP BY 
                        o.id, oi.product_id
                    ORDER BY 
                        oi.quantity DESC;
        ";
    
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}

?>
