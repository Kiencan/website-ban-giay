-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 11, 2025 lúc 05:10 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoes_shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner_name` varchar(20) NOT NULL,
  `banner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `banner_name`, `banner`) VALUES
(1, 'banner_duoi', 'baner-1a.png'),
(2, 'banner_tren', 'hero-img-1a.png'),
(3, 'banner_tren', 'hero-img-2a.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `p_id` varchar(50) DEFAULT NULL,
  `p_size` decimal(3,1) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `p_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(9, 'Giày Nike'),
(10, 'Giày Adidas'),
(11, 'Giày New Balance'),
(15, 'Bán chạy'),
(16, 'Giảm giá'),
(17, 'Giày Puma'),
(18, 'Giày Lining'),
(19, 'Giày Anta'),
(20, 'Quần áo'),
(21, 'Phụ kiện'),
(22, 'Sandal');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `collection`
--

CREATE TABLE `collection` (
  `collection_id` int(10) NOT NULL,
  `collection_name` varchar(50) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `collection`
--

INSERT INTO `collection` (`collection_id`, `collection_name`, `category_id`) VALUES
(8, 'Nike Dunk', 9),
(9, 'Nike SB', 9),
(10, 'Jordan 1 Low', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `p_id` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_time` datetime DEFAULT current_timestamp(),
  `comment_content` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `total` int(13) DEFAULT NULL,
  `order_status` int(1) DEFAULT NULL,
  `order_create_at` date NOT NULL DEFAULT current_timestamp(),
  `payment_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `p_id` varchar(50) NOT NULL,
  `p_name_custom` varchar(100) DEFAULT NULL,
  `p_name_id` int(10) DEFAULT NULL,
  `p_color` varchar(20) DEFAULT NULL,
  `p_rate` int(1) DEFAULT NULL,
  `p_description` varchar(2000) DEFAULT NULL,
  `p_price_min` int(11) DEFAULT NULL,
  `p_price_max` int(11) DEFAULT NULL,
  `size_available` varchar(50) DEFAULT NULL,
  `size_not_available` varchar(50) DEFAULT NULL,
  `isBestSelling` int(1) DEFAULT 0,
  `discount` int(3) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`p_id`, `p_name_custom`, `p_name_id`, `p_color`, `p_rate`, `p_description`, `p_price_min`, `p_price_max`, `size_available`, `size_not_available`, `isBestSelling`, `discount`, `create_at`, `update_at`) VALUES
('DD1391-100', 'Nike Dunk Low Panda Black White', 182949038, 'Panda Black White', 5, 'Nike Dunk Low - Cổ điển vượt thời gian, phong cách bất tận&#34;&#13;&#10;&#13;&#10;Nike Dunk Low là một biểu tượng của văn hóa sneaker, mang đến vẻ đẹp vượt thời gian. Đôi giày sở hữu thiết kế đơn giản nhưng không kém phần tinh tế với gam màu trắng đen tương phản, tạo nên sự hài hòa và sang trọng. Chất liệu da cao cấp mang đến cảm giác êm ái, thoải mái và tăng thêm độ bền cho sản phẩm. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu trắng nổi bật trên nền đen, tạo điểm nhấn ấn tượng.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu đơn giản: Sự kết hợp giữa trắng và đen tạo nên vẻ đẹp tinh tế, dễ phối đồ.&#13;&#10;Logo Swoosh đặc trưng: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Nike Dunk Low - sự lựa chọn hoàn hảo cho những ai yêu thích phong cách cổ điển và muốn thể hiện sự tinh tế trong từng bước đi.', 2350000, 3155000, '38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45', '', 1, 10, '2025-01-10 16:53:27', NULL),
('DD1503-118', NULL, 182949038, 'Rose Whisper Women', 5, '&#34;Nike Dunk Low Rose Whisper Women&#39;s - Hồng hào ngọt ngào, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Nike Dunk Low Rose Whisper Women&#39;s với tông màu hồng phấn ngọt ngào sẽ khiến trái tim bạn tan chảy. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu hồng phấn chủ đạo kết hợp cùng màu trắng tinh khôi tạo nên một tổng thể hài hòa, nữ tính. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu trắng, tạo điểm nhấn tinh tế. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu hồng phấn ngọt ngào: Tông màu nữ tính, trẻ trung, phù hợp với nhiều outfit.&#13;&#10;Logo Swoosh tinh tế: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Nike Dunk Low Rose Whisper Women&#39;s màu hồng phấn - là sự lựa chọn hoàn hảo cho những cô nàng yêu thích phong cách thời trang nhẹ nhàng, nữ tính và muốn thể hiện cá tính riêng.', 1990000, 3350000, '36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, 42, 42', '', 1, 5, '2025-01-10 17:00:29', NULL),
('DZ2768-651', NULL, 87417065, 'Pastel Purple Women&', 5, '&#34;JORDAN 1 Low Pastel Purple Women&#39;s - Ước mơ ngọt ngào trên đôi chân&#34;&#13;&#10;&#13;&#10;JORDAN 1 Low Pastel Purple Women&#39;s là một tác phẩm nghệ thuật dành cho những tín đồ sneaker yêu thích sự nhẹ nhàng, ngọt ngào. Đôi giày sở hữu thiết kế cổ điển với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu pastel tím, hồng và trắng tạo nên một bức tranh tuyệt đẹp, vừa nữ tính lại vừa hiện đại. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu trắng, tạo điểm nhấn tinh tế. Đế giày màu kem cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu pastel ngọt ngào: Sự kết hợp hài hòa giữa tím, hồng và trắng tạo nên vẻ đẹp mơ màng.&#13;&#10;Logo Swoosh tinh tế: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;JORDAN 1 Low Pastel Purple Women&#39;s&#13;&#10; - là sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách thời trang nhẹ nhàng, nữ tính và không kém phần cá tính.', 1990000, 2350000, '36,36.5,37.5,38,38.5,39,40,40.5,41,42,42.5', '', 1, 50, '2025-01-10 17:10:44', NULL),
('FQ7637-001', NULL, 318090249, 'Light Smoke Burgundy', 4, 'Nike Sb Force 58 &#39;Light Smoke Burgundy&#39; - Phong cách đường phố, cá tính nổi bật&#34;&#13;&#10;&#13;&#10;Nike Sb Force 58 &#39;Light Smoke Burgundy là một lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao, năng động. Đôi giày sở hữu thiết kế hiện đại với gam màu xám chủ đạo, kết hợp cùng các chi tiết đỏ đô tạo nên sự tương phản ấn tượng. Chất liệu da lộn cao cấp và vải lưới thoáng khí mang đến cảm giác thoải mái, êm ái khi vận động. Đế giày được thiết kế với các rãnh sâu, tăng độ bám, giúp bạn tự tin di chuyển trên mọi địa hình.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế trẻ trung: Kiểu dáng thể thao, năng động, phù hợp với nhiều phong cách thời trang.&#13;&#10;Chất liệu cao cấp: Da lộn và vải lưới mang đến cảm giác thoải mái và bền bỉ.&#13;&#10;Phối màu ấn tượng: Sự kết hợp giữa xám và đỏ tạo nên vẻ ngoài cá tính, nổi bật.&#13;&#10;Đế giày bền bỉ: Đế giày được thiết kế với các rãnh sâu, tăng độ bám, giúp bạn di chuyển an toàn.&#13;&#10;Nike Sb Force 58 &#39;Light Smoke Burgund  - sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách đường phố và luôn năng động.', 1720000, 1890000, '38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45', '', 0, 20, '2025-01-10 17:07:18', NULL),
('HJ9093-030', NULL, 182949038, 'Light Iron Ore Gym R', 5, '&#34;Nike Dunk Low Light Iron Ore Gym Red - Vẻ đẹp cổ điển, điểm nhấn cá tính&#34;&#13;&#10;&#13;&#10;Nike Dunk Low Light Iron Ore Gym Red là một biểu tượng của văn hóa sneaker, mang đến vẻ đẹp vượt thời gian. Đôi giày sở hữu thiết kế đơn giản nhưng không kém phần tinh tế với gam màu trắng xám chủ đạo, kết hợp cùng các chi tiết đỏ nổi bật tạo nên sự tương phản ấn tượng. Chất liệu da cao cấp mang đến cảm giác êm ái, thoải mái và tăng thêm độ bền cho sản phẩm. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đỏ tươi, tạo điểm nhấn nổi bật.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu độc đáo: Sự kết hợp giữa trắng xám và đỏ tạo nên vẻ đẹp cổ điển nhưng không kém phần hiện đại.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Nike Dunk Low Light Iron Ore Gym Red - là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thời trang đơn giản nhưng không kém phần cá tính. Đôi giày sẽ giúp bạn nổi bật giữa đám đông mà vẫn giữ được sự tinh tế.', 1990000, 2050000, '38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45', '', 1, 10, '2025-01-10 16:57:01', NULL),
('HM3711-144', NULL, 87417065, 'Armory Navy', 5, 'Air Jordan 1 Low SE &#34;Armory Navy&#34; - Bước đi trên biển, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Air Jordan 1 Low SE &#34;Armory Navy phiên bản này mang đến một làn gió mới mẻ với sự kết hợp hài hòa giữa màu xanh dương tươi mát, trắng tinh khôi và những điểm nhấn màu cam đất. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu xanh dương chủ đạo gợi lên hình ảnh bầu trời và đại dương, tạo nên vẻ ngoài tươi trẻ và năng động, trong khi đó, màu trắng và cam tạo điểm nhấn nổi bật. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đen, tạo sự tương phản ấn tượng. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu độc đáo: Sự kết hợp giữa xanh dương, trắng và cam tạo nên vẻ đẹp tươi trẻ, năng động.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Air Jordan 1 Low SE &#34;Armory Navy&#34; phiên bản này là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao, năng động và muốn thể hiện sự cá tính riêng.', 2210000, 2250000, '37.5, 38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44', '', 0, 50, '2025-01-10 17:13:45', NULL),
('HQ3437-101', NULL, 87417065, 'SE COCONUT MILK/BLAC', 5, 'Jordan Air Jordan 1 LOW SE “COCONUT MILK/BLACK - Kiệt tác thời trang, đẳng cấp vượt thời gian&#34;&#13;&#10;&#13;&#10;Jordan Air Jordan 1 LOW SE “COCONUT MILK/BLACK phiên bản này mang đến một làn gió mới với sự kết hợp tinh tế giữa màu kem, đen và xanh nhạt. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp và da rắn độc đáo, tạo nên vẻ ngoài sang trọng và đẳng cấp. Gam màu kem chủ đạo mang đến cảm giác nhẹ nhàng, tinh tế, trong khi đó, màu đen và xanh nhạt tạo điểm nhấn nổi bật. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đen, tạo sự tương phản ấn tượng. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật và da rắn mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu độc đáo: Sự kết hợp giữa kem, đen và xanh nhạt tạo nên vẻ đẹp thời thượng.&#13;&#10;Chi tiết da rắn: Tăng thêm vẻ đẹp độc đáo và cá tính cho đôi giày.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Jordan Air Jordan 1 LOW SE “COCONUT MILK/BLACK phiên bản này là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thời trang cao cấp, muốn thể hiện sự đẳng cấp và khác biệt.', 2590000, 2690000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 1, 50, '2025-01-11 10:50:27', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `p_id` varchar(50) DEFAULT NULL,
  `product_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`image_id`, `p_id`, `product_image`) VALUES
