-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2026 at 10:22 AM
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
-- Database: `grocery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `module`, `description`, `created_at`, `updated_at`) VALUES
(1, 4, 'Updated', 'Inventory', 'Updated product: Organic Carrots1 (ID: 43)', '2026-02-21 02:57:11', '2026-02-21 02:57:11'),
(2, 1, 'Updated', 'Staff Profile', 'Updated roles/permissions for: Store Staff', '2026-02-21 03:32:26', '2026-02-21 03:32:26'),
(3, 1, 'Updated', 'Inventory', 'Updated product: Red Tomatoes (ID: 44)', '2026-02-21 04:12:17', '2026-02-21 04:12:17'),
(4, 1, 'Updated', 'Inventory', 'Updated product: Fuji Apples (ID: 45)', '2026-02-21 11:24:20', '2026-02-21 11:24:20'),
(5, 1, 'Created', 'Inventory', 'Added a new product: Potatoes French (ID: 57)', '2026-02-21 11:45:23', '2026-02-21 11:45:23'),
(6, 1, 'Deleted', 'Staff Security', 'Permanently deleted account: Theatith', '2026-02-21 12:10:29', '2026-02-21 12:10:29'),
(7, 1, 'Updated', 'Staff Security', 'Deactivated account for: Berry', '2026-02-21 12:11:44', '2026-02-21 12:11:44'),
(8, 1, 'Updated', 'Staff Security', 'Reactivated account for: Berry', '2026-02-21 12:11:55', '2026-02-21 12:11:55'),
(9, 1, 'Updated', 'Staff Profile', 'Updated roles/permissions for: Mineral Water', '2026-02-21 12:21:16', '2026-02-21 12:21:16'),
(10, 1, 'Created', 'Staff Profile', 'Created new account for: Organic Carrots', '2026-02-21 12:27:26', '2026-02-21 12:27:26'),
(11, 1, 'Created', 'Staff Profile', 'Created new account for: Berry1', '2026-02-21 12:46:41', '2026-02-21 12:46:41'),
(12, 1, 'Updated', 'Inventory', 'Updated category: Vegetables', '2026-02-21 13:55:25', '2026-02-21 13:55:25'),
(13, 1, 'Updated', 'Inventory', 'Updated category: Vegetables', '2026-02-21 13:55:31', '2026-02-21 13:55:31'),
(14, 1, 'Updated', 'Staff Security', 'Deactivated account for: Organic Carrots', '2026-02-21 13:56:16', '2026-02-21 13:56:16'),
(15, 1, 'Created', 'Inventory', 'Added a new product: fish meat (ID: 58)', '2026-02-21 14:14:47', '2026-02-21 14:14:47'),
(16, 1, 'Updated', 'Inventory', 'Updated product: fish meat (ID: 58)', '2026-02-21 14:15:44', '2026-02-21 14:15:44'),
(17, 1, 'Created', 'Inventory', 'Added a new product: red (ID: 59)', '2026-02-21 14:37:31', '2026-02-21 14:37:31'),
(18, 1, 'Created', 'Inventory', 'Added a new product: នំប៉័ង (ID: 60)', '2026-02-21 14:43:11', '2026-02-21 14:43:11'),
(19, 1, 'Created', 'Inventory', 'Added a new product: ccaas (ID: 61)', '2026-02-21 14:43:34', '2026-02-21 14:43:34'),
(20, 1, 'Created', 'Inventory', 'Added a new product: pppp (ID: 62)', '2026-02-21 14:43:56', '2026-02-21 14:43:56'),
(21, 1, 'Created', 'Inventory', 'Added a new product: 12312 (ID: 63)', '2026-02-21 14:44:19', '2026-02-21 14:44:19'),
(22, 1, 'Created', 'Inventory', 'Added a new product: 12312 (ID: 64)', '2026-02-21 14:44:35', '2026-02-21 14:44:35'),
(23, 1, 'Created', 'Inventory', 'Added a new product: asdas (ID: 65)', '2026-02-21 14:44:45', '2026-02-21 14:44:45'),
(24, 1, 'Created', 'Inventory', 'Added a new product: 1213 (ID: 66)', '2026-02-21 14:44:54', '2026-02-21 14:44:54'),
(25, 1, 'Created', 'Inventory', 'Added a new product: 1213 (ID: 67)', '2026-02-21 14:44:55', '2026-02-21 14:44:55'),
(26, 1, 'Created', 'Inventory', 'Added a new product: 12312 (ID: 68)', '2026-02-21 14:45:03', '2026-02-21 14:45:03'),
(27, 1, 'Updated', 'Inventory', 'Updated product: 12312 (ID: 68)', '2026-02-21 14:46:24', '2026-02-21 14:46:24'),
(28, 1, 'Updated', 'Inventory', 'Updated product: 12312 (ID: 68)', '2026-02-21 14:46:33', '2026-02-21 14:46:33'),
(29, 1, 'Deleted', 'Staff Security', 'Permanently deleted account: Organic Carrots', '2026-02-21 15:05:58', '2026-02-21 15:05:58'),
(30, 1, 'Created', 'Inventory', 'Added a new product: banana (ID: 69)', '2026-02-21 15:17:05', '2026-02-21 15:17:05'),
(31, 1, 'Created', 'Inventory', 'Added a new product: asdsa (ID: 70)', '2026-02-21 15:18:13', '2026-02-21 15:18:13'),
(32, 1, 'Deleted', 'Inventory', 'Deleted product: asdsa (ID: 70)', '2026-02-21 15:25:29', '2026-02-21 15:25:29'),
(33, 1, 'Updated', 'Staff Security', 'Deactivated account for: Berry1', '2026-02-21 15:27:59', '2026-02-21 15:27:59'),
(34, 1, 'Created', 'Inventory', 'Added a new product: 1234 (ID: 71)', '2026-02-21 15:28:59', '2026-02-21 15:28:59'),
(35, 1, 'Updated', 'Inventory', 'Updated product: 1213 (ID: 67)', '2026-02-21 15:34:45', '2026-02-21 15:34:45'),
(36, 1, 'Updated', 'Inventory', 'Updated product: 1213 (ID: 67)', '2026-02-21 15:35:38', '2026-02-21 15:35:38'),
(37, 1, 'Updated', 'Inventory', 'Updated category: Vegetables', '2026-02-21 16:28:07', '2026-02-21 16:28:07'),
(38, 1, 'Updated', 'Inventory', 'Updated category: Vegetables', '2026-02-21 16:28:13', '2026-02-21 16:28:13'),
(39, 1, 'Created', 'Inventory', 'Created new category: Clothes', '2026-02-21 16:35:18', '2026-02-21 16:35:18'),
(40, 1, 'Updated', 'Inventory', 'Updated product: 12312 (ID: 68)', '2026-02-21 16:48:48', '2026-02-21 16:48:48'),
(41, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-21 16:52:42', '2026-02-21 16:52:42'),
(42, 1, 'Updated', 'Inventory', 'Updated product: 12312 (ID: 68)', '2026-02-21 16:53:05', '2026-02-21 16:53:05'),
(43, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-21 16:54:17', '2026-02-21 16:54:17'),
(44, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-21 17:05:28', '2026-02-21 17:05:28'),
(45, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-21 17:11:00', '2026-02-21 17:11:00'),
(46, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:13:35', '2026-02-21 17:13:35'),
(47, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:13:45', '2026-02-21 17:13:45'),
(48, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:13:53', '2026-02-21 17:13:53'),
(49, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:16:49', '2026-02-21 17:16:49'),
(50, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:16:59', '2026-02-21 17:16:59'),
(51, 1, 'Deleted', 'Inventory', 'Deleted product: banana (ID: 69)', '2026-02-21 17:18:52', '2026-02-21 17:18:52'),
(52, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:22:59', '2026-02-21 17:22:59'),
(53, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-21 17:23:09', '2026-02-21 17:23:09'),
(54, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:29:56', '2026-02-21 17:29:56'),
(55, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-21 17:30:18', '2026-02-21 17:30:18'),
(56, 1, 'Deleted', 'Inventory', 'Deleted product: 1234 (ID: 71)', '2026-02-21 17:30:29', '2026-02-21 17:30:29'),
(57, 1, 'Deleted', 'Inventory', 'Deleted product: 1234 (ID: 71)', '2026-02-21 17:32:48', '2026-02-21 17:32:48'),
(58, 1, 'RESTORED', 'Inventory', 'Restored product: 1234 (ID: 71)', '2026-02-21 17:33:00', '2026-02-21 17:33:00'),
(59, 1, 'Updated', 'Inventory', 'Updated product: banana (ID: 69)', '2026-02-21 18:27:09', '2026-02-21 18:27:09'),
(60, 1, 'customer_status_change', 'Customer Management', 'Suspended customer account: nou.sovannarout63827@gmail.com', '2026-02-22 05:14:26', '2026-02-22 05:14:26'),
(61, 1, 'customer_status_change', 'Customer Management', 'Suspended customer account: nou.sovannarout@gmail.com', '2026-02-22 05:14:30', '2026-02-22 05:14:30'),
(62, 1, 'customer_status_change', 'Customer Management', 'Activated customer account: nou.sovannarout63827@gmail.com', '2026-02-22 05:14:32', '2026-02-22 05:14:32'),
(63, 1, 'customer_status_change', 'Customer Management', 'Suspended customer account: nou.sovannarout63827@gmail.com', '2026-02-22 05:14:35', '2026-02-22 05:14:35'),
(64, 1, 'customer_status_change', 'Customer Management', 'Activated customer account: nou.sovannarout@gmail.com', '2026-02-22 05:14:36', '2026-02-22 05:14:36'),
(65, 1, 'Updated', 'Inventory', 'Updated product: Chocolate Croissant (ID: 41)', '2026-02-22 05:29:30', '2026-02-22 05:29:30'),
(66, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-22 05:29:45', '2026-02-22 05:29:45'),
(67, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-22 05:29:51', '2026-02-22 05:29:51'),
(68, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-22 05:29:58', '2026-02-22 05:29:58'),
(69, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-22 05:30:03', '2026-02-22 05:30:03'),
(70, 1, 'Updated', 'Inventory', 'Updated category: Clothes', '2026-02-22 05:32:09', '2026-02-22 05:32:09'),
(71, 1, 'Updated', 'Inventory', 'Updated category: Clothes', '2026-02-22 05:44:08', '2026-02-22 05:44:08'),
(72, 1, 'Updated', 'Inventory', 'Updated category: Clothes', '2026-02-22 05:48:19', '2026-02-22 05:48:19'),
(73, 1, 'Updated', 'Inventory', 'Updated category: Vegetables', '2026-02-22 05:49:40', '2026-02-22 05:49:40'),
(74, 1, 'Updated', 'Inventory', 'Updated category: Fruits', '2026-02-22 05:51:01', '2026-02-22 05:51:01'),
(75, 1, 'Updated', 'Inventory', 'Updated category: Vegetables', '2026-02-22 05:52:45', '2026-02-22 05:52:45'),
(76, 1, 'Updated', 'Inventory', 'Updated category: Meat & Fish', '2026-02-22 05:54:23', '2026-02-22 05:54:23'),
(77, 1, 'Updated', 'Inventory', 'Updated category: Dairy & Eggs', '2026-02-22 05:55:20', '2026-02-22 05:55:20'),
(78, 1, 'Updated', 'Inventory', 'Updated category: Beverages', '2026-02-22 05:56:00', '2026-02-22 05:56:00'),
(79, 1, 'Updated', 'Inventory', 'Updated category: Meat & Fish', '2026-02-22 05:56:28', '2026-02-22 05:56:28'),
(80, 1, 'Updated', 'Inventory', 'Updated category: Bakery', '2026-02-22 05:57:32', '2026-02-22 05:57:32'),
(81, 1, 'Updated', 'Inventory', 'Updated category: Snacks', '2026-02-22 06:00:57', '2026-02-22 06:00:57'),
(82, 1, 'Updated', 'Inventory', 'Updated category: Dairy & Eggs', '2026-02-22 06:01:37', '2026-02-22 06:01:37'),
(83, 1, 'Updated', 'Inventory', 'Updated category: Frozen Food', '2026-02-22 06:03:14', '2026-02-22 06:03:14'),
(84, 1, 'Updated', 'Inventory', 'Updated category: Frozen Food', '2026-02-22 06:03:15', '2026-02-22 06:03:15'),
(85, 1, 'order_placed', 'Orders', 'Customer placed order #3', '2026-02-22 06:13:39', '2026-02-22 06:13:39'),
(86, 12, 'order_placed', 'Orders', 'Customer placed order #4', '2026-02-22 06:32:33', '2026-02-22 06:32:33'),
(87, 1, 'customer_status_change', 'Customer Management', 'Activated customer account: nou.sovannarout63827@gmail.com', '2026-02-22 06:49:41', '2026-02-22 06:49:41'),
(88, 13, 'order_placed', 'Orders', 'Customer placed order #5', '2026-02-22 06:51:49', '2026-02-22 06:51:49'),
(89, 13, 'order_placed', 'Orders', 'Customer placed order #6', '2026-02-22 07:08:20', '2026-02-22 07:08:20'),
(90, 13, 'order_placed', 'Orders', 'Customer placed order #7', '2026-02-22 10:15:28', '2026-02-22 10:15:28'),
(91, 1, 'Updated', 'Inventory', 'Updated product: banana (ID: 69)', '2026-02-22 10:33:57', '2026-02-22 10:33:57'),
(92, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-22 10:34:08', '2026-02-22 10:34:08'),
(93, 13, 'order_placed', 'Orders', 'Customer placed order #8', '2026-02-22 11:07:36', '2026-02-22 11:07:36'),
(94, 13, 'order_placed', 'Orders', 'Customer placed order #9', '2026-02-22 12:05:57', '2026-02-22 12:05:57'),
(95, 13, 'order_placed', 'Orders', 'Customer placed order #10', '2026-02-22 13:06:09', '2026-02-22 13:06:09'),
(96, 1, 'customer_status_change', 'Customer Management', 'Suspended customer account: makara@gmail.com', '2026-02-22 14:39:01', '2026-02-22 14:39:01'),
(97, 1, 'customer_status_change', 'Customer Management', 'Activated customer account: makara@gmail.com', '2026-02-22 14:39:04', '2026-02-22 14:39:04'),
(98, 1, 'Updated', 'Staff Security', 'Reactivated account for: Berry1', '2026-02-22 14:39:30', '2026-02-22 14:39:30'),
(99, 1, 'Updated', 'Staff Security', 'Deactivated account for: Berry1', '2026-02-22 14:39:37', '2026-02-22 14:39:37'),
(100, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-22 15:35:12', '2026-02-22 15:35:12'),
(101, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-22 15:37:26', '2026-02-22 15:37:26'),
(102, 1, 'Updated', 'Inventory', 'Updated product: asdsa (ID: 70)', '2026-02-22 15:37:52', '2026-02-22 15:37:52'),
(103, 13, 'order_placed', 'Orders', 'Customer placed order #11', '2026-02-22 16:57:20', '2026-02-22 16:57:20'),
(104, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #11 for delivery', '2026-02-22 17:26:59', '2026-02-22 17:26:59'),
(105, 2, 'Delivered Order', 'Delivery', 'Driver Delivery Driver completed delivery of Order #11 - $7.00 (Pre-paid)', '2026-02-22 17:27:22', '2026-02-22 17:27:22'),
(106, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #6 for delivery', '2026-02-22 18:04:00', '2026-02-22 18:04:00'),
(107, 2, 'Delivered Order', 'Delivery', 'Driver Delivery Driver completed delivery of Order #6 - $123.00 (Pre-paid)', '2026-02-22 18:07:34', '2026-02-22 18:07:34'),
(108, 13, 'order_placed', 'Orders', 'Customer placed order #12', '2026-02-23 06:45:55', '2026-02-23 06:45:55'),
(109, 13, 'order_placed', 'Orders', 'Customer placed order #13', '2026-02-23 07:06:50', '2026-02-23 07:06:50'),
(110, 1, 'Updated', 'Staff', 'Updated profile information for: Mineral Water', '2026-02-23 08:15:16', '2026-02-23 08:15:16'),
(111, 1, 'Created', 'Staff', 'Created new account for: Super Admin1', '2026-02-23 08:38:32', '2026-02-23 08:38:32'),
(112, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-23 09:21:07', '2026-02-23 09:21:07'),
(113, 14, 'Logged Out', 'Auth', 'Super Admin1 logged out', '2026-02-23 09:21:20', '2026-02-23 09:21:20'),
(114, 1, 'profile_photo_updated', 'Profile', 'Updated profile photo', '2026-02-23 09:22:06', '2026-02-23 09:22:06'),
(115, 1, 'profile_updated', 'Profile', 'Updated profile information', '2026-02-23 09:22:09', '2026-02-23 09:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `icon` varchar(255) DEFAULT NULL,
  `emoji` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `is_active`, `icon`, `emoji`, `created_at`, `updated_at`) VALUES
(1, 'Vegetables', 'vegetables', NULL, NULL, 1, 'category-icons/1v2NWsOh4I9oxzIKLBpNcsUl0cYrigO8s3oYLE5F.png', NULL, '2026-02-20 00:57:34', '2026-02-22 05:52:45'),
(2, 'Fruits', 'fruits', NULL, NULL, 1, 'category-icons/rErY7zO26bUeWmnJJm6UgWv6HHyNoQb1RZa3voKx.png', NULL, '2026-02-20 00:57:34', '2026-02-22 05:51:01'),
(3, 'Meat & Fish', 'meat-fish', NULL, NULL, 1, NULL, '🥩', '2026-02-20 00:57:34', '2026-02-22 05:56:28'),
(4, 'Dairy & Eggs', 'dairy-eggs', NULL, NULL, 1, NULL, '🥚', '2026-02-20 00:57:34', '2026-02-22 06:01:37'),
(5, 'Beverages', 'beverages', NULL, NULL, 1, NULL, '🍷', '2026-02-20 00:57:34', '2026-02-22 05:56:00'),
(6, 'Frozen Food', 'frozen-food', NULL, NULL, 1, 'category-icons/9jrISJhnuetIKAst9XXXj06UDvo3V3FEu6ZBfKws.png', NULL, '2026-02-20 00:57:34', '2026-02-22 06:03:15'),
(7, 'Bakery', 'bakery', NULL, NULL, 1, NULL, '🍞', '2026-02-20 00:57:34', '2026-02-22 05:57:32'),
(8, 'Snacks', 'snacks', NULL, NULL, 1, 'category-icons/b6Sj3nsRQm1nVRIdwjEdNMMagmBoH6qRc5qsx71Z.png', NULL, '2026-02-20 00:57:34', '2026-02-22 06:00:57'),
(10, 'Clothes', 'clothes', 'asdasd', NULL, 1, 'category-icons/RlOXDYEiyt4wZAQEiaWTpJ5CCBjwScnnJS6WZdBS.png', NULL, '2026-02-21 16:35:18', '2026-02-22 05:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('fixed','percent') NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `min_purchase` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_purchase`, `status`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME10', 'fixed', 10.00, 30.00, 1, NULL, '2026-02-22 09:09:42', '2026-02-22 09:09:42'),
(2, 'FRESH20', 'percent', 20.00, 50.00, 1, '2026-05-22 09:09:42', '2026-02-22 09:09:42', '2026-02-22 09:09:42'),
(3, 'SAVE5', 'fixed', 5.00, 20.00, 1, NULL, '2026-02-22 09:09:42', '2026-02-22 09:09:42'),
(4, 'HALF50', 'percent', 50.00, 100.00, 1, '2026-03-22 09:09:42', '2026-02-22 09:09:42', '2026-02-22 09:09:42'),
(5, 'EXPIRED', 'percent', 30.00, 0.00, 1, '2026-02-15 09:09:42', '2026-02-22 09:09:42', '2026-02-22 09:09:42'),
(6, 'DISABLED', 'fixed', 15.00, 0.00, 0, NULL, '2026-02-22 09:09:42', '2026-02-22 09:09:42'),
(7, 'FREEDELIVERY', 'fixed', 6.00, 0.00, 1, NULL, '2026-02-22 11:55:02', '2026-02-22 11:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_18_104511_create_categories_table', 1),
(5, '2026_02_18_114452_create_products_table', 1),
(6, '2026_02_18_121509_create_orders_table', 1),
(7, '2026_02_18_163319_add_soft_deletes_to_products_table', 1),
(8, '2026_02_20_065456_create_personal_access_tokens_table', 1),
(9, '2026_02_20_071839_add_avatar_to_users_table', 1),
(10, '2026_02_20_150904_add_deleted_at_to_products_table', 2),
(11, '2026_02_21_000001_update_role_default_in_users_table', 3),
(12, '2026_02_21_052105_add_role_to_users_table', 3),
(13, '2026_02_21_000002_add_unit_to_products_table', 4),
(14, '2026_02_21_000003_change_image_to_images_in_products_table', 5),
(16, '2026_02_21_000004_create_product_images_table', 6),
(17, '2026_02_21_075626_create_role_histories_table', 7),
(18, '2026_02_21_081624_add_permissions_to_users_table', 8),
(19, '2026_02_21_083122_add_profile_photo_to_users_table', 9),
(20, '2026_02_21_083605_create_activity_logs_table', 10),
(21, '2026_02_21_105206_add_status_to_users_table', 11),
(22, '2026_02_21_195208_add_personal_info_to_users_table', 12),
(23, '2026_02_21_201032_update_categories_and_products_tables', 13),
(24, '2026_02_22_123741_add_emoji_to_categories_table', 14),
(25, '2026_02_22_131204_create_order_items_table', 15),
(26, '2026_02_22_135838_add_shipping_details_to_orders_table', 16),
(27, '2026_02_22_140810_backfill_order_shipping_details', 17),
(28, '2026_02_22_142420_add_cancellation_reason_to_orders_table', 18),
(29, '2026_02_22_160536_create_coupons_table', 19),
(30, '2026_02_22_164135_create_wishlists_table', 20),
(31, '2026_02_22_225123_add_delivery_notes_to_orders_table', 21),
(32, '2026_02_22_231704_update_order_statuses_enum', 22);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ready_for_pickup',
  `cancellation_reason` text DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `delivery_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `driver_id`, `total_amount`, `phone`, `delivery_address`, `address`, `status`, `cancellation_reason`, `payment_method`, `payment_status`, `delivery_notes`, `created_at`, `updated_at`) VALUES
(5, 13, NULL, 1.00, '123456667', NULL, 'Cambodia, Phnom Penh 123235463', 'delivered', NULL, 'cash', 'unpaid', NULL, '2026-02-22 06:51:48', '2026-02-22 06:54:08'),
(6, 13, 2, 123.00, '123498092384092348', 'Cambodia, Phnom Penh 123235463', 'Cambodia, Phnom Penh 123235463', 'delivered', NULL, 'cash', 'unpaid', NULL, '2026-02-22 07:08:20', '2026-02-22 18:07:34'),
(7, 13, NULL, 10.00, 'asdasd', 'Cambodia, Phnom Penh asdasd', 'Cambodia, Phnom Penh asdasd', 'delivered', NULL, 'cash', 'paid', NULL, '2026-02-22 10:15:28', '2026-02-22 11:18:57'),
(8, 13, NULL, 40.00, '124637454756', 'Cambodia, Phnom Penh 1231445', 'Cambodia, Phnom Penh 1231445', 'delivered', NULL, 'card', 'paid', NULL, '2026-02-22 11:07:36', '2026-02-22 11:18:36'),
(9, 13, 2, 40.00, '124637454756', 'Cambodia, Phnom Penh 1231445', 'Cambodia, Phnom Penh 1231445', 'delivered', NULL, 'cash', 'unpaid', NULL, '2026-02-22 12:05:57', '2026-02-22 16:34:06'),
(10, 13, 2, 7.00, 'asdasd', 'Cambodia, Phnom Penh asdasd', 'Cambodia, Phnom Penh asdasd', 'delivered', NULL, 'cash', 'paid', NULL, '2026-02-22 13:06:09', '2026-02-22 17:24:13'),
(11, 13, 2, 7.00, 'asdasd', 'Cambodia, Phnom Penh asdasd', 'Cambodia, Phnom Penh asdasd', 'delivered', NULL, 'cash', 'unpaid', NULL, '2026-02-22 16:57:20', '2026-02-22 17:27:22'),
(12, 13, NULL, 7.00, '015868608', 'Cambodia, Phnom Penh asdasd', 'Cambodia, Phnom Penh asdasd', 'cancelled', 'OutofStock', 'cash', 'unpaid', NULL, '2026-02-23 06:45:55', '2026-02-23 06:48:35'),
(13, 13, NULL, 11.00, '0158686089', 'asdas, asd qwseqw', 'asdas, asd qwseqw', 'pending', NULL, 'cash', 'unpaid', NULL, '2026-02-23 07:06:50', '2026-02-23 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(3, 5, 69, 1, 1.00, 1.00, '2026-02-22 06:51:48', '2026-02-22 06:51:48'),
(4, 6, 58, 1, 123.00, 123.00, '2026-02-22 07:08:20', '2026-02-22 07:08:20'),
(5, 7, 69, 3, 1.00, 3.00, '2026-02-22 10:15:28', '2026-02-22 10:15:28'),
(6, 7, 57, 1, 1.00, 1.00, '2026-02-22 10:15:28', '2026-02-22 10:15:28'),
(7, 8, 69, 50, 1.00, 50.00, '2026-02-22 11:07:36', '2026-02-22 11:07:36'),
(8, 9, 69, 50, 1.00, 50.00, '2026-02-22 12:05:57', '2026-02-22 12:05:57'),
(9, 10, 69, 1, 1.00, 1.00, '2026-02-22 13:06:09', '2026-02-22 13:06:09'),
(10, 11, 69, 1, 1.00, 1.00, '2026-02-22 16:57:20', '2026-02-22 16:57:20'),
(11, 12, 69, 1, 1.00, 1.00, '2026-02-23 06:45:55', '2026-02-23 06:45:55'),
(12, 13, 69, 5, 1.00, 5.00, '2026-02-23 07:06:50', '2026-02-23 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `unit` varchar(255) NOT NULL DEFAULT 'piece',
  `min_stock_level` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `images`, `price`, `stock`, `image`, `description`, `is_active`, `unit`, `min_stock_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Organic Carrots', 'organic-carrots-1', NULL, '[\"products/NSnsrtPnbt05OwkAjIWbHLHy9kKx9mMH11wxzBlN.jpg\"]', 1.50, 1, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(2, 1, 'Red Tomatoes', 'red-tomatoes-2', NULL, '[\"products/RomXFWb8I6qWl06tzB3o59pTXXk12oULXGrvvO03.jpg\"]', 2.00, 3, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(3, 2, 'Fuji Apples', 'fuji-apples-3', NULL, '[\"products/cyby0XozzWxjrbrZt5cfcMBwNIUVc6RQBhHdtUTM.jpg\"]', 3.00, 2, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(4, 2, 'Cavendish Bananas', 'cavendish-bananas-4', NULL, '[\"products/1khha5AVUI50ITXeKjz0Kh2R4n2U1igvfYZzUBrQ.jpg\"]', 1.20, 4, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(5, 3, 'Chicken Breast', 'chicken-breast-5', NULL, '[\"products/pNJiJNXWjIYrlVaEpKmKwZKwmizEywc8AUs1ZVjQ.jpg\"]', 5.50, 3, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(6, 3, 'Fresh Salmon', 'fresh-salmon-6', NULL, '[\"products/5ViaevIAdwHQAlBKaLutSYPvJX8ofTEwtzZYYbQr.jpg\"]', 12.00, 4, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(7, 4, 'Whole Milk', 'whole-milk-7', NULL, '[\"products/RAZLATpGNvqLlO3BeSUco5hzedN7ZE8seU4T44Bo.jpg\"]', 2.50, 2, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(8, 4, 'Brown Eggs (12pk)', 'brown-eggs-12pk-8', NULL, '[\"products/gLLZP3tgoGNYg7U3mnTEx6ZX1AXShtVOD2sUmmUC.jpg\"]', 4.00, 2, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(9, 5, 'Coca-Cola 1.5L', 'coca-cola-15l-9', NULL, '[\"products/ueDdwApBIanlsRsWCXhJEMxxMXEm6wWigZnh9nqy.jpg\"]', 1.50, 1, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(10, 5, 'Mineral Water', 'mineral-water-10', NULL, '[\"products/35H7idlukvoUaz6AtlzPASk5OzWC3LOuJ9NV0ZXF.jpg\"]', 0.50, 1, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(11, 6, 'Vanilla Ice Cream', 'vanilla-ice-cream-11', NULL, '[\"products/rRbcKwe7DvUpP8CzEXQ3nyK0vtjdkkxthgxJyM3F.jpg\"]', 4.50, 4, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(12, 7, 'White Bread', 'white-bread-12', NULL, '[\"products/nlRWZcmTQlMdp03P5pgULb5bTtJunzVcwsRYjk6V.jpg\"]', 1.00, 3, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(13, 7, 'Chocolate Croissant', 'chocolate-croissant-13', NULL, '[\"products/oVW1mqOCxnZqzfwOKloobkRWah8AKHhRA59iC8wQ.jpg\"]', 2.50, 1, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(14, 8, 'Potato Chips', 'potato-chips-14', NULL, '[\"products/hoZ9dcoTbiPtZofENuOGFhBCesc96dqG05JYnK8z.jpg\"]', 1.80, 1, NULL, NULL, 1, 'piece', 5, '2026-02-20 00:57:34', '2026-02-21 18:31:55', NULL),
(15, 2, 'Passion', 'passion-15', NULL, '[\"products/UHfQ6PGKznsHIAHPUSB8NOvw6RQttSVTmsehhb6s.jpg\"]', 1.00, 100, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:02:30', '2026-02-21 18:31:55', NULL),
(16, 2, 'Orange', 'orange-16', NULL, '[\"products/NGWrMghjrH7fAAfdYoEm83C2bQZaEeFjkmBAseOm.jpg\"]', 1.00, 100, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:03:52', '2026-02-21 18:31:55', NULL),
(17, 2, 'Mango', 'mango-17', NULL, '[\"products/gH54F2lsPPzhSBz1vgjv8uxVlwtzJBeLChsBazPx.jpg\"]', 1.00, 12, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:04:23', '2026-02-21 18:31:55', NULL),
(18, 2, 'Pear', 'pear-18', NULL, '[\"products/sTGorhiyAVqyhWSNYd7qAAN1CC5OggAIP7Kpuk4R.jpg\"]', 1.00, 111, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:04:58', '2026-02-21 18:31:55', NULL),
(19, 5, 'Yoes Coo', 'yoes-coo-19', NULL, '[\"products/x9mxRecacExHWpCx3jrZY3d05BrramAgbQbN7sqN.jpg\"]', 1.00, 111, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:05:36', '2026-02-21 18:31:55', NULL),
(20, 5, 'Sting', 'sting-20', NULL, '[\"products/ntuzwGvVLTT5IjVfhKiMhUrFzqfIDtjmcVnoDkTk.jpg\"]', 1.00, 111, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:05:52', '2026-02-21 18:31:55', NULL),
(21, 5, 'Redbull', 'redbull-21', NULL, '[\"products/ePLbA4OImz9SauT3vM1LcnhDT9JjnkkjY8qtnBw4.jpg\"]', 1.00, 232, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:06:06', '2026-02-21 18:31:55', NULL),
(23, 5, 'Pepci', 'pepci-23', NULL, '[\"products/cXyRDQLSbBFv3WCAYgJGz4aOlQb8nZEt2LIaN26K.jpg\"]', 1.00, 3213, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:06:28', '2026-02-21 18:31:55', NULL),
(24, 2, 'Blue berry', 'blue-berry-24', NULL, '[\"products/5DEDp1HorxdDXlcr6S6vLKARdXR7Cel5fY4zWo7c.jpg\"]', 1.00, 5345, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:08:43', '2026-02-21 18:31:55', NULL),
(25, 2, 'Water Melon', 'water-melon-25', NULL, '[\"products/ukDcCY9V8KJfzJMxXFfB11wxYdiBfG6YhOjcX8l6.jpg\"]', 1.00, 23, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:09:07', '2026-02-21 18:31:55', NULL),
(26, 2, 'Papaya', 'papaya-26', NULL, '[\"products/VhlAfmgKLE802jzykItNQfj88JRITucZcji60LIo.jpg\"]', 3.00, 22, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:09:29', '2026-02-21 18:31:55', NULL),
(27, 2, 'Berry', 'berry-27', NULL, '[\"products/LVhfGNhD78s3fZtKQLL01N7iYGJDGVl1skinJokn.jpg\"]', 2.00, 0, NULL, NULL, 1, 'piece', 5, '2026-02-20 09:10:08', '2026-02-21 18:31:55', NULL),
(28, 5, 'Redbull', 'redbull-28', NULL, '[\"products/eAKw7D02ROUbnTrswJQqRBytwgvJ4bfB10pddbAN.jpg\"]', 1.00, 455, NULL, NULL, 1, 'piece', 5, '2026-02-20 10:07:17', '2026-02-21 18:31:55', NULL),
(29, 1, 'Organic Carrots', 'organic-carrots-29', NULL, NULL, 1.50, 50, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(30, 1, 'Red Tomatoes', 'red-tomatoes-30', NULL, NULL, 2.00, 3, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(31, 2, 'Fuji Apples', 'fuji-apples-31', NULL, NULL, 3.00, 25, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(32, 2, 'Cavendish Bananas', 'cavendish-bananas-32', NULL, NULL, 1.20, 40, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(33, 3, 'Chicken Breast', 'chicken-breast-33', NULL, NULL, 5.50, 15, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(34, 3, 'Fresh Salmon', 'fresh-salmon-34', NULL, NULL, 12.00, 8, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(35, 4, 'Whole Milk', 'whole-milk-35', NULL, NULL, 2.50, 2, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(36, 4, 'Brown Eggs (12pk)', 'brown-eggs-12pk-36', NULL, NULL, 4.00, 20, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(37, 5, 'Coca-Cola 1.5L', 'coca-cola-15l-37', NULL, NULL, 1.50, 100, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(38, 5, 'Mineral Water', 'mineral-water-38', NULL, NULL, 0.50, 200, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(39, 6, 'Vanilla Ice Cream', 'vanilla-ice-cream-39', NULL, NULL, 4.50, 12, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(40, 7, 'White Bread', 'white-bread-40', NULL, NULL, 1.00, 30, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(41, 7, 'Chocolate Croissant', 'chocolate-croissant-41', 'PRD-UC5JKXXR', NULL, 2.50, 20, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-22 05:29:30', NULL),
(42, 8, 'Potato Chips', 'potato-chips-42', NULL, NULL, 1.80, 60, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:23:26', '2026-02-21 18:31:55', NULL),
(43, 1, 'Organic Carrots1', 'organic-carrots1-43', NULL, NULL, 1.50, 50, NULL, NULL, 1, 'Kg', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(44, 1, 'Red Tomatoes', 'red-tomatoes-44', NULL, NULL, 2.00, 6, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(45, 2, 'Fuji Apples', 'fuji-apples-45', NULL, NULL, 3.00, 25, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(46, 2, 'Cavendish Bananas', 'cavendish-bananas-46', NULL, NULL, 1.20, 40, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(47, 3, 'Chicken Breast', 'chicken-breast-47', NULL, NULL, 5.50, 15, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(48, 3, 'Fresh Salmon', 'fresh-salmon-48', NULL, NULL, 12.00, 8, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(49, 4, 'Whole Milk', 'whole-milk-49', NULL, NULL, 2.50, 2, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(50, 4, 'Brown Eggs (12pk)', 'brown-eggs-12pk-50', NULL, NULL, 4.00, 20, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(51, 5, 'Coca-Cola 1.5L', 'coca-cola-15l-51', NULL, NULL, 1.50, 100, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(52, 5, 'Mineral Water', 'mineral-water-52', NULL, NULL, 0.50, 200, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(53, 6, 'Vanilla Ice Cream', 'vanilla-ice-cream-53', NULL, NULL, 4.50, 12, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(54, 7, 'White Bread', 'white-bread-54', NULL, NULL, 1.00, 30, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(55, 7, 'Chocolate Croissant', 'chocolate-croissant-55', NULL, NULL, 2.50, 10, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(56, 8, 'Potato Chips', 'potato-chips-56', NULL, NULL, 1.80, 60, NULL, NULL, 1, 'piece', 5, '2026-02-20 22:24:12', '2026-02-21 18:31:55', NULL),
(57, 1, 'Potatoes French', 'potatoes-french-57', NULL, NULL, 1.00, 99, NULL, NULL, 1, 'bunch', 5, '2026-02-21 11:45:23', '2026-02-22 10:15:28', NULL),
(58, 3, 'fish meat', 'fish-meat', 'PRD-GFHI2UGV', NULL, 123.00, 122, NULL, NULL, 1, 'g', 5, '2026-02-21 14:14:47', '2026-02-22 07:08:20', NULL),
(59, 5, 'red', 'red', 'PRD-6BSCXYUR', NULL, 1.00, 0, NULL, NULL, 1, 'can', 5, '2026-02-21 14:37:31', '2026-02-21 14:37:31', NULL),
(60, 1, 'នំប៉័ង', '-60', 'PRD-YNGXPWNQ', NULL, 1.00, 0, NULL, NULL, 1, 'piece', 5, '2026-02-21 14:43:11', '2026-02-21 18:31:55', NULL),
(61, 8, 'ccaas', 'ccaas', 'PRD-A23USFAG', NULL, 12.00, 0, NULL, NULL, 1, 'pack', 5, '2026-02-21 14:43:34', '2026-02-21 14:43:34', NULL),
(62, 5, 'pppp', 'pppp', 'PRD-JV2IVDXA', NULL, 1.00, 0, NULL, NULL, 1, 'case', 5, '2026-02-21 14:43:55', '2026-02-21 14:43:55', NULL),
(63, 5, '12312', '12312', 'PRD-VCWQDUAS', NULL, 1.00, 0, NULL, NULL, 1, 'case', 5, '2026-02-21 14:44:19', '2026-02-21 14:44:19', NULL),
(64, 5, '12312', '12312', 'PRD-CNQ1XHOV', NULL, 1.00, 0, NULL, NULL, 1, 'bottle', 5, '2026-02-21 14:44:35', '2026-02-21 14:44:35', NULL),
(65, 1, 'asdas', 'asdas', 'PRD-VH4DYSWT', NULL, 1.00, 0, NULL, NULL, 1, 'Kg', 5, '2026-02-21 14:44:45', '2026-02-21 14:44:45', NULL),
(66, 3, '1213', '1213', 'PRD-VPKICNOT', NULL, 1.00, 0, NULL, NULL, 1, 'Kg', 5, '2026-02-21 14:44:54', '2026-02-21 14:44:54', NULL),
(67, 3, '1213', '1213', 'PRD-WTVNTWVQ', NULL, 1.00, 0, NULL, NULL, 1, 'Kg', 5, '2026-02-21 14:44:55', '2026-02-21 15:35:38', NULL),
(68, 2, '12312', '12312', 'PRD-12UZZBQD', NULL, 11.00, 0, NULL, NULL, 1, 'Kg', 5, '2026-02-21 14:45:03', '2026-02-21 16:53:05', NULL),
(69, 2, 'Banana', 'banana', 'PRD-XCJWOJOV', NULL, 1.00, 492, NULL, NULL, 1, 'pack', 5, '2026-02-21 15:17:04', '2026-02-23 07:06:50', NULL),
(70, 1, 'asdsa', 'asdsa', 'PRD-RGCA9KAM', NULL, 1.00, 100, NULL, NULL, 1, 'Kg', 5, '2026-02-21 15:18:13', '2026-02-22 15:37:52', NULL),
(71, 1, '1234', '1234', 'PRD-JRKDBQNK', NULL, 1.00, 0, NULL, NULL, 1, 'g', 5, '2026-02-21 15:28:59', '2026-02-22 06:13:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'products/NSnsrtPnbt05OwkAjIWbHLHy9kKx9mMH11wxzBlN.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(2, 2, 'products/RomXFWb8I6qWl06tzB3o59pTXXk12oULXGrvvO03.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(3, 3, 'products/cyby0XozzWxjrbrZt5cfcMBwNIUVc6RQBhHdtUTM.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(4, 4, 'products/1khha5AVUI50ITXeKjz0Kh2R4n2U1igvfYZzUBrQ.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(5, 5, 'products/pNJiJNXWjIYrlVaEpKmKwZKwmizEywc8AUs1ZVjQ.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(6, 6, 'products/5ViaevIAdwHQAlBKaLutSYPvJX8ofTEwtzZYYbQr.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(7, 7, 'products/RAZLATpGNvqLlO3BeSUco5hzedN7ZE8seU4T44Bo.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(8, 8, 'products/gLLZP3tgoGNYg7U3mnTEx6ZX1AXShtVOD2sUmmUC.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(9, 9, 'products/ueDdwApBIanlsRsWCXhJEMxxMXEm6wWigZnh9nqy.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(10, 10, 'products/35H7idlukvoUaz6AtlzPASk5OzWC3LOuJ9NV0ZXF.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(11, 11, 'products/rRbcKwe7DvUpP8CzEXQ3nyK0vtjdkkxthgxJyM3F.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(12, 12, 'products/nlRWZcmTQlMdp03P5pgULb5bTtJunzVcwsRYjk6V.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(13, 13, 'products/oVW1mqOCxnZqzfwOKloobkRWah8AKHhRA59iC8wQ.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(14, 14, 'products/hoZ9dcoTbiPtZofENuOGFhBCesc96dqG05JYnK8z.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(15, 15, 'products/UHfQ6PGKznsHIAHPUSB8NOvw6RQttSVTmsehhb6s.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(16, 16, 'products/NGWrMghjrH7fAAfdYoEm83C2bQZaEeFjkmBAseOm.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(17, 17, 'products/gH54F2lsPPzhSBz1vgjv8uxVlwtzJBeLChsBazPx.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(18, 18, 'products/sTGorhiyAVqyhWSNYd7qAAN1CC5OggAIP7Kpuk4R.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(19, 19, 'products/x9mxRecacExHWpCx3jrZY3d05BrramAgbQbN7sqN.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(20, 20, 'products/ntuzwGvVLTT5IjVfhKiMhUrFzqfIDtjmcVnoDkTk.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(21, 21, 'products/ePLbA4OImz9SauT3vM1LcnhDT9JjnkkjY8qtnBw4.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(23, 23, 'products/cXyRDQLSbBFv3WCAYgJGz4aOlQb8nZEt2LIaN26K.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(24, 24, 'products/5DEDp1HorxdDXlcr6S6vLKARdXR7Cel5fY4zWo7c.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(25, 25, 'products/ukDcCY9V8KJfzJMxXFfB11wxYdiBfG6YhOjcX8l6.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(26, 26, 'products/VhlAfmgKLE802jzykItNQfj88JRITucZcji60LIo.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(27, 27, 'products/LVhfGNhD78s3fZtKQLL01N7iYGJDGVl1skinJokn.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(28, 28, 'products/eAKw7D02ROUbnTrswJQqRBytwgvJ4bfB10pddbAN.jpg', 0, '2026-02-21 00:00:22', '2026-02-21 00:00:22'),
(29, 43, 'products/euVkmfA4pVVYkCmxJoiZSSh3XXbjvtsj4KIDT3Yx.jpg', 0, '2026-02-21 02:57:11', '2026-02-21 02:57:11'),
(30, 44, 'products/hJArTQppZz9QHazlGfSjEtJ9NKw8BuEsmkAeBpuO.jpg', 0, '2026-02-21 04:12:17', '2026-02-21 04:12:17'),
(31, 45, 'products/KlZTlwTu81o8au9IPzJZPu7hRbzD49sowJgGMyeo.jpg', 0, '2026-02-21 11:24:20', '2026-02-21 11:24:20'),
(32, 57, 'products/gTgc8ot9c9Pnf1ZkStad0iq05VrJaEIUApQJq8xG.jpg', 0, '2026-02-21 11:45:23', '2026-02-21 11:45:23'),
(33, 58, 'products/vniy8wdj9F0daYI8V4xm54HpppfQ6jRUNzfEOqJX.jpg', 0, '2026-02-21 14:15:44', '2026-02-21 14:15:44'),
(34, 59, 'products/XOik5eJQbDadr638RUNfYOcQ8PxvuSI7RSqiYHsw.jpg', 0, '2026-02-21 14:37:31', '2026-02-21 14:37:31'),
(35, 60, 'products/Kkif4PzglNycwK7GsSLylaEeUgmMikEgcMpF9tuh.jpg', 0, '2026-02-21 14:43:11', '2026-02-21 14:43:11'),
(36, 61, 'products/X7jp9DwrgPJKL8ZdpthzI6Dgezgkh9VYpV0J5QT8.jpg', 0, '2026-02-21 14:43:34', '2026-02-21 14:43:34'),
(37, 62, 'products/zdeyeFxr7Lps16t1qrZApQaELD4H1WnmNfpe9Vja.jpg', 0, '2026-02-21 14:43:56', '2026-02-21 14:43:56'),
(38, 63, 'products/kv8hydQdW7h4i3ulzYaCZ3z7zgFpHI8RgEfy5hme.jpg', 0, '2026-02-21 14:44:19', '2026-02-21 14:44:19'),
(39, 69, 'products/WXwwwu8olrScQ1CaHNrRfbqdkgrrUdLxGwxzWcKg.jpg', 0, '2026-02-21 15:17:05', '2026-02-21 15:17:05'),
(47, 68, 'products/MxiKR4UCXR64oHTrrETKEm873hLOei6LR2H46qsG.jpg', 0, '2026-02-21 16:53:05', '2026-02-21 16:53:05'),
(57, 71, 'products/hCPngqAHnFeeR0HjPBOFItsrSHe8uuQ4pGdjUJfn.jpg', 0, '2026-02-21 17:23:09', '2026-02-21 17:23:09'),
(58, 71, 'products/GFRr4RS9su6yET5e1XutwH2dTCEWDuawo7FmWaXc.jpg', 2, '2026-02-21 17:23:09', '2026-02-21 17:23:09'),
(61, 70, 'products/NDoEvcMvsr7saqOaD935UwiMSicnL93VXFj6OboT.jpg', 0, '2026-02-21 17:29:56', '2026-02-21 17:29:56'),
(62, 70, 'products/rJVQMYaFUA3HEURkCWnPpaqx2ZtVjdxxudReYsjz.jpg', 2, '2026-02-21 17:29:56', '2026-02-21 17:29:56'),
(63, 70, 'products/girhxAXOyimcnrLDq74R4fH2QLmpK4LA8KgkAIvW.jpg', 4, '2026-02-21 17:29:56', '2026-02-21 17:29:56'),
(65, 71, 'products/RvUNE6L40wsEFqlEbNcy3AcRIFtCiH5s0Z6FYkyk.png', 2, '2026-02-22 15:35:12', '2026-02-22 15:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_histories`
--

CREATE TABLE `role_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `changed_by` bigint(20) UNSIGNED NOT NULL,
  `old_role` varchar(255) NOT NULL,
  `new_role` varchar(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_histories`
--

INSERT INTO `role_histories` (`id`, `user_id`, `changed_by`, `old_role`, `new_role`, `reason`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'staff', 'driver', NULL, '2026-02-21 03:20:32', '2026-02-21 03:20:32'),
(2, 4, 1, 'driver', 'staff', NULL, '2026-02-21 03:21:01', '2026-02-21 03:21:01'),
(3, 6, 1, 'staff', 'driver', 'ប្ដូរគាត់ទៅជាអ្នកដឹកជញ្ជូនវិញ ដោយសារគាត់ ពូកែ', '2026-02-21 12:25:02', '2026-02-21 12:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jnL6jL5h5K0SMgZ6yfDV28XiwDw1clq2kXc04PXd', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ3d2T1VhN1JsMTVyV0gzN3lOWXJ3RDVSWFIzc1U5OTVGREE5Qkl6SSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY3VzdG9tZXIvcHJvZmlsZSI7czo1OiJyb3V0ZSI7czoxNjoiY3VzdG9tZXIucHJvZmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEzO30=', 1771833792),
('r7IbYBn7r3UrefGmDCHspg0KjjciURj6vXqcyaDA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6Ikk5TzJmdWRBcXNES2xOZ25WVkNwV29NTldMTWlnZkx5NmNQREJOSEEiO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcHJvZmlsZSI7czo1OiJyb3V0ZSI7czoxMzoiYWRtaW4ucHJvZmlsZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJ1c2VyX3JvbGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjEwOiJsb2dpbl90aW1lIjtPOjI1OiJJbGx1bWluYXRlXFN1cHBvcnRcQ2FyYm9uIjozOntzOjQ6ImRhdGUiO3M6MjY6IjIwMjYtMDItMjMgMTY6MjE6MjMuNjA2MzIzIjtzOjEzOiJ0aW1lem9uZV90eXBlIjtpOjM7czo4OiJ0aW1lem9uZSI7czoxNToiQXNpYS9QaG5vbV9QZW5oIjt9czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX25hbWUiO3M6MTE6IlN1cGVyIEFkbWluIjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjE3OiJhZG1pbkBncm9jZXJ5LmNvbSI7fQ==', 1771838530);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pob` varchar(255) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'staff',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `gender`, `dob`, `pob`, `current_address`, `bio`, `profile_photo_path`, `role`, `status`, `permissions`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@grocery.com', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/SkWDyOznC2Dk57XQvitrnb6y08PgMyyJvThlyWeV.png', 'admin', 'active', NULL, 'profile-photos/SkWDyOznC2Dk57XQvitrnb6y08PgMyyJvThlyWeV.png', NULL, '$2y$12$W/1ClW/ZYkTf8lYX2A03suhU1nEeNrwte3Me8.MTc6vDDySWIP/w2', NULL, '2026-02-20 00:57:34', '2026-02-23 09:22:06'),
(2, 'Delivery Driver', 'driver@grocery.com', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/NdARXECREhZUN7CXdSZ9DtVzU0UuR8hXkM2fh9xs.jpg', 'driver', 'active', NULL, NULL, NULL, '$2y$12$U7xswNNsxm5KFIX5uIgiseVHjNJshYlF7IB5oevImcDrre57Y.vVa', NULL, '2026-02-20 00:57:34', '2026-02-21 17:55:31'),
(3, 'Store Staff', 'staff@grocery.com', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/pSdU1ozHEjT6zXQwddOEGtAAvQd3FpS7vy8GVAj8.png', 'staff', 'active', '[\"manage_inventory\",\"manage_staff\"]', NULL, NULL, '$2y$12$jE3fRDtuZT2Q/rz6zg.SYOMPn4hzAdnBZTuccMbZY4iFpiNGYCbCC', NULL, '2026-02-20 22:22:45', '2026-02-21 03:32:26'),
(4, 'Supervisor', 'spv@123.com', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/ARsA8kxdBIFd6r2FaMXV4OrjIl8EbUImbIAyZLno.jpg', 'staff', 'active', '[\"manage_inventory\",\"manage_categories\",\"manage_staff\"]', NULL, NULL, '$2y$12$eEU/BtsjaeIzwYVl5xA28OOOo05GzPTpBhrcKSOifVrWmfgk.9dte', NULL, '2026-02-21 02:55:10', '2026-02-21 03:21:01'),
(6, 'Berry', 'bb@123.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'driver', 'active', '[\"manage_categories\"]', NULL, NULL, '$2y$12$NWpOS/ALaYah0vg52o5KheTkyJvMzRy7MoYioGG2jpHBCfW8ZSmB.', NULL, '2026-02-21 12:11:33', '2026-02-21 12:25:02'),
(7, 'Meng Love', 'mm@123.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'staff', 'active', '[\"manage_inventory\",\"manage_categories\"]', NULL, NULL, '$2y$12$ZPLA.E1fOwFi14LBT8klDOGW6c8heTzXTmi/vaD/zuMM4MdmPANQ6', NULL, '2026-02-21 12:19:26', '2026-02-21 12:19:26'),
(8, 'Mineral Water', 'Min@123.com', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/K20wtjZLWMw6P62BbLjkYWV16oXVMNHR5jy12yVr.jpg', 'staff', 'active', '[\"manage_inventory\",\"manage_categories\"]', 'profile-photos/K20wtjZLWMw6P62BbLjkYWV16oXVMNHR5jy12yVr.jpg', NULL, '$2y$12$rXl.yU7lcnpWa1iT99uTUuiUJbqYxwUlf8S0Kk2SichBk7YS6rDeu', NULL, '2026-02-21 12:19:54', '2026-02-23 08:15:16'),
(10, 'Berry1', 'bb1@123.com', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/Suu342gw2VpcJNbcVAwG7CqnGeOzcu4BfrRLRO9p.jpg', 'staff', 'disabled', '[\"manage_orders\"]', NULL, NULL, '$2y$12$qCMyI0BcK777zYOh4WPRl.iFtxsXdM5DzVMj0yhAc8Ux.sS/exCcS', NULL, '2026-02-21 12:46:41', '2026-02-22 14:39:37'),
(11, 'Sovannarout', 'nou.sovannarout63827@gmail.com', '015868608', NULL, NULL, NULL, 'Cambodia', NULL, NULL, 'customer', 'active', NULL, 'profile-photos/J63wVXClSezEZapGEvxXgeBwldZbWMEInT8yaVRr.jpg', NULL, '$2y$12$YklTfJ66fu2xVRiv/KLLx.L3oQi6xVmTU7jQopNijbt.HoRweBCLW', NULL, '2026-02-22 03:21:04', '2026-02-22 06:49:41'),
(12, 'Sovannarout1', 'nou.sovannarout@gmail.com', '015868608', NULL, NULL, NULL, NULL, NULL, NULL, 'customer', 'active', NULL, 'profile-photos/UbT0CmPPRLoTjw9L8RgHD7SX7hi0lanbKrhsYloS.jpg', NULL, '$2y$12$5pJDVN2YaXx8Vve/ew.94eMV2Vz/FUmIpIGGxfamjxkAMhZvISK.u', 'kdSRWbWYSD5UGvPAWyeiy3Ju0FMSYKsEl5HGUMWf1wIV2cExBkdqHT9nmFPA', '2026-02-22 03:22:59', '2026-02-22 06:31:18'),
(13, 'Makara', 'makara@gmail.com', '123456667', NULL, NULL, NULL, NULL, NULL, NULL, 'customer', 'active', NULL, 'profile-photos/BnTMQNGY9sC7Hbfw40m6UAAnTUbWIvfV7p3m3mar.jpg', NULL, '$2y$12$il4vgWsJHnWFfXMv.eUHLemdNl0ioJpQj10g/JvNgmZsr4ICv8sl6', NULL, '2026-02-22 05:20:18', '2026-02-23 08:03:11'),
(14, 'Super Admin1', 'admin1@grocery.com', '01234545465', 'Male', '2019-06-04', 'Cambodia', 'Phnom Penh', 'Admin', 'profile-photos/Z0c4Kyahbx7cuAYn05o4icQLsV8s22BTZPCrkpBW.jpg', 'admin', 'active', '[]', 'profile-photos/Z0c4Kyahbx7cuAYn05o4icQLsV8s22BTZPCrkpBW.jpg', NULL, '$2y$12$DfFIKZhHBe1Y/.tV/GYJQOTxgIGq6aELUzQIMoFNCCfBjSZoDaZZi', NULL, '2026-02-23 08:38:32', '2026-02-23 08:38:32');

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
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 13, 69, '2026-02-22 09:51:06', '2026-02-22 09:51:06'),
(2, 13, 43, '2026-02-22 09:51:37', '2026-02-22 09:51:37'),
(3, 13, 70, '2026-02-22 10:12:18', '2026-02-22 10:12:18'),
(4, 13, 46, '2026-02-22 15:15:02', '2026-02-22 15:15:02'),
(5, 13, 58, '2026-02-22 15:15:08', '2026-02-22 15:15:08'),
(6, 13, 48, '2026-02-22 15:16:23', '2026-02-22 15:16:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_index` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

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
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_index` (`product_id`);

--
-- Indexes for table `role_histories`
--
ALTER TABLE `role_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_histories_changed_by_foreign` (`changed_by`),
  ADD KEY `role_histories_user_id_index` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `role_histories`
--
ALTER TABLE `role_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_histories`
--
ALTER TABLE `role_histories`
  ADD CONSTRAINT `role_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `role_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
