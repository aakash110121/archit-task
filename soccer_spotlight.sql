-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 02:30 PM
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
-- Database: `soccer_spotlight`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned_user`
--

CREATE TABLE `banned_user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 1,
  `isAuthenticated` int(11) NOT NULL DEFAULT 0,
  `image_path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `deleted`, `isAuthenticated`, `image_path`) VALUES
(99, 'archit', 'verma', 'archit.avology@gmail.com', '6239763288', '$2y$10$HHsX9a8fwr5rb6K69N3aY.xp3wt9V5KNUm37c/PjOKJzU6b9qjndG', 1, 1, 'assets/uploads/$sign.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `mail_subscribers`
--

CREATE TABLE `mail_subscribers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail_subscribers`
--

INSERT INTO `mail_subscribers` (`id`, `name`, `email`, `createdAt`) VALUES
(43, 'archit verma', 'architv2023@gmail.com', '2024-11-26 08:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `otp_detail`
--

CREATE TABLE `otp_detail` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `otp` varchar(8) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_detail`
--

INSERT INTO `otp_detail` (`id`, `email`, `otp`, `createdAt`) VALUES
(35, 'archit.avology@gmail.com', '45637247', '2024-11-29 07:01:48'),
(36, 'architv18@gmail.com', '86720453', '2024-11-27 04:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `token`) VALUES
(19, 'archit.avology@gmail.com', '6732ff7c6dd4c'),
(20, 'archit.avology@gmail.com', '76f647e83a7cc'),
(21, 'archit.avology@gmail.com', '23e67460ef8ec');

-- --------------------------------------------------------

--
-- Table structure for table `spam_logs`
--

CREATE TABLE `spam_logs` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spam_logs`
--

INSERT INTO `spam_logs` (`id`, `email`, `submit_time`) VALUES
(469, 'architv2023@gmail.com', '2024-11-26 08:55:43'),
(470, 'architv2023@gmail.com', '2024-11-26 09:00:24'),
(471, 'architv2023@gmail.com', '2024-11-26 09:03:23'),
(472, 'architv2023@gmail.com', '2024-11-26 09:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_ban_count`
--

CREATE TABLE `user_ban_count` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ban_count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ban_count`
--

INSERT INTO `user_ban_count` (`id`, `email`, `ban_count`) VALUES
(57, 'archit.avology@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wrong_pass_banned`
--

CREATE TABLE `wrong_pass_banned` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wrong_pass_logs`
--

CREATE TABLE `wrong_pass_logs` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned_user`
--
ALTER TABLE `banned_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_subscribers`
--
ALTER TABLE `mail_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_detail`
--
ALTER TABLE `otp_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spam_logs`
--
ALTER TABLE `spam_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_ban_count`
--
ALTER TABLE `user_ban_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wrong_pass_banned`
--
ALTER TABLE `wrong_pass_banned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wrong_pass_logs`
--
ALTER TABLE `wrong_pass_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banned_user`
--
ALTER TABLE `banned_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `mail_subscribers`
--
ALTER TABLE `mail_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `otp_detail`
--
ALTER TABLE `otp_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `spam_logs`
--
ALTER TABLE `spam_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=473;

--
-- AUTO_INCREMENT for table `user_ban_count`
--
ALTER TABLE `user_ban_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `wrong_pass_banned`
--
ALTER TABLE `wrong_pass_banned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `wrong_pass_logs`
--
ALTER TABLE `wrong_pass_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
