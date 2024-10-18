<?php

require_once '../models/Product.php';
require_once '../dao/ProductManager.php';

class ProductController {
    private $productManager;

    public function __construct() {
        $this->productManager = new ProductManager();
    }

    public function listProducts() {
        try {
            return $this->productManager->getAllProducts();
        } catch (Exception $e) {
            return ['error' => 'Failed to retrieve products: ' . $e->getMessage()];
        }
    }

    public function getProductById($productId) {
        try {
            $product = $this->productManager->getProductById($productId);
            if (!$product) {
                throw new InvalidArgumentException("Product not found.");
            }
            return $product;
        } catch (Exception $e) {
            return ['error' => 'Failed to retrieve product: ' . $e->getMessage()];
        }
    }
}

?>