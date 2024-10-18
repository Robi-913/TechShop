<?php

require_once '../models/Product.php';

class ConfigTax {
    public static $taxRate = 19; 
}

class TaxableProduct extends Product {
    private $taxRate;

    public function __construct($id, $title, $description, $price, $categories = []) {
        parent::__construct($id, $title, $description, $price, $categories);
        $this->taxRate = ConfigTax::$taxRate; 
    }

    public function getPriceWithTax() {
        return $this->price + ($this->price * $this->taxRate / 100);
    }

    public static function PriceWithTax($price){
        return $price + ($price * ConfigTax::$taxRate / 100);
    }
}

?>
