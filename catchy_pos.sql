-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 04:30 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

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
(1, 'BJ100', 9, '2018-06-01 06:07:38', '2020-06-10 02:23:17'),
(2, 'BRJ200', 2, '2018-06-01 06:07:38', '2020-06-10 02:26:27'),
(3, 'LG GL-B292', 3, '2018-06-01 06:07:38', '2018-06-14 06:22:40'),
(4, 'MIG10', 28, '2018-06-01 06:07:38', '2020-06-10 02:00:26'),
(5, 'RMJ100', 0, '2018-06-04 06:47:32', '2020-06-10 02:10:31'),
(6, 'TSHIRTMENS', 36, '2018-06-04 06:47:32', '2020-06-10 02:28:15'),
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
(1, 'Catchy Road', 'admin@admin.com', '$2y$10$ts2AA2nJGZI4XfvTgsNLzOlNIWQpuPX3W8LNC7tXHUoE6WxzRX6Za', 'Kalimati', 'kalimati', '4488542', 'images.png', 'Acr9pfeYS10iGoubdYpRWPFSHeaLyy4qcK8ky1JhYd1VZlr6GI3vVyEHYzaN', 'mJUhf2YAVekfhZrbweQJXv4WKfpDR5VwPZwE4AyJ6l3NjKVH2NWZgCT7ulsp', '2018-05-06 09:35:36', '2018-06-13 10:46:49');

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `per_purchase_invoice`
--
ALTER TABLE `per_purchase_invoice`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `per_roles`
--
ALTER TABLE `per_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `per_sales`
--
ALTER TABLE `per_sales`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `per_sales_invoice`
--
ALTER TABLE `per_sales_invoice`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
