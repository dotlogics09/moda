-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 06:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moda`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_image`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Sweat Shirt', '1670517345.jpg', 1, '2022-11-21 17:48:30', '2022-12-08 16:35:45'),
(8, 'Jeans', '1670517358.jpg', 1, '2022-11-21 17:49:17', '2022-12-08 16:35:58'),
(9, 'T Shirt', '1670517375.webp', 1, '2022-11-21 17:49:35', '2022-12-08 16:36:15'),
(10, 'Shoes', '1671122411.jpg', 1, '2022-11-21 17:49:54', '2022-12-15 16:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_title` varchar(255) NOT NULL,
  `coupon_code` varchar(155) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `use_limit` int(5) NOT NULL,
  `discount_type` enum('percentage','amount') NOT NULL,
  `amount_percentage` decimal(10,2) NOT NULL,
  `minimum_purc_amt` decimal(10,2) NOT NULL,
  `days` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('active','inactive','expired') NOT NULL DEFAULT 'inactive',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `subcategory_id` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `net_price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `discount_type` enum('percentage','amount') DEFAULT NULL,
  `product_image` text NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `subcategory_id`, `price`, `net_price`, `discounted_price`, `discount`, `discount_type`, `product_image`, `product_description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Roadster Slim Fit Jeans', 8, 4, '349.00', '317.59', '31.41', '9', 'percentage', '1671295906.jpg', 'Roadster Jeans', 1, 1, '2022-12-17 16:51:46', '2022-12-19 14:38:34'),
(2, 'Bikerz Hoodie', 7, 5, '1000.00', '800.00', '800.00', '200', 'amount', '1671460907.jpg', 'Bikerz Hoodie', 1, 1, '2022-12-19 14:41:47', '2022-12-19 14:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(155) NOT NULL,
  `subcategory_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `subcategory_name`, `subcategory_image`, `status`, `created_at`, `updated_at`) VALUES
(4, 8, 'Damaged Jeans', '1671122466.jpg', 1, '2022-11-24 15:04:18', '2022-12-15 16:41:24'),
(5, 7, 'Hoodie', '1671460813.jpg', 1, '2022-12-19 14:40:13', '2022-12-19 14:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(155) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Anuj Singh', 'anuj@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'User', 1, '2022-11-13 08:11:36', '2022-11-13 08:11:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
