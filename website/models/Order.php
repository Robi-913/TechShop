<?php

class Order {
    private $id;
    private $customerName;
    private $email;
    private $phone;
    private $address;
    private $totalAmount;
    private $orderDate; // New property for order date

    public function __construct($id, $customerName, $email, $phone, $address, $totalAmount, $orderDate) {
        $this->id = $id;
        $this->customerName = $customerName;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->totalAmount = $totalAmount;
        $this->orderDate = $orderDate;
    }

    public function getId() {
        return $this->id;
    }

    public function getCustomerName() {
        return $this->customerName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }
}


?>
