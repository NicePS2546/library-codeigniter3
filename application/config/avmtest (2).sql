-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 10:02 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avmtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbn_admin`
--

CREATE TABLE `tbn_admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `admin_status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbn_admin`
--

INSERT INTO `tbn_admin` (`admin_id`, `user_id`, `admin_status`, `admin_desc`) VALUES
(1, '654230003', 1, NULL),
(2, 'keng_milkcafe', 1, NULL),
(3, '654230015', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbn_music_reserv`
--

CREATE TABLE `tbn_music_reserv` (
  `reserv_id` int(11) NOT NULL,
  `st_id` varchar(70) NOT NULL,
  `r_id` int(11) NOT NULL,
  `total_pp` int(3) NOT NULL,
  `start_time` time NOT NULL,
  `exp_time` time NOT NULL,
  `r_date` date NOT NULL,
  `r_status` enum('actived','expired') NOT NULL DEFAULT 'actived',
  `r_verify` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_music_reserv`
--

INSERT INTO `tbn_music_reserv` (`reserv_id`, `st_id`, `r_id`, `total_pp`, `start_time`, `exp_time`, `r_date`, `r_status`, `r_verify`, `created_at`, `update_at`) VALUES
(1, '101', 3, 4, '09:00:00', '10:00:00', '2025-01-12', 'expired', 0, '2025-01-12 17:49:16', '2025-01-12 17:49:16'),
(2, '101', 3, 4, '10:00:00', '11:00:00', '2025-01-12', 'expired', 0, '2025-01-12 18:04:25', '2025-01-12 18:04:25'),
(3, '654', 3, 4, '11:00:00', '12:00:00', '2025-01-13', 'expired', 0, '2025-01-13 18:56:23', '2025-01-13 18:56:23'),
(4, '654230015', 3, 7, '09:00:00', '10:00:00', '2025-01-13', 'expired', 0, '2025-01-13 18:57:33', '2025-01-13 18:57:33'),
(5, '654230015', 2, 5, '09:00:00', '10:00:00', '2025-01-14', 'expired', 0, '2025-01-14 18:53:54', '2025-01-14 18:53:54'),
(6, '654230015', 3, 5, '09:00:00', '10:00:00', '2025-01-14', 'expired', 0, '2025-01-14 19:02:00', '2025-01-14 19:02:00'),
(7, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-01-15', 'expired', 0, '2025-01-15 01:07:44', '2025-01-15 01:07:44'),
(8, '654', 3, 5, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 01:59:12', '2025-01-15 01:59:12'),
(9, '6542300', 2, 5, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 02:16:04', '2025-01-15 02:16:04'),
(10, '654', 2, 5, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 02:17:10', '2025-01-15 02:17:10'),
(11, '0', 2, 5, '14:00:00', '15:00:00', '2025-01-15', 'expired', 0, '2025-01-15 02:18:26', '2025-01-15 02:18:26'),
(12, '654', 2, 4, '15:00:00', '16:00:00', '2025-01-15', 'expired', 0, '2025-01-15 02:22:09', '2025-01-15 02:22:09'),
(13, '654', 2, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 20:39:45', '2025-01-15 20:39:45'),
(14, '6540', 2, 4, '14:00:00', '15:00:00', '2025-01-15', 'expired', 0, '2025-01-15 20:40:21', '2025-01-15 20:40:21'),
(15, '6544', 2, 6, '12:00:00', '13:00:00', '2025-01-15', 'expired', 0, '2025-01-15 20:40:46', '2025-01-15 20:40:46'),
(16, '65404', 2, 5, '10:00:00', '11:00:00', '2025-01-15', 'expired', 0, '2025-01-15 20:41:30', '2025-01-15 20:41:30'),
(17, '654', 2, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 20:51:14', '2025-01-15 20:51:14'),
(18, '654', 2, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:01:53', '2025-01-15 21:01:53'),
(19, '654230015', 2, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:12:09', '2025-01-15 21:12:09'),
(20, '654', 2, 5, '10:00:00', '11:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:12:18', '2025-01-15 21:12:18'),
(21, '65400', 2, 4, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:12:35', '2025-01-15 21:12:35'),
(22, '5', 2, 7, '15:00:00', '16:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:12:53', '2025-01-15 21:12:53'),
(23, '65411', 2, 4, '12:00:00', '13:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:29:10', '2025-01-15 21:29:10'),
(24, '65444', 3, 5, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:29:35', '2025-01-15 21:29:35'),
(25, '654444', 2, 5, '11:00:00', '12:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:34:54', '2025-01-15 21:34:54'),
(26, '65400001', 2, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:52:04', '2025-01-15 21:52:04'),
(27, '65444444', 2, 5, '11:00:00', '12:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:56:10', '2025-01-15 21:56:10'),
(28, '65400', 3, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:00:46', '2025-01-15 22:00:46'),
(29, '6540004', 3, 5, '12:00:00', '13:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:02:22', '2025-01-15 22:02:22'),
(30, '6540014', 5, 5, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:11:40', '2025-01-15 22:11:40'),
(31, '65444040', 5, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:11:53', '2025-01-15 22:11:53'),
(32, '654', 2, 5, '09:00:00', '10:00:00', '2025-01-16', 'expired', 0, '2025-01-16 08:58:09', '2025-01-16 08:58:09'),
(33, '65400', 2, 6, '10:00:00', '11:00:00', '2025-01-16', 'expired', 0, '2025-01-16 08:58:49', '2025-01-16 08:58:49'),
(34, '654114', 2, 5, '13:00:00', '14:00:00', '2025-01-16', 'expired', 0, '2025-01-16 09:00:44', '2025-01-16 09:00:44'),
(35, '65400001', 2, 5, '11:00:00', '12:00:00', '2025-01-16', 'expired', 0, '2025-01-16 09:00:59', '2025-01-16 09:00:59'),
(36, '65400', 2, 5, '13:00:00', '14:00:00', '2025-01-16', 'expired', 0, '2025-01-16 13:46:39', '2025-01-16 13:46:39'),
(37, '654', 2, 5, '14:00:00', '15:00:00', '2025-01-16', 'expired', 0, '2025-01-16 13:47:57', '2025-01-16 13:47:57'),
(38, '654230015', 2, 5, '15:00:00', '16:00:00', '2025-01-16', 'expired', 0, '2025-01-16 15:55:46', '2025-01-16 15:55:46'),
(39, '654230003', 2, 7, '15:00:00', '16:00:00', '2025-01-20', 'expired', 0, '2025-01-20 14:08:43', '2025-01-20 14:08:43'),
(40, '654230015', 5, 5, '14:00:00', '15:00:00', '2025-01-20', 'expired', 0, '2025-01-20 14:09:39', '2025-01-20 14:09:39'),
(41, '654230003', 5, 5, '15:00:00', '16:00:00', '2025-01-20', 'expired', 0, '2025-01-20 14:10:07', '2025-01-20 14:10:07'),
(42, '654230015', 2, 4, '15:00:00', '16:00:00', '2025-01-20', 'expired', 0, '2025-01-20 15:28:35', '2025-01-20 15:28:35'),
(43, 's404', 2, 5, '10:00:00', '11:00:00', '2025-01-23', 'expired', 0, '2025-01-23 10:02:29', '2025-01-23 10:02:29'),
(44, '654230015', 2, 5, '15:00:00', '16:00:00', '2025-01-23', 'expired', 0, '2025-01-23 15:16:57', '2025-01-23 15:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_room`
--

CREATE TABLE `tbn_room` (
  `r_id` int(11) NOT NULL,
  `r_number` int(11) NOT NULL,
  `r_status` tinyint(1) NOT NULL,
  `r_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbn_room_mini`
--

CREATE TABLE `tbn_room_mini` (
  `r_id` int(11) NOT NULL,
  `r_number` int(11) NOT NULL,
  `r_status` tinyint(1) NOT NULL,
  `r_desc` varchar(100) NOT NULL,
  `r_close_desc` text NOT NULL,
  `r_img` int(11) NOT NULL,
  `r_type` int(3) NOT NULL DEFAULT '3',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbn_room_music`
--

CREATE TABLE `tbn_room_music` (
  `r_id` int(11) NOT NULL,
  `r_number` int(11) NOT NULL,
  `r_status` tinyint(1) NOT NULL,
  `r_close_desc` text NOT NULL,
  `r_desc` varchar(100) NOT NULL,
  `r_img` text NOT NULL,
  `r_type` int(3) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_room_music`
--

INSERT INTO `tbn_room_music` (`r_id`, `r_number`, `r_status`, `r_close_desc`, `r_desc`, `r_img`, `r_type`, `created_at`) VALUES
(1, 1, 0, 'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus.', '1', '', 1, NULL),
(2, 2, 1, '', 'ลงทะเบียนตั้งแต่ 4-7 คน เวลา 1 ชม.', '', 1, NULL),
(3, 3, 1, '', 'ลงทะเบียนตั้งแต่ 4-7 คน เวลา 1 ชม.', '', 1, NULL),
(5, 4, 1, '', 'x', '', 1, NULL),
(6, 11, 1, '', '0', '', 1, '2025-01-09 09:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_room_vdo`
--

CREATE TABLE `tbn_room_vdo` (
  `r_id` int(11) NOT NULL,
  `r_number` int(11) NOT NULL,
  `r_status` tinyint(1) NOT NULL,
  `r_desc` varchar(100) NOT NULL,
  `r_close_desc` text NOT NULL,
  `r_img` text NOT NULL,
  `r_type` int(3) NOT NULL DEFAULT '2',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_room_vdo`
--

INSERT INTO `tbn_room_vdo` (`r_id`, `r_number`, `r_status`, `r_desc`, `r_close_desc`, `r_img`, `r_type`, `created_at`) VALUES
(1, 11, 1, '1', '', '', 2, '2025-01-09 09:29:31'),
(2, 1, 1, 'test', '', '', 2, '2025-01-15 01:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_type`
--

CREATE TABLE `tbn_type` (
  `t_id` int(3) NOT NULL,
  `type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_type`
--

INSERT INTO `tbn_type` (`t_id`, `type`) VALUES
(1, 'Music-relax'),
(2, 'VDO On-demand'),
(3, 'Mini-theater');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_vdo_reserv`
--

CREATE TABLE `tbn_vdo_reserv` (
  `reserv_id` int(11) NOT NULL,
  `st_id` varchar(70) NOT NULL,
  `r_id` int(11) NOT NULL,
  `total_pp` int(3) NOT NULL,
  `start_time` time NOT NULL,
  `exp_time` time NOT NULL,
  `r_date` date NOT NULL,
  `r_status` enum('actived','expired') NOT NULL DEFAULT 'actived',
  `r_verify` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbn_vdo_services`
--

CREATE TABLE `tbn_vdo_services` (
  `service_id` int(11) NOT NULL,
  `s_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_TH` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_EN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_picture` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_picture.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbn_vdo_services`
--

INSERT INTO `tbn_vdo_services` (`service_id`, `s_type`, `name_TH`, `name_EN`, `s_picture`) VALUES
(9997, 'DVD', 'สตรีมมิ่งออนไลน์', 'Disney+', 'default_picture.png'),
(9998, 'DVD', 'ดิสนีย์+', 'Sreaming Online', 'default_picture.png'),
(9999, 'DVD', 'เน็ตฟลิกซ์', 'Netflix', 'default_picture.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbn_admin`
--
ALTER TABLE `tbn_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbn_music_reserv`
--
ALTER TABLE `tbn_music_reserv`
  ADD PRIMARY KEY (`reserv_id`);

--
-- Indexes for table `tbn_room_mini`
--
ALTER TABLE `tbn_room_mini`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `tbn_room_music`
--
ALTER TABLE `tbn_room_music`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `tbn_room_vdo`
--
ALTER TABLE `tbn_room_vdo`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `tbn_type`
--
ALTER TABLE `tbn_type`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tbn_vdo_services`
--
ALTER TABLE `tbn_vdo_services`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbn_admin`
--
ALTER TABLE `tbn_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbn_music_reserv`
--
ALTER TABLE `tbn_music_reserv`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbn_room_mini`
--
ALTER TABLE `tbn_room_mini`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbn_room_music`
--
ALTER TABLE `tbn_room_music`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbn_room_vdo`
--
ALTER TABLE `tbn_room_vdo`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbn_type`
--
ALTER TABLE `tbn_type`
  MODIFY `t_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
