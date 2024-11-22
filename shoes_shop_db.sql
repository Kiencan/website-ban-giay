-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 06:08 AM
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

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_id`, `customer_id`, `product_id`, `order_quantity`, `order_status`) VALUES
(5, 11, 'ES1111', 3, 0),
(6, 14, 'ES1112', 2, 0);

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
('ADSL-D1', 'Giày Adidas Duramo SL Màu đen', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 10, '2024-11-22 10:12:30', NULL),
('ADSL-T132', 'Giày Adidas Duramo SL Màu trắng', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 10, '2024-11-22 10:25:36', NULL),
('ADSL-XD3463', 'Giày Adidas Duramo SL Màu xanh dương', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 10, '2024-11-22 10:27:20', NULL),
('ES1111', 'Giày Nike E-Series Màu hồng', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.\n\nPhần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 9, '2024-11-22 10:11:55', NULL),
('ES1112', 'Giày Nike E-Series màu đen', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.\n\nPhần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 9, '2024-11-22 10:11:56', NULL),
('NCL2-C1', 'Giày Nike Court Low 2 Màu cam', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 9, '2024-11-22 10:11:57', NULL),
('NCL2-H1', 'Giày Nike Court Low 2 Màu hồng', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 9, '2024-11-22 10:11:58', NULL),
('NCL2-X1', 'Giày Nike Court Low 2 Màu xanh', 'Giày Nike E-Series 1.0 mẫu giày thời trang được Nike vừa ra mắt. Với thiết kế đơn giản nhưng sang trọng và có tính ứng dụng rất cao trong mọi hoạt động hàng ngày. Đây là mẫu giày hứa hẹn sẽ làm mưa làm gió của Nike trong năm nay.&#13;&#10;&#13;&#10;Phần upper được làm từ chất liệu chất liệu đặc biệt có mềm êm thoáng khí, phần đế giữa chất liệu froam êm ái, đế ngoài chất liệu cao su bền chắc. Một mẫu giày hột tụ đủ các yếu tố cao cấp từ chất liệu, công nghệ và thiết kế.', 9, '2024-11-22 10:11:59', NULL);

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
(1, 'ES1111', 'giayhong1.jpg'),
(2, 'ES1111', 'giayhong2.jpg'),
(3, 'ES1111', 'giayhong3.jpg'),
(4, 'ES1111', 'giayhong4.jpg'),
(5, 'ES1112', 'giayden1.jpg'),
(6, 'ES1112', 'giayden2.jpg'),
(7, 'ES1112', 'giayden3.jpg'),
(8, 'ES1112', 'giayden4.jpg'),
(14, 'NCL2-H1', 'NCL2_hong1.jpg'),
(15, 'NCL2-H1', 'NCL2_hong2.jpg'),
(16, 'NCL2-H1', 'NCL2_hong3.jpg'),
(17, 'NCL2-H1', 'NCL2_hong4.jpg'),
(18, 'NCL2-H1', 'NCL2_hong5.jpg'),
(19, 'NCL2-X1', 'NCL2_xanh1.jpg'),
(20, 'NCL2-X1', 'NCL2_xanh2.jpg'),
(21, 'NCL2-X1', 'NCL2_xanh3.jpg'),
(22, 'NCL2-X1', 'NCL2_xanh4.jpg'),
(23, 'NCL2-X1', 'NCL2_xanh5.jpg'),
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
(43, 'ADSL-XD3463', 'ADSLxanh5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `size_id` int(11) NOT NULL,
  `size` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`size_id`, `size`, `quantity`, `price`, `product_id`) VALUES
(2, 37, 37, 3700000, 'ES1111'),
(3, 38, 38, 3800000, 'ES1111'),
(4, 39, 39, 3900000, 'ES1111'),
(5, 40, 40, 4000000, 'ES1111'),
(6, 41, 41, 4100000, 'ES1111'),
(7, 42, 42, 4200000, 'ES1111'),
(8, 43, 43, 4300000, 'ES1111'),
(9, 44, 44, 4400000, 'ES1111'),
(10, 45, 45, 4500000, 'ES1111'),
(11, 36, 26, 2600000, 'ES1112'),
(12, 37, 27, 2700000, 'ES1112'),
(13, 38, 28, 2800000, 'ES1112'),
(14, 39, 29, 2900000, 'ES1112'),
(15, 40, 30, 3000000, 'ES1112'),
(16, 41, 31, 3100000, 'ES1112'),
(17, 42, 32, 3200000, 'ES1112'),
(18, 43, 33, 3300000, 'ES1112'),
(19, 44, 34, 3400000, 'ES1112'),
(20, 45, 35, 3500000, 'ES1112'),
(34, 36, 40, 3600000, 'ES1111'),
(36, 36, 100, 1400000, 'NCL2-H1'),
(37, 37, 100, 1400000, 'NCL2-H1'),
(38, 38, 100, 1400000, 'NCL2-H1'),
(39, 40, 100, 1200000, 'NCL2-H1'),
(40, 41, 100, 1200000, 'NCL2-H1'),
(41, 41.5, 100, 1200000, 'NCL2-H1'),
(42, 42.5, 100, 1200000, 'NCL2-H1'),
(43, 35, 100, 1480000, 'NCL2-X1'),
(44, 36, 100, 1800000, 'NCL2-X1'),
(45, 37.5, 100, 1800000, 'NCL2-X1'),
(46, 38, 100, 1800000, 'NCL2-X1'),
(47, 40, 100, 1800000, 'NCL2-X1'),
(48, 41, 100, 2000000, 'NCL2-X1'),
(49, 41.5, 100, 2000000, 'NCL2-X1'),
(50, 42, 100, 2000000, 'NCL2-X1'),
(51, 36, 100, 1400000, 'NCL2-C1'),
(52, 37, 100, 1400000, 'NCL2-C1'),
(53, 38, 100, 1400000, 'NCL2-C1'),
(54, 40, 100, 1200000, 'NCL2-C1'),
(55, 41, 100, 1200000, 'NCL2-C1'),
(56, 41.5, 100, 1200000, 'NCL2-C1'),
(57, 42.5, 100, 1200000, 'NCL2-C1'),
(58, 38, 100, 1555000, 'ADSL-D1'),
(59, 39, 100, 1555000, 'ADSL-D1'),
(60, 40, 100, 1555000, 'ADSL-D1'),
(61, 41, 100, 1555000, 'ADSL-D1'),
(62, 42, 100, 1900000, 'ADSL-D1'),
(63, 40, 100, 4200000, 'ADSL-T132'),
(64, 41, 100, 4200000, 'ADSL-T132'),
(65, 38, 100, 1765000, 'ADSL-XD3463'),
(66, 39, 100, 1765000, 'ADSL-XD3463'),
(67, 40, 100, 1765000, 'ADSL-XD3463'),
(68, 41, 100, 1876000, 'ADSL-XD3463'),
(69, 42, 100, 1876000, 'ADSL-XD3463'),
(70, 43, 100, 1876000, 'ADSL-XD3463'),
(71, 44.5, 100, 1876000, 'ADSL-XD3463');

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
-- Dumping data for table `token_login`
--

INSERT INTO `token_login` (`id`, `user_id`, `token`, `create_at`, `last_active`) VALUES
(55, 13, 'd2280de2cd60d61ceb942bb9a89efef6041c2e9e', '2024-11-21 09:55:56', NULL);

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
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`size_id`),
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
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `token_login`
--
ALTER TABLE `token_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`p_id`);

--
-- Constraints for table `token_login`
--
ALTER TABLE `token_login`
  ADD CONSTRAINT `token_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
