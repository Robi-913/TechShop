CREATE DATABASE IF NOT EXISTS my_shop;
USE my_shop;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    is_taxable BOOLEAN DEFAULT FALSE
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE product_categories (
    product_id INT,
    category_id INT,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    PRIMARY KEY (product_id, category_id)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id)
);


INSERT INTO categories (name) 
VALUES 
('Laptops'),
('Mobile Phones'),
('Tablets'),
('Accessories'),
('Televisions'),
('Smart Watches');

INSERT INTO products (title, description, price, is_taxable)
VALUES 
('MacBook Pro 16', 'Apple MacBook Pro 16 inch, 16GB RAM, 512GB SSD', 7500.00, TRUE),
('Dell XPS 13', 'Dell XPS 13 inch, 8GB RAM, 256GB SSD', 6000.00, TRUE),
('iPhone 14 Pro', 'Apple iPhone 14 Pro, 256GB, 5G', 6100.00, TRUE),
('Samsung Galaxy S22', 'Samsung Galaxy S22, 128GB, 5G', 4500.00, TRUE),
('iPad Pro', 'Apple iPad Pro 11 inch, 128GB, Wi-Fi', 5000.00, TRUE),
('Logitech MX Master 3', 'Wireless mouse, ergonomic design', 500.00, FALSE),
('AirPods 4', 'Wireless noise-cancelling headphones', 1100.00, TRUE),
('Samsung QLED 65 inch', 'Samsung 4K QLED Smart TV, 65 inch', 9000.00, TRUE),
('Apple Watch Series 10', 'Apple Watch Series 8, GPS, 45mm, Aluminium Case', 2500.00, TRUE),
('Samsung Galaxy Watch 5', 'Samsung Galaxy Watch 5, Bluetooth, 44mm', 1300.00, FALSE),
('USB-C to USB Adapter', 'Adapter pentru conectare USB-C la USB-A', 49.99, FALSE),
('HDMI Cable', 'Cablu HDMI de 1.5 metri', 29.99, FALSE),
('Screen Cleaning Kit', 'Set de curățare pentru ecran', 19.99, FALSE),
('Smartphone Stand', 'Suport ajustabil pentru smartphone', 69.99, FALSE),
('USB Flash Drive 32GB', 'Memorie USB 32GB, USB 3.0', 89.99, FALSE),
('Wireless Mouse Pad', 'Mousepad cu încărcare wireless integrată', 99.00, FALSE),
('HP Spectre x360', 'HP Spectre x360, 16GB RAM, 512GB SSD', 7000.00, TRUE),
('Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad X1 Carbon Gen 9, 16GB RAM, 512GB SSD', 8200.00, TRUE),
('Google Pixel 6', 'Google Pixel 6, 128GB, 5G', 4500.00, TRUE),
('OnePlus 9', 'OnePlus 9, 128GB, 5G', 4800.00, TRUE),
('Microsoft Surface Pro 8', 'Microsoft Surface Pro 8, 16GB RAM, 256GB SSD', 6000.00, TRUE),
('Samsung Galaxy Tab S8', 'Samsung Galaxy Tab S8, 128GB, Wi-Fi', 4000.00, TRUE),
('Razer DeathAdder V2', 'Razer DeathAdder V2, wired gaming mouse', 350.00, FALSE),
('Bose QuietComfort 35 II', 'Bose QuietComfort 35 II, wireless noise-cancelling headphones', 1200.00, TRUE),
('LG OLED 55 inch', 'LG OLED Smart TV, 55 inch', 8000.00, TRUE),
('Sony Bravia XR 55 inch', 'Sony Bravia XR 55 inch, 4K Smart TV', 7500.00, TRUE),
('Fitbit Versa 3', 'Fitbit Versa 3, GPS, Heart Rate Monitor', 1500.00, TRUE),
('Garmin Forerunner 245', 'Garmin Forerunner 245, GPS, Music', 1300.00, TRUE),
('ASUS ROG Zephyrus G14', 'ASUS ROG Zephyrus G14, 16GB RAM, 1TB SSD', 9500.00, TRUE), -- Produs suplimentar
('Microsoft Surface Laptop 4', 'Microsoft Surface Laptop 4, 16GB RAM, 512GB SSD', 7500.00, TRUE); -- Produs suplimentar

INSERT INTO product_categories (product_id, category_id) 
VALUES 
(1, 1), -- MacBook Pro -> Laptops
(2, 1), -- Dell XPS 13 -> Laptops
(3, 2), -- iPhone 14 Pro -> Mobile Phones
(4, 2), -- Samsung Galaxy S22 -> Mobile Phones
(5, 3), -- iPad Pro -> Tablets
(6, 4), -- Logitech MX Master 3 -> Accessories
(7, 4), -- AirPods 4 -> Accessories
(8, 5), -- Samsung QLED 65 inch -> Televisions
(9, 6), -- Apple Watch Series 10 -> Smart Watches
(10, 6), -- Samsung Galaxy Watch 5 -> Smart Watches
(11, 4), -- USB-C to USB Adapter -> Accessories
(12, 4), -- HDMI Cable -> Accessories
(13, 4), -- Screen Cleaning Kit -> Accessories
(14, 4), -- Smartphone Stand -> Accessories
(15, 4), -- USB Flash Drive 32GB -> Accessories
(16, 4), -- Wireless Mouse Pad -> Accessories
(17, 1), -- HP Spectre x360 -> Laptops
(18, 1), -- Lenovo ThinkPad X1 Carbon -> Laptops
(19, 2), -- Google Pixel 6 -> Mobile Phones
(20, 2), -- OnePlus 9 -> Mobile Phones
(21, 3), -- Microsoft Surface Pro 8 -> Tablets
(22, 3), -- Samsung Galaxy Tab S8 -> Tablets
(23, 4), -- Razer DeathAdder V2 -> Accessories
(24, 4), -- Bose QuietComfort 35 II -> Accessories
(25, 5), -- LG OLED 55 inch -> Televisions
(26, 5), -- Sony Bravia XR 55 inch -> Televisions
(27, 6), -- Fitbit Versa 3 -> Smart Watches
(28, 6), -- Garmin Forerunner 245 -> Smart Watches
(29, 1), -- ASUS ROG Zephyrus G14 -> Laptops
(30, 1); -- Microsoft Surface Laptop 4 -> Laptops
