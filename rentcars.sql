-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 04:23 PM
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
-- Database: `rentcars`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency_acc`
--

CREATE TABLE `agency_acc` (
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency_acc`
--

INSERT INTO `agency_acc` (`email`, `password`, `contact`, `created_on`) VALUES
('priyanshusaini1102@gmail.com', '$2y$10$9t8PBV6Vd60qqY93ZIf3oOpY3QOxvb0a1dVQQjCNV4K3AC0D5Mpmm', '7017413590', '2024-03-11 11:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `agency_mail` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rentperday` int(20) DEFAULT NULL,
  `number` int(30) DEFAULT NULL,
  `capacity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_mail` varchar(255) DEFAULT NULL,
  `startdate` varchar(255) DEFAULT NULL,
  `noofdays` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `agency_mail`, `image`, `rentperday`, `number`, `capacity`, `created_at`, `updated_at`, `user_mail`, `startdate`, `noofdays`) VALUES
(1, 'Kia Sonet', 'priyanshusaini1102@gmail.com', 'kiaSonet.jpg', 321, 123, '4', '2024-03-11 14:56:50', '2024-03-11 14:56:50', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_acc`
--

CREATE TABLE `user_acc` (
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_acc`
--

INSERT INTO `user_acc` (`email`, `password`, `contact`, `created_on`) VALUES
('priyanshusaini1102@gmail.com', '$2y$10$K0IQCZHwC5UCe9HOVP59ZegsaoDuqyOrIvB1cLpX/txo.EQQzesO2', '7017413590', '2024-03-11 12:01:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency_acc`
--
ALTER TABLE `agency_acc`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `user_acc`
--
ALTER TABLE `user_acc`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
