
<?php

require_once '../models/Product.php';
require_once '../models/TaxableProduct.php';
require_once '../connection/Database.php';

class ProductManager {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllProducts() {
        $products = $this->db->query('SELECT p.*, GROUP_CONCAT(c.name) as categories 
                                       FROM products p
                                       LEFT JOIN product_categories pc ON p.id = pc.product_id
                                       LEFT JOIN categories c ON pc.category_id = c.id
                                       GROUP BY p.id')->fetchAll();

        return array_map(function($product) {
            $categories = !empty($product['categories']) ? explode(',', $product['categories']) : [];

            if ($product['is_taxable']) {
                return new TaxableProduct($product['id'], $product['title'], $product['description'], $product['price'], $categories);
            } else {
                return new Product($product['id'], $product['title'], $product['description'], $product['price'], $categories);
            }
        }, $products);
    }

    public function getProductById($id) {
        $product = $this->db->query('SELECT p.*, GROUP_CONCAT(c.name) as categories 
                                       FROM products p
                                       LEFT JOIN product_categories pc ON p.id = pc.product_id
                                       LEFT JOIN categories c ON pc.category_id = c.id
                                       WHERE p.id = ?
                                       GROUP BY p.id', [$id])->fetch();

        if ($product) {
            $categories = !empty($product['categories']) ? explode(',', $product['categories']) : [];

            if ($product['is_taxable']) {
                return new TaxableProduct($product['id'], $product['title'], $product['description'], $product['price'], $categories);
            } else {
                return new Product($product['id'], $product['title'], $product['description'], $product['price'], $categories);
            }
        }

        return null;
    }
}

?>