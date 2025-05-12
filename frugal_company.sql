-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2025 at 06:17 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frugal_company`
--

-- --------------------------------------------------------

--
-- Table structure for table `products_cpu`
--

CREATE TABLE `products_cpu` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_cpu`
--

INSERT INTO `products_cpu` (`id`, `title`, `price`, `image_url`) VALUES
(1, 'AMD Ryzen 9 7900X', '400.00', 'newimg/AMDRyzen9-7900XCPU.png'),
(2, 'AMD Ryzen7 5700X', '500.00', 'newimg/AMDRyzen7-5700XCPU.png'),
(12, 'AMD Ryzen 9 9950X', '545.00', 'newimg/AMDRyzen9-9950XCPU.png');

-- --------------------------------------------------------

--
-- Table structure for table `products_gpu`
--

CREATE TABLE `products_gpu` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_gpu`
--

INSERT INTO `products_gpu` (`id`, `title`, `price`, `image_url`) VALUES
(1, 'RTX 6700 XT', '150.00', 'newimg/radeonrtx6700xtimg1.png'),
(2, 'GEFORCE RTX 3060', '2.00', 'newimg/msigeforcertx3060ventusimg2.png'),
(3, 'RTX 6800 XT', '3.00', 'newimg/radeonrtx6800xtimg3.png'),
(4, 'RTX 7900 XTX', '4.00', 'newimg/saphireradeonrtx7900xtximg4.png'),
(5, 'GEFORCE RTX 4090', '5.00', 'newimg/geforcertx409024gbrogstriximg5.png'),
(6, 'GEFORCE RTX 4080', '6.00', 'newimg/msigeforcertx408016gbimg6.png'),
(7, 'GEFORCE RTX 3060 TI', '7.00', 'newimg/asusdualgeforcertx3060ti8gbimg7.png'),
(8, 'RTX 6700 XT MECH', '8.00', 'newimg/radeonrx6700xtmechimg8.png'),
(9, 'GEFORCE RTX 4080 ULTRA', '9.00', 'newimg/asusgeforcertx408016gbimg9.png'),
(10, 'GEFORCE RTX 4080V', '10.00', 'newimg/asusgeforcertx408016gbimg10.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_cpu`
--
ALTER TABLE `products_cpu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_gpu`
--
ALTER TABLE `products_gpu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_cpu`
--
ALTER TABLE `products_cpu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products_gpu`
--
ALTER TABLE `products_gpu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
