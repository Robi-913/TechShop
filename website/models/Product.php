<?php

class Product {
    protected $id;
    protected $title;
    protected $description;
    protected $price;
    protected $categories = []; 

    public function __construct($id, $title, $description, $price, $categories = []) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->categories = $categories;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getCategories() {
        return $this->categories;
    }

    public function getPriceWithTax() {
        return $this->price;
    }
}

?>
