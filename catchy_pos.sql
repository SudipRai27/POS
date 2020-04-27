-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2018 at 11:19 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catchy_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `per_customers`
--

CREATE TABLE `per_customers` (
  `id` int(100) NOT NULL,
  `customer_code` varchar(100) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `customer_note` text,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_customers`
--

INSERT INTO `per_customers` (`id`, `customer_code`, `customer_name`, `address`, `phone_no`, `customer_note`, `status`, `created_at`, `updated_at`) VALUES
(2, 'TC1B10', 'Bijay Sangten', 'Kavre', '9823132311', NULL, 'active', '2018-05-27 09:42:55', '2018-05-27 09:42:55'),
(3, 'j200', 'Jimmy Gurung', 'Lalitpur', '9812323456', 'Jimmy', 'active', '2018-05-27 09:43:18', '2018-05-27 09:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `per_products`
--

CREATE TABLE `per_products` (
  `id` int(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text,
  `sales_price` decimal(10,2) NOT NULL,
  `category_id` int(100) NOT NULL,
  `subcategory_id` int(100) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_products`
--

INSERT INTO `per_products` (`id`, `product_code`, `product_name`, `description`, `sales_price`, `category_id`, `subcategory_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'BJ100', 'Blue Jeans', 'Blue Jeans', '1150.00', 3, 5, '5b06d5d5d45a0jeans1.jpg', 'inactive', '2018-05-24 15:10:13', '2018-06-14 08:59:04'),
(4, 'BRJ200', 'Brown Jeans', NULL, '1200.00', 3, 5, '5b06d608b4a38brown.jpg', 'active', '2018-05-24 15:11:04', '2018-06-14 08:58:51'),
(5, 'RMJ100', 'Real Madrid Jersey', 'Real Madrid', '800.00', 5, 3, '5b06d9949d8a3realmadrid.jpg', 'active', '2018-05-24 15:26:12', '2018-05-24 15:26:12'),
(23, 'MIG10', 'Suhr Guitar', 'Signature Suhr Guitar', '100000.00', 6, 7, '5b07be89923721.jpg', 'active', '2018-05-25 07:43:05', '2018-05-25 07:43:05'),
(24, 'LG GL-B292', 'LG Refrigerator', 'Double Doors Refrigerator', '25000.00', 7, 8, '5b10de872b467refrigerator1.jpg', 'active', '2018-06-01 05:49:59', '2018-06-01 05:49:59'),
(25, 'TSHIRTMENS', 'Mens T-Shirt', 'Mens T-Shirt', '1250.00', 3, 6, '5b10deab2dd0fmen-tshirt.jpg', 'active', '2018-06-01 05:50:35', '2018-06-01 05:50:35'),
(29, 'RCD202', 'Richmond Drums', 'Best Drums', '80000.00', 6, 9, '5b1780b6e1763richmond drums.png', 'active', '2018-06-06 06:35:35', '2018-06-06 06:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `per_product_category`
--

CREATE TABLE `per_product_category` (
  `id` int(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_product_category`
--

INSERT INTO `per_product_category` (`id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Mens Accessories', 'Variety of Mens Clothes', '2018-05-24 09:27:31', '2018-05-24'),
(5, 'Sports', NULL, '2018-05-24 10:08:19', '2018-05-24'),
(6, 'Musical Instruments', 'Popular Musical Instruments', '2018-05-25 07:05:09', '2018-05-25'),
(7, 'Home Appliances', 'Home Appliances', '2018-06-01 05:48:12', '2018-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `per_product_subcategory`
--

CREATE TABLE `per_product_subcategory` (
  `id` int(100) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `category_id` int(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_product_subcategory`
--

INSERT INTO `per_product_subcategory` (`id`, `subcategory_name`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 'Jersey Kit', 5, '2018-05-24 10:08:31', '2018-05-24 11:35:19'),
(5, 'Jeans', 3, '2018-05-24 10:12:28', '2018-05-24 10:12:28'),
(6, 'T-Shirts', 3, '2018-05-24 11:25:40', '2018-05-24 13:50:05'),
(7, 'Guitar', 6, '2018-05-25 07:05:24', '2018-05-25 07:05:24'),
(8, 'Refregerator', 7, '2018-06-01 05:48:30', '2018-06-01 05:48:30'),
(9, 'Drums', 6, '2018-06-06 06:30:06', '2018-06-06 06:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `per_purchase`
--

CREATE TABLE `per_purchase` (
  `id` int(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `invoice_number` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_purchase`
--

INSERT INTO `per_purchase` (`id`, `product_code`, `quantity`, `price`, `total_price`, `invoice_number`, `created_at`, `updated_at`) VALUES
(1, 'BJ100', 12, '1500.00', '18000.00', 1, '2018-06-01 06:07:38', '2018-06-01 06:07:38'),
(2, 'BRJ200', 5, '1150.00', '5750.00', 1, '2018-06-01 06:07:38', '2018-06-01 06:07:38'),
(3, 'LG GL-B292', 4, '22500.00', '90000.00', 1, '2018-06-01 06:07:38', '2018-06-01 06:07:38'),
(4, 'MIG10', 5, '30000.00', '150000.00', 1, '2018-06-01 06:07:38', '2018-06-01 06:07:38'),
(6, 'RMJ100', 20, '925.00', '18500.00', 3, '2018-06-04 06:47:32', '2018-06-04 06:47:32'),
(7, 'TSHIRTMENS', 60, '750.00', '45000.00', 3, '2018-06-04 06:47:32', '2018-06-04 06:47:32'),
(8, 'TSHIRTMENS', 20, '1200.00', '24000.00', 4, '2018-06-04 08:35:30', '2018-06-04 08:35:30'),
(9, 'RMJ100', 12, '1000.00', '12000.00', 4, '2018-06-04 08:35:30', '2018-06-04 08:35:30'),
(10, 'MIG10', 5, '20000.00', '100000.00', 4, '2018-06-04 08:35:30', '2018-06-04 08:35:30'),
(11, 'BJ100', 12, '1500.00', '18000.00', 5, '2018-06-06 07:30:32', '2018-06-06 07:30:32'),
(12, 'BRJ200', 10, '1500.00', '15000.00', 5, '2018-06-06 07:30:32', '2018-06-06 07:30:32'),
(13, 'RMJ100', 10, '850.00', '8500.00', 5, '2018-06-06 07:30:32', '2018-06-06 07:30:32'),
(14, 'TSHIRTMENS', 10, '925.00', '9250.00', 5, '2018-06-06 07:30:32', '2018-06-06 07:30:32'),
(15, 'RCD202', 20, '50000.00', '1000000.00', 6, '2018-06-08 08:05:55', '2018-06-08 08:05:55'),
(16, 'LG GL-B292', 10, '20000.00', '200000.00', 7, '2018-06-08 08:25:05', '2018-06-08 08:25:05'),
(17, 'RCD202', 12, '20000.00', '240000.00', 7, '2018-06-08 08:25:05', '2018-06-08 08:25:05'),
(18, 'BJ100', 12, '100.00', '1200.00', 8, '2018-06-12 10:24:16', '2018-06-12 10:24:16'),
(19, 'MIG10', 2, '100.00', '200.00', 8, '2018-06-12 10:24:17', '2018-06-12 10:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `per_purchase_invoice`
--

CREATE TABLE `per_purchase_invoice` (
  `id` int(50) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `invoice_number` int(50) NOT NULL,
  `supplier_id` int(50) NOT NULL,
  `invoice_generated_date` varchar(50) NOT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `dues` decimal(10,2) DEFAULT NULL,
  `is_paid` enum('unpaid','paid','partially paid') NOT NULL DEFAULT 'unpaid',
  `payment_date` varchar(50) DEFAULT NULL,
  `due_payment_date` date DEFAULT NULL,
  `notes` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_purchase_invoice`
--

INSERT INTO `per_purchase_invoice` (`id`, `grand_total`, `invoice_number`, `supplier_id`, `invoice_generated_date`, `paid_amount`, `dues`, `is_paid`, `payment_date`, `due_payment_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, '263750.00', 1, 3, '2018-06-01 11:51:03', '263750.00', '0.00', 'paid', '2018-06-01', NULL, NULL, '2018-06-01 06:07:38', '2018-06-01 08:22:57'),
(3, '63500.00', 3, 3, '2018-06-04 12:32:02', '62000.00', '0.00', 'paid', '2018-06-04', '2018-06-06', NULL, '2018-06-04 06:47:33', '2018-06-06 07:32:14'),
(4, '136000.00', 4, 4, '2018-06-03 14:19:25', '130000.00', '0.00', 'paid', '2018-06-06', '2018-06-06', NULL, '2018-06-04 08:35:30', '2018-06-06 11:12:48'),
(5, '50750.00', 5, 4, '2018-06-06 13:14:18', NULL, '50750.00', 'unpaid', NULL, NULL, NULL, '2018-06-06 07:30:32', '2018-06-06 07:30:32'),
(6, '1000000.00', 6, 3, '2018-06-08 13:50:38', NULL, '1000000.00', 'unpaid', NULL, NULL, NULL, '2018-06-08 08:05:55', '2018-06-08 08:05:55'),
(7, '440000.00', 7, 4, '2018-06-08 14:09:16', NULL, '440000.00', 'unpaid', NULL, NULL, 'Payment to be done afterwards', '2018-06-08 08:25:05', '2018-06-08 08:25:05'),
(8, '1400.00', 8, 3, '2018-06-12 16:08:58', NULL, '1400.00', 'unpaid', NULL, NULL, 'NTH', '2018-06-12 10:24:17', '2018-06-12 10:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `per_roles`
--

CREATE TABLE `per_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_roles`
--

INSERT INTO `per_roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'employee', '2018-06-11 00:00:00', '2018-06-11 00:00:00'),
(2, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `per_sales`
--

CREATE TABLE `per_sales` (
  `id` int(50) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `invoice_number` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_sales`
--

INSERT INTO `per_sales` (`id`, `product_code`, `quantity`, `price`, `total_price`, `invoice_number`, `created_at`, `updated_at`) VALUES
(1, 'BJ100', 5, '1212.00', '6060.00', 1, '2018-06-06 08:30:52', '2018-06-06 08:30:52'),
(2, 'BRJ200', 5, '1209.00', '6045.00', 1, '2018-06-06 08:30:52', '2018-06-06 08:30:52'),
(3, 'LG GL-B292', 5, '25000.00', '125000.00', 1, '2018-06-06 08:30:52', '2018-06-06 08:30:52'),
(4, 'MIG10', 5, '100000.00', '500000.00', 1, '2018-06-06 08:30:52', '2018-06-06 08:30:52'),
(5, 'RMJ100', 10, '800.00', '8000.00', 1, '2018-06-06 08:30:52', '2018-06-06 08:30:52'),
(6, 'TSHIRTMENS', 20, '1250.00', '25000.00', 1, '2018-06-06 08:30:52', '2018-06-06 08:30:52'),
(7, 'BJ100', 5, '1212.00', '6060.00', 2, '2018-06-08 08:03:12', '2018-06-08 08:03:12'),
(8, 'TSHIRTMENS', 20, '1250.00', '25000.00', 2, '2018-06-08 08:03:12', '2018-06-08 08:03:12'),
(9, 'BRJ200', 5, '1209.00', '6045.00', 3, '2018-06-08 08:26:09', '2018-06-08 08:26:09'),
(10, 'RCD202', 30, '80000.00', '2400000.00', 3, '2018-06-08 08:26:09', '2018-06-08 08:26:09'),
(11, 'MIG10', 10, '100000.00', '1000000.00', 4, '2018-06-08 08:45:38', '2018-06-08 08:45:38'),
(12, 'BJ100', 9, '1212.00', '10908.00', 5, '2018-06-12 10:36:00', '2018-06-12 10:36:00'),
(13, 'TSHIRTMENS', 20, '1250.00', '25000.00', 5, '2018-06-12 10:36:00', '2018-06-12 10:36:00'),
(14, 'RMJ100', 10, '800.00', '8000.00', 6, '2018-06-14 06:22:40', '2018-06-14 06:22:40'),
(15, 'LG GL-B292', 10, '25000.00', '250000.00', 6, '2018-06-14 06:22:40', '2018-06-14 06:22:40'),
(16, 'BJ100', 4, '1212.00', '4848.00', 7, '2018-06-14 06:52:50', '2018-06-14 06:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `per_sales_invoice`
--

CREATE TABLE `per_sales_invoice` (
  `id` int(50) NOT NULL,
  `grand_total` decimal(25,2) NOT NULL,
  `grand_total_with_vat` decimal(25,2) NOT NULL,
  `invoice_number` int(50) NOT NULL,
  `invoice_generated_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` decimal(25,2) NOT NULL,
  `return_amount` decimal(25,2) NOT NULL,
  `vat_percent` decimal(10,2) NOT NULL,
  `notes` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_sales_invoice`
--

INSERT INTO `per_sales_invoice` (`id`, `grand_total`, `grand_total_with_vat`, `invoice_number`, `invoice_generated_date`, `paid_amount`, `return_amount`, `vat_percent`, `notes`, `created_at`, `updated_at`) VALUES
(1, '670105.00', '757218.65', 1, '2018-06-06 14:14:29', '760000.00', '2782.00', '13.00', NULL, '2018-06-06 08:30:53', '2018-06-06 08:30:53'),
(2, '31060.00', '35097.00', 2, '2018-06-08 13:47:38', '36000.00', '903.00', '13.00', NULL, '2018-06-08 08:03:12', '2018-06-08 08:03:12'),
(3, '2406045.00', '2718830.00', 3, '2018-06-08 14:10:21', '2800000.00', '81170.00', '13.00', 'Amount is fully paid', '2018-06-08 08:26:09', '2018-06-08 08:26:09'),
(4, '1000000.00', '1130000.00', 4, '2018-06-08 14:30:23', '1200000.00', '70000.00', '13.00', NULL, '2018-06-08 08:45:38', '2018-06-08 08:45:38'),
(5, '35908.00', '40576.00', 5, '2018-06-12 16:20:42', '41000.00', '424.00', '13.00', NULL, '2018-06-12 10:36:00', '2018-06-12 10:36:00'),
(6, '258000.00', '291540.00', 6, '2018-06-14 12:07:11', '300000.00', '8460.00', '13.00', NULL, '2018-06-14 06:22:40', '2018-06-14 06:22:40'),
(7, '4848.00', '5478.00', 7, '2018-06-14 12:37:39', '6000.00', '522.00', '13.00', NULL, '2018-06-14 06:52:50', '2018-06-14 06:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `per_settings`
--

CREATE TABLE `per_settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_settings`
--

INSERT INTO `per_settings` (`id`, `company_name`, `address`, `telephone`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Catchy POS', 'SoalteeMode', '9813426920', '5b1512561a24blogo.jpg', '2018-06-04 10:08:31', '2018-06-04 10:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `per_stock`
--

CREATE TABLE `per_stock` (
  `id` int(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_stock`
--

INSERT INTO `per_stock` (`id`, `product_code`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'BJ100', 1, '2018-06-01 06:07:38', '2018-06-14 06:52:50'),
(2, 'BRJ200', 0, '2018-06-01 06:07:38', '2018-06-08 08:26:09'),
(3, 'LG GL-B292', 3, '2018-06-01 06:07:38', '2018-06-14 06:22:40'),
(4, 'MIG10', 9, '2018-06-01 06:07:38', '2018-06-12 10:24:17'),
(5, 'RMJ100', 12, '2018-06-04 06:47:32', '2018-06-14 06:22:40'),
(6, 'TSHIRTMENS', 10, '2018-06-04 06:47:32', '2018-06-12 10:36:00'),
(7, 'RCD202', 2, '2018-06-08 08:05:55', '2018-06-08 08:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `per_superadmin`
--

CREATE TABLE `per_superadmin` (
  `id` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `temporary_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `per_superadmin`
--

INSERT INTO `per_superadmin` (`id`, `name`, `email`, `password`, `temporary_address`, `permanent_address`, `contact`, `photo`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Catchy Road', 'admin@admin.com', '$2y$10$ts2AA2nJGZI4XfvTgsNLzOlNIWQpuPX3W8LNC7tXHUoE6WxzRX6Za', 'Kalimati', 'kalimati', '4488542', 'images.png', 'rTHpzggzIDFuKI7Rn2ybQYybBAFNhi9Eydq1Ef47o4jJ5cM0wbdFhFqWrbeD', 'mJUhf2YAVekfhZrbweQJXv4WKfpDR5VwPZwE4AyJ6l3NjKVH2NWZgCT7ulsp', '2018-05-06 09:35:36', '2018-06-13 10:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `per_suppliers`
--

CREATE TABLE `per_suppliers` (
  `id` int(50) NOT NULL,
  `supplier_code` varchar(50) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `supplier_note` text,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_suppliers`
--

INSERT INTO `per_suppliers` (`id`, `supplier_code`, `supplier_name`, `address`, `contact_person`, `phone_no`, `supplier_note`, `status`, `created_at`, `updated_at`) VALUES
(3, 'HSI2', 'Harisiddhi Suppliers', 'KTM', 'Ravi Gurung', '9813426920', NULL, 'active', '2018-05-27 09:24:20', '2018-06-04 09:41:42'),
(4, 'T102', 'Tika Suppliers', 'Bkt', 'Tika Yadav', '981232113', NULL, 'active', '2018-05-27 09:41:50', '2018-05-27 09:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `per_users`
--

CREATE TABLE `per_users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_users`
--

INSERT INTO `per_users` (`id`, `name`, `email`, `password`, `address`, `contact`, `photo`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(2, 'Sushan Paudyal', 'sushan@gmail.com', '$2y$10$tS6PQvaQlEID2b6gjCKn3.vgfIRdycO10en2OeXHwZwBNc7SGheQK', 'ktm', '981232121', '', 'Ls2mC5zrkt2BH7QsHhlbK6WZdmiitkbL68g15wiuP7qHF9MSaf72vytnQAQ2', 'oj4osmanE3MjuvW2YA9L7SSwCMK6yQW7WZZwDt6NKJnj9OHmWvKYtOaNf2WR', '2018-05-20 07:59:56', '2018-06-13 08:51:23'),
(9, 'Rohit Manadhar', 'rohit@gmail.com', '$2y$10$pGfCx4.XivsPRk.lAAm9jeMnC4JfdKBn2GZl4C3JHYK89tjcI1rk6', 'kalanki', '9812312', '5b20d9278085dimages.jpg', 'WMzn4bJKrrcgOE89KqGakJHPD4im59VpWJoD8PdhHKHdmYMZtISGaqk1HW7g', 'FexqJAv93bwBBnohYTbwHOOuhycxNa8K48hNzmAT7qg17YWlrbzTv8ga6yyP', '2018-06-13 08:43:19', '2018-06-13 10:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `per_user_roles`
--

CREATE TABLE `per_user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_user_roles`
--

INSERT INTO `per_user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2018-06-11 00:00:00', '2018-06-13 08:55:16'),
(4, 9, 2, '2018-06-13 08:43:19', '2018-06-13 08:53:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `per_customers`
--
ALTER TABLE `per_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_products`
--
ALTER TABLE `per_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `subcategory_id_2` (`subcategory_id`),
  ADD KEY `subcategory_id_3` (`subcategory_id`);

--
-- Indexes for table `per_product_category`
--
ALTER TABLE `per_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_product_subcategory`
--
ALTER TABLE `per_product_subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `category_id_2` (`category_id`),
  ADD KEY `category_id_3` (`category_id`),
  ADD KEY `category_id_4` (`category_id`);

--
-- Indexes for table `per_purchase`
--
ALTER TABLE `per_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_purchase_invoice`
--
ALTER TABLE `per_purchase_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_roles`
--
ALTER TABLE `per_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_sales`
--
ALTER TABLE `per_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_sales_invoice`
--
ALTER TABLE `per_sales_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_settings`
--
ALTER TABLE `per_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_stock`
--
ALTER TABLE `per_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_superadmin`
--
ALTER TABLE `per_superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_suppliers`
--
ALTER TABLE `per_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_users`
--
ALTER TABLE `per_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_user_roles`
--
ALTER TABLE `per_user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `per_customers`
--
ALTER TABLE `per_customers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `per_products`
--
ALTER TABLE `per_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `per_product_category`
--
ALTER TABLE `per_product_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `per_product_subcategory`
--
ALTER TABLE `per_product_subcategory`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `per_purchase`
--
ALTER TABLE `per_purchase`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `per_purchase_invoice`
--
ALTER TABLE `per_purchase_invoice`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `per_roles`
--
ALTER TABLE `per_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `per_sales`
--
ALTER TABLE `per_sales`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `per_sales_invoice`
--
ALTER TABLE `per_sales_invoice`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `per_settings`
--
ALTER TABLE `per_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `per_stock`
--
ALTER TABLE `per_stock`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `per_superadmin`
--
ALTER TABLE `per_superadmin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `per_suppliers`
--
ALTER TABLE `per_suppliers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `per_users`
--
ALTER TABLE `per_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `per_user_roles`
--
ALTER TABLE `per_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `per_products`
--
ALTER TABLE `per_products`
  ADD CONSTRAINT `FOREIGN_KEY_CONSTRAINT` FOREIGN KEY (`subcategory_id`) REFERENCES `per_product_subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `per_product_subcategory`
--
ALTER TABLE `per_product_subcategory`
  ADD CONSTRAINT `FOREIGN_KEY_CONSTRAINT_SUBCATEGORY` FOREIGN KEY (`category_id`) REFERENCES `per_product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
