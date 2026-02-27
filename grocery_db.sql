-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2026 at 01:06 PM
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
(115, 1, 'profile_updated', 'Profile', 'Updated profile information', '2026-02-23 09:22:09', '2026-02-23 09:22:09'),
(116, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 06:17:01', '2026-02-24 06:17:01'),
(117, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-24 06:18:12', '2026-02-24 06:18:12'),
(118, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 08:38:52', '2026-02-24 08:38:52'),
(119, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-24 08:42:10', '2026-02-24 08:42:10'),
(120, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 08:44:06', '2026-02-24 08:44:06'),
(121, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-24 08:49:57', '2026-02-24 08:49:57'),
(122, 14, 'Logged Out', 'Auth', 'Super Admin1 logged out', '2026-02-24 08:50:49', '2026-02-24 08:50:49'),
(123, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 09:09:49', '2026-02-24 09:09:49'),
(124, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 09:27:20', '2026-02-24 09:27:20'),
(125, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-24 09:28:42', '2026-02-24 09:28:42'),
(126, 1, 'password_reset', 'Staff', 'SuperAdmin performed an emergency password reset for: Berry', '2026-02-24 09:30:24', '2026-02-24 09:30:24'),
(127, 1, 'Updated', 'Staff', 'Updated profile information for: Berry', '2026-02-24 09:30:24', '2026-02-24 09:30:24'),
(128, 1, 'password_reset', 'Staff', 'SuperAdmin performed an emergency password reset for: Delivery Driver', '2026-02-24 09:31:43', '2026-02-24 09:31:43'),
(129, 1, 'Updated', 'Staff', 'Updated profile information for: Delivery Driver', '2026-02-24 09:31:43', '2026-02-24 09:31:43'),
(130, 6, 'Logged Out', 'Auth', 'Berry logged out', '2026-02-24 09:34:22', '2026-02-24 09:34:22'),
(131, 6, 'Accepted Order', 'Delivery', 'Driver Berry accepted Order #13 for delivery', '2026-02-24 09:37:24', '2026-02-24 09:37:24'),
(132, 6, 'Arrived at Customer', 'Delivery', 'Driver Berry arrived at customer location for Order #13', '2026-02-24 09:39:36', '2026-02-24 09:39:36'),
(133, 6, 'Delivered Order', 'Delivery', 'Driver Berry completed delivery of Order #13 - $11.00 (Pre-paid)', '2026-02-24 09:45:55', '2026-02-24 09:45:55'),
(134, 6, 'Requested Directions', 'Delivery', 'Driver Berry requested directions for Order #13', '2026-02-24 10:03:41', '2026-02-24 10:03:41'),
(135, 6, 'Requested Directions', 'Delivery', 'Driver Berry requested directions for Order #13', '2026-02-24 10:03:54', '2026-02-24 10:03:54'),
(136, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 10:06:59', '2026-02-24 10:06:59'),
(137, 1, 'Updated', 'Staff', 'Updated profile information for: Berry', '2026-02-24 10:12:50', '2026-02-24 10:12:50'),
(138, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 10:13:01', '2026-02-24 10:13:01'),
(139, 1, 'Updated', 'Staff', 'Updated profile information for: Berry', '2026-02-24 10:41:45', '2026-02-24 10:41:45'),
(140, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-24 12:44:01', '2026-02-24 12:44:01'),
(141, 13, 'order_placed', 'Orders', 'Customer placed order #14', '2026-02-24 12:50:34', '2026-02-24 12:50:34'),
(142, 1, 'password_reset', 'Staff', 'SuperAdmin performed an emergency password reset for: Delivery Driver', '2026-02-24 12:57:44', '2026-02-24 12:57:44'),
(143, 1, 'Updated', 'Staff', 'Updated profile information for: Delivery Driver', '2026-02-24 12:57:44', '2026-02-24 12:57:44'),
(144, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #14 for delivery', '2026-02-24 12:58:47', '2026-02-24 12:58:47'),
(145, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #14', '2026-02-24 12:59:06', '2026-02-24 12:59:06'),
(146, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #14', '2026-02-24 12:59:40', '2026-02-24 12:59:40'),
(147, 2, 'Delivered Order', 'Delivery', 'Driver Delivery Driver completed delivery of Order #14 - $25.00 (Pre-paid)', '2026-02-24 13:01:52', '2026-02-24 13:01:52'),
(148, 13, 'order_placed', 'Orders', 'Customer placed order #15', '2026-02-24 13:27:25', '2026-02-24 13:27:25'),
(149, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #15 for delivery', '2026-02-24 13:29:05', '2026-02-24 13:29:05'),
(150, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #15', '2026-02-24 13:29:52', '2026-02-24 13:29:52'),
(151, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 03:47:04', '2026-02-25 03:47:04'),
(152, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 04:03:10', '2026-02-25 04:03:10'),
(153, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 04:14:20', '2026-02-25 04:14:20'),
(154, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-25 04:17:26', '2026-02-25 04:17:26'),
(155, 1, 'Updated', 'Staff', 'Updated profile information for: Delivery Driver', '2026-02-25 05:09:02', '2026-02-25 05:09:02'),
(156, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 05:09:50', '2026-02-25 05:09:50'),
(157, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-25 05:09:59', '2026-02-25 05:09:59'),
(158, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 05:11:58', '2026-02-25 05:11:58'),
(159, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-25 05:21:05', '2026-02-25 05:21:05'),
(160, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-25 05:38:42', '2026-02-25 05:38:42'),
(161, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 08:35:56', '2026-02-25 08:35:56'),
(162, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 10:05:16', '2026-02-25 10:05:16'),
(163, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 10:06:42', '2026-02-25 10:06:42'),
(164, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 10:09:26', '2026-02-25 10:09:26'),
(165, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 10:15:53', '2026-02-25 10:15:53'),
(166, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 10:19:56', '2026-02-25 10:19:56'),
(167, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 10:27:43', '2026-02-25 10:27:43'),
(168, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 10:30:40', '2026-02-25 10:30:40'),
(169, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 10:31:56', '2026-02-25 10:31:56'),
(170, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 10:34:44', '2026-02-25 10:34:44'),
(171, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 10:35:46', '2026-02-25 10:35:46'),
(172, 1, 'Review Moderation', 'Reviews', 'Flagged review #1 for moderation', '2026-02-25 11:04:38', '2026-02-25 11:04:38'),
(173, 1, 'Review Moderation', 'Reviews', 'Flagged review #1 for moderation', '2026-02-25 11:04:47', '2026-02-25 11:04:47'),
(174, 1, 'Review Moderation', 'Reviews', 'Flagged review #1 for moderation', '2026-02-25 11:04:53', '2026-02-25 11:04:53'),
(175, 1, 'Review Moderation', 'Reviews', 'Flagged review #1 for moderation', '2026-02-25 11:05:03', '2026-02-25 11:05:03'),
(176, 1, 'Review Moderation', 'Reviews', 'Flagged review #1 for moderation', '2026-02-25 11:05:09', '2026-02-25 11:05:09'),
(177, 1, 'Review Moderation', 'Reviews', 'Flagged review #1 for moderation', '2026-02-25 11:05:57', '2026-02-25 11:05:57'),
(178, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 11:06:05', '2026-02-25 11:06:05'),
(179, 1, 'Review Moderation', 'Reviews', 'Banned review #1 by Makara. Reason: Policy', '2026-02-25 11:09:15', '2026-02-25 11:09:15'),
(180, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 11:09:21', '2026-02-25 11:09:21'),
(181, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 11:17:50', '2026-02-25 11:17:50'),
(182, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 12:26:40', '2026-02-25 12:26:40'),
(183, 1, 'Review Moderation', 'Reviews', 'Unbanned review #1', '2026-02-25 13:00:22', '2026-02-25 13:00:22'),
(184, 1, 'Review Moderation', 'Reviews', 'Approved review #1 by Makara', '2026-02-25 13:00:31', '2026-02-25 13:00:31'),
(185, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 13:00:54', '2026-02-25 13:00:54'),
(186, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 13:59:49', '2026-02-25 13:59:49'),
(187, 1, 'Created', 'Inventory', 'Added a new product: Testing1 (ID: 72)', '2026-02-25 14:13:07', '2026-02-25 14:13:07'),
(188, 1, 'Updated', 'Inventory', 'Updated product: Testing1 (ID: 72)', '2026-02-25 14:13:25', '2026-02-25 14:13:25'),
(189, 1, 'Created', 'Inventory', 'Added a new product: Testing2 (ID: 73)', '2026-02-25 14:13:54', '2026-02-25 14:13:54'),
(190, 1, 'Created', 'Inventory', 'Added a new product: Testing3 (ID: 74)', '2026-02-25 14:14:13', '2026-02-25 14:14:13'),
(191, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 14:14:17', '2026-02-25 14:14:17'),
(192, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-25 14:54:36', '2026-02-25 14:54:36'),
(193, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 14:55:18', '2026-02-25 14:55:18'),
(194, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 15:04:44', '2026-02-25 15:04:44'),
(195, 1, 'Updated', 'Inventory', 'Updated product: 1234 (ID: 71)', '2026-02-25 15:08:46', '2026-02-25 15:08:46'),
(196, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 15:09:33', '2026-02-25 15:09:33'),
(197, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 15:17:34', '2026-02-25 15:17:34'),
(198, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 15:18:39', '2026-02-25 15:18:39'),
(199, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 15:53:21', '2026-02-25 15:53:21'),
(200, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 17:06:41', '2026-02-25 17:06:41'),
(201, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 17:10:31', '2026-02-25 17:10:31'),
(202, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 17:23:00', '2026-02-25 17:23:00'),
(203, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-25 17:32:08', '2026-02-25 17:32:08'),
(204, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-25 17:43:45', '2026-02-25 17:43:45'),
(205, 11, 'order_placed', 'Orders', 'Customer placed order #16', '2026-02-25 18:07:13', '2026-02-25 18:07:13'),
(206, 11, 'Logged Out', 'Auth', 'Sovannarout logged out', '2026-02-25 18:11:24', '2026-02-25 18:11:24'),
(207, 11, 'order_placed', 'Orders', 'Customer placed order #17', '2026-02-25 18:20:09', '2026-02-25 18:20:09'),
(208, 11, 'order_placed', 'Orders', 'Customer placed order #18', '2026-02-25 18:21:38', '2026-02-25 18:21:38'),
(209, 1, 'Review Moderation', 'Reviews', 'Deleted reply #1 on review #2', '2026-02-25 18:54:31', '2026-02-25 18:54:31'),
(210, 1, 'Review Moderation', 'Reviews', 'Hidden reply #4 on review #2', '2026-02-26 04:34:51', '2026-02-26 04:34:51'),
(211, 1, 'Review Moderation', 'Reviews', 'Unhidden reply #4 on review #2', '2026-02-26 04:34:59', '2026-02-26 04:34:59'),
(212, 1, 'Updated', 'Inventory', 'Updated category: Spices & Condiments', '2026-02-26 07:00:50', '2026-02-26 07:00:50'),
(213, 1, 'DELETED', 'Inventory', 'Bulk force deleted 10 products', '2026-02-26 07:07:06', '2026-02-26 07:07:06'),
(214, 1, 'DELETED', 'Inventory', 'Bulk force deleted 10 products', '2026-02-26 07:07:16', '2026-02-26 07:07:16'),
(215, 1, 'DELETED', 'Inventory', 'Bulk force deleted 10 products', '2026-02-26 07:07:28', '2026-02-26 07:07:28'),
(216, 1, 'DELETED', 'Inventory', 'Bulk force deleted 10 products', '2026-02-26 07:07:34', '2026-02-26 07:07:34'),
(217, 1, 'DELETED', 'Inventory', 'Bulk force deleted 10 products', '2026-02-26 07:07:40', '2026-02-26 07:07:40'),
(218, 1, 'DELETED', 'Inventory', 'Bulk force deleted 10 products', '2026-02-26 07:07:45', '2026-02-26 07:07:45'),
(219, 1, 'DELETED', 'Inventory', 'Bulk force deleted 3 products', '2026-02-26 07:07:52', '2026-02-26 07:07:52'),
(220, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-26 07:08:30', '2026-02-26 07:08:30'),
(221, 13, 'order_placed', 'Orders', 'Customer placed order #19', '2026-02-26 08:49:49', '2026-02-26 08:49:49'),
(222, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-26 09:07:11', '2026-02-26 09:07:11'),
(223, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-26 09:08:19', '2026-02-26 09:08:19'),
(224, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-26 09:09:18', '2026-02-26 09:09:18'),
(225, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-26 09:09:41', '2026-02-26 09:09:41'),
(226, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #19 for delivery', '2026-02-26 09:09:54', '2026-02-26 09:09:54'),
(227, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #19', '2026-02-26 09:10:11', '2026-02-26 09:10:11'),
(228, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #19', '2026-02-26 09:11:32', '2026-02-26 09:11:32'),
(229, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #19', '2026-02-26 09:12:37', '2026-02-26 09:12:37'),
(230, 2, 'Contacted Customer', 'Delivery', 'Driver Delivery Driver contacted customer for Order #19', '2026-02-26 09:14:28', '2026-02-26 09:14:28'),
(231, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #19', '2026-02-26 09:14:48', '2026-02-26 09:14:48'),
(232, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #19', '2026-02-26 09:15:08', '2026-02-26 09:15:08'),
(233, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #19', '2026-02-26 09:17:55', '2026-02-26 09:17:55'),
(234, 2, 'Delivered Order', 'Delivery', 'Driver Delivery Driver completed delivery of Order #19 - $21.00 (Pre-paid)', '2026-02-26 09:18:10', '2026-02-26 09:18:10'),
(235, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-26 09:18:24', '2026-02-26 09:18:24'),
(236, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-26 09:18:43', '2026-02-26 09:18:43'),
(237, 13, 'order_placed', 'Orders', 'Customer placed order #20', '2026-02-26 09:41:58', '2026-02-26 09:41:58'),
(238, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-26 09:42:09', '2026-02-26 09:42:09'),
(239, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 03:18:08', '2026-02-27 03:18:08'),
(240, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 04:48:22', '2026-02-27 04:48:22'),
(241, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 05:16:36', '2026-02-27 05:16:36'),
(242, 2, 'Contacted Customer', 'Delivery', 'Driver Delivery Driver contacted customer for Order #20', '2026-02-27 05:16:59', '2026-02-27 05:16:59'),
(243, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #20 for delivery', '2026-02-27 05:37:05', '2026-02-27 05:37:05'),
(244, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #20', '2026-02-27 05:37:11', '2026-02-27 05:37:11'),
(245, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 05:37:40', '2026-02-27 05:37:40'),
(246, 13, 'order_placed', 'Orders', 'Customer placed order #25', '2026-02-27 05:54:03', '2026-02-27 05:54:03'),
(247, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-27 06:36:36', '2026-02-27 06:36:36'),
(248, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 06:37:36', '2026-02-27 06:37:36'),
(249, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-27 07:51:55', '2026-02-27 07:51:55'),
(250, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 08:05:56', '2026-02-27 08:05:56'),
(251, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #20', '2026-02-27 08:06:07', '2026-02-27 08:06:07'),
(252, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #20', '2026-02-27 08:06:13', '2026-02-27 08:06:13'),
(253, 2, 'Delivered Order', 'Delivery', 'Driver Delivery Driver completed delivery of Order #20 - $7.00 (Pre-paid)', '2026-02-27 08:06:15', '2026-02-27 08:06:15'),
(254, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 08:06:24', '2026-02-27 08:06:24'),
(255, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 08:07:09', '2026-02-27 08:07:09'),
(256, 2, 'Contacted Customer', 'Delivery', 'Driver Delivery Driver contacted customer for Order #25', '2026-02-27 08:07:23', '2026-02-27 08:07:23'),
(257, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 08:42:20', '2026-02-27 08:42:20'),
(258, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 08:43:25', '2026-02-27 08:43:25'),
(259, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #25 for delivery', '2026-02-27 08:50:58', '2026-02-27 08:50:58'),
(260, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #25', '2026-02-27 08:54:11', '2026-02-27 08:54:11'),
(261, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 09:51:02', '2026-02-27 09:51:02'),
(262, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #25', '2026-02-27 09:56:55', '2026-02-27 09:56:55'),
(263, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 10:09:16', '2026-02-27 10:09:16'),
(264, 13, 'Logged Out', 'Auth', 'Makara logged out', '2026-02-27 10:09:55', '2026-02-27 10:09:55'),
(265, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #25', '2026-02-27 10:20:28', '2026-02-27 10:20:28'),
(266, 2, 'Status Updated', 'Delivery', 'Driver Delivery Driver marked Order #25 as Delivered', '2026-02-27 10:21:43', '2026-02-27 10:21:43'),
(267, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 10:27:16', '2026-02-27 10:27:16'),
(268, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 10:32:21', '2026-02-27 10:32:21'),
(269, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #25', '2026-02-27 10:33:04', '2026-02-27 10:33:04'),
(270, 2, 'Delivered Order', 'Delivery', 'Driver Delivery Driver completed delivery of Order #25 - $7.00 (Pre-paid)', '2026-02-27 10:34:01', '2026-02-27 10:34:01'),
(271, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 10:34:39', '2026-02-27 10:34:39'),
(272, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-27 10:37:58', '2026-02-27 10:37:58'),
(273, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #25', '2026-02-27 10:38:10', '2026-02-27 10:38:10'),
(274, 2, 'Delivered Order', 'Delivery', 'Driver Delivery Driver completed delivery of Order #25 - $7.00 (Pre-paid)', '2026-02-27 10:38:15', '2026-02-27 10:38:15'),
(275, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #25', '2026-02-27 11:24:20', '2026-02-27 11:24:20'),
(276, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #25', '2026-02-27 11:38:49', '2026-02-27 11:38:49'),
(277, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #25', '2026-02-27 11:55:14', '2026-02-27 11:55:14'),
(278, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 11:56:37', '2026-02-27 11:56:37');

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
(10, 'Spices & Condiments', 'spices-condiments', 'Includes dry spices and liquid seasonings used to enhance food flavor.', NULL, 1, 'category-icons/DoGT6a3uib7kzQPVHN4OV7iqi6IxtKZDKERx2phj.png', NULL, '2026-02-21 16:35:18', '2026-02-26 07:00:50');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"fb258c98-943b-4864-ba7c-48d6a336ec7a\",\"displayName\":\"App\\\\Notifications\\\\ReviewReplyNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:41:\\\"App\\\\Notifications\\\\ReviewReplyNotification\\\":3:{s:8:\\\"\\u0000*\\u0000reply\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\ReviewReply\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"review\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000review\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Review\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"dc50e45a-fd6f-412c-919a-9210c9487976\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1772045743,\"delay\":null}', 0, NULL, 1772045743, 1772045743),
(2, 'default', '{\"uuid\":\"817adba0-93d5-40fa-9161-627756335cd3\",\"displayName\":\"App\\\\Notifications\\\\ReviewReplyNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:41:\\\"App\\\\Notifications\\\\ReviewReplyNotification\\\":3:{s:8:\\\"\\u0000*\\u0000reply\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\ReviewReply\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"review\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000review\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Review\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"dc50e45a-fd6f-412c-919a-9210c9487976\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1772045743,\"delay\":null}', 0, NULL, 1772045743, 1772045743),
(3, 'default', '{\"uuid\":\"6b121495-6d08-4a7f-b39c-c5027e5476b8\",\"displayName\":\"App\\\\Notifications\\\\ReviewReplyNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:11;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:41:\\\"App\\\\Notifications\\\\ReviewReplyNotification\\\":3:{s:8:\\\"\\u0000*\\u0000reply\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\ReviewReply\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"review\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000review\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Review\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"9ff7047a-0290-4d88-ab79-eaef607adc6f\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1772045756,\"delay\":null}', 0, NULL, 1772045756, 1772045756),
(4, 'default', '{\"uuid\":\"a68cc3b5-ffc2-4945-9ff6-0627297b02d2\",\"displayName\":\"App\\\\Notifications\\\\ReviewReplyNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:11;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:41:\\\"App\\\\Notifications\\\\ReviewReplyNotification\\\":3:{s:8:\\\"\\u0000*\\u0000reply\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\ReviewReply\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"review\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000review\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Review\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"9ff7047a-0290-4d88-ab79-eaef607adc6f\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1772045756,\"delay\":null}', 0, NULL, 1772045756, 1772045756),
(5, 'default', '{\"uuid\":\"54b11673-4c76-4eca-8c3d-ce2cd1c6aece\",\"displayName\":\"App\\\\Notifications\\\\ReviewReplyNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:41:\\\"App\\\\Notifications\\\\ReviewReplyNotification\\\":3:{s:8:\\\"\\u0000*\\u0000reply\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\ReviewReply\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"review\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000review\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Review\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"50b330cc-c74e-4d27-a604-3d3cd7e901af\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\",\"batchId\":null},\"createdAt\":1772046180,\"delay\":null}', 0, NULL, 1772046180, 1772046180),
(6, 'default', '{\"uuid\":\"6ad861ac-67b1-439e-8f11-f85f6f2ac65e\",\"displayName\":\"App\\\\Notifications\\\\ReviewReplyNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:41:\\\"App\\\\Notifications\\\\ReviewReplyNotification\\\":3:{s:8:\\\"\\u0000*\\u0000reply\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\ReviewReply\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"review\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000review\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Review\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"50b330cc-c74e-4d27-a604-3d3cd7e901af\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1772046180,\"delay\":null}', 0, NULL, 1772046180, 1772046180);

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
(32, '2026_02_22_231704_update_order_statuses_enum', 22),
(33, '2026_02_25_161321_create_reviews_table', 23),
(34, '2026_02_25_161428_create_review_helpful_table', 23),
(35, '2026_02_25_171612_add_moderation_columns_to_reviews_table', 24),
(36, '2026_02_26_000002_add_shipping_method_to_orders_table', 25),
(37, '2026_02_26_000003_create_review_replies_table', 26),
(38, '2026_02_26_000004_create_notifications_table', 27),
(39, '2026_02_26_000005_add_is_hidden_to_review_replies_table', 28),
(43, '2026_02_26_154034_add_location_to_orders_table', 29),
(44, '2026_02_27_000001_add_performance_indexes', 29),
(45, '2026_02_27_112714_add_multilingual_support_to_products_table', 30),
(46, '2026_02_27_151224_add_location_fields_to_users_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ready_for_pickup',
  `cancellation_reason` text DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `shipping_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `delivery_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `driver_id`, `total_amount`, `phone`, `delivery_address`, `latitude`, `longitude`, `address`, `status`, `cancellation_reason`, `payment_method`, `shipping_method`, `payment_status`, `delivery_notes`, `created_at`, `updated_at`) VALUES
(5, 13, NULL, 1.00, '123456667', NULL, NULL, NULL, 'Cambodia, Phnom Penh 123235463', 'delivered', NULL, 'cash', NULL, 'unpaid', NULL, '2026-02-22 06:51:48', '2026-02-22 06:54:08'),
(7, 13, NULL, 10.00, 'asdasd', 'Cambodia, Phnom Penh asdasd', NULL, NULL, 'Cambodia, Phnom Penh asdasd', 'delivered', NULL, 'cash', NULL, 'paid', NULL, '2026-02-22 10:15:28', '2026-02-22 11:18:57'),
(8, 13, NULL, 40.00, '124637454756', 'Cambodia, Phnom Penh 1231445', NULL, NULL, 'Cambodia, Phnom Penh 1231445', 'delivered', NULL, 'card', NULL, 'paid', NULL, '2026-02-22 11:07:36', '2026-02-22 11:18:36'),
(9, 13, 2, 40.00, '124637454756', 'Cambodia, Phnom Penh 1231445', NULL, NULL, 'Cambodia, Phnom Penh 1231445', 'delivered', NULL, 'cash', NULL, 'unpaid', NULL, '2026-02-22 12:05:57', '2026-02-22 16:34:06'),
(10, 13, 2, 7.00, 'asdasd', 'Cambodia, Phnom Penh asdasd', NULL, NULL, 'Cambodia, Phnom Penh asdasd', 'delivered', NULL, 'cash', NULL, 'paid', NULL, '2026-02-22 13:06:09', '2026-02-22 17:24:13'),
(11, 13, 2, 7.00, 'asdasd', 'Cambodia, Phnom Penh asdasd', NULL, NULL, 'Cambodia, Phnom Penh asdasd', 'delivered', NULL, 'cash', NULL, 'unpaid', NULL, '2026-02-22 16:57:20', '2026-02-22 17:27:22'),
(12, 13, NULL, 7.00, '015868608', 'Cambodia, Phnom Penh asdasd', NULL, NULL, 'Cambodia, Phnom Penh asdasd', 'cancelled', 'OutofStock', 'cash', NULL, 'unpaid', NULL, '2026-02-23 06:45:55', '2026-02-23 06:48:35'),
(13, 13, 6, 11.00, '0158686089', 'asdas, asd qwseqw', NULL, NULL, 'asdas, asd qwseqw', 'delivered', NULL, 'cash', NULL, 'unpaid', NULL, '2026-02-23 07:06:50', '2026-02-24 09:45:55'),
(14, 13, 2, 25.00, '1234567890', 'esdrfghj, cgvhb 2345', NULL, NULL, 'esdrfghj, cgvhb 2345', 'delivered', NULL, 'cash', NULL, 'unpaid', NULL, '2026-02-24 12:50:34', '2026-02-24 13:01:51'),
(16, 11, NULL, 26.20, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', NULL, NULL, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'pending', NULL, 'cash', NULL, 'unpaid', NULL, '2026-02-25 18:07:13', '2026-02-25 18:07:13'),
(18, 11, NULL, 23.00, '015868608', 'Cambodia, Phnom Penh 123235463', NULL, NULL, 'Cambodia, Phnom Penh 123235463', 'pending', NULL, 'cash', 'Fast Delivery (2 hours)', 'unpaid', NULL, '2026-02-25 18:21:38', '2026-02-25 18:21:38'),
(20, 13, 2, 7.00, '015868608', 'Cambodia, Phnom Penh 123235463', NULL, NULL, 'Cambodia, Phnom Penh 123235463', 'delivered', NULL, 'cash', 'Standard Delivery', 'unpaid', 'egg', '2026-02-26 09:41:57', '2026-02-27 08:06:15'),
(21, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 1234455', 11.54913649, 104.91813541, 'Chamkar Doung, Dangkor, Phnom Penh 1234455', 'pending', NULL, 'cash', 'Standard Delivery', 'unpaid', 'សូមមកពេលល្ងា​ច ព្រោះខ្ញុំនៅផ្ទះ', '2026-02-27 05:48:21', '2026-02-27 05:48:21'),
(22, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51243805, 104.88872517, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'pending', NULL, 'cash', 'Standard Delivery', 'unpaid', 'Please Delivery at evening if possible', '2026-02-27 05:49:20', '2026-02-27 05:49:20'),
(23, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51327900, 104.88916800, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'pending', NULL, 'cash', 'Standard Delivery', 'unpaid', 'Please delivery at evening', '2026-02-27 05:50:01', '2026-02-27 05:50:01'),
(24, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51327900, 104.88916800, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'pending', NULL, 'cash', 'Standard Delivery', 'unpaid', NULL, '2026-02-27 05:50:29', '2026-02-27 05:50:29'),
(25, 13, 2, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51255370, 104.88870641, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'delivered', NULL, 'cash', 'Standard Delivery', 'paid', '3rd Floor', '2026-02-27 05:54:03', '2026-02-27 10:38:15');

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
(5, 7, 69, 3, 1.00, 3.00, '2026-02-22 10:15:28', '2026-02-22 10:15:28'),
(7, 8, 69, 50, 1.00, 50.00, '2026-02-22 11:07:36', '2026-02-22 11:07:36'),
(8, 9, 69, 50, 1.00, 50.00, '2026-02-22 12:05:57', '2026-02-22 12:05:57'),
(9, 10, 69, 1, 1.00, 1.00, '2026-02-22 13:06:09', '2026-02-22 13:06:09'),
(10, 11, 69, 1, 1.00, 1.00, '2026-02-22 16:57:20', '2026-02-22 16:57:20'),
(11, 12, 69, 1, 1.00, 1.00, '2026-02-23 06:45:55', '2026-02-23 06:45:55'),
(12, 13, 69, 5, 1.00, 5.00, '2026-02-23 07:06:50', '2026-02-23 07:06:50'),
(14, 14, 69, 1, 1.00, 1.00, '2026-02-24 12:50:34', '2026-02-24 12:50:34'),
(17, 16, 69, 1, 1.00, 1.00, '2026-02-25 18:07:13', '2026-02-25 18:07:13'),
(28, 18, 69, 1, 1.00, 1.00, '2026-02-25 18:21:38', '2026-02-25 18:21:38'),
(30, 20, 69, 1, 1.00, 1.00, '2026-02-26 09:41:58', '2026-02-26 09:41:58'),
(31, 21, 69, 1, 1.00, 1.00, '2026-02-27 05:48:22', '2026-02-27 05:48:22'),
(32, 22, 69, 1, 1.00, 1.00, '2026-02-27 05:49:20', '2026-02-27 05:49:20'),
(33, 23, 69, 1, 1.00, 1.00, '2026-02-27 05:50:01', '2026-02-27 05:50:01'),
(34, 24, 69, 1, 1.00, 1.00, '2026-02-27 05:50:29', '2026-02-27 05:50:29'),
(35, 25, 69, 1, 1.00, 1.00, '2026-02-27 05:54:03', '2026-02-27 05:54:03');

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
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
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
(69, 2, '{\"en\":\"Banana\",\"km\":\"Banana\",\"zh\":\"Banana\"}', 'banana', 'PRD-XCJWOJOV', NULL, 1.00, 993, NULL, NULL, 1, 'box', 5, '2026-02-21 15:17:04', '2026-02-27 05:54:03', NULL);

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
(39, 69, 'products/WXwwwu8olrScQ1CaHNrRfbqdkgrrUdLxGwxzWcKg.jpg', 0, '2026-02-21 15:17:05', '2026-02-21 15:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `images` varchar(1000) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `is_flagged` tinyint(1) NOT NULL DEFAULT 0,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_reason` text DEFAULT NULL,
  `moderator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  `helpful_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `order_id`, `rating`, `comment`, `images`, `is_approved`, `is_flagged`, `is_banned`, `ban_reason`, `moderator_id`, `banned_at`, `helpful_count`, `created_at`, `updated_at`) VALUES
(1, 69, 13, NULL, 5, 'ចេកនេះទំនងស៊ីណាស់ បងៗ', NULL, 1, 0, 0, NULL, NULL, NULL, 3, '2026-02-25 09:58:51', '2026-02-26 05:36:10'),
(2, 69, 11, NULL, 5, 'ចេកនេះឆ្ងាញ់ណាស់', NULL, 1, 0, 0, NULL, NULL, NULL, 1, '2026-02-25 18:08:14', '2026-02-25 18:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `review_helpful`
--

CREATE TABLE `review_helpful` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_helpful`
--

INSERT INTO `review_helpful` (`id`, `review_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 1, 11, '2026-02-25 18:08:18', '2026-02-25 18:08:18'),
(7, 2, 11, '2026-02-25 18:08:26', '2026-02-25 18:08:26'),
(8, 1, 1, '2026-02-25 19:03:39', '2026-02-25 19:03:39'),
(10, 1, 13, '2026-02-26 05:36:10', '2026-02-26 05:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `review_replies`
--

CREATE TABLE `review_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_replies`
--

INSERT INTO `review_replies` (`id`, `review_id`, `user_id`, `comment`, `is_hidden`, `created_at`, `updated_at`) VALUES
(2, 1, 11, 'មែនតើ!', 0, '2026-02-25 18:46:47', '2026-02-25 18:46:47'),
(3, 1, 1, 'អរគុណ', 0, '2026-02-25 18:55:42', '2026-02-25 18:55:42'),
(4, 2, 1, 'មែនតើ!', 0, '2026-02-25 18:55:56', '2026-02-26 04:34:59'),
(5, 1, 1, 'ទិញឲ្យច្រើនៗមកបង', 0, '2026-02-25 19:03:00', '2026-02-25 19:03:00');

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
('Go2cctcnGXvbMuw5u0yXPgJYcmkmf0rzU123lI90', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6InFTY2wzazhXbkZDczlWQ0tNSzN4UkxIZkhEUW9PeVp3QmY3MFoxOEciO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToidXNlcl9yb2xlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czoxMDoibG9naW5fdGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI2LTAyLTI3IDEwOjE2OjA4LjY3MDgwNSI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTU6IkFzaWEvUGhub21fUGVuaCI7fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl9uYW1lIjtzOjExOiJTdXBlciBBZG1pbiI7czoxMDoidXNlcl9lbWFpbCI7czoxNzoiYWRtaW5AZ3JvY2VyeS5jb20iO30=', 1772162168),
('Jw6QgK5sFOVUEoXBm7hQeXhn6caVRC9vv350L5q6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS25lN05nUjRVcld5MnBsSzF3emtQMVYyd0R1bndQUnJ0blFxVFlLOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772162153),
('O9XRt1FxtVdL0adx2viJXzaXHXxUwqLfnY54w1Uw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2MwN1ZLSHhYeWdUY09ua3VnM0JnZWVma1JhaEprc1RZbzBtTWYyVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MjQ6ImN1c3RvbWVyLmZvcmdvdC1wYXNzd29yZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772162136),
('syYTS6BG7bgHcfJbnmJQAoeUlGjUqGxlcKgix1Zb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXBad3hVOEV2SEh1R0N2eHhoWlBCY2RybGk2eWw4eEozWGxwaWM3MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MjQ6ImN1c3RvbWVyLmZvcmdvdC1wYXNzd29yZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjY5O2E6NDp7czo0OiJuYW1lIjtzOjY6IkJhbmFuYSI7czo4OiJxdWFudGl0eSI7aToxO3M6NToicHJpY2UiO3M6NDoiMS4wMCI7czo1OiJpbWFnZSI7czo1MzoicHJvZHVjdHMvV1h3d3d1OG9sclNjUTFDYUhOclJmYnFka2dyclVkTHhHd3h6V2NLZy5qcGciO319fQ==', 1772108304),
('uVp7ijNYP7Nas1P4MsZI87ppzmuXvx1P2XPOAAVU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6IndTeXVwbnJpTDhSOXRnSG9GS3V5VzVRUmxKczF2dXU5RXdGdjBNcXkiO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vY291cG9ucyI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uY291cG9ucy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJ1c2VyX3JvbGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjEwOiJsb2dpbl90aW1lIjtPOjI1OiJJbGx1bWluYXRlXFN1cHBvcnRcQ2FyYm9uIjozOntzOjQ6ImRhdGUiO3M6MjY6IjIwMjYtMDItMjcgMTA6MTg6MTMuMjI4NDAyIjtzOjEzOiJ0aW1lem9uZV90eXBlIjtpOjM7czo4OiJ0aW1lem9uZSI7czoxNToiQXNpYS9QaG5vbV9QZW5oIjt9czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX25hbWUiO3M6MTE6IlN1cGVyIEFkbWluIjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjE3OiJhZG1pbkBncm9jZXJ5LmNvbSI7fQ==', 1772162382);

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
  `latitude` decimal(10,8) DEFAULT NULL COMMENT 'Driver current latitude',
  `longitude` decimal(11,8) DEFAULT NULL COMMENT 'Driver current longitude',
  `location_updated_at` timestamp NULL DEFAULT NULL COMMENT 'Last time location was updated',
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

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `gender`, `dob`, `pob`, `current_address`, `latitude`, `longitude`, `location_updated_at`, `bio`, `profile_photo_path`, `role`, `status`, `permissions`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@grocery.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/SkWDyOznC2Dk57XQvitrnb6y08PgMyyJvThlyWeV.png', 'admin', 'active', NULL, 'profile-photos/SkWDyOznC2Dk57XQvitrnb6y08PgMyyJvThlyWeV.png', NULL, '$2y$12$W/1ClW/ZYkTf8lYX2A03suhU1nEeNrwte3Me8.MTc6vDDySWIP/w2', NULL, '2026-02-20 00:57:34', '2026-02-23 09:22:06'),
(2, 'Delivery Driver', 'driver@grocery.com', '01234545465', NULL, NULL, NULL, NULL, 11.51327900, 104.88916800, '2026-02-27 10:34:25', NULL, 'profile-photos/NdARXECREhZUN7CXdSZ9DtVzU0UuR8hXkM2fh9xs.jpg', 'driver', 'active', '[]', NULL, NULL, '$2y$12$hWtix2NM4Tu.Y0AvfHXYn.HIhQtYfw6.GRmmuG/6UI8j8f60a7i96', NULL, '2026-02-20 00:57:34', '2026-02-27 10:34:25'),
(3, 'Store Staff', 'staff@grocery.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/pSdU1ozHEjT6zXQwddOEGtAAvQd3FpS7vy8GVAj8.png', 'staff', 'active', '[\"manage_inventory\",\"manage_staff\"]', NULL, NULL, '$2y$12$jE3fRDtuZT2Q/rz6zg.SYOMPn4hzAdnBZTuccMbZY4iFpiNGYCbCC', NULL, '2026-02-20 22:22:45', '2026-02-21 03:32:26'),
(4, 'Supervisor', 'spv@123.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/ARsA8kxdBIFd6r2FaMXV4OrjIl8EbUImbIAyZLno.jpg', 'staff', 'active', '[\"manage_inventory\",\"manage_categories\",\"manage_staff\"]', NULL, NULL, '$2y$12$eEU/BtsjaeIzwYVl5xA28OOOo05GzPTpBhrcKSOifVrWmfgk.9dte', NULL, '2026-02-21 02:55:10', '2026-02-21 03:21:01'),
(6, 'Berry', 'bb@123.com', '01234545465', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/Njk8zSA4uz8bU6gfBoMQwP13PzxcSaWKfv9FxDU8.jpg', 'driver', 'active', '[]', 'profile-photos/Njk8zSA4uz8bU6gfBoMQwP13PzxcSaWKfv9FxDU8.jpg', NULL, '$2y$12$kPk5Df3yqbtQ5pc64FEAeOClkTw4K/kh8o1nJE2sHArqQLQf8y.9q', NULL, '2026-02-21 12:11:33', '2026-02-24 10:41:45'),
(7, 'Meng Love', 'mm@123.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'staff', 'active', '[\"manage_inventory\",\"manage_categories\"]', NULL, NULL, '$2y$12$ZPLA.E1fOwFi14LBT8klDOGW6c8heTzXTmi/vaD/zuMM4MdmPANQ6', NULL, '2026-02-21 12:19:26', '2026-02-21 12:19:26'),
(8, 'Mineral Water', 'Min@123.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/K20wtjZLWMw6P62BbLjkYWV16oXVMNHR5jy12yVr.jpg', 'staff', 'active', '[\"manage_inventory\",\"manage_categories\"]', 'profile-photos/K20wtjZLWMw6P62BbLjkYWV16oXVMNHR5jy12yVr.jpg', NULL, '$2y$12$rXl.yU7lcnpWa1iT99uTUuiUJbqYxwUlf8S0Kk2SichBk7YS6rDeu', NULL, '2026-02-21 12:19:54', '2026-02-23 08:15:16'),
(10, 'Berry1', 'bb1@123.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/Suu342gw2VpcJNbcVAwG7CqnGeOzcu4BfrRLRO9p.jpg', 'staff', 'disabled', '[\"manage_orders\"]', NULL, NULL, '$2y$12$qCMyI0BcK777zYOh4WPRl.iFtxsXdM5DzVMj0yhAc8Ux.sS/exCcS', NULL, '2026-02-21 12:46:41', '2026-02-22 14:39:37'),
(11, 'Sovannarout', 'nou.sovannarout63827@gmail.com', '015868608', NULL, NULL, NULL, 'Cambodia', NULL, NULL, NULL, NULL, NULL, 'customer', 'active', NULL, 'profile-photos/J63wVXClSezEZapGEvxXgeBwldZbWMEInT8yaVRr.jpg', NULL, '$2y$12$P4Hi8PXjtU5eyG.qPQqhJO57BS/8cgCEzBhdOa0Q6r5CsRio1PUUS', NULL, '2026-02-22 03:21:04', '2026-02-25 17:46:43'),
(12, 'Sovannarout1', 'nou.sovannarout@gmail.com', '015868608', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'customer', 'active', NULL, 'profile-photos/UbT0CmPPRLoTjw9L8RgHD7SX7hi0lanbKrhsYloS.jpg', NULL, '$2y$12$5pJDVN2YaXx8Vve/ew.94eMV2Vz/FUmIpIGGxfamjxkAMhZvISK.u', 'kdSRWbWYSD5UGvPAWyeiy3Ju0FMSYKsEl5HGUMWf1wIV2cExBkdqHT9nmFPA', '2026-02-22 03:22:59', '2026-02-22 06:31:18'),
(13, 'Makara', 'makara@gmail.com', '123456667', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'customer', 'active', NULL, 'profile-photos/BnTMQNGY9sC7Hbfw40m6UAAnTUbWIvfV7p3m3mar.jpg', NULL, '$2y$12$il4vgWsJHnWFfXMv.eUHLemdNl0ioJpQj10g/JvNgmZsr4ICv8sl6', NULL, '2026-02-22 05:20:18', '2026-02-23 08:03:11'),
(14, 'Super Admin1', 'admin1@grocery.com', '01234545465', 'Male', '2019-06-04', 'Cambodia', 'Phnom Penh', NULL, NULL, NULL, 'Admin', 'profile-photos/Z0c4Kyahbx7cuAYn05o4icQLsV8s22BTZPCrkpBW.jpg', 'admin', 'active', '[]', 'profile-photos/Z0c4Kyahbx7cuAYn05o4icQLsV8s22BTZPCrkpBW.jpg', NULL, '$2y$12$DfFIKZhHBe1Y/.tV/GYJQOTxgIGq6aELUzQIMoFNCCfBjSZoDaZZi', NULL, '2026-02-23 08:38:32', '2026-02-23 08:38:32');

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
(19, 11, 69, '2026-02-25 18:04:32', '2026-02-25 18:04:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_index` (`user_id`),
  ADD KEY `activity_logs_user_id_idx` (`user_id`),
  ADD KEY `activity_logs_module_idx` (`module`),
  ADD KEY `activity_logs_created_at_idx` (`created_at`);

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
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_slug_idx` (`slug`),
  ADD KEY `categories_is_active_idx` (`is_active`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`),
  ADD KEY `coupons_status_idx` (`status`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `notifications_notifiable_type_idx` (`notifiable_type`),
  ADD KEY `notifications_read_at_idx` (`read_at`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_index` (`customer_id`),
  ADD KEY `orders_driver_id_index` (`driver_id`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_created_at_index` (`created_at`),
  ADD KEY `orders_payment_status_index` (`payment_status`),
  ADD KEY `orders_status_created_at_index` (`status`,`created_at`),
  ADD KEY `orders_customer_id_status_index` (`customer_id`,`status`),
  ADD KEY `orders_customer_id_idx` (`customer_id`),
  ADD KEY `orders_driver_id_idx` (`driver_id`),
  ADD KEY `orders_status_idx` (`status`),
  ADD KEY `orders_created_at_idx` (`created_at`),
  ADD KEY `orders_payment_status_idx` (`payment_status`),
  ADD KEY `orders_status_created_idx` (`status`,`created_at`),
  ADD KEY `orders_customer_status_idx` (`customer_id`,`status`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_index` (`order_id`),
  ADD KEY `order_items_product_id_index` (`product_id`),
  ADD KEY `order_items_order_id_idx` (`order_id`),
  ADD KEY `order_items_product_id_idx` (`product_id`);

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
  ADD KEY `products_slug_index` (`slug`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_stock_index` (`stock`),
  ADD KEY `products_is_active_index` (`is_active`),
  ADD KEY `products_stock_is_active_index` (`stock`,`is_active`),
  ADD KEY `products_slug_idx` (`slug`),
  ADD KEY `products_category_id_idx` (`category_id`),
  ADD KEY `products_stock_idx` (`stock`),
  ADD KEY `products_is_active_idx` (`is_active`),
  ADD KEY `products_stock_active_idx` (`stock`,`is_active`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_index` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`),
  ADD KEY `reviews_product_id_is_approved_index` (`product_id`,`is_approved`),
  ADD KEY `reviews_user_id_product_id_index` (`user_id`,`product_id`),
  ADD KEY `reviews_moderator_id_foreign` (`moderator_id`),
  ADD KEY `reviews_is_flagged_is_banned_index` (`is_flagged`,`is_banned`),
  ADD KEY `reviews_product_id_index` (`product_id`),
  ADD KEY `reviews_user_id_index` (`user_id`),
  ADD KEY `reviews_is_approved_index` (`is_approved`),
  ADD KEY `reviews_product_id_idx` (`product_id`),
  ADD KEY `reviews_user_id_idx` (`user_id`),
  ADD KEY `reviews_is_approved_idx` (`is_approved`),
  ADD KEY `reviews_product_approved_idx` (`product_id`,`is_approved`);

--
-- Indexes for table `review_helpful`
--
ALTER TABLE `review_helpful`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `review_helpful_review_id_user_id_unique` (`review_id`,`user_id`),
  ADD KEY `review_helpful_user_id_foreign` (`user_id`);

--
-- Indexes for table `review_replies`
--
ALTER TABLE `review_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_replies_review_id_foreign` (`review_id`),
  ADD KEY `review_replies_user_id_foreign` (`user_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_email_idx` (`email`),
  ADD KEY `users_role_idx` (`role`),
  ADD KEY `users_status_idx` (`status`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD UNIQUE KEY `wishlists_user_product_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_user_id_idx` (`user_id`),
  ADD KEY `wishlists_product_id_idx` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review_helpful`
--
ALTER TABLE `review_helpful`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `review_replies`
--
ALTER TABLE `review_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_moderator_id_foreign` FOREIGN KEY (`moderator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_helpful`
--
ALTER TABLE `review_helpful`
  ADD CONSTRAINT `review_helpful_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_helpful_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_replies`
--
ALTER TABLE `review_replies`
  ADD CONSTRAINT `review_replies_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
