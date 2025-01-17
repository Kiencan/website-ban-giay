-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 16, 2025 lúc 06:31 PM
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

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `p_id`, `p_size`, `total_price`, `p_quantity`) VALUES
(47, 17, 'DD1503-118', 37.5, 3980000, 2);

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
(22, 'Sandal'),
(23, 'Giày hãng khác');

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
(10, 'Jordan 1 Low', 9),
(11, 'Nike Air', 9),
(12, 'Nike Blazer', 9),
(13, 'Adidas Neo', 10),
(14, 'Adidas VL Court', 10),
(15, 'Adidas Spiritain', 10),
(16, 'Adidas Alphabounce', 10),
(17, 'Adidas EQ21', 10),
(18, 'Adidas EQ19', 10),
(19, 'Adidas Originals', 10),
(20, 'Adidas Ultrabounce', 10),
(21, 'Adidas Adizero', 10),
(22, 'Puma St Runner', 17),
(23, 'Puma Rebound', 17),
(26, 'Adidas Duramo', 10);

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

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`payment_id`, `user_id`, `cart_id`, `total`, `order_status`, `order_create_at`, `payment_type`) VALUES
(1, 13, NULL, 1818000, 1, '2025-01-12', 0),
(2, 13, NULL, 640000, 1, '2025-01-16', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `p_id` varchar(50) NOT NULL,
  `p_name_custom` varchar(100) DEFAULT NULL,
  `p_name_id` int(10) DEFAULT NULL,
  `p_color` varchar(50) DEFAULT NULL,
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
('368876-01', 'PUMA Rebound LayUp Low Black White Camo', 862294080, 'Black White', 5, '&#34;Puma Rebound Layup Lo - Cá tính nổi bật, phong cách không giới hạn&#34;&#13;&#10;&#13;&#10;Với thiết kế trẻ trung, năng động, Puma Rebound Layup Lo chắc chắn sẽ chinh phục trái tim của những tín đồ thời trang. Đôi giày sở hữu gam màu trắng đen tương phản mạnh mẽ, tạo nên điểm nhấn ấn tượng. Phần upper bằng da cao cấp kết hợp với họa tiết độc đáo mang đến vẻ ngoài thời thượng và cá tính. Đế giày bằng cao su bền bỉ, tạo độ bám tốt, giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế độc đáo: Họa tiết độc đáo trên thân giày tạo nên điểm nhấn ấn tượng, giúp bạn nổi bật giữa đám đông.&#13;&#10;Phối màu ấn tượng: Sự kết hợp hoàn hảo giữa trắng và đen mang đến vẻ ngoài trẻ trung, năng động.&#13;&#10;Chất liệu cao cấp: Da thật cao cấp đảm bảo độ bền và thoải mái khi sử dụng.&#13;&#10;Puma Rebound Layup Lo - sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách riêng và luôn bắt kịp xu hướng thời trang.&#34;', 1320000, 1500000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 50, '2025-01-12 14:18:59', NULL),
('384857-01', 'Puma ST Runner V3 NL Black White', 862294079, 'Black White', 5, '&#34;Puma St Runner - Bước chân tự tin, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Puma St Runner là một lựa chọn hoàn hảo cho những ai yêu thích sự đơn giản nhưng không kém phần thời trang. Đôi giày sở hữu gam màu xanh navy chủ đạo, kết hợp cùng các chi tiết màu trắng tạo nên vẻ ngoài thanh lịch và nam tính. Chất liệu da cao cấp không chỉ mang đến cảm giác êm ái, thoải mái mà còn tăng thêm độ bền cho sản phẩm. Đế giày bằng cao su chắc chắn, tạo độ bám tốt, giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều hoàn cảnh.&#13;&#10;Chất liệu cao cấp: Da thật cao cấp đảm bảo độ bền và thoải mái khi sử dụng.&#13;&#10;Phối màu đơn giản: Sự kết hợp giữa xanh navy và trắng tạo nên vẻ ngoài thanh lịch, dễ phối đồ.&#13;&#10;Puma St Runner - sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách lịch lãm và trẻ trung.', 1350000, 1550000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 60, '2025-01-12 14:13:45', NULL),
('384857-02', 'PUMA St Runner V3 Parisian Night', 862294079, 'Parisian Night', 5, '&#34;Puma St Runner - Bước chân tự tin, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Puma St Runner là một lựa chọn hoàn hảo cho những ai yêu thích sự đơn giản nhưng không kém phần thời trang. Đôi giày sở hữu gam màu xanh navy chủ đạo, kết hợp cùng các chi tiết màu trắng tạo nên vẻ ngoài thanh lịch và nam tính. Chất liệu da cao cấp không chỉ mang đến cảm giác êm ái, thoải mái mà còn tăng thêm độ bền cho sản phẩm. Đế giày bằng cao su chắc chắn, tạo độ bám tốt, giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều hoàn cảnh.&#13;&#10;Chất liệu cao cấp: Da thật cao cấp đảm bảo độ bền và thoải mái khi sử dụng.&#13;&#10;Phối màu đơn giản: Sự kết hợp giữa xanh navy và trắng tạo nên vẻ ngoài thanh lịch, dễ phối đồ.&#13;&#10;Puma St Runner - sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách lịch lãm và trẻ trung.', 1290000, 1550000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 50, '2025-01-12 14:11:19', NULL),
('392328-09', 'PUMA Rebound V6 Low Oatmeal Grey', 862294081, 'White/Oatmeal/Grey', 5, '&#34;Giày Puma Rebound V6 Low - Sự kết hợp hoàn hảo giữa phong cách cổ điển và hiện đại&#13;&#10;&#13;&#10;Với thiết kế đơn giản nhưng không kém phần tinh tế, Puma Rebound V6 Low sẽ khiến bạn yêu từ cái nhìn đầu tiên. Đôi giày sở hữu gam màu trắng kem chủ đạo, kết hợp cùng các chi tiết màu xám nhạt tạo nên vẻ ngoài thanh lịch và dễ phối đồ. Chất liệu da cao cấp không chỉ mang đến cảm giác êm ái, thoải mái mà còn tăng thêm độ bền cho sản phẩm. Đế giày bằng cao su chắc chắn, tạo độ bám tốt, giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Phong cách đa năng: Dễ dàng kết hợp với nhiều trang phục khác nhau, từ quần jeans, quần jogger cho đến shorts, tạo nên phong cách thời trang đa dạng.&#13;&#10;Chất lượng vượt trội: Đế giày được làm từ cao su cao cấp, đảm bảo độ bền và thoải mái khi di chuyển.&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều hoàn cảnh.&#13;&#10;Puma Rebound V6 Low - sự lựa chọn hoàn hảo cho những ai yêu thích sự đơn giản, tinh tế và thoải mái.&#34;', 1250000, 1390000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 50, '2025-01-12 14:21:54', NULL),
('553558-141', 'Jordan1 Low Wolf Grey Midnight Navy', 87417065, 'Wolf Grey Midnight Navy', 5, 'JORDAN 1 Low Wolf Grey Midnight Navy - Biển cả sâu thẳm, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;JORDAN 1 Low Wolf Grey Midnight Navy phiên bản này mang đến một hơi thở mới mẻ với sự kết hợp hài hòa giữa màu xanh navy đậm, trắng tinh khôi và xám bạc. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu xanh navy chủ đạo gợi lên hình ảnh biển cả sâu thẳm, tạo nên vẻ ngoài bí ẩn và cuốn hút, trong khi đó, màu trắng và xám tạo điểm nhấn tinh tế. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu xám bạc, tạo sự tương phản ấn tượng. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu độc đáo: Sự kết hợp giữa xanh navy, trắng và xám tạo nên vẻ đẹp thời thượng.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;JORDAN 1 Low Wolf Grey Midnight Navy phiên bản này là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thời trang đơn giản, tinh tế và muốn thể hiện sự cá tính riêng.', 1890000, 2450000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 30, '2025-01-11 11:15:30', NULL),
('553558-152', 'Jordan 1 Low Iron Grey', 87417065, 'Iron Grey', 5, 'Jordan 1 Low Iron Grey - Đơn giản mà thời thượng&#34;&#13;&#10;&#13;&#10;Jordan 1 Low Iron Grey phiên bản này mang đến một hơi thở mới với sự kết hợp tinh tế giữa màu trắng, xám và đen. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu xám chủ đạo tạo nên vẻ ngoài trầm ổn, lịch lãm, trong khi đó, các chi tiết màu trắng và đen tạo điểm nhấn nổi bật. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đen, tạo sự tương phản ấn tượng. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu đơn giản nhưng tinh tế: Sự kết hợp giữa trắng, xám và đen tạo nên vẻ đẹp thời thượng.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Jordan 1 Low Iron Grey phiên bản này là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách đơn giản, thanh lịch và muốn thể hiện sự tinh tế trong từng bước đi.', 1790000, 2290000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 50, '2025-01-12 12:20:43', NULL),
('553558-161', 'Jordan 1 Low Bred Toe 2.0', 87417065, 'Bred Toe 2.0', 5, '&#34;Jordan 1 Low Bred Toe 2.0 - Biểu tượng bất hủ, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Jordan 1 Low Bred Toe 2.0 phiên bản này mang đến một hơi thở mới với sự kết hợp kinh điển giữa màu đỏ, trắng và đen. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu đỏ nổi bật tạo nên điểm nhấn ấn tượng, trong khi đó, màu trắng và đen tạo nên sự cân bằng hài hòa. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đen, tạo sự tương phản mạnh mẽ. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu kinh điển: Sự kết hợp giữa đỏ, trắng và đen tạo nên vẻ đẹp bất hủ.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Jordan 1 Low Bred Toe 2.0 phiên bản này là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao, cá tính và muốn thể hiện sự đẳng cấp.', 2350000, 2790000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 1, 30, '2025-01-12 12:03:22', NULL),
('789', 'Adidas Spritian Đen', 862294084, 'vàng', 2, 'fvfve', 1350000, 1890000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '36 37 ', 1, 30, '2025-01-12 21:45:11', NULL),
('D8302', 'Adidas Duramo hihihihihi', 862294083, 'đen', 3, 'fverv', 1990000, 2147483647, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 23, '2025-01-12 21:40:08', NULL),
('DD1391-100', 'Nike Dunk Low Panda Black White', 182949038, 'Panda Black White', 5, 'Nike Dunk Low - Cổ điển vượt thời gian, phong cách bất tận&#34;&#13;&#10;&#13;&#10;Nike Dunk Low là một biểu tượng của văn hóa sneaker, mang đến vẻ đẹp vượt thời gian. Đôi giày sở hữu thiết kế đơn giản nhưng không kém phần tinh tế với gam màu trắng đen tương phản, tạo nên sự hài hòa và sang trọng. Chất liệu da cao cấp mang đến cảm giác êm ái, thoải mái và tăng thêm độ bền cho sản phẩm. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu trắng nổi bật trên nền đen, tạo điểm nhấn ấn tượng.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu đơn giản: Sự kết hợp giữa trắng và đen tạo nên vẻ đẹp tinh tế, dễ phối đồ.&#13;&#10;Logo Swoosh đặc trưng: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Nike Dunk Low - sự lựa chọn hoàn hảo cho những ai yêu thích phong cách cổ điển và muốn thể hiện sự tinh tế trong từng bước đi.', 2350000, 3155000, '38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45', '', 1, 10, '2025-01-10 16:53:27', NULL),
('DD1503-118', 'Nike Dunk Low Rose Whisper Women&#39;s', 182949038, 'Rose Whisper Women', 5, '&#34;Nike Dunk Low Rose Whisper Women&#39;s - Hồng hào ngọt ngào, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Nike Dunk Low Rose Whisper Women&#39;s với tông màu hồng phấn ngọt ngào sẽ khiến trái tim bạn tan chảy. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu hồng phấn chủ đạo kết hợp cùng màu trắng tinh khôi tạo nên một tổng thể hài hòa, nữ tính. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu trắng, tạo điểm nhấn tinh tế. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu hồng phấn ngọt ngào: Tông màu nữ tính, trẻ trung, phù hợp với nhiều outfit.&#13;&#10;Logo Swoosh tinh tế: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Nike Dunk Low Rose Whisper Women&#39;s màu hồng phấn - là sự lựa chọn hoàn hảo cho những cô nàng yêu thích phong cách thời trang nhẹ nhàng, nữ tính và muốn thể hiện cá tính riêng.', 1990000, 3350000, '36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, 42, 42', '', 1, 5, '2025-01-10 17:00:29', NULL),
('DQ1470-101', 'Nike Blazer Low &#39;77 Jumbo Sneakers', 862294065, 'White Black', 5, '&#34;Nike Blazer Low &#39;77 Jumbo Sneakers - Cổ điển vượt thời gian, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Nike Blazer Low &#39;77 Jumbo Sneakers là một biểu tượng của làng sneaker, mang đến vẻ đẹp vượt thời gian. Đôi giày sở hữu thiết kế đơn giản nhưng không kém phần tinh tế với gam màu trắng đen chủ đạo, tạo nên sự tương phản ấn tượng. Chất liệu da cao cấp mang đến cảm giác thoải mái, êm ái khi vận động. Đế giày được thiết kế chắc chắn, tạo độ bám tốt, giúp bạn tự tin di chuyển trên mọi địa hình.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và bền bỉ.&#13;&#10;Phối màu đơn giản nhưng tinh tế: Sự kết hợp giữa trắng và đen tạo nên vẻ đẹp thời thượng.&#13;&#10;Đế giày bền bỉ: Đế giày được thiết kế chắc chắn, tăng độ bám, giúp bạn di chuyển an toàn.&#13;&#10;Nike Blazer Low &#39;77 Jumbo Sneakers - là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách cổ điển, đơn giản nhưng không kém phần thời thượng. Đôi giày sẽ giúp bạn tự tin thể hiện cá tính riêng và thoải mái trong mọi hoạt động.', 1450000, 1650000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 40, '2025-01-12 12:24:25', NULL),
('DV5476-004', 'Nike Sb Force 58 Premium &#39;Light Bone Cosmic Clay&#39;', 318090249, 'Light Bone Cosmic Clay', 4, 'Nike Sb Force 58 Premium &#39;Light Bone Cosmic Clay&#39; - Phong cách đường phố, cá tính nổi bật&#34;&#13;&#10;&#13;&#10;Nike Sb Force 58 Premium &#39;Light Bone Cosmic Clay là một lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao, năng động. Đôi giày sở hữu thiết kế hiện đại với gam màu xám chủ đạo, kết hợp cùng các chi tiết đỏ đô tạo nên sự tương phản ấn tượng. Chất liệu da lộn cao cấp và vải lưới thoáng khí mang đến cảm giác thoải mái, êm ái khi vận động. Đế giày được thiết kế với các rãnh sâu, tăng độ bám, giúp bạn tự tin di chuyển trên mọi địa hình.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế trẻ trung: Kiểu dáng thể thao, năng động, phù hợp với nhiều phong cách thời trang.&#13;&#10;Chất liệu cao cấp: Da lộn và vải lưới mang đến cảm giác thoải mái và bền bỉ.&#13;&#10;Phối màu ấn tượng: Sự kết hợp giữa xám và đỏ tạo nên vẻ ngoài cá tính, nổi bật.&#13;&#10;Đế giày bền bỉ: Đế giày được thiết kế với các rãnh sâu, tăng độ bám, giúp bạn di chuyển an toàn.&#13;&#10;Nike Sb Force 58 Premium &#39;Light Bone Cosmic Clay - sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách đường phố và luôn năng động.', 1790000, 2020000, '36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, 42, 42', '', 0, 30, '2025-01-12 12:07:29', NULL),
('DZ2768-651', 'Jordan 1 Low Pastel Purple Women&#39;s', 87417065, 'Pastel Purple Women&#38;', 5, '&#34;JORDAN 1 Low Pastel Purple Women&#39;s - Ước mơ ngọt ngào trên đôi chân&#34;&#13;&#10;&#13;&#10;JORDAN 1 Low Pastel Purple Women&#39;s là một tác phẩm nghệ thuật dành cho những tín đồ sneaker yêu thích sự nhẹ nhàng, ngọt ngào. Đôi giày sở hữu thiết kế cổ điển với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu pastel tím, hồng và trắng tạo nên một bức tranh tuyệt đẹp, vừa nữ tính lại vừa hiện đại. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu trắng, tạo điểm nhấn tinh tế. Đế giày màu kem cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu pastel ngọt ngào: Sự kết hợp hài hòa giữa tím, hồng và trắng tạo nên vẻ đẹp mơ màng.&#13;&#10;Logo Swoosh tinh tế: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;JORDAN 1 Low Pastel Purple Women&#39;s&#13;&#10; - là sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách thời trang nhẹ nhàng, nữ tính và không kém phần cá tính.', 1990000, 2350000, '36,36.5,37.5,38,38.5,39,40,40.5,41,42,42.5', '', 1, 50, '2025-01-10 17:10:44', NULL),
('FD9082-107', 'Nike Air Max 1 White Black', 862294064, 'White Black', 5, 'Nike Air Max 1 - Cổ điển vượt thời gian, phong cách bất diệt&#34;&#13;&#10;&#13;&#10;Nike Air Max 1 là một biểu tượng của làng sneaker, mang đến vẻ đẹp vượt thời gian. Đôi giày sở hữu thiết kế đơn giản nhưng không kém phần tinh tế với gam màu trắng xám chủ đạo, kết hợp cùng các chi tiết đen nổi bật tạo nên sự tương phản ấn tượng. Chất liệu da cao cấp và vải lưới thoáng khí mang đến cảm giác thoải mái, êm ái khi vận động. Đế giày được trang bị công nghệ Air Max, mang đến khả năng đệm êm ái, hỗ trợ tối đa cho đôi chân.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật và vải lưới mang đến cảm giác thoải mái và bền bỉ.&#13;&#10;Phối màu đơn giản nhưng tinh tế: Sự kết hợp giữa trắng, xám và đen tạo nên vẻ đẹp thời thượng.&#13;&#10;Công nghệ Air Max: Đế giày được trang bị công nghệ Air Max, mang đến cảm giác êm ái, thoải mái.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Nike Air Max 1 - là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách cổ điển, đơn giản nhưng không kém phần thời thượng. Đôi giày sẽ giúp bạn tự tin thể hiện cá tính riêng và thoải mái trong mọi hoạt động.', 1890000, 2090000, '39, 40,40.5, 41, 42, 42.5, 43', '', 1, 50, '2025-01-12 12:15:03', NULL),
('FQ7637-001', 'Nike Sb Force 58 &#39;Light Smoke Burgundy&#39;', 318090249, 'Light Smoke Burgundy', 4, 'Nike Sb Force 58 &#39;Light Smoke Burgundy&#39; - Phong cách đường phố, cá tính nổi bật&#34;&#13;&#10;&#13;&#10;Nike Sb Force 58 &#39;Light Smoke Burgundy là một lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao, năng động. Đôi giày sở hữu thiết kế hiện đại với gam màu xám chủ đạo, kết hợp cùng các chi tiết đỏ đô tạo nên sự tương phản ấn tượng. Chất liệu da lộn cao cấp và vải lưới thoáng khí mang đến cảm giác thoải mái, êm ái khi vận động. Đế giày được thiết kế với các rãnh sâu, tăng độ bám, giúp bạn tự tin di chuyển trên mọi địa hình.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế trẻ trung: Kiểu dáng thể thao, năng động, phù hợp với nhiều phong cách thời trang.&#13;&#10;Chất liệu cao cấp: Da lộn và vải lưới mang đến cảm giác thoải mái và bền bỉ.&#13;&#10;Phối màu ấn tượng: Sự kết hợp giữa xám và đỏ tạo nên vẻ ngoài cá tính, nổi bật.&#13;&#10;Đế giày bền bỉ: Đế giày được thiết kế với các rãnh sâu, tăng độ bám, giúp bạn di chuyển an toàn.&#13;&#10;Nike Sb Force 58 &#39;Light Smoke Burgund  - sự lựa chọn hoàn hảo cho những ai muốn thể hiện phong cách đường phố và luôn năng động.', 1720000, 1890000, '38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45', '', 0, 20, '2025-01-10 17:07:18', NULL),
('FW5188', 'Adidas Alphabounce 1 &#39;Black Red&#39;', 862294070, 'Black Red', 4, 'Thiết kế ôm chân:Thân giày bằng vải dệt co giãn 4 chiều, ôm sát bàn chân.&#13;&#10;Lớp lót dệt kim mềm mại, thoáng khí.&#13;&#10;Đệm êm ái:Công nghệ đệm Bounce:Chất liệu Bounce êm ái, đàn hồi tốt, hỗ trợ chuyển động hiệu quả.&#13;&#10;Đem lại cảm giác êm ái, thoải mái khi chạy bộ.&#13;&#10;Đế ngoài bằng cao su Continental:Bền bỉ, chống trơn trượt trên nhiều địa hình.&#13;&#10;Hỗ trợ di chuyển:Hệ thống Forgedmesh:Tăng cường độ ổn định và hỗ trợ cho bàn chân.&#13;&#10;Giúp di chuyển linh hoạt và hạn chế chấn thương.&#13;&#10;Ưu điểm:&#13;&#10;&#13;&#10;Giày đa năng, phù hợp cho nhiều hoạt động thể thao: chạy bộ, tập gym, gym nhẹ nhàng, đi bộ nhiều.&#13;&#10;Thiết kế ôm chân, thoải mái cho nhiều hình dạng bàn chân.&#13;&#10;Công nghệ Bounce đem lại cảm giác êm ái, đàn hồi tốt.&#13;&#10;Màu sắc cá tính, dễ phối đồ.&#13;&#10;Lưu ý:&#13;&#10;&#13;&#10;Không phải giày chuyên chạy bộ tốc độ cao.&#13;&#10;Form giày ôm, nên cân nhắc tăng 0.5 size nếu muốn thoải mái hơn.', 1290000, 1490000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 30, '2025-01-12 12:58:04', NULL),
('FX8707', 'Adidas Neo Breaknet Skateboard Shoes Men Low-Top White Black', 862294073, 'White Black', 5, 'Đôi giày adidas phong cách tennis.&#13;&#10;Ghi điểm phong cách cùng đôi giày mang cảm hứng tennis này. Đây là đôi giày 3 Sọc classic với kết cấu đậm chất thể thao cho cảm giác thoải mái dài lâu. Lót giày cho cảm giác mềm mại suốt ngày dài hoạt động đôi chân.', 1490000, 1790000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 1, 30, '2025-01-12 13:14:27', NULL),
('FX8708', 'Adidas Neo Breaknet &#39;Black White&#39;', 862294073, 'Black White', 4, 'Đôi giày adidas phong cách tennis.&#13;&#10;Ghi điểm phong cách cùng đôi giày mang cảm hứng tennis này. Đây là đôi giày 3 Sọc classic với kết cấu đậm chất thể thao cho cảm giác thoải mái dài lâu. Lót giày cho cảm giác mềm mại suốt ngày dài hoạt động đôi chân.', 1490000, 1550000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 70, '2025-01-12 13:17:02', NULL),
('FY7756', NULL, 862294078, 'White Blue', 5, 'Đôi giày bóng rổ trứ danh trong thiết kế cổ thấp.&#13;&#10;Không chỉ là một đôi giày, mà chính là một tuyên ngôn. Dòng adidas Forum ra mắt năm 1984 và cực kỳ được ưa chuộng cả trên sân bóng rổ lẫn trong giới âm nhạc. Mẫu mới của dòng giày kinh điển này tái hiện tinh thần thập niên 80, nguồn năng lượng bùng nổ trên sân đấu cũng như thiết kế quai cổ chân chữ X đặc trưng, kết tinh thành phiên bản cổ thấp đậm chất đường phố.', 1650000, 1790000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 50, '2025-01-12 14:06:40', NULL),
('FY9650', 'Adidas Neo Breaknet Plus &#39;White Blue&#39;', 862294073, 'White Blue', 4, 'Stylish trainers with a clean look.&#13;&#10;Classic good looks dominate the style of these tennis-inspired adidas shoes. 3-Stripes and suede details on the leather upper add a premium feel and make them easy to match with a modern streetwear wardrobe.', 1490000, 1550000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 40, '2025-01-12 13:25:16', NULL),
('FZ1119', 'Adidas Neo Entrap &#39;White Blue Green&#39;', 862294069, 'White Blue Green', 5, '&#39;Giày Adidas Neo Entrap Skateboard Shoes Men Low-Top White Blue/Green là sự lựa chọn hoàn hảo cho những tín đồ đam mê thể thao và thời trang. Được thiết kế dành riêng cho nam giới, đôi giày này không chỉ mang lại phong cách hiện đại mà còn đảm bảo tính năng tối ưu cho việc trượt ván.&#13;&#10;&#13;&#10;Phần trên của giày được làm từ chất liệu da tổng hợp, với tông màu trắng chủ đạo kết hợp cùng các chi tiết xanh lá cây và xanh dương nổi bật. Thiết kế low-top giúp cải thiện độ linh hoạt, cho phép bạn dễ dàng thực hiện các động tác nhảy và xoay chuyển trong quá trình sử dụng. Logo ba sọc đặc trưng của Adidas được đặt ở hai bên giày, tạo điểm nhấn thời trang trong khi vẫn giữ vững bản sắc thương hiệu 6 7 .&#13;&#10;&#13;&#10;Đế giày được làm từ cao su chất lượng cao, cung cấp độ bám tối ưu và khả năng chống trượt, giúp bạn tự tin hơn khi trượt ván hoặc hoạt động ngoài trời. Hệ thống đệm Cloudfoam bên trong giày không chỉ mang lại cảm giác êm ái mà còn giúp hấp thụ sốc hiệu quả, giữ cho đôi chân của bạn thoải mái suốt cả ngày dài ', 1490000, 1650000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 40, '2025-01-12 12:48:20', NULL),
('GW6728', 'Adidas EQ21 Run &#39;White Beam Yellow&#39;', 862294071, 'White Beam Yellow', 4, 'Thông tin phát hành Giày adidas EQ21 Run ‘White Beam Yellow’ GW6728&#13;&#10;Thương hiệu: Adidas&#13;&#10;Thiết kế: Giày chạy bộ, Sneaker thời trang&#13;&#10;&#13;&#10;Mã sản phẩm: GW6728&#13;&#10;&#13;&#10;Xuất xứ: Trung ', 1350000, 1550000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 40, '2025-01-12 13:06:49', NULL),
('GZ8990', 'Adidas Alphabounce 1 Chinese New Year Black', 862294070, 'Black', 5, 'Thiết kế ôm chân, thoải mái:Thân giày bằng vải lưới kỹ thuật thoáng khí, ôm sát bàn chân.&#13;&#10;Lớp lót bên trong êm ái, chống trơn trượt.&#13;&#10;Đệm êm ái:Công nghệ đế giữa Bounce:Chất liệu Bounce đàn hồi tốt, tạo cảm giác êm ái, thoải mái khi di chuyển.&#13;&#10;Đế ngoài bằng cao su Continental: Bền bỉ, chống trơn trượt trên nhiều địa hình.&#13;&#10;Hỗ trợ di chuyển:Hệ thống Forgedmesh:Lớp phủ TPU ở giữa thân giày.&#13;&#10;Tăng cường độ ổn định và hỗ trợ cho bàn chân, đặc biệt các chuyển động sang ngang.&#13;&#10;Ưu điểm:&#13;&#10;&#13;&#10;Giày đa năng, phù hợp cho nhiều hoạt động: chạy bộ, tập gym, đi bộ nhiều, đi chơi ngày Tết.&#13;&#10;Thiết kế ôm chân, thoải mái cho nhiều hình dạng bàn chân.&#13;&#10;Công nghệ Bounce đem lại cảm giác êm ái, đàn hồi tốt.&#13;&#10;Màu sắc trang nhã, dễ phối đồ, phù hợp không khí Tết Nguyên Đán.&#13;&#10;Lưu ý:&#13;&#10;&#13;&#10;Không phải giày chuyên chạy bộ tốc độ cao.&#13;&#10;Một số người dùng phản hồi form giày hơi ôm, nên cân nhắc tăng 0.5 size nếu muốn thoải mái hơn.&#13;&#10;Đây là sản phẩm edição limitada (số lượng giới hạn), nên nếu bạn thích thì cần tìm kiếm sớm.', 1190000, 1290000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 30, '2025-01-12 12:53:06', NULL),
('H02036', 'Adidas EQ19 Run Shoes &#39;White Solar Red&#39;', 862294072, 'White Solar Red', 5, 'Giày Adidas EQ19 Run Shoes ‘White Solar Red’ H02036 là một đôi giày chạy bộ nam tính, trẻ trung, được nhiều người yêu thích bởi sự thoải mái và phong cách năng động.&#13;&#10;&#13;&#10;Thiết kế:&#13;&#10;&#13;&#10;Màu sắc: Trắng chủ đạo, nổi bật với các điểm nhấn màu đỏ rực ở logo, đế giữa và dây giày, tạo cảm giác bắt mắt và năng động.&#13;&#10;Kiểu dáng: Cổ thấp ôm vừa chân, mang lại sự linh hoạt và thoải mái khi di chuyển. Thân giày được làm từ vải lưới mesh thoáng khí, kết hợp với các lớp phủ tổng hợp, tạo nên sự bền bỉ và chắc chắn.&#13;&#10;Các chi tiết: Logo adidas màu đỏ nổi bật trên nền trắng, cùng với các đường viền phản quang tạo điểm nhấn bắt mắt và an toàn khi chạy trong điều kiện thiếu sáng. Dây giày màu đỏ, đế giữa màu trắng với công nghệ Cloudfoam màu đỏ ở gót và mũi giày mang đến vẻ đẹp hiện đại và cá tính. Đế ngoài bằng cao su bền bỉ với các vân rãnh chống trơn trượt, đảm bảo độ bám tốt trên nhiều bề mặt.&#13;&#10;Công nghệ:&#13;&#10;&#13;&#10;Đế giữa Cloudfoam: Công nghệ đế giữa Cloudfoam êm ái, đàn hồi, hấp thụ lực va chạm hiệu quả, mang lại cảm giác thoải mái trên từng bước chạy.&#13;&#10;Torsion System: Hệ thống Torsion System ở phần giữa đế giày giúp tăng cường độ linh hoạt và ổn định cho bàn chân, giảm thiểu nguy cơ chấn thương.', 1150000, 1550000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 30, '2025-01-12 13:11:20', NULL),
('H68075', 'Adidas EQ21 Run Running Shoes Men Low-Top Smoke Gray', 862294071, 'Smoke Gray', 4, 'Đôi giày chạy bộ cho cảm giác thoải mái tuyệt đối.&#13;&#10;Tự tin chinh phục cự ly với đôi giày chạy bộ adidas này. Thân giày thoáng khí giúp đôi chân bạn luôn khô thoáng khi chạy đường dài. Lớp đệm siêu nhẹ cho sải bước đàn hồi dễ chịu từ lúc xuất phát tới tận khi về đích.', 1350000, 1550000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 1, 50, '2025-01-12 13:03:17', NULL),
('HJ9093-030', 'Nike Dunk Low Light Iron Ore Gym Red', 182949038, 'Light Iron Ore Gym R', 5, '&#34;Nike Dunk Low Light Iron Ore Gym Red - Vẻ đẹp cổ điển, điểm nhấn cá tính&#34;&#13;&#10;&#13;&#10;Nike Dunk Low Light Iron Ore Gym Red là một biểu tượng của văn hóa sneaker, mang đến vẻ đẹp vượt thời gian. Đôi giày sở hữu thiết kế đơn giản nhưng không kém phần tinh tế với gam màu trắng xám chủ đạo, kết hợp cùng các chi tiết đỏ nổi bật tạo nên sự tương phản ấn tượng. Chất liệu da cao cấp mang đến cảm giác êm ái, thoải mái và tăng thêm độ bền cho sản phẩm. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đỏ tươi, tạo điểm nhấn nổi bật.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu độc đáo: Sự kết hợp giữa trắng xám và đỏ tạo nên vẻ đẹp cổ điển nhưng không kém phần hiện đại.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Nike Dunk Low Light Iron Ore Gym Red - là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thời trang đơn giản nhưng không kém phần cá tính. Đôi giày sẽ giúp bạn nổi bật giữa đám đông mà vẫn giữ được sự tinh tế.', 1990000, 2050000, '38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45', '', 1, 10, '2025-01-10 16:57:01', NULL),
('HM3711-144', 'Air Jordan 1 Low SE &#34;Armory Navy&#34;', 87417065, 'Armory Navy', 5, 'Air Jordan 1 Low SE &#34;Armory Navy&#34; - Bước đi trên biển, phong cách thời thượng&#34;&#13;&#10;&#13;&#10;Air Jordan 1 Low SE &#34;Armory Navy phiên bản này mang đến một làn gió mới mẻ với sự kết hợp hài hòa giữa màu xanh dương tươi mát, trắng tinh khôi và những điểm nhấn màu cam đất. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp, mang đến cảm giác êm ái, thoải mái. Gam màu xanh dương chủ đạo gợi lên hình ảnh bầu trời và đại dương, tạo nên vẻ ngoài tươi trẻ và năng động, trong khi đó, màu trắng và cam tạo điểm nhấn nổi bật. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đen, tạo sự tương phản ấn tượng. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu độc đáo: Sự kết hợp giữa xanh dương, trắng và cam tạo nên vẻ đẹp tươi trẻ, năng động.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Air Jordan 1 Low SE &#34;Armory Navy&#34; phiên bản này là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao, năng động và muốn thể hiện sự cá tính riêng.', 2210000, 2250000, '37.5, 38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44', '', 0, 50, '2025-01-10 17:13:45', NULL),
('HP5790', 'Adidas Ultrabounce &#39;Cloud White&#39; Women&#39;s', 862294076, 'Cloud White', 5, 'Đôi giày chạy bộ êm ái có sử dụng chất liệu tái chế.&#13;&#10;Bạn đã sẵn sàng nâng dần cường độ tập luyện? Đôi giày adidas này giúp bạn sải bước tiếp theo trên hành trình chạy bộ. Đệm Bounce siêu nhẹ mang đến cảm giác thoải mái và linh hoạt để trợ lực cho bạn khi tăng cường cự ly trên đường chạy hàng ngày. Đế ngoài bằng cao su bền bỉ đảm bảo độ bám trên nhiều bề mặt đa dạng để bạn tự tin sải bước.&#13;&#10;&#13;&#10;Thoải mái mọi lúc mọi nơi&#13;&#10;Lớp đệm đế giữa cho cảm giác mềm mại, đàn hồi dễ chịu.&#13;&#10;&#13;&#10;Trải nghiệm cảm giác thoải mái toàn diện từ khi xỏ giày tới sải bước. Thiết kế cho bước chạy siêu mềm mại với lớp đệm vô tận.', 1490000, 1790000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40', '', 0, 50, '2025-01-12 13:50:04', NULL),
('HP5796', 'Adidas Ultrabounce &#39;Black White&#39;', 862294076, 'Black White', 5, 'Đôi giày chạy bộ êm ái có sử dụng chất liệu tái chế.&#13;&#10;Bạn đã sẵn sàng nâng dần cường độ tập luyện? Đôi giày adidas này giúp bạn sải bước tiếp theo trên hành trình chạy bộ. Đệm Bounce siêu nhẹ mang đến cảm giác thoải mái và linh hoạt để trợ lực cho bạn khi tăng cường cự ly trên đường chạy hàng ngày. Đế ngoài bằng cao su bền bỉ đảm bảo độ bám trên nhiều bề mặt đa dạng để bạn tự tin sải bước.', 1350000, 1850000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 50, '2025-01-12 13:46:55', NULL),
('HQ1763', 'Adidas Neo CourtBeat Court Lifestyle Shoes &#39;Core Black&#39;', 862294074, 'Core Black', 4, 'Mẫu giày tập mang đường nét thanh thoát phù hợp với hoạt động hàng ngày.&#13;&#10;Mỗi tủ quần áo đều cần có các thành phần chủ đạo. Đôi giày adidas Team Court mang phong cách thể thao đơn giản này được thiết kế để đi mọi ngày trong tuần. Thân giày bằng da mềm và không phô trương giúp đôi giày này kết hợp được với mọi thứ. Vì đôi khi, bạn chỉ muốn những món đồ kinh điển.', 1390000, 1790000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 50, '2025-01-12 13:33:02', NULL),
('HQ3437-101', 'Jordan Air Jordan 1 LOW SE “COCONUT MILK/BLACK', 87417065, 'SE COCONUT MILK/BLAC', 5, 'Jordan Air Jordan 1 LOW SE “COCONUT MILK/BLACK - Kiệt tác thời trang, đẳng cấp vượt thời gian&#34;&#13;&#10;&#13;&#10;Jordan Air Jordan 1 LOW SE “COCONUT MILK/BLACK phiên bản này mang đến một làn gió mới với sự kết hợp tinh tế giữa màu kem, đen và xanh nhạt. Đôi giày sở hữu thiết kế cổ điển, thanh lịch với phần upper được làm từ chất liệu da cao cấp và da rắn độc đáo, tạo nên vẻ ngoài sang trọng và đẳng cấp. Gam màu kem chủ đạo mang đến cảm giác nhẹ nhàng, tinh tế, trong khi đó, màu đen và xanh nhạt tạo điểm nhấn nổi bật. Logo Swoosh đặc trưng của Nike được nhấn nhá bằng màu đen, tạo sự tương phản ấn tượng. Đế giày màu trắng ngà cùng phần lót giày mềm mại giúp bạn tự tin vận động cả ngày dài.&#13;&#10;&#13;&#10;Đặc biệt:&#13;&#10;&#13;&#10;Thiết kế cổ điển: Dáng giày thấp cổ tạo nên vẻ ngoài thanh lịch và phù hợp với nhiều phong cách.&#13;&#10;Chất liệu cao cấp: Da thật và da rắn mang đến cảm giác êm ái và sang trọng.&#13;&#10;Phối màu độc đáo: Sự kết hợp giữa kem, đen và xanh nhạt tạo nên vẻ đẹp thời thượng.&#13;&#10;Chi tiết da rắn: Tăng thêm vẻ đẹp độc đáo và cá tính cho đôi giày.&#13;&#10;Logo Swoosh nổi bật: Biểu tượng của Nike, tạo điểm nhấn ấn tượng.&#13;&#10;Đế giày êm ái: Đảm bảo sự thoải mái cho đôi chân.&#13;&#10;Jordan Air Jordan 1 LOW SE “COCONUT MILK/BLACK phiên bản này là sự lựa chọn hoàn hảo cho những ai yêu thích phong cách thời trang cao cấp, muốn thể hiện sự đẳng cấp và khác biệt.', 2590000, 2690000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 1, 50, '2025-01-11 10:50:27', NULL),
('HQ8707', 'Adidas originals Campus 00s &#39;Grey White&#39;', 862294075, 'Grey White', 5, 'Đôi giày Campus nâng tầm di sản thiết kế.&#13;&#10;Dù ra mắt trên sân bóng rổ nhưng dòng giày adidas Campus đã nhanh chóng được ưa chuộng ở khắp mọi nơi. Ở phiên bản này, chúng tôi biến hóa kiểu dáng biểu tượng ấy theo một hướng mới và kết hợp các chất liệu, màu sắc và tỷ lệ thiết kế hiện đại. Thân giày bằng da cao cấp với lớp lót bằng vải dệt terry mềm mại, tất cả đặt trên đế giữa màu trắng ngà — mối liên kết đậm nét với di sản Campus.', 1550000, 1890000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 50, '2025-01-12 13:37:43', NULL),
('HQ8708', 'Adidas Originals Campus 00s &#39;Core Black&#39;', 862294075, 'Core Black', 5, 'Đôi giày Campus nâng tầm di sản thiết kế.&#13;&#10;Dù ra mắt trên sân bóng rổ nhưng dòng giày adidas Campus đã nhanh chóng được ưa chuộng ở khắp mọi nơi. Ở phiên bản này, chúng tôi biến hóa kiểu dáng biểu tượng ấy theo một hướng mới và kết hợp các chất liệu, màu sắc và tỷ lệ thiết kế hiện đại. Thân giày bằng da cao cấp với lớp lót bằng vải dệt terry mềm mại, tất cả đặt trên đế giữa màu trắng ngà — mối liên kết đậm nét với di sản Campus.', 1550000, 1890000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 0, 50, '2025-01-12 13:41:30', NULL),
('ID9658', 'Adidas Neo CourtBeat &#39;Cloud White&#39;', 862294074, 'Cloud White', 5, 'Thiết Kế&#13;&#10;Màu Sắc: Tông màu trắng sạch sẽ, dễ dàng phối hợp với nhiều trang phục khác nhau.&#13;&#10;Chất Liệu: Da tổng hợp cao cấp và vải lưới, giúp giày bền bỉ và thông thoáng.&#13;&#10;Chi Tiết: Các đường chỉ may tinh tế và logo adidas đặc trưng, tạo điểm nhấn cho thiết kế.&#13;&#10;Tính Năng&#13;&#10;Đế Giày: Đế cao su bền bỉ, cung cấp độ bám tốt trên nhiều bề mặt, thích hợp cho các hoạt động thể thao.&#13;&#10;Đệm êm ái: Thiết kế với lớp đệm bên trong giúp nâng đỡ bàn chân và giảm sốc khi di chuyển.&#13;&#10;Ứng Dụng&#13;&#10;Thể Thao: Phù hợp cho các hoạt động thể thao như tennis, bóng rổ hoặc tập gym.&#13;&#10;Phong Cách Hàng Ngày: Dễ dàng kết hợp với nhiều loại trang phục từ quần jeans đến quần thể thao, thích hợp cho cả đi học, đi làm và dạo phố.&#13;&#10;Kích Cỡ&#13;&#10;Có nhiều kích cỡ khác nhau để đáp ứng nhu cầu của người dùng.&#13;&#10;Giày adidas CourtBeat ‘Cloud White’ ID9658 là lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao cổ điển và sự thoải mái trong từng bước đi.', 1390000, 1790000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 50, '2025-01-12 13:28:50', NULL),
('IE1054', 'Adidas Adizero SL2 Running Shoes Men&#39;s Clear Lemon', 862294077, 'Lemon', 5, 'Đôi giày chạy bộ siêu nhẹ có sử dụng chất liệu tái chế.&#13;&#10;Trải nghiệm cảm giác phấn khích mỗi khi phá vỡ kỷ lục cá nhân cùng đôi giày nhanh như tốc độ của bạn. Đôi giày chạy bộ adidas Adizero này được trang bị lớp đệm Lightstrike Pro đàn hồi, siêu nhẹ và hoàn trả năng lượng cho tốc độ ở tầm cao mới. Thân giày bằng vải lưới kỹ thuật cho cảm giác thoáng khí và nâng đỡ tập trung ở những vị trí cần thiết nhất giúp bạn lướt bay tới vạch đích.&#13;&#10;&#13;&#10;Sản phẩm này có chứa tối thiểu 20% chất liệu tái chế. Bằng cách tái sử dụng các chất liệu đã được tạo ra, chúng tôi góp phần giảm thiểu lãng phí và hạn chế phụ thuộc vào các nguồn tài nguyên hữu hạn, cũng như giảm phát thải từ các sản phẩm mà chúng tôi sản xuất.', 1990000, 2550000, '40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 46', '', 0, 50, '2025-01-12 13:58:53', NULL),
('IF6753', 'Adizero SL2 Adidas &#39;Aurora Ink Flash Aqua&#39;', 862294077, ' Off White/Aurora Ink/Flash Aqua', 5, 'Đôi giày chạy bộ siêu nhẹ có sử dụng chất liệu tái chế.&#13;&#10;Trải nghiệm cảm giác phấn khích mỗi khi phá vỡ kỷ lục cá nhân cùng đôi giày nhanh như tốc độ của bạn. Đôi giày chạy bộ adidas Adizero này được trang bị lớp đệm Lightstrike Pro đàn hồi, siêu nhẹ và hoàn trả năng lượng cho tốc độ ở tầm cao mới. Thân giày bằng vải lưới kỹ thuật cho cảm giác thoáng khí và nâng đỡ tập trung ở những vị trí cần thiết nhất giúp bạn lướt bay tới vạch đích.&#13;&#10;&#13;&#10;Sản phẩm này có chứa tối thiểu 20% chất liệu tái chế. Bằng cách tái sử dụng các chất liệu đã được tạo ra, chúng tôi góp phần giảm thiểu lãng phí và hạn chế phụ thuộc vào các nguồn tài nguyên hữu hạn, cũng như giảm phát thải từ các sản phẩm mà chúng tôi sản xuất.', 1990000, 2550000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 50, '2025-01-12 13:55:12', NULL),
('JH8027', 'Adidas Spiritain 2000 Running Shoes Unisex Low-Top White Red Silver', 862294068, 'White Red Silver', 5, '&#39;Giày Adidas Spiritain 2000 Running Shoes Unisex Low-Top White Red Silver là mẫu giày thể thao hoàn hảo dành cho những ai yêu thích phong cách năng động và hiệu suất trong suốt quá trình luyện tập. Với thiết kế unisex, đôi giày này phù hợp cho cả nam và nữ, mang đến sự thoải mái và phong cách hiện đại cho mọi hoạt động thể chất.&#13;&#10;&#13;&#10;Phần trên của giày được chế tạo từ chất liệu vải vững chắc và thoáng khí, giúp giữ cho đôi chân luôn khô ráo và thoải mái trong suốt quá trình vận động. Sự kết hợp giữa màu trắng, đỏ và bạc tạo ra một diện mạo nổi bật, làm cho đôi giày này trở thành điểm nhấn cho bộ trang phục thể thao của bạn. Logo ba sọc đặc trưng của Adidas được thiết kế tinh tế, thể hiện tính thương hiệu rõ nét mà không làm mất đi sự thanh lịch của sản phẩm [citation:2][citation:3].&#13;&#10;&#13;&#10;Đế giày được làm từ cao su chống trượt, cung cấp độ bám tốt trên mọi bề mặt, giúp bạn tự tin hơn khi thực hiện các bài tập chạy hoặc trong các hoạt động ngoài trời. Hơn nữa, công nghệ đệm FORMOTION và midsole mềm mại giúp hấp thụ lực va chạm, giảm thiểu mệt mỏi cho', 1350000, 1550000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 30, '2025-01-12 12:44:44', NULL),
('JH8812', 'Adidas Neo D-PAD Classic &#39;White Teal&#39;', 862294066, 'White Teal', 5, '&#39;Giày Adidas Neo D-PAD Skateboard Shoes Unisex Low-Top White/Ruin Blue/Brown là một mẫu giày thể thao phong cách, kết hợp giữa sự thoải mái và tính năng chuyên dụng cho bộ môn skateboard. Được thiết kế dành riêng cho cả nam và nữ, đôi giày này mang đến cho người dùng cảm giác tự tin trong từng bước đi.&#13;&#10;&#13;&#10;Phần trên của giày được làm từ chất liệu da và vải cao cấp, giúp tăng cường sự thoáng khí và độ bền. Màu sắc chủ đạo là trắng kết hợp với các chi tiết màu Ruin Blue và nâu, tạo nên sự nổi bật và cá tính. Thiết kế cổ thấp giúp dễ dàng di chuyển, đồng thời tạo phong cách thời trang trẻ trung và hiện đại. Phần đế cao su chống trượt đảm bảo độ bám và an toàn khi sử dụng trên ván trượt, phù hợp với nhu cầu của những người đam mê bộ môn này [citation:6][citation:1].&#13;&#10;&#13;&#10;Ngoài ra, giày còn được trang bị công nghệ đệm êm ái, giúp giảm chấn động khi bạn thực hiện các động tác nhảy cao hoặc trượt dài, mang đến sự thoải mái tối đa cho người sử dụng. Adidas Neo D-PAD Skateboard Shoes là lựa chọn lý tưởng cho những ai yêu thích phong cách thể thao và năng động, thích hợp cho cả việc đi lại hàng ngày và các hoạt động ngoài trời [citation:3][citation:10].&#13;&#10;&#13;&#10;Với giá bán khoảng 85 USD, sản phẩm này dễ dàng tìm thấy tại các cửa hàng giày thể thao trực tuyến và các trang thương mại điện tử [citation:6][citation:2]. Mẫu giày này không chỉ mang đến phong cách thời trang mà còn đáp ứng được nhu cầu sử dụng hàng ngày của người tiêu dùng.', 1350000, 1850000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 60, '2025-01-12 12:35:53', NULL),
('JI0497', 'Adidas VL COURT 2.0 Classic Low-Top Skateboard Shoes Unisex White', 862294067, 'White', 5, '&#39;Giày Adidas VL Court 2.0 Skateboard Shoes Unisex Low-Top White là một lựa chọn hoàn hảo cho những ai yêu thích phong cách thể thao cổ điển nhưng vẫn muốn thể hiện sự năng động và cá tính. Với thiết kế cổ thấp, đôi giày này dễ dàng kết hợp với nhiều loại trang phục, từ quần jean đến quần short, mang đến vẻ ngoài trẻ trung và hiện đại.&#13;&#10;&#13;&#10;Phần trên của giày được làm từ chất liệu da tổng hợp cao cấp, với màu trắng tinh khôi, mang lại cảm giác sạch sẽ và dễ dàng trong việc bảo quản. Các chi tiết logo ba sọc biểu tượng của Adidas ở hai bên giày không chỉ tạo điểm nhấn mà còn khẳng định chất lượng và di sản lâu đời của thương hiệu. Sự kết hợp giữa thiết kế đơn giản và các yếu tố hiện đại giúp VL Court 2.0 phù hợp với nhiều hoàn cảnh khác nhau, từ đi chơi hàng ngày đến tham gia các hoạt động thể thao .&#13;&#10;&#13;&#10;Đế giày được làm từ cao su chống trượt, đảm bảo độ bám chắc chắn trên mọi bề mặt, giúp bạn tự tin hơn khi thực hiện các động tác skateboard hoặc khi di chuyển trên phố. Công nghệ đệm êm ái trong giày giúp hấp thụ chấn động, mang lại sự thoải mái tối đa cho bàn chân trong suốt thời gian sử dụng  .', 1490000, 1890000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 50, '2025-01-12 12:41:33', NULL),
('JI2551', 'Adidas Neo D-Pad Classic &#39;Beige White&#39;', 862294066, 'Beige White', 5, 'Giày Adidas Neo D-Pad Classic &#39;Beige White&#39; (mã sản phẩm JI2551) là một đôi giày thể thao kết hợp giữa sự thời trang và tính linh hoạt. Chúng được thiết kế với phần trên bằng da màu be kết hợp với các chi tiết màu trắng, mang lại một diện mạo sạch sẽ và cổ điển. Logo ba sọc đặc trưng của Adidas ở bên hông không chỉ tạo điểm nhấn mà còn thể hiện di sản lâu đời của thương hiệu này.&#13;&#10;&#13;&#10;Đôi giày này không chỉ thích hợp cho việc thể thao mà còn phù hợp với nhiều phong cách thời trang khác nhau, rất lý tưởng cho cả những buổi đi chơi hàng ngày lẫn các hoạt động thể thao. Đồng thời, điều này cũng khiến chúng trở thành lựa chọn lý tưởng cho những ai yêu thích sự thoải mái và phong cách [citation:3][citation:7].&#13;&#10;&#13;&#10;Chất liệu sử dụng cho đôi giày này là da và vải, giúp tăng cường độ bền và thoáng khí, đồng thời mang lại cảm giác nhẹ nhàng khi di chuyển. Giá bán hiện tại cho sản phẩm này thường dao động khoảng 80 USD, và có thể được tìm thấy tại nhiều cửa hàng sneaker uy tín như Authentic Shoes hoặc thông qua các trang thương mại điện tử như Flight Club và GOAT [citation:1][citation:2][citation:4][citation:10]. &#13;&#10;&#13;&#10;Với Adidas D-Pad Classic &#39;Beige White&#39;, bạn không chỉ sở hữu một sản phẩm thời trang mà còn là một phần của di sản thể thao toàn cầu do Adidas mang lại.', 1550000, 1890000, '35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, ', '', 1, 40, '2025-01-12 12:29:58', NULL);

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
(98, 'HQ3437-101', 'HQ3437-101_05.jpg'),
(99, '553558-141', '553558-141_02.jpg'),
(100, '553558-141', '553558-141_01.jpg'),
(101, '553558-141', '553558-141_03.jpg'),
(102, '553558-141', '553558-141_04.jpg'),
(103, '553558-141', '553558-141_05.jpg'),
(104, '553558-161', '553558-161_2.jpg'),
(105, '553558-161', '553558-161_01.jpg'),
(106, '553558-161', '553558-161_03.jpg'),
(107, '553558-161', '553558-161_04.jpg'),
(108, '553558-161', '553558-161_05.jpg'),
(109, 'FD9082-107', 'FD9082-107_02.jpg'),
(110, 'FD9082-107', 'FD9082-107_01.jpg'),
(111, 'FD9082-107', 'FD9082-107_03.jpg'),
(112, 'FD9082-107', 'FD9082-107_04.jpg'),
(113, 'FD9082-107', 'FD9082-107_05.jpg'),
(114, 'DQ1470-101', 'DQ1470-101_02.jpg'),
(115, 'DQ1470-101', 'DQ1470-101_01.jpg'),
(116, 'DQ1470-101', 'DQ1470-101_03.jpg'),
(117, 'DQ1470-101', 'DQ1470-101_04.jpg'),
(118, 'DQ1470-101', 'DQ1470-101_05.jpg'),
(119, 'JI2551', 'JI2551_2.jpg'),
(120, 'JI2551', 'JI2551_1.jpg'),
(121, 'JI2551', 'JI2551_3.jpg'),
(122, 'JI2551', 'JI2551_4.jpg'),
(123, 'JH8812', 'JH8812_2.jpg'),
(124, 'JH8812', 'JH8812_1.jpg'),
(125, 'JH8812', 'JH8812_3.jpg'),
(126, 'JH8812', 'JH8812_4.jpg'),
(127, 'JI0497', 'JI0497_2.jpg'),
(128, 'JI0497', 'JI0497_1.jpg'),
(129, 'JI0497', 'JI0497_3.jpg'),
(130, 'JI0497', 'JI0497_4.jpg'),
(131, 'JH8027', 'JH8027_2.jpg'),
(132, 'JH8027', 'JH8027_1.jpg'),
(133, 'JH8027', 'JH8027_3.jpg'),
(134, 'JH8027', 'JH8027_4.jpg'),
(135, 'JH8027', 'JH8027_5.jpg'),
(136, 'FZ1119', 'FZ1119_2.jpg'),
(137, 'FZ1119', 'FZ1119_1.jpg'),
(138, 'FZ1119', 'FZ1119_3.jpg'),
(139, 'FZ1119', 'FZ1119_4.jpg'),
(140, 'FZ1119', 'FZ1119_5.jpg'),
(141, 'GZ8990', 'GZ8990_1.jpg'),
(142, 'GZ8990', 'GZ8990_2.jpg'),
(143, 'GZ8990', 'GZ8990_3.jpg'),
(144, 'GZ8990', 'GZ8990_4.jpg'),
(145, 'GZ8990', 'GZ8990_5.jpg'),
(146, 'FW5188', 'FW5188_2.jpg'),
(147, 'FW5188', 'FW5188_3.jpg'),
(148, 'FW5188', 'FW5188_1.jpg'),
(149, 'FW5188', 'FW5188_4.jpg'),
(150, 'H68075', 'H68075_1.jpg'),
(151, 'H68075', 'H68075_2.jpg'),
(152, 'H68075', 'H68075_3.jpg'),
(153, 'H68075', 'H68075_4.jpg'),
(154, 'H68075', 'H68075_5.jpg'),
(155, 'GW6728', 'GW6728_1.jpg'),
(156, 'GW6728', 'GW6728_2.jpg'),
(157, 'GW6728', 'GW6728_3.jpg'),
(158, 'GW6728', 'GW6728_4.jpg'),
(159, 'GW6728', 'GW6728_5.jpg'),
(160, 'GW6728', 'GW6728_6.jpg'),
(161, 'H02036', 'H02036_1.jpg'),
(162, 'H02036', 'H02036_2.jpg'),
(163, 'H02036', 'H02036_3.jpg'),
(164, 'H02036', 'H02036_4.jpg'),
(165, 'H02036', 'H02036_5.jpg'),
(166, 'FX8707', 'FX8707_1.jpg'),
(167, 'FX8707', 'FX8707_2.jpg'),
(168, 'FX8707', 'FX8707_3.jpg'),
(169, 'FX8707', 'FX8707_4.jpg'),
(170, 'FX8707', 'FX8707_5.jpg'),
(171, 'FX8708', 'FX8708_1.jpg'),
(172, 'FX8708', 'FX8708_2.jpg'),
(173, 'FX8708', 'FX8708_3.jpg'),
(174, 'FX8708', 'FX8708_4.jpg'),
(175, 'FX8708', 'FX8708_5.jpg'),
(176, 'FX8708', 'FX8708_6.jpg'),
(177, 'DV5476-004', 'DV5476-004_2.jpg'),
(178, 'DV5476-004', 'DV5476-004_1.jpg'),
(179, 'DV5476-004', 'DV5476-004_3.jpg'),
(180, 'DV5476-004', 'DV5476-004_4.jpg'),
(181, 'DV5476-004', 'DV5476-004_5.jpg'),
(182, '553558-152', '553558-152_2.jpg'),
(183, '553558-152', '553558-152_1.jpg'),
(184, '553558-152', '553558-152_3.jpg'),
(185, '553558-152', '553558-152_4.jpg'),
(186, '553558-152', '553558-152_5.jpg'),
(187, 'FY9650', 'FY9650_2.jpg'),
(188, 'FY9650', 'FY9650_1.jpg'),
(189, 'FY9650', 'FY9650_3.jpg'),
(190, 'FY9650', 'FY9650_4.jpg'),
(191, 'FY9650', 'FY9650_5.jpg'),
(192, 'ID9658', 'ID9658_1.jpg'),
(193, 'ID9658', 'ID9658_2.jpg'),
(194, 'ID9658', 'ID9658_3.jpg'),
(195, 'ID9658', 'ID9658_4.jpg'),
(196, 'HQ1763', 'HQ1763_1.jpg'),
(197, 'HQ1763', 'HQ1763_2.jpg'),
(198, 'HQ1763', 'HQ1763_3.jpg'),
(199, 'HQ1763', 'HQ1763_4.jpg'),
(200, 'HQ8707', 'HQ8707_1.jpg'),
(201, 'HQ8707', 'HQ8707_2.jpg'),
(202, 'HQ8707', 'HQ8707_3.jpg'),
(203, 'HQ8707', 'HQ8707_4.jpg'),
(204, 'HQ8708', 'HQ8708_1.jpg'),
(205, 'HQ8708', 'HQ8708_2.jpg'),
(206, 'HQ8708', 'HQ8708_3.jpg'),
(207, 'HQ8708', 'HQ8708_4.jpg'),
(208, 'HQ8708', 'HQ8708_5.jpg'),
(209, 'HQ8708', 'HQ1763_5.jpg'),
(210, 'HP5796', 'HP5796_1.jpg'),
(211, 'HP5796', 'HP5796_2.jpg'),
(212, 'HP5796', 'HP5796_3.jpg'),
(213, 'HP5796', 'HP5796_4.jpg'),
(214, 'HP5796', 'HP5796_5.jpg'),
(215, 'HP5790', 'HP5790_1.jpg'),
(216, 'HP5790', 'HP5790_2.jpg'),
(217, 'HP5790', 'HP5790_3.jpg'),
(218, 'HP5790', 'HP5790_4.jpg'),
(219, 'HP5790', 'HP5790_5.jpg'),
(220, 'HP5790', 'HP5790_6.jpg'),
(221, 'IF6753', 'IF6753_1.jpg'),
(222, 'IF6753', 'IF6753_2.jpg'),
(223, 'IF6753', 'IF6753_3.jpg'),
(224, 'IF6753', 'IF6753_4.jpg'),
(225, 'IF6753', 'IF6753_5.jpg'),
(226, 'IE1054', 'IE1054_1.jpg'),
(227, 'IE1054', 'IE1054_2.jpg'),
(228, 'IE1054', 'IE1054_3.jpg'),
(229, 'IE1054', 'IE1054_4.jpg'),
(230, 'IE1054', 'IE1054_5.jpg'),
(231, 'IE1054', 'IE1054_6.jpg'),
(232, 'FY7756', 'FY7756_1.jpg'),
(233, 'FY7756', 'FY7756_2.jpg'),
(234, 'FY7756', 'FY7756_3.jpg'),
(235, 'FY7756', 'FY7756_4.jpg'),
(236, 'FY7756', 'FY7756_5.jpg'),
(237, '384857-02', 'PMSTRUNxanhthan2.jpg'),
(238, '384857-02', 'PMSTRUNxanhthan4.jpg'),
(239, '384857-02', 'PMSTRUNxanhthan1.jpg'),
(240, '384857-02', 'PMSTRUNxanhthan3.jpg'),
(241, '384857-01', '384857-01_1.jpg'),
(242, '384857-01', '384857-01_2.jpg'),
(243, '384857-01', '384857-01_3.jpg'),
(244, '384857-01', '384857-01_4.jpg'),
(245, '384857-01', '384857-01_5.jpg'),
(246, '368876-01', 'PMLocamo1.jpg'),
(247, '368876-01', 'PMLocamo2.jpg'),
(248, '368876-01', 'PMLocamo3.jpg'),
(249, '368876-01', 'PMLocamo4.jpg'),
(250, '368876-01', 'PMLocamo5.jpg'),
(251, '392328-09', 'PMRBvang1.jpg'),
(252, '392328-09', 'PMRBvang2.jpg'),
(253, '392328-09', 'PMRBvang3.jpg'),
(254, '392328-09', 'PMRBvang4.jpg'),
(255, '392328-09', 'PMRBvang5.jpg'),
(256, 'D8302', 'PMCRClogoxanh3.jpg'),
(257, '789', 'PMarmy5.jpg');

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
(318090249, 'Nike SB Force 58 ', 9),
(862294064, 'Nike Air Max', 11),
(862294065, 'Nike Blazer Low', 12),
(862294066, 'Adidas Neo D-PAD', 13),
(862294067, 'Adidas VL Court 2.0 ', 14),
(862294068, 'Adidas Spiritain 2000', 15),
(862294069, 'Adidas Neo Entrap', 13),
(862294070, 'Adidas Alphabounce 1', 16),
(862294071, 'Adidas EQ21 Run', 17),
(862294072, 'Adidas EQ19 Run ', 18),
(862294073, 'Adidas Neo Breaknet', 13),
(862294074, 'Adidas Neo CourtBeat', 13),
(862294075, 'Adidas Originals Campus', 19),
(862294076, 'Adidas Ultrabounce', 20),
(862294077, 'Adidas Adizero SL2', 21),
(862294078, 'Adidas Originals Forum', 19),
(862294079, 'Puma ST Runner V3', 22),
(862294080, 'PUMA Rebound Layup Low', 23),
(862294081, 'PUMA Rebound V6', 23),
(862294082, 'Adidas Duramo Đen 234', 26),
(862294083, 'Adidas Duramo Đen', 26),
(862294084, 'Adidas Spriritan Mid', 15);

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

--
-- Đang đổ dữ liệu cho bảng `token_login`
--

INSERT INTO `token_login` (`id`, `user_id`, `token`, `create_at`, `last_active`) VALUES
(132, 13, '9ed3e6acc11bb95e98bbffc5b1749f50baa6c11a', '2025-01-16 23:29:21', NULL);

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
(13, 'kiendz1234', '123456789', 'Phạm Thu Thủy', '89 Phùng Hưng, Phúc La, Hà Đông, Hà Nội', '0383083743', 'phamthuthuy_t66@hus.edu.vn', NULL, NULL, 1, 1, '2024-10-27 22:28:09', '2024-11-10 13:46:14'),
(14, 'kiendz12', '123456789', 'Lê Trung Kiên', NULL, '0353693404', 'letrungkien2_t66@hus.edu.vn', NULL, NULL, 1, 1, '2024-11-15 11:26:09', NULL),
(15, 'kiendz1', '123456789', 'Lê Trung Kiên 123', NULL, '0353693404', 'letrungkien3_t66@hus.edu.vn', NULL, NULL, 1, 0, '2024-11-16 00:56:55', NULL),
(16, 'kiendz123', '123456789', 'Lê Trung', NULL, '0123456789', 'letrungkien9_t66@hus.edu.vn', NULL, NULL, 1, 1, '2024-12-11 10:30:07', NULL),
(17, 'thuthuyne', '12345678', NULL, NULL, NULL, 'phamthuthuythuyloi@gmail.com', NULL, NULL, 1, 0, '2025-01-11 13:47:45', '2025-01-11 13:58:37'),
(18, 'thuthuynha', '123456789', NULL, NULL, NULL, 'phamthuthuy_t66@hus.edu.vn', NULL, '819b73a4d3e119d9776629ec44c465fadc9b9858', 0, 0, '2025-01-11 13:53:10', NULL);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT cho bảng `product_name`
--
ALTER TABLE `product_name`
  MODIFY `p_name_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=862294085;

--
-- AUTO_INCREMENT cho bảng `token_login`
--
ALTER TABLE `token_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
