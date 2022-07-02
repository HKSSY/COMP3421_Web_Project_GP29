-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2022 at 02:03 AM
-- Server version: 10.3.32-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp3421_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `self_description` varchar(800) DEFAULT NULL,
  `permission` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `nickname`, `password`, `email`, `dob`, `gender`, `self_description`, `permission`) VALUES
(1, 'test', '$2y$10$KzAzZSgk3yzX.6z6mbVupOYuo4A3l5iZ7.m5EurUar..CKvcW43rW', 'test@test.com', '2000-01-01', 'Male', 'Hello world', 1),
(41, 'may', '$2y$10$inzt8ACqLVLramE9TAU4Pe2jTFfOI5BUWhH0QR4b7hGj96uZbciN.', 'may@test.com', '2005-07-20', 'Female', 'LOL', 0),
(42, 'test99', '$2y$10$zxMPBvU7Tbyu4cyyTaT1a.SuCHKcllcfLnovEgOMzwm7lOMtt8yTi', 'test99@test.com', '2006-02-07', 'Male', 'dfgdfgdfgfdg', 0),
(43, 'tom', '$2y$10$oJzRrRnILWyez53x7m10OOqVi0er.tQZCP/dPQTe4jeeY8ktKk5DK', 'tom@tom.com', '2005-08-16', 'Male', NULL, 0),
(44, '<script>alert(\"XSS attack test\");</script>', '$2y$10$0IYRBCdPg6Hacis5dsF5q.iDTmiT235/zU8chwqbjNV1ubnq6OlFu', 'script@test.com', '2006-02-07', 'Male', '<script>alert(\"XSS attack test\");</script>', 0),
(46, 'admin', '$2y$10$7Q7X5MFrzczUeQPyuczKIOWwSXYOQ4AtaMDiliUfhkzTGO8usKoV2', 'sdfsds@yahoo.com.hk', '2006-03-27', 'Male', '8964\r\n', 0),
(47, 'test', '$2y$10$sJupXH4.YzMLBtLhLUrOC.xO2KhArdHyo8CIG23Af.kk1/hNM5HuK', 'hello@test.com', '2006-03-29', 'Male', NULL, 0),
(48, 'root1', '$2y$10$QcvzXZ0eB3/jpRQsee1aGuyiyVJjjIT2gl9Ie4OyTV9Nj7AcYRiDy', 'root@yahoo.com.hk', '2001-02-07', 'Male', NULL, 1),
(49, 'root2', '$2y$10$wfkyKAp/vkAtEYZ/0Ex2v.3DUumF7KxKMEvxaD1hN9oSNLG7zq2fe', 'root2@yahoo.com.hk', '2002-02-20', 'Male', NULL, 0),
(50, 'root3', '$2y$10$el3xRWTJ6QO01JMsUwhCFu/X8NDTwsjUHeET/v2RxRSFbwjuYP9ku', 'dsafs@yahoo.com.hk', '2002-07-24', 'Male', NULL, 0),
(51, 'testing', '$2y$10$6.XOsXnN4h5jfQfb7j.sHO7WYK6Xqz/JaWlZ0Cmh1nvRfEgCrSO8a', 'testing@test.com', '2006-04-05', 'Female', NULL, 0),
(52, 'Oscar Ng', '$2y$10$qyecT0iauneLmfJl0j.oZeCcUIyMdWMwU4zCH.4RKsXPAaCDS8c/y', 'ngoscar9008@gmail.com', '2006-04-04', 'Male', NULL, 0),
(53, '<script>alert(\"hacked!!!\");</script>', '$2y$10$K1iUUMlvMq0i283c8EKaQOvrPdr1I9DnbVWnbyP7fZd0zE8YU9YGy', 'ngoscar8009@gmail.com', '2006-04-04', 'Male', NULL, 0),
(54, 'ben', '$2y$10$kEU3NeTKV1fq7GOQP6Bk2.XNHngapqYVAVTTKnG5Io67nsR.T7f0m', 'ben@gmail.com', '2004-12-31', 'Male', NULL, 0),
(56, 'alex', '$2y$10$I0AlUjBNRul2YrWKp4Bug.ajzhn1h465/HGSEQbr.Rta0m21tCPKq', 'alex@test.com', '2006-04-19', 'Male', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(1, 'MSI PRO B660M-A WIFI', 'The PRO B660M-A WIFI is a business-oriented micro-ATX motherboard featuring the latest Intel B660 chipset with Core Boost.', '1180.00', '1199.00', 45, 'product_items/1649773711board.png', '2022-04-10 22:14:22'),
(2, 'Samsung 32\" M8 Samsung Smart Monitor (2022)', NULL, '6300.00', '6480.00', 21, 'product_items/1649773546hk-smart-m8-32m80b-ls32bm801ucxxk-531180500.png', '2022-04-10 18:52:49'),
(3, 'ASUS RT-AX55 AX1800 Dual Band WiFi 6 Router', 'AX1800 Dual Band WiFi 6 (802.11ax) Router supporting MU-MIMO and OFDMA technology, with AiProtection Classic network security powered by Trend Micro™, compatible with ASUS AiMesh WiFi system.', '799.00', '0.00', 80, 'product_items/164977335912105766-12105766.webp', '2022-04-11 01:15:43'),
(7, 'MSI GeForce RTX 3090 GAMING X TRIO 24G', NULL, '14370.00', '20000.00', 8944, 'product_items/1649616313470492_kjuzpp_0.webp', '2022-04-11 02:45:12'),
(8, 'Intel Core i7-12700K', NULL, '3260.00', '4000.00', 12, 'product_items/1649755930QGvIgQr.png', '2022-04-11 13:48:41'),
(13, 'Gigabyte Radeon RX 6900 XT GAMING OC 16G', 'The Radeon RX 6900 XT is now AMD\'s fastest GPU.', '10999.00', '9000.00', 2, 'product_items/16497702241000.png', '2022-04-12 05:45:26'),
(14, 'AMD Ryzen 9 5950X', 'CPU Cores: 16', '5200.00', '6232.20', 721, 'product_items/1649769227Ryzen-9-5950X-16-Co-12275124.jpg', '2022-04-12 21:13:47'),
(15, 'Fractal Design Torrent Compact E-ATX Case', 'The Torrent Compact is built to air cool your compact build as efficiently as possible through an open front grille and two of our 180 x 38 mm Dynamic PWM fans (Prisma for RGB version), making it a perfect fit for air cooling aficionados looking for a compact case.', '1040.00', '1200.00', 5, 'product_items/1649778126Torrent_Compact_Black_RGB_TGL_1-Left-Front.webp', '2022-04-12 23:42:05'),
(16, 'ASUS ROG-STRIX-1000G 1000W PSU', 'The ROG Strix 1000W Gold PSU brings premium cooling performance to the mainstream with ROG Heatsinks and Axial-tech fan design.', '1450.00', '1649.00', 80, 'product_items/1649784959469506_funh3o_0.webp', '2022-04-13 01:35:59'),
(21, 'ROG-Strix-LC-RTX3090Ti-O24G-Gaming price', 'GPU', '21000.00', '19990.00', 99, 'product_items/1649959265NVIDIA-ASUS-ROG-Strix-LC-GeForce-RTX-3090-Ti-24G-OC-Graphics-Card-rog-strix-lc-rtx3090ti-o24g-gaming-model.jpg', '2022-04-15 02:01:05'),
(23, '49\" Odyssey Neo G9 Gaming DQHD Quantum Mini-LED Monitor', 'Nice monitor!', '18999.00', '18999.00', 200, 'product_items/1649961493Samsung_Odyssey_Neo_G920.jpg', '2022-04-15 02:38:13'),
(24, ' The Picaroons', 'Welcome Aboaard ! Here be The Picaroons.', '100.00', '100.00', 99, 'product_items/1650385143VvNhMb0.jpg', '2022-04-20 00:19:02'),
(25, 'The Picaroons', 'Windows XP', '100.00', '100.00', 99, 'product_items/1650387613VvNhMb0.jpg', '2022-04-20 01:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(35) NOT NULL,
  `description` varchar(45) NOT NULL,
  `filepath` text NOT NULL,
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp(),
  `profile_image` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_images`
--

INSERT INTO `profile_images` (`id`, `userid`, `title`, `description`, `filepath`, `uploaded_date`, `profile_image`) VALUES
(1, 1, '', '', 'profile_image/1649931245VvNhMb0.jpg', '2022-04-14 18:14:04', 1),
(19, 44, '', '', 'profile_image/1649528859Tehurn-1483160975255773192-img1.jpg', '2022-04-10 02:27:38', 1),
(20, 52, '<script>alert(\"ha!\");</script>', '<script>alert(\"hacked!!!\");</script>', 'profile_image/16496161881.png', '2022-04-11 02:43:07', 1),
(22, 56, '', '', 'profile_image/1650387810Picarons.jpg', '2022-04-20 01:03:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_record`
--

CREATE TABLE `sales_record` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` decimal(7,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_record`
--

INSERT INTO `sales_record` (`id`, `product_id`, `product_name`, `product_price`, `user_id`, `date_added`) VALUES
(4, 13, 'Sam', '153.00', 48, '2022-04-12 21:12:44'),
(5, 8, 'Intel Core i7-12700K', '3260.00', 48, '2022-04-12 21:31:13'),
(6, 13, 'Gigabyte Radeon RX 6900 XT GAMING OC 16G', '10999.00', 1, '2022-04-12 21:46:26'),
(7, 15, 'Fractal Design Torrent Compact E-ATX Case', '1040.00', 54, '2022-04-14 02:05:01'),
(8, 15, 'Fractal Design Torrent Compact E-ATX Case', '1040.00', 54, '2022-04-14 17:25:59'),
(9, 15, 'Fractal Design Torrent Compact E-ATX Case', '1040.00', 1, '2022-04-14 19:07:11'),
(10, 13, 'Gigabyte Radeon RX 6900 XT GAMING OC 16G', '10999.00', 48, '2022-04-15 01:43:04'),
(11, 13, 'Gigabyte Radeon RX 6900 XT GAMING OC 16G', '10999.00', 48, '2022-04-15 02:31:12'),
(12, 15, 'Fractal Design Torrent Compact E-ATX Case', '1040.00', 48, '2022-04-15 02:31:12'),
(13, 15, 'Fractal Design Torrent Compact E-ATX Case', '1040.00', 48, '2022-04-15 02:38:29'),
(14, 23, '49\" Odyssey Neo G9 Gaming DQHD Quantum Mini-LED Monitor', '18999.00', 1, '2022-04-18 00:59:26'),
(15, 16, 'ASUS ROG-STRIX-1000G 1000W PSU', '1450.00', 1, '2022-04-18 01:00:35'),
(16, 21, 'ROG-Strix-LC-RTX3090Ti-O24G-Gaming price', '21000.00', 1, '2022-04-19 19:03:19'),
(18, 25, 'The Picaroons', '100.00', 56, '2022-04-20 01:04:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_record`
--
ALTER TABLE `sales_record`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sales_record`
--
ALTER TABLE `sales_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`userid`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
