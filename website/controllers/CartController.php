<?php

require_once '../dao/CartManager.php';

class CartController {
    private $cartManager;

    public function __construct() {
        $this->cartManager = new CartManager();
    }

    public function addProductToCart($productId, $quantity) {
        $productName = $this->cartManager->getProductName($productId); // Obținem numele produsului din baza de date
        if ($productName) {
            $cartItem = new Cart($productId, $productName, $quantity);
            $this->cartManager->addCartItem($cartItem);
        } else {
            throw new Exception("Product not found");
        }
    }

    public function removeProductFromCart($productId) {
        $this->cartManager->removeCartItem($productId);
    }

    public function updateProductInCart($productId, $quantity) {
        $productName = $this->cartManager->getProductName($productId); // Obținem numele produsului din baza de date
        if ($productName) {
            $cartItem = new Cart($productId, $productName, $quantity);
            $this->cartManager->updateCartItem($cartItem);
        } else {
            throw new Exception("Product not found");
        }
    }

    public function getCartItems() {
        return $this->cartManager->getCartItems();
    }

    public function calculateTotalPrice() {
        return $this->cartManager->calculateTotalPrice();
    }
}

?>
