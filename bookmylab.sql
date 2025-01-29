-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2025 at 01:09 PM
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
-- Database: `bookmylab`
--

-- --------------------------------------------------------

--
-- Table structure for table `franchises`
--

CREATE TABLE `franchises` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `tier` enum('gold','diamond','','') NOT NULL,
  `wallet_balance` int(255) NOT NULL,
  `parent_franchise_id` int(10) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `franchises`
--

INSERT INTO `franchises` (`id`, `username`, `email`, `password`, `tier`, `wallet_balance`, `parent_franchise_id`, `created_at`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$5MFQjECvNsN/k3ANg6JSRejPgiHVFqAWocTOKkGUCjEckx1KxuSjO', 'gold', 0, 0, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `recharge_requests`
--

CREATE TABLE `recharge_requests` (
  `id` int(10) NOT NULL,
  `franchise_id` int(10) NOT NULL,
  `amount` int(255) DEFAULT 0,
  `upi_reference` int(255) NOT NULL,
  `attachments` text NOT NULL,
  `status` enum('pending','approved','rejected','') NOT NULL DEFAULT 'pending',
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recharge_requests`
--

INSERT INTO `recharge_requests` (`id`, `franchise_id`, `amount`, `upi_reference`, `attachments`, `status`, `created_at`) VALUES
(2, 1, 5000, 12, '', 'approved', '0000-00-00 00:00:00.000000'),
(3, 1, 4000, 12, '', 'approved', '0000-00-00 00:00:00.000000'),
(4, 1, 4567, 1234, '', 'pending', '2025-01-27 13:31:39.000000'),
(5, 1, 4567, 1234, '', 'pending', '2025-01-27 13:31:53.000000'),
(6, 1, 9000, 90, '', 'approved', '2025-01-27 21:14:55.000000'),
(8, 1, 4567, 3456, '', 'pending', '2025-01-29 16:39:11.000000'),
(9, 1, 9000, 90, 'chat-img2.jpg', 'pending', '2025-01-29 17:02:26.000000');

-- --------------------------------------------------------

--
-- Table structure for table `test_requests`
--

CREATE TABLE `test_requests` (
  `id` int(10) NOT NULL,
  `franchise_id` int(10) NOT NULL,
  `name` text NOT NULL,
  `age` int(255) NOT NULL,
  `gender` enum('male','female','','') NOT NULL,
  `mobile` int(10) NOT NULL,
  `city` text NOT NULL,
  `selected_test` text NOT NULL,
  `dispatch_option` enum('sample_drawn','home_collection','','') NOT NULL,
  `sample_drawn_date` date NOT NULL,
  `sample_drawn_time` time(6) NOT NULL,
  `fasting_status` tinyint(1) NOT NULL,
  `reference_doctor` text NOT NULL,
  `attachments` text NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `usertype` text NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `franchises`
--
ALTER TABLE `franchises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `recharge_requests`
--
ALTER TABLE `recharge_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_requests`
--
ALTER TABLE `test_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `franchises`
--
ALTER TABLE `franchises`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recharge_requests`
--
ALTER TABLE `recharge_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `test_requests`
--
ALTER TABLE `test_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
