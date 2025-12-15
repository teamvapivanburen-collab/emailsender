-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 06:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ig`
--

-- --------------------------------------------------------

--
-- Table structure for table `plan_features`
--

CREATE TABLE `plan_features` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `feature_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_features`
--

INSERT INTO `plan_features` (`id`, `plan_id`, `feature_text`) VALUES
(1, 1, 'Single Pipeline'),
(2, 1, '500 Records'),
(3, 1, 'Basic Support'),
(4, 2, 'Team Pipelines (3)'),
(5, 2, '50,000 Records'),
(6, 2, 'Email Integration'),
(7, 3, 'Team Pipelines (5)'),
(8, 3, '100,000 Records'),
(9, 3, 'Advanced Analytics'),
(10, 3, 'Priority Support'),
(11, 4, 'Everything in Premier'),
(12, 4, 'Unlimited Records'),
(13, 4, 'Dedicated Support'),
(14, 4, 'Advanced Integrations'),
(15, 5, 'f'),
(16, 6, 'bnb'),
(17, 7, 'm'),
(18, 8, '1');

-- --------------------------------------------------------

--
-- Table structure for table `plan_prices`
--

CREATE TABLE `plan_prices` (
  `price_id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `monthly_price` decimal(10,2) DEFAULT 0.00,
  `yearly_price` decimal(10,2) DEFAULT 0.00,
  `price_unit` varchar(50) DEFAULT '/user/month'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_prices`
--

INSERT INTO `plan_prices` (`price_id`, `plan_id`, `monthly_price`, `yearly_price`, `price_unit`) VALUES
(1, 1, '0.00', '0.00', '/user/month'),
(2, 2, '500.00', '400.00', '/user/month'),
(3, 3, '900.00', '720.00', '/user/month'),
(4, 4, '1350.00', '1080.00', '/user/month'),
(5, 5, '5.00', '5.00', '/user/month'),
(6, 6, '2.00', '3.00', '/user/month'),
(7, 7, '5.00', '3.00', '/user/month'),
(8, 8, '500.00', '2.00', '/user/month');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_plans`
--

CREATE TABLE `pricing_plans` (
  `plan_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `plan_name` varchar(100) NOT NULL,
  `is_popular` tinyint(4) DEFAULT 0,
  `button_text` varchar(50) DEFAULT 'Start Free Trial'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing_plans`
--

INSERT INTO `pricing_plans` (`plan_id`, `product_id`, `plan_name`, `is_popular`, `button_text`) VALUES
(1, 1, 'Free', 0, 'Start Free Trial'),
(2, 1, 'Express', 0, 'Start Free Trial'),
(3, 1, 'Premier', 1, 'Start Free Trial'),
(4, 1, 'Bigin 360', 0, 'Start Free Trial'),
(5, 2, 'g', 0, 'gg'),
(6, 2, 'd', 0, '5'),
(7, 2, 'ghh', 0, 'h'),
(8, 2, 'jk', 0, '3');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category`, `logo_url`, `status`, `created_at`) VALUES
(1, 'Bigin – Simple CRM', 'A simple, powerful CRM solution...', 'Sales', 'https://www.zohowebstatic.com/sites/zweb/images/productlogos/sign.svg', 1, '2025-12-04 11:49:18'),
(2, 'fdgfd', 'dfgssd', 'dgffd', 'dfgf', 1, '2025-12-04 12:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `feature_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `feature_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`feature_id`, `product_id`, `icon`, `feature_text`) VALUES
(1, 1, '🗂️', 'Contact & Pipeline Management'),
(2, 1, '⚙️', 'Customizable Deal Stages'),
(3, 1, '📧', 'Email Integration'),
(4, 1, '📆', 'Task & Activity Tracking'),
(5, 1, '📱', 'Mobile Apps (iOS & Android)'),
(6, 2, 'gdfg', 'dgd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plan_features`
--
ALTER TABLE `plan_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `plan_prices`
--
ALTER TABLE `plan_prices`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`feature_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plan_features`
--
ALTER TABLE `plan_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `plan_prices`
--
ALTER TABLE `plan_prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plan_features`
--
ALTER TABLE `plan_features`
  ADD CONSTRAINT `plan_features_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans` (`plan_id`) ON DELETE CASCADE;

--
-- Constraints for table `plan_prices`
--
ALTER TABLE `plan_prices`
  ADD CONSTRAINT `plan_prices_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans` (`plan_id`) ON DELETE CASCADE;

--
-- Constraints for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD CONSTRAINT `pricing_plans_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_features`
--
ALTER TABLE `product_features`
  ADD CONSTRAINT `product_features_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
