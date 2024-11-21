-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 03:53 AM
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
-- Database: `shoes_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner_name` varchar(20) NOT NULL,
  `banner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `banner_name`, `banner`) VALUES
(1, 'banner_duoi', 'baner-1a.png'),
(2, 'banner_tren', 'hero-img-1a.png'),
(3, 'banner_tren', 'hero-img-2a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Iphone'),
(2, 'Samsung'),
(6, 'Giày'),
(7, 'Giày 123'),
(8, 'Sneaker');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `p_id` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `comment_time` datetime DEFAULT current_timestamp(),
  `comment_content` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `p_id`, `customer_id`, `comment_time`, `comment_content`) VALUES
(3, '29', 13, '2024-11-16 21:48:45', 'Sản phẩm rất tệ'),
(5, '30', 12, '2024-11-16 21:49:27', 'Mua về là vứt');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `forgotToken` varchar(100) DEFAULT NULL,
  `activeToken` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `admin` int(11) NOT NULL DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `fullname`, `address`, `phone`, `email`, `forgotToken`, `activeToken`, `status`, `admin`, `create_at`, `update_at`) VALUES
(9, 'thuycute1412', '12345678', 'Phạm Thu Thủy', NULL, '0353693404', 'letrungkien6_t66@hus.edu.vn', NULL, NULL, 1, 0, '2024-11-16 14:30:51', NULL),
(11, '12345', '123456789', 'Kiên', NULL, '0353693404', 'letrungkien9_t66@hus.edu.vn', NULL, NULL, 0, 0, '2024-11-16 01:02:56', NULL),
(12, 'thuyoi', '1234567890', 'Lê Trung Kiên đẹp trai', NULL, '0353693404', 'letrungkien1_t66@hus.edu.vn', NULL, NULL, 1, 0, '2024-11-15 09:56:01', NULL),
(13, 'kiendz1234', '123456789', 'Lê Trung Kiên', NULL, '0353693404', 'kienbestdaxua@gmail.com', NULL, NULL, 1, 1, '2024-10-27 22:28:09', '2024-11-10 13:46:14'),
(14, 'kiendz12', '123456789', 'Lê Trung Kiên', NULL, '0353693404', 'letrungkien2_t66@hus.edu.vn', NULL, NULL, 1, 1, '2024-11-15 11:26:09', NULL),
(15, 'kiendz1', '123456789', 'Lê Trung Kiên 123', NULL, '0353693404', 'letrungkien3_t66@hus.edu.vn', NULL, NULL, 1, 0, '2024-11-16 00:56:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_id`, `customer_id`, `product_id`, `product_type_id`, `order_quantity`, `order_status`) VALUES
(1, 15, '29', NULL, NULL, 1),
(2, 9, '35', NULL, NULL, 1),
(3, 15, '30', NULL, NULL, 1),
(5, 11, 'ES1111', 2, 3, 0),
(6, 14, 'ES1111', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` varchar(50) NOT NULL,
  `p_name` varchar(50) DEFAULT NULL,
  `p_description` varchar(2000) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `p_description`, `category_id`, `create_at`, `update_at`) VALUES
('29', 'Iphone 13 Pro Max', 'sdfsdafsadfsadfdsafdas', 1, '2024-11-16 14:47:48', '2024-11-16 14:59:10'),
('30', 'Samsung Galaxy Z Flip 5', 'ssdfasdfsdafdsaf', 2, '2024-11-15 18:58:41', '2024-11-16 14:55:11'),
('35', 'Iphone 16 Pro Max', 'Sản phẩm rất tốt', 1, '2024-11-16 14:46:13', NULL),
('36', 'Samsung Galaxy Z Fold 6', 'Sản phẩm của Trung Quốc', 2, '2024-11-17 00:16:10', NULL),
('39', 'Samsung Galaxy S24 Ultra', 'Hàng limitted', 2, '2024-11-17 11:26:37', '2024-11-17 23:17:57'),
('ES1111', 'Giày Nike E-Series', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.\r\n\r\nPhần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(20) DEFAULT NULL,
  `rate` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`color_id`, `color_name`, `rate`) VALUES
(1, 'hong', 4),
(2, 'den', 5),
(3, 'trang', 4),
(4, 'vang', 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `product_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `color_id`, `product_image`) VALUES
(1, 1, 'giayhong1.jpg'),
(2, 1, 'giayhong2.jpg'),
(3, 1, 'giayhong3.jpg'),
(4, 1, 'giayhong4.jpg'),
(5, 2, 'giayden1.jpg'),
(6, 2, 'giayden2.jpg'),
(7, 2, 'giayden3.jpg'),
(8, 2, 'giayden4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `size_id` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `product_id`, `color_id`) VALUES
(1, 'ES1111', NULL),
(2, 'ES1111', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `token_login`
--

CREATE TABLE `token_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `last_active` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_ibfk_1` (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`size_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `token_login`
--
ALTER TABLE `token_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `token_login`
--
ALTER TABLE `token_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`p_id`),
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `order_item` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`color_id`) REFERENCES `product_color` (`color_id`);

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`color_id`) REFERENCES `product_color` (`color_id`);

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `product_type_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`p_id`),
  ADD CONSTRAINT `product_type_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `product_color` (`color_id`);

--
-- Constraints for table `token_login`
--
ALTER TABLE `token_login`
  ADD CONSTRAINT `token_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
