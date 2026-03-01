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
(278, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-27 11:56:37', '2026-02-27 11:56:37'),
(279, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 04:02:17', '2026-02-28 04:02:17'),
(280, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 04:24:57', '2026-02-28 04:24:57'),
(281, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-28 04:32:41', '2026-02-28 04:32:41'),
(282, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-28 04:45:27', '2026-02-28 04:45:27'),
(283, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-28 04:46:14', '2026-02-28 04:46:14'),
(284, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-28 04:47:16', '2026-02-28 04:47:16'),
(285, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-28 04:50:58', '2026-02-28 04:50:58'),
(286, 1, 'Updated', 'Inventory', 'Updated product: Banana (ID: 69)', '2026-02-28 04:59:57', '2026-02-28 04:59:57'),
(287, 1, 'Created', 'Inventory', 'Added a new product: Beef (ID: 75)', '2026-02-28 07:42:27', '2026-02-28 07:42:27'),
(288, 1, 'Created', 'Inventory', 'Added a new product: Beef (ID: 76)', '2026-02-28 07:42:27', '2026-02-28 07:42:27'),
(289, 1, 'Created', 'Inventory', 'Added a new product: adsas (ID: 77)', '2026-02-28 07:45:21', '2026-02-28 07:45:21'),
(290, 1, 'Deleted', 'Inventory', 'Deleted product: adsas (ID: 77)', '2026-02-28 07:45:30', '2026-02-28 07:45:30'),
(291, 1, 'RESTORED', 'Inventory', 'Restored product: adsas (ID: 77)', '2026-02-28 07:45:44', '2026-02-28 07:45:44'),
(292, 1, 'RESTORED', 'Inventory', 'Restored product: Beef (ID: 76)', '2026-02-28 07:45:48', '2026-02-28 07:45:48'),
(293, 1, 'Deleted', 'Inventory', 'Deleted product: adsas (ID: 77)', '2026-02-28 07:46:00', '2026-02-28 07:46:00'),
(294, 1, 'Deleted', 'Inventory', 'Deleted product: Beef (ID: 76)', '2026-02-28 07:46:12', '2026-02-28 07:46:12'),
(295, 1, 'RESTORED', 'Inventory', 'Restored product: adsas (ID: 77)', '2026-02-28 07:46:19', '2026-02-28 07:46:19'),
(296, 1, 'Deleted', 'Inventory', 'Deleted product: adsas (ID: 77)', '2026-02-28 07:46:27', '2026-02-28 07:46:27'),
(297, 1, 'RESTORED', 'Inventory', 'Bulk restored 2 products', '2026-02-28 07:47:48', '2026-02-28 07:47:48'),
(298, 1, 'Updated', 'Inventory', 'Updated product: Beefasda (ID: 76)', '2026-02-28 07:49:07', '2026-02-28 07:49:07'),
(299, 1, 'Deleted', 'Inventory', 'Deleted product: adsas (ID: 77)', '2026-02-28 07:49:14', '2026-02-28 07:49:14'),
(300, 1, 'Deleted', 'Inventory', 'Deleted product: Beefasda (ID: 76)', '2026-02-28 07:49:17', '2026-02-28 07:49:17'),
(301, 1, 'Created', 'Inventory', 'Added a new product: Pork (ID: 78)', '2026-02-28 07:50:38', '2026-02-28 07:50:38'),
(302, 1, 'Created', 'Inventory', 'Added a new product: Chicken (ID: 79)', '2026-02-28 07:52:32', '2026-02-28 07:52:32'),
(303, 1, 'Created', 'Inventory', 'Added a new product: Duck (ID: 80)', '2026-02-28 07:53:17', '2026-02-28 07:53:17'),
(304, 1, 'Created', 'Inventory', 'Added a new product: Minced Beef (ID: 81)', '2026-02-28 07:54:27', '2026-02-28 07:54:27'),
(305, 1, 'Updated', 'Inventory', 'Updated product: Minced Beef (ID: 81)', '2026-02-28 07:54:39', '2026-02-28 07:54:39'),
(306, 1, 'Created', 'Inventory', 'Added a new product: Minced Pork (ID: 82)', '2026-02-28 07:55:35', '2026-02-28 07:55:35'),
(307, 1, 'Created', 'Inventory', 'Added a new product: Pork Ribs (ID: 83)', '2026-02-28 07:56:25', '2026-02-28 07:56:25'),
(308, 1, 'Created', 'Inventory', 'Added a new product: Sausage (ID: 84)', '2026-02-28 07:57:37', '2026-02-28 07:57:37'),
(309, 1, 'Created', 'Inventory', 'Added a new product: Ham (ID: 85)', '2026-02-28 07:58:27', '2026-02-28 07:58:27'),
(310, 1, 'Created', 'Inventory', 'Added a new product: Bacon (ID: 86)', '2026-02-28 07:59:15', '2026-02-28 07:59:15'),
(311, 1, 'Created', 'Inventory', 'Added a new product: Fresh Fish (ID: 87)', '2026-02-28 08:00:18', '2026-02-28 08:00:18'),
(312, 1, 'Created', 'Inventory', 'Added a new product: Fish Fillet (ID: 88)', '2026-02-28 08:01:25', '2026-02-28 08:01:25'),
(313, 1, 'Created', 'Inventory', 'Added a new product: Shrimp (ID: 89)', '2026-02-28 08:02:05', '2026-02-28 08:02:05'),
(314, 1, 'Created', 'Inventory', 'Added a new product: Crab (ID: 90)', '2026-02-28 08:02:46', '2026-02-28 08:02:46'),
(315, 1, 'Created', 'Inventory', 'Added a new product: Squid (ID: 91)', '2026-02-28 08:03:34', '2026-02-28 08:03:34'),
(316, 1, 'Created', 'Inventory', 'Added a new product: Clams (ID: 92)', '2026-02-28 08:04:29', '2026-02-28 08:04:29'),
(317, 1, 'Created', 'Inventory', 'Added a new product: Mussels (ID: 93)', '2026-02-28 08:05:23', '2026-02-28 08:05:23'),
(318, 1, 'Created', 'Inventory', 'Added a new product: Salmon (ID: 94)', '2026-02-28 08:06:13', '2026-02-28 08:06:13'),
(319, 1, 'Created', 'Inventory', 'Added a new product: Coca Zero (ID: 95)', '2026-02-28 08:12:22', '2026-02-28 08:12:22'),
(320, 1, 'Created', 'Inventory', 'Added a new product: Red Sting (ID: 96)', '2026-02-28 08:14:13', '2026-02-28 08:14:13'),
(321, 1, 'Created', 'Inventory', 'Added a new product: Yellow Sting (ID: 97)', '2026-02-28 08:15:27', '2026-02-28 08:15:27'),
(322, 1, 'Created', 'Inventory', 'Added a new product: Red Bull (ID: 98)', '2026-02-28 08:16:36', '2026-02-28 08:16:36'),
(323, 1, 'Created', 'Inventory', 'Added a new product: Pepci (ID: 99)', '2026-02-28 08:17:26', '2026-02-28 08:17:26'),
(324, 1, 'Created', 'Inventory', 'Added a new product: Fresh Water (ID: 100)', '2026-02-28 08:18:20', '2026-02-28 08:18:20'),
(325, 1, 'Created', 'Inventory', 'Added a new product: 01 Baguette (ID: 101)', '2026-02-28 08:20:14', '2026-02-28 08:20:14'),
(326, 1, 'Created', 'Inventory', 'Added a new product: 02 White Bread (ID: 102)', '2026-02-28 08:21:18', '2026-02-28 08:21:18'),
(327, 1, 'Created', 'Inventory', 'Added a new product: 03 Whole Wheat Bread (ID: 103)', '2026-02-28 08:22:07', '2026-02-28 08:22:07'),
(328, 1, 'Created', 'Inventory', 'Added a new product: 04 Croissant (ID: 104)', '2026-02-28 08:22:59', '2026-02-28 08:22:59'),
(329, 1, 'Created', 'Inventory', 'Added a new product: 05 Garlic Bread (ID: 105)', '2026-02-28 08:23:46', '2026-02-28 08:23:46'),
(330, 1, 'Created', 'Inventory', 'Added a new product: 06 Burger Bun (ID: 106)', '2026-02-28 08:24:34', '2026-02-28 08:24:34'),
(331, 1, 'Created', 'Inventory', 'Added a new product: 07 Hot Dog Bun (ID: 107)', '2026-02-28 08:25:23', '2026-02-28 08:25:23'),
(332, 1, 'Created', 'Inventory', 'Added a new product: 08 Chocolate Cake (ID: 108)', '2026-02-28 08:26:19', '2026-02-28 08:26:19'),
(333, 1, 'Created', 'Inventory', 'Added a new product: 09 Vanilla Cake (ID: 109)', '2026-02-28 08:27:02', '2026-02-28 08:27:02'),
(334, 1, 'Created', 'Inventory', 'Added a new product: 10 Red Velvet Cake (ID: 110)', '2026-02-28 08:27:35', '2026-02-28 08:27:35'),
(335, 1, 'Created', 'Inventory', 'Added a new product: 11 Donut (ID: 111)', '2026-02-28 08:28:02', '2026-02-28 08:28:02'),
(336, 1, 'Created', 'Inventory', 'Added a new product: 12 Danish Pastry (ID: 112)', '2026-02-28 08:28:41', '2026-02-28 08:28:41'),
(337, 1, 'Created', 'Inventory', 'Added a new product: 13 Pie (ID: 113)', '2026-02-28 08:29:08', '2026-02-28 08:29:08'),
(338, 1, 'Created', 'Inventory', 'Added a new product: 01 Potato Chips (ID: 114)', '2026-02-28 08:30:22', '2026-02-28 08:30:22'),
(339, 1, 'Created', 'Inventory', 'Added a new product: 02 Nachos (ID: 115)', '2026-02-28 08:30:52', '2026-02-28 08:30:52'),
(340, 1, 'Created', 'Inventory', 'Added a new product: 03 Cheese Balls (ID: 116)', '2026-02-28 08:32:31', '2026-02-28 08:32:31'),
(341, 1, 'Created', 'Inventory', 'Added a new product: 04 Pretzels (ID: 117)', '2026-02-28 08:33:31', '2026-02-28 08:33:31'),
(342, 1, 'Created', 'Inventory', 'Added a new product: 05 Popcorn (ID: 118)', '2026-02-28 08:34:01', '2026-02-28 08:34:01'),
(343, 1, 'Created', 'Inventory', 'Added a new product: 06 Corn Chips (ID: 119)', '2026-02-28 08:34:27', '2026-02-28 08:34:27'),
(344, 1, 'Created', 'Inventory', 'Added a new product: 07 Shrimp Chips (ID: 120)', '2026-02-28 08:34:49', '2026-02-28 08:34:49'),
(345, 1, 'Created', 'Inventory', 'Added a new product: 08 Seaweed Snack (ID: 121)', '2026-02-28 08:35:17', '2026-02-28 08:35:17'),
(346, 1, 'Created', 'Inventory', 'Added a new product: 09 Chocolate Bar (ID: 122)', '2026-02-28 08:35:44', '2026-02-28 08:35:44'),
(347, 1, 'Created', 'Inventory', 'Added a new product: 10 Cookies (ID: 123)', '2026-02-28 08:36:12', '2026-02-28 08:36:12'),
(348, 1, 'Created', 'Inventory', 'Added a new product: 11 Wafer (ID: 124)', '2026-02-28 08:36:45', '2026-02-28 08:36:45'),
(349, 1, 'Created', 'Inventory', 'Added a new product: 12 Candy (ID: 125)', '2026-02-28 08:37:09', '2026-02-28 08:37:09'),
(350, 1, 'Created', 'Inventory', 'Added a new product: 13 Marshmallow (ID: 126)', '2026-02-28 08:37:39', '2026-02-28 08:37:39'),
(351, 1, 'Created', 'Inventory', 'Added a new product: 14 Granola Bar (ID: 127)', '2026-02-28 08:38:01', '2026-02-28 08:38:01'),
(352, 1, 'Created', 'Inventory', 'Added a new product: 15 Sweet Rice Crackers (ID: 128)', '2026-02-28 08:38:25', '2026-02-28 08:38:25'),
(353, 1, 'Created', 'Inventory', 'Added a new product: 16 Caramel Popcorn (ID: 129)', '2026-02-28 08:39:30', '2026-02-28 08:39:30'),
(354, 1, 'Created', 'Inventory', 'Added a new product: 01 Frozen Chicken (ID: 130)', '2026-02-28 08:40:40', '2026-02-28 08:40:40'),
(355, 1, 'Created', 'Inventory', 'Added a new product: 02 Frozen Beef (ID: 131)', '2026-02-28 08:41:07', '2026-02-28 08:41:07'),
(356, 1, 'Created', 'Inventory', 'Added a new product: 03 Frozen Pork (ID: 132)', '2026-02-28 08:41:33', '2026-02-28 08:41:33'),
(357, 1, 'Created', 'Inventory', 'Added a new product: 04 Frozen Shrimp (ID: 133)', '2026-02-28 08:42:02', '2026-02-28 08:42:02'),
(358, 1, 'Created', 'Inventory', 'Added a new product: 05 Frozen Fish (ID: 134)', '2026-02-28 08:42:36', '2026-02-28 08:42:36'),
(359, 1, 'Created', 'Inventory', 'Added a new product: 06 Frozen Squid (ID: 135)', '2026-02-28 08:44:31', '2026-02-28 08:44:31'),
(360, 1, 'Created', 'Inventory', 'Added a new product: 07 Frozen Crab (ID: 136)', '2026-02-28 08:45:46', '2026-02-28 08:45:46'),
(361, 1, 'Created', 'Inventory', 'Added a new product: 08 Vanilla Ice Cream (ID: 137)', '2026-02-28 08:46:27', '2026-02-28 08:46:27'),
(362, 1, 'Created', 'Inventory', 'Added a new product: 09 Chocolate Ice Cream (ID: 138)', '2026-02-28 08:46:55', '2026-02-28 08:46:55'),
(363, 1, 'Created', 'Inventory', 'Added a new product: 10 Strawberry Ice Cream (ID: 139)', '2026-02-28 08:47:30', '2026-02-28 08:47:30'),
(364, 1, 'Created', 'Inventory', 'Added a new product: 11 Matcha Ice Cream (ID: 140)', '2026-02-28 08:47:55', '2026-02-28 08:47:55'),
(365, 1, 'Created', 'Inventory', 'Added a new product: 12 Coconut Ice Cream (ID: 141)', '2026-02-28 08:48:31', '2026-02-28 08:48:31'),
(366, 1, 'Created', 'Inventory', 'Added a new product: 13 Mango Ice Cream (ID: 142)', '2026-02-28 08:48:58', '2026-02-28 08:48:58'),
(367, 1, 'Created', 'Inventory', 'Added a new product: 01 Fresh Milk (ID: 143)', '2026-02-28 08:50:43', '2026-02-28 08:50:43'),
(368, 1, 'Created', 'Inventory', 'Added a new product: 02 Condensed Milk (ID: 144)', '2026-02-28 08:51:24', '2026-02-28 08:51:24'),
(369, 1, 'Created', 'Inventory', 'Added a new product: 03 Milk Powder (ID: 145)', '2026-02-28 08:51:50', '2026-02-28 08:51:50'),
(370, 1, 'Created', 'Inventory', 'Added a new product: 04 Raw Milk (ID: 146)', '2026-02-28 08:52:19', '2026-02-28 08:52:19'),
(371, 1, 'Created', 'Inventory', 'Added a new product: 05 Yogurt (ID: 147)', '2026-02-28 08:52:44', '2026-02-28 08:52:44'),
(372, 1, 'Created', 'Inventory', 'Added a new product: 06 Cheese (ID: 148)', '2026-02-28 08:53:13', '2026-02-28 08:53:13'),
(373, 1, 'Created', 'Inventory', 'Added a new product: 07 Butter (ID: 149)', '2026-02-28 08:53:45', '2026-02-28 08:53:45'),
(374, 1, 'Created', 'Inventory', 'Added a new product: 08 Cream (ID: 150)', '2026-02-28 08:54:12', '2026-02-28 08:54:12'),
(375, 1, 'Created', 'Inventory', 'Added a new product: 09 Chicken Egg (ID: 151)', '2026-02-28 08:55:03', '2026-02-28 08:55:03'),
(376, 1, 'Created', 'Inventory', 'Added a new product: 10 Duck Egg (ID: 152)', '2026-02-28 08:55:38', '2026-02-28 08:55:38'),
(377, 1, 'Created', 'Inventory', 'Added a new product: 01 Black Pepper (ID: 153)', '2026-02-28 08:56:26', '2026-02-28 08:56:26'),
(378, 1, 'Created', 'Inventory', 'Added a new product: 02 Turmeric (ID: 154)', '2026-02-28 08:56:50', '2026-02-28 08:56:50'),
(379, 1, 'Updated', 'Inventory', 'Updated product: 02 Turmeric (ID: 154)', '2026-02-28 08:57:01', '2026-02-28 08:57:01'),
(380, 1, 'Updated', 'Inventory', 'Updated product: 01 Black Pepper (ID: 153)', '2026-02-28 08:57:07', '2026-02-28 08:57:07'),
(381, 1, 'Created', 'Inventory', 'Added a new product: 03 Salt (ID: 155)', '2026-02-28 08:57:49', '2026-02-28 08:57:49'),
(382, 1, 'Updated', 'Inventory', 'Updated product: 01 Black Pepper (ID: 153)', '2026-02-28 08:58:08', '2026-02-28 08:58:08'),
(383, 1, 'Updated', 'Inventory', 'Updated product: 02 Turmeric (ID: 154)', '2026-02-28 08:58:26', '2026-02-28 08:58:26'),
(384, 1, 'Created', 'Inventory', 'Added a new product: 04 Sugar (ID: 156)', '2026-02-28 08:59:26', '2026-02-28 08:59:26'),
(385, 1, 'Created', 'Inventory', 'Added a new product: 05 Palm Sugar (ID: 157)', '2026-02-28 08:59:53', '2026-02-28 08:59:53'),
(386, 1, 'Created', 'Inventory', 'Added a new product: 06 Paprika (ID: 158)', '2026-02-28 09:00:28', '2026-02-28 09:00:28'),
(387, 1, 'Created', 'Inventory', 'Added a new product: 07 Cinnamon (ID: 159)', '2026-02-28 09:00:55', '2026-02-28 09:00:55'),
(388, 1, 'Created', 'Inventory', 'Added a new product: 08 Cardamom (ID: 160)', '2026-02-28 09:01:17', '2026-02-28 09:01:17'),
(389, 1, 'Created', 'Inventory', 'Added a new product: 09 Star Anise (ID: 161)', '2026-02-28 09:01:39', '2026-02-28 09:01:39'),
(390, 1, 'Created', 'Inventory', 'Added a new product: 10 Garlic (ID: 162)', '2026-02-28 09:02:12', '2026-02-28 09:02:12'),
(391, 1, 'Created', 'Inventory', 'Added a new product: 11 Shallot (ID: 163)', '2026-02-28 09:02:43', '2026-02-28 09:02:43'),
(392, 1, 'Created', 'Inventory', 'Added a new product: 12 Cumin (ID: 164)', '2026-02-28 09:03:16', '2026-02-28 09:03:16'),
(393, 1, 'Created', 'Inventory', 'Added a new product: 13 Dried Lemongrass (ID: 165)', '2026-02-28 09:03:37', '2026-02-28 09:03:37'),
(394, 1, 'Created', 'Inventory', 'Added a new product: 14 Chili Flakes (ID: 166)', '2026-02-28 09:04:02', '2026-02-28 09:04:02'),
(395, 1, 'Created', 'Inventory', 'Added a new product: 15 Cloves (ID: 167)', '2026-02-28 09:04:28', '2026-02-28 09:04:28'),
(396, 1, 'Created', 'Inventory', 'Added a new product: 01 Fish Sauce (ID: 168)', '2026-02-28 09:05:07', '2026-02-28 09:05:07'),
(397, 1, 'Created', 'Inventory', 'Added a new product: 02 Soy Sauce (ID: 169)', '2026-02-28 09:05:34', '2026-02-28 09:05:34'),
(398, 1, 'Created', 'Inventory', 'Added a new product: 03 Vinegar (ID: 170)', '2026-02-28 09:06:03', '2026-02-28 09:06:03'),
(399, 1, 'Created', 'Inventory', 'Added a new product: 04 Chili Sauce (ID: 171)', '2026-02-28 09:06:27', '2026-02-28 09:06:27'),
(400, 1, 'Created', 'Inventory', 'Added a new product: 05 Tomato Ketchup (ID: 172)', '2026-02-28 09:06:50', '2026-02-28 09:06:50'),
(401, 1, 'Created', 'Inventory', 'Added a new product: 06 Oyster Sauce (ID: 173)', '2026-02-28 09:07:17', '2026-02-28 09:07:17'),
(402, 1, 'Created', 'Inventory', 'Added a new product: 07 Sesame Oil (ID: 174)', '2026-02-28 09:08:04', '2026-02-28 09:08:04'),
(403, 1, 'Created', 'Inventory', 'Added a new product: 08 Cooking Oil (ID: 175)', '2026-02-28 09:08:34', '2026-02-28 09:08:34'),
(404, 1, 'Created', 'Inventory', 'Added a new product: 09 Butter (ID: 176)', '2026-02-28 09:08:58', '2026-02-28 09:08:58'),
(405, 1, 'Created', 'Inventory', 'Added a new product: 10 Mayonnaise (ID: 177)', '2026-02-28 09:09:25', '2026-02-28 09:09:25'),
(406, 1, 'Created', 'Inventory', 'Added a new product: 11 Mustard (ID: 178)', '2026-02-28 09:10:43', '2026-02-28 09:10:43'),
(407, 1, 'Created', 'Inventory', 'Added a new product: 12 Shrimp Paste (ID: 179)', '2026-02-28 09:11:06', '2026-02-28 09:11:06'),
(408, 1, 'Created', 'Inventory', 'Added a new product: 13 Fish Paste (ID: 180)', '2026-02-28 09:11:32', '2026-02-28 09:11:32'),
(409, 1, 'Created', 'Inventory', 'Added a new product: 14 Hoisin Sauce (ID: 181)', '2026-02-28 09:11:58', '2026-02-28 09:11:58'),
(410, 1, 'Created', 'Inventory', 'Added a new product: 15 BBQ Sauce (ID: 182)', '2026-02-28 09:12:24', '2026-02-28 09:12:24'),
(411, 1, 'Created', 'Inventory', 'Added a new product: 16 Coconut Milk (ID: 183)', '2026-02-28 09:12:59', '2026-02-28 09:12:59'),
(412, 1, 'Created', 'Inventory', 'Added a new product: 17 Garlic Sauce (ID: 184)', '2026-02-28 09:13:41', '2026-02-28 09:13:41'),
(413, 1, 'Created', 'Inventory', 'Added a new product: 18 Sweet Sauce (ID: 185)', '2026-02-28 09:14:09', '2026-02-28 09:14:09'),
(414, 1, 'Created', 'Inventory', 'Added a new product: 01 Apple (ID: 186)', '2026-02-28 09:15:59', '2026-02-28 09:15:59'),
(415, 1, 'Created', 'Inventory', 'Added a new product: Green Apple (ID: 187)', '2026-02-28 09:16:53', '2026-02-28 09:16:53'),
(416, 1, 'Created', 'Inventory', 'Added a new product: 02 Banana (ID: 188)', '2026-02-28 09:18:10', '2026-02-28 09:18:10'),
(417, 1, 'Created', 'Inventory', 'Added a new product: 03 Orange (ID: 189)', '2026-02-28 09:18:53', '2026-02-28 09:18:53');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `module`, `description`, `created_at`, `updated_at`) VALUES
(418, 1, 'Created', 'Inventory', 'Added a new product: 04 Mango (ID: 190)', '2026-02-28 09:19:35', '2026-02-28 09:19:35'),
(419, 1, 'Created', 'Inventory', 'Added a new product: 05 Pineapple (ID: 191)', '2026-02-28 09:20:09', '2026-02-28 09:20:09'),
(420, 1, 'Created', 'Inventory', 'Added a new product: 06 Papaya (ID: 192)', '2026-02-28 09:20:44', '2026-02-28 09:20:44'),
(421, 1, 'Created', 'Inventory', 'Added a new product: 07 Watermelon (ID: 193)', '2026-02-28 09:21:11', '2026-02-28 09:21:11'),
(422, 1, 'Created', 'Inventory', 'Added a new product: 08 Grapes (ID: 194)', '2026-02-28 09:22:08', '2026-02-28 09:22:08'),
(423, 1, 'Created', 'Inventory', 'Added a new product: 09 Strawberry (ID: 195)', '2026-02-28 09:22:30', '2026-02-28 09:22:30'),
(424, 1, 'Created', 'Inventory', 'Added a new product: 10 Blueberry (ID: 196)', '2026-02-28 09:22:57', '2026-02-28 09:22:57'),
(425, 1, 'Created', 'Inventory', 'Added a new product: 11 Raspberry (ID: 197)', '2026-02-28 09:23:18', '2026-02-28 09:23:18'),
(426, 1, 'Created', 'Inventory', 'Added a new product: 12 Blackberry (ID: 198)', '2026-02-28 09:23:44', '2026-02-28 09:23:44'),
(427, 1, 'Created', 'Inventory', 'Added a new product: 13 Cherry (ID: 199)', '2026-02-28 09:24:14', '2026-02-28 09:24:14'),
(428, 1, 'Created', 'Inventory', 'Added a new product: 14 Peach (ID: 200)', '2026-02-28 09:24:37', '2026-02-28 09:24:37'),
(429, 1, 'Created', 'Inventory', 'Added a new product: 15 Pear (ID: 201)', '2026-02-28 09:25:07', '2026-02-28 09:25:07'),
(430, 1, 'Created', 'Inventory', 'Added a new product: 16 Plum (ID: 202)', '2026-02-28 09:25:28', '2026-02-28 09:25:28'),
(431, 1, 'Created', 'Inventory', 'Added a new product: 17 Apricot (ID: 203)', '2026-02-28 09:26:24', '2026-02-28 09:26:24'),
(432, 1, 'Created', 'Inventory', 'Added a new product: 18 Kiwi (ID: 204)', '2026-02-28 09:26:47', '2026-02-28 09:26:47'),
(433, 1, 'Created', 'Inventory', 'Added a new product: 19 Dragon fruit (ID: 205)', '2026-02-28 09:27:14', '2026-02-28 09:27:14'),
(434, 1, 'Created', 'Inventory', 'Added a new product: 20 Passion fruit (ID: 206)', '2026-02-28 09:27:43', '2026-02-28 09:27:43'),
(435, 1, 'Created', 'Inventory', 'Added a new product: 21 Guava (ID: 207)', '2026-02-28 09:28:03', '2026-02-28 09:28:03'),
(436, 1, 'Created', 'Inventory', 'Added a new product: 22 Lychee (ID: 208)', '2026-02-28 09:28:31', '2026-02-28 09:28:31'),
(437, 1, 'Created', 'Inventory', 'Added a new product: 23 Longan (ID: 209)', '2026-02-28 09:28:54', '2026-02-28 09:28:54'),
(438, 1, 'Created', 'Inventory', 'Added a new product: 24 Durian (ID: 210)', '2026-02-28 09:29:32', '2026-02-28 09:29:32'),
(439, 1, 'Created', 'Inventory', 'Added a new product: 25 Jackfruit (ID: 211)', '2026-02-28 09:30:00', '2026-02-28 09:30:00'),
(440, 1, 'Created', 'Inventory', 'Added a new product: 26 Coconut (ID: 212)', '2026-02-28 09:30:24', '2026-02-28 09:30:24'),
(441, 1, 'Created', 'Inventory', 'Added a new product: 27 Pomegranate (ID: 213)', '2026-02-28 09:30:50', '2026-02-28 09:30:50'),
(442, 1, 'Created', 'Inventory', 'Added a new product: 28 Fig (ID: 214)', '2026-02-28 09:32:07', '2026-02-28 09:32:07'),
(443, 1, 'Created', 'Inventory', 'Added a new product: 29 Date (ID: 215)', '2026-02-28 09:32:32', '2026-02-28 09:32:32'),
(444, 1, 'Created', 'Inventory', 'Added a new product: 30 Avocado (ID: 216)', '2026-02-28 09:32:58', '2026-02-28 09:32:58'),
(445, 1, 'Created', 'Inventory', 'Added a new product: 31 Lemon (ID: 217)', '2026-02-28 09:33:36', '2026-02-28 09:33:36'),
(446, 1, 'Created', 'Inventory', 'Added a new product: 32 Lime (ID: 218)', '2026-02-28 09:33:59', '2026-02-28 09:33:59'),
(447, 1, 'Created', 'Inventory', 'Added a new product: 33 Grapefruit (ID: 219)', '2026-02-28 09:34:32', '2026-02-28 09:34:32'),
(448, 1, 'Created', 'Inventory', 'Added a new product: 34 Tangerine (ID: 220)', '2026-02-28 09:35:11', '2026-02-28 09:35:11'),
(449, 1, 'Created', 'Inventory', 'Added a new product: 35 Mandarin (ID: 221)', '2026-02-28 09:35:35', '2026-02-28 09:35:35'),
(450, 1, 'Created', 'Inventory', 'Added a new product: 36 Cantaloupe (ID: 222)', '2026-02-28 09:36:01', '2026-02-28 09:36:01'),
(451, 1, 'Created', 'Inventory', 'Added a new product: 37 Honeydew (ID: 223)', '2026-02-28 09:36:36', '2026-02-28 09:36:36'),
(452, 1, 'Created', 'Inventory', 'Added a new product: 38 Cranberry (ID: 224)', '2026-02-28 09:36:59', '2026-02-28 09:36:59'),
(453, 1, 'Created', 'Inventory', 'Added a new product: 39 Mulberry (ID: 225)', '2026-02-28 09:37:20', '2026-02-28 09:37:20'),
(454, 1, 'Created', 'Inventory', 'Added a new product: 40 Starfruit (ID: 226)', '2026-02-28 09:37:40', '2026-02-28 09:37:40'),
(455, 1, 'Created', 'Inventory', 'Added a new product: 41 Sapodilla (ID: 227)', '2026-02-28 09:38:04', '2026-02-28 09:38:04'),
(456, 1, 'Created', 'Inventory', 'Added a new product: 42 Rambutan (ID: 228)', '2026-02-28 09:39:08', '2026-02-28 09:39:08'),
(457, 1, 'Created', 'Inventory', 'Added a new product: 43 Soursop (ID: 229)', '2026-02-28 09:39:29', '2026-02-28 09:39:29'),
(458, 1, 'Created', 'Inventory', 'Added a new product: 44 Custard apple (ID: 230)', '2026-02-28 09:40:14', '2026-02-28 09:40:14'),
(459, 1, 'Created', 'Inventory', 'Added a new product: 45 Pomelo (ID: 231)', '2026-02-28 09:40:46', '2026-02-28 09:40:46'),
(460, 1, 'Created', 'Inventory', 'Added a new product: 47 Nectarine (ID: 232)', '2026-02-28 09:41:13', '2026-02-28 09:41:13'),
(461, 1, 'Created', 'Inventory', 'Added a new product: 48 Olive (ID: 233)', '2026-02-28 09:41:40', '2026-02-28 09:41:40'),
(462, 1, 'Created', 'Inventory', 'Added a new product: 49 Quince (ID: 234)', '2026-02-28 09:42:00', '2026-02-28 09:42:00'),
(463, 1, 'Created', 'Inventory', 'Added a new product: 50 Gooseberry (ID: 235)', '2026-02-28 09:42:21', '2026-02-28 09:42:21'),
(464, 1, 'Created', 'Inventory', 'Added a new product: 51 Tamarind (ID: 236)', '2026-02-28 09:42:40', '2026-02-28 09:42:40'),
(465, 1, 'Created', 'Inventory', 'Added a new product: 52 Mangosteen (ID: 237)', '2026-02-28 09:43:05', '2026-02-28 09:43:05'),
(466, 1, 'Created', 'Inventory', 'Added a new product: 53 Rose Apple (ID: 238)', '2026-02-28 09:43:24', '2026-02-28 09:43:24'),
(467, 1, 'Created', 'Inventory', 'Added a new product: 54 Otaheite gooseberry (ID: 239)', '2026-02-28 09:44:13', '2026-02-28 09:44:13'),
(468, 1, 'Created', 'Inventory', 'Added a new product: 55 Passion Fruit (ID: 240)', '2026-02-28 09:44:39', '2026-02-28 09:44:39'),
(469, 1, 'Created', 'Inventory', 'Added a new product: 56 Langsat (ID: 241)', '2026-02-28 09:45:06', '2026-02-28 09:45:06'),
(470, 1, 'Created', 'Inventory', 'Added a new product: 57 Milk Fruit (ID: 242)', '2026-02-28 09:45:27', '2026-02-28 09:45:27'),
(471, 1, 'Created', 'Inventory', 'Added a new product: 58 Plum mango (ID: 243)', '2026-02-28 09:45:54', '2026-02-28 09:45:54'),
(472, 1, 'Created', 'Inventory', 'Added a new product: 59 Black Sapote (ID: 244)', '2026-02-28 09:46:19', '2026-02-28 09:46:19'),
(473, 1, 'Created', 'Inventory', 'Added a new product: 60 Lychee (ID: 245)', '2026-02-28 09:46:52', '2026-02-28 09:46:52'),
(474, 1, 'Created', 'Inventory', 'Added a new product: Cucumber (ID: 246)', '2026-02-28 09:48:12', '2026-02-28 09:48:12'),
(475, 1, 'Created', 'Inventory', 'Added a new product: Cabbage (ID: 247)', '2026-02-28 09:48:56', '2026-02-28 09:48:56'),
(476, 1, 'Created', 'Inventory', 'Added a new product: Carrot (ID: 248)', '2026-02-28 09:49:36', '2026-02-28 09:49:36'),
(477, 1, 'Created', 'Inventory', 'Added a new product: Tomato (ID: 249)', '2026-02-28 09:50:19', '2026-02-28 09:50:19'),
(478, 1, 'Created', 'Inventory', 'Added a new product: Eggplant (ID: 250)', '2026-02-28 09:51:37', '2026-02-28 09:51:37'),
(479, 1, 'Created', 'Inventory', 'Added a new product: Water spinach (ID: 251)', '2026-02-28 10:07:39', '2026-02-28 10:07:39'),
(480, 1, 'Created', 'Inventory', 'Added a new product: Pumpkin (ID: 252)', '2026-02-28 10:08:15', '2026-02-28 10:08:15'),
(481, 1, 'Created', 'Inventory', 'Added a new product: Bitter melon (ID: 253)', '2026-02-28 10:08:55', '2026-02-28 10:08:55'),
(482, 1, 'Created', 'Inventory', 'Added a new product: Yardlong bean (ID: 254)', '2026-02-28 10:09:39', '2026-02-28 10:09:39'),
(483, 1, 'Created', 'Inventory', 'Added a new product: Broccoli (ID: 255)', '2026-02-28 10:10:37', '2026-02-28 10:10:37'),
(484, 1, 'Created', 'Inventory', 'Added a new product: Cauliflower (ID: 256)', '2026-02-28 10:11:18', '2026-02-28 10:11:18'),
(485, 1, 'Created', 'Inventory', 'Added a new product: Chinese kale (ID: 257)', '2026-02-28 10:11:55', '2026-02-28 10:11:55'),
(486, 1, 'Created', 'Inventory', 'Added a new product: Chili (ID: 258)', '2026-02-28 10:12:43', '2026-02-28 10:12:43'),
(487, 1, 'Created', 'Inventory', 'Added a new product: Red Onion (ID: 259)', '2026-02-28 10:13:26', '2026-02-28 10:13:26'),
(488, 1, 'Created', 'Inventory', 'Added a new product: Garlic (ID: 260)', '2026-02-28 10:14:04', '2026-02-28 10:14:04'),
(489, 1, 'Created', 'Inventory', 'Added a new product: Lemongrass (ID: 261)', '2026-02-28 10:14:48', '2026-02-28 10:14:48'),
(490, 1, 'Created', 'Inventory', 'Added a new product: Basil (ID: 262)', '2026-02-28 10:15:29', '2026-02-28 10:15:29'),
(491, 1, 'Created', 'Inventory', 'Added a new product: Kaffir lime leaf (ID: 263)', '2026-02-28 10:16:15', '2026-02-28 10:16:15'),
(492, 1, 'Created', 'Inventory', 'Added a new product: Green bean (ID: 264)', '2026-02-28 10:17:03', '2026-02-28 10:17:03'),
(493, 1, 'Created', 'Inventory', 'Added a new product: Water mimosa (ID: 265)', '2026-02-28 10:18:05', '2026-02-28 10:18:05'),
(494, 1, 'Created', 'Inventory', 'Added a new product: Potato (ID: 266)', '2026-02-28 10:18:46', '2026-02-28 10:18:46'),
(495, 1, 'Created', 'Inventory', 'Added a new product: Sweet potato (ID: 267)', '2026-02-28 10:19:29', '2026-02-28 10:19:29'),
(496, 1, 'Created', 'Inventory', 'Added a new product: Cassava (ID: 268)', '2026-02-28 10:20:17', '2026-02-28 10:20:17'),
(497, 1, 'Created', 'Inventory', 'Added a new product: Corn (ID: 269)', '2026-02-28 10:21:00', '2026-02-28 10:21:00'),
(498, 1, 'Created', 'Inventory', 'Added a new product: Bottle gourd (ID: 270)', '2026-02-28 10:21:59', '2026-02-28 10:21:59'),
(499, 1, 'Created', 'Inventory', 'Added a new product: Luffa (ID: 271)', '2026-02-28 10:22:48', '2026-02-28 10:22:48'),
(500, 1, 'Updated', 'Inventory', 'Updated product: Bottle gourd (ID: 270)', '2026-02-28 10:22:59', '2026-02-28 10:22:59'),
(501, 1, 'Created', 'Inventory', 'Added a new product: Kale (ID: 272)', '2026-02-28 10:23:38', '2026-02-28 10:23:38'),
(502, 1, 'Created', 'Inventory', 'Added a new product: Mustard greens (ID: 273)', '2026-02-28 10:24:17', '2026-02-28 10:24:17'),
(503, 1, 'Created', 'Inventory', 'Added a new product: Khmer eggplant (ID: 274)', '2026-02-28 10:25:24', '2026-02-28 10:25:24'),
(504, 1, 'Created', 'Inventory', 'Added a new product: Mung bean (sprout) (ID: 275)', '2026-02-28 10:26:19', '2026-02-28 10:26:19'),
(505, 1, 'Created', 'Inventory', 'Added a new product: Soybean (ID: 276)', '2026-02-28 10:27:04', '2026-02-28 10:27:04'),
(506, 1, 'Created', 'Inventory', 'Added a new product: Pea (ID: 277)', '2026-02-28 10:27:45', '2026-02-28 10:27:45'),
(507, 1, 'Created', 'Inventory', 'Added a new product: Galangal (ID: 278)', '2026-02-28 10:29:21', '2026-02-28 10:29:21'),
(508, 1, 'Updated', 'Inventory', 'Updated product: Galangal (ID: 278)', '2026-02-28 10:29:38', '2026-02-28 10:29:38'),
(509, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 10:55:50', '2026-02-28 10:55:50'),
(510, 1, 'Updated', 'Inventory', 'Updated product: Pea (ID: 277)', '2026-02-28 11:48:11', '2026-02-28 11:48:11'),
(511, 1, 'Updated', 'Inventory', 'Updated product: Soybean (ID: 276)', '2026-02-28 11:48:27', '2026-02-28 11:48:27'),
(512, 1, 'Updated', 'Inventory', 'Updated product: Bottle gourd (ID: 270)', '2026-02-28 11:48:39', '2026-02-28 11:48:39'),
(513, 1, 'Updated', 'Inventory', 'Updated product: Mung bean (sprout) (ID: 275)', '2026-02-28 11:56:18', '2026-02-28 11:56:18'),
(514, 13, 'order_placed', 'Orders', 'Customer placed order #26', '2026-02-28 12:39:49', '2026-02-28 12:39:49'),
(515, 1, 'Updated', 'Inventory', 'Updated product: Galangal (ID: 278)', '2026-02-28 12:49:07', '2026-02-28 12:49:07'),
(516, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 12:51:00', '2026-02-28 12:51:00'),
(517, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #26 for delivery', '2026-02-28 12:51:10', '2026-02-28 12:51:10'),
(518, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 12:51:19', '2026-02-28 12:51:19'),
(519, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 12:53:11', '2026-02-28 12:53:11'),
(520, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 12:54:55', '2026-02-28 12:54:55'),
(521, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 12:59:46', '2026-02-28 12:59:46'),
(522, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:03:21', '2026-02-28 13:03:21'),
(523, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:10:18', '2026-02-28 13:10:18'),
(524, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:13:34', '2026-02-28 13:13:34'),
(525, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:13:49', '2026-02-28 13:13:49'),
(526, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:13:59', '2026-02-28 13:13:59'),
(527, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-28 13:14:32', '2026-02-28 13:14:32'),
(528, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 13:23:03', '2026-02-28 13:23:03'),
(529, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:23:10', '2026-02-28 13:23:10'),
(530, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 13:28:08', '2026-02-28 13:28:08'),
(531, 13, 'order_placed', 'Orders', 'Customer placed order #27', '2026-02-28 13:29:00', '2026-02-28 13:29:00'),
(532, 2, 'Accepted Order', 'Delivery', 'Driver Delivery Driver accepted Order #27 for delivery', '2026-02-28 13:29:40', '2026-02-28 13:29:40'),
(533, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:29:44', '2026-02-28 13:29:44'),
(534, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #27', '2026-02-28 13:29:58', '2026-02-28 13:29:58'),
(535, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #26', '2026-02-28 13:30:53', '2026-02-28 13:30:53'),
(536, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #27', '2026-02-28 13:30:59', '2026-02-28 13:30:59'),
(537, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #27', '2026-02-28 13:31:26', '2026-02-28 13:31:26'),
(538, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #26', '2026-02-28 13:31:28', '2026-02-28 13:31:28'),
(539, 2, 'Requested Directions', 'Delivery', 'Driver Delivery Driver requested directions for Order #27', '2026-02-28 13:32:02', '2026-02-28 13:32:02'),
(540, 2, 'Status Updated', 'Delivery', 'Driver Delivery Driver marked Order #26 as Delivered', '2026-02-28 13:34:53', '2026-02-28 13:34:53'),
(541, 2, 'Picked Up Order', 'Delivery', 'Driver Delivery Driver picked up Order #27 from store', '2026-02-28 13:44:46', '2026-02-28 13:44:46'),
(542, 2, 'Arrived at Customer', 'Delivery', 'Driver Delivery Driver arrived at customer location for Order #27', '2026-02-28 13:44:52', '2026-02-28 13:44:52'),
(543, 2, 'Status Updated', 'Delivery', 'Driver Delivery Driver marked Order #27 as Delivered', '2026-02-28 13:45:01', '2026-02-28 13:45:01'),
(544, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 13:45:26', '2026-02-28 13:45:26'),
(545, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-28 13:47:08', '2026-02-28 13:47:08'),
(546, 1, 'Logged Out', 'Auth', 'Super Admin logged out', '2026-02-28 13:47:48', '2026-02-28 13:47:48'),
(547, 2, 'Logged Out', 'Auth', 'Delivery Driver logged out', '2026-02-28 13:54:41', '2026-02-28 13:54:41');

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
(39, '2026_02_26_000005_add_is_hidden_to_review_replies_table', 28),
(43, '2026_02_26_154034_add_location_to_orders_table', 29),
(44, '2026_02_27_000001_add_performance_indexes', 29),
(45, '2026_02_27_112714_add_multilingual_support_to_products_table', 30),
(46, '2026_02_27_151224_add_location_fields_to_users_table', 31),
(47, '2026_02_28_111510_add_discount_fields_to_products_table', 32),
(48, '2026_02_26_000004_create_notifications_table', 33);

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('2037f235-58c6-470f-8984-25106c760d35', 'promotion', 'App\\Models\\User', 13, '{\"title\":\"\\ud83c\\udf89 Special Discount Just for You!\",\"message\":\"We offer you a promotion 10$ off\",\"coupon_id\":1,\"coupon_code\":\"WELCOME10\",\"discount_value\":\"10.00\",\"discount_type\":\"fixed\"}', '2026-02-28 07:01:46', '2026-02-28 06:41:46', '2026-02-28 07:01:46'),
('a1301ca6-b22d-4017-a0ab-e1a95166c616', 'order_cancelled', 'App\\Models\\User', 13, '{\"title\":\"Order Cancelled\",\"message\":\"Your order #23 has been cancelled by our staff.\",\"reason\":\"\\u17a2\\u178f\\u17b7\\u1790\\u17b7\\u1787\\u1793 \\u1798\\u17b7\\u1793\\u179b\\u17be\\u1780\\u1791\\u17bc\\u179a\\u179f\\u17d0\\u1796\\u17d2\\u1791\",\"order_id\":23,\"cancelled_by\":\"Super Admin\"}', '2026-02-28 12:27:08', '2026-02-28 12:01:52', '2026-02-28 12:27:08');

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
(16, 11, NULL, 26.20, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', NULL, NULL, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'cancelled', 'No response call from customer', 'cash', NULL, 'unpaid', NULL, '2026-02-25 18:07:13', '2026-02-28 11:49:47'),
(18, 11, NULL, 23.00, '015868608', 'Cambodia, Phnom Penh 123235463', NULL, NULL, 'Cambodia, Phnom Penh 123235463', 'cancelled', 'No response call from customer', 'cash', 'Fast Delivery (2 hours)', 'unpaid', NULL, '2026-02-25 18:21:38', '2026-02-28 11:50:01'),
(20, 13, 2, 7.00, '015868608', 'Cambodia, Phnom Penh 123235463', NULL, NULL, 'Cambodia, Phnom Penh 123235463', 'delivered', NULL, 'cash', 'Standard Delivery', 'unpaid', 'egg', '2026-02-26 09:41:57', '2026-02-27 08:06:15'),
(21, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 1234455', 11.54913649, 104.91813541, 'Chamkar Doung, Dangkor, Phnom Penh 1234455', 'cancelled', 'No response call from customer', 'cash', 'Standard Delivery', 'unpaid', 'សូមមកពេលល្ងា​ច ព្រោះខ្ញុំនៅផ្ទះ', '2026-02-27 05:48:21', '2026-02-28 11:50:09'),
(22, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51243805, 104.88872517, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'cancelled', 'No response call from customer', 'cash', 'Standard Delivery', 'unpaid', 'Please Delivery at evening if possible', '2026-02-27 05:49:20', '2026-02-28 11:50:17'),
(23, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51327900, 104.88916800, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'ready_for_pickup', NULL, 'cash', 'Standard Delivery', 'unpaid', 'Please delivery at evening', '2026-02-27 05:50:01', '2026-02-28 13:33:03'),
(24, 13, NULL, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51327900, 104.88916800, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'cancelled', 'No response call from from store', 'cash', 'Standard Delivery', 'unpaid', NULL, '2026-02-27 05:50:29', '2026-02-28 11:50:59'),
(25, 13, 2, 7.00, '015868608', 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 11.51255370, 104.88870641, 'Chamkar Doung, Dangkor, Phnom Penh 123123321', 'delivered', NULL, 'cash', 'Standard Delivery', 'paid', '3rd Floor', '2026-02-27 05:54:03', '2026-02-27 10:38:15'),
(26, 13, 2, 32.50, '015868608', 'Cambodia, Phnom Penh 123235463', 11.51938705, 104.89600071, 'Cambodia, Phnom Penh 123235463', 'delivered', NULL, 'cash', 'Express Delivery (6 hours)', 'paid', '3rd floor', '2026-02-28 12:39:49', '2026-02-28 13:34:53'),
(27, 13, 2, 7.00, '015868608', 'Cambodia, Phnom Penh 123235463', 11.51133419, 104.89428438, 'Cambodia, Phnom Penh 123235463', 'ready_for_pickup', NULL, 'cash', 'Standard Delivery', 'paid', '2nd Floor', '2026-02-28 13:29:00', '2026-02-28 13:47:40');

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
(35, 25, 69, 1, 1.00, 1.00, '2026-02-27 05:54:03', '2026-02-27 05:54:03'),
(36, 26, 278, 30, 1.00, 30.00, '2026-02-28 12:39:49', '2026-02-28 12:39:49'),
(37, 26, 276, 1, 2.00, 2.00, '2026-02-28 12:39:49', '2026-02-28 12:39:49'),
(38, 26, 275, 1, 0.50, 0.50, '2026-02-28 12:39:49', '2026-02-28 12:39:49'),
(39, 27, 278, 1, 1.00, 1.00, '2026-02-28 13:29:00', '2026-02-28 13:29:00');

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
  `discount_percent` decimal(5,2) NOT NULL DEFAULT 0.00,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `discount_start` datetime DEFAULT NULL,
  `discount_end` datetime DEFAULT NULL,
  `is_on_sale` tinyint(1) NOT NULL DEFAULT 0,
  `sale_label` varchar(255) DEFAULT NULL,
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

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `images`, `price`, `discount_percent`, `discount_price`, `discount_start`, `discount_end`, `is_on_sale`, `sale_label`, `stock`, `image`, `description`, `is_active`, `unit`, `min_stock_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(69, 2, '{\"en\":\"Banana\",\"km\":\"\\u1785\\u17c1\\u1780\",\"zh\":\"\\u9999\\u8549\"}', 'banana', 'PRD-XCJWOJOV', NULL, 11.00, 20.00, 8.80, '2026-02-27 11:45:00', '2026-03-28 11:32:00', 1, 'Flash Sale', 993, NULL, '{\"en\":\"This banana from the farmer.\",\"km\":\"This banana from the farmer.\",\"zh\":\"This banana from the farmer.\"}', 1, 'box', 5, '2026-02-21 15:17:04', '2026-02-28 04:59:57', NULL),
(75, 3, '{\"en\":\"Beef\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1782\\u17c4\",\"zh\":\"\\u725b\\u8089\"}', 'beef', 'PRD-TPQWQBFA', NULL, 10.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:42:26', '2026-02-28 07:42:26', NULL),
(76, 3, '{\"en\":\"Beefasda\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1782\\u17c4\",\"zh\":\"\\u725b\\u8089\"}', 'beef', 'PRD-HA1RJYO8', NULL, 10.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:42:27', '2026-02-28 07:49:17', '2026-02-28 07:49:17'),
(77, 3, '{\"en\":\"adsas\",\"km\":\"sad\",\"zh\":\"asd\"}', 'adsas', 'PRD-JL0LOCUI', NULL, 12.00, 0.00, NULL, NULL, NULL, 0, NULL, 1231, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:45:21', '2026-02-28 07:49:14', '2026-02-28 07:49:14'),
(78, 3, '{\"en\":\"Pork\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1787\\u17d2\\u179a\\u17bc\\u1780\",\"zh\":\"\\u732a\\u8089\"}', 'pork', 'PRD-JZC2JGGP', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:50:38', '2026-02-28 07:50:38', NULL),
(79, 3, '{\"en\":\"Chicken\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1798\\u17b6\\u1793\\u17cb\",\"zh\":\"\\u9e21\"}', 'chicken', 'PRD-KHERGVYR', NULL, 2.50, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:52:32', '2026-02-28 07:52:32', NULL),
(80, 3, '{\"en\":\"Duck\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1791\\u17b6\",\"zh\":\"\\u9e2d\\u5b50\"}', 'duck', 'PRD-K6DUNQFG', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:53:17', '2026-02-28 07:53:17', NULL),
(81, 3, '{\"en\":\"Minced Beef\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1782\\u17c4\\u1785\\u17b7\\u1789\\u17d2\\u1785\\u17d2\\u179a\\u17b6\\u17c6\",\"zh\":\"\\u725b\\u8089\\u788e\"}', 'minced-beef', 'PRD-F8QKT7OA', NULL, 12.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:54:27', '2026-02-28 07:54:27', NULL),
(82, 3, '{\"en\":\"Minced Pork\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1787\\u17d2\\u179a\\u17bc\\u1780\\u1785\\u17b7\\u1789\\u17d2\\u1785\\u17d2\\u179a\\u17b6\\u17c6\",\"zh\":\"\\u732a\\u8089\\u672b\"}', 'minced-pork', 'PRD-KGFZHUH9', NULL, 11.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:55:35', '2026-02-28 07:55:35', NULL),
(83, 3, '{\"en\":\"Pork Ribs\",\"km\":\"\\u1786\\u17d2\\u179b\\u17b9\\u1784\\u1787\\u17c6\\u1793\\u17b8\\u1787\\u17d2\\u179a\\u17bc\\u1780\",\"zh\":\"\\u732a\\u808b\\u6392\"}', 'pork-ribs', 'PRD-MNLYSVTI', NULL, 14.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:56:25', '2026-02-28 07:56:25', NULL),
(84, 3, '{\"en\":\"Sausage\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u1780\\u17d2\\u179a\\u1780\",\"zh\":\"\\u9999\\u80a0\"}', 'sausage', 'PRD-GIHFMTA0', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:57:37', '2026-02-28 07:57:37', NULL),
(85, 3, '{\"en\":\"Ham\",\"km\":\"\\u17a0\\u17b6\\u17c6\",\"zh\":\"\\u706b\\u817f\"}', 'ham', 'PRD-NTB5MTDX', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'box', 5, '2026-02-28 07:58:27', '2026-02-28 07:58:27', NULL),
(86, 3, '{\"en\":\"Bacon\",\"km\":\"\\u1794\\u17c1\\u1781\\u1793\",\"zh\":\"\\u718f\\u8089\"}', 'bacon', 'PRD-HBRSG8ZA', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 07:59:15', '2026-02-28 07:59:15', NULL),
(87, 3, '{\"en\":\"Fresh Fish\",\"km\":\"\\u178f\\u17d2\\u179a\\u17b8\\u179f\\u17d2\\u179a\\u179f\\u17cb\",\"zh\":\"\\u9c9c\\u9c7c\"}', 'fresh-fish', 'PRD-WAD1HRK2', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:00:18', '2026-02-28 08:00:18', NULL),
(88, 3, '{\"en\":\"Fish Fillet\",\"km\":\"\\u179f\\u17b6\\u1785\\u17cb\\u178f\\u17d2\\u179a\\u17b8\\u179b\\u17b6\\u178f\",\"zh\":\"\\u9c7c\\u7247\"}', 'fish-fillet', 'PRD-RVJWACSG', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:01:25', '2026-02-28 08:01:25', NULL),
(89, 3, '{\"en\":\"Shrimp\",\"km\":\"\\u1794\\u1784\\u17d2\\u1782\\u17b6\",\"zh\":\"\\u867e\"}', 'shrimp', 'PRD-T1QB9LXR', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:02:05', '2026-02-28 08:02:05', NULL),
(90, 3, '{\"en\":\"Crab\",\"km\":\"\\u1780\\u17d2\\u178a\\u17b6\\u1798\",\"zh\":\"\\u8783\\u87f9\"}', 'crab', 'PRD-IWFNSGGI', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:02:46', '2026-02-28 08:02:46', NULL),
(91, 3, '{\"en\":\"Squid\",\"km\":\"\\u1798\\u17b9\\u1780\",\"zh\":\"\\u4e4c\\u8d3c\"}', 'squid', 'PRD-QXBFPYH0', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:03:34', '2026-02-28 08:03:34', NULL),
(92, 3, '{\"en\":\"Clams\",\"km\":\"\\u179b\\u17b6\\u179f\",\"zh\":\"\\u86e4\\u870a\"}', 'clams', 'PRD-G3ZW3IN2', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:04:29', '2026-02-28 08:04:29', NULL),
(93, 3, '{\"en\":\"Mussels\",\"km\":\"\\u1782\\u17d2\\u179a\\u17bb\\u17c6\\u1791\\u1793\\u17d2\\u179b\\u17c1\",\"zh\":\"\\u8d3b\\u8d1d\"}', 'mussels', 'PRD-SOOCPKSA', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:05:23', '2026-02-28 08:05:23', NULL),
(94, 3, '{\"en\":\"Salmon\",\"km\":\"\\u178f\\u17d2\\u179a\\u17b8\\u179f\\u17b6\\u179b\\u1798\\u17c9\\u17bb\\u1793\",\"zh\":\"\\u4e09\\u6587\\u9c7c\"}', 'salmon', 'PRD-DIL4CASU', NULL, 15.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:06:13', '2026-02-28 08:06:13', NULL),
(95, 5, '{\"en\":\"Coca Zero\",\"km\":\"\\u1780\\u17bc\\u1780\\u17b6 \\u17a0\\u17d2\\u179f\\u17c1\\u179a\\u17c9\\u17bc\",\"zh\":\"\\u96f6\\u5ea6\\u53ef\\u53e3\\u53ef\\u4e50\"}', 'coca-zero', 'PRD-LSFFJHFL', NULL, 12.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'box', 5, '2026-02-28 08:12:22', '2026-02-28 08:12:22', NULL),
(96, 5, '{\"en\":\"Red Sting\",\"km\":\"\\u179f\\u17d2\\u1791\\u17b8\\u1784\\u1780\\u17d2\\u179a\\u17a0\\u1798\",\"zh\":\"Red Sting\"}', 'red-sting', 'PRD-UHWRKGK2', NULL, 15.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'box', 5, '2026-02-28 08:14:13', '2026-02-28 08:14:13', NULL),
(97, 5, '{\"en\":\"Yellow Sting\",\"km\":\"\\u179f\\u17d2\\u1791\\u17b8\\u1784\\u179b\\u17bf\\u1784\",\"zh\":\"Yellow Sting\"}', 'yellow-sting', 'PRD-5KHCUF1C', NULL, 15.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'box', 5, '2026-02-28 08:15:27', '2026-02-28 08:15:27', NULL),
(98, 5, '{\"en\":\"Red Bull\",\"km\":\"\\u1782\\u17c4\\u1787\\u179b\\u17cb\",\"zh\":\"\\u7ea2\\u725b\\u80fd\\u91cf\\u996e\\u6599\"}', 'red-bull', 'PRD-UAZCOWU6', NULL, 15.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'box', 5, '2026-02-28 08:16:36', '2026-02-28 08:16:36', NULL),
(99, 5, '{\"en\":\"Pepci\",\"km\":\"\\u1794\\u17c9\\u17b7\\u1794\\u179f\\u17ca\\u17b8\",\"zh\":\"\\u767e\\u666e\\u79d1\"}', 'pepci', 'PRD-MPT2B73T', NULL, 15.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'box', 5, '2026-02-28 08:17:26', '2026-02-28 08:17:26', NULL),
(100, 5, '{\"en\":\"Fresh Water\",\"km\":\"\\u1791\\u17b9\\u1780\\u179f\\u17bb\\u1791\\u17d2\\u1792\",\"zh\":\"\\u6de1\\u6c34\"}', 'fresh-water', 'PRD-GA9MGS4P', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'box', 5, '2026-02-28 08:18:20', '2026-02-28 08:18:20', NULL),
(101, 7, '{\"en\":\"01 Baguette\",\"km\":\"\\u1793\\u17c6\\u1794\\u17c9\\u17d0\\u1784\\u179c\\u17c2\\u1784\",\"zh\":\"\\u6cd5\\u68cd\\u9762\\u5305\"}', '01-baguette', 'PRD-6YEKEFPX', NULL, 1.50, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:20:14', '2026-02-28 08:20:14', NULL),
(102, 7, '{\"en\":\"02 White Bread\",\"km\":\"\\u1793\\u17c6\\u1794\\u17c9\\u17d0\\u1784\\u1787\\u17d2\\u179a\\u17bb\\u1784\",\"zh\":\"\\u767d\\u9762\\u5305\"}', '02-white-bread', 'PRD-UVRHBKP8', NULL, 1.20, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:21:18', '2026-02-28 08:21:18', NULL),
(103, 7, '{\"en\":\"03 Whole Wheat Bread\",\"km\":\"\\u1793\\u17c6\\u1794\\u17c9\\u17d0\\u1784\\u179f\\u17d2\\u179a\\u17bc\\u179c\\u179f\\u17b6\\u17a1\\u17b8\",\"zh\":\"\\u5168\\u9ea6\\u9762\\u5305\"}', '03-whole-wheat-bread', 'PRD-XRDNQMAT', NULL, 1.60, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:22:07', '2026-02-28 08:22:07', NULL),
(104, 7, '{\"en\":\"04 Croissant\",\"km\":\"\\u1793\\u17c6\\u1794\\u17c9\\u17d0\\u1784\\u1794\\u17c9\\u17c4\\u1784\",\"zh\":\"\\u725b\\u89d2\\u9762\\u5305\"}', '04-croissant', 'PRD-IL6VB76V', NULL, 1.20, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:22:59', '2026-02-28 08:22:59', NULL),
(105, 7, '{\"en\":\"05 Garlic Bread\",\"km\":\"\\u1793\\u17c6\\u1794\\u17c9\\u17d0\\u1784\\u1781\\u17d2\\u1791\\u17b9\\u1798\\u179f\",\"zh\":\"\\u849c\\u84c9\\u9762\\u5305\"}', '05-garlic-bread', 'PRD-3DQ0BFY7', NULL, 1.40, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:23:46', '2026-02-28 08:23:46', NULL),
(106, 7, '{\"en\":\"06 Burger Bun\",\"km\":\"\\u1793\\u17c6\\u1794\\u17c9\\u17bb\\u1784\\u1798\\u17bc\\u179b\",\"zh\":\"\\u6c49\\u5821\\u9762\\u5305\"}', '06-burger-bun', 'PRD-BFVCOEMB', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:24:33', '2026-02-28 08:24:33', NULL),
(107, 7, '{\"en\":\"07 Hot Dog Bun\",\"km\":\"\\u1793\\u17c6\\u1794\\u17c9\\u17d0\\u1784\\u17a0\\u178f\\u178a\\u1780\",\"zh\":\"\\u70ed\\u72d7\\u9762\\u5305\"}', '07-hot-dog-bun', 'PRD-XOTXAGLK', NULL, 1.10, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:25:23', '2026-02-28 08:25:23', NULL),
(108, 7, '{\"en\":\"08 Chocolate Cake\",\"km\":\"\\u1793\\u17c6\\u1781\\u17c1\\u1780\\u179f\\u17bc\\u1780\\u17bc\\u17a1\\u17b6\",\"zh\":\"\\u5de7\\u514b\\u529b\\u86cb\\u7cd5\"}', '08-chocolate-cake', 'PRD-V9ESQNUH', NULL, 1.55, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:26:19', '2026-02-28 08:26:19', NULL),
(109, 7, '{\"en\":\"09 Vanilla Cake\",\"km\":\"\\u1793\\u17c6\\u1781\\u17c1\\u1780 \\u179c\\u17c9\\u17b6\\u1793\\u17b8\\u17a1\\u17b6\",\"zh\":\"\\u9999\\u8349\\u86cb\\u7cd5\"}', '09-vanilla-cake', 'PRD-GT6OJLJY', NULL, 1.50, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:27:02', '2026-02-28 08:27:02', NULL),
(110, 7, '{\"en\":\"10 Red Velvet Cake\",\"km\":\"10 Red Velvet Cake\",\"zh\":\"10 Red Velvet Cake\"}', '10-red-velvet-cake', 'PRD-QHYAULP0', NULL, 1.60, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:27:35', '2026-02-28 08:27:35', NULL),
(111, 7, '{\"en\":\"11 Donut\",\"km\":\"11 Donut\",\"zh\":\"11 Donut\"}', '11-donut', 'PRD-N0BY3TJN', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:28:02', '2026-02-28 08:28:02', NULL),
(112, 7, '{\"en\":\"12 Danish Pastry\",\"km\":\"12 Danish Pastry\",\"zh\":\"12 Danish Pastry\"}', '12-danish-pastry', 'PRD-EYQFOGC2', NULL, 1.40, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:28:41', '2026-02-28 08:28:41', NULL),
(113, 7, '{\"en\":\"13 Pie\",\"km\":\"13 Pie\",\"zh\":\"13 Pie\"}', '13-pie', 'PRD-TKLOGIQA', NULL, 1.55, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:29:08', '2026-02-28 08:29:08', NULL),
(114, 8, '{\"en\":\"01 Potato Chips\",\"km\":\"01 Potato Chips\",\"zh\":\"\\u85af\\u7247\"}', '01-potato-chips', 'PRD-EBUCFYIE', NULL, 0.50, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:30:22', '2026-02-28 08:30:22', NULL),
(115, 8, '{\"en\":\"02 Nachos\",\"km\":\"02 Nachos\",\"zh\":\"02 Nachos\"}', '02-nachos', 'PRD-9GAP6YAV', NULL, 0.50, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:30:52', '2026-02-28 08:30:52', NULL),
(116, 8, '{\"en\":\"03 Cheese Balls\",\"km\":\"03 Cheese Balls\",\"zh\":\"03 Cheese Balls\"}', '03-cheese-balls', 'PRD-F7S0UDUD', NULL, 0.60, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:32:31', '2026-02-28 08:32:31', NULL),
(117, 8, '{\"en\":\"04 Pretzels\",\"km\":\"04 Pretzels\",\"zh\":\"04 Pretzels\"}', '04-pretzels', 'PRD-XU2IXWKY', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:33:31', '2026-02-28 08:33:31', NULL),
(118, 8, '{\"en\":\"05 Popcorn\",\"km\":\"05 Popcorn\",\"zh\":\"05 Popcorn\"}', '05-popcorn', 'PRD-6A5AYDY8', NULL, 1.20, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:34:01', '2026-02-28 08:34:01', NULL),
(119, 8, '{\"en\":\"06 Corn Chips\",\"km\":\"06 Corn Chips\",\"zh\":\"06 Corn Chips\"}', '06-corn-chips', 'PRD-WSBSAPLP', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:34:27', '2026-02-28 08:34:27', NULL),
(120, 8, '{\"en\":\"07 Shrimp Chips\",\"km\":\"07 Shrimp Chips\",\"zh\":\"07 Shrimp Chips\"}', '07-shrimp-chips', 'PRD-5AEOR0BL', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:34:49', '2026-02-28 08:34:49', NULL),
(121, 8, '{\"en\":\"08 Seaweed Snack\",\"km\":\"08 Seaweed Snack\",\"zh\":\"08 Seaweed Snack\"}', '08-seaweed-snack', 'PRD-11HUF7CI', NULL, 1.60, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:35:17', '2026-02-28 08:35:17', NULL),
(122, 8, '{\"en\":\"09 Chocolate Bar\",\"km\":\"09 Chocolate Bar\",\"zh\":\"09 Chocolate Bar\"}', '09-chocolate-bar', 'PRD-KRSEONLV', NULL, 1.70, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:35:44', '2026-02-28 08:35:44', NULL),
(123, 8, '{\"en\":\"10 Cookies\",\"km\":\"10 Cookies\",\"zh\":\"10 Cookies\"}', '10-cookies', 'PRD-O4WFHGTA', NULL, 1.60, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:36:12', '2026-02-28 08:36:12', NULL),
(124, 8, '{\"en\":\"11 Wafer\",\"km\":\"11 Wafer\",\"zh\":\"11 Wafer\"}', '11-wafer', 'PRD-KOIV2ONN', NULL, 1.50, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:36:45', '2026-02-28 08:36:45', NULL),
(125, 8, '{\"en\":\"12 Candy\",\"km\":\"12 Candy\",\"zh\":\"12 Candy\"}', '12-candy', 'PRD-OECJJF9Z', NULL, 1.90, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:37:09', '2026-02-28 08:37:09', NULL),
(126, 8, '{\"en\":\"13 Marshmallow\",\"km\":\"13 Marshmallow\",\"zh\":\"13 Marshmallow\"}', '13-marshmallow', 'PRD-1LWGG8U8', NULL, 1.70, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:37:39', '2026-02-28 08:37:39', NULL),
(127, 8, '{\"en\":\"14 Granola Bar\",\"km\":\"14 Granola Bar\",\"zh\":\"14 Granola Bar\"}', '14-granola-bar', 'PRD-U1T0FLW7', NULL, 1.90, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:38:01', '2026-02-28 08:38:01', NULL),
(128, 8, '{\"en\":\"15 Sweet Rice Crackers\",\"km\":\"15 Sweet Rice Crackers\",\"zh\":\"15 Sweet Rice Crackers\"}', '15-sweet-rice-crackers', 'PRD-QMCWUJM2', NULL, 1.80, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'pack', 5, '2026-02-28 08:38:25', '2026-02-28 08:38:25', NULL),
(129, 8, '{\"en\":\"16 Caramel Popcorn\",\"km\":\"16 Caramel Popcorn\",\"zh\":\"16 Caramel Popcorn\"}', '16-caramel-popcorn', 'PRD-JEFJSP1U', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:39:30', '2026-02-28 08:39:30', NULL),
(130, 6, '{\"en\":\"01 Frozen Chicken\",\"km\":\"01 Frozen Chicken\",\"zh\":\"01 Frozen Chicken\"}', '01-frozen-chicken', 'PRD-QJOEZ4CV', NULL, 10.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:40:40', '2026-02-28 08:40:40', NULL),
(131, 6, '{\"en\":\"02 Frozen Beef\",\"km\":\"02 Frozen Beef\",\"zh\":\"02 Frozen Beef\"}', '02-frozen-beef', 'PRD-IIFSFCRJ', NULL, 10.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:41:07', '2026-02-28 08:41:07', NULL),
(132, 6, '{\"en\":\"03 Frozen Pork\",\"km\":\"03 Frozen Pork\",\"zh\":\"03 Frozen Pork\"}', '03-frozen-pork', 'PRD-3YO5YGB4', NULL, 13.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:41:33', '2026-02-28 08:41:33', NULL),
(133, 6, '{\"en\":\"04 Frozen Shrimp\",\"km\":\"04 Frozen Shrimp\",\"zh\":\"04 Frozen Shrimp\"}', '04-frozen-shrimp', 'PRD-JWEPC3RR', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:42:02', '2026-02-28 08:42:02', NULL),
(134, 6, '{\"en\":\"05 Frozen Fish\",\"km\":\"05 Frozen Fish\",\"zh\":\"05 Frozen Fish\"}', '05-frozen-fish', 'PRD-9SJ0EVMO', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:42:36', '2026-02-28 08:42:36', NULL),
(135, 6, '{\"en\":\"06 Frozen Squid\",\"km\":\"06 Frozen Squid\",\"zh\":\"06 Frozen Squid\"}', '06-frozen-squid', 'PRD-X9IJ66AQ', NULL, 12.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:44:31', '2026-02-28 08:44:31', NULL),
(136, 6, '{\"en\":\"07 Frozen Crab\",\"km\":\"07 Frozen Crab\",\"zh\":\"07 Frozen Crab\"}', '07-frozen-crab', 'PRD-4A1JSDFE', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:45:46', '2026-02-28 08:45:46', NULL),
(137, 6, '{\"en\":\"08 Vanilla Ice Cream\",\"km\":\"08 Vanilla Ice Cream\",\"zh\":\"08 Vanilla Ice Cream\"}', '08-vanilla-ice-cream', 'PRD-TCZLYPH8', NULL, 1.50, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:46:27', '2026-02-28 08:46:27', NULL),
(138, 6, '{\"en\":\"09 Chocolate Ice Cream\",\"km\":\"09 Chocolate Ice Cream\",\"zh\":\"09 Chocolate Ice Cream\"}', '09-chocolate-ice-cream', 'PRD-VWXNA5YL', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:46:55', '2026-02-28 08:46:55', NULL),
(139, 6, '{\"en\":\"10 Strawberry Ice Cream\",\"km\":\"10 Strawberry Ice Cream\",\"zh\":\"10 Strawberry Ice Cream\"}', '10-strawberry-ice-cream', 'PRD-RX93ISW0', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:47:29', '2026-02-28 08:47:29', NULL),
(140, 6, '{\"en\":\"11 Matcha Ice Cream\",\"km\":\"11 Matcha Ice Cream\",\"zh\":\"11 Matcha Ice Cream\"}', '11-matcha-ice-cream', 'PRD-FCS0D5S8', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:47:55', '2026-02-28 08:47:55', NULL),
(141, 6, '{\"en\":\"12 Coconut Ice Cream\",\"km\":\"12 Coconut Ice Cream\",\"zh\":\"12 Coconut Ice Cream\"}', '12-coconut-ice-cream', 'PRD-ERFYMTF0', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:48:31', '2026-02-28 08:48:31', NULL),
(142, 6, '{\"en\":\"13 Mango Ice Cream\",\"km\":\"13 Mango Ice Cream\",\"zh\":\"13 Mango Ice Cream\"}', '13-mango-ice-cream', 'PRD-VHAXQGHN', NULL, 6.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:48:58', '2026-02-28 08:48:58', NULL),
(143, 4, '{\"en\":\"01 Fresh Milk\",\"km\":\"01 Fresh Milk\",\"zh\":\"01 Fresh Milk\"}', '01-fresh-milk', 'PRD-Y8EMXVQA', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:50:43', '2026-02-28 08:50:43', NULL),
(144, 4, '{\"en\":\"02 Condensed Milk\",\"km\":\"02 Condensed Milk\",\"zh\":\"02 Condensed Milk\"}', '02-condensed-milk', 'PRD-KJBRSI8Y', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:51:24', '2026-02-28 08:51:24', NULL),
(145, 4, '{\"en\":\"03 Milk Powder\",\"km\":\"03 Milk Powder\",\"zh\":\"03 Milk Powder\"}', '03-milk-powder', 'PRD-BJTPWIJ7', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:51:50', '2026-02-28 08:51:50', NULL),
(146, 4, '{\"en\":\"04 Raw Milk\",\"km\":\"04 Raw Milk\",\"zh\":\"04 Raw Milk\"}', '04-raw-milk', 'PRD-SX62UIQ4', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:52:19', '2026-02-28 08:52:19', NULL),
(147, 4, '{\"en\":\"05 Yogurt\",\"km\":\"05 Yogurt\",\"zh\":\"05 Yogurt\"}', '05-yogurt', 'PRD-UU07AF8T', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:52:44', '2026-02-28 08:52:44', NULL),
(148, 4, '{\"en\":\"06 Cheese\",\"km\":\"06 Cheese\",\"zh\":\"06 Cheese\"}', '06-cheese', 'PRD-VIAKLRLA', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:53:13', '2026-02-28 08:53:13', NULL),
(149, 4, '{\"en\":\"07 Butter\",\"km\":\"07 Butter\",\"zh\":\"07 Butter\"}', '07-butter', 'PRD-BBSJTGSH', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:53:45', '2026-02-28 08:53:45', NULL),
(150, 4, '{\"en\":\"08 Cream\",\"km\":\"08 Cream\",\"zh\":\"08 Cream\"}', '08-cream', 'PRD-H3PRTNQ3', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 08:54:12', '2026-02-28 08:54:12', NULL),
(151, 4, '{\"en\":\"09 Chicken Egg\",\"km\":\"09 Chicken Egg\",\"zh\":\"09 Chicken Egg\"}', '09-chicken-egg', 'PRD-DZGJARHT', NULL, 0.20, 0.00, NULL, NULL, NULL, 0, NULL, 10000, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:55:03', '2026-02-28 08:55:03', NULL),
(152, 4, '{\"en\":\"10 Duck Egg\",\"km\":\"10 Duck Egg\",\"zh\":\"10 Duck Egg\"}', '10-duck-egg', 'PRD-KW2WAWJC', NULL, 0.30, 0.00, NULL, NULL, NULL, 0, NULL, 10000, NULL, NULL, 1, 'piece', 5, '2026-02-28 08:55:38', '2026-02-28 08:55:38', NULL),
(153, 10, '{\"en\":\"01 Black Pepper\",\"km\":\"01 Black Pepper\",\"zh\":\"01 Black Pepper\"}', '01-black-pepper', 'PRD-NJLOXYEV', NULL, 10.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:56:26', '2026-02-28 08:58:08', NULL),
(154, 10, '{\"en\":\"02 Turmeric\",\"km\":\"02 Turmeric\",\"zh\":\"02 Turmeric\"}', '02-turmeric', 'PRD-PC4BTJ1D', NULL, 0.40, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'g', 5, '2026-02-28 08:56:50', '2026-02-28 08:58:26', NULL),
(155, 10, '{\"en\":\"03 Salt\",\"km\":\"03 Salt\",\"zh\":\"03 Salt\"}', '03-salt', 'PRD-1IHPQM3Z', NULL, 1.20, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:57:49', '2026-02-28 08:57:49', NULL),
(156, 10, '{\"en\":\"04 Sugar\",\"km\":\"04 Sugar\",\"zh\":\"04 Sugar\"}', '04-sugar', 'PRD-BAPGSBNY', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:59:26', '2026-02-28 08:59:26', NULL),
(157, 10, '{\"en\":\"05 Palm Sugar\",\"km\":\"05 Palm Sugar\",\"zh\":\"05 Palm Sugar\"}', '05-palm-sugar', 'PRD-T7QU3H60', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 08:59:53', '2026-02-28 08:59:53', NULL),
(158, 10, '{\"en\":\"06 Paprika\",\"km\":\"06 Paprika\",\"zh\":\"06 Paprika\"}', '06-paprika', 'PRD-WQ5JBFP2', NULL, 10.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:00:28', '2026-02-28 09:00:28', NULL),
(159, 10, '{\"en\":\"07 Cinnamon\",\"km\":\"07 Cinnamon\",\"zh\":\"07 Cinnamon\"}', '07-cinnamon', 'PRD-IPUXCV68', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:00:54', '2026-02-28 09:00:54', NULL),
(160, 10, '{\"en\":\"08 Cardamom\",\"km\":\"08 Cardamom\",\"zh\":\"08 Cardamom\"}', '08-cardamom', 'PRD-Y0HBDVNL', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:01:17', '2026-02-28 09:01:17', NULL),
(161, 10, '{\"en\":\"09 Star Anise\",\"km\":\"09 Star Anise\",\"zh\":\"09 Star Anise\"}', '09-star-anise', 'PRD-DBCOLMNX', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:01:39', '2026-02-28 09:01:39', NULL),
(162, 10, '{\"en\":\"10 Garlic\",\"km\":\"10 Garlic\",\"zh\":\"10 Garlic\"}', '10-garlic', 'PRD-RJBZXHVO', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:02:12', '2026-02-28 09:02:12', NULL),
(163, 10, '{\"en\":\"11 Shallot\",\"km\":\"11 Shallot\",\"zh\":\"11 Shallot\"}', '11-shallot', 'PRD-CQALJBSQ', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:02:43', '2026-02-28 09:02:43', NULL),
(164, 10, '{\"en\":\"12 Cumin\",\"km\":\"12 Cumin\",\"zh\":\"12 Cumin\"}', '12-cumin', 'PRD-AAVUVERD', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:03:16', '2026-02-28 09:03:16', NULL),
(165, 10, '{\"en\":\"13 Dried Lemongrass\",\"km\":\"13 Dried Lemongrass\",\"zh\":\"13 Dried Lemongrass\"}', '13-dried-lemongrass', 'PRD-GUOKIDY9', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:03:37', '2026-02-28 09:03:37', NULL),
(166, 10, '{\"en\":\"14 Chili Flakes\",\"km\":\"14 Chili Flakes\",\"zh\":\"14 Chili Flakes\"}', '14-chili-flakes', 'PRD-ORKXJPHE', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:04:02', '2026-02-28 09:04:02', NULL),
(167, 10, '{\"en\":\"15 Cloves\",\"km\":\"15 Cloves\",\"zh\":\"15 Cloves\"}', '15-cloves', 'PRD-KJ5VBI7Y', NULL, 5.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:04:28', '2026-02-28 09:04:28', NULL),
(168, 10, '{\"en\":\"01 Fish Sauce\",\"km\":\"01 Fish Sauce\",\"zh\":\"01 Fish Sauce\"}', '01-fish-sauce', 'PRD-SPO66YNH', NULL, 1.60, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:05:07', '2026-02-28 09:05:07', NULL),
(169, 10, '{\"en\":\"02 Soy Sauce\",\"km\":\"02 Soy Sauce\",\"zh\":\"02 Soy Sauce\"}', '02-soy-sauce', 'PRD-MIRVVEJ0', NULL, 1.30, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:05:34', '2026-02-28 09:05:34', NULL),
(170, 10, '{\"en\":\"03 Vinegar\",\"km\":\"03 Vinegar\",\"zh\":\"03 Vinegar\"}', '03-vinegar', 'PRD-UTHG73HO', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:06:03', '2026-02-28 09:06:03', NULL),
(171, 10, '{\"en\":\"04 Chili Sauce\",\"km\":\"04 Chili Sauce\",\"zh\":\"04 Chili Sauce\"}', '04-chili-sauce', 'PRD-UO06C77X', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:06:27', '2026-02-28 09:06:27', NULL),
(172, 10, '{\"en\":\"05 Tomato Ketchup\",\"km\":\"05 Tomato Ketchup\",\"zh\":\"05 Tomato Ketchup\"}', '05-tomato-ketchup', 'PRD-83FCCK10', NULL, 1.20, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:06:50', '2026-02-28 09:06:50', NULL),
(173, 10, '{\"en\":\"06 Oyster Sauce\",\"km\":\"06 Oyster Sauce\",\"zh\":\"06 Oyster Sauce\"}', '06-oyster-sauce', 'PRD-UKDJWOLX', NULL, 1.70, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:07:17', '2026-02-28 09:07:17', NULL),
(174, 10, '{\"en\":\"07 Sesame Oil\",\"km\":\"07 Sesame Oil\",\"zh\":\"07 Sesame Oil\"}', '07-sesame-oil', 'PRD-MHXZURXK', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:08:04', '2026-02-28 09:08:04', NULL),
(175, 10, '{\"en\":\"08 Cooking Oil\",\"km\":\"08 Cooking Oil\",\"zh\":\"08 Cooking Oil\"}', '08-cooking-oil', 'PRD-D20YY8FU', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:08:34', '2026-02-28 09:08:34', NULL),
(176, 10, '{\"en\":\"09 Butter\",\"km\":\"09 Butter\",\"zh\":\"09 Butter\"}', '09-butter', 'PRD-PUMF0QU7', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:08:58', '2026-02-28 09:08:58', NULL),
(177, 10, '{\"en\":\"10 Mayonnaise\",\"km\":\"10 Mayonnaise\",\"zh\":\"10 Mayonnaise\"}', '10-mayonnaise', 'PRD-CZPGYBQI', NULL, 2.80, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:09:25', '2026-02-28 09:09:25', NULL),
(178, 10, '{\"en\":\"11 Mustard\",\"km\":\"11 Mustard\",\"zh\":\"11 Mustard\"}', '11-mustard', 'PRD-UJST1WNP', NULL, 1.50, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:10:43', '2026-02-28 09:10:43', NULL),
(179, 10, '{\"en\":\"12 Shrimp Paste\",\"km\":\"12 Shrimp Paste\",\"zh\":\"12 Shrimp Paste\"}', '12-shrimp-paste', 'PRD-CXHNB7LQ', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:11:06', '2026-02-28 09:11:06', NULL),
(180, 10, '{\"en\":\"13 Fish Paste\",\"km\":\"13 Fish Paste\",\"zh\":\"13 Fish Paste\"}', '13-fish-paste', 'PRD-038LOYYJ', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:11:32', '2026-02-28 09:11:32', NULL),
(181, 10, '{\"en\":\"14 Hoisin Sauce\",\"km\":\"14 Hoisin Sauce\",\"zh\":\"14 Hoisin Sauce\"}', '14-hoisin-sauce', 'PRD-MKD52MSK', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:11:58', '2026-02-28 09:11:58', NULL),
(182, 10, '{\"en\":\"15 BBQ Sauce\",\"km\":\"15 BBQ Sauce\",\"zh\":\"15 BBQ Sauce\"}', '15-bbq-sauce', 'PRD-YKHOIAOU', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:12:24', '2026-02-28 09:12:24', NULL),
(183, 10, '{\"en\":\"16 Coconut Milk\",\"km\":\"16 Coconut Milk\",\"zh\":\"16 Coconut Milk\"}', '16-coconut-milk', 'PRD-DM1EMPUM', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 09:12:59', '2026-02-28 09:12:59', NULL),
(184, 10, '{\"en\":\"17 Garlic Sauce\",\"km\":\"17 Garlic Sauce\",\"zh\":\"17 Garlic Sauce\"}', '17-garlic-sauce', 'PRD-XN4XKPSS', NULL, 1.90, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 09:13:41', '2026-02-28 09:13:41', NULL),
(185, 10, '{\"en\":\"18 Sweet Sauce\",\"km\":\"18 Sweet Sauce\",\"zh\":\"18 Sweet Sauce\"}', '18-sweet-sauce', 'PRD-FWNNUIEX', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'box', 5, '2026-02-28 09:14:09', '2026-02-28 09:14:09', NULL),
(186, 2, '{\"en\":\"01 Apple\",\"km\":\"\\u1794\\u17c9\\u17c4\\u1798\\u1780\\u17d2\\u179a\\u17a0\\u1798\",\"zh\":\"\\u82f9\\u679c\"}', '01-apple', 'PRD-DIHXZT5Z', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:15:59', '2026-02-28 09:15:59', NULL),
(187, 2, '{\"en\":\"Green Apple\",\"km\":\"\\u1794\\u17c9\\u17c4\\u1798\\u1794\\u17c3\\u178f\\u1784\",\"zh\":\"\\u82f9\\u679c\"}', 'green-apple', 'PRD-J3CBXQ3L', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:16:53', '2026-02-28 09:16:53', NULL),
(188, 2, '{\"en\":\"02 Banana\",\"km\":\"02 Banana\",\"zh\":\"02 Banana\"}', '02-banana', 'PRD-NAR78MCW', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:18:10', '2026-02-28 09:18:10', NULL),
(189, 2, '{\"en\":\"03 Orange\",\"km\":\"\\u1780\\u17d2\\u179a\\u17bc\\u1785\",\"zh\":\"\\u6a59\\u5b50\"}', '03-orange', 'PRD-0WJM1L2T', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:18:53', '2026-02-28 09:18:53', NULL),
(190, 2, '{\"en\":\"04 Mango\",\"km\":\"04 Mango\",\"zh\":\"04 Mango\"}', '04-mango', 'PRD-A7VGZOY7', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:19:35', '2026-02-28 09:19:35', NULL),
(191, 2, '{\"en\":\"05 Pineapple\",\"km\":\"05 Pineapple\",\"zh\":\"05 Pineapple\"}', '05-pineapple', 'PRD-ERBWZHXP', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:20:08', '2026-02-28 09:20:08', NULL),
(192, 2, '{\"en\":\"06 Papaya\",\"km\":\"06 Papaya\",\"zh\":\"06 Papaya\"}', '06-papaya', 'PRD-Q4RYYBL0', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:20:44', '2026-02-28 09:20:44', NULL),
(193, 2, '{\"en\":\"07 Watermelon\",\"km\":\"07 Watermelon\",\"zh\":\"07 Watermelon\"}', '07-watermelon', 'PRD-LGKXRKP9', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:21:11', '2026-02-28 09:21:11', NULL),
(194, 2, '{\"en\":\"08 Grapes\",\"km\":\"08 Grapes\",\"zh\":\"08 Grapes\"}', '08-grapes', 'PRD-5Q9DH2P1', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:22:08', '2026-02-28 09:22:08', NULL),
(195, 2, '{\"en\":\"09 Strawberry\",\"km\":\"09 Strawberry\",\"zh\":\"09 Strawberry\"}', '09-strawberry', 'PRD-PFFCEHXK', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:22:30', '2026-02-28 09:22:30', NULL),
(196, 2, '{\"en\":\"10 Blueberry\",\"km\":\"10 Blueberry\",\"zh\":\"10 Blueberry\"}', '10-blueberry', 'PRD-EVX64MST', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:22:57', '2026-02-28 09:22:57', NULL),
(197, 2, '{\"en\":\"11 Raspberry\",\"km\":\"11 Raspberry\",\"zh\":\"11 Raspberry\"}', '11-raspberry', 'PRD-W16UDVKK', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:23:18', '2026-02-28 09:23:18', NULL),
(198, 2, '{\"en\":\"12 Blackberry\",\"km\":\"12 Blackberry\",\"zh\":\"12 Blackberry\"}', '12-blackberry', 'PRD-J6ZY3OWD', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:23:44', '2026-02-28 09:23:44', NULL),
(199, 2, '{\"en\":\"13 Cherry\",\"km\":\"13 Cherry\",\"zh\":\"13 Cherry\"}', '13-cherry', 'PRD-EUHGNACR', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:24:14', '2026-02-28 09:24:14', NULL),
(200, 2, '{\"en\":\"14 Peach\",\"km\":\"14 Peach\",\"zh\":\"14 Peach\"}', '14-peach', 'PRD-STIRRAPH', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:24:37', '2026-02-28 09:24:37', NULL),
(201, 2, '{\"en\":\"15 Pear\",\"km\":\"15 Pear\",\"zh\":\"15 Pear\"}', '15-pear', 'PRD-LHCTQF1Y', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:25:07', '2026-02-28 09:25:07', NULL),
(202, 2, '{\"en\":\"16 Plum\",\"km\":\"16 Plum\",\"zh\":\"16 Plum\"}', '16-plum', 'PRD-CUNGKHZE', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:25:28', '2026-02-28 09:25:28', NULL),
(203, 2, '{\"en\":\"17 Apricot\",\"km\":\"17 Apricot\",\"zh\":\"17 Apricot\"}', '17-apricot', 'PRD-MKRRJPPP', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:26:24', '2026-02-28 09:26:24', NULL),
(204, 2, '{\"en\":\"18 Kiwi\",\"km\":\"18 Kiwi\",\"zh\":\"18 Kiwi\"}', '18-kiwi', 'PRD-N6OHCYVH', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:26:47', '2026-02-28 09:26:47', NULL),
(205, 2, '{\"en\":\"19 Dragon fruit\",\"km\":\"19 Dragon fruit\",\"zh\":\"19 Dragon fruit\"}', '19-dragon-fruit', 'PRD-YDUS721X', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:27:14', '2026-02-28 09:27:14', NULL),
(206, 2, '{\"en\":\"20 Passion fruit\",\"km\":\"20 Passion fruit\",\"zh\":\"20 Passion fruit\"}', '20-passion-fruit', 'PRD-S18YUG0G', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:27:43', '2026-02-28 09:27:43', NULL),
(207, 2, '{\"en\":\"21 Guava\",\"km\":\"21 Guava\",\"zh\":\"21 Guava\"}', '21-guava', 'PRD-1C7NV855', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:28:03', '2026-02-28 09:28:03', NULL),
(208, 2, '{\"en\":\"22 Lychee\",\"km\":\"22 Lychee\",\"zh\":\"22 Lychee\"}', '22-lychee', 'PRD-A4TVFIUI', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:28:31', '2026-02-28 09:28:31', NULL),
(209, 2, '{\"en\":\"23 Longan\",\"km\":\"23 Longan\",\"zh\":\"23 Longan\"}', '23-longan', 'PRD-3BPBW5WC', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:28:54', '2026-02-28 09:28:54', NULL),
(210, 2, '{\"en\":\"24 Durian\",\"km\":\"24 Durian\",\"zh\":\"24 Durian\"}', '24-durian', 'PRD-XVMTTUIW', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:29:31', '2026-02-28 09:29:31', NULL),
(211, 2, '{\"en\":\"25 Jackfruit\",\"km\":\"25 Jackfruit\",\"zh\":\"25 Jackfruit\"}', '25-jackfruit', 'PRD-DOYIRF2J', NULL, 4.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:30:00', '2026-02-28 09:30:00', NULL),
(212, 2, '{\"en\":\"26 Coconut\",\"km\":\"26 Coconut\",\"zh\":\"26 Coconut\"}', '26-coconut', 'PRD-SFLKDGWZ', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'piece', 5, '2026-02-28 09:30:24', '2026-02-28 09:30:24', NULL),
(213, 2, '{\"en\":\"27 Pomegranate\",\"km\":\"27 Pomegranate\",\"zh\":\"27 Pomegranate\"}', '27-pomegranate', 'PRD-HXBY8NVR', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:30:50', '2026-02-28 09:30:50', NULL),
(214, 2, '{\"en\":\"28 Fig\",\"km\":\"28 Fig\",\"zh\":\"28 Fig\"}', '28-fig', 'PRD-BN2AVUSN', NULL, 2.00, 0.00, NULL, '2026-02-28 19:33:00', NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:32:07', '2026-02-28 09:32:07', NULL),
(215, 2, '{\"en\":\"29 Date\",\"km\":\"29 Date\",\"zh\":\"29 Date\"}', '29-date', 'PRD-KSKH0ZSA', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:32:32', '2026-02-28 09:32:32', NULL),
(216, 2, '{\"en\":\"30 Avocado\",\"km\":\"30 Avocado\",\"zh\":\"30 Avocado\"}', '30-avocado', 'PRD-3DOJVHIH', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:32:57', '2026-02-28 09:32:57', NULL),
(217, 2, '{\"en\":\"31 Lemon\",\"km\":\"31 Lemon\",\"zh\":\"31 Lemon\"}', '31-lemon', 'PRD-XC7G6NID', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:33:36', '2026-02-28 09:33:36', NULL),
(218, 2, '{\"en\":\"32 Lime\",\"km\":\"32 Lime\",\"zh\":\"32 Lime\"}', '32-lime', 'PRD-HYYXUJ5M', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:33:59', '2026-02-28 09:33:59', NULL),
(219, 2, '{\"en\":\"33 Grapefruit\",\"km\":\"33 Grapefruit\",\"zh\":\"33 Grapefruit\"}', '33-grapefruit', 'PRD-HNRXTOHU', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:34:31', '2026-02-28 09:34:31', NULL),
(220, 2, '{\"en\":\"34 Tangerine\",\"km\":\"34 Tangerine\",\"zh\":\"34 Tangerine\"}', '34-tangerine', 'PRD-BUWZHCDY', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:35:11', '2026-02-28 09:35:11', NULL),
(221, 2, '{\"en\":\"35 Mandarin\",\"km\":\"35 Mandarin\",\"zh\":\"35 Mandarin\"}', '35-mandarin', 'PRD-LORIYMEZ', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:35:35', '2026-02-28 09:35:35', NULL),
(222, 2, '{\"en\":\"36 Cantaloupe\",\"km\":\"36 Cantaloupe\",\"zh\":\"36 Cantaloupe\"}', '36-cantaloupe', 'PRD-8LIYDUVE', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:36:01', '2026-02-28 09:36:01', NULL),
(223, 2, '{\"en\":\"37 Honeydew\",\"km\":\"37 Honeydew\",\"zh\":\"37 Honeydew\"}', '37-honeydew', 'PRD-IIUCALJF', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:36:36', '2026-02-28 09:36:36', NULL),
(224, 2, '{\"en\":\"38 Cranberry\",\"km\":\"38 Cranberry\",\"zh\":\"38 Cranberry\"}', '38-cranberry', 'PRD-VYJIO1FW', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:36:59', '2026-02-28 09:36:59', NULL),
(225, 2, '{\"en\":\"39 Mulberry\",\"km\":\"39 Mulberry\",\"zh\":\"39 Mulberry\"}', '39-mulberry', 'PRD-JGIFNLRZ', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:37:20', '2026-02-28 09:37:20', NULL),
(226, 2, '{\"en\":\"40 Starfruit\",\"km\":\"40 Starfruit\",\"zh\":\"40 Starfruit\"}', '40-starfruit', 'PRD-H9IVWDNZ', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:37:40', '2026-02-28 09:37:40', NULL),
(227, 2, '{\"en\":\"41 Sapodilla\",\"km\":\"41 Sapodilla\",\"zh\":\"41 Sapodilla\"}', '41-sapodilla', 'PRD-ZLT0NRP2', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:38:04', '2026-02-28 09:38:04', NULL),
(228, 2, '{\"en\":\"42 Rambutan\",\"km\":\"42 Rambutan\",\"zh\":\"42 Rambutan\"}', '42-rambutan', 'PRD-02EXKUN1', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:39:08', '2026-02-28 09:39:08', NULL),
(229, 2, '{\"en\":\"43 Soursop\",\"km\":\"43 Soursop\",\"zh\":\"43 Soursop\"}', '43-soursop', 'PRD-NHMOQNI1', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:39:29', '2026-02-28 09:39:29', NULL),
(230, 2, '{\"en\":\"44 Custard apple\",\"km\":\"44 Custard apple\",\"zh\":\"44 Custard apple\"}', '44-custard-apple', 'PRD-GVXMYAEJ', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:40:14', '2026-02-28 09:40:14', NULL),
(231, 2, '{\"en\":\"45 Pomelo\",\"km\":\"45 Pomelo\",\"zh\":\"45 Pomelo\"}', '45-pomelo', 'PRD-V3SBHGV9', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:40:46', '2026-02-28 09:40:46', NULL),
(232, 2, '{\"en\":\"47 Nectarine\",\"km\":\"47 Nectarine\",\"zh\":\"47 Nectarine\"}', '47-nectarine', 'PRD-PPMW8NP9', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:41:13', '2026-02-28 09:41:13', NULL),
(233, 2, '{\"en\":\"48 Olive\",\"km\":\"48 Olive\",\"zh\":\"48 Olive\"}', '48-olive', 'PRD-TIRHFOEM', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:41:40', '2026-02-28 09:41:40', NULL),
(234, 2, '{\"en\":\"49 Quince\",\"km\":\"49 Quince\",\"zh\":\"49 Quince\"}', '49-quince', 'PRD-0WJL8KJX', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:42:00', '2026-02-28 09:42:00', NULL),
(235, 2, '{\"en\":\"50 Gooseberry\",\"km\":\"50 Gooseberry\",\"zh\":\"50 Gooseberry\"}', '50-gooseberry', 'PRD-ZYD7WUNP', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:42:21', '2026-02-28 09:42:21', NULL),
(236, 2, '{\"en\":\"51 Tamarind\",\"km\":\"51 Tamarind\",\"zh\":\"51 Tamarind\"}', '51-tamarind', 'PRD-IA5PMJ9Y', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:42:40', '2026-02-28 09:42:40', NULL),
(237, 2, '{\"en\":\"52 Mangosteen\",\"km\":\"52 Mangosteen\",\"zh\":\"52 Mangosteen\"}', '52-mangosteen', 'PRD-WVTW0JEV', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:43:05', '2026-02-28 09:43:05', NULL),
(238, 2, '{\"en\":\"53 Rose Apple\",\"km\":\"53 Rose Apple\",\"zh\":\"53 Rose Apple\"}', '53-rose-apple', 'PRD-XCGBAXYF', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:43:24', '2026-02-28 09:43:24', NULL),
(239, 2, '{\"en\":\"54 Otaheite gooseberry\",\"km\":\"\\u1795\\u17d2\\u179b\\u17c2\\u1780\\u1793\\u17d2\\u1791\\u17bd\\u178f\",\"zh\":\"\\u5927\\u6eaa\\u5730\\u918b\\u6817\"}', '54-otaheite-gooseberry', 'PRD-M3DSPIGX', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:44:13', '2026-02-28 09:44:13', NULL),
(240, 2, '{\"en\":\"55 Passion Fruit\",\"km\":\"55 Passion Fruit\",\"zh\":\"55 Passion Fruit\"}', '55-passion-fruit', 'PRD-OQU5LKOW', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 199, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:44:39', '2026-02-28 09:44:39', NULL),
(241, 2, '{\"en\":\"56 Langsat\",\"km\":\"56 Langsat\",\"zh\":\"56 Langsat\"}', '56-langsat', 'PRD-K8W06IQK', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 1000, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:45:06', '2026-02-28 09:45:06', NULL),
(242, 2, '{\"en\":\"57 Milk Fruit\",\"km\":\"57 Milk Fruit\",\"zh\":\"57 Milk Fruit\"}', '57-milk-fruit', 'PRD-QDJZHLVC', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:45:27', '2026-02-28 09:45:27', NULL),
(243, 2, '{\"en\":\"58 Plum mango\",\"km\":\"58 Plum mango\",\"zh\":\"58 Plum mango\"}', '58-plum-mango', 'PRD-VVODX0YR', NULL, 3.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:45:54', '2026-02-28 09:45:54', NULL),
(244, 2, '{\"en\":\"59 Black Sapote\",\"km\":\"59 Black Sapote\",\"zh\":\"59 Black Sapote\"}', '59-black-sapote', 'PRD-ODRBU6UZ', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:46:19', '2026-02-28 09:46:19', NULL),
(245, 2, '{\"en\":\"60 Lychee\",\"km\":\"60 Lychee\",\"zh\":\"60 Lychee\"}', '60-lychee', 'PRD-NTPZBETC', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:46:52', '2026-02-28 09:46:52', NULL),
(246, 1, '{\"en\":\"Cucumber\",\"km\":\"\\u178f\\u17d2\\u179a\\u179f\\u1780\\u17cb\",\"zh\":\"\\u9ec4\\u74dc\"}', 'cucumber', 'PRD-U1L0F1FY', NULL, 1.20, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:48:12', '2026-02-28 09:48:12', NULL),
(247, 1, '{\"en\":\"Cabbage\",\"km\":\"\\u179f\\u17d2\\u1796\\u17c3\\u1780\\u17d2\\u178a\\u17c4\\u1794\",\"zh\":\"\\u5377\\u5fc3\\u83dc\"}', 'cabbage', 'PRD-UZQDX90X', NULL, 1.30, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:48:56', '2026-02-28 09:48:56', NULL),
(248, 1, '{\"en\":\"Carrot\",\"km\":\"\\u1780\\u17b6\\u179a\\u17c9\\u17bb\\u178f\",\"zh\":\"\\u80e1\\u841d\\u535c\"}', 'carrot', 'PRD-HSTICCRK', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:49:36', '2026-02-28 09:49:36', NULL),
(249, 1, '{\"en\":\"Tomato\",\"km\":\"\\u1794\\u17c9\\u17c1\\u1784\\u1794\\u17c9\\u17c4\\u17c7\",\"zh\":\"\\u756a\\u8304\"}', 'tomato', 'PRD-TAZYHA97', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:50:19', '2026-02-28 09:50:19', NULL),
(250, 1, '{\"en\":\"Eggplant\",\"km\":\"\\u178f\\u17d2\\u179a\\u1794\\u17cb\\u179c\\u17c2\\u1784\",\"zh\":\"\\u8304\\u5b50\"}', 'eggplant', 'PRD-MXTJOKTS', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 09:51:37', '2026-02-28 09:51:37', NULL),
(251, 1, '{\"en\":\"Water spinach\",\"km\":\"\\u178f\\u17d2\\u179a\\u1780\\u17bd\\u1793\\u1791\\u17b9\\u1780\",\"zh\":\"\\u7a7a\\u5fc3\\u83dc\"}', 'water-spinach', 'PRD-VZXGBFL6', NULL, 0.50, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:07:39', '2026-02-28 10:07:39', NULL),
(252, 1, '{\"en\":\"Pumpkin\",\"km\":\"\\u179b\\u17d2\\u1796\\u17c5\",\"zh\":\"\\u5357\\u74dc\"}', 'pumpkin', 'PRD-XNPEMCYZ', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:08:15', '2026-02-28 10:08:15', NULL),
(253, 1, '{\"en\":\"Bitter melon\",\"km\":\"\\u1798\\u17d2\\u179a\\u17c7\",\"zh\":\"\\u82e6\\u74dc\"}', 'bitter-melon', 'PRD-YOFCVECT', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:08:55', '2026-02-28 10:08:55', NULL),
(254, 1, '{\"en\":\"Yardlong bean\",\"km\":\"\\u179f\\u178e\\u17d2\\u178a\\u17c2\\u1780\\u1780\\u17bd\\u179a\",\"zh\":\"\\u957f\\u8c46\"}', 'yardlong-bean', 'PRD-SVH5VC4R', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:09:39', '2026-02-28 10:09:39', NULL),
(255, 1, '{\"en\":\"Broccoli\",\"km\":\"\\u1795\\u17d2\\u1780\\u17b6\\u1781\\u17b6\\u178f\\u17cb\\u178e\\u17b6\\u1794\\u17c3\\u178f\\u1784\",\"zh\":\"\\u897f\\u5170\\u82b1\"}', 'broccoli', 'PRD-MB3TPFDX', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:10:37', '2026-02-28 10:10:37', NULL),
(256, 1, '{\"en\":\"Cauliflower\",\"km\":\"\\u1795\\u17d2\\u1780\\u17b6\\u1781\\u17b6\\u178f\\u17cb\\u178e\\u17b6\",\"zh\":\"\\u83dc\\u82b1\"}', 'cauliflower', 'PRD-LNBPON8Q', NULL, 1.60, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:11:18', '2026-02-28 10:11:18', NULL),
(257, 1, '{\"en\":\"Chinese kale\",\"km\":\"\\u179f\\u17d2\\u1796\\u17c3\\u1785\\u17b7\\u1793\",\"zh\":\"\\u82a5\\u84dd\"}', 'chinese-kale', 'PRD-TXQOO9JY', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:11:55', '2026-02-28 10:11:55', NULL),
(258, 1, '{\"en\":\"Chili\",\"km\":\"\\u1798\\u17d2\\u1791\\u17c1\\u179f\",\"zh\":\"\\u8fa3\\u6912\"}', 'chili', 'PRD-OFI1FQP0', NULL, 0.30, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:12:43', '2026-02-28 10:12:43', NULL),
(259, 1, '{\"en\":\"Red Onion\",\"km\":\"\\u1781\\u17d2\\u1791\\u17b9\\u1798\\u1794\\u17b6\\u179a\\u17b6\\u17c6\\u1784\\u1780\\u17d2\\u179a\\u17a0\\u1798\",\"zh\":\"\\u7ea2\\u6d0b\\u8471\"}', 'red-onion', 'PRD-SDB4GKDZ', NULL, 1.10, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:13:26', '2026-02-28 10:13:26', NULL),
(260, 1, '{\"en\":\"Garlic\",\"km\":\"\\u1781\\u17d2\\u1791\\u17b9\\u1798\\u179f\",\"zh\":\"\\u849c\"}', 'garlic', 'PRD-MAOR91RX', NULL, 0.50, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:14:04', '2026-02-28 10:14:04', NULL),
(261, 1, '{\"en\":\"Lemongrass\",\"km\":\"\\u179f\\u17d2\\u179b\\u17b9\\u1780\\u1782\\u17d2\\u179a\\u17c3\",\"zh\":\"\\u9999\\u8305\"}', 'lemongrass', 'PRD-BEUJNKD8', NULL, 0.60, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:14:48', '2026-02-28 10:14:48', NULL),
(262, 1, '{\"en\":\"Basil\",\"km\":\"\\u1787\\u17b8\\u17a2\\u1784\\u17d2\\u1780\\u17b6\\u1798\",\"zh\":\"\\u7f57\\u52d2\"}', 'basil', 'PRD-SZGVSEKP', NULL, 0.50, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:15:29', '2026-02-28 10:15:29', NULL),
(263, 1, '{\"en\":\"Kaffir lime leaf\",\"km\":\"\\u179f\\u17d2\\u179b\\u17b9\\u1780\\u1780\\u17d2\\u179a\\u17bc\\u1785\\u1786\\u17d2\\u1798\\u17b6\\u179a Kaffir\",\"zh\":\"\\u5361\\u83f2\\u5c14\\u9178\\u6a59\\u53f6\"}', 'kaffir-lime-leaf', 'PRD-OWVGHIR0', NULL, 0.30, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:16:15', '2026-02-28 10:16:15', NULL);
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `images`, `price`, `discount_percent`, `discount_price`, `discount_start`, `discount_end`, `is_on_sale`, `sale_label`, `stock`, `image`, `description`, `is_active`, `unit`, `min_stock_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(264, 1, '{\"en\":\"Green bean\",\"km\":\"\\u179f\\u178e\\u17d2\\u178f\\u17c2\\u1780\\u1794\\u17c3\\u178f\\u1784\",\"zh\":\"\\u56db\\u5b63\\u8c46\"}', 'green-bean', 'PRD-P67T9IN8', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:17:03', '2026-02-28 10:17:03', NULL),
(265, 1, '{\"en\":\"Water mimosa\",\"km\":\"\\u1780\\u1789\\u17d2\\u1786\\u17c2\\u1780\",\"zh\":\"\\u6c34\\u542b\\u7f9e\\u8349\"}', 'water-mimosa', 'PRD-YZAMRON7', NULL, 0.70, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:18:05', '2026-02-28 10:18:05', NULL),
(266, 1, '{\"en\":\"Potato\",\"km\":\"\\u178a\\u17c6\\u17a1\\u17bc\\u1784\\u1794\\u17b6\\u179a\\u17b6\\u17c6\\u1784\",\"zh\":\"\\u571f\\u8c46\"}', 'potato', 'PRD-D4Y3OSDA', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:18:46', '2026-02-28 10:18:46', NULL),
(267, 1, '{\"en\":\"Sweet potato\",\"km\":\"\\u178a\\u17c6\\u17a1\\u17bc\\u1784\\u1787\\u17d2\\u179c\\u17b6\",\"zh\":\"\\u7518\\u85af\"}', 'sweet-potato', 'PRD-PRO7HPUS', NULL, 1.20, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:19:29', '2026-02-28 10:19:29', NULL),
(268, 1, '{\"en\":\"Cassava\",\"km\":\"\\u178a\\u17c6\\u17a1\\u17bc\\u1784\\u1798\\u17b8\",\"zh\":\"\\u6728\\u85af\"}', 'cassava', 'PRD-DUPAQGSC', NULL, 0.90, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:20:17', '2026-02-28 10:20:17', NULL),
(269, 1, '{\"en\":\"Corn\",\"km\":\"\\u1796\\u17c4\\u178f\",\"zh\":\"\\u7389\\u7c73\"}', 'corn', 'PRD-KSZQRW1T', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:21:00', '2026-02-28 10:21:00', NULL),
(270, 1, '{\"en\":\"Bottle gourd\",\"km\":\"\\u1793\\u1793\\u17c4\\u1784\\u1798\\u17bc\\u179b\",\"zh\":\"\\u846b\\u82a6\"}', 'bottle-gourd', 'PRD-5709ZZKZ', NULL, 0.55, 0.00, NULL, NULL, NULL, 0, NULL, 7, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:21:59', '2026-02-28 11:48:39', NULL),
(271, 1, '{\"en\":\"Luffa\",\"km\":\"\\u1793\\u1793\\u17c4\\u1784\\u1787\\u17d2\\u179a\\u17bb\\u1784\",\"zh\":\"\\u4e1d\\u74dc\\u7edc\"}', 'luffa', 'PRD-RAEVKG5G', NULL, 0.60, 0.00, NULL, NULL, NULL, 0, NULL, 199, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:22:48', '2026-02-28 10:22:48', NULL),
(272, 1, '{\"en\":\"Kale\",\"km\":\"\\u179f\\u17d2\\u1796\\u17c3\\u1781\\u17d2\\u1798\\u17c5\",\"zh\":\"\\u7fbd\\u8863\\u7518\\u84dd\"}', 'kale', 'PRD-PTGMVF9K', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:23:38', '2026-02-28 10:23:38', NULL),
(273, 1, '{\"en\":\"Mustard greens\",\"km\":\"\\u179f\\u17d2\\u1796\\u17c3\\u1794\\u17c3\\u178f\\u1784\",\"zh\":\"\\u82a5\\u83dc\"}', 'mustard-greens', 'PRD-0DDOIEJY', NULL, 1.10, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:24:17', '2026-02-28 10:24:17', NULL),
(274, 1, '{\"en\":\"Khmer eggplant\",\"km\":\"\\u178f\\u17d2\\u179a\\u1794\\u17cb\\u1798\\u17bc\\u179b\",\"zh\":\"\\u8304\\u5b50\"}', 'khmer-eggplant', 'PRD-0SSJNASX', NULL, 0.40, 0.00, NULL, NULL, NULL, 0, NULL, 100, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:25:24', '2026-02-28 10:25:24', NULL),
(275, 1, '{\"en\":\"Mung bean (sprout)\",\"km\":\"\\u179f\\u178e\\u17d2\\u178a\\u17c2\\u1780\\u1794\\u178e\\u17d2\\u178a\\u17bb\\u17c7\",\"zh\":\"\\u7eff\\u8c46\\uff08\\u82bd\\uff09\"}', 'mung-bean-sprout', 'PRD-K3ERJQUS', NULL, 0.50, 10.00, 0.45, NULL, NULL, 1, '10% OFF', 99, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:26:19', '2026-02-28 12:39:49', NULL),
(276, 1, '{\"en\":\"Soybean\",\"km\":\"\\u179f\\u178e\\u17d2\\u178a\\u17c2\\u1780\\u179f\\u17c0\\u1784\",\"zh\":\"\\u5927\\u8c46\"}', 'soybean', 'PRD-GDUFSBXV', NULL, 2.00, 0.00, NULL, NULL, NULL, 0, NULL, 4, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:27:04', '2026-02-28 12:39:49', NULL),
(277, 1, '{\"en\":\"Pea\",\"km\":\"\\u179f\\u178e\\u17d2\\u178f\\u17c2\\u1780\\u1794\\u17b6\\u179a\\u17b6\\u17c6\\u1784\",\"zh\":\"\\u8c4c\\u8c46\"}', 'pea', 'PRD-TLCYEPNH', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:27:45', '2026-02-28 11:48:11', NULL),
(278, 1, '{\"en\":\"Galangal\",\"km\":\"\\u1781\\u17d2\\u1789\\u17b8\",\"zh\":\"\\u9ad8\\u826f\\u59dc\"}', 'galangal', 'PRD-JLA6GLQE', NULL, 1.00, 0.00, NULL, NULL, NULL, 0, NULL, 699, NULL, NULL, 1, 'kg', 5, '2026-02-28 10:29:21', '2026-02-28 13:29:00', NULL);

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
(39, 69, 'products/WXwwwu8olrScQ1CaHNrRfbqdkgrrUdLxGwxzWcKg.jpg', 0, '2026-02-21 15:17:05', '2026-02-21 15:17:05'),
(70, 75, 'products/ARnLUrWqtFGXZvbR9ZBOGWdyM1swRDZZPbtsdIfK.jpg', 0, '2026-02-28 07:42:27', '2026-02-28 07:42:27'),
(71, 76, 'products/dfdR5DQJ3xsDw8sxLEywmEKAJ9YbJWuEYhuXjNFH.jpg', 0, '2026-02-28 07:42:27', '2026-02-28 07:42:27'),
(72, 77, 'products/F4jA4kp1qgggGwBm5QIsz4lY1KaL44E7fSCgPmpE.jpg', 0, '2026-02-28 07:45:21', '2026-02-28 07:45:21'),
(73, 78, 'products/wmumjdFYIgpzg3vzqsC9NqHcOJkz8Rp4NjhHBhIp.jpg', 0, '2026-02-28 07:50:38', '2026-02-28 07:50:38'),
(74, 79, 'products/ghNMNttIWexrXZmIXl6tQCSB4y4Mmg13pj1ebDvh.jpg', 0, '2026-02-28 07:52:32', '2026-02-28 07:52:32'),
(75, 80, 'products/Cwvo6qetqJk0sFwhW3Tknq1diCxINisbiKRVUILJ.jpg', 0, '2026-02-28 07:53:17', '2026-02-28 07:53:17'),
(76, 81, 'products/zFMsQ6KT1C9Mhbr1ZBgR5AMpr9mwv42lRBqkLIxF.jpg', 0, '2026-02-28 07:54:39', '2026-02-28 07:54:39'),
(77, 82, 'products/7mdDlSTXyaPonw2CV2z5qgccD6N0ZSJMP9bTpLuP.jpg', 0, '2026-02-28 07:55:35', '2026-02-28 07:55:35'),
(78, 83, 'products/0XFCSA9LY9Ecu8p7exHplFcirprGeDEkhc5GDxh7.jpg', 0, '2026-02-28 07:56:25', '2026-02-28 07:56:25'),
(79, 84, 'products/4IfSXXfYub6l42nhKCweuCzZYBTpgGAmGQBWKzmS.jpg', 0, '2026-02-28 07:57:37', '2026-02-28 07:57:37'),
(80, 85, 'products/oRfNA0bTQL1TqfjcyBfneb1wPukrd3N7HAzwF5kR.jpg', 0, '2026-02-28 07:58:27', '2026-02-28 07:58:27'),
(81, 86, 'products/1MQjqQNgOlybTKqsqiZl3RduruKqig25SaADIfsZ.jpg', 0, '2026-02-28 07:59:15', '2026-02-28 07:59:15'),
(82, 87, 'products/pPMBHwBoqennhLe1WzxqnvnuflNVtXIOsl42l8GC.jpg', 0, '2026-02-28 08:00:18', '2026-02-28 08:00:18'),
(83, 88, 'products/ZiC48d6rWeA0u5HmyJZT4U9VDahNTVKoDcr88iZH.jpg', 0, '2026-02-28 08:01:25', '2026-02-28 08:01:25'),
(84, 89, 'products/GWXXdWZZk8cZSfinsRkqmXKgv78lQaKvM03wlDX2.jpg', 0, '2026-02-28 08:02:05', '2026-02-28 08:02:05'),
(85, 90, 'products/hEJh70VKh5ifpPMfKniW3ZAb8Mxpx7DwLRZ0YxlO.jpg', 0, '2026-02-28 08:02:46', '2026-02-28 08:02:46'),
(86, 91, 'products/KUVlBU7PuyBycYLAD2O5wyTUamYxMyXQqHAaiNzC.jpg', 0, '2026-02-28 08:03:34', '2026-02-28 08:03:34'),
(87, 92, 'products/x2wAdBkUWscEBmgkjHRPb59KV9KiWIMsW5mKtHpB.jpg', 0, '2026-02-28 08:04:29', '2026-02-28 08:04:29'),
(88, 93, 'products/YsCefo5W1XrKdwGw7cC2JPh9vu4GzUJ9aR7EkIbM.jpg', 0, '2026-02-28 08:05:23', '2026-02-28 08:05:23'),
(89, 94, 'products/6XONdVQCZvvfoguGdDxQBdRhquOk3fqXfAe3wH65.jpg', 0, '2026-02-28 08:06:13', '2026-02-28 08:06:13'),
(90, 95, 'products/dfbaMq14xxy5VBkUJGNBpitn9Nios51OGYLX26q5.jpg', 0, '2026-02-28 08:12:22', '2026-02-28 08:12:22'),
(91, 96, 'products/smYvrW1ppqXHhoWRXdO01WRJDfzzZR58vCoEn5J9.jpg', 0, '2026-02-28 08:14:13', '2026-02-28 08:14:13'),
(92, 97, 'products/JZtqVve8sQMqWjCp8CyaxniF3LPGnmvv2iI062EE.jpg', 0, '2026-02-28 08:15:27', '2026-02-28 08:15:27'),
(93, 98, 'products/Nlvo5MgFXlqQxRTAyMXowuZzqUUBENnRREcU0zbb.jpg', 0, '2026-02-28 08:16:36', '2026-02-28 08:16:36'),
(94, 99, 'products/Y95rpI0yeGEqXMyiEXAijrYN8Upi6MpzscJ50FAm.jpg', 0, '2026-02-28 08:17:26', '2026-02-28 08:17:26'),
(95, 100, 'products/Mv3b4lfTUV7a7brBIJCxwRMzoEMV1fFZD0n3ZCzt.jpg', 0, '2026-02-28 08:18:20', '2026-02-28 08:18:20'),
(96, 101, 'products/gH3MLnJN09BcErOHq5rlE5ySNCnBZ7kXEExk68HZ.jpg', 0, '2026-02-28 08:20:14', '2026-02-28 08:20:14'),
(97, 102, 'products/Wp3LWhMjiQDCYrm0NW0cBmlQcVQNhRNgLstUxMNV.jpg', 0, '2026-02-28 08:21:18', '2026-02-28 08:21:18'),
(98, 103, 'products/loyavyFD0CBwkCUckaoQ0SwX9H3hy3iSNPI1Y5be.jpg', 0, '2026-02-28 08:22:07', '2026-02-28 08:22:07'),
(99, 104, 'products/ICZtAcHzOyaotSLYdgjKxzWqmlb597TRlDXZljpP.jpg', 0, '2026-02-28 08:22:59', '2026-02-28 08:22:59'),
(100, 105, 'products/7itEPb9ejUuuywz2GZbEz7UMGI20rSfCWxTtuzEw.jpg', 0, '2026-02-28 08:23:46', '2026-02-28 08:23:46'),
(101, 106, 'products/GEwAlqFixotXISAV5hwTB4J9PlVqJpS6OJfa9nHb.jpg', 0, '2026-02-28 08:24:34', '2026-02-28 08:24:34'),
(102, 107, 'products/mI5daGtcsYB1bxICK6sze9fjrVWVgpBak3TDBggr.jpg', 0, '2026-02-28 08:25:23', '2026-02-28 08:25:23'),
(103, 108, 'products/azpqiTk6egVxlxLVxC2IyVaQtH0wKi4QENyMExOC.jpg', 0, '2026-02-28 08:26:19', '2026-02-28 08:26:19'),
(104, 109, 'products/ySs004FA6HdX6uRCBn3cNBuenLNsOHfrtU5NJXs1.jpg', 0, '2026-02-28 08:27:02', '2026-02-28 08:27:02'),
(105, 110, 'products/wlb6lASEtWWPQBSawkbAn2ENyKweNJ2q8oPepCJY.jpg', 0, '2026-02-28 08:27:35', '2026-02-28 08:27:35'),
(106, 111, 'products/dByDI6kMglVUbgJdyy2zmkDAGwA8wPCUaFKA86Hh.jpg', 0, '2026-02-28 08:28:02', '2026-02-28 08:28:02'),
(107, 112, 'products/gODVprizTwX69iXHsmbqDiL4A4ywZYGMGvH9wI6S.jpg', 0, '2026-02-28 08:28:41', '2026-02-28 08:28:41'),
(108, 113, 'products/h2nF904WfYH7yXmXfMXFHWbO0UrfNmuif6tJj2h5.jpg', 0, '2026-02-28 08:29:08', '2026-02-28 08:29:08'),
(109, 114, 'products/LjI7fZyVj1TDAEPsdTSSuBEKDR8UeTJw9dCCP3QZ.jpg', 0, '2026-02-28 08:30:22', '2026-02-28 08:30:22'),
(110, 115, 'products/NEHyPrXcSXg58JY1tfvupVb3LsjBkURbfPTwBGUZ.jpg', 0, '2026-02-28 08:30:52', '2026-02-28 08:30:52'),
(111, 116, 'products/hGS5I4WXZdKFFeyqljMehHX5hsXResC5bFV5Z30J.jpg', 0, '2026-02-28 08:32:31', '2026-02-28 08:32:31'),
(112, 117, 'products/MZqGaxn7wIUbHQ9d0FMv7ijJBbzLJHh34hu0S79t.jpg', 0, '2026-02-28 08:33:31', '2026-02-28 08:33:31'),
(113, 118, 'products/sfyFjWQSqh34MS7fh2xMTSWe6X9EojuuCKwewnzq.jpg', 0, '2026-02-28 08:34:01', '2026-02-28 08:34:01'),
(114, 119, 'products/fO0GQgif2sYlNMYqoymFZRZyr4zJNqLFgCEl8ymm.jpg', 0, '2026-02-28 08:34:27', '2026-02-28 08:34:27'),
(115, 120, 'products/vI5Dbnu6MrnJavrGucj9LNwwaIlporBMxCFK8yWY.jpg', 0, '2026-02-28 08:34:49', '2026-02-28 08:34:49'),
(116, 121, 'products/8KXip7yQ9Wcn2rywPVri5oRPhkl0VpR9SP8jlThT.jpg', 0, '2026-02-28 08:35:17', '2026-02-28 08:35:17'),
(117, 122, 'products/4aibRdJg1GCFNm3PZwPQv5QU2ZbKatayYhgCfnVw.jpg', 0, '2026-02-28 08:35:44', '2026-02-28 08:35:44'),
(118, 123, 'products/TxQgBhve2FjGyseirhdq7GDBdJ5zZfe3OiFmUe2B.jpg', 0, '2026-02-28 08:36:12', '2026-02-28 08:36:12'),
(119, 124, 'products/KXxSLQ8uldvqmyFNogiSBmXirUfkGk1Mlo6my04H.jpg', 0, '2026-02-28 08:36:45', '2026-02-28 08:36:45'),
(120, 125, 'products/EpHVuDBAz0FYcTBZD0c0L5DpexZ0S6ZIxS3bkalS.jpg', 0, '2026-02-28 08:37:09', '2026-02-28 08:37:09'),
(121, 126, 'products/vL50ZMe1PtCtTKZYCvFXQh3anEMLPd2Pw6ayImnY.jpg', 0, '2026-02-28 08:37:39', '2026-02-28 08:37:39'),
(122, 127, 'products/JOjqt9zRJkkERVXEXpRJFoaiSUoajvKQ3ky6k8Re.jpg', 0, '2026-02-28 08:38:01', '2026-02-28 08:38:01'),
(123, 128, 'products/Sdv3qZnYxSZDrxJEL4ub2av3rrLPJgXy4ZiYlSBm.jpg', 0, '2026-02-28 08:38:25', '2026-02-28 08:38:25'),
(124, 129, 'products/etQccuoOVV1Anj50vWO8UxumB09Rh2HbaKVghbYw.jpg', 0, '2026-02-28 08:39:30', '2026-02-28 08:39:30'),
(125, 130, 'products/VxhwwFsnyqQlDSg7fv0VUP7rWFgFmFW0F4ucmTTf.jpg', 0, '2026-02-28 08:40:40', '2026-02-28 08:40:40'),
(126, 131, 'products/3NxLB5HG8ABFTdW29PcIFelQ5Ud1XITYm5oa63D3.jpg', 0, '2026-02-28 08:41:07', '2026-02-28 08:41:07'),
(127, 132, 'products/kzrwGHcSnTyY8xaH2lZ4BKLlKZ6OUVop5K8iWDbM.jpg', 0, '2026-02-28 08:41:33', '2026-02-28 08:41:33'),
(128, 133, 'products/czwRc8rzEll73XaPRtCox1OK2DtMKQLNDXYk8Bl3.jpg', 0, '2026-02-28 08:42:02', '2026-02-28 08:42:02'),
(129, 134, 'products/20qSrefBFj5jgN8oIFWbS43xDeigp0hdD5Hbimhg.jpg', 0, '2026-02-28 08:42:36', '2026-02-28 08:42:36'),
(130, 135, 'products/QVqVRK34Sl3EyX75SYpFiVvjeeNdHEeC6fNoAR1s.jpg', 0, '2026-02-28 08:44:31', '2026-02-28 08:44:31'),
(131, 136, 'products/1jIJcoUs6uFcoZXH7l7xRtP6bgMhc8Dp4rNgBaPj.jpg', 0, '2026-02-28 08:45:46', '2026-02-28 08:45:46'),
(132, 137, 'products/OpohA1PVwu1RXwh4IYo2w0OFDt8HZInnsla4dhR4.jpg', 0, '2026-02-28 08:46:27', '2026-02-28 08:46:27'),
(133, 138, 'products/7xDiMXMo4PP7rik6lHMh9P2RZivTQXe5iSqCqr7C.jpg', 0, '2026-02-28 08:46:55', '2026-02-28 08:46:55'),
(134, 139, 'products/31r1IJPvb159RARoXVySg04VfdCF7WiwpvY6JBHG.jpg', 0, '2026-02-28 08:47:30', '2026-02-28 08:47:30'),
(135, 140, 'products/kNklOsMXTOqRdu2ttDkyEkNXi3oqbx4SbaokAiUw.jpg', 0, '2026-02-28 08:47:55', '2026-02-28 08:47:55'),
(136, 141, 'products/bqnKUvyR8Tzx6aVLUcU4LAzGW7MoGSa2sj3p36qK.jpg', 0, '2026-02-28 08:48:31', '2026-02-28 08:48:31'),
(137, 142, 'products/EVl45OX7tEwcxvc2EPNkxfEQdMuMfZZBXVNb6seV.jpg', 0, '2026-02-28 08:48:58', '2026-02-28 08:48:58'),
(138, 143, 'products/2y799EqwedhwOGJg2VEf5QPLo3Z8srsv8Ta3cIdC.jpg', 0, '2026-02-28 08:50:43', '2026-02-28 08:50:43'),
(139, 144, 'products/oGEtUz70UuhApTfPrHTFzr6ZXTnpqd6KyApA4FuH.jpg', 0, '2026-02-28 08:51:24', '2026-02-28 08:51:24'),
(140, 145, 'products/a5jkO2HKhkCVwIR6ZlEVPg6pieP5DpvyQkK3HAOE.jpg', 0, '2026-02-28 08:51:50', '2026-02-28 08:51:50'),
(141, 146, 'products/KJjpkU45CFnFKjOxDONHY6TMrm5jRuTtstGZzdcn.jpg', 0, '2026-02-28 08:52:19', '2026-02-28 08:52:19'),
(142, 147, 'products/PRVWI08Qz14phIZSXigPshcqe5EBvIEZSjfDSe1L.jpg', 0, '2026-02-28 08:52:44', '2026-02-28 08:52:44'),
(143, 148, 'products/ivBNS29mY0CY07q6M9Z0EyVWMMHGmlRX7tr4M9Xk.jpg', 0, '2026-02-28 08:53:13', '2026-02-28 08:53:13'),
(144, 149, 'products/rzLmPmheTBGxY6Fc9IPVdZg1kfmQpiTt2dfq4xt8.jpg', 0, '2026-02-28 08:53:45', '2026-02-28 08:53:45'),
(145, 150, 'products/KH2XGYaFDs3mD7P2JT9hyAROWmgyGHAQdFnwe02q.jpg', 0, '2026-02-28 08:54:12', '2026-02-28 08:54:12'),
(146, 151, 'products/g4KrgrS9lluuyneORuCqJwWVFfVPN3HmXDqKWdrg.jpg', 0, '2026-02-28 08:55:03', '2026-02-28 08:55:03'),
(147, 152, 'products/a2fuO6dkjTewkMnRR25ZC6ehZifJGxs9LlaKHB1R.jpg', 0, '2026-02-28 08:55:38', '2026-02-28 08:55:38'),
(148, 153, 'products/LPbZ6y2Wninjmfdfff69lARVxGHCTFSWLuUPyYjG.jpg', 0, '2026-02-28 08:56:26', '2026-02-28 08:56:26'),
(149, 154, 'products/yoLcWkewTxoAvrqcDN8wx3XwXbvrtf20uS8qauXn.jpg', 0, '2026-02-28 08:56:50', '2026-02-28 08:56:50'),
(150, 155, 'products/dsInDjkriZZO53KDVlBZPzn9cBWJHNaLOJg5aKqG.jpg', 0, '2026-02-28 08:57:49', '2026-02-28 08:57:49'),
(151, 156, 'products/jwf1Cmi49KavpCUQ6pjcSyri6bLwEEWlkM39n548.jpg', 0, '2026-02-28 08:59:26', '2026-02-28 08:59:26'),
(152, 157, 'products/4OGRqcLdIv3g9lvYiR1xcRJLkGYBAlxy0foR4ggw.jpg', 0, '2026-02-28 08:59:53', '2026-02-28 08:59:53'),
(153, 158, 'products/1GpFEgjBMuJofa9h18gvcBxvnu9KL5azFF69Ojzu.jpg', 0, '2026-02-28 09:00:28', '2026-02-28 09:00:28'),
(154, 159, 'products/70DFVkjgP0oEXfGM3HzQcBO1hOgKzAgbZx5Q1rAT.jpg', 0, '2026-02-28 09:00:55', '2026-02-28 09:00:55'),
(155, 160, 'products/7997aJsCHBE4BcnGiPtd3dO2WtHXZ8fald1Atopz.jpg', 0, '2026-02-28 09:01:17', '2026-02-28 09:01:17'),
(156, 161, 'products/ELdmgNqFw34xgclFE8qO0qkh1VxzDGTj52QTQcbX.jpg', 0, '2026-02-28 09:01:39', '2026-02-28 09:01:39'),
(157, 162, 'products/kcTrA2WBulRmt2bH7jdtUzkd0dz2dmoDuW46qkvg.jpg', 0, '2026-02-28 09:02:12', '2026-02-28 09:02:12'),
(158, 163, 'products/SZHwk8wJAMwGoD2WSmNybITHqxMWCedCxZVfrgDX.jpg', 0, '2026-02-28 09:02:43', '2026-02-28 09:02:43'),
(159, 164, 'products/uvVl9FdNgMRSaCi5YyXTvj25m6SrY0LVP2kTxxVJ.jpg', 0, '2026-02-28 09:03:16', '2026-02-28 09:03:16'),
(160, 165, 'products/5WNB1izOEkgfYyNez4R6VOdCymEboiN4WROinCZv.jpg', 0, '2026-02-28 09:03:37', '2026-02-28 09:03:37'),
(161, 166, 'products/8foKm2kbapD3AaD05J0wkxka6L6QRYpEdDpQDRGF.jpg', 0, '2026-02-28 09:04:02', '2026-02-28 09:04:02'),
(162, 167, 'products/9zS4ojLq1OcrCqBz4uTD4j9N1IIVdXNd65BTN6AE.jpg', 0, '2026-02-28 09:04:28', '2026-02-28 09:04:28'),
(163, 168, 'products/2iHeJ2sMe5hrHuGOowGL7WwoEClBbDhmzo6WcbQW.jpg', 0, '2026-02-28 09:05:07', '2026-02-28 09:05:07'),
(164, 169, 'products/sl4v93yzR1bKhJddcNezYuX5o8moQJoVLQhBuhSf.jpg', 0, '2026-02-28 09:05:34', '2026-02-28 09:05:34'),
(165, 170, 'products/OZNfLd9yeYbRsgR9mLa3OZPazUZudHKhNWjD5qvs.jpg', 0, '2026-02-28 09:06:03', '2026-02-28 09:06:03'),
(166, 171, 'products/qq1n8hNFYYE2ONoBHhz3Azra713OUBR5ArwUh71x.jpg', 0, '2026-02-28 09:06:27', '2026-02-28 09:06:27'),
(167, 172, 'products/j8qfiAiW5ZDtEUM378yKTeD4TFJTK0JfM4cIVdzH.jpg', 0, '2026-02-28 09:06:50', '2026-02-28 09:06:50'),
(168, 173, 'products/RDEicqp2PtVsqIXqBJouQ8IJQQo050AnKoo8CjmI.jpg', 0, '2026-02-28 09:07:17', '2026-02-28 09:07:17'),
(169, 174, 'products/DelyjB77xb9ra8c9wcY3LtJ9qQbmqyUDWAHYJOSP.png', 0, '2026-02-28 09:08:04', '2026-02-28 09:08:04'),
(170, 175, 'products/V1tijM2jkNGpkplUaKCbwlRmcROyuIWHjhp7ZYtQ.gif', 0, '2026-02-28 09:08:34', '2026-02-28 09:08:34'),
(171, 176, 'products/wPJTbse4BNtFsNwYrbg3FBU5iwRe40BP5CZ00EYB.jpg', 0, '2026-02-28 09:08:58', '2026-02-28 09:08:58'),
(172, 177, 'products/UbrQ5gybkTWWQKY9ncdvR18nqXwMNLaPeuaOKYzs.jpg', 0, '2026-02-28 09:09:25', '2026-02-28 09:09:25'),
(173, 178, 'products/POIdxocs1QLlEhb2aoTR7eJi108r8kCY8se2A92W.jpg', 0, '2026-02-28 09:10:43', '2026-02-28 09:10:43'),
(174, 179, 'products/6verViQCqFEhJRxuDGxd2ab0H7QQc80Itj7eueEL.jpg', 0, '2026-02-28 09:11:06', '2026-02-28 09:11:06'),
(175, 180, 'products/QMaUI6V8MQ2icNp2nt6LipOuv6xM3rSIW8PhLfR2.jpg', 0, '2026-02-28 09:11:32', '2026-02-28 09:11:32'),
(176, 181, 'products/98e782rTLxBvm1ydDAwfD3xsCZ21c5RSD04KT3SH.jpg', 0, '2026-02-28 09:11:58', '2026-02-28 09:11:58'),
(177, 183, 'products/MQo4D7GtY0cRcqxfPr2ZZgAOZK8WYlYWJtEixcj9.jpg', 0, '2026-02-28 09:12:59', '2026-02-28 09:12:59'),
(178, 184, 'products/UeXnzBoKx0e4qomGODUuOSr1vFPC5yTny3YjeJwx.jpg', 0, '2026-02-28 09:13:41', '2026-02-28 09:13:41'),
(179, 185, 'products/8gKaL4BhPPVf8q6BIURKena527bDsJnPu8luI7jE.jpg', 0, '2026-02-28 09:14:09', '2026-02-28 09:14:09'),
(180, 186, 'products/l8lUmSz1lLdLuJEaftcIyNVwJuHQ2GWnwa1Yievm.jpg', 0, '2026-02-28 09:15:59', '2026-02-28 09:15:59'),
(181, 187, 'products/oJTaSF0Pmn3FKmItKGsKZYshrghdD63ssKLvMM6z.jpg', 0, '2026-02-28 09:16:53', '2026-02-28 09:16:53'),
(182, 188, 'products/02tOCAdvvpQhFG5zatP71q3SjgYrrYBCvHo20ME4.jpg', 0, '2026-02-28 09:18:10', '2026-02-28 09:18:10'),
(183, 189, 'products/IJ9SxwcWmYtNWeIEmry81kFHr9Aog2M3qfBvWSpT.jpg', 0, '2026-02-28 09:18:53', '2026-02-28 09:18:53'),
(184, 190, 'products/Vg2QKLYuoBI1p2bitr9Ch13b8Zckaoi9vzPxP2wL.jpg', 0, '2026-02-28 09:19:35', '2026-02-28 09:19:35'),
(185, 191, 'products/LUZIu4vY9sR13egHFFwZthscuI2Vwd82vm7x0RL0.jpg', 0, '2026-02-28 09:20:09', '2026-02-28 09:20:09'),
(186, 192, 'products/y8SS4vHeovGAVIt5jc4eLvvjpgmtWmWyPDdT4T1E.jpg', 0, '2026-02-28 09:20:44', '2026-02-28 09:20:44'),
(187, 193, 'products/SzCB6P2yG7SYpjodbrSAq4Nz6awIq3wm8dH0P6Ye.jpg', 0, '2026-02-28 09:21:11', '2026-02-28 09:21:11'),
(188, 194, 'products/mK3evOy59f2vcv7OdRMPMZTx5WO4GYVNJuHJwqti.jpg', 0, '2026-02-28 09:22:08', '2026-02-28 09:22:08'),
(189, 195, 'products/ux91AlPjxml6TOxETX7oZDs6g4DGk8Jid72uUJj4.jpg', 0, '2026-02-28 09:22:30', '2026-02-28 09:22:30'),
(190, 196, 'products/TUnQKQ4BfGJLwToOy0IFDCcGRp2da5cegNgMe4CB.jpg', 0, '2026-02-28 09:22:57', '2026-02-28 09:22:57'),
(191, 197, 'products/oyHIeZIzbt3zNamrDJayIMLZ9Zm69lZamD8rXFIu.jpg', 0, '2026-02-28 09:23:18', '2026-02-28 09:23:18'),
(192, 198, 'products/onoU5gRfFcZUmR5VNVVVIeyzPSsqTzGMXS69mr51.jpg', 0, '2026-02-28 09:23:44', '2026-02-28 09:23:44'),
(193, 199, 'products/v95CPhdYXCfQwYOxBcW4HPaJrOgxytExGI4TFK28.jpg', 0, '2026-02-28 09:24:14', '2026-02-28 09:24:14'),
(194, 200, 'products/l73oPuSqW6BjnRWZSpCuKhCReDcgIZYB6Z3yxxjm.jpg', 0, '2026-02-28 09:24:37', '2026-02-28 09:24:37'),
(195, 201, 'products/xsdwHn8owCAjvlsY0SZoxtCgv7Z4KZgV4g8DxRkr.jpg', 0, '2026-02-28 09:25:07', '2026-02-28 09:25:07'),
(196, 201, 'products/J1LKJ6ObK81tTx7xTWkN8W0uvtkrCaLXpXwRz0IL.jpg', 1, '2026-02-28 09:25:07', '2026-02-28 09:25:07'),
(197, 202, 'products/aNGExLPzzyqrUzgtt2nYVQESO6WIC3owLd0bHVh4.jpg', 0, '2026-02-28 09:25:28', '2026-02-28 09:25:28'),
(198, 204, 'products/0Qh3JC0uQ41la6Ezw00oxXthH3yDf9kLgcSOzXyT.jpg', 0, '2026-02-28 09:26:47', '2026-02-28 09:26:47'),
(199, 205, 'products/EouwkkL7B7YSyzRwFHH0J78ub9H2cXQqcuHYAglK.jpg', 0, '2026-02-28 09:27:14', '2026-02-28 09:27:14'),
(200, 206, 'products/ayhyZuXk37mV7li08tIQctD5kKQ2Rppz1YLVvwWq.jpg', 0, '2026-02-28 09:27:43', '2026-02-28 09:27:43'),
(201, 207, 'products/jdU6ZcXjoaxUm9izDJkQVKLRQb4USuuJzjjGki8E.jpg', 0, '2026-02-28 09:28:03', '2026-02-28 09:28:03'),
(202, 208, 'products/VXGY4ba1YDYeEnuhELm4eqltXCXwqhvqUYlLNJaa.jpg', 0, '2026-02-28 09:28:31', '2026-02-28 09:28:31'),
(203, 209, 'products/xKxEMLKwZ6JK0VSCq0UwhhsBJHXjtrxzGZr6G7j4.jpg', 0, '2026-02-28 09:28:54', '2026-02-28 09:28:54'),
(204, 210, 'products/j4HInZ8Jr91LDhjm4LMzZ1JW8gBZq7JJ3FZMICES.jpg', 0, '2026-02-28 09:29:32', '2026-02-28 09:29:32'),
(205, 211, 'products/EyzOIdmphqWLM0cUPozKJk7J9SBsXaFE7SeRYAvv.jpg', 0, '2026-02-28 09:30:00', '2026-02-28 09:30:00'),
(206, 212, 'products/GbLfW9cdsIXgQNb7Z7Wy2EremsJWpPAnUMfs4aS9.png', 0, '2026-02-28 09:30:24', '2026-02-28 09:30:24'),
(207, 213, 'products/mltjPtGK1XEycYp1w8bvs3in8Od1FMk7swsz4Jve.jpg', 0, '2026-02-28 09:30:50', '2026-02-28 09:30:50'),
(208, 214, 'products/r1BcZlS6BH9tvlL0yZRfhMrxDCLvIeRl2NCqiABf.jpg', 0, '2026-02-28 09:32:07', '2026-02-28 09:32:07'),
(209, 215, 'products/kqQUfHrCbce68wvA1zKT3tOAKoRCxDJuRyrOWiyB.jpg', 0, '2026-02-28 09:32:32', '2026-02-28 09:32:32'),
(210, 216, 'products/ZMZgLuwG088lT6M92FhA4AIsqlMmHCaG8RUMDZfO.jpg', 0, '2026-02-28 09:32:58', '2026-02-28 09:32:58'),
(211, 217, 'products/8r3j39BrR19NHoCLfJ1i0PuUhdsCvqvUttrCwkNZ.jpg', 0, '2026-02-28 09:33:36', '2026-02-28 09:33:36'),
(212, 218, 'products/IQmrXErC3wSmq5MLmN4KgzYOIeprybTxmbyqQcSq.png', 0, '2026-02-28 09:33:59', '2026-02-28 09:33:59'),
(213, 219, 'products/47FDYkM4jSicTqsCp4JZFXkLE6irs1PR40kqfxvW.jpg', 0, '2026-02-28 09:34:32', '2026-02-28 09:34:32'),
(214, 220, 'products/dtWhAL2nkQrFpY31OLXfWTIGa0KSDZj07kq1z0JW.jpg', 0, '2026-02-28 09:35:11', '2026-02-28 09:35:11'),
(215, 221, 'products/Be8kbEgNm90ahHVKjZ2VQjCJVCRwYVZjxFafRTWV.jpg', 0, '2026-02-28 09:35:35', '2026-02-28 09:35:35'),
(216, 222, 'products/J4diyZIytJYRJDkhjjFIZhRmmfRuFyZT4L4hIcZF.jpg', 0, '2026-02-28 09:36:01', '2026-02-28 09:36:01'),
(217, 223, 'products/7LiWCIlO1C4q6XmU9hy4b4is0Xr22P76rtWTe1Xr.jpg', 0, '2026-02-28 09:36:36', '2026-02-28 09:36:36'),
(218, 224, 'products/oVJ3bQC6HJI7xpIPc04OefdnaASfrxvzpjRtkq9o.jpg', 0, '2026-02-28 09:36:59', '2026-02-28 09:36:59'),
(219, 225, 'products/vfDOcqHcV9GMq9hXrjaEjw44MQgqb7dcpYKriGTI.jpg', 0, '2026-02-28 09:37:20', '2026-02-28 09:37:20'),
(220, 226, 'products/4yrNB7dcBy9PSDbPJAM7f6pDHPbYG7sRZxTcwKco.jpg', 0, '2026-02-28 09:37:40', '2026-02-28 09:37:40'),
(221, 227, 'products/1cGsrlx79ZS9KMOVKTZmCBXjfwNnE734O5OLjCKN.jpg', 0, '2026-02-28 09:38:04', '2026-02-28 09:38:04'),
(222, 228, 'products/wYIM4jtDXHiKMzQzYnntnKZYBzc6Xi53wV2XItou.jpg', 0, '2026-02-28 09:39:08', '2026-02-28 09:39:08'),
(223, 229, 'products/IbT3DLR5CBIgQ2bVBD97wWJU4tX0ONfXfRG8edX2.jpg', 0, '2026-02-28 09:39:29', '2026-02-28 09:39:29'),
(224, 231, 'products/eU4sRpTMiFgemQkuKpEeUE1ZzJiPPMREIH4GPfNL.jpg', 0, '2026-02-28 09:40:46', '2026-02-28 09:40:46'),
(225, 232, 'products/jihJrV5vZvxb3hg5rJGorQt6CUBEDkHbWLhbzR2J.jpg', 0, '2026-02-28 09:41:13', '2026-02-28 09:41:13'),
(226, 233, 'products/rsIhzakWEJFDhFYB6j5mdZfb93uW4SGnoN3Hi6OE.jpg', 0, '2026-02-28 09:41:40', '2026-02-28 09:41:40'),
(227, 234, 'products/fifSJKq7fo8gSHKxMZ3bZD6JA7WLQdQ4yEIPpS2V.jpg', 0, '2026-02-28 09:42:00', '2026-02-28 09:42:00'),
(228, 235, 'products/AlnVluEQJDSNILd7yLvNRVZpi94wZe65r7yuYGea.jpg', 0, '2026-02-28 09:42:21', '2026-02-28 09:42:21'),
(229, 236, 'products/k4jXSIHWubg8uEAEx5lKkh2y2HYXpNXHeZ4qqS1m.jpg', 0, '2026-02-28 09:42:40', '2026-02-28 09:42:40'),
(230, 237, 'products/LksGyLa9LoYvfmlPMaPrDebwrIYzjLUTrqrwyDPr.jpg', 0, '2026-02-28 09:43:05', '2026-02-28 09:43:05'),
(231, 238, 'products/szNgUrtjRfXkUTvp8PYslwD7ro1RtBuHjNqpl7rI.jpg', 0, '2026-02-28 09:43:24', '2026-02-28 09:43:24'),
(232, 239, 'products/VEvUQM289ZFhis2e3jB88zdoo6wlHPqD0LMsCodh.jpg', 0, '2026-02-28 09:44:13', '2026-02-28 09:44:13'),
(233, 240, 'products/9zOYOqHmV4GZG6b0HhOqa46ulBKJO4geLsCRkCZk.jpg', 0, '2026-02-28 09:44:39', '2026-02-28 09:44:39'),
(234, 241, 'products/R5BtujOX1rQQOKkMLSteVVdhwFic8Jj0tl5a6JSR.jpg', 0, '2026-02-28 09:45:06', '2026-02-28 09:45:06'),
(235, 242, 'products/W2GYQB9BCZ7Otlcmz3PhrywXdglSYo9sqMFb0qLT.jpg', 0, '2026-02-28 09:45:27', '2026-02-28 09:45:27'),
(236, 243, 'products/4HHCSd0GTuG50tqyQ1YQBb1avV3m46KZNRXKnn3X.jpg', 0, '2026-02-28 09:45:54', '2026-02-28 09:45:54'),
(237, 244, 'products/k0BAOZGCb4sx7IInxSFyQevNxiwIxQdbNxCDJarT.jpg', 0, '2026-02-28 09:46:19', '2026-02-28 09:46:19'),
(238, 245, 'products/urvhl9OBENhQZktXJHZGqg3hfYGcADAsmI0Md96y.jpg', 0, '2026-02-28 09:46:52', '2026-02-28 09:46:52'),
(239, 246, 'products/UBA17YsKq2q89OAHAWV1MjCHfXNMoQLXW9DNAU71.jpg', 0, '2026-02-28 09:48:12', '2026-02-28 09:48:12'),
(240, 247, 'products/RtKRXH1dlM2YBZwEiclhZmOrvRVQCIQUZbdQOq8U.jpg', 0, '2026-02-28 09:48:56', '2026-02-28 09:48:56'),
(241, 248, 'products/vYqo4I0dssPC3bVARDlfMBg0otbzSA9xsVPQcr8i.jpg', 0, '2026-02-28 09:49:36', '2026-02-28 09:49:36'),
(242, 249, 'products/pLuNxaX1rUrepfA7GBXsw9jTa3euvdF4mWz7LXUZ.jpg', 0, '2026-02-28 09:50:19', '2026-02-28 09:50:19'),
(243, 250, 'products/dycdZss8qPiBqwiA9uWmBL2Eaj2fRcMpwsbCDStb.jpg', 0, '2026-02-28 09:51:37', '2026-02-28 09:51:37'),
(244, 251, 'products/c1kGXlkmqaWqdijkbwEMkTIzPsPgNzcMTAeSVUbT.jpg', 0, '2026-02-28 10:07:39', '2026-02-28 10:07:39'),
(245, 252, 'products/iPTRgYBDOe8zea4ytqg4ZLfr8YeAms47fsltAHU9.jpg', 0, '2026-02-28 10:08:15', '2026-02-28 10:08:15'),
(246, 253, 'products/eyPcUEt0PWtkCYQszxvY0o8LmJhPAefkifBx6qut.jpg', 0, '2026-02-28 10:08:55', '2026-02-28 10:08:55'),
(247, 254, 'products/NqmUGtzrlpiQCUVorbHAlrJsgopGZvY0Y7KFzM0j.jpg', 0, '2026-02-28 10:09:39', '2026-02-28 10:09:39'),
(248, 255, 'products/dWvbHfCTKMh67WF46se1PXEqVKZkOSEd44Mai8ma.jpg', 0, '2026-02-28 10:10:37', '2026-02-28 10:10:37'),
(249, 256, 'products/YTxurICw0FXOeXDlsal74SGUx1pzMfKRQNjZgTKt.jpg', 0, '2026-02-28 10:11:18', '2026-02-28 10:11:18'),
(250, 257, 'products/D1E8LdmrIfgG1qTQVE2udUIHEq6F3k0XXrTr0uP8.jpg', 0, '2026-02-28 10:11:55', '2026-02-28 10:11:55'),
(251, 258, 'products/OeVJ9nMsRDt3V57Q8pFqgbxvDxtbAQldzp3KVPhp.jpg', 0, '2026-02-28 10:12:43', '2026-02-28 10:12:43'),
(252, 259, 'products/8PNradKjpkS7YRmJH9uq7ERQMtAeqEHHSkq8NaIM.jpg', 0, '2026-02-28 10:13:26', '2026-02-28 10:13:26'),
(253, 260, 'products/9naBNM9POWZeHS6nbftlUnImBkLlM9Sg8qHyWFpR.jpg', 0, '2026-02-28 10:14:04', '2026-02-28 10:14:04'),
(254, 261, 'products/PZh9QyB5ktVLRHwtqX5GVKOiunFNnngj8eNnM1Cn.png', 0, '2026-02-28 10:14:48', '2026-02-28 10:14:48'),
(255, 262, 'products/Vhbk57SC8zUCa2muyI7X1X48FJIIAKlpVAaCgm23.jpg', 0, '2026-02-28 10:15:29', '2026-02-28 10:15:29'),
(256, 263, 'products/0G2wx5EVyg2JzXpJWhKak2iNaMWOyJJbsQD3K8YX.jpg', 0, '2026-02-28 10:16:15', '2026-02-28 10:16:15'),
(257, 264, 'products/Yy9FMzL2SKpduGOYB6FpNKpdYFkayqaffk4Zz1FG.jpg', 0, '2026-02-28 10:17:03', '2026-02-28 10:17:03'),
(258, 265, 'products/xW5K78dYKc4Q68X2wsyNRDdv7MtUyYjV2H91P0ua.png', 0, '2026-02-28 10:18:05', '2026-02-28 10:18:05'),
(259, 266, 'products/yTvzof52421ZekcuCgEiV4twajKodhs6ZV1mqS26.jpg', 0, '2026-02-28 10:18:46', '2026-02-28 10:18:46'),
(260, 267, 'products/jWHXbVlp0oAxUFCADeKVdhul3xQWFHYjgnTXvfiU.jpg', 0, '2026-02-28 10:19:29', '2026-02-28 10:19:29'),
(261, 268, 'products/oSMCXqewas18NbWrFGcss2sXDXsWiDPhx6vCHSnI.jpg', 0, '2026-02-28 10:20:17', '2026-02-28 10:20:17'),
(262, 269, 'products/1Ui6GDCQBaiSuGB7eKowelACBsRY8QDV0XglNomt.jpg', 0, '2026-02-28 10:21:00', '2026-02-28 10:21:00'),
(263, 270, 'products/VIjqXvWMWZ6MlRPUxmJG1cJoUmOeGPakugbaQi0I.jpg', 0, '2026-02-28 10:21:59', '2026-02-28 10:21:59'),
(264, 271, 'products/nW961qYeDZOkdRGTDZZXm29h4Ii2leGLc4qNTVcy.jpg', 0, '2026-02-28 10:22:48', '2026-02-28 10:22:48'),
(265, 272, 'products/POrTAY5DPgPOusl4kQazKTTTzLVyk94aSPkyvjS1.jpg', 0, '2026-02-28 10:23:38', '2026-02-28 10:23:38'),
(266, 273, 'products/yBetnpo2KQQN59pbvwuMsYP6lQs9WUILk5RiDhAc.jpg', 0, '2026-02-28 10:24:17', '2026-02-28 10:24:17'),
(267, 274, 'products/861kA84AlcjRqhxaab7D79C7w80Z03zDStK9z729.jpg', 0, '2026-02-28 10:25:24', '2026-02-28 10:25:24'),
(268, 275, 'products/to0qhgH0HscPNxQCzAocowxgiILnBdwvFV9cR7h3.jpg', 0, '2026-02-28 10:26:19', '2026-02-28 10:26:19'),
(269, 276, 'products/M73iP5axLwj2fRreKivSun93x772hsyQtN05lvPW.jpg', 0, '2026-02-28 10:27:04', '2026-02-28 10:27:04'),
(270, 277, 'products/xAok9ftQUKOASB6uSIwvv6xTGKzO9gHOGwpmiO8F.jpg', 0, '2026-02-28 10:27:45', '2026-02-28 10:27:45'),
(271, 278, 'products/8uag9jxsbowW4jXKc9c70sIJPVhLiggfzBKmpDVx.jpg', 0, '2026-02-28 10:29:38', '2026-02-28 10:29:38');

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
(2, 69, 11, NULL, 5, 'ចេកនេះឆ្ងាញ់ណាស់', NULL, 1, 0, 0, NULL, NULL, NULL, 1, '2026-02-25 18:08:14', '2026-02-25 18:08:26'),
(3, 278, 13, NULL, 5, 'ខ្ញីនេះទំនងដាំទឹកផឹកណាស់ បើយកទៅឆាក៏ឆ្ងាញ់ដែរ', '[\"reviews\\/90i9fmYp3XpEtWs0SmKwpcwOjmCaZcYg88xAMQ0K.jpg\"]', 1, 0, 0, NULL, NULL, NULL, 1, '2026-02-28 11:57:35', '2026-02-28 11:58:10'),
(4, 276, 13, NULL, 4, 'សណ្ដែកសៀងនេះ ទំនងយកទៅធ្វើទឹកសណ្ដែក', NULL, 1, 0, 0, NULL, NULL, NULL, 0, '2026-02-28 11:59:08', '2026-02-28 11:59:08'),
(5, 275, 13, NULL, 3, 'ជិតអស់ស្តុកហើយបង ដាក់ថែមឲ្យច្រើនៗមក', NULL, 1, 0, 0, NULL, NULL, NULL, 0, '2026-02-28 11:59:43', '2026-02-28 11:59:43'),
(6, 274, 13, NULL, 2, 'ខ្ញុំអត់ចូលចិត្តញ៉ាំត្រប់ទេ', NULL, 1, 0, 0, NULL, NULL, NULL, 0, '2026-02-28 12:00:15', '2026-02-28 12:00:15');

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
(10, 1, 13, '2026-02-26 05:36:10', '2026-02-26 05:36:10'),
(11, 3, 13, '2026-02-28 11:58:10', '2026-02-28 11:58:10');

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
(2, 'Delivery Driver', 'driver@grocery.com', '01234545465', NULL, NULL, NULL, NULL, 11.51327900, 104.88916800, '2026-02-28 13:54:38', NULL, 'profile-photos/NdARXECREhZUN7CXdSZ9DtVzU0UuR8hXkM2fh9xs.jpg', 'driver', 'active', '[]', NULL, NULL, '$2y$12$hWtix2NM4Tu.Y0AvfHXYn.HIhQtYfw6.GRmmuG/6UI8j8f60a7i96', NULL, '2026-02-20 00:57:34', '2026-02-28 13:54:38'),
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
(19, 11, 69, '2026-02-25 18:04:32', '2026-02-25 18:04:32'),
(23, 13, 278, '2026-02-28 11:18:31', '2026-02-28 11:18:31'),
(24, 13, 254, '2026-02-28 11:19:45', '2026-02-28 11:19:45'),
(25, 13, 253, '2026-02-28 11:19:46', '2026-02-28 11:19:46'),
(26, 13, 274, '2026-02-28 11:56:43', '2026-02-28 11:56:43'),
(27, 13, 273, '2026-02-28 11:56:44', '2026-02-28 11:56:44'),
(28, 13, 271, '2026-02-28 11:56:46', '2026-02-28 11:56:46'),
(29, 13, 269, '2026-02-28 11:56:48', '2026-02-28 11:56:48'),
(30, 13, 266, '2026-02-28 11:58:29', '2026-02-28 11:58:29');

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
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review_helpful`
--
ALTER TABLE `review_helpful`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
