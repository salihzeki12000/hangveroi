-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 16, 2018 at 06:32 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cuahangbansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hồ Chí Minh', '2016-10-14 01:47:41', '2016-10-14 01:47:41', NULL),
(2, 'Vũng Tàu', '2016-10-14 01:47:57', '2016-10-14 01:47:57', NULL),
(3, 'Phan Thiết', '2016-10-14 01:48:03', '2016-10-14 01:48:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `filename` text COLLATE utf8_unicode_ci,
  `tag` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `user_id`, `filename`, `tag`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 2, 'product_20161003-1475467561.6188.png', 'news.image', '2016-10-02 21:06:01', '2016-10-03 07:18:45', NULL),
(4, 2, 'product_20161003-1475467583.2737.png', 'products.image', '2016-10-02 21:06:23', '2016-10-02 21:06:23', NULL),
(10, 2, 'product_20161003-1475468654.6786.png', 'products.image', '2016-10-02 21:24:14', '2016-10-02 21:24:14', NULL),
(11, 2, 'product_20161003-1475468698.3531.png', 'products.image', '2016-10-02 21:24:58', '2016-10-02 21:24:58', NULL),
(12, 2, 'product_20161003-1475468903.1066.png', 'news.image', '2016-10-02 21:28:23', '2016-10-03 07:20:59', NULL),
(13, 2, 'product_20161003-1475470172.1408.png', 'products.image', '2016-10-02 21:49:32', '2016-10-02 21:49:32', NULL),
(14, 2, 'product_20161003-1475477876.2154.png', 'products.image', '2016-10-02 23:57:56', '2016-10-02 23:57:56', NULL),
(15, 2, 'product_20161003-1475478764.8376.png', 'products.image', '2016-10-03 00:12:44', '2016-10-03 00:12:44', NULL),
(16, 2, 'product_20161003-1475478765.0152.png', 'products.image', '2016-10-03 00:12:45', '2016-10-03 00:12:45', NULL),
(17, 2, 'product_20161003-1475478800.4793.png', 'products.image', '2016-10-03 00:13:20', '2016-10-03 00:13:20', NULL),
(19, 2, 'product_20161003-1475478845.9309.jpg', 'products.image', '2016-10-03 00:14:05', '2016-10-03 00:14:05', NULL),
(20, 2, 'product_20161003-1475478867.5269.jpg', 'products.image', '2016-10-03 00:14:27', '2016-10-03 00:14:27', NULL),
(22, 2, 'product_20161003-1475479024.7728.png', 'products.image', '2016-10-03 00:17:04', '2016-10-03 00:17:04', NULL),
(24, 2, 'product_20161003-1475479088.6732.png', 'products.image', '2016-10-03 00:18:08', '2016-10-03 00:18:08', NULL),
(25, 2, 'product_20161007-1475811435.7867.png', 'products.image', '2016-10-06 20:37:15', '2016-10-06 20:37:15', NULL),
(26, 2, 'news_20161007-1475811717.8511.png', 'news.image', '2016-10-06 20:41:57', '2016-10-06 20:41:57', NULL),
(29, 2, 'news_20161007-1475812094.7888.jpg', 'news.image', '2016-10-06 20:48:14', '2016-10-06 20:48:14', NULL),
(30, 2, 'news_20161007-1475812094.921.jpg', 'news.image', '2016-10-06 20:48:14', '2016-10-06 20:48:14', NULL),
(33, 2, 'news_20161007-1475812187.4002.png', 'news.image', '2016-10-06 20:49:47', '2016-10-06 20:49:47', NULL),
(34, 2, 'http://localhost:8888/cuahangbansi/public/assets/uploads/news/news_20161007-1475812222.2744_medium.png', 'news.image', '2016-10-06 20:50:22', '2016-11-26 05:23:51', NULL),
(35, 2, 'http://localhost:8888/cuahangbansi/public/assets/uploads/news/news_20161007-1475823729.0703_medium.png', 'news.image', '2016-10-07 00:02:09', '2016-11-26 05:23:56', NULL),
(36, 2, 'http://localhost:8888/cuahangbansi/public/assets/uploads/news/news_20161007-1475823793.264_medium.png', 'news.image', '2016-10-07 00:03:13', '2016-11-26 05:24:05', NULL),
(41, 1, 'product_20161110-1478744322.027.jpg', 'products.image', '2016-11-09 19:18:42', '2016-11-09 19:18:42', NULL),
(42, 1, 'http://localhost:8888/cuahangbansi/public/assets/uploads/products/products_20161110-1478747534.652_medium.jpg', 'products.image', '2016-11-09 20:12:14', '2016-11-26 05:24:11', NULL),
(59, 1, 'http://localhost:8888/cuahangbansi/public/assets/uploads/products/products_20161110-1478747792.235_medium.png', 'products.image', '2016-11-09 20:16:32', '2016-11-26 05:24:15', NULL),
(60, 1, 'http://localhost:8888/cuahangbansi/public/assets/uploads/products/products_20161110-1478747896.1071_medium.jpg', 'products.image', '2016-11-09 20:18:16', '2016-11-26 05:24:20', NULL),
(61, 1, 'http://localhost:8888/cuahangbansi/public/assets/uploads/products/products_20161110-1478748108.8692_medium.jpg', 'products.image', '2016-11-09 20:21:48', '2016-11-26 05:24:24', NULL),
(62, 1, 'product_20161110-1478748142.3575.jpg', 'products.image', '2016-11-09 20:22:22', '2016-11-09 20:22:22', NULL),
(63, 1, 'product_20161110-1478748142.516.jpg', 'products.image', '2016-11-09 20:22:22', '2016-11-09 20:22:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL,
  `original_name` text COLLATE utf8_unicode_ci NOT NULL,
  `filename` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE `layouts` (
  `id` int(11) NOT NULL,
  `layout` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2015_08_07_125128_CreateImages', 1),
('2016_11_26_055358_create_shoppingcart_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` int(11) NOT NULL,
  `possition` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `metatitle` text COLLATE utf8_unicode_ci,
  `metakeyword` text COLLATE utf8_unicode_ci,
  `metadescription` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category_id`, `name`, `slug`, `content`, `image_thumb`, `possition`, `user_id`, `metatitle`, `metakeyword`, `metadescription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Tesst', '', '<p>Test</p>', 34, 1, 2, 'tes', 'tes,tets', 'test', '2016-10-06 20:50:22', '2016-10-07 00:01:23', NULL),
(2, 3, 'Tesst 2', '', '<p>Tesst 2</p>', 35, 2, 2, 'Tesst 2', 'Tesst 2', 'Tesst 2', '2016-10-07 00:02:09', '2016-10-07 01:06:38', NULL),
(3, 3, 'test 3', '', '<p>test 3</p>', 36, 3, 2, 'test 3', 'test 3', 'test 3', '2016-10-07 00:03:13', '2016-10-07 01:06:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE `news_category` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'vi',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`id`, `name`, `lang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Góc báo chí', 'vi', '2016-10-06 20:07:50', '2016-10-06 21:28:36', NULL),
(2, 'Chính trị', 'vi', '2016-10-06 21:06:08', '2016-10-06 23:19:42', NULL),
(3, 'Giáo dục', 'vi', '2016-10-06 21:36:16', '2016-10-06 23:23:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_image`
--

CREATE TABLE `news_image` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_image`
--

INSERT INTO `news_image` (`id`, `news_id`, `image_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 33, '2016-10-06 20:49:47', '2016-10-06 20:50:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cus_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cus_phone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cus_email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cus_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `city_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `total_price` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `cus_name`, `cus_phone`, `cus_email`, `cus_address`, `city_id`, `district_id`, `total_price`, `qty`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Nguy?n Th? B?o', '1682219209', NULL, '26/1D ?p M? Hoà 1, Xã Trung Chánh, huy?n Hóc Môn', 1, NULL, '246,997', 2, '2017-05-24 07:28:18', '2017-05-24 07:28:18', NULL),
(2, 1, 'Nguy?n Th? B?o', '1682219209', NULL, '26/1D ?p M? Hoà 1, Xã Trung Chánh, huy?n Hóc Môn', 1, NULL, '246,997', 2, '2017-05-24 07:32:09', '2017-05-24 07:32:09', NULL),
(3, 1, 'Nguyễn Thế Bảo', '1682219209', NULL, '26/1D Ấp Mỹ Hoà 1, Xã Trung Chánh, huyện Hóc Môn', 1, NULL, '26,924,994', 26, '2017-05-24 08:12:47', '2017-05-24 08:12:47', NULL),
(4, 1, 'Nguyễn Thế Bảo', '1682219209', NULL, '26/1D Ấp Mỹ Hoà 1, Xã Trung Chánh, huyện Hóc Môn', 1, NULL, '0', 0, '2017-05-24 08:12:59', '2017-05-24 08:12:59', NULL),
(5, 1, 'Nguyễn Thế Bảo', '1682219209', NULL, '26/1D Ấp Mỹ Hoà 1, Xã Trung Chánh, huyện Hóc Môn', 1, NULL, '24,347,650', 5, '2017-05-24 08:16:53', '2017-05-24 08:16:53', NULL),
(6, 1, '日本に帰って食べたいシリーズ Vol.１', '671657011', NULL, '大阪府 大阪市中央区千日前1-7-25 相合ビル1階', 1, NULL, '11,990,000', 1, '2017-05-24 08:19:01', '2017-05-24 08:19:01', NULL),
(7, 1, 'Nguyễn Thế Bảo', '1682219209', NULL, '26/1D Ấp Mỹ Hoà 1, Xã Trung Chánh, huyện Hóc Môn', 1, NULL, '11,990,000', 1, '2017-05-24 08:19:38', '2017-05-24 08:19:38', NULL),
(8, 1, 'Nguyễn Thế Bảo', '1682219209', NULL, '26/1D Ấp Mỹ Hoà 1, Xã Trung Chánh, huyện Hóc Môn', 1, NULL, '11,990,000', 1, '2017-05-24 08:21:46', '2017-05-24 08:21:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_price` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `product_id`, `product_name`, `product_price`, `product_qty`, `order_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 23, ' Xe Jeep ??a Hình ?i?u Khi?n T? Xa  ', '122550', 1, 2, '2017-05-24 07:32:09', '2017-05-24 07:32:09', NULL),
(2, 1, 'Máy bay ?i?u khi?n t? xa No.901 (??)sds', '124447', 1, 2, '2017-05-24 07:32:09', '2017-05-24 07:32:09', NULL),
(3, 22, 'Apple iPhone 6S 64GB (Vàng hồng) - Hàng nhập khẩu', '11990000', 2, 3, '2017-05-24 08:12:47', '2017-05-24 08:12:47', NULL),
(4, 19, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '122550', 9, 3, '2017-05-24 08:12:47', '2017-05-24 08:12:47', NULL),
(5, 23, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '122550', 1, 3, '2017-05-24 08:12:47', '2017-05-24 08:12:47', NULL),
(6, 20, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '122550', 3, 3, '2017-05-24 08:12:47', '2017-05-24 08:12:47', NULL),
(7, 18, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '122550', 9, 3, '2017-05-24 08:12:47', '2017-05-24 08:12:47', NULL),
(8, 1, 'Máy bay điều khiển từ xa No.901 (Đỏ)sds', '124447', 2, 3, '2017-05-24 08:12:47', '2017-05-24 08:12:47', NULL),
(9, 20, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '122550', 2, 5, '2017-05-24 08:16:53', '2017-05-24 08:16:53', NULL),
(10, 2, 'Apple iPhone 6S 64GB (Vàng hồng) - Hàng nhập khẩu', '11990000', 2, 5, '2017-05-24 08:16:53', '2017-05-24 08:16:53', NULL),
(11, 19, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '122550', 1, 5, '2017-05-24 08:16:53', '2017-05-24 08:16:53', NULL),
(12, 2, 'Apple iPhone 6S 64GB (Vàng hồng) - Hàng nhập khẩu', '11990000', 1, 6, '2017-05-24 08:19:01', '2017-05-24 08:19:01', NULL),
(13, 2, 'Apple iPhone 6S 64GB (Vàng hồng) - Hàng nhập khẩu', '11990000', 1, 7, '2017-05-24 08:19:38', '2017-05-24 08:19:38', NULL),
(14, 22, 'Apple iPhone 6S 64GB (Vàng hồng) - Hàng nhập khẩu', '11990000', 1, 8, '2017-05-24 08:21:46', '2017-05-24 08:21:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `possition` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `metatitle` text COLLATE utf8_unicode_ci,
  `metakeyword` text COLLATE utf8_unicode_ci,
  `metadescription` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `possition`, `user_id`, `metatitle`, `metakeyword`, `metadescription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Khuyến mãi', 'khuyen-mai', '<p>Khuyến mãi</p>', 2, 2, 'Tesst 2', 'Tesst 2', 'Tesst 2', '2016-10-07 00:02:09', '2016-10-13 19:39:37', NULL),
(3, 'Hướng dẫn mua hàng', 'huong-dan-mua-hang', '<p>Hướng dẫn mua hàng</p>', 3, 2, 'test 3', 'test 3', 'test 3', '2016-10-07 00:03:13', '2017-05-21 04:22:29', NULL),
(4, 'Giới thiệu', 'gioi-thieu', '<p>Đây là bài giới thiệu</p>', 4, 2, 'Bài giới thiệu', 'gioi thieu', 'Đây là bài giới thiệu', '2016-10-13 19:24:07', '2016-10-13 19:27:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` text COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` int(11) NOT NULL,
  `price` double NOT NULL,
  `descriptions` text COLLATE utf8_unicode_ci NOT NULL,
  `specifications` text COLLATE utf8_unicode_ci NOT NULL,
  `units_on_order` int(11) NOT NULL,
  `product_type` int(11) NOT NULL,
  `product_manufacturer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image_thumb`, `price`, `descriptions`, `specifications`, `units_on_order`, `product_type`, `product_manufacturer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Máy bay điều khiển từ xa No.901 (Đỏ)sds', 'may-bay-dieu-khien-tu-xa-no.901-(do)sds', 60, 124447, '<h1><br></h1><h1>Máy bay điều khiển từ xa No.901 là sản phẩm đồ chơi giá rẻ nhưng rất được ưa chuộng tại các nước Châu Âu như Anh và Tây Ban Nha. Với những tính năng như chống chịu va đập, thời gian bay 5-8 phút, No.901 chính là sản phẩm máy bay điều khiển từ xa giá rẻ tốt nhất.</h1><p>&nbsp;</p><p>TÍNH NĂNG CƠ BẢN</p><p>. Sản phẩm có khả năng chịu va đập mạnh<br>. Độ đạt được khá lớn 8-12m đối với một sản phẩm máy bay đồ chơi giá rẻ<br>. Thiết kế thông minh, sạc pin trực tiếp cho máy bay từ giắc cắm trên bộ điều khiển mà không thông qua bất kỳ thiết bị dây cắm nào cả.</p><p>&nbsp;</p><p>Một số lưu ý khi sử dụng sản phẩm&nbsp;</p><p>&nbsp;1. Do sản phẩm là máy bay mini, nên độ cân bằng của máy bay chỉ tương đối, nên khi mới chơi, bạn chưa quen điều khiển máy bay bạn sẽ làm máy bay rơi nhiều lần, nhưng bạn yên tâm máy bay có khả năng chịu va đập mạnh nên bạn không lo bị hư hỏng nhé</p><p>&nbsp;2. Sản phẩm có thể điều hướng sang trái hay sang phải nhưng để làm được điều này, bạn cần phải điều khiển thành thạo để máy bay có thể bay thăng bằng trên không trung, sau đó bạn ấn vào nút R hay L rồi đồng thời gạt cần điều khiển phía tay trái để máy bay bay sang hướng bên phải hay bên trái. Do đó bạn phải cần chơi nhiều lần mới điều chỉnh được nhé.</p><p>3. Bạn nên xem kỹ video mở hộp và hướng dẫn sử dụng ở dưới bài viết<br><br>Nếu bạn có thắc mắc gì xin liên hệ trực tiếp với chúng tôi để được tư vấn tốt nhất</p>', '<blockquote><p>Nguyen the bao</p><p>Qua dep</p></blockquote>', 100, 1, 7, '2016-09-15 02:16:43', '2016-11-26 05:45:11', NULL),
(2, 'Apple iPhone 6S 64GB (Vàng hồng) - Hàng nhập khẩu', 'apple-iphone-6s-64gb-(vang-hong)---hang-nhap-khau', 59, 11990000, '<h1><img class="fr-dib fr-draggable fr-fil" src="http://localhost/cuahangbansi/public/assets/uploads/product_20161003-1475478867.5269.jpg" style="width: 300px;"></h1><h1>Máy bay điều khiển từ xa No.901 là sản phẩm đồ chơi giá rẻ nhưng rất được ưa chuộng tại các nước Châu Âu như Anh và Tây Ban Nha. Với những tính năng như chống chịu va đập, thời gian bay 5-8 phút, No.901 chính là sản phẩm máy bay điều khiển từ xa giá rẻ tốt nhất.</h1><p>&nbsp;</p><p>TÍNH NĂNG CƠ BẢN</p><p>. Sản phẩm có khả năng chịu va đập mạnh<br>. Độ đạt được khá lớn 8-12m đối với một sản phẩm máy bay đồ chơi giá rẻ<br>. Thiết kế thông minh, sạc pin trực tiếp cho máy bay từ giắc cắm trên bộ điều khiển mà không thông qua bất kỳ thiết bị dây cắm nào cả.</p><p>&nbsp;</p><p>Một số lưu ý khi sử dụng sản phẩm&nbsp;</p><p>&nbsp;1. Do sản phẩm là máy bay mini, nên độ cân bằng của máy bay chỉ tương đối, nên khi mới chơi, bạn chưa quen điều khiển máy bay bạn sẽ làm máy bay rơi nhiều lần, nhưng bạn yên tâm máy bay có khả năng chịu va đập mạnh nên bạn không lo bị hư hỏng nhé</p><p>&nbsp;2. Sản phẩm có thể điều hướng sang trái hay sang phải nhưng để làm được điều này, bạn cần phải điều khiển thành thạo để máy bay có thể bay thăng bằng trên không trung, sau đó bạn ấn vào nút R hay L rồi đồng thời gạt cần điều khiển phía tay trái để máy bay bay sang hướng bên phải hay bên trái. Do đó bạn phải cần chơi nhiều lần mới điều chỉnh được nhé.</p><p>3. Bạn nên xem kỹ video mở hộp và hướng dẫn sử dụng ở dưới bài viết<br><br>Nếu bạn có thắc mắc gì xin liên hệ trực tiếp với chúng tôi để được tư vấn tốt nhất</p>', '<p>. 01 máy bay Mingji 901</p><p>. 01 bộ điều khiển từ xa</p>', 99, 1, 2, '2016-09-15 02:16:43', '2016-11-09 20:16:32', NULL),
(17, ' Apple iPhone 7 32GB (Đen nhám) - Hàng nhập khẩu', '-apple-iphone-7-32gb-(den-nham)---hang-nhap-khau', 42, 15580000, '<h2>Giới thiệu sản phẩm Apple iPhone 7 32GB (Đen nhám) - Hàng nhập khẩu</h2><h1>Bộ đôi iPhone 7 và iPhone 7 Plus đã chính thức được Apple giới thiệu với nhiều nâng cấp về mặt cấu hình cũng như tính năng.</h1><p><strong><strong>Thiết kế quen thuộc</strong></strong></p><p>Tương tự như bộ đôi iPhone 6s và 6s Plus ra mắt năm ngoái thì thiết kế của iPhone 7 năm nay cũng không có nhiều sự thay đổi. Điểm dễ dàng nhận thấy sự khác biệt nhất giữa iPhone 6s và iPhone 7 chính là phần dải nhựa bắt sóng đã được đưa lên phần cạnh trên thay vì cắt ngang mặt lưng như trước.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-711.jpg"><img alt="Thiết kế khá tương đồng với iPhone 6s" data-original="https://cdn1.tgdd.vn/Products/Images/42/74110/iphone-711.jpg" title="Thiết kế khá tương đồng với iPhone 6s" src="https://cdn1.tgdd.vn/Products/Images/42/74110/iphone-711.jpg" class="fr-dii fr-draggable"></a></p><p><em>Thiết kế khá tương đồng với iPhone 6s</em></p><p>Ngoài ra thì phần camera trên iPhone 7 cũng lồi lên khá nhiều và có kích thước lớn hơn hẳn so với các thế hệ iPhone trước. iPhone 7 cũng được bổ sung thêm màu mới là màu đen bóng mà Apple gọi là Jet Black tuy nhiên màu mới này khá bỏng bẩy và dễ bị trầy xước nếu bạn không sắm cho mình một chiếc ốp lưng trong quá trình sử dụng.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-710.jpg"><img alt="Màu Jet Black mới" data-original="https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-710.jpg" title="Màu Jet Black mới" src="https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-710.jpg" class="fr-dii fr-draggable"></a></p><p><em>Màu Jet Black mới</em></p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-75.jpg"><img alt="Tất cả các màu sắc của iPhone 7" data-original="https://cdn.tgdd.vn/Products/Images/42/74110/iphone-75.jpg" title="Tất cả các màu sắc của iPhone 7" src="https://cdn.tgdd.vn/Products/Images/42/74110/iphone-75.jpg" class="fr-dii fr-draggable"></a></p><p><em>Tất cả các màu sắc của iPhone 7</em></p><p>Phím Home vật lý trên iPhone cũng đã biến mất và thay vào đó là sự kết hợp với Taptic Engine mới, liên kết với 3D Touch để biến thành một nút Home cảm ứng.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-76.jpg"><img alt="Phím Home cảm ứng lực" data-original="https://cdn2.tgdd.vn/Products/Images/42/74110/iphone-76.jpg" title="Phím Home cảm ứng lực" src="https://cdn2.tgdd.vn/Products/Images/42/74110/iphone-76.jpg" class="fr-dii fr-draggable"></a></p><p><em>Phím Home cảm ứng lực</em></p><p><strong><strong>Lần đầu tiên iPhone có thể chống nước</strong></strong></p><p>Apple đã lắng nghe mong muốn của người tiêu dùng và đưa tiêu chuẩn chống nước IP67 lên bộ đôi iPhone mới của mình. Giờ đây chiếc iPhone 7 của bạn có thể sống sót dưới nước ở độ sâu 1m trong khoảng thời gian 30 phút mà không bị hư hỏng gì.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-7-5.jpg"><img alt="iPhone 7 hỗ trợ chống nước tiêu chuẩn IP67" data-original="https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-7-5.jpg" title="iPhone 7 hỗ trợ chống nước tiêu chuẩn IP67" src="https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-7-5.jpg" class="fr-dii fr-draggable"></a></p><p><em>iPhone 7 hỗ trợ chống nước tiêu chuẩn IP67</em></p><p>Tuy nhiên Apple cũng không khuyến cáo người dùng mang theo thiết bị đi biển hay thường xuyên nhúng thiết bị xuống nước.</p><p><strong><strong>Màn hình đẹp hơn</strong></strong></p><p>Vẫn là kích thước 4.7 inch và vẫn có công nghệ cảm ứng lực 3D Touch nhưng giờ đây màn hình của iPhone 7 đã hỗ trợ không gian màu 3P giúp máy có độ phủ màu rộng hơn 25% so với thế hệ iPhone cũ.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-712.jpg"><img alt="Màn hình hiển thị đẹp hơn" data-original="https://cdn1.tgdd.vn/Products/Images/42/74110/iphone-712.jpg" title="Màn hình hiển thị đẹp hơn" src="https://cdn1.tgdd.vn/Products/Images/42/74110/iphone-712.jpg" class="fr-dii fr-draggable"></a></p><p><em>Màn hình hiển thị đẹp hơn</em></p><p><strong><strong>Hiệu năng hàng đầu</strong></strong></p><p>Con chip Apple A9 vẫn đang một trong những con chip có hiệu năng tốt nhất trên thị trường và với iPhone 7 thì Apple đã nâng cấp lên thế hệ mới là Apple A10 với tốc độ nhanh hơn 40% so với thế hệ cũ nhưng điện năng tiêu thụ lại giảm 20%.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-78.jpg"><img alt="Con chip mới mạnh hơn, tiết kiệm năng lượng hơn" data-original="https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-78.jpg" title="Con chip mới mạnh hơn, tiết kiệm năng lượng hơn" src="https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-78.jpg" class="fr-dii fr-draggable"></a></p><p><em>Con chip mới mạnh hơn, tiết kiệm năng lượng hơn</em></p><p>Ngoài ra thì con chip Apple A10 cũng cho hiệu năng đồ họa tăng 50% so với Apple A9.</p><p><strong><strong>Camera được nâng cấp mạnh mẽ</strong></strong></p><p>Camera là điểm được Apple nâng cấp nhiều nhất trên bộ đôi iPhone mới. iPhone 7 sở hữu camera chính vẫn có độ phân giải 12 MP nhưng khẩu độ đã được tăng lên F/1.8 cùng khả năng chống rung quang học 3 trục OIS được tích hợp sẵn.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-79.jpg"><img alt="Camera với ống kính 6 thành phần" data-original="https://cdn.tgdd.vn/Products/Images/42/74110/iphone-79.jpg" title="Camera với ống kính 6 thành phần" src="https://cdn.tgdd.vn/Products/Images/42/74110/iphone-79.jpg" class="fr-dii fr-draggable"></a></p><p><em>Camera với ống kính 6 thành phần</em></p><p>Máy cũng được tích hợp sẵn con chip xử lý hình ảnh riêng đến từ Apple với tốc độ nhanh hơn 60% thế hệ cũ trong khi điện năng lại tiết kiệm hơn 30%.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-71-2.jpg"><img alt="Một hình ảnh được chụp với điều kiện ban ngày" data-original="https://cdn2.tgdd.vn/Products/Images/42/74110/iphone-71-2.jpg" title="Một hình ảnh được chụp với điều kiện ban ngày" src="https://cdn2.tgdd.vn/Products/Images/42/74110/iphone-71-2.jpg" class="fr-dii fr-draggable"></a></p><p><em>Một hình ảnh được chụp với điều kiện ban ngày</em></p><p>Một tính năng nổi bật nữa lần đầu tiên xuất hiện trên smartphone là khả năng quay video 4K 60 khung hình trên giây trên bộ đôi iPhone mới.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-72-2.jpg"><img alt="Hỉnh ảnh khác được chụp từ iPhone 7" data-original="https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-72-2.jpg" src="https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-72-2.jpg" class="fr-dii fr-draggable"></a></p><p><em>Hỉnh ảnh khác được chụp từ iPhone 7</em></p><p><strong><strong>Jack cắm tai nghe đã không còn</strong></strong></p><p>Apple đã loại bỏ đi jack cắm tai nghe truyền thống trên bộ đôi iPhone mới và thay vào đó là iPhone 7 sẽ sở hữu cho mình cặp loa kép trên dưới hứa hẹn sẽ cho chất lượng âm thanh tốt hơn.</p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-74-1.jpg"><img alt="Jack cắm tai nghe đã bị loại bỏ" data-original="https://cdn1.tgdd.vn/Products/Images/42/74110/iphone-74-1.jpg" title="Jack cắm tai nghe đã bị loại bỏ" src="https://cdn1.tgdd.vn/Products/Images/42/74110/iphone-74-1.jpg" class="fr-dii fr-draggable"></a></p><p><em>Jack cắm tai nghe đã bị loại bỏ</em></p><p><a href="https://www.thegioididong.com/images/42/74110/iphone-77.jpg"><img alt="Trải nghiệm âm thanh hay hơn" data-original="https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-77.jpg" title="Trải nghiệm âm thanh hay hơn" src="https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-77.jpg" class="fr-dii fr-draggable"></a></p><p><em>Trải nghiệm âm thanh hay hơn</em></p><p>Apple iPhone 7 thực sự là smartphone đáng sở hữu nhất trên thị trường vào dịp mua sắm cuối năm.</p>', '<table><tbody><tr><td>SKU</td><td>AP069ELAA1S1K3VNAMZ-2985296</td></tr><tr><td>Điều kiện</td><td>Mới</td></tr><tr><td>Screen Size (inches)</td><td>4.7</td></tr><tr><td>Mẫu mã</td><td>apple iphone 7</td></tr><tr><td>Hệ điều hành</td><td>iOS 10</td></tr><tr><td>Processor Type</td><td>Quad-core</td></tr><tr><td>Kích thước sản phẩm (D x R x C cm)</td><td>13.8 x 6.7 x 0.7</td></tr><tr><td>Trọng lượng (KG)</td><td>0.138</td></tr><tr><td>Screen Type</td><td>IPS LCD</td></tr><tr><td>Bộ nhớ trong</td><td>32GB</td></tr><tr><td>Thời gian bảo hành</td><td>12 tháng</td></tr><tr><td>Loại hình bảo hành</td><td>Bằng Phiếu bảo hành và Hóa đơn</td></tr></tbody></table>', 10, 1, 1, '2016-10-03 00:17:55', '2016-11-10 03:13:56', NULL),
(18, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '-xe-jeep-dia-hinh-dieu-khien-tu-xa--', 61, 122550, '<h2>Giới thiệu sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</h2><h1><strong>Xe Jeep Địa Hình Điều Khiển Từ Xa</strong></h1><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" class="fr-dii fr-draggable"></p><p>xe Jeep địa hình là sản phẩm đồ chơi mô hình điều khiển mới nhất hiện nay, vỏ bền, kiểu dáng đẹp, bắt mắt.</p><p>Chiếc ôtô được thiết kế kiểu dáng hầm hố và hiện đại.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" class="fr-dii fr-draggable"></p><p>Sản phẩm dành cho những quý ông đam mê ô tô đồng thời sẽ là món đồ chơi giúp bé được thỏa sức thể hiện sự khéo léo và ham khám phá của mình khi điều khiên ô tô tiến, lùi, hay rẽ trái rẽ phải.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" class="fr-dii fr-draggable"></p><p><em><strong>xe Jeep địa hình</strong></em> là sản phẩm dành cho những ai yêu thích xe và môn thể thao leo núi. Dành cho bé thích khám phá, năng động.</p><p>Xe được thiết kế &nbsp;giống như xe mô hình tĩnh nhưng có thể điều khiển được.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" class="fr-dii fr-draggable"></p><p>Vô lăng lái xe thiết kế như thật, điều khiển vô cùng nhạy.</p><p>1 bộ sản phẩm gồm: 1 xe, 1 điều khiển, 1 dây sạc, pin.</p><p>Xe có thể chạy bằng pin hoặc sạc điện.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" class="fr-dii fr-draggable"></p><p><strong>Thông tin sản phẩm:</strong></p><p><em>Thiết kế giống như mô hình xe tĩnh<br>Có thể điều khiển được<br>Xe chạy bằng pin hoặc sạc điện<br>Chất liệu nhựa<br>An toàn cho bé<br>Địa Điểm Vàng giao sản phẩm cho khách hàng<br>Áp dụng cho sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</em></p>', '<table><tbody><tr><td>SKU</td><td>OE680TBAA1D07SVNAMZ-2125211</td></tr><tr><td>Mẫu mã</td><td>Thế giới đồ chơi 24h-MHXJ MT02</td></tr><tr><td>Kích thước sản phẩm (D x R x C cm)</td><td>18x12x10</td></tr><tr><td>Trọng lượng (KG)</td><td>0.3</td></tr><tr><td>Thời gian bảo hành</td><td>1 tháng</td></tr><tr><td>Loại hình bảo hành</td><td>Bằng Hóa đơn mua hàng</td></tr></tbody></table>', 100, 1, 7, '2016-11-09 20:21:49', '2016-11-26 05:45:14', NULL),
(19, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '-xe-jeep-dia-hinh-dieu-khien-tu-xa--', 61, 122550, '<h2>Giới thiệu sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</h2><h1><strong>Xe Jeep Địa Hình Điều Khiển Từ Xa</strong></h1><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" class="fr-dii fr-draggable"></p><p>xe Jeep địa hình là sản phẩm đồ chơi mô hình điều khiển mới nhất hiện nay, vỏ bền, kiểu dáng đẹp, bắt mắt.</p><p>Chiếc ôtô được thiết kế kiểu dáng hầm hố và hiện đại.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" class="fr-dii fr-draggable"></p><p>Sản phẩm dành cho những quý ông đam mê ô tô đồng thời sẽ là món đồ chơi giúp bé được thỏa sức thể hiện sự khéo léo và ham khám phá của mình khi điều khiên ô tô tiến, lùi, hay rẽ trái rẽ phải.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" class="fr-dii fr-draggable"></p><p><em><strong>xe Jeep địa hình</strong></em> là sản phẩm dành cho những ai yêu thích xe và môn thể thao leo núi. Dành cho bé thích khám phá, năng động.</p><p>Xe được thiết kế &nbsp;giống như xe mô hình tĩnh nhưng có thể điều khiển được.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" class="fr-dii fr-draggable"></p><p>Vô lăng lái xe thiết kế như thật, điều khiển vô cùng nhạy.</p><p>1 bộ sản phẩm gồm: 1 xe, 1 điều khiển, 1 dây sạc, pin.</p><p>Xe có thể chạy bằng pin hoặc sạc điện.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" class="fr-dii fr-draggable"></p><p><strong>Thông tin sản phẩm:</strong></p><p><em>Thiết kế giống như mô hình xe tĩnh<br>Có thể điều khiển được<br>Xe chạy bằng pin hoặc sạc điện<br>Chất liệu nhựa<br>An toàn cho bé<br>Địa Điểm Vàng giao sản phẩm cho khách hàng<br>Áp dụng cho sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</em></p>', '<table><tbody><tr><td>SKU</td><td>OE680TBAA1D07SVNAMZ-2125211</td></tr><tr><td>Mẫu mã</td><td>Thế giới đồ chơi 24h-MHXJ MT02</td></tr><tr><td>Kích thước sản phẩm (D x R x C cm)</td><td>18x12x10</td></tr><tr><td>Trọng lượng (KG)</td><td>0.3</td></tr><tr><td>Thời gian bảo hành</td><td>1 tháng</td></tr><tr><td>Loại hình bảo hành</td><td>Bằng Hóa đơn mua hàng</td></tr></tbody></table>', 100, 1, 7, '2016-11-09 20:21:49', '2016-11-26 05:45:14', NULL),
(20, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '-xe-jeep-dia-hinh-dieu-khien-tu-xa--', 61, 122550, '<h2>Giới thiệu sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</h2><h1><strong>Xe Jeep Địa Hình Điều Khiển Từ Xa</strong></h1><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" class="fr-dii fr-draggable"></p><p>xe Jeep địa hình là sản phẩm đồ chơi mô hình điều khiển mới nhất hiện nay, vỏ bền, kiểu dáng đẹp, bắt mắt.</p><p>Chiếc ôtô được thiết kế kiểu dáng hầm hố và hiện đại.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" class="fr-dii fr-draggable"></p><p>Sản phẩm dành cho những quý ông đam mê ô tô đồng thời sẽ là món đồ chơi giúp bé được thỏa sức thể hiện sự khéo léo và ham khám phá của mình khi điều khiên ô tô tiến, lùi, hay rẽ trái rẽ phải.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" class="fr-dii fr-draggable"></p><p><em><strong>xe Jeep địa hình</strong></em> là sản phẩm dành cho những ai yêu thích xe và môn thể thao leo núi. Dành cho bé thích khám phá, năng động.</p><p>Xe được thiết kế &nbsp;giống như xe mô hình tĩnh nhưng có thể điều khiển được.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" class="fr-dii fr-draggable"></p><p>Vô lăng lái xe thiết kế như thật, điều khiển vô cùng nhạy.</p><p>1 bộ sản phẩm gồm: 1 xe, 1 điều khiển, 1 dây sạc, pin.</p><p>Xe có thể chạy bằng pin hoặc sạc điện.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" class="fr-dii fr-draggable"></p><p><strong>Thông tin sản phẩm:</strong></p><p><em>Thiết kế giống như mô hình xe tĩnh<br>Có thể điều khiển được<br>Xe chạy bằng pin hoặc sạc điện<br>Chất liệu nhựa<br>An toàn cho bé<br>Địa Điểm Vàng giao sản phẩm cho khách hàng<br>Áp dụng cho sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</em></p>', '<table><tbody><tr><td>SKU</td><td>OE680TBAA1D07SVNAMZ-2125211</td></tr><tr><td>Mẫu mã</td><td>Thế giới đồ chơi 24h-MHXJ MT02</td></tr><tr><td>Kích thước sản phẩm (D x R x C cm)</td><td>18x12x10</td></tr><tr><td>Trọng lượng (KG)</td><td>0.3</td></tr><tr><td>Thời gian bảo hành</td><td>1 tháng</td></tr><tr><td>Loại hình bảo hành</td><td>Bằng Hóa đơn mua hàng</td></tr></tbody></table>', 100, 1, 7, '2016-11-09 20:21:49', '2016-11-26 05:45:14', NULL),
(21, 'Máy bay điều khiển từ xa No.901 (Đỏ)sds', 'may-bay-dieu-khien-tu-xa-no.901-(do)sds', 60, 124447, '<h1><br></h1><h1>Máy bay điều khiển từ xa No.901 là sản phẩm đồ chơi giá rẻ nhưng rất được ưa chuộng tại các nước Châu Âu như Anh và Tây Ban Nha. Với những tính năng như chống chịu va đập, thời gian bay 5-8 phút, No.901 chính là sản phẩm máy bay điều khiển từ xa giá rẻ tốt nhất.</h1><p>&nbsp;</p><p>TÍNH NĂNG CƠ BẢN</p><p>. Sản phẩm có khả năng chịu va đập mạnh<br>. Độ đạt được khá lớn 8-12m đối với một sản phẩm máy bay đồ chơi giá rẻ<br>. Thiết kế thông minh, sạc pin trực tiếp cho máy bay từ giắc cắm trên bộ điều khiển mà không thông qua bất kỳ thiết bị dây cắm nào cả.</p><p>&nbsp;</p><p>Một số lưu ý khi sử dụng sản phẩm&nbsp;</p><p>&nbsp;1. Do sản phẩm là máy bay mini, nên độ cân bằng của máy bay chỉ tương đối, nên khi mới chơi, bạn chưa quen điều khiển máy bay bạn sẽ làm máy bay rơi nhiều lần, nhưng bạn yên tâm máy bay có khả năng chịu va đập mạnh nên bạn không lo bị hư hỏng nhé</p><p>&nbsp;2. Sản phẩm có thể điều hướng sang trái hay sang phải nhưng để làm được điều này, bạn cần phải điều khiển thành thạo để máy bay có thể bay thăng bằng trên không trung, sau đó bạn ấn vào nút R hay L rồi đồng thời gạt cần điều khiển phía tay trái để máy bay bay sang hướng bên phải hay bên trái. Do đó bạn phải cần chơi nhiều lần mới điều chỉnh được nhé.</p><p>3. Bạn nên xem kỹ video mở hộp và hướng dẫn sử dụng ở dưới bài viết<br><br>Nếu bạn có thắc mắc gì xin liên hệ trực tiếp với chúng tôi để được tư vấn tốt nhất</p>', '<blockquote><p>Nguyen the bao</p><p>Qua dep</p></blockquote>', 100, 1, 7, '2016-09-15 02:16:43', '2016-11-26 05:45:11', NULL),
(22, 'Apple iPhone 6S 64GB (Vàng hồng) - Hàng nhập khẩu', 'apple-iphone-6s-64gb-(vang-hong)---hang-nhap-khau', 59, 11990000, '<h1><img class="fr-dib fr-draggable fr-fil" src="http://localhost/cuahangbansi/public/assets/uploads/product_20161003-1475478867.5269.jpg" style="width: 300px;"></h1><h1>Máy bay điều khiển từ xa No.901 là sản phẩm đồ chơi giá rẻ nhưng rất được ưa chuộng tại các nước Châu Âu như Anh và Tây Ban Nha. Với những tính năng như chống chịu va đập, thời gian bay 5-8 phút, No.901 chính là sản phẩm máy bay điều khiển từ xa giá rẻ tốt nhất.</h1><p>&nbsp;</p><p>TÍNH NĂNG CƠ BẢN</p><p>. Sản phẩm có khả năng chịu va đập mạnh<br>. Độ đạt được khá lớn 8-12m đối với một sản phẩm máy bay đồ chơi giá rẻ<br>. Thiết kế thông minh, sạc pin trực tiếp cho máy bay từ giắc cắm trên bộ điều khiển mà không thông qua bất kỳ thiết bị dây cắm nào cả.</p><p>&nbsp;</p><p>Một số lưu ý khi sử dụng sản phẩm&nbsp;</p><p>&nbsp;1. Do sản phẩm là máy bay mini, nên độ cân bằng của máy bay chỉ tương đối, nên khi mới chơi, bạn chưa quen điều khiển máy bay bạn sẽ làm máy bay rơi nhiều lần, nhưng bạn yên tâm máy bay có khả năng chịu va đập mạnh nên bạn không lo bị hư hỏng nhé</p><p>&nbsp;2. Sản phẩm có thể điều hướng sang trái hay sang phải nhưng để làm được điều này, bạn cần phải điều khiển thành thạo để máy bay có thể bay thăng bằng trên không trung, sau đó bạn ấn vào nút R hay L rồi đồng thời gạt cần điều khiển phía tay trái để máy bay bay sang hướng bên phải hay bên trái. Do đó bạn phải cần chơi nhiều lần mới điều chỉnh được nhé.</p><p>3. Bạn nên xem kỹ video mở hộp và hướng dẫn sử dụng ở dưới bài viết<br><br>Nếu bạn có thắc mắc gì xin liên hệ trực tiếp với chúng tôi để được tư vấn tốt nhất</p>', '<p>. 01 máy bay Mingji 901</p><p>. 01 bộ điều khiển từ xa</p>', 99, 1, 2, '2016-09-15 02:16:43', '2016-11-09 20:16:32', NULL),
(23, ' Xe Jeep Địa Hình Điều Khiển Từ Xa  ', '-xe-jeep-dia-hinh-dieu-khien-tu-xa--', 61, 122550, '<h2>Giới thiệu sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</h2><h1><strong>Xe Jeep Địa Hình Điều Khiển Từ Xa</strong></h1><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%283%29.jpg" class="fr-dii fr-draggable"></p><p>xe Jeep địa hình là sản phẩm đồ chơi mô hình điều khiển mới nhất hiện nay, vỏ bền, kiểu dáng đẹp, bắt mắt.</p><p>Chiếc ôtô được thiết kế kiểu dáng hầm hố và hiện đại.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%282%29.jpg" class="fr-dii fr-draggable"></p><p>Sản phẩm dành cho những quý ông đam mê ô tô đồng thời sẽ là món đồ chơi giúp bé được thỏa sức thể hiện sự khéo léo và ham khám phá của mình khi điều khiên ô tô tiến, lùi, hay rẽ trái rẽ phải.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa_%284%29.jpg" class="fr-dii fr-draggable"></p><p><em><strong>xe Jeep địa hình</strong></em> là sản phẩm dành cho những ai yêu thích xe và môn thể thao leo núi. Dành cho bé thích khám phá, năng động.</p><p>Xe được thiết kế &nbsp;giống như xe mô hình tĩnh nhưng có thể điều khiển được.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien.jpg" class="fr-dii fr-draggable"></p><p>Vô lăng lái xe thiết kế như thật, điều khiển vô cùng nhạy.</p><p>1 bộ sản phẩm gồm: 1 xe, 1 điều khiển, 1 dây sạc, pin.</p><p>Xe có thể chạy bằng pin hoặc sạc điện.</p><p><img alt="Xe Jeep Địa Hình Điều Khiển Từ Xa" data-original="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" title="Xe Jeep Địa Hình Điều Khiển Từ Xa" src="http://dathangsi.vn/upload/store/images/xe-jeep-dieu-khien-tu-xa.jpg" class="fr-dii fr-draggable"></p><p><strong>Thông tin sản phẩm:</strong></p><p><em>Thiết kế giống như mô hình xe tĩnh<br>Có thể điều khiển được<br>Xe chạy bằng pin hoặc sạc điện<br>Chất liệu nhựa<br>An toàn cho bé<br>Địa Điểm Vàng giao sản phẩm cho khách hàng<br>Áp dụng cho sản phẩm Xe Jeep Địa Hình Điều Khiển Từ Xa</em></p>', '<table><tbody><tr><td>SKU</td><td>OE680TBAA1D07SVNAMZ-2125211</td></tr><tr><td>Mẫu mã</td><td>Thế giới đồ chơi 24h-MHXJ MT02</td></tr><tr><td>Kích thước sản phẩm (D x R x C cm)</td><td>18x12x10</td></tr><tr><td>Trọng lượng (KG)</td><td>0.3</td></tr><tr><td>Thời gian bảo hành</td><td>1 tháng</td></tr><tr><td>Loại hình bảo hành</td><td>Bằng Hóa đơn mua hàng</td></tr></tbody></table>', 100, 1, 7, '2016-11-09 20:21:49', '2016-11-26 05:45:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 17, '2016-10-03 00:13:20', '2016-10-03 00:13:20', NULL),
(8, 17, 41, '2016-11-09 19:18:42', '2016-11-09 19:18:42', NULL),
(10, 18, 62, '2016-11-09 20:22:22', '2016-11-09 20:22:22', NULL),
(11, 18, 63, '2016-11-09 20:22:22', '2016-11-09 20:22:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_manufacturer`
--

CREATE TABLE `product_manufacturer` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_manufacturer`
--

INSERT INTO `product_manufacturer` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Apple', NULL, '2016-08-08 08:08:02', '2016-09-15 07:22:51', NULL),
(2, 'Microsoft', NULL, '2016-08-08 08:08:02', '2016-10-03 09:19:37', NULL),
(3, 'Honda', NULL, '2016-08-08 08:08:02', '2016-10-03 09:19:37', NULL),
(4, 'BMW', NULL, '2016-08-08 08:08:02', '2016-10-03 09:19:37', NULL),
(5, 'Samsung', NULL, '2016-08-08 08:08:02', '2016-10-03 09:19:37', NULL),
(6, 'Toyota', NULL, '2016-10-04 01:36:32', '2016-10-04 01:36:32', NULL),
(7, 'Nhựa Long Thành', NULL, '2016-10-04 02:07:30', '2016-10-04 02:07:30', NULL),
(8, 'Cocacola', NULL, '2016-10-05 00:41:20', '2016-10-05 00:41:20', NULL),
(9, 'Pepsi', NULL, '2016-10-05 00:42:03', '2016-10-05 00:42:03', NULL),
(10, 'Lụa Thái Tuấn', NULL, '2016-10-05 00:42:41', '2016-10-06 23:23:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_promotion`
--

CREATE TABLE `product_promotion` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `discount` float NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `money_has_discount` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `review` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `name`, `email`, `content`, `review`, `like`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 17, 'Nguyễn Thế Bảo', 'thebaoit@gmail.com', 'Sản phẩm đẹp', 5, 7, '2016-10-13 23:50:50', '2016-10-18 20:39:00', NULL),
(2, 2, 'Tesst', 'teas@tes.com', 'Test danh gia', 5, 14, '2016-10-18 20:07:31', '2016-10-19 03:56:12', NULL),
(3, 2, 'Tesst 22', 'teas@tes.com', 'Test danh gia', 4, 8, '2016-10-18 20:07:31', '2016-10-19 03:56:58', NULL),
(4, 2, 'Cais danh gia', 'danh@gia', 'Cais danh gia', 5, 1, '2016-10-18 20:59:46', '2016-11-08 03:09:43', NULL),
(5, 18, 'Bảo', 'thebaoit@gmail.com', 'Giá mắc quá shop ơi', 5, 0, '2016-11-09 20:23:26', '2016-11-09 20:23:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Điện thoại di động', '2016-08-08 08:08:02', '2016-10-03 09:20:53', NULL),
(2, 'Xe hơi', '2016-08-08 08:08:02', '2016-10-03 09:21:07', NULL),
(3, 'Laptop', '2016-08-08 08:08:02', '2016-10-03 09:21:07', NULL),
(4, 'Nhà sách', '2016-10-04 01:16:35', '2016-10-04 01:16:35', NULL),
(5, 'Dụng cụ gia đình', '2016-10-04 01:18:03', '2016-10-04 01:18:03', NULL),
(6, 'Thiết bị văn phòng', '2016-10-04 01:22:25', '2016-10-04 01:22:25', NULL),
(7, 'Đồ nhựa', '2016-10-04 01:23:24', '2016-10-04 01:23:24', NULL),
(8, 'Tủ lạnh', '2016-10-05 21:29:49', '2016-10-06 23:23:05', NULL),
(9, 'Đồ chơi', '2016-11-09 20:18:44', '2016-11-09 20:18:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `possition` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `key`, `value`, `group`, `possition`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'intro_text', 'Nước giải khác online', 'basic', 0, '2016-10-08 05:50:23', '2016-10-08 05:50:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'thebaoit', 'thebaoit@gmail.com', '$2y$10$1XcfMZYsTCkk32ShIzFNT.fQyFX6Dq15s0VQzZkuYz6JCJ.V.Ci3C', 'qbeK0zg2WfQstTfOlkotZM6YUDEPR3fNq4NsMYiC3mZhDJueSYPVrKJWE1DE', '2016-08-05 02:58:12', '2016-08-04 21:37:24', NULL),
(2, 'ntbao', 'bao@poste-vn.com', '$2y$10$3CLYmtThdE2fx9.d/8yp4eQ3SQsWmPFSa8oWgDSHDUQ6vnvQSrG0q', 'b6mAt0avtLDOAMJofum74hA7SAQKuRwzbzleIcR1z5kG8v3RJWxu5jNCH8eN', '2016-08-04 21:38:17', '2016-08-07 19:58:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `name`, `link`, `view`, `like`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Hai xe khách đấu đầu do vượt ẩu', 'https://www.youtube.com/watch?v=YLMdtvs5t4M', 0, 0, '2016-11-09 02:03:01', '2017-05-21 05:45:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layouts`
--
ALTER TABLE `layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_image`
--
ALTER TABLE `news_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_manufacturer`
--
ALTER TABLE `product_manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_promotion`
--
ALTER TABLE `product_promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `layouts`
--
ALTER TABLE `layouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news_category`
--
ALTER TABLE `news_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news_image`
--
ALTER TABLE `news_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product_manufacturer`
--
ALTER TABLE `product_manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_promotion`
--
ALTER TABLE `product_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;