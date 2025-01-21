-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 09:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lunchbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(99) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone`, `address`, `date`) VALUES
(32, 'Ashwani Hada', 'ashwanihada00@gmail.com', 9785199922, 'b-20 kota Rajasthan', '2025-01-11 15:51:44'),
(33, 'Rahul kumar sharma', 'rahul@123gmail.com', 9199292919, 'c-22 ,kg road , kota', '2025-01-11 15:52:42'),
(34, 'sumit', 'rg@gmail.com', 999292992, 'b39-kota', '2025-01-21 13:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` int(200) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `date`, `category`, `amount`, `description`) VALUES
(8, '2025-01-09', 'Vegitable', 30, 'Extra Vegitables');

-- --------------------------------------------------------

--
-- Table structure for table `tiffinorder`
--

CREATE TABLE `tiffinorder` (
  `id` int(99) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `mealtime` varchar(255) NOT NULL,
  `tiffinname` varchar(255) NOT NULL,
  `tiffinprice` varchar(255) NOT NULL,
  `tiffincount` int(255) NOT NULL,
  `amount` int(99) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiffinorder`
--

INSERT INTO `tiffinorder` (`id`, `customer`, `date`, `mealtime`, `tiffinname`, `tiffinprice`, `tiffincount`, `amount`, `status`) VALUES
(38, 'Ashwani Hada', '2025-01-11', 'Lunch', 'Maharaja', '150', 2, 300, 'Delivered'),
(39, 'Rahul kumar sharma', '2025-01-21', 'Lunch', 'Special Vr 2', '200', 1, 200, 'Delivered'),
(40, 'sumit', '2025-01-21', 'Lunch', 'sunday special', '299', 2, 598, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `tiffintype`
--

CREATE TABLE `tiffintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(99) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiffintype`
--

INSERT INTO `tiffintype` (`id`, `name`, `price`, `date`) VALUES
(7, 'Special', 100, '2025-01-11 15:50:33'),
(8, 'Maharaja', 150, '2025-01-11 15:50:47'),
(9, 'Special Vr 2', 200, '2025-01-21 12:00:20'),
(10, 'sunday special', 299, '2025-01-21 13:13:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiffinorder`
--
ALTER TABLE `tiffinorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiffintype`
--
ALTER TABLE `tiffintype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tiffinorder`
--
ALTER TABLE `tiffinorder`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tiffintype`
--
ALTER TABLE `tiffintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
