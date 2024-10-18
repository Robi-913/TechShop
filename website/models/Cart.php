<?php

class Cart {
    private $productId;
    private $productName;
    private $quantity;

    public function __construct($productId, $productName, $quantity) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->setQuantity($quantity);
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        if ($quantity < 1) {
            throw new InvalidArgumentException("Cantitatea trebuie să fie cel puțin 1.");
        }
        $this->quantity = $quantity;
    }
}

?>
