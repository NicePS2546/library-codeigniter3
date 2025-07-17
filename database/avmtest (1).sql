-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 12:12 AM
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
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_status` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ผู้ดูแล',
  `admin_desc` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbn_admin`
--

INSERT INTO `tbn_admin` (`admin_id`, `user_id`, `admin_status`, `role`, `admin_desc`) VALUES
(1, '654230003', 1, 'ผู้ดูแล', NULL),
(2, 'keng_milkcafe', 1, 'ผู้ดูแล', NULL),
(3, '654230015', 1, 'นักพัฒนา', NULL),
(4, '654230044', 0, 'ผู้ดูแล', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbn_mini_reserv`
--

CREATE TABLE `tbn_mini_reserv` (
  `reserv_id` int(11) NOT NULL,
  `r_s_id` tinyint(4) DEFAULT '3',
  `st_id` varchar(100) NOT NULL,
  `r_id` int(11) NOT NULL,
  `total_pp` int(3) NOT NULL,
  `start_time` time NOT NULL,
  `exp_time` time NOT NULL,
  `r_date` date NOT NULL,
  `r_status` enum('actived','expired','deleted') NOT NULL DEFAULT 'actived',
  `r_verify` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_mini_reserv`
--

INSERT INTO `tbn_mini_reserv` (`reserv_id`, `r_s_id`, `st_id`, `r_id`, `total_pp`, `start_time`, `exp_time`, `r_date`, `r_status`, `r_verify`, `created_at`, `update_at`) VALUES
(1, 3, '654230053', 1, 11, '12:00:00', '15:00:00', '2025-03-02', 'deleted', 1, '2025-03-02 12:07:27', '2025-03-02 12:07:27'),
(2, 3, '654230015', 1, 10, '09:00:00', '12:00:00', '2025-03-02', 'deleted', 1, '2025-03-02 15:08:22', '2025-03-02 15:08:22'),
(3, 3, '654230053', 1, 10, '09:00:00', '12:00:00', '2025-03-06', 'deleted', 1, '2025-03-06 05:10:09', '2025-03-06 05:10:09'),
(4, 3, '654230042', 2, 10, '09:00:00', '12:00:00', '2025-03-13', 'actived', 1, '2025-03-13 04:06:30', '2025-03-13 04:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_music_reserv`
--

CREATE TABLE `tbn_music_reserv` (
  `reserv_id` int(11) NOT NULL,
  `r_s_id` tinyint(1) NOT NULL DEFAULT '1',
  `st_id` varchar(100) NOT NULL,
  `r_id` int(11) NOT NULL,
  `total_pp` int(3) NOT NULL,
  `start_time` time NOT NULL,
  `exp_time` time NOT NULL,
  `r_date` date NOT NULL,
  `r_status` enum('actived','expired','deleted') NOT NULL DEFAULT 'actived',
  `r_verify` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_music_reserv`
--

INSERT INTO `tbn_music_reserv` (`reserv_id`, `r_s_id`, `st_id`, `r_id`, `total_pp`, `start_time`, `exp_time`, `r_date`, `r_status`, `r_verify`, `created_at`, `update_at`) VALUES
(78, 1, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-03-09', 'expired', 0, '2025-03-06 05:08:29', '2025-03-06 05:08:29'),
(79, 1, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-03-09', 'expired', 0, '2025-03-09 13:59:02', '2025-03-09 13:59:02'),
(80, 1, '654230015', 1, 5, '10:00:00', '11:00:00', '2025-03-11', 'expired', 1, '2025-03-11 01:27:35', '2025-03-11 01:27:35'),
(81, 1, '654230015', 1, 7, '10:00:00', '11:00:00', '2025-03-13', 'actived', 1, '2025-03-13 01:59:50', '2025-03-13 01:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_online_users`
--

CREATE TABLE `tbn_online_users` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbn_online_users`
--

INSERT INTO `tbn_online_users` (`id`, `date`, `user_count`) VALUES
(1, '2025-03-01', 0);

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
  `r_img` varchar(100) NOT NULL DEFAULT 'mini/default.png	',
  `r_type` int(3) NOT NULL DEFAULT '3',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_room_mini`
--

INSERT INTO `tbn_room_mini` (`r_id`, `r_number`, `r_status`, `r_desc`, `r_close_desc`, `r_img`, `r_type`, `created_at`) VALUES
(1, 1, 0, 'ลงทะเบียนเข้าใช้งาน 10 คนขึ้นไป', 'ห้องถูกปิดเนื่องจากLorem ipsum dolor sit amet consectetur adipisicing elit. Modi fugit earum blanditiis exercit', 'mini/1.jpg', 3, '2025-02-06 09:51:05'),
(2, 2, 1, 'asdasd', '', 'mini/2.jpg', 3, NULL);

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
  `r_img` varchar(100) NOT NULL DEFAULT 'music/default.png',
  `r_type` int(3) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_room_music`
--

INSERT INTO `tbn_room_music` (`r_id`, `r_number`, `r_status`, `r_close_desc`, `r_desc`, `r_img`, `r_type`, `created_at`) VALUES
(1, 1, 1, 'ห้องถูกปิดเนื่องจากLorem ipsum dolor sit amet consectetur adipisicing elit. Modi fugit earum blanditiis exercit', 'ลงทะเบียนตั้งแต่ 4-7 คน เวลา 1 ชม.', 'music/1.jpg', 1, '0000-00-00 00:00:00'),
(2, 2, 1, '', 'ลงทะเบียนตั้งแต่ 4-7 คน เวลา 1 ชม.', 'music/2.jpg', 1, '0000-00-00 00:00:00'),
(3, 3, 1, '', 'ลงทะเบียนตั้งแต่ 4-7 คน เวลา 1 ชม.', 'music/default.png', 1, '0000-00-00 00:00:00'),
(5, 4, 1, '', 'ลงทะเบียนตั้งแต่ 4-7 คน เวลา 1 ชม.', 'music/default.png', 1, '0000-00-00 00:00:00'),
(6, 11, 1, '', 'ลงทะเบียนตั้งแต่ 4-7 คน เวลา 1 ชม.', 'music/default.png', 1, '2025-01-09 09:29:40'),
(7, 14, 1, '', 'we', 'music/14.png', 1, '2025-03-10 02:36:51'),
(8, 12, 1, '', 'dasd', 'music/12.jpg', 1, '2025-03-10 02:37:18'),
(9, 13, 1, '', 'asd', 'music/13.png', 1, '2025-03-10 02:43:40'),
(10, 89, 1, '', 'kokok', 'music/89.jpg', 1, '2025-03-13 06:08:57');

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
  `r_img` varchar(100) NOT NULL DEFAULT 'vdo/default.png',
  `r_type` int(3) NOT NULL DEFAULT '2',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbn_room_vdo`
--

INSERT INTO `tbn_room_vdo` (`r_id`, `r_number`, `r_status`, `r_desc`, `r_close_desc`, `r_img`, `r_type`, `created_at`) VALUES
(1, 5, 1, '1', '', 'vdo/default.png	', 2, '2025-01-09 09:29:31'),
(2, 1, 1, 'test', '', 'vdo/default.png	', 2, '2025-01-15 01:19:17'),
(3, 7, 1, '4', '', 'vdo/default.png	', 2, '2025-01-18 21:47:00'),
(4, 8, 1, '4', '', 'vdo/default.png	', 2, '2025-01-18 21:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_statistic`
--

CREATE TABLE `tbn_statistic` (
  `id` int(11) NOT NULL,
  `stat_date` date NOT NULL,
  `total_users` int(11) NOT NULL DEFAULT '0',
  `total_reservations` int(11) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbn_statistic`
--

INSERT INTO `tbn_statistic` (`id`, `stat_date`, `total_users`, `total_reservations`, `last_update`, `service_id`) VALUES
(3, '2025-03-01', 24, 5, '2025-03-01 10:14:22', 3),
(4, '2025-02-13', 23, 2, '2025-03-10 21:46:45', 2),
(6, '2025-02-02', 11, 7, '2025-03-10 22:18:53', 2),
(7, '2025-03-02', 24, 2, '2025-03-02 08:08:22', 3),
(8, '2025-03-05', 6, 1, '2025-03-10 21:46:28', 1),
(12, '2025-03-06', 10, 2, '2025-03-05 22:08:29', 1),
(13, '2025-03-06', 5, 12, '2025-03-10 22:20:41', 2),
(14, '2025-03-06', 54, 13, '2025-03-10 22:20:42', 3),
(15, '2025-03-09', 5, 1, '2025-03-09 06:59:02', 1),
(16, '2025-03-09', 3, 1, '2025-03-09 07:02:13', 2),
(17, '2025-03-11', 5, 1, '2025-03-10 18:27:35', 1),
(18, '2025-03-13', 4, 1, '2025-03-12 18:59:50', 1),
(19, '2025-03-13', 6, 1, '2025-03-12 21:05:56', 2),
(20, '2025-03-13', 10, 1, '2025-03-12 21:06:30', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbn_time_slot_settings`
--

CREATE TABLE `tbn_time_slot_settings` (
  `t_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `start_time` time NOT NULL DEFAULT '09:00:00',
  `end_time` time NOT NULL DEFAULT '16:00:00',
  `interval_hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbn_time_slot_settings`
--

INSERT INTO `tbn_time_slot_settings` (`t_id`, `s_id`, `start_time`, `end_time`, `interval_hours`) VALUES
(1, 2, '09:00:00', '16:00:00', 3),
(2, 1, '09:00:00', '16:00:00', 1),
(3, 3, '09:00:00', '16:00:00', 3);

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
  `r_s_id` tinyint(4) NOT NULL DEFAULT '2',
  `st_id` varchar(100) NOT NULL,
  `r_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `total_pp` int(3) NOT NULL,
  `start_time` time NOT NULL,
  `exp_time` time NOT NULL,
  `r_date` date NOT NULL,
  `r_status` enum('actived','expired','deleted') NOT NULL DEFAULT 'actived',
  `r_verify` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbn_vdo_reserv`
--

INSERT INTO `tbn_vdo_reserv` (`reserv_id`, `r_s_id`, `st_id`, `r_id`, `s_id`, `total_pp`, `start_time`, `exp_time`, `r_date`, `r_status`, `r_verify`, `created_at`, `update_at`) VALUES
(1, 2, '654230015', 1, 9997, 1, '08:00:00', '12:00:00', '2025-02-02', 'deleted', 0, '2025-02-02 00:39:59', '2025-02-02 00:39:59'),
(3, 2, '654230015', 2, 9997, 5, '15:00:00', '16:00:00', '2025-02-06', 'deleted', 0, '2025-02-06 15:00:51', '2025-02-06 15:00:51'),
(4, 2, '654230044', 3, 9998, 5, '15:00:00', '16:00:00', '2025-02-06', 'deleted', 0, '2025-02-06 15:46:21', '2025-02-06 15:46:21'),
(5, 2, '654230041', 2, 9997, 5, '09:00:00', '12:00:00', '2025-02-13', 'deleted', 0, '2025-02-13 11:13:48', '2025-02-13 11:13:48'),
(6, 2, '654230053', 1, 9999, 10, '08:00:00', '12:00:00', '2025-02-13', 'deleted', 0, '2025-02-13 11:55:33', '2025-02-13 11:55:33'),
(7, 2, '654230053', 1, 9997, 4, '09:00:00', '12:00:00', '2025-03-02', 'deleted', 1, '2025-03-02 09:38:41', '2025-03-02 09:38:41'),
(8, 2, '654230012', 1, 9998, 1, '12:00:00', '15:00:00', '2025-03-02', 'deleted', 1, '2025-03-02 09:43:53', '2025-03-02 09:43:53'),
(9, 2, '654230042', 3, 9999, 4, '09:00:00', '12:00:00', '2025-03-02', 'deleted', 1, '2025-03-02 09:45:09', '2025-03-02 09:45:09'),
(10, 2, '654230042', 1, 9998, 2, '09:00:00', '12:00:00', '2025-03-02', 'deleted', 1, '2025-03-02 17:35:36', '2025-03-02 17:35:36'),
(11, 2, '654230042', 1, 9997, 5, '09:00:00', '12:00:00', '2025-03-06', 'deleted', 1, '2025-03-06 05:09:41', '2025-03-06 05:09:41'),
(12, 2, '654230053', 3, 9998, 3, '09:00:00', '12:00:00', '2025-03-09', 'expired', 1, '2025-03-09 14:02:13', '2025-03-09 14:02:13'),
(13, 2, '654230053', 1, 9998, 6, '09:00:00', '12:00:00', '2025-03-13', 'actived', 1, '2025-03-13 04:05:56', '2025-03-13 04:05:56'),
(14, 2, '654230044', 3, 9999, 5, '09:00:00', '12:00:00', '2025-03-13', 'actived', 1, '2025-03-13 04:08:58', '2025-03-13 04:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_vdo_services`
--

CREATE TABLE `tbn_vdo_services` (
  `service_id` int(11) NOT NULL,
  `s_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_TH` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_EN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_picture` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_picture.png',
  `s_desc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbn_vdo_services`
--

INSERT INTO `tbn_vdo_services` (`service_id`, `s_type`, `name_TH`, `name_EN`, `s_picture`, `s_desc`) VALUES
(9997, 'DVD', 'สตรีมมิ่งออนไลน์', 'Sreaming Online', '9997.jpg', ''),
(9998, 'DVD', 'ดิสนีย์+', 'Disney+', 'default_picture.png', NULL),
(9999, 'DVD', 'เน็ตฟลิกซ์', 'Netflix', 'default_picture.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbn_admin`
--
ALTER TABLE `tbn_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tbn_mini_reserv`
--
ALTER TABLE `tbn_mini_reserv`
  ADD PRIMARY KEY (`reserv_id`);

--
-- Indexes for table `tbn_music_reserv`
--
ALTER TABLE `tbn_music_reserv`
  ADD PRIMARY KEY (`reserv_id`);

--
-- Indexes for table `tbn_online_users`
--
ALTER TABLE `tbn_online_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

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
-- Indexes for table `tbn_statistic`
--
ALTER TABLE `tbn_statistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbn_time_slot_settings`
--
ALTER TABLE `tbn_time_slot_settings`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tbn_type`
--
ALTER TABLE `tbn_type`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tbn_vdo_reserv`
--
ALTER TABLE `tbn_vdo_reserv`
  ADD PRIMARY KEY (`reserv_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbn_mini_reserv`
--
ALTER TABLE `tbn_mini_reserv`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbn_music_reserv`
--
ALTER TABLE `tbn_music_reserv`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbn_online_users`
--
ALTER TABLE `tbn_online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbn_room_mini`
--
ALTER TABLE `tbn_room_mini`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbn_room_music`
--
ALTER TABLE `tbn_room_music`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbn_room_vdo`
--
ALTER TABLE `tbn_room_vdo`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbn_statistic`
--
ALTER TABLE `tbn_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbn_time_slot_settings`
--
ALTER TABLE `tbn_time_slot_settings`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbn_type`
--
ALTER TABLE `tbn_type`
  MODIFY `t_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbn_vdo_reserv`
--
ALTER TABLE `tbn_vdo_reserv`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
