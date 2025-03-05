-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2025 at 09:16 PM
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
(4, '654230044', 1, 'ผู้ดูแล', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbn_mini_reserv`
--

CREATE TABLE `tbn_mini_reserv` (
  `reserv_id` int(11) NOT NULL,
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

INSERT INTO `tbn_mini_reserv` (`reserv_id`, `st_id`, `r_id`, `total_pp`, `start_time`, `exp_time`, `r_date`, `r_status`, `r_verify`, `created_at`, `update_at`) VALUES
(1, '654230053', 1, 11, '12:00:00', '15:00:00', '2025-03-02', 'expired', 1, '2025-03-02 12:07:27', '2025-03-02 12:07:27'),
(2, '654230015', 1, 10, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 15:08:22', '2025-03-02 15:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbn_music_reserv`
--

CREATE TABLE `tbn_music_reserv` (
  `reserv_id` int(11) NOT NULL,
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
(24, '65444', 3, 5, '14:00:00', '15:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:29:35', '2025-01-15 21:29:35'),
(25, '654444', 2, 5, '11:00:00', '12:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:34:54', '2025-01-15 21:34:54'),
(26, '65400001', 2, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:52:04', '2025-01-15 21:52:04'),
(27, '65444444', 2, 5, '11:00:00', '12:00:00', '2025-01-15', 'expired', 0, '2025-01-15 21:56:10', '2025-01-15 21:56:10'),
(28, '65400', 3, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:00:46', '2025-01-15 22:00:46'),
(29, '6540004', 3, 5, '12:00:00', '13:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:02:22', '2025-01-15 22:02:22'),
(30, '6540014', 5, 5, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:11:40', '2025-01-15 22:11:40'),
(31, '65444040', 5, 5, '09:00:00', '10:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:11:53', '2025-01-15 22:11:53'),
(32, '65411474', 6, 5, '13:00:00', '14:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:14:05', '2025-01-15 22:14:05'),
(33, '1', 2, 5, '12:00:00', '13:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:15:07', '2025-01-15 22:15:07'),
(34, '6541401', 3, 5, '14:00:00', '15:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:15:40', '2025-01-15 22:15:40'),
(35, '6542424', 2, 5, '14:00:00', '15:00:00', '2025-01-15', 'expired', 0, '2025-01-15 22:16:19', '2025-01-15 22:16:19'),
(36, '654230015', 2, 5, '12:00:00', '13:00:00', '2025-01-18', 'expired', 0, '2025-01-18 12:38:01', '2025-01-18 12:38:01'),
(37, '654230003', 3, 5, '14:00:00', '15:00:00', '2025-01-18', 'expired', 0, '2025-01-18 12:38:50', '2025-01-18 12:38:50'),
(38, '654230001', 3, 5, '12:00:00', '13:00:00', '2025-01-18', 'expired', 0, '2025-01-18 12:46:30', '2025-01-18 12:46:30'),
(39, '654230002', 2, 5, '14:00:00', '15:00:00', '2025-01-18', 'expired', 0, '2025-01-18 14:21:21', '2025-01-18 14:21:21'),
(40, '654230015', 2, 5, '14:00:00', '15:00:00', '2025-01-18', 'expired', 0, '2025-01-18 14:27:39', '2025-01-18 14:27:39'),
(41, '654230001', 2, 6, '13:00:00', '14:00:00', '2025-01-18', 'expired', 0, '2025-01-18 14:29:29', '2025-01-18 14:29:29'),
(42, '654230015', 2, 5, '15:00:00', '16:00:00', '2025-01-20', 'expired', 0, '2025-01-20 21:10:39', '2025-01-20 21:10:39'),
(43, '654230003', 2, 5, '10:00:00', '11:00:00', '2025-01-20', 'expired', 0, '2025-01-20 21:16:16', '2025-01-20 21:16:16'),
(44, '654230015', 2, 6, '10:00:00', '11:00:00', '2025-01-27', 'expired', 0, '2025-01-27 20:13:47', '2025-01-27 20:13:47'),
(45, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-01-31', 'expired', 0, '2025-01-31 12:16:36', '2025-01-31 12:16:36'),
(46, '654230015', 2, 4, '11:00:00', '12:00:00', '2025-02-02', 'expired', 0, '2025-02-02 00:51:59', '2025-02-02 00:51:59'),
(47, '654230015', 2, 6, '13:00:00', '14:00:00', '2025-02-03', 'expired', 0, '2025-02-03 13:19:11', '2025-02-03 13:19:11'),
(48, '654230015', 2, 5, '13:00:00', '14:00:00', '2025-02-03', 'expired', 0, '2025-02-03 13:25:23', '2025-02-03 13:25:23'),
(49, '654230015', 2, 5, '15:00:00', '16:00:00', '2025-02-03', 'expired', 0, '2025-02-03 15:47:17', '2025-02-03 15:47:17'),
(50, '654230015', 2, 5, '15:00:00', '16:00:00', '2025-02-03', 'expired', 0, '2025-02-03 15:59:35', '2025-02-03 15:59:35'),
(51, '654230003', 2, 4, '13:00:00', '14:00:00', '2025-02-03', 'expired', 0, '2025-02-03 16:01:22', '2025-02-03 16:01:22'),
(52, '654230015', 2, 5, '09:00:00', '10:00:00', '2025-02-06', 'expired', 0, '2025-02-06 09:35:03', '2025-02-06 09:35:03'),
(53, '654230001', 2, 4, '10:00:00', '11:00:00', '2025-02-06', 'expired', 0, '2025-02-06 09:38:23', '2025-02-06 09:38:23'),
(54, '654230003', 5, 5, '09:00:00', '10:00:00', '2025-02-06', 'expired', 0, '2025-02-06 09:39:03', '2025-02-06 09:39:03'),
(55, '654230044', 2, 4, '11:00:00', '12:00:00', '2025-02-06', 'expired', 0, '2025-02-06 09:47:37', '2025-02-06 09:47:37'),
(56, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-02-06', 'expired', 0, '2025-02-06 10:04:51', '2025-02-06 10:04:51'),
(57, '654230003', 5, 6, '10:00:00', '11:00:00', '2025-02-06', 'expired', 0, '2025-02-06 10:05:06', '2025-02-06 10:05:06'),
(58, '654230003', 2, 4, '15:00:00', '16:00:00', '2025-02-06', 'expired', 0, '2025-02-06 15:02:12', '2025-02-06 15:02:12'),
(59, '654230015', 2, 5, '09:00:00', '10:00:00', '2025-02-13', 'expired', 0, '2025-02-13 08:53:51', '2025-02-13 08:53:51'),
(60, '654230041', 2, 5, '10:00:00', '11:00:00', '2025-02-13', 'expired', 0, '2025-02-13 10:11:36', '2025-02-13 10:11:36'),
(61, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-02-13', 'expired', 0, '2025-02-13 10:24:35', '2025-02-13 10:24:35'),
(62, '654230015', 2, 5, '11:00:00', '12:00:00', '2025-02-13', 'expired', 0, '2025-02-13 11:11:37', '2025-02-13 11:11:37'),
(63, '654230015', 5, 4, '14:00:00', '15:00:00', '2025-03-01', 'expired', 1, '2025-02-13 14:03:22', '2025-02-13 14:03:22'),
(64, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-03-01', 'expired', 1, '2025-03-01 18:49:41', '2025-03-01 18:49:41'),
(65, '654230053', 2, 5, '14:00:00', '15:00:00', '2025-03-01', 'expired', 1, '2025-03-01 18:50:23', '2025-03-01 18:50:23'),
(66, '654230015', 2, 5, '10:00:00', '11:00:00', '2025-03-02', 'expired', 1, '2025-03-02 08:19:54', '2025-03-02 08:19:54'),
(67, '654230003', 2, 4, '11:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 08:32:46', '2025-03-02 08:32:46'),
(68, '654230015', 1, 10, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 11:56:44', '2025-03-02 11:56:44'),
(69, '654230015', 2, 4, '10:00:00', '11:00:00', '2025-03-02', 'expired', 1, '2025-03-02 17:33:07', '2025-03-02 17:33:07');

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
(7, '2025-03-02', 24, 2, '2025-03-02 08:08:22', 3);

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

INSERT INTO `tbn_vdo_reserv` (`reserv_id`, `st_id`, `r_id`, `s_id`, `total_pp`, `start_time`, `exp_time`, `r_date`, `r_status`, `r_verify`, `created_at`, `update_at`) VALUES
(1, '654230015', 1, 9997, 1, '09:00:00', '12:00:00', '2025-02-02', 'expired', 0, '2025-02-02 00:39:59', '2025-02-02 00:39:59'),
(3, '654230015', 2, 9997, 5, '15:00:00', '16:00:00', '2025-02-06', 'expired', 0, '2025-02-06 15:00:51', '2025-02-06 15:00:51'),
(4, '654230044', 3, 9998, 5, '15:00:00', '16:00:00', '2025-02-06', 'expired', 0, '2025-02-06 15:46:21', '2025-02-06 15:46:21'),
(5, '654230041', 2, 9997, 5, '09:00:00', '12:00:00', '2025-02-13', 'expired', 0, '2025-02-13 11:13:48', '2025-02-13 11:13:48'),
(6, '654230053', 1, 9999, 5, '09:00:00', '12:00:00', '2025-02-13', 'expired', 0, '2025-02-13 11:55:33', '2025-02-13 11:55:33'),
(7, '654230053', 1, 9997, 4, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 09:38:41', '2025-03-02 09:38:41'),
(8, '654230012', 1, 9998, 1, '12:00:00', '15:00:00', '2025-03-02', 'expired', 1, '2025-03-02 09:43:53', '2025-03-02 09:43:53'),
(9, '654230042', 3, 9999, 4, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 09:45:09', '2025-03-02 09:45:09'),
(10, '654230042', 1, 9998, 2, '09:00:00', '12:00:00', '2025-03-02', 'expired', 1, '2025-03-02 17:35:36', '2025-03-02 17:35:36');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbn_mini_reserv`
--
ALTER TABLE `tbn_mini_reserv`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbn_music_reserv`
--
ALTER TABLE `tbn_music_reserv`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