(65, 'DD1391-100', 'DD1391-100_1.jpg'),
(66, 'DD1391-100', 'DD1391-100_2.jpg'),
(67, 'DD1391-100', 'DD1391-100_3.jpg'),
(68, 'DD1391-100', 'DD1391-100_4.jpg'),
(69, 'DD1391-100', 'DD1391-100_5.jpg'),
(70, 'DD1503-118', 'DD1503-118_02.jpg'),
(71, 'DD1503-118', 'DD1503-118_01.jpg'),
(72, 'DD1503-118', 'DD1503-118_03.jpg'),
(73, 'DD1503-118', 'DD1503-118_04.jpg'),
(74, 'DZ2768-651', 'DZ2768-651_02.jpg'),
(75, 'DZ2768-651', 'DZ2768-651_01.jpg'),
(76, 'DZ2768-651', 'DZ2768-651_03.jpg'),
(77, 'DZ2768-651', 'DZ2768-651_05.jpg'),
(78, 'DZ2768-651', 'DZ2768-651_04.jpg'),
(79, 'HM3711-144', 'HM3711-144_02.jpg'),
(80, 'HM3711-144', 'HM3711-144_01.jpg'),
(81, 'HM3711-144', 'HM3711-144_03.jpg'),
(82, 'HM3711-144', 'HM3711-144_04.jpg'),
(83, 'HM3711-144', 'HM3711-144_05.jpg'),
(84, 'FQ7637-001', 'FQ7637-001_02.jpg'),
(85, 'FQ7637-001', 'FQ7637-001_01.jpg'),
(86, 'FQ7637-001', 'FQ7637-001_03.jpg'),
(87, 'FQ7637-001', 'FQ7637-001_04.jpg'),
(88, 'FQ7637-001', 'FQ7637-001_05.jpg'),
(89, 'HJ9093-030', 'HJ9093-030_1.jpg'),
(90, 'HJ9093-030', 'HJ9093-030_2.jpg'),
(91, 'HJ9093-030', 'HJ9093-030_3.jpg'),
(92, 'HJ9093-030', 'HJ9093-030_4.jpg'),
(93, 'HJ9093-030', 'HJ9093-030_5.jpg'),
(94, 'HQ3437-101', 'HQ3437-101_01.jpg'),
(95, 'HQ3437-101', 'HQ3437-101_02.jpg'),
(96, 'HQ3437-101', 'HQ3437-101_03.jpg'),
(97, 'HQ3437-101', 'HQ3437-101_04.jpg'),
(98, 'HQ3437-101', 'HQ3437-101_05.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_name`
--

CREATE TABLE `product_name` (
  `p_name_id` int(10) NOT NULL,
  `p_name` varchar(50) DEFAULT NULL,
  `collection_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_name`
--

INSERT INTO `product_name` (`p_name_id`, `p_name`, `collection_id`) VALUES
(87417065, 'Jordan 1 Low', 10),
(182949038, 'Nike Dunk Low ', 8),
(318090249, 'Force 58 ', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `token_login`
--

CREATE TABLE `token_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `last_active` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `forgotToken` varchar(100) DEFAULT NULL,
  `activeToken` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fullname`, `address`, `phone`, `email`, `forgotToken`, `activeToken`, `status`, `isAdmin`, `create_at`, `update_at`) VALUES
(9, 'thuycute1412', '12345678', 'Phạm Thu Thủy', NULL, '0353693404', 'letrungkien6_t66@hus.edu.vn', NULL, NULL, 1, 0, '2024-11-16 14:30:51', '2024-12-11 10:27:19'),
(12, 'thuyoi', '1234567890', 'Lê Trung Kiên đẹp trai', NULL, '0353693404', 'letrungkien1_t66@hus.edu.vn', NULL, NULL, 1, 0, '2024-11-15 09:56:01', NULL),
(13, 'kiendz1234', '123456789', 'Lê Trung Kiên', NULL, '0353693404', 'kienbestdaxua@gmail.com', NULL, NULL, 1, 1, '2024-10-27 22:28:09', '2024-11-10 13:46:14'),
(14, 'kiendz12', '123456789', 'Lê Trung Kiên', NULL, '0353693404', 'letrungkien2_t66@hus.edu.vn', NULL, NULL, 1, 1, '2024-11-15 11:26:09', NULL),
(15, 'kiendz1', '123456789', 'Lê Trung Kiên 123', NULL, '0353693404', 'letrungkien3_t66@hus.edu.vn', NULL, NULL, 1, 0, '2024-11-16 00:56:55', NULL),
(16, 'kiendz123', '123456789', 'Lê Trung', NULL, '0123456789', 'letrungkien9_t66@hus.edu.vn', NULL, NULL, 1, 1, '2024-12-11 10:30:07', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`user_id`),
  ADD KEY `product_id` (`p_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`collection_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `customer_id` (`user_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_ibfk_1` (`cart_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `p_name_id` (`p_name_id`);

--
-- Chỉ mục cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`p_id`);

--
-- Chỉ mục cho bảng `product_name`
--
ALTER TABLE `product_name`
  ADD PRIMARY KEY (`p_name_id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- Chỉ mục cho bảng `token_login`
--
ALTER TABLE `token_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT cho bảng `product_name`
--
ALTER TABLE `product_name`
  MODIFY `p_name_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=862294064;

--
-- AUTO_INCREMENT cho bảng `token_login`
--
ALTER TABLE `token_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);

--
-- Các ràng buộc cho bảng `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`p_name_id`) REFERENCES `product_name` (`p_name_id`);

--
-- Các ràng buộc cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);

--
-- Các ràng buộc cho bảng `product_name`
--
ALTER TABLE `product_name`
  ADD CONSTRAINT `product_name_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`collection_id`);

--
-- Các ràng buộc cho bảng `token_login`
--
ALTER TABLE `token_login`
  ADD CONSTRAINT `token_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
