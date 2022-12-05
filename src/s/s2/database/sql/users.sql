-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 09:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ztech`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'student',
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gowns` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not issued',
  `gown` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `finance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `lib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `cert_i` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not issued',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `number`, `email`, `code`, `admission`, `email_verified_at`, `password`, `remember_token`, `gowns`, `gown`, `finance`, `lib`, `cert_i`, `created_at`, `updated_at`) VALUES
(1, 'name', 'admin', '0713772837', 'admin@gmail.com', NULL, 'pending', NULL, '$2y$10$KROhVAaEdZhKkkHIjRiG2.G5rUZ29uwYDse0RAMujF7LXnKakTYvq', NULL, '', 'false', 'false', 'false', 'not issued', '2022-08-17 05:39:08', '2022-08-18 07:22:21'),
(2, 'name', 'finance', NULL, 'finance@gmail.com', NULL, 'admitted', NULL, '$2y$10$2KYQSuve3XW0xw9h56MRBe1P5sGRekOFR1zRvBaBBndHCrZrclvFK', NULL, '', 'false', 'false', 'false', 'not issued', '2022-08-17 06:09:19', '2022-08-19 15:34:25'),
(3, 'name', 'hod', NULL, 'hod@gmail.com', NULL, 'admitted', NULL, '$2y$10$OjUeZyMrta3eMy/4CK4lZ.agZYT6ioPFHy1J6HEwYhkt676uvymJy', NULL, '', 'false', 'false', 'false', 'not issued', '2022-08-17 06:09:30', '2022-08-19 15:34:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
