-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2025 at 08:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medpoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `number` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `inventory_id`, `number`) VALUES
(60, 7, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Painkillers'),
(2, 'Antibiotics'),
(3, 'Vitamins'),
(4, 'Cough & Cold'),
(5, 'Digestive'),
(10, 'sumit');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL DEFAULT 'public/medicine.svg',
  `description` text NOT NULL,
  `seller_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `stock`, `product_id`, `image_url`, `description`, `seller_id`, `unit_price`) VALUES
(5, 0, 1, 'public/medicine.svg', 'para para paracitamol', 2, 20),
(6, 5, 5, 'public/medicine.svg', 'vitamin c very good for body', 3, 60),
(11, 2, 11, 'public/medicine.svg', 'sumit', 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_date`, `order_id`, `buyer_id`) VALUES
('2025-12-08 06:03:13', 50, 7),
('2025-12-08 06:12:53', 52, 7),
('2025-12-08 13:08:23', 53, 7),
('2025-12-08 14:52:11', 54, 7),
('2025-12-08 15:02:04', 55, 7),
('2025-12-08 15:02:18', 56, 7),
('2025-12-08 15:04:33', 57, 7),
('2025-12-08 15:11:32', 58, 7),
('2025-12-08 15:11:34', 59, 7),
('2025-12-08 15:12:15', 60, 7),
('2025-12-08 15:12:17', 61, 7),
('2025-12-08 15:12:19', 62, 7),
('2025-12-08 15:12:21', 63, 7),
('2025-12-08 15:12:24', 64, 7),
('2025-12-08 15:58:37', 65, 7),
('2025-12-08 15:58:40', 66, 7),
('2025-12-09 05:46:17', 67, 7),
('2025-12-09 14:33:13', 68, 7),
('2025-12-10 06:08:00', 69, 8),
('2025-12-12 13:05:09', 70, 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `seller_id`, `quantity`) VALUES
(64, 50, 1, 2, 3),
(68, 52, 1, 2, 5),
(69, 52, 5, 3, 3),
(70, 53, 1, 2, 11),
(71, 54, 5, 3, 4),
(72, 55, 5, 3, 6),
(73, 56, 5, 3, 3),
(74, 57, 5, 3, 3),
(75, 58, 5, 3, 1),
(76, 59, 5, 3, 1),
(77, 60, 5, 3, 1),
(78, 61, 5, 3, 1),
(79, 62, 5, 3, 1),
(80, 63, 5, 3, 1),
(81, 64, 5, 3, 1),
(82, 65, 5, 3, 1),
(83, 66, 5, 3, 1),
(84, 67, 5, 3, 3),
(85, 68, 1, 2, 4),
(86, 68, 5, 3, 4),
(87, 69, 5, 3, 5),
(88, 70, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category_id`) VALUES
(1, 'Paracetamol', 1),
(2, 'Ibuprofen', 1),
(3, 'Amoxicillin', 2),
(4, 'Azithromycin', 2),
(5, 'Vitamin C', 3),
(6, 'Vitamin D', 3),
(7, 'Cough Syrup', 4),
(8, 'Antacid', 5),
(11, 'sumit', 10);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(11) NOT NULL,
  `reg_id` text NOT NULL,
  `shop_name` text NOT NULL,
  `approval` tinyint(1) DEFAULT 0,
  `document_path` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `reg_id`, `shop_name`, `approval`, `document_path`, `user_id`) VALUES
(2, '1', 'shop1', 0, 'documents/shop1_regDoc.png', 8),
(3, '2', 'shop2', 0, 'documents/shop2_regDoc.png', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` text NOT NULL DEFAULT 'prefer not to say',
  `phone_number` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `province` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `gender`, `phone_number`, `address`, `city`, `province`) VALUES
(7, 'sumitpdl', '637534835cb265c5e844f6d2e76a79b0', 'goku chan', 'male', '9829234343', 'basantachowk, bharatpur-18', 'bharatpur', 'bagmati'),
(8, 'seller', '4a9980831f3ee5ebce8f2c57e78f620c', 'seller kumar', 'prefer not to say', '9811111111', NULL, NULL, NULL),
(9, 'seller2', '4d2ffec435594e97445570c068e180dc', 'sellerTwo kumar', 'prefer not to say', '9822222222', NULL, NULL, NULL),
(10, 'admin', '0e7517141fb53f21ee439b355b5a1d0a', 'admin kumar', 'prefer not to say', '9811111111', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_fk1` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`inventory_id`),
  ADD KEY `fk_inventory` (`inventory_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`seller_id`),
  ADD KEY `inventory_fk5` (`seller_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_fk4` (`buyer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_items_fk1` (`order_id`),
  ADD KEY `order_items_fk2` (`product_id`),
  ADD KEY `seller_id_fk3` (`seller_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_fk2` (`category_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`),
  ADD UNIQUE KEY `reg_id` (`reg_id`) USING HASH,
  ADD KEY `seller_fk5` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_inventory` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_fk1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `inventory_fk5` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk4` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_fk1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_fk2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `seller_id_fk3` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_fk2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_fk5` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
