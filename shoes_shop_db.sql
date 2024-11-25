-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 12:33 PM
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
(9, 'Giày Nike'),
(10, 'Giày Adidas'),
(11, 'Giày New Balance');

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
  `order_quantity` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `p_price_min` int(11) DEFAULT NULL,
  `p_price_max` int(11) DEFAULT NULL,
  `size_available` varchar(50) DEFAULT NULL,
  `size_not_available` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `isBestSelling` int(1) DEFAULT 0,
  `isDiscount` int(1) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `p_description`, `p_price_min`, `p_price_max`, `size_available`, `size_not_available`, `category_id`, `isBestSelling`, `isDiscount`, `create_at`, `update_at`) VALUES
('ADSL-D1', 'Giày Adidas Duramo SL Màu đen', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 1200000, 1499000, '38, 39, 40, 41', '42', 10, 1, 1, '2024-11-22 10:12:30', NULL),
('ADSL-T132', 'Giày Adidas Duramo SL Màu trắng', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 1499000, 1800000, '40, 41', 'Không có', 10, 1, 1, '2024-11-22 10:25:36', NULL),
('ADSL-XD3463', 'Giày Adidas Duramo SL Màu xanh dương', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 1399000, 1500000, '38, 39, 40', '41, 42, 43, 44.5', 10, 0, 1, '2024-11-22 10:27:20', NULL),
('NCL2-C1', 'Giày Nike Court Low 2 Màu cam', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 2000000, 2500000, 'Không có', '40, 41,41.5, 42.5', 9, 0, 0, '2024-11-22 10:11:57', NULL),
('NCL2-H1', 'Giày Nike Court Low 2 Màu hồng', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 2000000, 2500000, '36, 37, 38', '40.5, 41, 42', 9, 0, 0, '2024-11-22 10:11:58', NULL),
('NCL2-X1', 'Giày Nike Court Low 2 Màu xanh', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 1400000, 1900000, '35, 36, 36.5, 28, 40', 'Không có', 9, 1, 0, '2024-11-24 14:43:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `product_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `product_id`, `product_image`) VALUES
(14, 'NCL2-H1', 'NCL2_hong1.jpg'),
(15, 'NCL2-H1', 'NCL2_hong2.jpg'),
(16, 'NCL2-H1', 'NCL2_hong3.jpg'),
(17, 'NCL2-H1', 'NCL2_hong4.jpg'),
(18, 'NCL2-H1', 'NCL2_hong5.jpg'),
(24, 'NCL2-C1', 'NCL2_cam1.jpg'),
(25, 'NCL2-C1', 'NCL2_cam2.jpg'),
(26, 'NCL2-C1', 'NCL2_cam3.jpg'),
(27, 'NCL2-C1', 'NCL2_cam4.jpg'),
(28, 'NCL2-C1', 'NCL2_cam5.jpg'),
(29, 'NCL2-C1', 'NCL2_cam6.jpg'),
(30, 'ADSL-D1', 'ADSLden1.jpg'),
(31, 'ADSL-D1', 'ADSLden2.jpg'),
(32, 'ADSL-D1', 'ADSLden3.jpg'),
(33, 'ADSL-D1', 'ADSLden4.jpg'),
(34, 'ADSL-T132', 'ADSLtrang1.jpg'),
(35, 'ADSL-T132', 'ADSLtrang2.jpg'),
(36, 'ADSL-T132', 'ADSLtrang3.jpg'),
(37, 'ADSL-T132', 'ADSLtrang4.jpg'),
(38, 'ADSL-T132', 'ADSLtrang5.jpg'),
(39, 'ADSL-XD3463', 'ADSLxanh1.jpg'),
(40, 'ADSL-XD3463', 'ADSLxanh2.jpg'),
(41, 'ADSL-XD3463', 'ADSLxanh3.jpg'),
(42, 'ADSL-XD3463', 'ADSLxanh4.jpg'),
(43, 'ADSL-XD3463', 'ADSLxanh5.jpg'),
(54, 'NCL2-X1', 'NCL2_xanh1.jpg'),
(55, 'NCL2-X1', 'NCL2_xanh2.jpg'),
(56, 'NCL2-X1', 'NCL2_xanh3.jpg'),
(62, 'NCL2-X1', 'NCL2_xanh4.jpg'),
(63, 'NCL2-X1', 'NCL2_xanh5.jpg');

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
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `token_login`
--
ALTER TABLE `token_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`p_id`);

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
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`p_id`);

--
-- Constraints for table `token_login`
--
ALTER TABLE `token_login`
  ADD CONSTRAINT `token_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
