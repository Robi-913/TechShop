-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost:3307
-- Timp de generare: oct. 02, 2024 la 01:16 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `my_shop`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Laptops'),
(2, 'Mobile Phones'),
(3, 'Tablets'),
(4, 'Accessories'),
(5, 'Televisions'),
(6, 'Smart Watches');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `email`, `phone`, `address`, `total`, `order_date`) VALUES
(1, 'Robert Ardelean', 'tttrobert13@gmail.com', '0758329805', 'Aleea Dobrogei 8', 6219.98, '2024-10-02 14:14:31'),
(2, 'Robert Ardelean', 'tttrobert13@gmail.com', '0758329805', 'Zorilor 39', 7500.00, '2024-10-02 14:15:55');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 3, 1),
(2, 1, 11, 1),
(3, 1, 14, 1),
(4, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_taxable` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `is_taxable`) VALUES
(1, 'MacBook Pro 16', 'Apple MacBook Pro 16 inch, 16GB RAM, 512GB SSD', 7500.00, 1),
(2, 'Dell XPS 13', 'Dell XPS 13 inch, 8GB RAM, 256GB SSD', 6000.00, 1),
(3, 'iPhone 14 Pro', 'Apple iPhone 14 Pro, 256GB, 5G', 6100.00, 1),
(4, 'Samsung Galaxy S22', 'Samsung Galaxy S22, 128GB, 5G', 4500.00, 1),
(5, 'iPad Pro', 'Apple iPad Pro 11 inch, 128GB, Wi-Fi', 5000.00, 1),
(6, 'Logitech MX Master 3', 'Wireless mouse, ergonomic design', 500.00, 0),
(7, 'AirPods 4', 'Wireless noise-cancelling headphones', 1100.00, 1),
(8, 'Samsung QLED 65 inch', 'Samsung 4K QLED Smart TV, 65 inch', 9000.00, 1),
(9, 'Apple Watch Series 10', 'Apple Watch Series 8, GPS, 45mm, Aluminium Case', 2500.00, 1),
(10, 'Samsung Galaxy Watch 5', 'Samsung Galaxy Watch 5, Bluetooth, 44mm', 1300.00, 0),
(11, 'USB-C to USB Adapter', 'Adapter pentru conectare USB-C la USB-A', 49.99, 0),
(12, 'HDMI Cable', 'Cablu HDMI de 1.5 metri', 29.99, 0),
(13, 'Screen Cleaning Kit', 'Set de curățare pentru ecran', 19.99, 0),
(14, 'Smartphone Stand', 'Suport ajustabil pentru smartphone', 69.99, 0),
(15, 'USB Flash Drive 32GB', 'Memorie USB 32GB, USB 3.0', 89.99, 0),
(16, 'Wireless Mouse Pad', 'Mousepad cu încărcare wireless integrată', 99.00, 0),
(17, 'HP Spectre x360', 'HP Spectre x360, 16GB RAM, 512GB SSD', 7000.00, 1),
(18, 'Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad X1 Carbon Gen 9, 16GB RAM, 512GB SSD', 8200.00, 1),
(19, 'Google Pixel 6', 'Google Pixel 6, 128GB, 5G', 4500.00, 1),
(20, 'OnePlus 9', 'OnePlus 9, 128GB, 5G', 4800.00, 1),
(21, 'Microsoft Surface Pro 8', 'Microsoft Surface Pro 8, 16GB RAM, 256GB SSD', 6000.00, 1),
(22, 'Samsung Galaxy Tab S8', 'Samsung Galaxy Tab S8, 128GB, Wi-Fi', 4000.00, 1),
(23, 'Razer DeathAdder V2', 'Razer DeathAdder V2, wired gaming mouse', 350.00, 0),
(24, 'Bose QuietComfort 35 II', 'Bose QuietComfort 35 II, wireless noise-cancelling headphones', 1200.00, 1),
(25, 'LG OLED 55 inch', 'LG OLED Smart TV, 55 inch', 8000.00, 1),
(26, 'Sony Bravia XR 55 inch', 'Sony Bravia XR 55 inch, 4K Smart TV', 7500.00, 1),
(27, 'Fitbit Versa 3', 'Fitbit Versa 3, GPS, Heart Rate Monitor', 1500.00, 1),
(28, 'Garmin Forerunner 245', 'Garmin Forerunner 245, GPS, Music', 1300.00, 1),
(29, 'ASUS ROG Zephyrus G14', 'ASUS ROG Zephyrus G14, 16GB RAM, 1TB SSD', 9500.00, 1),
(30, 'Microsoft Surface Laptop 4', 'Microsoft Surface Laptop 4, 16GB RAM, 512GB SSD', 7500.00, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 4),
(7, 4),
(8, 5),
(9, 6),
(10, 6),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 1),
(18, 1),
(19, 2),
(20, 2),
(21, 3),
(22, 3),
(23, 4),
(24, 4),
(25, 5),
(26, 5),
(27, 6),
(28, 6),
(29, 1),
(30, 1);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexuri pentru tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexuri pentru tabele `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pentru tabele `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pentru tabele `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pentru tabele `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constrângeri pentru tabele `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constrângeri pentru tabele `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
