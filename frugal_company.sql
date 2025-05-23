-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 19 maj 2025 kl 04:50
-- Serverversion: 8.0.41
-- PHP-version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `frugal_company`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `products_cpu`
--

CREATE TABLE `products_cpu` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `products_cpu`
--

INSERT INTO `products_cpu` (`id`, `title`, `price`, `image_url`) VALUES
(1, 'AMD Ryzen 9 7900X', 400.00, 'newimg/AMDRyzen9-7900XCPU.png'),
(2, 'AMD Ryzen7 5700X', 500.00, 'newimg/AMDRyzen7-5700XCPU.png'),
(3, 'AMD Ryzen 9 9950X', 545.00, 'newimg/AMDRyzen9-9950XCPU.png'),
(4, 'Product 4', 400.00, 'newimg/cpufillers.png'),
(5, 'Product 5', 500.00, 'newimg/cpufillers.png'),
(6, 'Product 6', 545.00, 'newimg/cpufillers.png'),
(7, 'Product 7', 400.00, 'newimg/cpufillers.png'),
(8, 'Product 8', 400.00, 'newimg/cpufillers.png'),
(9, 'Product 9', 500.00, 'newimg/cpufillers.png'),
(10, 'Product 10', 545.00, 'newimg/cpufillers.png'),
(11, 'Product 11', 500.00, 'newimg/cpufillers.png'),
(12, 'Product 12', 545.00, 'newimg/cpufillers.png'),
(13, 'Product 13', 400.00, 'newimg/cpufillers.png'),
(14, 'Product 14', 500.00, 'newimg/cpufillers.png'),
(15, 'Product 15', 545.00, 'newimg/cpufillers.png'),
(16, 'Product 16', 400.00, 'newimg/cpufillers.png'),
(17, 'Product 17', 500.00, 'newimg/cpufillers.png'),
(18, 'Product 18', 545.00, 'newimg/cpufillers.png'),
(19, 'Product 19', 400.00, 'newimg/cpufillers.png'),
(20, 'Product 20', 400.00, 'newimg/cpufillers.png'),
(21, 'Product 21', 500.00, 'newimg/cpufillers.png'),
(22, 'Product 22', 545.00, 'newimg/cpufillers.png'),
(23, 'Product 23', 500.00, 'newimg/cpufillers.png'),
(24, 'Product 24', 545.00, 'newimg/cpufillers.png'),
(25, 'Product 25', 400.00, 'newimg/cpufillers.png'),
(33, 'Product 26', 500.00, 'newimg/cpufillers.png'),
(34, 'Product 28', 545.00, 'newimg/cpufillers.png');

-- --------------------------------------------------------

--
-- Tabellstruktur `products_gpu`
--

CREATE TABLE `products_gpu` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `products_gpu`
--

