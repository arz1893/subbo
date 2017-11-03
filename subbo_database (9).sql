-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2017 at 09:39 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sorf7479_subbo_db`
--
CREATE DATABASE IF NOT EXISTS `sorf7479_subbo_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sorf7479_subbo_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin 1', 'admin1@example.com', '$2y$10$dloNLhBQmPfrCD4B65DnPOfOcPbUN.MHZaVBhfD4FcQSeegJFhzOm', NULL, '2017-09-05 01:24:41', '2017-09-05 01:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `album_category`
--

CREATE TABLE `album_category` (
  `album_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album_category`
--

INSERT INTO `album_category` (`album_id`, `category_id`, `created_at`, `updated_at`) VALUES
('f7992d2e-83e4-5198-a04b-8f5e6caadded', 6, '2017-10-23 21:01:21', '2017-10-23 21:01:21'),
('f7992d2e-83e4-5198-a04b-8f5e6caadded', 4, '2017-10-23 21:01:21', '2017-10-23 21:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` double DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `downloaded` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `album_cover_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `description`, `price`, `views`, `downloaded`, `is_published`, `is_deleted`, `album_cover_id`, `user_id`, `created_at`, `updated_at`) VALUES
('f7992d2e-83e4-5198-a04b-8f5e6caadded', 'upload from firefox', 'test upload', 14996, NULL, NULL, 1, 0, 9, '983ac884-2762-3e85-a7b7-51013cfd1a11', '2017-10-23 20:57:44', '2017-10-23 21:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Abstract', 'Imagine on your own', 'abstract-icon.png', NULL, NULL),
(2, 'Culture', 'All about nationwide culture', 'culture-icon.png', NULL, NULL),
(3, 'Food', 'Make sure your stomach is not empty!', 'food-icon.png', NULL, NULL),
(4, 'Modern', 'High Tech? not always', 'modern-icon.png', NULL, NULL),
(5, 'Sport', 'All about sweat', 'sport-icon.png', NULL, NULL),
(6, 'Tech', 'Are you geek enough ?', 'tech-icon.png', NULL, NULL),
(7, 'Cars', 'All you need is petrol head', 'car-icon.png', NULL, NULL),
(8, 'Comic', 'a comic book tag', 'comic-icon.png', NULL, NULL),
(9, 'Shounen', 'a japan comic category', 'japan-icon.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(10) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '?'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'ƒ'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '???'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', '??'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '?'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '?'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '?'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'K?'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', '¢'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', 'Rp'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '?'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '?'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '??'),
(64, 'Korea (North)', 'Won', 'KPW', '?'),
(65, 'Korea (South)', 'Won', 'KRW', '?'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', '??'),
(67, 'Laos', 'Kips', 'LAK', '?'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', '???'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '?'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '?'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '?'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '?'),
(88, 'North Korea', 'Won', 'KPW', '?'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '?'),
(91, 'Pakistan', 'Rupees', 'PKR', '?'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'z?'),
(97, 'Qatar', 'Rials', 'QAR', '?'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '???'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '?'),
(102, 'Serbia', 'Dinars', 'RSD', '???.'),
(103, 'Seychelles', 'Rupees', 'SCR', '?'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '?'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '?'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '?'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '£'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '?'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(126, 'Uzbekistan', 'Sums', 'UZS', '??'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '?'),
(130, 'Yemen', 'Rials', 'YER', '?'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `image_thumbnails`
--

CREATE TABLE `image_thumbnails` (
  `id` int(10) UNSIGNED NOT NULL,
  `thumbnail_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_size` double DEFAULT NULL,
  `alias` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  `album_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_thumbnails`
--

INSERT INTO `image_thumbnails` (`id`, `thumbnail_name`, `thumbnail_path`, `thumbnail_size`, `alias`, `image_id`, `album_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_10_bg1.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_10_bg1.jpg', NULL, '10_bg1.jpg', 1, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(2, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_9_bg2.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_9_bg2.jpg', NULL, '9_bg2.jpg', 2, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(3, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_6_bg5.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_6_bg5.jpg', NULL, '6_bg5.jpg', 3, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(4, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_3_comic-02.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_3_comic-02.jpg', NULL, '3_comic-02.jpg', 4, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(5, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_4_comic-01.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_4_comic-01.jpg', NULL, '4_comic-01.jpg', 5, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(6, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_7_bg4.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_7_bg4.jpg', NULL, '7_bg4.jpg', 6, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(7, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_2_comic-03.png', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_2_comic-03.png', NULL, '2_comic-03.png', 7, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(8, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_8_bg3.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_8_bg3.jpg', NULL, '8_bg3.jpg', 8, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(9, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_5_bg6.jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_5_bg6.jpg', NULL, '5_bg6.jpg', 9, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', '983ac884-2762-3e85-a7b7-51013cfd1a11'),
(10, 'thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_1_Snake_River_(5mb).jpg', 'image_thumbnails/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/thumb_f7992d2e-83e4-5198-a04b-8f5e6caadded_1_Snake_River_(5mb).jpg', NULL, '1_Snake_River_(5mb).jpg', 10, 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:21', '2017-10-23 21:01:21', '983ac884-2762-3e85-a7b7-51013cfd1a11');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double NOT NULL,
  `alias` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `album_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_thumbnail_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file_name`, `path`, `size`, `alias`, `album_id`, `created_at`, `updated_at`, `image_thumbnail_id`) VALUES
(1, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_10_bg1.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_10_bg1.jpg', 358827, '10_bg1.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', NULL),
(2, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_9_bg2.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_9_bg2.jpg', 134951, '9_bg2.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', NULL),
(3, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_6_bg5.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_6_bg5.jpg', 157758, '6_bg5.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', NULL),
(4, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_3_comic-02.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_3_comic-02.jpg', 121114, '3_comic-02.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:19', '2017-10-23 21:01:19', NULL),
(5, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_4_comic-01.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_4_comic-01.jpg', 146490, '4_comic-01.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', NULL),
(6, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_7_bg4.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_7_bg4.jpg', 320131, '7_bg4.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', NULL),
(7, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_2_comic-03.png', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_2_comic-03.png', 387543, '2_comic-03.png', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', NULL),
(8, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_8_bg3.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_8_bg3.jpg', 652834, '8_bg3.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', NULL),
(9, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_5_bg6.jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_5_bg6.jpg', 882412, '5_bg6.jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', NULL),
(10, 'f7992d2e-83e4-5198-a04b-8f5e6caadded_1_Snake_River_(5mb).jpg', 'uploaded_images/johndoe@example.com/f7992d2e-83e4-5198-a04b-8f5e6caadded/f7992d2e-83e4-5198-a04b-8f5e6caadded_1_Snake_River_(5mb).jpg', 5245329, '1_Snake_River_(5mb).jpg', 'f7992d2e-83e4-5198-a04b-8f5e6caadded', '2017-10-23 21:01:20', '2017-10-23 21:01:20', NULL);

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
(4, '2017_06_28_093543_create_albums_table', 2),
(5, '2017_06_28_095004_create_categories_table', 3),
(9, '2017_06_28_100335_create_album_category_table', 4),
(10, '2017_06_28_100626_create_images_table', 4),
(11, '2017_06_28_101903_create_image_thumbnails_table', 4),
(13, '2017_07_06_072526_add_columns_to_users', 5),
(14, '2017_07_13_084332_add_instagram_id_to_users', 6),
(16, '2017_07_14_085801_create_wallets_table', 7),
(17, '2017_07_14_090112_add_wallet_id_to_users', 8),
(18, '2017_07_14_092411_create_order_history_table', 9),
(19, '2017_07_17_043858_add_user_id_to_image_thumbnails', 10),
(20, '2017_07_17_092128_add_foreign_to_albums', 11),
(21, '2017_08_30_064116_add_phone_number_to_users', 11),
(26, '2017_08_31_083705_create_admin_users_table', 12),
(27, '2017_09_12_095353_add_image_thumbnail_id_to_images', 13),
(30, '2017_09_13_073737_create_withdraw_requests_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `album_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` char(19) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `instagram_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `provider_name`, `provider_id`, `avatar`, `about`, `phone_number`, `bank_name`, `account_number`, `currency_id`, `instagram_id`, `wallet_id`, `remember_token`, `created_at`, `updated_at`) VALUES
('983ac884-2762-3e85-a7b7-51013cfd1a11', 'John Doe', 'johndoe@example.com', '$2y$10$FfXE1apLximpGx5e2nslCOey3pIwVx19sM7FaYgW5tRmtknA6whJ2', NULL, NULL, NULL, 'Hello World!', '089652214479', NULL, NULL, 54, NULL, 11, 'twmyeD8Ldf8sFKRFcCFRcUTl61xUxigZx1Fr9DwfdcA5mPHJoE5FCivMrGgI', '2017-10-20 02:37:46', '2017-10-23 20:57:36'),
('f3c16e77-3a72-37fb-9a22-c6e6d3fb7114', 'Arnadi Denanda Surya', 'arz1893@gmail.com', NULL, 'facebook', '10210502862241008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dcbo8VDm8keOWfDjriHpy6E56yqKO4sSNLYUX2FDGoBuN1gAVDHGaRhrcFO6', '2017-10-22 20:42:51', '2017-10-22 20:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `deposit` double NOT NULL DEFAULT '0',
  `withdraw` double NOT NULL DEFAULT '0',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `deposit`, `withdraw`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 30000, 0, '983ac884-2762-3e85-a7b7-51013cfd1a11', '2017-10-20 02:37:46', '2017-10-22 20:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `album_category`
--
ALTER TABLE `album_category`
  ADD KEY `album_category_album_id_foreign` (`album_id`),
  ADD KEY `album_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`),
  ADD KEY `albums_album_cover_id_foreign` (`album_cover_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency` (`currency`);

--
-- Indexes for table `image_thumbnails`
--
ALTER TABLE `image_thumbnails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_thumbnails_image_id_foreign` (`image_id`),
  ADD KEY `image_thumbnails_album_id_foreign` (`album_id`),
  ADD KEY `image_thumbnails_user_id_foreign` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_album_id_foreign` (`album_id`),
  ADD KEY `images_image_thumbnail_id_foreign` (`image_thumbnail_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_history_user_id_foreign` (`user_id`),
  ADD KEY `order_history_album_id_foreign` (`album_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_currency_id_foreign` (`currency_id`),
  ADD KEY `users_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraw_requests_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `image_thumbnails`
--
ALTER TABLE `image_thumbnails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_category`
--
ALTER TABLE `album_category`
  ADD CONSTRAINT `album_category_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `album_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image_thumbnails`
--
ALTER TABLE `image_thumbnails`
  ADD CONSTRAINT `image_thumbnails_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `image_thumbnails_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `image_thumbnails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `images_image_thumbnail_id_foreign` FOREIGN KEY (`image_thumbnail_id`) REFERENCES `image_thumbnails` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `order_history_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD CONSTRAINT `withdraw_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
