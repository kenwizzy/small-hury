-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2022 at 06:27 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buyandsell`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(11,5) DEFAULT NULL,
  `latitude` double(11,5) DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nigeria',
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Abuja',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `street`, `name`, `longitude`, `latitude`, `pincode`, `country`, `state`, `city`, `landmark`, `default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'No 66 old yaba road', 'Office', 7.60000, 3.70000, NULL, 'Nigeria', 'lagos', 'Yaba', 'Adekunle Bus stop', 1, '2022-02-15 06:29:23', '2022-02-15 06:29:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'default', 1, '2022-02-15 06:28:32', '2022-02-15 06:28:32'),
(2, 'size', 1, '2022-02-15 06:28:32', '2022-02-15 06:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_val_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `attribute_val_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'default', 1, '2022-02-15 06:28:33', '2022-02-15 06:28:33'),
(2, 2, 'small', 1, '2022-02-15 06:28:33', '2022-02-15 06:28:33'),
(3, 2, 'medium', 1, '2022-02-15 06:28:33', '2022-02-15 06:28:33'),
(4, 2, 'large', 1, '2022-02-15 06:28:33', '2022-02-15 06:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `on_sales` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE `cart_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `cat_img_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'This is the image that will displayed for a particular category',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `cat_img_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', 0, NULL, 1, '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(2, 'Clothings', 'cloths', 0, NULL, 1, '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(3, 'Skin Care', 'skin-care', 0, NULL, 1, '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(4, 'Pasteries', 'pasteries', 0, NULL, 1, '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(5, 'Rice', 'rice', 0, NULL, 1, '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(6, 'Ofada Rice', 'ofade-rice', 5, NULL, 1, '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(7, 'Chinese Rice', 'chinese-rice', 5, NULL, 1, '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(8, 'Abakaliki Rice', 'abakaloki-rice', 5, NULL, 1, '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(9, 'Laptops', 'laptops', 1, NULL, 1, '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(10, 'Smart Tvs', 'Smart-tvs', 1, NULL, 1, '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(11, 'Sound Systems', 'sound-systems', 1, NULL, 1, '2022-02-15 06:28:35', '2022-02-15 06:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_costs`
--

CREATE TABLE `delivery_costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price_range` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(10,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_costs`
--

INSERT INTO `delivery_costs` (`id`, `price_range`, `cost`, `created_at`, `updated_at`) VALUES
(1, '0 to 999', '200.00', NULL, NULL),
(2, '1000 to 4999', '500.00', NULL, NULL),
(3, '5000 to 9999', '800.00', NULL, NULL),
(4, '10000 to 19999', '1200.00', NULL, NULL),
(5, '20000 to 49999', '1800.00', NULL, NULL),
(6, '50000 to 99999', '2500.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `time_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`id`, `order_id`, `delivery_contact`, `address_id`, `delivery_phone`, `delivery_note`, `delivery_reference`, `created_at`, `updated_at`, `payment_method`, `delivery_date`, `time_interval`) VALUES
(1, 1000000, '08076884964', 1, '08076884964', 'Please Call me when coming', NULL, NULL, NULL, 'CARD', '2022-03-01', '8AM - 12AM');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

CREATE TABLE `delivery_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_type`
--

INSERT INTO `delivery_type` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pickup', 1, NULL, NULL),
(2, 'Delivery', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` decimal(15,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '5.00', 1, '2022-02-15 06:28:33', '2022-02-15 06:28:33'),
(2, '10.00', 1, '2022-02-15 06:28:33', '2022-02-15 06:28:33'),
(3, '15.00', 1, '2022-02-15 06:28:33', '2022-02-15 06:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lgas`
--

CREATE TABLE `lgas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lgas`
--

INSERT INTO `lgas` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Aba North', NULL, NULL),
(2, 1, 'Aba South ', NULL, NULL),
(3, 1, 'Arochukwu', NULL, NULL),
(4, 1, 'Bende', NULL, NULL),
(5, 1, 'Ikwuano', NULL, NULL),
(6, 1, 'Isiala-Ngwa North', NULL, NULL),
(7, 1, 'Isiala-Ngwa South', NULL, NULL),
(8, 1, 'Isuikwato', NULL, NULL),
(9, 1, 'Ngwa', NULL, NULL),
(10, 1, ' Obi Nwa', NULL, NULL),
(11, 1, 'Ohafia', NULL, NULL),
(12, 1, 'Osisioma', NULL, NULL),
(13, 1, 'Ugwunagbo', NULL, NULL),
(14, 1, 'Ukwa East', NULL, NULL),
(15, 1, 'Ukwa West', NULL, NULL),
(16, 1, 'Umuahia North', NULL, NULL),
(17, 1, 'Umuahia South', NULL, NULL),
(18, 1, 'Umu-Neochi', NULL, NULL),
(19, 2, 'Demsa', NULL, NULL),
(20, 2, 'Fufore', NULL, NULL),
(21, 2, 'Ganaye', NULL, NULL),
(22, 2, 'Gireri', NULL, NULL),
(23, 2, 'Gombi', NULL, NULL),
(24, 2, 'Guyuk', NULL, NULL),
(25, 2, 'Hong', NULL, NULL),
(26, 2, 'Jada', NULL, NULL),
(27, 2, 'Lamurde', NULL, NULL),
(28, 2, 'Madagali', NULL, NULL),
(29, 2, 'Maiha', NULL, NULL),
(30, 2, 'Mayo-Belwa', NULL, NULL),
(31, 2, 'Michika', NULL, NULL),
(32, 2, 'Mubi North', NULL, NULL),
(33, 2, 'Mubi South', NULL, NULL),
(34, 2, 'Numan', NULL, NULL),
(35, 2, 'Shelleng', NULL, NULL),
(36, 2, 'Song', NULL, NULL),
(37, 2, 'Toungo', NULL, NULL),
(38, 2, 'Yola North', NULL, NULL),
(39, 2, 'Yola South', NULL, NULL),
(40, 3, 'Abak', NULL, NULL),
(41, 3, 'Eastern Obolo', NULL, NULL),
(42, 3, 'Eket', NULL, NULL),
(43, 3, 'Esit Eket', NULL, NULL),
(44, 3, 'Essien Udim', NULL, NULL),
(45, 3, 'Etim Ekpo', NULL, NULL),
(46, 3, 'Etinan', NULL, NULL),
(47, 3, 'Ibeno', NULL, NULL),
(48, 3, 'Ibesikpo Asutan', NULL, NULL),
(49, 3, 'Ibiono Ibom', NULL, NULL),
(50, 3, 'Ika', NULL, NULL),
(51, 3, 'Ikono', NULL, NULL),
(52, 3, 'Ikot Abasi', NULL, NULL),
(53, 3, 'Ikot Ekpene', NULL, NULL),
(54, 3, 'Ini', NULL, NULL),
(55, 3, 'Itu', NULL, NULL),
(56, 3, 'Mbo', NULL, NULL),
(57, 3, 'Mkpat Enin', NULL, NULL),
(58, 3, 'Nsit Atai', NULL, NULL),
(59, 3, 'Nsit Ibom', NULL, NULL),
(60, 3, 'Nsit Ubium', NULL, NULL),
(61, 3, 'Obot Akara', NULL, NULL),
(62, 3, 'Okobo', NULL, NULL),
(63, 3, 'Onna', NULL, NULL),
(64, 3, 'Oron', NULL, NULL),
(65, 3, 'Orok Anam', NULL, NULL),
(66, 3, 'Udung Uko', NULL, NULL),
(67, 3, 'Ukanafun', NULL, NULL),
(68, 3, 'Uruan', NULL, NULL),
(69, 3, 'Urue-Offong/Oruko', NULL, NULL),
(70, 3, 'Uyo', NULL, NULL),
(71, 4, 'Aguata', NULL, NULL),
(72, 4, 'Anambra East', NULL, NULL),
(73, 4, 'Anambra West', NULL, NULL),
(74, 4, 'Anaocha', NULL, NULL),
(75, 4, 'Awka North', NULL, NULL),
(76, 4, 'Awka South', NULL, NULL),
(77, 4, 'Ayamelum', NULL, NULL),
(78, 4, 'Dunukofia', NULL, NULL),
(79, 4, 'Ekwusigo', NULL, NULL),
(80, 4, 'Idemili North', NULL, NULL),
(81, 4, 'Idemili South', NULL, NULL),
(82, 4, 'ihiala', NULL, NULL),
(83, 4, 'Njikoka', NULL, NULL),
(84, 4, 'Nnewi North', NULL, NULL),
(85, 4, 'Nnewi South', NULL, NULL),
(86, 4, 'Ogbaru', NULL, NULL),
(87, 4, 'Onitsha North', NULL, NULL),
(88, 4, 'Onitsha South', NULL, NULL),
(89, 4, 'Onumba N', NULL, NULL),
(90, 4, 'Onumba South', NULL, NULL),
(91, 4, 'Oyi', NULL, NULL),
(92, 5, 'Alkaleri', NULL, NULL),
(93, 5, 'Bauchi', NULL, NULL),
(94, 5, 'Bogoro', NULL, NULL),
(95, 5, 'Damban', NULL, NULL),
(96, 5, 'Darazo', NULL, NULL),
(97, 5, 'Dass', NULL, NULL),
(98, 5, 'Ganjuwa', NULL, NULL),
(99, 5, 'Giade', NULL, NULL),
(100, 5, 'Itas/Gadau', NULL, NULL),
(101, 5, 'Jama\"are', NULL, NULL),
(102, 5, 'Katagum', NULL, NULL),
(103, 5, 'Kirfi', NULL, NULL),
(104, 5, 'Misau', NULL, NULL),
(105, 5, 'Ningi', NULL, NULL),
(106, 5, 'Shira', NULL, NULL),
(107, 5, 'Tafawa-Balewa', NULL, NULL),
(108, 5, 'Toro', NULL, NULL),
(109, 5, 'Warji', NULL, NULL),
(110, 5, 'Zaki', NULL, NULL),
(111, 6, 'Brass', NULL, NULL),
(112, 6, 'Ekeremor', NULL, NULL),
(113, 6, 'Kolokuma/Opokuma', NULL, NULL),
(114, 6, 'Nembe', NULL, NULL),
(115, 6, 'Ogbia', NULL, NULL),
(116, 6, 'Sagbama', NULL, NULL),
(117, 6, 'Southern Jaw', NULL, NULL),
(118, 6, 'Yenegoa', NULL, NULL),
(119, 7, 'Ado', NULL, NULL),
(120, 7, 'Agatu', NULL, NULL),
(121, 7, 'Apa', NULL, NULL),
(122, 7, 'Buruku', NULL, NULL),
(123, 7, 'Gboko', NULL, NULL),
(124, 7, 'Guma', NULL, NULL),
(125, 7, 'Gwer East', NULL, NULL),
(126, 7, 'Gwer West', NULL, NULL),
(127, 7, 'Katsina-Ala', NULL, NULL),
(128, 7, 'Konshisha', NULL, NULL),
(129, 7, 'Kwande', NULL, NULL),
(130, 7, 'Logo', NULL, NULL),
(131, 7, 'Markurdi', NULL, NULL),
(132, 7, 'Obi', NULL, NULL),
(133, 7, 'Ogbadipo', NULL, NULL),
(134, 7, 'Oju', NULL, NULL),
(135, 7, 'Okpokwu', NULL, NULL),
(136, 7, 'Ohimini', NULL, NULL),
(137, 7, 'Oturkpo', NULL, NULL),
(138, 7, 'Tarka', NULL, NULL),
(139, 7, 'Ukum', NULL, NULL),
(140, 7, 'Ushongo', NULL, NULL),
(141, 7, 'Vandeikya', NULL, NULL),
(142, 8, 'Abadam', NULL, NULL),
(143, 8, 'Askira/Uba', NULL, NULL),
(144, 8, 'Bama', NULL, NULL),
(145, 8, 'Bayo', NULL, NULL),
(146, 8, 'Biu', NULL, NULL),
(147, 8, 'Chibok', NULL, NULL),
(148, 8, 'Damboa', NULL, NULL),
(149, 8, 'Dikwa', NULL, NULL),
(150, 8, 'Gubio', NULL, NULL),
(151, 8, 'Guzamala', NULL, NULL),
(152, 8, 'Gwoza', NULL, NULL),
(153, 8, 'Hawul', NULL, NULL),
(154, 8, 'Jere', NULL, NULL),
(155, 8, 'Kaga', NULL, NULL),
(156, 8, 'Kala/Balge', NULL, NULL),
(157, 8, 'Konduga', NULL, NULL),
(158, 8, 'Kukawa', NULL, NULL),
(159, 8, 'Kwaya Kusar', NULL, NULL),
(160, 8, 'Mafa', NULL, NULL),
(161, 8, 'Magumeri', NULL, NULL),
(162, 8, 'Maiduguri', NULL, NULL),
(163, 8, 'Marte', NULL, NULL),
(164, 8, 'Mobbar', NULL, NULL),
(165, 8, 'Monguno', NULL, NULL),
(166, 8, 'Ngala', NULL, NULL),
(167, 8, 'Nganzai', NULL, NULL),
(168, 8, 'Shani', NULL, NULL),
(169, 9, 'Akpabuyo', NULL, NULL),
(170, 9, 'Odukpani', NULL, NULL),
(171, 9, 'Akamkpa', NULL, NULL),
(172, 9, 'Biase', NULL, NULL),
(173, 9, 'Abi', NULL, NULL),
(174, 9, 'Ikom', NULL, NULL),
(175, 9, 'Yarkur', NULL, NULL),
(176, 9, 'Odubra', NULL, NULL),
(177, 9, 'Boki', NULL, NULL),
(178, 9, 'Ogoja', NULL, NULL),
(179, 9, 'Yala', NULL, NULL),
(180, 9, 'Obanliku', NULL, NULL),
(181, 9, 'Obudu', NULL, NULL),
(182, 9, 'Calabar South', NULL, NULL),
(183, 9, 'Etung', NULL, NULL),
(184, 9, 'Bekwara', NULL, NULL),
(185, 9, 'Bakasi', NULL, NULL),
(186, 9, 'Calabar Municipality', NULL, NULL),
(187, 10, 'Oshimili', NULL, NULL),
(188, 10, 'Aniocha', NULL, NULL),
(189, 10, 'Aniocha-South', NULL, NULL),
(190, 10, 'Ika South', NULL, NULL),
(191, 10, 'Ika North-East', NULL, NULL),
(192, 10, 'Ndokwa West', NULL, NULL),
(193, 10, 'Ndokwa East', NULL, NULL),
(194, 10, 'Isoko South', NULL, NULL),
(195, 10, 'Isoko North', NULL, NULL),
(196, 10, 'Bomadi', NULL, NULL),
(197, 10, 'Burutu', NULL, NULL),
(198, 10, 'Ughelli South', NULL, NULL),
(199, 10, 'Ughelli North', NULL, NULL),
(200, 10, 'Ethiope West', NULL, NULL),
(201, 10, 'Ethiope East', NULL, NULL),
(202, 10, 'Sapele', NULL, NULL),
(203, 10, 'Okpe', NULL, NULL),
(204, 10, 'Warri North', NULL, NULL),
(205, 10, 'Warri South', NULL, NULL),
(206, 10, 'Uvwie', NULL, NULL),
(207, 10, 'Udu', NULL, NULL),
(208, 10, 'Warri Central', NULL, NULL),
(209, 10, 'Ukwani', NULL, NULL),
(210, 10, 'Oshimili North', NULL, NULL),
(211, 10, 'Patani', NULL, NULL),
(212, 11, 'Afikpo South', NULL, NULL),
(213, 11, 'Afikpo North', NULL, NULL),
(214, 11, 'Onicha', NULL, NULL),
(215, 11, 'Ohaozara', NULL, NULL),
(216, 11, 'Abakaliki', NULL, NULL),
(217, 11, 'Ishielu', NULL, NULL),
(218, 11, 'lkwo', NULL, NULL),
(219, 11, 'Ezza', NULL, NULL),
(220, 11, 'Ezza South', NULL, NULL),
(221, 11, 'Ohaukwu', NULL, NULL),
(222, 11, 'Ebonyi', NULL, NULL),
(223, 11, 'Ivo', NULL, NULL),
(224, 12, 'Akoko Edo', NULL, NULL),
(225, 12, 'Egor', NULL, NULL),
(226, 12, 'Esan Central', NULL, NULL),
(227, 12, 'Esan North-East', NULL, NULL),
(228, 12, 'Esan South-East', NULL, NULL),
(229, 12, 'Esan West', NULL, NULL),
(230, 12, 'Etsako Central', NULL, NULL),
(231, 12, 'Etsako East', NULL, NULL),
(232, 12, 'Etsako West', NULL, NULL),
(233, 12, 'Igueben', NULL, NULL),
(234, 12, 'Ikpoba Okha', NULL, NULL),
(235, 12, 'Oredo', NULL, NULL),
(236, 12, 'Orhiomwon', NULL, NULL),
(237, 12, 'Ovia North East', NULL, NULL),
(238, 12, 'Ovia SouthWest', NULL, NULL),
(239, 12, 'Owan East', NULL, NULL),
(240, 12, 'Owan West', NULL, NULL),
(241, 12, 'Uhunmwonde', NULL, NULL),
(242, 12, 'Ukpoba', NULL, NULL),
(243, 13, 'Ado', NULL, NULL),
(244, 13, 'Ekiti-East', NULL, NULL),
(245, 13, 'Ekiti-West', NULL, NULL),
(246, 13, 'Emure/Ise/Orun', NULL, NULL),
(247, 13, 'Ekiti South-West', NULL, NULL),
(248, 13, 'Ikare', NULL, NULL),
(249, 13, 'Irepodun', NULL, NULL),
(250, 13, 'Ijero', NULL, NULL),
(251, 13, 'Ido/Osi', NULL, NULL),
(252, 13, 'Oye', NULL, NULL),
(253, 13, 'Ikole', NULL, NULL),
(254, 13, 'Moba', NULL, NULL),
(255, 13, 'Gbonyin', NULL, NULL),
(256, 13, 'Efon', NULL, NULL),
(257, 13, 'Ise/Orun', NULL, NULL),
(258, 13, 'Ilejemeje', NULL, NULL),
(259, 14, 'Agwu', NULL, NULL),
(260, 14, 'Enugu South', NULL, NULL),
(261, 14, 'Igbo-Eze South', NULL, NULL),
(262, 14, 'Enugu North', NULL, NULL),
(263, 14, 'Nkanu', NULL, NULL),
(264, 14, 'Udi', NULL, NULL),
(265, 14, 'Oji-River', NULL, NULL),
(266, 14, 'Ezeagu', NULL, NULL),
(267, 14, 'IgboEze North', NULL, NULL),
(268, 14, 'Isi-Uzo', NULL, NULL),
(269, 14, 'Nsukka', NULL, NULL),
(270, 14, 'Igbo-Ekiti', NULL, NULL),
(271, 14, 'Uzo-Uwani', NULL, NULL),
(272, 14, 'Enugu East', NULL, NULL),
(273, 14, 'Aninri', NULL, NULL),
(274, 14, 'Nkanu South', NULL, NULL),
(275, 14, 'Udenu', NULL, NULL),
(276, 15, 'Akko', NULL, NULL),
(277, 15, 'Balanga', NULL, NULL),
(278, 15, 'Billiri', NULL, NULL),
(279, 15, 'Dukku', NULL, NULL),
(280, 15, 'Kaltungo', NULL, NULL),
(281, 15, 'Kwami', NULL, NULL),
(282, 15, 'Shomgom', NULL, NULL),
(283, 15, 'Funakaye', NULL, NULL),
(284, 15, 'Gombe', NULL, NULL),
(285, 15, 'Nafada/Bajoga', NULL, NULL),
(286, 15, 'Yamaltu/Delta', NULL, NULL),
(287, 16, 'Aboh-Mbaise', NULL, NULL),
(288, 16, 'Ahiazu-Mbaise', NULL, NULL),
(289, 16, 'Ehime-Mbano', NULL, NULL),
(290, 16, 'Ezinihitte', NULL, NULL),
(291, 16, 'Ideato North', NULL, NULL),
(292, 16, 'Ideato South', NULL, NULL),
(293, 16, 'Ihitte/Uboma', NULL, NULL),
(294, 16, 'Ikeduru', NULL, NULL),
(295, 16, 'Isiala Mbano', NULL, NULL),
(296, 16, 'Isu', NULL, NULL),
(297, 16, 'Mbaitoli', NULL, NULL),
(298, 16, 'Ngor-Okpala', NULL, NULL),
(299, 16, 'Njaba', NULL, NULL),
(300, 16, 'Nwangele', NULL, NULL),
(301, 16, 'Nkwerre', NULL, NULL),
(302, 16, 'Obowo', NULL, NULL),
(303, 16, 'Oguta', NULL, NULL),
(304, 16, 'Ohaji/Egbeme', NULL, NULL),
(305, 16, 'Okigwe', NULL, NULL),
(306, 16, 'Orlu', NULL, NULL),
(307, 16, 'Orsu', NULL, NULL),
(308, 16, 'Oru East', NULL, NULL),
(309, 16, 'Oru West', NULL, NULL),
(310, 16, 'Owerri-Municipal', NULL, NULL),
(311, 16, 'Owerri North', NULL, NULL),
(312, 16, 'Owerri West', NULL, NULL),
(313, 17, 'Auyo', NULL, NULL),
(314, 17, 'Babura', NULL, NULL),
(315, 17, 'Birni kudu', NULL, NULL),
(316, 17, 'Birniwa', NULL, NULL),
(317, 17, 'Buji', NULL, NULL),
(318, 17, 'Dutse', NULL, NULL),
(319, 17, 'Gagarawa', NULL, NULL),
(320, 17, 'Garki', NULL, NULL),
(321, 17, 'Gumel', NULL, NULL),
(322, 17, 'Guri', NULL, NULL),
(323, 17, 'Gwaram', NULL, NULL),
(324, 17, 'Gwiwa', NULL, NULL),
(325, 17, 'Hadejia', NULL, NULL),
(326, 17, 'Jahun', NULL, NULL),
(327, 17, 'Kafin Hausa', NULL, NULL),
(328, 17, 'Kaugama Kazaure', NULL, NULL),
(329, 17, 'kiri kasamma', NULL, NULL),
(330, 17, 'kiyawa', NULL, NULL),
(331, 17, 'Maigatari', NULL, NULL),
(332, 17, 'Malam Madori', NULL, NULL),
(333, 17, 'Miga', NULL, NULL),
(334, 17, 'Ringim', NULL, NULL),
(335, 17, 'Roni', NULL, NULL),
(336, 17, 'Sule-Tankarkar', NULL, NULL),
(337, 17, 'Taura', NULL, NULL),
(338, 17, 'Yankwashi', NULL, NULL),
(339, 18, 'Birni-Gwari', NULL, NULL),
(340, 18, 'Chikun', NULL, NULL),
(341, 18, 'Giwa', NULL, NULL),
(342, 18, 'Igabi', NULL, NULL),
(343, 18, 'Ikara', NULL, NULL),
(344, 18, 'Jaba', NULL, NULL),
(345, 18, 'Jema\"a', NULL, NULL),
(346, 18, 'Kachia', NULL, NULL),
(347, 18, 'Kaduna North', NULL, NULL),
(348, 18, 'Kaduna South', NULL, NULL),
(349, 18, 'Kagarko', NULL, NULL),
(350, 18, 'Kajuru', NULL, NULL),
(351, 18, 'Kaura', NULL, NULL),
(352, 18, 'Kauru', NULL, NULL),
(353, 18, 'Kubua', NULL, NULL),
(354, 18, 'Kudan', NULL, NULL),
(355, 18, 'Lere', NULL, NULL),
(356, 18, 'Makarfi', NULL, NULL),
(357, 18, 'Sabon-gari', NULL, NULL),
(358, 18, 'Sanga', NULL, NULL),
(359, 18, 'Soba', NULL, NULL),
(360, 18, 'Zango-kataf', NULL, NULL),
(361, 18, 'Zaria', NULL, NULL),
(362, 19, 'Ajingi', NULL, NULL),
(363, 19, 'Albasu', NULL, NULL),
(364, 19, 'Bagwai', NULL, NULL),
(365, 19, 'Bebeji', NULL, NULL),
(366, 19, 'Bichi', NULL, NULL),
(367, 19, 'Bunkure', NULL, NULL),
(368, 19, 'Dala', NULL, NULL),
(369, 19, 'Dambatta', NULL, NULL),
(370, 19, 'Dawakin kudu', NULL, NULL),
(371, 19, 'Dawakin tofa', NULL, NULL),
(372, 19, 'Doguwa', NULL, NULL),
(373, 19, 'Fagge', NULL, NULL),
(374, 19, 'Gabasawa', NULL, NULL),
(375, 19, 'Garko', NULL, NULL),
(376, 19, 'Garum', NULL, NULL),
(377, 19, 'Mallam', NULL, NULL),
(378, 19, 'Gaya', NULL, NULL),
(379, 19, 'Gezawa', NULL, NULL),
(380, 19, 'Gwale', NULL, NULL),
(381, 19, 'Gwarzo', NULL, NULL),
(382, 19, 'Kabo', NULL, NULL),
(383, 19, 'Kano Municipal', NULL, NULL),
(384, 19, 'Karaye', NULL, NULL),
(385, 19, 'Kibiya', NULL, NULL),
(386, 19, 'Kiru', NULL, NULL),
(387, 19, 'Kumbutso', NULL, NULL),
(388, 19, 'Kunchi', NULL, NULL),
(389, 19, 'Kura', NULL, NULL),
(390, 19, 'Madobi', NULL, NULL),
(391, 19, 'Makoda', NULL, NULL),
(392, 19, 'Minjibir', NULL, NULL),
(393, 19, 'Nasarawa', NULL, NULL),
(394, 19, 'Rano', NULL, NULL),
(395, 19, 'Rimin Gado', NULL, NULL),
(396, 19, 'Rogo', NULL, NULL),
(397, 19, 'Shano', NULL, NULL),
(398, 19, 'Sumaila', NULL, NULL),
(399, 19, 'Takali', NULL, NULL),
(400, 19, 'Tarauni', NULL, NULL),
(401, 19, 'Tofa', NULL, NULL),
(402, 19, 'Tsanyawa', NULL, NULL),
(403, 19, 'Tudun wada', NULL, NULL),
(404, 19, 'Ungogo', NULL, NULL),
(405, 19, 'Warawa', NULL, NULL),
(406, 19, 'Wudil', NULL, NULL),
(407, 20, 'Bakori', NULL, NULL),
(408, 20, 'Batagarawa', NULL, NULL),
(409, 20, 'Batsari', NULL, NULL),
(410, 20, 'Baure', NULL, NULL),
(411, 20, 'Bindawa', NULL, NULL),
(412, 20, 'Charanchi', NULL, NULL),
(413, 20, 'Dandume', NULL, NULL),
(414, 20, 'Danja', NULL, NULL),
(415, 20, 'Dan Musa', NULL, NULL),
(416, 20, 'Daura', NULL, NULL),
(417, 20, 'Dutsi', NULL, NULL),
(418, 20, 'Dutsin-Ma', NULL, NULL),
(419, 20, 'Faskari', NULL, NULL),
(420, 20, 'Funtua', NULL, NULL),
(421, 20, 'Ingawa', NULL, NULL),
(422, 20, 'Jibia', NULL, NULL),
(423, 20, 'Kafur', NULL, NULL),
(424, 20, 'Kaita', NULL, NULL),
(425, 20, 'Kankara', NULL, NULL),
(426, 20, 'Kankia', NULL, NULL),
(427, 20, 'Katsina', NULL, NULL),
(428, 20, 'Kurfi', NULL, NULL),
(429, 20, 'Kusada', NULL, NULL),
(430, 20, 'Mai Adua', NULL, NULL),
(431, 20, 'Malumfashi', NULL, NULL),
(432, 20, 'Mani', NULL, NULL),
(433, 20, 'Mashi', NULL, NULL),
(434, 20, 'Matazuu', NULL, NULL),
(435, 20, 'Musawa', NULL, NULL),
(436, 20, 'Rimi', NULL, NULL),
(437, 20, 'Sabuwa', NULL, NULL),
(438, 20, 'Safana', NULL, NULL),
(439, 20, 'Sandamu', NULL, NULL),
(440, 20, 'Zango', NULL, NULL),
(441, 21, 'Aleiro', NULL, NULL),
(442, 21, 'Arewa-Dandi', NULL, NULL),
(443, 21, 'Argungu', NULL, NULL),
(444, 21, 'Augie', NULL, NULL),
(445, 21, 'Bagudo', NULL, NULL),
(446, 21, 'Birnin Kebbi', NULL, NULL),
(447, 21, 'Bunza', NULL, NULL),
(448, 21, 'Dandi', NULL, NULL),
(449, 21, 'Fakai', NULL, NULL),
(450, 21, 'Gwandu', NULL, NULL),
(451, 21, 'Jega', NULL, NULL),
(452, 21, 'Kalgo', NULL, NULL),
(453, 21, 'Koko/Besse', NULL, NULL),
(454, 21, 'Maiyama', NULL, NULL),
(455, 21, 'Ngaski', NULL, NULL),
(456, 21, 'Sakaba', NULL, NULL),
(457, 21, 'Shanga', NULL, NULL),
(458, 21, 'Suru', NULL, NULL),
(459, 21, 'Wasagu/Danko', NULL, NULL),
(460, 21, 'Yauri', NULL, NULL),
(461, 21, 'Zuru', NULL, NULL),
(462, 22, 'Adavi', NULL, NULL),
(463, 22, 'Ajaokuta', NULL, NULL),
(464, 22, 'Ankpa', NULL, NULL),
(465, 22, 'Bassa', NULL, NULL),
(466, 22, 'Dekina', NULL, NULL),
(467, 22, 'Ibaji', NULL, NULL),
(468, 22, 'Idah', NULL, NULL),
(469, 22, 'Igalamela-Odolu', NULL, NULL),
(470, 22, 'Ijumu', NULL, NULL),
(471, 22, 'Kabba/Bunu', NULL, NULL),
(472, 22, 'Kogi', NULL, NULL),
(473, 22, 'Lokoja', NULL, NULL),
(474, 22, 'Mopa-Muro', NULL, NULL),
(475, 22, 'Ofu', NULL, NULL),
(476, 22, 'Ogori/Mangongo', NULL, NULL),
(477, 22, 'Okehi', NULL, NULL),
(478, 22, 'Okene', NULL, NULL),
(479, 22, 'Olamabolo', NULL, NULL),
(480, 22, 'Omala', NULL, NULL),
(481, 22, 'Yagba East', NULL, NULL),
(482, 22, 'Yagba West', NULL, NULL),
(483, 23, 'Asa', NULL, NULL),
(484, 23, 'Baruten', NULL, NULL),
(485, 23, 'Edu', NULL, NULL),
(486, 23, 'Ekiti', NULL, NULL),
(487, 23, 'Ifelodun', NULL, NULL),
(488, 23, 'Ilorin East', NULL, NULL),
(489, 23, 'Ilorin West', NULL, NULL),
(490, 23, 'Irepodun', NULL, NULL),
(491, 23, 'Isin', NULL, NULL),
(492, 23, 'Kaiama', NULL, NULL),
(493, 23, 'Moro', NULL, NULL),
(494, 23, 'Offa', NULL, NULL),
(495, 23, 'Oke-Ero', NULL, NULL),
(496, 23, 'Oyun', NULL, NULL),
(497, 23, 'Pategi', NULL, NULL),
(498, 24, 'Agege', NULL, NULL),
(499, 24, 'Ajeromi-Ifelodun', NULL, NULL),
(500, 24, 'Alimosho', NULL, NULL),
(501, 24, 'Amuwo-Odofin', NULL, NULL),
(502, 24, 'Apapa', NULL, NULL),
(503, 24, 'Badagry', NULL, NULL),
(504, 24, 'Epe', NULL, NULL),
(505, 24, 'Eti-Osa', NULL, NULL),
(506, 24, 'Ibeju/Lekki', NULL, NULL),
(507, 24, 'Ifako-Ijaye', NULL, NULL),
(508, 24, 'Ikeja', NULL, NULL),
(509, 24, 'Ikorodu', NULL, NULL),
(510, 24, 'Kosofe', NULL, NULL),
(511, 24, 'Lagos Island', NULL, NULL),
(512, 24, 'Lagos Mainland', NULL, NULL),
(513, 24, 'Mushin', NULL, NULL),
(514, 24, 'Ojo', NULL, NULL),
(515, 24, 'Oshodi-Isolo', NULL, NULL),
(516, 24, 'Shomolu', NULL, NULL),
(517, 24, 'Surulere', NULL, NULL),
(518, 25, 'Akwanga', NULL, NULL),
(519, 25, 'Awe', NULL, NULL),
(520, 25, 'Doma', NULL, NULL),
(521, 25, 'Karu', NULL, NULL),
(522, 25, 'Keana', NULL, NULL),
(523, 25, 'Keffi', NULL, NULL),
(524, 25, 'Kokona', NULL, NULL),
(525, 25, 'Lafia', NULL, NULL),
(526, 25, 'Nasarawa', NULL, NULL),
(527, 25, 'Nasarawa-Eggon', NULL, NULL),
(528, 25, 'Obi', NULL, NULL),
(529, 25, 'Toto', NULL, NULL),
(530, 25, 'Wamba', NULL, NULL),
(531, 26, 'Agaie', NULL, NULL),
(532, 26, 'Agwara ', NULL, NULL),
(533, 26, 'Bida', NULL, NULL),
(534, 26, 'Borgu', NULL, NULL),
(535, 26, 'Bosso', NULL, NULL),
(536, 26, 'Chanchaga', NULL, NULL),
(537, 26, 'Edati', NULL, NULL),
(538, 26, 'Gbako', NULL, NULL),
(539, 26, 'Gurara ', NULL, NULL),
(540, 26, 'Katcha', NULL, NULL),
(541, 26, 'Kontagora', NULL, NULL),
(542, 26, 'Lapai', NULL, NULL),
(543, 26, 'Lavun', NULL, NULL),
(544, 26, 'Magama', NULL, NULL),
(545, 26, 'Mariga', NULL, NULL),
(546, 26, 'Mashegu', NULL, NULL),
(547, 26, 'Mokwa', NULL, NULL),
(548, 26, 'Muya', NULL, NULL),
(549, 26, 'Pailoro', NULL, NULL),
(550, 26, 'Rafi', NULL, NULL),
(551, 26, 'Rijau ', NULL, NULL),
(552, 26, 'Shiroro', NULL, NULL),
(553, 26, 'Suleja ', NULL, NULL),
(554, 26, 'Tafa', NULL, NULL),
(555, 26, 'Wushishi', NULL, NULL),
(556, 27, 'Abeokuta North', NULL, NULL),
(557, 27, 'Abeokuta South', NULL, NULL),
(558, 27, 'Ado-Odo/Ota', NULL, NULL),
(559, 27, 'Egbado North', NULL, NULL),
(560, 27, 'Egbado South', NULL, NULL),
(561, 27, 'Ewekoro', NULL, NULL),
(562, 27, 'Ifo', NULL, NULL),
(563, 27, 'Ijebu East', NULL, NULL),
(564, 27, 'Ijebu North', NULL, NULL),
(565, 27, 'Ijebu North East', NULL, NULL),
(566, 27, 'Ijebu Ode', NULL, NULL),
(567, 27, 'Ikenne', NULL, NULL),
(568, 27, 'Imeko-Afon', NULL, NULL),
(569, 27, 'Ipokia', NULL, NULL),
(570, 27, 'Obafemi-Owode', NULL, NULL),
(571, 27, 'Ogun Watrside', NULL, NULL),
(572, 27, 'Odeda', NULL, NULL),
(573, 27, 'Odogbolu', NULL, NULL),
(574, 27, 'Remo North', NULL, NULL),
(575, 27, 'Shagamu', NULL, NULL),
(576, 28, 'Akoko North East', NULL, NULL),
(577, 28, 'Akoko North West ', NULL, NULL),
(578, 28, 'Akoko South Akure East', NULL, NULL),
(579, 28, 'Akoko South West', NULL, NULL),
(580, 28, 'Akure North ', NULL, NULL),
(581, 28, 'Akure South', NULL, NULL),
(582, 28, 'Ese-Odo ', NULL, NULL),
(583, 28, 'Idanre', NULL, NULL),
(584, 28, 'Ifedore ', NULL, NULL),
(585, 28, 'Ilaje ', NULL, NULL),
(586, 28, 'Ile-Oluji ', NULL, NULL),
(587, 28, 'Okeigbo ', NULL, NULL),
(588, 28, 'Irele ', NULL, NULL),
(589, 28, 'Odigbo ', NULL, NULL),
(590, 28, 'Okitipupa ', NULL, NULL),
(591, 28, 'Ondo East  ', NULL, NULL),
(592, 28, 'Ondo West', NULL, NULL),
(593, 28, 'Ose', NULL, NULL),
(594, 28, 'Owo', NULL, NULL),
(595, 29, 'Aiyedade', NULL, NULL),
(596, 29, 'Aiyedire', NULL, NULL),
(597, 29, 'Atakumosa East', NULL, NULL),
(598, 29, 'Atakumosa West', NULL, NULL),
(599, 29, 'Boluwaduro', NULL, NULL),
(600, 29, 'Boripe', NULL, NULL),
(601, 29, 'Ede North', NULL, NULL),
(602, 29, 'Ede South', NULL, NULL),
(603, 29, 'Egbedore', NULL, NULL),
(604, 29, 'Ejigbo', NULL, NULL),
(605, 29, 'Ife Central', NULL, NULL),
(606, 29, 'Ife East', NULL, NULL),
(607, 29, 'Ife North', NULL, NULL),
(608, 29, 'Ife South', NULL, NULL),
(609, 29, 'Ifedayo', NULL, NULL),
(610, 29, 'Ifelodun', NULL, NULL),
(611, 29, 'Ila', NULL, NULL),
(612, 29, 'Ilesha East', NULL, NULL),
(613, 29, 'Ilesha West', NULL, NULL),
(614, 29, 'Irepodun', NULL, NULL),
(615, 29, 'Irewole', NULL, NULL),
(616, 29, 'Isokan', NULL, NULL),
(617, 29, 'Iwo', NULL, NULL),
(618, 29, 'Obokun', NULL, NULL),
(619, 29, 'Odo-Otin', NULL, NULL),
(620, 29, 'Ola-Oluwa', NULL, NULL),
(621, 29, 'Olorunda', NULL, NULL),
(622, 29, 'Oriade', NULL, NULL),
(623, 29, 'Oriade', NULL, NULL),
(624, 29, 'Oriade', NULL, NULL),
(625, 30, 'Afijio', NULL, NULL),
(626, 30, 'Akinyele', NULL, NULL),
(627, 30, 'Atiba', NULL, NULL),
(628, 30, 'Atigbo', NULL, NULL),
(629, 30, 'Egbeda', NULL, NULL),
(630, 30, 'Ibadan Central', NULL, NULL),
(631, 30, 'Ibadan North', NULL, NULL),
(632, 30, 'Ibadan North West', NULL, NULL),
(633, 30, 'Ibadan South East', NULL, NULL),
(634, 30, 'Ibadan South West', NULL, NULL),
(635, 30, 'Ibarapa Central ', NULL, NULL),
(636, 30, 'Ibarapa East', NULL, NULL),
(637, 30, 'Ibarapa North', NULL, NULL),
(638, 30, 'Ido', NULL, NULL),
(639, 30, 'Irepo', NULL, NULL),
(640, 30, 'Iseyin', NULL, NULL),
(641, 30, 'Itesiwaju', NULL, NULL),
(642, 30, 'Iwajowa', NULL, NULL),
(643, 30, 'Kajola', NULL, NULL),
(644, 30, 'Lagelu Ogbomosho North', NULL, NULL),
(645, 30, 'Ogbmosho South', NULL, NULL),
(646, 30, 'Ogo Oluwa', NULL, NULL),
(647, 30, 'Olorunsogo', NULL, NULL),
(648, 30, 'Oluyole', NULL, NULL),
(649, 30, 'Ona-Ara', NULL, NULL),
(650, 30, 'Orelope', NULL, NULL),
(651, 30, 'Ori Ire', NULL, NULL),
(652, 30, 'Oyo East', NULL, NULL),
(653, 30, 'Oyo West', NULL, NULL),
(654, 30, 'Saki East', NULL, NULL),
(655, 30, 'Saki West', NULL, NULL),
(656, 30, 'Surulere', NULL, NULL),
(657, 31, 'Barikin Ladi', NULL, NULL),
(658, 31, 'Bassa', NULL, NULL),
(659, 31, 'Bokkos', NULL, NULL),
(660, 2, 'Jos East', NULL, NULL),
(661, 31, 'Jos North', NULL, NULL),
(662, 31, 'Jos South', NULL, NULL),
(663, 31, 'Kanam', NULL, NULL),
(664, 31, 'Kanke', NULL, NULL),
(665, 31, 'Langtang North', NULL, NULL),
(666, 31, 'Langtang South', NULL, NULL),
(667, 31, 'Mangu', NULL, NULL),
(668, 31, 'Mikang', NULL, NULL),
(669, 31, 'Pankshin', NULL, NULL),
(670, 31, 'Qua an Pan', NULL, NULL),
(671, 31, 'Riyom', NULL, NULL),
(672, 31, 'Shendam', NULL, NULL),
(673, 31, 'Wase', NULL, NULL),
(674, 32, 'Abua/Odual', NULL, NULL),
(675, 32, 'Ahoada East', NULL, NULL),
(676, 32, 'Ahoada West', NULL, NULL),
(677, 32, 'Akuku Toru', NULL, NULL),
(678, 32, 'Adoni', NULL, NULL),
(679, 32, 'Bonny', NULL, NULL),
(680, 32, 'Degema', NULL, NULL),
(681, 32, 'Emohua', NULL, NULL),
(682, 32, 'Eleme', NULL, NULL),
(683, 32, 'Etche', NULL, NULL),
(684, 32, 'Gokana', NULL, NULL),
(685, 32, 'Ikwerre', NULL, NULL),
(686, 32, 'Khana', NULL, NULL),
(687, 32, 'Mubi South', NULL, NULL),
(688, 32, 'Obia/Akpor', NULL, NULL),
(689, 32, 'Ogba/Egbema/Ndoni', NULL, NULL),
(690, 32, 'Ogu/Bolo', NULL, NULL),
(691, 32, 'Okrika', NULL, NULL),
(692, 32, 'Omumma', NULL, NULL),
(693, 32, 'Opobo/Nkoro', NULL, NULL),
(694, 32, 'Oyigbo', NULL, NULL),
(695, 32, 'Port-Harcourt', NULL, NULL),
(696, 32, 'Tai', NULL, NULL),
(697, 33, 'Binji', NULL, NULL),
(698, 33, 'Bodinga', NULL, NULL),
(699, 33, 'Dange-shnsi', NULL, NULL),
(700, 33, 'Gada', NULL, NULL),
(701, 33, 'Goronyo', NULL, NULL),
(702, 33, 'Gudu', NULL, NULL),
(703, 33, 'Gawabawa', NULL, NULL),
(704, 33, 'Illela', NULL, NULL),
(705, 33, 'Isa', NULL, NULL),
(706, 33, 'Kware', NULL, NULL),
(707, 33, 'Kebba', NULL, NULL),
(708, 33, 'Rabah', NULL, NULL),
(709, 33, 'Sabon birni', NULL, NULL),
(710, 33, 'Shagari', NULL, NULL),
(711, 33, 'Silame', NULL, NULL),
(712, 33, 'Sokoto North', NULL, NULL),
(713, 33, 'Sokoto South', NULL, NULL),
(714, 33, 'Tambuwal', NULL, NULL),
(715, 33, 'Tqngaza', NULL, NULL),
(716, 33, 'Tureta', NULL, NULL),
(717, 33, 'Wamako', NULL, NULL),
(718, 33, 'Wurno', NULL, NULL),
(719, 33, 'Yabo', NULL, NULL),
(720, 34, 'Ardo-kola', NULL, NULL),
(721, 34, 'Bali', NULL, NULL),
(722, 34, 'Donga', NULL, NULL),
(723, 34, 'Gashaka', NULL, NULL),
(724, 34, 'Cassol', NULL, NULL),
(725, 34, 'Ibi', NULL, NULL),
(726, 34, 'Jalingo', NULL, NULL),
(727, 34, 'Karin-Lamido', NULL, NULL),
(728, 34, 'Kurmi', NULL, NULL),
(729, 34, 'Lau', NULL, NULL),
(730, 34, 'Sardauna', NULL, NULL),
(731, 34, 'Takum', NULL, NULL),
(732, 34, 'ussa', NULL, NULL),
(733, 34, 'Wukari', NULL, NULL),
(734, 34, 'Yorro', NULL, NULL),
(735, 34, 'zing', NULL, NULL),
(736, 35, 'Bade', NULL, NULL),
(737, 35, 'Bursari', NULL, NULL),
(738, 35, 'Damaturu', NULL, NULL),
(739, 35, 'Fika', NULL, NULL),
(740, 35, 'Fune', NULL, NULL),
(741, 35, 'Geidam', NULL, NULL),
(742, 35, 'Gujba', NULL, NULL),
(743, 35, 'Gulani', NULL, NULL),
(744, 35, 'Jakusko', NULL, NULL),
(745, 35, 'Karasuwa', NULL, NULL),
(746, 35, 'Karawa', NULL, NULL),
(747, 35, 'Machina', NULL, NULL),
(748, 35, 'Nangere', NULL, NULL),
(749, 35, 'Nguru Potiskum', NULL, NULL),
(750, 35, 'Tarmua', NULL, NULL),
(751, 35, 'Yunusari ', NULL, NULL),
(752, 35, 'Yusufari', NULL, NULL),
(753, 36, 'Anka', NULL, NULL),
(754, 36, 'Bakura', NULL, NULL),
(755, 36, 'Birnin Magaji', NULL, NULL),
(756, 36, 'Bukkuyum', NULL, NULL),
(757, 36, 'Bungudu', NULL, NULL),
(758, 36, 'Gummi', NULL, NULL),
(759, 36, 'Gusau', NULL, NULL),
(760, 36, 'Kaura', NULL, NULL),
(761, 36, 'Namoda', NULL, NULL),
(762, 36, 'Maradun', NULL, NULL),
(763, 36, 'Maru', NULL, NULL),
(764, 36, 'Shinkafi', NULL, NULL),
(765, 36, 'Talata Mafara', NULL, NULL),
(766, 36, 'Tsafe', NULL, NULL),
(767, 36, 'Zurmi', NULL, NULL),
(768, 37, 'Gwagwalada ', NULL, NULL),
(769, 37, 'Kuje', NULL, NULL),
(770, 37, 'Abaji', NULL, NULL),
(771, 37, 'Abuja Municipal', NULL, NULL),
(772, 37, 'Bwari', NULL, NULL),
(773, 37, 'Kwali', NULL, NULL),
(774, 37, 'Utako', NULL, NULL),
(775, 37, 'Maitama', NULL, NULL),
(776, 37, 'Gwarimpa', NULL, NULL),
(777, 37, 'Wuse', NULL, NULL),
(778, 37, 'Kubwa', NULL, NULL),
(779, 37, 'Asokoro', NULL, NULL),
(780, 37, 'Jabi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_13_014227_create_roles_table', 1),
(6, '2021_11_13_014644_add_roles_column_to_users_table', 1),
(7, '2021_11_13_022227_create_categories_table', 1),
(8, '2021_11_13_023750_create_products_table', 1),
(9, '2021_11_13_030647_create_attributes_table', 1),
(10, '2021_11_13_030716_create_attribute_values_table', 1),
(11, '2021_11_13_030814_create_product_images_table', 1),
(12, '2021_11_13_034735_create_warehouses_table', 1),
(13, '2021_11_13_040802_create_order_status_table', 1),
(14, '2021_11_13_041351_create_orders_table', 1),
(15, '2021_11_13_041452_create_addresses_table', 1),
(16, '2021_11_13_041523_create_delivery_details_table', 1),
(17, '2021_11_13_042623_create_order_details_table', 1),
(18, '2021_11_13_043720_create_delivery_type_table', 1),
(19, '2021_11_14_131101_create_carts_table', 1),
(20, '2021_11_14_135241_create_product_warehouses_table', 1),
(21, '2021_12_10_135749_create_states_table', 1),
(22, '2021_12_10_135810_create_lgas_table', 1),
(23, '2021_12_19_174607_create_discounts_table', 1),
(24, '2021_12_20_064721_create_product_attributes_table', 1),
(25, '2022_01_27_035050_create_wishlist_table', 1),
(26, '2022_01_27_211933_create_cart_products_table', 1),
(27, '2022_01_27_212713_drop_four_columns_from_carts_table', 1),
(28, '2022_01_27_215056_add_warehouse_column_to_cart_products_table', 1),
(29, '2022_01_28_153810_create_delivery_costs_table', 1),
(30, '2022_01_29_005518_add_payment_method_column_to_delivery_details', 1),
(31, '2022_01_29_023357_drop_warehouse_and_order_status_column_from_delivery_details_table', 1),
(32, '2022_01_29_030646_drop_on_sales_and_status_columns_from_order_details_table', 1),
(33, '2022_01_29_032954_add_date_of_delivery_and_time_slots_to_delivery_details_table', 1),
(34, '2022_01_29_100924_add_gender_to_users_table', 1),
(35, '2022_01_29_183630_add_soft_delete_to_address', 1),
(36, '2022_01_31_181350_create_transactions_table', 1),
(37, '2022_02_01_025312_add_app_token_to_users_table', 1),
(38, '2022_02_03_040818_create_rate_order_table', 1),
(39, '2022_02_03_225644_create_user_searches_table', 1),
(40, '2022_02_04_014704_add_user_id_column_to_user_searches_table', 1),
(41, '2022_02_12_140503_create_notifications_table', 1),
(42, '2022_02_13_014413_create_order_assignees_table', 1),
(43, '2022_02_14_034442_create_jobs_table', 1),
(44, '2022_02_14_212228_create_warehouse_districts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('read','unread') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `subject`, `body`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 'Order Declined', 'Order with ID 1000000 has been declined by admin admin(Super Admin)', 'unread', '2022-02-19 23:28:41', '2022-02-19 23:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_products_price` decimal(15,2) NOT NULL,
  `total_shipping_price` decimal(15,2) NOT NULL,
  `total_paid` decimal(15,2) NOT NULL,
  `status` bigint(20) UNSIGNED NOT NULL,
  `update_by` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_products_price`, `total_shipping_price`, `total_paid`, `status`, `update_by`, `warehouse_id`, `created_at`, `updated_at`) VALUES
(1000000, 1, '9500.00', '1000.00', '10500.00', 8, 1, 2, '2022-02-15 06:29:23', '2022-02-19 23:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_assignees`
--

CREATE TABLE `order_assignees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_accepted` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_acceptance_time` timestamp NULL DEFAULT NULL,
  `order_rejected_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivery_detail_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `delivery_detail_id`, `created_at`, `updated_at`) VALUES
(1, 1000000, 1, 'Ofada Rice', 2, 1, '2022-02-15 06:29:24', '2022-02-15 06:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2022-02-15 06:27:44'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `slug`, `created_at`) VALUES
(1, 'Awaiting Fulfillment', 'awaiting-fulfillment', '2022-02-15 06:27:44'),
(2, 'Awaiting Shipment', 'awaiting-shipment', '2022-02-15 06:27:44'),
(3, 'Awaiting Pickup', 'awaiting-pickup', '2022-02-15 06:27:44'),
(4, 'Partially Shipped', 'partially-shipped', '2022-02-15 06:27:44'),
(5, 'Completely Shipped', 'completely-shipped', '2022-02-15 06:27:44'),
(6, 'Completed', 'completed', '2022-02-15 06:27:44'),
(7, 'Cancelled', 'cancelled', '2022-02-15 06:27:44'),
(8, 'Declined', 'declined', '2022-02-15 06:27:44'),
(9, 'Refunded', 'refunded', '2022-02-15 06:27:44'),
(10, 'Partially Refunded', 'partially-refunded', '2022-02-15 06:27:44'),
(11, 'Processing', 'processing', '2022-02-15 06:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `internal_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_price` decimal(15,2) NOT NULL,
  `original_price` decimal(15,2) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `sales_expiry` timestamp NULL DEFAULT NULL,
  `on_sales` tinyint(4) NOT NULL DEFAULT 1,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `internal_ref`, `name`, `description`, `category_id`, `sub_category_id`, `slug`, `real_price`, `original_price`, `status`, `sales_expiry`, `on_sales`, `added_by`, `created_at`, `updated_at`) VALUES
(1, '123-567-9', 'Ofada Rice', 'Ofada Rice is good for your health', 4, 5, 'ofada-rice', '20000.00', '25000.00', 1, NULL, 1, 1, '2022-02-15 06:29:23', '2022-02-15 06:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT '2022-02-15 06:28:05'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `default` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `attribute_value_id`, `image_url`, `status`, `default`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'http://localhost/assets/images/products/meat20.png', 1, 1, '2022-02-15 06:29:23', '2022-02-15 06:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouses`
--

CREATE TABLE `product_warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `total_quantity` int(11) DEFAULT NULL COMMENT 'This is the total number of product in this particular warehouse',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_warehouses`
--

INSERT INTO `product_warehouses` (`id`, `product_id`, `warehouse_id`, `total_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 20, '2022-02-15 06:29:24', '2022-02-15 06:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `rate_orders`
--

CREATE TABLE `rate_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overall_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `delivery_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', '2022-02-15 06:28:33', '2022-02-15 06:28:33'),
(2, 'Admin', 'admin', '2022-02-15 06:28:33', '2022-02-15 06:28:33'),
(3, 'Warehouse Manager', 'warehouse-manager', '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(4, 'Biker', 'biker', '2022-02-15 06:28:34', '2022-02-15 06:28:34'),
(5, 'Customer', 'customer', '2022-02-15 06:28:34', '2022-02-15 06:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Abia', '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(2, 'Adamawa', '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(3, 'Akwa Ibom', '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(4, 'Anambra', '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(5, 'Bauchi', '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(6, 'Bayelsa', '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(7, 'Benue', '2022-02-15 06:28:35', '2022-02-15 06:28:35'),
(8, 'Borno', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(9, 'Cross River', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(10, 'Delta', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(11, 'Ebonyi', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(12, 'Edo', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(13, 'Ekiti', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(14, 'Enugu', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(15, 'Gombe', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(16, 'Imo', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(17, 'Jigawa', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(18, 'Kaduna', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(19, 'Kano', '2022-02-15 06:28:36', '2022-02-15 06:28:36'),
(20, 'Katsina', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(21, 'Kebbi', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(22, 'Kogi', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(23, 'Kwara', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(24, 'Lagos', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(25, 'Nassarawa', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(26, 'Niger', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(27, 'Ogun', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(28, 'Ondo', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(29, 'Osun', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(30, 'Oyo', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(31, 'Plateau', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(32, 'Rivers', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(33, 'Sokoto', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(34, 'Taraba', '2022-02-15 06:28:37', '2022-02-15 06:28:37'),
(35, 'Yobe', '2022-02-15 06:28:38', '2022-02-15 06:28:38'),
(36, 'Zamfara', '2022-02-15 06:28:38', '2022-02-15 06:28:38'),
(37, 'Abuja Federal Capital Territory', '2022-02-15 06:28:38', '2022-02-15 06:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://localhost/assets/images/users/default.png',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_token` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `image_url`, `phone`, `email`, `token`, `email_verified_at`, `password`, `social_id`, `remember_token`, `created_at`, `updated_at`, `role_id`, `gender`, `app_token`) VALUES
(1, 'admin', 'John', 'Doe', 'http://localhost/assets/images/users/default.png', '09087645233', 'admin@admin.com', NULL, NULL, '$2y$10$p66St1xddZs0CuXTF40cdemzTv7GRQMpfaApmRQopUuQySOzGpnOa', NULL, NULL, '2022-02-15 06:28:32', '2022-02-15 06:28:32', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_searches`
--

CREATE TABLE `user_searches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `lga_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `slug`, `email`, `user_id`, `lga_id`, `state_id`, `zipcode`, `street`, `longitude`, `latitude`, `created_at`, `updated_at`) VALUES
(1, 'Asokoro Stores', 'asokoro-stores', 'asokorostore@smallhurry.com', 1, 779, 37, NULL, 'Mobolaji Crescent, Yaba, Lagos', '7.519309', '9.04084', '2022-02-15 06:29:21', '2022-02-16 16:10:43'),
(2, 'Gwarimpa', 'Gwarimpa', 'gwarinpastore@smallhurry.com', 0, 776, 37, NULL, NULL, '7.39826', '9.067318', '2022-02-15 06:29:22', '2022-02-15 06:29:22'),
(3, 'Jabi ', 'Jabi ', 'jabistore@smallhurry.com', 0, 780, 37, NULL, NULL, '7.42191', '9.06478', '2022-02-15 06:29:22', '2022-02-15 06:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_districts`
--

CREATE TABLE `warehouse_districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_districts`
--

INSERT INTO `warehouse_districts` (`id`, `warehouse_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Central Business Area', NULL, NULL),
(2, 1, 'Garki', NULL, NULL),
(3, 1, 'Maitama', NULL, NULL),
(4, 1, 'Asokoro', NULL, NULL),
(5, 1, 'Guazepe', NULL, NULL),
(6, 1, 'Durumi ', NULL, NULL),
(7, 1, 'Gudu', NULL, NULL),
(8, 1, 'Jahi', NULL, NULL),
(9, 2, 'Wuse', NULL, NULL),
(10, 2, 'Kado', NULL, NULL),
(11, 2, 'Life Camp', NULL, NULL),
(12, 2, 'Utako', NULL, NULL),
(13, 2, 'Jabi', NULL, NULL),
(14, 2, 'Mabuchi', NULL, NULL),
(15, 2, 'Katampe', NULL, NULL),
(16, 2, 'wuye', NULL, NULL),
(17, 3, 'Gwarinpa', NULL, NULL),
(18, 3, 'Dawaki', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_products_product_id_foreign` (`product_id`),
  ADD KEY `cart_products_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_products_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `delivery_costs`
--
ALTER TABLE `delivery_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_details_order_id_foreign` (`order_id`),
  ADD KEY `delivery_details_address_id_foreign` (`address_id`);

--
-- Indexes for table `delivery_type`
--
ALTER TABLE `delivery_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `lgas`
--
ALTER TABLE `lgas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_foreign` (`status`),
  ADD KEY `orders_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `order_assignees`
--
ALTER TABLE `order_assignees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_assignees_user_id_foreign` (`user_id`),
  ADD KEY `order_assignees_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_delivery_detail_id_foreign` (`delivery_detail_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`),
  ADD KEY `product_images_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `product_warehouses`
--
ALTER TABLE `product_warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_warehouses_product_id_foreign` (`product_id`),
  ADD KEY `product_warehouses_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `rate_orders`
--
ALTER TABLE `rate_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rate_orders_user_id_foreign` (`user_id`),
  ADD KEY `rate_orders_order_id_foreign` (`order_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_searches`
--
ALTER TABLE `user_searches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_searches_product_id_foreign` (`product_id`),
  ADD KEY `user_searches_user_id_foreign` (`user_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_districts`
--
ALTER TABLE `warehouse_districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_districts_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `delivery_costs`
--
ALTER TABLE `delivery_costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_type`
--
ALTER TABLE `delivery_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lgas`
--
ALTER TABLE `lgas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=781;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000001;

--
-- AUTO_INCREMENT for table `order_assignees`
--
ALTER TABLE `order_assignees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_warehouses`
--
ALTER TABLE `product_warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate_orders`
--
ALTER TABLE `rate_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_searches`
--
ALTER TABLE `user_searches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse_districts`
--
ALTER TABLE `warehouse_districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `cart_products_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_products_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`);

--
-- Constraints for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD CONSTRAINT `delivery_details_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_status_foreign` FOREIGN KEY (`status`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`);

--
-- Constraints for table `order_assignees`
--
ALTER TABLE `order_assignees`
  ADD CONSTRAINT `order_assignees_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_assignees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_delivery_detail_id_foreign` FOREIGN KEY (`delivery_detail_id`) REFERENCES `delivery_details` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_warehouses`
--
ALTER TABLE `product_warehouses`
  ADD CONSTRAINT `product_warehouses_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_warehouses_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`);

--
-- Constraints for table `rate_orders`
--
ALTER TABLE `rate_orders`
  ADD CONSTRAINT `rate_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rate_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_searches`
--
ALTER TABLE `user_searches`
  ADD CONSTRAINT `user_searches_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_searches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `warehouse_districts`
--
ALTER TABLE `warehouse_districts`
  ADD CONSTRAINT `warehouse_districts_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