INSERT INTO `products_gpu` (`id`, `title`, `price`, `image_url`) VALUES
(1, 'RTX 6700 XT', 150.00, 'newimg/radeonrtx6700xtimg1.png'),
(2, 'GEFORCE RTX 3060', 2.00, 'newimg/msigeforcertx3060ventusimg2.png'),
(3, 'RTX 6800 XT', 3.00, 'newimg/radeonrtx6800xtimg3.png'),
(4, 'RTX 7900 XTX', 4.00, 'newimg/saphireradeonrtx7900xtximg4.png'),
(5, 'GEFORCE RTX 4090', 5.00, 'newimg/geforcertx409024gbrogstriximg5.png'),
(6, 'GEFORCE RTX 4080', 6.00, 'newimg/msigeforcertx408016gbimg6.png'),
(7, 'GEFORCE RTX 3060 TI', 7.00, 'newimg/asusdualgeforcertx3060ti8gbimg7.png'),
(8, 'RTX 6700 XT MECH', 8.00, 'newimg/radeonrx6700xtmechimg8.png'),
(9, 'GEFORCE RTX 4080 ULTRA', 9.00, 'newimg/asusgeforcertx408016gbimg9.png'),
(10, 'GEFORCE RTX 4080V', 10.00, 'newimg/asusgeforcertx408016gbimg10.png'),
(11, 'Product 11', 10.00, 'newimg/gpufillers.png'),
(12, 'Product 12', 12.00, 'newimg/gpufillers.png'),
(13, 'Product 13', 2.00, 'newimg/gpufillers.png'),
(14, 'Product 14', 3.00, 'newimg/gpufillers.png'),
(15, 'Product 15', 4.00, 'newimg/gpufillers.png'),
(16, 'Product 16', 5.00, 'newimg/gpufillers.png'),
(17, 'Product 17', 6.00, 'newimg/gpufillers.png'),
(18, 'Product 18', 7.00, 'newimg/gpufillers.png'),
(19, 'Product 19', 8.00, 'newimg/gpufillers.png'),
(20, 'Product 20', 9.00, 'newimg/gpufillers.png'),
(21, 'Product 21', 10.00, 'newimg/gpufillers.png'),
(22, 'Product 22', 10.00, 'newimg/gpufillers.png'),
(23, 'Product 23', 10.00, 'newimg/gpufillers.png'),
(24, 'Product 24', 12.00, 'newimg/gpufillers.png'),
(25, 'Product 25', 2.00, 'newimg/gpufillers.png'),
(26, 'Product 26', 3.00, 'newimg/gpufillers.png'),
(27, 'Product 27', 4.00, 'newimg/gpufillers.png'),
(28, 'Product 28', 5.00, 'newimg/gpufillers.png'),
(29, 'Product 29', 6.00, 'newimg/gpufillers.png'),
(30, 'Product 30', 7.00, 'newimg/gpufillers.png'),
(31, 'Product 31', 8.00, 'newimg/gpufillers.png'),
(32, 'Product 32', 9.00, 'newimg/gpufillers.png'),
(33, 'Product 33', 10.00, 'newimg/gpufillers.png'),
(34, 'Product 34', 10.00, 'newimg/gpufillers.png'),
(35, 'Product 35', 7.00, 'newimg/gpufillers.png'),
(36, 'Product 36', 8.00, 'newimg/gpufillers.png'),
(37, 'Product 37', 9.00, 'newimg/gpufillers.png'),
(38, 'Product 38', 10.00, 'newimg/gpufillers.png'),
(39, 'Product 39', 10.00, 'newimg/gpufillers.png'),
(40, 'Product 40', 7.00, 'newimg/gpufillers.png'),
(41, 'Product 41', 8.00, 'newimg/gpufillers.png'),
(42, 'Product 42', 9.00, 'newimg/gpufillers.png'),
(43, 'Product 43', 10.00, 'newimg/gpufillers.png'),
(44, 'Product 44', 10.00, 'newimg/gpufillers.png'),
(45, 'Product 45', 7.00, 'newimg/gpufillers.png'),
(46, 'Product 46', 8.00, 'newimg/gpufillers.png'),
(47, 'Product 47', 9.00, 'newimg/gpufillers.png'),
(48, 'Product 48', 10.00, 'newimg/gpufillers.png'),
(49, 'Product 49', 10.00, 'newimg/gpufillers.png'),
(50, 'Product 50', 9.00, 'newimg/gpufillers.png'),
(51, 'Product 51', 10.00, 'newimg/gpufillers.png'),
(52, 'Product 52', 10.00, 'newimg/gpufillers.png'),
(53, 'Product 53', 10.00, 'newimg/gpufillers.png'),
(54, 'Product 54', 12.00, 'newimg/gpufillers.png'),
(55, 'Product 55', 2.00, 'newimg/gpufillers.png'),
(56, 'Product 56', 3.00, 'newimg/gpufillers.png'),
(57, 'Product 57', 4.00, 'newimg/gpufillers.png'),
(58, 'Product 58', 5.00, 'newimg/gpufillers.png'),
(59, 'Product 59', 6.00, 'newimg/gpufillers.png'),
(60, 'Product 60', 7.00, 'newimg/gpufillers.png'),
(61, 'Product 61', 8.00, 'newimg/gpufillers.png'),
(62, 'Product 62', 9.00, 'newimg/gpufillers.png'),
(63, 'Product 63', 10.00, 'newimg/gpufillers.png'),
(64, 'Product 64', 10.00, 'newimg/gpufillers.png'),
(65, 'Product 65', 7.00, 'newimg/gpufillers.png'),
(66, 'Product 66', 8.00, 'newimg/gpufillers.png'),
(67, 'Product 67', 9.00, 'newimg/gpufillers.png'),
(68, 'Product 68', 10.00, 'newimg/gpufillers.png'),
(69, 'Product 69', 10.00, 'newimg/gpufillers.png'),
(70, 'Product 70', 7.00, 'newimg/gpufillers.png'),
(71, 'Product 71', 8.00, 'newimg/gpufillers.png'),
(72, 'Product 72', 9.00, 'newimg/gpufillers.png'),
(73, 'Product 73', 10.00, 'newimg/gpufillers.png'),
(74, 'Product 74', 10.00, 'newimg/gpufillers.png'),
(75, 'Product 75', 7.00, 'newimg/gpufillers.png'),
(76, 'Product 76', 8.00, 'newimg/gpufillers.png'),
(77, 'Product 77', 9.00, 'newimg/gpufillers.png'),
(78, 'Product 78', 10.00, 'newimg/gpufillers.png'),
(79, 'Product 79', 10.00, 'newimg/gpufillers.png');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `products_cpu`
--
ALTER TABLE `products_cpu`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products_gpu`
--
ALTER TABLE `products_gpu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `products_cpu`
--
ALTER TABLE `products_cpu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT för tabell `products_gpu`
--
ALTER TABLE `products_gpu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
