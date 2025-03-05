-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 11:11 PM
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
CREATE DATABASE IF NOT EXISTS `avmtest` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `avmtest`;

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
(4, '654230044', 1, 'ผู้ดูแล', NULL);

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
(1, 3, '654230053', 1, 11, '12:00:00', '15:00:00', '2025-03-02', 'expired', 1, '2025-03-02 12:07:27', '2025-03-02 12:07:27'),
(2, 3, '654230015', 1, 10, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 15:08:22', '2025-03-02 15:08:22'),
(3, 3, '654230053', 1, 10, '09:00:00', '12:00:00', '2025-03-06', 'actived', 1, '2025-03-06 05:10:09', '2025-03-06 05:10:09');

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
(78, 1, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-03-06', 'expired', 1, '2025-03-06 05:08:29', '2025-03-06 05:08:29');

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
(1, '2025-03-01', 1);

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

--
-- Dumping data for table `tbn_room_mini`
--

INSERT INTO `tbn_room_mini` (`r_id`, `r_number`, `r_status`, `r_desc`, `r_close_desc`, `r_img`, `r_type`, `created_at`) VALUES
(1, 1, 1, 'ลงทะเบียนเข้าใช้งาน 10 คนขึ้นไป', '', 0, 3, '2025-02-06 09:51:05');

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
(1, '2025-03-01', 10, 2, '2025-03-01 09:59:09', 2),
(2, '2025-03-01', 14, 3, '2025-03-01 11:50:23', 1),
(3, '2025-03-01', 24, 5, '2025-03-01 10:14:22', 3),
(4, '2025-02-13', 10, 2, '2025-02-13 04:55:33', 2),
(5, '2025-03-02', 23, 4, '2025-03-02 10:33:07', 1),
(6, '2025-03-02', 11, 4, '2025-03-02 10:35:36', 2),
(7, '2025-03-02', 24, 2, '2025-03-02 08:08:22', 3),
(8, '2025-03-05', 5, 1, '2025-03-05 16:10:34', 1),
(12, '2025-03-06', 10, 2, '2025-03-05 22:08:29', 1),
(13, '2025-03-06', 5, 1, '2025-03-05 22:09:41', 2),
(14, '2025-03-06', 10, 1, '2025-03-05 22:10:09', 3);

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
(1, 2, '654230015', 1, 9997, 1, '09:00:00', '12:00:00', '2025-02-02', 'expired', 0, '2025-02-02 00:39:59', '2025-02-02 00:39:59'),
(3, 2, '654230015', 2, 9997, 5, '15:00:00', '16:00:00', '2025-02-06', 'expired', 0, '2025-02-06 15:00:51', '2025-02-06 15:00:51'),
(4, 2, '654230044', 3, 9998, 5, '15:00:00', '16:00:00', '2025-02-06', 'expired', 0, '2025-02-06 15:46:21', '2025-02-06 15:46:21'),
(5, 2, '654230041', 2, 9997, 5, '09:00:00', '12:00:00', '2025-02-13', 'expired', 0, '2025-02-13 11:13:48', '2025-02-13 11:13:48'),
(6, 2, '654230053', 1, 9999, 5, '09:00:00', '12:00:00', '2025-02-13', 'expired', 0, '2025-02-13 11:55:33', '2025-02-13 11:55:33'),
(7, 2, '654230053', 1, 9997, 4, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 09:38:41', '2025-03-02 09:38:41'),
(8, 2, '654230012', 1, 9998, 1, '12:00:00', '15:00:00', '2025-03-02', 'expired', 1, '2025-03-02 09:43:53', '2025-03-02 09:43:53'),
(9, 2, '654230042', 3, 9999, 4, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 09:45:09', '2025-03-02 09:45:09'),
(10, 2, '654230042', 1, 9998, 2, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 17:35:36', '2025-03-02 17:35:36'),
(11, 2, '654230042', 1, 9997, 5, '09:00:00', '12:00:00', '2025-03-06', 'actived', 1, '2025-03-06 05:09:41', '2025-03-06 05:09:41');

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
(9997, 'DVD', 'สตรีมมิ่งออนไลน์', 'Sreaming Online', 'default_picture.png', NULL),
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
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbn_music_reserv`
--
ALTER TABLE `tbn_music_reserv`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbn_online_users`
--
ALTER TABLE `tbn_online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbn_room_mini`
--
ALTER TABLE `tbn_room_mini`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbn_room_music`
--
ALTER TABLE `tbn_room_music`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbn_room_vdo`
--
ALTER TABLE `tbn_room_vdo`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbn_statistic`
--
ALTER TABLE `tbn_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"avmtest\",\"table\":\"tbn_music_reserv\"},{\"db\":\"avmtest\",\"table\":\"tbn_mini_reserv\"},{\"db\":\"avmtest\",\"table\":\"tbn_online_users\"},{\"db\":\"avmtest\",\"table\":\"tbn_statistic\"},{\"db\":\"avmtest\",\"table\":\"tbn_vdo_reserv\"},{\"db\":\"avmtest\",\"table\":\"tbn_type\"},{\"db\":\"avmtest\",\"table\":\"tbn_room_vdo\"},{\"db\":\"avmtest\",\"table\":\"tbn_room_mini\"},{\"db\":\"avmtest\",\"table\":\"tbn_room_music\"},{\"db\":\"avmtest\",\"table\":\"tbn_admin\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-02-28 13:00:20', '{\"collation_connection\":\"utf8mb4_unicode_ci\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
