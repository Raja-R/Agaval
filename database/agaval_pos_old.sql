-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 06:13 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agaval_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Super Admin', NULL, NULL, '2024-02-04 17:54:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `read_module` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `create_module` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `update_module` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `delete_module` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`id`, `group_id`, `permission_id`, `read_module`, `create_module`, `update_module`, `delete_module`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 3, 'YES', 'YES', 'YES', 'YES', 1, '2024-02-04 17:54:52', NULL, NULL),
(2, 1, 2, 'YES', 'YES', 'YES', 'YES', 1, '2024-02-04 17:54:52', NULL, NULL),
(3, 1, 1, 'YES', 'YES', 'YES', 'YES', 1, '2024-02-04 17:54:52', NULL, NULL),
(4, 1, 4, 'YES', 'YES', 'YES', 'YES', 1, '2024-02-04 17:54:52', NULL, NULL),
(5, 1, 5, 'YES', 'YES', 'YES', 'YES', 1, '2024-02-04 17:54:52', NULL, NULL),
(6, 1, 6, 'YES', 'YES', 'YES', 'YES', 1, '2024-02-04 17:54:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `group_id`, `user_id`) VALUES
(1, 1, 8),
(2, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'RajaRaman', NULL, '2024-01-06 18:01:54', 0),
(2, '::1', 'RajaR', NULL, '2024-01-06 18:04:36', 0),
(3, '::1', 'rajar0572@gmail.com', 1, '2024-01-06 18:10:12', 1),
(4, '::1', 'rajar0572@gmail.com', 1, '2024-01-06 20:04:09', 1),
(5, '::1', 'RajaR', NULL, '2024-01-07 11:02:33', 0),
(6, '::1', 'RajaR', NULL, '2024-01-07 11:02:55', 0),
(7, '::1', 'RajaR', NULL, '2024-01-07 11:03:07', 0),
(8, '::1', 'rajar0572@gmail.com', 1, '2024-01-07 11:04:03', 1),
(9, '::1', 'RajaR', NULL, '2024-01-07 16:30:41', 0),
(10, '::1', 'RajaR', NULL, '2024-01-07 16:30:55', 0),
(11, '::1', 'rajar0572@gmail.com', 1, '2024-01-07 16:31:09', 1),
(12, '::1', 'SuperAdmin', NULL, '2024-01-07 19:41:33', 0),
(13, '::1', 'rajar0572@gmail.com', 1, '2024-01-07 19:41:58', 1),
(14, '::1', 'rajar0572@gmail.com', NULL, '2024-01-12 18:44:58', 0),
(15, '::1', 'rajar0572@gmail.com', 1, '2024-01-12 18:45:50', 1),
(16, '::1', 'rajar0572@gmail.com', 1, '2024-01-12 21:10:40', 1),
(17, '::1', 'rajar0572@gmail.com', 1, '2024-01-13 19:46:17', 1),
(18, '::1', 'rajar0572@gmail.com', 1, '2024-01-13 21:34:36', 1),
(19, '::1', 'rajar0572@gmail.com', 1, '2024-01-14 12:26:59', 1),
(20, '::1', 'rajar0572@gmail.com', 1, '2024-01-14 16:27:50', 1),
(21, '::1', 'rajar0572@gmail.com', 1, '2024-01-14 19:41:58', 1),
(22, '::1', 'rajar0572@gmail.com', 1, '2024-01-15 18:39:57', 1),
(23, '::1', 'rajar0572@gmail.com', 1, '2024-01-16 11:22:01', 1),
(24, '::1', 'rajar0572@gmail.com', 1, '2024-01-16 19:34:52', 1),
(25, '::1', 'rajar0572@gmail.com', 1, '2024-01-18 19:47:25', 1),
(26, '::1', 'rajar0572@gmail.com', 1, '2024-01-19 11:37:04', 1),
(27, '::1', 'rajar0572@gmail.com', 1, '2024-01-19 17:30:42', 1),
(28, '::1', 'rajar0572@gmail.com', 1, '2024-01-21 11:25:14', 1),
(29, '::1', 'rajar0572@gmail.com', 1, '2024-01-21 16:30:50', 1),
(30, '::1', 'rajar0572@gmail.com', 1, '2024-01-22 21:53:02', 1),
(31, '::1', 'rajar0572@gmail.com', 1, '2024-01-24 21:14:22', 1),
(32, '::1', 'rajar0572@gmail.com', 1, '2024-01-26 22:18:46', 1),
(33, '::1', 'rajar0572@gmail.com', 1, '2024-02-02 20:54:56', 1),
(34, '::1', 'rajar0572@gmail.com', 1, '2024-02-04 12:00:58', 1),
(35, '::1', 'rajar0572@gmail.com', 1, '2024-02-04 17:48:34', 1),
(36, '::1', 'RajaR', NULL, '2024-02-04 19:04:53', 0),
(37, '::1', 'RajaR', NULL, '2024-02-04 19:05:03', 0),
(38, '::1', 'RajaR', NULL, '2024-02-04 19:05:17', 0),
(39, '::1', 'RajaR', NULL, '2024-02-04 19:05:56', 0),
(40, '::1', 'RajaR', NULL, '2024-02-04 19:06:26', 0),
(41, '::1', 'rajar0572@gmail.com', NULL, '2024-02-04 19:07:17', 0),
(42, '::1', 'rajar0572@gmail.com', NULL, '2024-02-04 19:07:35', 0),
(43, '::1', 'RajaR', NULL, '2024-02-04 19:08:48', 0),
(44, '::1', 'rajar0572@gmail.com', 1, '2024-02-05 21:22:04', 1),
(45, '::1', 'rajar0572@gmail.com', 1, '2024-02-06 21:32:57', 1),
(46, '::1', 'agaval@gmail.com', 9, '2024-02-06 21:52:50', 1),
(47, '::1', 'agaval@gmail.com', 9, '2024-02-06 22:21:20', 1),
(48, '::1', 'agaval@gmail.com', 9, '2024-02-07 21:35:37', 1),
(49, '::1', 'agaval@gmail.com', 9, '2024-02-07 21:49:47', 1),
(50, '::1', 'agaval@gmail.com', 9, '2024-02-08 22:35:48', 1),
(51, '::1', 'agaval@gmail.com', 9, '2024-02-12 21:16:18', 1),
(52, '::1', 'agaval@gmail.com', 9, '2024-02-13 21:02:26', 1),
(53, '::1', 'agaval@gmail.com', 9, '2024-02-14 21:36:28', 1),
(54, '::1', 'agaval@gmail.com', 9, '2024-02-15 21:25:46', 1),
(55, '::1', 'agaval@gmail.com', 9, '2024-02-17 19:49:35', 1),
(56, '::1', 'agaval@gmail.com', 9, '2024-02-17 20:02:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sales', 'Sales', '2024-01-07 00:20:06', NULL),
(2, 'Customer', 'Customer', '2024-01-07 12:06:29', NULL),
(3, 'Purchase', 'Purchase', '2024-01-13 20:29:32', NULL),
(4, 'Suppliers', 'Suppliers', '2024-01-13 20:29:32', NULL),
(5, 'User', 'User', '2024-01-13 20:29:32', NULL),
(6, 'Site', 'Site', '2024-01-13 20:29:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `root_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` longtext NOT NULL,
  `path` varchar(100) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `sorting` int(11) NOT NULL,
  `active_category` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `root_id`, `app_id`, `name`, `description`, `path`, `status`, `sorting`, `active_category`, `created_by`, `created_at`) VALUES
(1, 0, 1, 'முறுக்கு', '', '', 'ACTIVE', 1, 1, 0, '2019-10-05 00:00:00'),
(2, 0, 1, 'இனிப்புகள்', '', '', 'ACTIVE', 2, 0, 0, '2019-10-05 23:18:58'),
(3, 0, 1, 'Sweets', 'Sweets', '', 'ACTIVE', 3, 0, 6, '2019-10-15 21:48:09'),
(5, 0, 1, 'காரவகை', '??????', '', 'ACTIVE', 4, 0, 6, '2019-10-19 22:49:26'),
(6, 0, 1, 'dfad', 'dasfd', '', 'ACTIVE', 2, 0, 6, '2019-10-19 22:56:44'),
(7, 0, 0, '', '', '', 'ACTIVE', 0, 1, 0, '2019-10-29 22:34:45'),
(8, 0, 1, 'Raja Raman', 'dfasd', '', '', 1, 0, 6, '2019-10-29 22:45:22'),
(9, 0, 1, 'Raja Raman', 'dfasd', '', '', 1, 0, 6, '2019-10-29 22:45:59'),
(10, 0, 1, 'Raja Raman', 'dfasd', '', '', 1, 0, 6, '2019-10-29 22:46:51'),
(11, 0, 1, 'Raja Raman', 'dfasd', '', '', 1, 0, 6, '2019-10-29 22:47:12'),
(12, 0, 1, 'RajaRaman', '', '', 'ACTIVE', 0, 0, 6, '2019-10-29 22:52:13'),
(13, 0, 1, 'RajaRaman', 'dsd', '', 'ACTIVE', 2, 0, 6, '2019-10-29 22:54:06'),
(14, 0, 1, 'Raja', '', '', 'ACTIVE', 0, 0, 6, '2019-10-29 22:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cid` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `tamil_name` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cid`, `district`, `name`, `tamil_name`) VALUES
(1, 1, 'Gummidipoondi', '??????????????'),
(2, 1, 'Ponneri', '????????'),
(3, 1, 'Tiruttani', '?????????'),
(4, 1, 'Thiruvallur', '???????????'),
(5, 1, 'Poonamallee', '??????????'),
(6, 1, 'Avadi', '????'),
(7, 1, 'Maduravoyal', '?????????'),
(8, 1, 'Ambattur', '??????????'),
(9, 1, 'Madavaram', '???????'),
(10, 1, 'Thiruvottiyur', '??????????????'),
(11, 2, 'Radhakrishnan Nagar', '??????? ????????????? ????'),
(12, 2, 'Perambur', '?????????'),
(13, 2, 'Kolathur', '?????????'),
(14, 2, 'Villivakkam', '?????????????'),
(15, 2, 'Thiru. Vi. Ka. Nagar', '????.??.?.????'),
(16, 2, 'Egmore', '?????????'),
(17, 2, 'Royapuram', '????????'),
(18, 2, 'Harbour', '?????????'),
(19, 2, 'Chepauk-Thiruvallikeni', '???????????-?????????????'),
(20, 2, 'Thousand Lights', '?????? ???????'),
(21, 2, 'Anna Nagar', '????? ????'),
(22, 2, 'Virugambakkam', '??????????????'),
(23, 2, 'Saidapet', '????????????'),
(24, 2, 'T. Nagar', '????????????'),
(25, 2, 'Mylapore', '??????????'),
(26, 2, 'Velachery', '?????????'),
(27, 35, 'Sholinganallur', '??????????????'),
(28, 3, 'Alandur', '????????'),
(29, 3, 'Sriperumbudur', '???????????????'),
(30, 35, 'Pallavaram', '?????????'),
(31, 35, 'Tambaram', '????????'),
(32, 35, 'Chengalpattu', '????????????'),
(33, 35, 'Tirupporur', '????????????'),
(34, 35, 'Cheyyur', '????????'),
(35, 35, 'Maduranthakam', '???????????'),
(36, 3, 'Uthiramerur', '????????????'),
(37, 3, 'Kancheepuram', '???????????'),
(38, 37, 'Arakkonam', '?????????'),
(39, 37, 'Sholingur', '?????????'),
(40, 4, 'Katpadi', '????????'),
(41, 37, 'Ranipet', '?????????????'),
(42, 37, 'Arcot', '???????'),
(43, 4, 'Vellore (Vellore south)', '??????'),
(44, 4, 'Anaikattu', '??????????'),
(45, 4, 'K. V. Kuppam', '??????????????????????'),
(46, 4, 'Gudiyattam', '???????????'),
(47, 36, 'Vaniyambadi', '???????????'),
(48, 36, 'Ambur', '???????'),
(49, 36, 'Jolarpet', '????????????'),
(50, 36, 'Tirupattur,  Vellore', '?????????????'),
(51, 5, 'Uthangarai', '?????????'),
(52, 5, 'Bargur', '???????'),
(53, 5, 'Krishnagiri', '???????????'),
(54, 5, 'Veppanahalli', '???????????'),
(55, 5, 'Hosur', '?????'),
(56, 5, 'Thalli', '???'),
(57, 6, 'Palacode', '?????????'),
(58, 6, 'Pennagaram', '??????????'),
(59, 6, 'Dharmapuri', '????????'),
(60, 6, 'Pappireddippatti', '?????????????????'),
(61, 6, 'Harur', '?????'),
(62, 7, 'Chengam', '???????'),
(63, 7, 'Tiruvannamalai', '????????????'),
(64, 7, 'Kilpennathur', '????????????????'),
(65, 7, 'Kalasapakkam', '??????????'),
(66, 7, 'Polur', '??????'),
(67, 7, 'Arani', '????'),
(68, 7, 'Cheyyar', '????????'),
(69, 7, 'Vandavasi', '????????'),
(70, 8, 'Gingee', '??????'),
(71, 8, 'Mailam', '??????'),
(72, 8, 'Tindivanam', '??????????'),
(73, 8, 'Vanur', '??????'),
(74, 8, 'Villupuram', '???????????'),
(75, 8, 'Vikravandi', '?????????????'),
(76, 8, 'Tirukkoyilur', '??????????????'),
(77, 33, 'Ulundurpettai', '???????????????'),
(78, 33, 'Rishivandiyam', '????????????'),
(79, 33, 'Sankarapuram', '???????????'),
(80, 33, 'Kallakurichi', '??????????????'),
(81, 9, 'Gangavalli', '??????????'),
(82, 9, 'Attur', '???????'),
(83, 9, 'Yercaud', '???????'),
(84, 9, 'Omalur', '??????'),
(85, 9, 'Mettur', '????????'),
(86, 9, 'Edappadi', '????????'),
(87, 9, 'Sankari', '????????'),
(88, 9, 'Salem (West)', '????? (??????)'),
(89, 9, 'Salem (North)', '????? (??????)'),
(90, 9, 'Salem (South)', '????? (??????)'),
(91, 9, 'Veerapandi', '?????????'),
(92, 10, 'Rasipuram', '?????????'),
(93, 10, 'Senthamangalam', '????????????'),
(94, 10, 'Namakkal', '????????'),
(95, 10, 'Paramathi Velur', '???????-??????'),
(96, 10, 'Tiruchengodu', '??????????????'),
(97, 10, 'Kumarapalayam', '????????????'),
(98, 11, 'Erode (East)', '????? (???????)'),
(99, 11, 'Erode (West)', '????? (??????)'),
(100, 11, 'Modakkurichi', '?????????????'),
(101, 32, 'Dharapuram', '?????????'),
(102, 32, 'Kangayam', '?????????'),
(103, 11, 'Perundurai', '??????????'),
(104, 11, 'Bhavani', '?????'),
(105, 11, 'Anthiyur', '?????????'),
(106, 11, 'Gobichettipalayam', '?????????????????'),
(107, 11, 'Bhavanisagar', '??????????'),
(108, 12, 'Udhagamandalam', '??????????'),
(109, 12, 'Coonoor', '???????'),
(110, 12, 'Gudalur', '????????'),
(111, 13, 'Mettupalayam', '???????????????'),
(112, 32, 'Avanashi', '???????'),
(113, 32, 'Tiruppur North', '?????????? (??????)'),
(114, 32, 'Tiruppur South', '?????????? (??????)'),
(115, 32, 'Palladam', '???????'),
(116, 13, 'Sulur', '??????'),
(117, 13, 'Kavundampalayam', '???????????????'),
(118, 13, 'Coimbatore North', '????????????? (??????)'),
(119, 13, 'Thondamuthur', '??????????????'),
(120, 13, 'Coimbatore South', '????????????? (??????)'),
(121, 13, 'Singanallur', '?????????????'),
(122, 13, 'Kinathukadavu', '?????????????'),
(123, 13, 'Pollachi', '??????????'),
(124, 13, 'Valparai', '????????'),
(125, 32, 'Udumalaipettai', '??????????????'),
(126, 32, 'Madathukulam', '?????????????'),
(127, 14, 'Palani', '????'),
(128, 14, 'Oddanchatram', '??????????????'),
(129, 14, 'Athoor', '???????'),
(130, 14, 'Nilakottai', '???????????'),
(131, 14, 'Natham', '??????'),
(132, 14, 'Dindigul', '???????????'),
(133, 14, 'Vedasandur', '??????????'),
(134, 15, 'Aravakurichi', '?????????????'),
(135, 15, 'Karur', '?????'),
(136, 15, 'Krishnarayapuram', '???????????????'),
(137, 15, 'Kulithalai', '?????????'),
(138, 16, 'Manapaarai', '????????'),
(139, 16, 'Srirangam', '??????????'),
(140, 16, 'Tiruchirappalli (West)', '?????????????????(??????)'),
(141, 16, 'Tiruchirappalli (East)', '?????????????????(???????)'),
(142, 16, 'Thiruverumbur', '??????????????'),
(143, 16, 'Lalgudi', '????????'),
(144, 16, 'Manachanallur', '????????????'),
(145, 16, 'Musiri', '??????'),
(146, 16, 'Thuraiyur', '????????'),
(147, 17, 'Perambalur', '??????????'),
(148, 17, 'Kunnam', '???????'),
(149, 31, 'Ariyalur', '????????'),
(150, 31, 'Jayankondam', '????????????'),
(151, 18, 'Tittakudi', '???????????'),
(152, 18, 'Virudhachalam', '????????????'),
(153, 18, 'Neyveli', '????????'),
(154, 18, 'Panruti', '?????????'),
(155, 18, 'Cuddalore', '??????'),
(156, 18, 'Kurinjipadi', '??????????????'),
(157, 18, 'Bhuvanagiri', '????????'),
(158, 18, 'Chidambaram', '?????????'),
(159, 18, 'Kattumannarkoil', '???????????????????'),
(160, 19, 'Sirkazhi', '????????'),
(161, 19, 'Mayiladuthurai', '???????????'),
(162, 19, 'Poompuhar', '??????????'),
(163, 19, 'Nagapattinam', '?????????????'),
(164, 19, 'Kilvelur', '??????????'),
(165, 19, 'Vedaranyam', '??????????'),
(166, 20, 'Thiruthuraipoondi', '????????????????'),
(167, 20, 'Mannargudi', '???????????'),
(168, 20, 'Thiruvarur', '??????????'),
(169, 20, 'Nannilam', '????????'),
(170, 21, 'Thiruvidaimarudur', '???????????????'),
(171, 21, 'Kumbakonam', '??????????'),
(172, 21, 'Papanasam', '????????'),
(173, 21, 'Thiruvaiyaru', '??????????'),
(174, 21, 'Thanjavur', '?????????'),
(175, 21, 'Orathanadu', '?????????'),
(176, 21, 'Pattukkottai', '?????????????'),
(177, 21, 'Peravurani', '?????????'),
(178, 22, 'Gandharvakottai', '?????????????'),
(179, 22, 'Viralimalai', '?????????'),
(180, 22, 'Pudukkottai', '????????????'),
(181, 22, 'Thirumayam', '????????'),
(182, 22, 'Alangudi', '????????'),
(183, 22, 'Aranthangi', '??????????'),
(184, 23, 'Karaikudi', '??????????'),
(185, 23, 'Tiruppattur, Sivaganga', '?????????????'),
(186, 23, 'Sivaganga', '????????'),
(187, 23, 'Manamadurai', '?????????(???)'),
(188, 24, 'Melur', '??????'),
(189, 24, 'Madurai East', '????? (???????)'),
(190, 24, 'Sholavandan', '??????????'),
(191, 24, 'Madurai North', '????? (??????)'),
(192, 24, 'Madurai South', '????? (??????)'),
(193, 24, 'Madurai Central', '????? (?????)'),
(194, 24, 'Madurai West', '????? (??????)'),
(195, 24, 'Thiruparankundram', '?????????????????'),
(196, 24, 'Tirumangalam', '???????????'),
(197, 24, 'Usilampatti', '???????????'),
(198, 25, 'Andipatti', '??????????'),
(199, 25, 'Periyakulam', '??????????'),
(200, 25, 'Bodinayakanur', '??????????????'),
(201, 25, 'Cumbum', '??????'),
(202, 26, 'Rajapalayam', '??????????'),
(203, 26, 'Srivilliputhur', '????????????????????'),
(204, 26, 'Sattur', '????????'),
(205, 26, 'Sivakasi', '???????'),
(206, 26, 'Virudhunagar', '??????????'),
(207, 26, 'Aruppukkottai', '???????????????'),
(208, 26, 'Tiruchuli', '??????????'),
(209, 27, 'Paramakudi', '?????????'),
(210, 27, 'Tiruvadanai', '??????????'),
(211, 27, 'Ramanathapuram', '????????????'),
(212, 27, 'Mudhukulathur', '?????????????'),
(213, 28, 'Vilathikulam', '?????????????'),
(214, 28, 'Thoothukudi', '????????????'),
(215, 28, 'Tiruchendur', '??????????????'),
(216, 28, 'Thiruvaikundam', '?????????????'),
(217, 28, 'Ottapidaram', '?????????????'),
(218, 28, 'Kovilpatti', '???????????'),
(219, 34, 'Sankarankovil', '?????????????'),
(220, 34, 'Vasudevanallur', '??????????????'),
(221, 34, 'Kadayanallur', '???????????'),
(222, 34, 'Tenkasi', '????????'),
(223, 34, 'Alangulam', '?????????'),
(224, 29, 'Tirunelveli', '????????????'),
(225, 29, 'Ambasamudram', '???????????????'),
(226, 29, 'Palayamkottai', '?????????????'),
(227, 29, 'Nanguneri', '??????????'),
(228, 29, 'Radhapuram', '?????????'),
(229, 30, 'Kanniyakumari', '????????????'),
(230, 30, 'Nagercoil', '???????????'),
(231, 30, 'Colachal', '????????'),
(232, 30, 'Padmanabhapuram', '????????????'),
(233, 30, 'Vilavancode', '??????????'),
(234, 30, 'Killiyoor', '??????????');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `support_no` varchar(15) DEFAULT NULL,
  `support_email` varchar(30) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `prefix_category` varchar(10) DEFAULT NULL,
  `prefix_product` varchar(10) DEFAULT NULL,
  `prefix_sale` varchar(10) DEFAULT NULL,
  `prefix_purchase` varchar(10) DEFAULT NULL,
  `prefix_brand` varchar(10) DEFAULT NULL,
  `prefix_supplier` varchar(10) DEFAULT NULL,
  `prefix_invoice` varchar(10) DEFAULT NULL,
  `prefix_expense` varchar(10) DEFAULT NULL,
  `site_logo` varchar(100) NOT NULL,
  `site_favicon` varchar(100) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `site_name`, `support_no`, `support_email`, `copy_right`, `prefix_category`, `prefix_product`, `prefix_sale`, `prefix_purchase`, `prefix_brand`, `prefix_supplier`, `prefix_invoice`, `prefix_expense`, `site_logo`, `site_favicon`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Agaval POS', '9585048650', 'rajar0572@gmail.com', '© 2024 Developed by Agaval POS', '#CAT', '#PRD', NULL, '#PRC', '#BRD', '#SUP', '#INV', '#EXP', '{\"image\":\"LOGO_1705420732.png\",\"file\":\"image\\/png\",\"ext\":\"png\"}', '{\"image\":\"FAVICON_1705420732.png\",\"file\":\"image\\/png\",\"ext\":\"png\"}', 1, 1, '2024-01-16 00:00:00', '2024-01-18 20:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `alternate_mobile` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `alternate_address` varchar(200) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `pincode` int(11) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `app_id`, `alternate_mobile`, `address`, `alternate_address`, `city`, `state`, `country`, `pincode`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 7, 1, '5525565', 'teser', 'FDAFDA', 'sdad', 'test', 'tdaf', 45687, 'ACTIVE', '2019-11-17 05:22:26', 6, '2019-11-17 05:22:26', 0),
(2, 8, 1, '7845227090', 'teser', 'FDAFDA', 'sdad', 'test', 'tdaf', 45687, 'ACTIVE', '2019-11-17 05:26:26', 6, '2019-11-17 05:26:26', 0),
(3, 9, 1, '7845227090', 'teser', 'FDAFDA', 'sdad', 'test', 'tdaf', 45687, 'ACTIVE', '2019-11-17 05:27:22', 6, '2019-11-17 05:27:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `code` varchar(20) CHARACTER SET latin1 NOT NULL,
  `address` varchar(250) COLLATE utf8_bin NOT NULL,
  `city` varchar(30) COLLATE utf8_bin NOT NULL,
  `state` varchar(20) COLLATE utf8_bin NOT NULL,
  `country` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'India',
  `postcode` int(11) NOT NULL,
  `contact_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `mobile` varchar(15) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `web_url` varchar(50) CHARACTER SET latin1 NOT NULL,
  `gst_no` varchar(20) COLLATE utf8_bin NOT NULL,
  `tax_no` varchar(20) COLLATE utf8_bin NOT NULL,
  `status` enum('ACTIVE','INACTIVE','','') CHARACTER SET latin1 NOT NULL DEFAULT 'ACTIVE',
  `type` enum('CUSTOMER','SUPPLIER','SERVICE','OTHER') CHARACTER SET latin1 NOT NULL DEFAULT 'CUSTOMER',
  `module` enum('PURCHASE','SERVICE','BOTH','SALE') COLLATE utf8_bin NOT NULL DEFAULT 'SALE' COMMENT 'BOTH -  Purchase & Service',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `code`, `address`, `city`, `state`, `country`, `postcode`, `contact_name`, `mobile`, `phone`, `email`, `web_url`, `gst_no`, `tax_no`, `status`, `type`, `module`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Raja R', '', '126/2, Main Road, Anandhathandavapuram', 'Mayiladuthurai', 'TN', 'IN', 609103, '', '7845227090', '7845227090', 'rajar0572@gmail.com', '', '545854', '545854', 'ACTIVE', 'CUSTOMER', 'SALE', 9, '2024-02-13 21:54:19', 9, '2024-02-13 22:33:22'),
(3, 'Raja R', '', 'Anandhathandavapuram\r\ntest', 'Mayiladuthurai', 'TN', 'IN', 609103, '', '7845227090', '7845227090', 'rajar0572@gmail.com', '', '563653465346536', '', 'ACTIVE', 'SUPPLIER', 'PURCHASE', 9, '2024-02-15 22:08:21', 0, '2024-02-15 22:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` mediumtext DEFAULT NULL,
  `tamil` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district`, `state_id`, `name`, `tamil`) VALUES
(1, 1, 'Tiruvallur', '???????????'),
(2, 1, 'Chennai', '??????'),
(3, 1, 'Kancheepuram', '???????????'),
(4, 1, 'Vellore', '??????'),
(5, 1, 'Krishnagiri', '???????????'),
(6, 1, 'Dharmapuri', '????????'),
(7, 1, 'Tiruvannamalai', '????????????'),
(8, 1, 'Viluppuram', '???????????'),
(9, 1, 'Salem', '?????'),
(10, 1, 'Namakkal', '????????'),
(11, 1, 'Erode', '?????'),
(12, 1, 'Nilgiris', '???????'),
(13, 1, 'Coimbatore', '?????????????'),
(14, 1, 'Dindigul', '???????????'),
(15, 1, 'Karur', '?????'),
(16, 1, 'Tiruchirappalli', '?????????????????'),
(17, 1, 'Perambalur', '??????????'),
(18, 1, 'Cuddalore', '??????'),
(19, 1, 'Nagapattinam', '?????????????'),
(20, 1, 'Thiruvarur', '??????????'),
(21, 1, 'Thanjavur', '?????????'),
(22, 1, 'Pudukkottai', '????????????'),
(23, 1, 'Sivaganga', '????????'),
(24, 1, 'Madurai', '?????'),
(25, 1, 'Theni', '????'),
(26, 1, 'Virudhunagar', '??????????'),
(27, 1, 'Ramanathapuram', '????????????'),
(28, 1, 'Thoothukudi', '????????????'),
(29, 1, 'Tirunelveli', '????????????'),
(30, 1, 'Kanniyakumari', '????????????'),
(31, 1, 'Ariyalur', '????????'),
(32, 1, 'Tiruppur', '??????????'),
(33, 1, 'Kallakurichi', '??????????????'),
(34, 1, 'Tenkasi', '????????'),
(35, 1, 'Chengalpattu', '????????????'),
(36, 1, 'Tirupattur', '?????????????'),
(37, 1, 'Ranipet', '?????????????');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` enum('CATEGORY','PRODUCT','PROFILE','APPLICATION','ICON','OTHER') NOT NULL,
  `path` longtext NOT NULL,
  `alt` varchar(50) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media_id`, `name`, `type`, `path`, `alt`, `status`) VALUES
(1, 1, 'Banner', '', 'banner-2762447082.jpg', '', 'ACTIVE'),
(2, 1, 'Banner', '', 'banner41271525.jpg', '', 'ACTIVE'),
(3, 1, 'Banner', '', 'banner-11086575513.jpg', '', 'ACTIVE'),
(4, 2, 'Event', '', 'bg_31880774815.jpg', '', 'ACTIVE'),
(5, 2, 'Event', '', 'cause-251453539.jpg', '', 'ACTIVE'),
(6, 4, ' Doing Nothing is No', '', '06845396698.png', '', 'ACTIVE'),
(7, 4, 'test', '', '081299915337.png', '', 'ACTIVE'),
(8, 3, '', '', 'MARKANDEYARTEMPLE1141392639.jpg', '', 'ACTIVE'),
(9, 3, '', '', '0cd89f2fa635f2dc73dc8dee21c4f42d1635595689.jpg', '', 'ACTIVE'),
(10, 4, '', '', 'Tirukoilur1117319263.jpg', '', 'ACTIVE'),
(11, 11, 'Category Image', '', 'WIN_20190714_18_38_37_Pro999700290.jpg', '', 'ACTIVE'),
(12, 12, 'Category Image', '', 'WIN_20190714_18_38_44_Pro187382711.jpg', '', 'ACTIVE'),
(13, 13, 'Category Image', '', 'WIN_20190714_18_38_44_Pro1772290040.jpg', '', 'ACTIVE'),
(14, 14, 'Category Image', '', 'WIN_20190714_18_38_44_Pro1274678067.jpg', '', 'ACTIVE'),
(15, 6, 'Product Image', 'PRODUCT', '6_1572592915_1144276378.jpg', '', 'ACTIVE'),
(16, 7, 'Product Image', 'PRODUCT', '7_1572593165_872139832.jpg', '', 'ACTIVE'),
(18, 6, 'Profile Image', 'PROFILE', '6_1573915549_1056181618.jpg', '', 'ACTIVE'),
(19, 1, 'Application Logo', 'APPLICATION', '1_1638083647_1179824449.jpg', '', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `initial` varchar(10) NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verification_code` varchar(50) DEFAULT NULL,
  `email_verification_status` int(11) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `mobile_wp` varchar(20) NOT NULL,
  `is_closed` varchar(20) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `height` decimal(10,1) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` longtext NOT NULL,
  `address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) UNSIGNED NOT NULL,
  `hook_id` int(11) UNSIGNED NOT NULL,
  `condition` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `medium` enum('EMAIL','SMS','PUSH') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'EMAIL',
  `type` enum('TRANSACTION','ALERT','REMAINDER','PROMO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'TRANSACTION',
  `from` enum('STORE','USER','NO-REPLY') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'STORE',
  `from_custom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` enum('STORE','ADMIN','STAFF','USER','CUSTOM') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USER',
  `to_add` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule_field` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'created_at',
  `schedule` varchar(25) COLLATE utf8_unicode_ci DEFAULT 'now',
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1704524247, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1704565214, 2),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1704565214, 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `type` enum('INFO','ALERT') NOT NULL DEFAULT 'INFO',
  `class` varchar(50) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `source_id` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(250) DEFAULT '',
  `message` text DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `target` enum('ALL','SPECIFIC') NOT NULL DEFAULT 'ALL',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification_status`
--

CREATE TABLE `notification_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `notification_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `read_at` timestamp NULL DEFAULT NULL,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `delete_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `app_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `order_no` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `charges` decimal(10,2) DEFAULT NULL,
  `roundoff` decimal(5,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('DRAFT','ORDERED','SCHEDULED','CANCELED','DELIVERED') NOT NULL DEFAULT 'DRAFT',
  `schedule` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `app_id`, `user_id`, `order_no`, `date`, `reference`, `amount`, `discount`, `tax`, `charges`, `roundoff`, `total`, `paid_amount`, `description`, `status`, `schedule`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, '1571462631', '2019-10-19', 'R5daa9de750639', '640.00', '0.00', '0.00', NULL, NULL, '640.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-18 23:53:51', 6, NULL, NULL),
(2, 1, 3, '1571464244', '2019-10-19', 'R5daaa434b5308', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-19 00:20:44', 6, '2019-10-19 23:15:30', 3),
(3, 1, 2, '1571464635', '2019-10-19', 'R5daaa5bb054aa', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-19 00:27:15', 6, NULL, NULL),
(4, 1, 3, '1571474163', '2019-10-19', 'R5daacaf3b3df4', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-19 03:06:03', 6, NULL, NULL),
(5, 1, 3, '1571474247', '2019-10-19', 'R5daacb47a046b', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-19 03:07:27', 6, NULL, NULL),
(6, 1, 3, '1571474447', '2019-10-19', 'R5daacc0f67c67', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-19 03:10:47', 6, '2019-10-19 23:12:33', 3),
(7, 1, 3, '1571474585', '2019-10-19', 'R5daacc996a805', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-19 03:13:05', 6, '2019-10-19 23:10:28', 3),
(8, 1, 1, '1571575757', '2019-10-20', 'R5dac57cd6e4ca', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:19:17', 6, NULL, NULL),
(9, 1, 1, '1571575903', '2019-10-20', 'R5dac585f768f1', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:21:43', 6, NULL, NULL),
(10, 1, 1, '1571576131', '2019-10-20', 'R5dac5943bbe8f', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:25:31', 6, NULL, NULL),
(11, 1, 2, '1571576153', '2019-10-20', 'R5dac5959310b0', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:25:53', 6, NULL, NULL),
(12, 1, 2, '1571576201', '2019-10-20', 'R5dac598974feb', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:26:41', 6, NULL, NULL),
(13, 1, 1, '1571576267', '2019-10-20', 'R5dac59cbc0186', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:27:47', 6, NULL, NULL),
(14, 1, 1, '1571576301', '2019-10-20', 'R5dac59ed98fff', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-20 07:28:21', 6, NULL, NULL),
(15, 1, 2, '1571576449', '2019-10-20', 'R5dac5a81e4e21', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:30:49', 6, NULL, NULL),
(16, 1, 2, '1571576474', '2019-10-20', 'R5dac5a9a4face', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'SCHEDULED', '0000-00-00 00:00:00', '2019-10-20 07:31:14', 6, NULL, NULL),
(17, 1, 2, '1571577157', '2019-10-20', 'R5dac5d4585756', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '0000-00-00 00:00:00', '2019-10-20 07:42:37', 6, NULL, NULL),
(18, 1, 2, '1571577209', '2019-10-20', 'R5dac5d7997c67', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-20 07:43:29', 6, NULL, NULL),
(19, 1, 1, '1571577456', '2019-10-20', 'R5dac5e701939f', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '0000-00-00 00:00:00', '2019-10-20 07:47:36', 6, NULL, NULL),
(20, 1, 2, '1571673650', '2019-10-21', 'R5dadd6327d959', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'SCHEDULED', '0000-00-00 00:00:00', '2019-10-21 10:30:50', 6, NULL, NULL),
(21, 1, 1, '1571673749', '2019-10-21', 'R5dadd6955a424', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'DELIVERED', '2019-10-20 13:00:00', '2019-10-21 10:32:29', 6, '2019-11-23 17:22:44', 1),
(22, 1, 1, '1571673954', '2019-10-21', 'R5dadd762d6224', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'SCHEDULED', '2019-10-20 13:00:00', '2019-10-21 10:35:54', 6, NULL, NULL),
(23, 1, 1, '1571674204', '2019-10-21', 'R5dadd85c440a5', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'SCHEDULED', '2019-10-20 13:00:00', '2019-10-21 10:40:04', 6, NULL, NULL),
(24, 1, 1, '1574577923', '2019-11-24', 'R5dda2703ec962', '300.00', '0.00', '18.00', NULL, NULL, '300.00', NULL, NULL, 'DELIVERED', '2019-11-23 13:00:00', '2019-11-24 01:15:23', 6, NULL, NULL),
(25, 1, 1, '1574578502', '2019-11-24', 'R5dda2946bb41e', '150.00', '0.00', '0.00', NULL, NULL, '150.00', NULL, NULL, 'DELIVERED', '2019-11-23 13:00:00', '2019-11-24 01:25:02', 6, '2019-11-23 17:30:50', 1),
(26, 1, 2, '1574578570', '2019-11-24', 'R5dda298a9fffb', '150.00', '0.00', '27.00', NULL, NULL, '150.00', NULL, NULL, 'DELIVERED', '2019-11-23 13:00:00', '2019-11-24 01:26:10', 6, '2019-11-23 17:28:50', 2),
(27, 1, 1, '1574580274', '2019-11-24', 'R5dda3032852d9', '300.00', '0.00', '54.00', NULL, NULL, '300.00', NULL, NULL, 'DELIVERED', '2019-11-23 13:00:00', '2019-11-24 01:54:34', 6, '2019-11-23 15:46:00', 1),
(28, 1, 1, '1574606975', '2019-11-24', 'R5dda987fd9f0b', '497.00', '0.00', '47.79', NULL, NULL, '497.00', NULL, NULL, 'DELIVERED', '2019-11-23 13:00:00', '2019-11-24 09:19:35', 6, '2019-11-23 17:14:11', 1),
(29, 1, 1, '1574607561', '2019-11-24', 'R5dda9ac9c0d6b', '470.00', '0.00', '27.00', NULL, NULL, '497.00', NULL, NULL, 'DELIVERED', '2019-11-23 13:00:00', '2019-11-24 09:29:21', 6, '2019-11-23 17:12:23', 1),
(30, 1, 1, '1578229020', '2020-01-05', 'R5e11dd1cacfd3', '640.00', '0.00', '0.00', NULL, NULL, '640.00', NULL, NULL, 'ORDERED', '2020-01-04 13:00:00', '2020-01-05 07:27:00', 6, NULL, NULL),
(31, 1, 1, '1578229497', '2020-01-05', 'R5e11def9d96b1', '790.00', '0.00', '27.00', NULL, NULL, '817.00', NULL, NULL, 'DELIVERED', '2020-01-04 13:00:00', '2020-01-05 07:34:57', 6, '2020-01-04 15:06:42', 1),
(32, 1, 1, '1578232668', '2020-01-05', 'R5e11eb5c575ad', '150.00', '0.00', '27.00', NULL, NULL, '177.00', NULL, NULL, 'ORDERED', '2020-01-04 13:00:00', '2020-01-05 08:27:48', 6, NULL, NULL),
(33, 1, 1, '1578233157', '2020-01-05', 'R5e11ed45741ac', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '2020-01-04 13:00:00', '2020-01-05 08:35:57', 6, NULL, NULL),
(34, 1, 2, '1596043381', '2020-07-29', 'R5f21b07582b82', '960.00', '0.00', '0.00', NULL, NULL, '960.00', NULL, NULL, 'DELIVERED', '2020-07-28 13:00:00', '2020-07-29 11:53:01', 6, NULL, NULL),
(35, 1, 1, '1596045723', '2020-07-29', 'R5f21b99baaadf', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '2020-07-28 13:00:00', '2020-07-29 12:32:03', 6, NULL, NULL),
(36, 1, 4, '1596220340', '2020-07-31', 'R5f2463b472012', '1040.00', '0.00', '54.00', NULL, NULL, '1094.00', NULL, NULL, 'ORDERED', '2020-07-30 13:00:00', '2020-07-31 13:02:20', 6, NULL, NULL),
(37, 1, 4, '1596563033', '2020-08-04', 'R5f299e597507f', '960.00', '0.00', '0.00', NULL, NULL, '960.00', NULL, NULL, 'ORDERED', '2020-08-03 13:00:00', '2020-08-04 12:13:53', 6, NULL, NULL),
(38, 1, 2, '1620409406', '2021-05-07', 'R60957c3e144f8', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'ORDERED', '2021-05-06 18:30:00', '2021-05-07 17:43:26', 6, NULL, NULL),
(39, 1, 2, '1625396481', '2021-07-04', 'R60e1950134c45', '590.00', '0.00', '0.00', NULL, NULL, '590.00', NULL, NULL, 'ORDERED', '2021-07-03 18:30:00', '2021-07-04 11:01:21', 6, NULL, NULL),
(40, 1, 4, '1697304964', '2023-10-14', 'R652ad18435b3b', '1060.00', '0.00', '0.00', NULL, NULL, '1060.00', NULL, NULL, 'ORDERED', '2023-10-13 18:30:00', '2023-10-14 17:36:04', 6, NULL, NULL),
(41, 1, 2, '1697305136', '2023-10-14', 'R652ad23087e99', '960.00', '0.00', '0.00', NULL, NULL, '960.00', NULL, NULL, 'ORDERED', '2023-10-13 18:30:00', '2023-10-14 17:38:56', 6, NULL, NULL),
(42, 1, 4, '1697305287', '2023-10-14', 'R652ad2c781fb8', '1060.00', '0.00', '0.00', NULL, NULL, '1060.00', NULL, NULL, 'ORDERED', '2023-10-13 18:30:00', '2023-10-14 17:41:27', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT 0.00,
  `discount_type` enum('PERCENTAGE','FIXED') NOT NULL DEFAULT 'PERCENTAGE',
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `tax_id` int(11) UNSIGNED DEFAULT NULL,
  `tax_amount` decimal(10,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `sorting` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `description`, `quantity`, `rate`, `amount`, `discount_value`, `discount_type`, `discount_amount`, `tax_id`, `tax_amount`, `total`, `sorting`) VALUES
(1, 1, 2, NULL, '2.00', '320.00', '640.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '640.00', 1),
(2, 2, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(3, 3, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(4, 4, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(5, 5, 2, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(6, 6, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(7, 7, 2, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(8, 8, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(9, 9, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(10, 10, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(11, 11, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(12, 12, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(13, 13, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(14, 14, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(15, 15, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(16, 16, 2, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(17, 17, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(18, 18, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(19, 19, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(20, 20, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(21, 21, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(22, 22, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(23, 23, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '320.00', 1),
(24, 24, 7, NULL, '2.00', '150.00', '300.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '300.00', 1),
(25, 25, 7, NULL, '1.00', '150.00', '150.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '150.00', 1),
(26, 26, 7, NULL, '1.00', '150.00', '150.00', NULL, 'PERCENTAGE', NULL, NULL, '0.00', '150.00', 1),
(27, 27, 7, NULL, '2.00', '150.00', '300.00', NULL, 'PERCENTAGE', NULL, 1, '54.00', '300.00', 1),
(28, 28, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '47.79', '320.00', 1),
(29, 28, 7, NULL, '1.00', '150.00', '177.00', NULL, 'PERCENTAGE', NULL, 1, '47.79', '177.00', 1),
(30, 29, 3, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(31, 29, 7, NULL, '1.00', '150.00', '150.00', NULL, 'PERCENTAGE', NULL, 1, '27.00', '177.00', 1),
(32, 30, 3, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(33, 30, 2, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(34, 31, 3, NULL, '2.00', '320.00', '640.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '640.00', 1),
(35, 31, 7, NULL, '1.00', '150.00', '150.00', '0.00', 'PERCENTAGE', NULL, 1, '27.00', '177.00', 1),
(36, 32, 7, NULL, '1.00', '150.00', '150.00', '0.00', 'PERCENTAGE', NULL, 1, '27.00', '177.00', 1),
(37, 33, 3, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(38, 34, 3, NULL, '3.00', '320.00', '960.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '960.00', 1),
(39, 35, 2, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(40, 36, 1, NULL, '1.00', '420.00', '420.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '420.00', 1),
(41, 36, 2, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(42, 36, 7, NULL, '2.00', '150.00', '300.00', '0.00', 'PERCENTAGE', NULL, 1, '54.00', '354.00', 1),
(43, 37, 3, NULL, '2.00', '320.00', '640.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '640.00', 1),
(44, 37, 2, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(45, 38, 3, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(46, 39, 3, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(47, 39, 4, NULL, '1.00', '120.00', '120.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '120.00', 1),
(48, 39, 6, NULL, '1.00', '150.00', '150.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '150.00', 1),
(49, 40, 3, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(50, 40, 2, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(51, 40, 1, NULL, '1.00', '420.00', '420.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '420.00', 1),
(52, 41, 3, NULL, '3.00', '320.00', '960.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '960.00', 1),
(53, 42, 3, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(54, 42, 2, NULL, '1.00', '320.00', '320.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(55, 42, 1, NULL, '1.00', '420.00', '420.00', '0.00', 'PERCENTAGE', NULL, 0, '0.00', '420.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `app_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `mode` enum('CASH','CHEQUE','BANK','CARD','PAYLATER','3RDPARTY','OTHER') NOT NULL DEFAULT 'CASH',
  `mode_info` text DEFAULT NULL,
  `decription` text DEFAULT NULL,
  `status` enum('PENDING','COMPLETED','CONFIRMED','CANCELED') NOT NULL DEFAULT 'COMPLETED',
  `type` enum('SALE','PURCHASE','SERVICE','ADVANCE','OTHER') NOT NULL DEFAULT 'SALE',
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `app_id`, `user_id`, `order_id`, `date`, `amount`, `mode`, `mode_info`, `decription`, `status`, `type`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 3, 7, '2019-10-20 00:00:00', '320.00', 'CASH', NULL, 'Cash collected', 'COMPLETED', 'SALE', 3, '2019-10-20 02:40:28', NULL, NULL),
(2, 1, 3, 6, '2019-10-20 00:00:00', '320.00', 'CASH', NULL, 'Cash Colleted', 'COMPLETED', 'SALE', 3, '2019-10-20 02:42:33', NULL, NULL),
(3, 1, 3, 2, '2019-10-20 00:00:00', '320.00', 'CARD', NULL, '', 'COMPLETED', 'SALE', 3, '2019-10-20 02:44:06', NULL, NULL),
(4, 1, 3, 2, '2019-10-20 00:00:00', '320.00', 'CARD', NULL, '', 'COMPLETED', 'SALE', 3, '2019-10-20 02:45:30', NULL, NULL),
(5, 1, 1, 9, '2019-10-20 00:00:00', '0.00', '', NULL, '', 'COMPLETED', 'SALE', 1, '2019-10-20 07:21:43', NULL, NULL),
(6, 1, 1, 14, '2019-10-20 02:58:21', '320.00', '', NULL, '', 'COMPLETED', 'SALE', 1, '2019-10-20 07:28:21', NULL, NULL),
(7, 1, 2, 18, '2019-10-20 03:13:29', '320.00', '', NULL, '', 'COMPLETED', 'SALE', 2, '2019-10-20 07:43:29', NULL, NULL),
(8, 1, 1, 19, '2019-10-20 03:17:36', '320.00', 'CASH', NULL, '', 'COMPLETED', 'SALE', 1, '2019-10-20 07:47:36', NULL, NULL),
(9, 1, 1, 24, '2019-11-24 07:45:24', '354.00', 'CASH', NULL, 'testing new 1212', 'COMPLETED', 'SALE', 1, '2019-11-24 01:15:24', NULL, NULL),
(10, 1, 1, 27, '2019-11-24 02:46:00', '354.00', 'CASH', NULL, '', 'COMPLETED', 'SALE', 1, '2019-11-24 08:16:00', NULL, NULL),
(11, 1, 1, 29, '2019-11-24 04:12:23', '497.00', 'CASH', NULL, '', 'COMPLETED', 'SALE', 1, '2019-11-24 09:42:23', NULL, NULL),
(12, 1, 1, 28, '2019-11-24 04:14:11', '497.00', 'CASH', NULL, '', 'COMPLETED', 'SALE', 1, '2019-11-24 09:44:11', NULL, NULL),
(13, 1, 1, 21, '2019-11-24 04:22:44', '320.00', '', NULL, '', 'COMPLETED', 'SALE', 1, '2019-11-24 09:52:44', NULL, NULL),
(14, 1, 2, 26, '2019-11-24 04:28:50', '150.00', '', NULL, '', 'COMPLETED', 'SALE', 2, '2019-11-24 09:58:50', NULL, NULL),
(15, 1, 1, 25, '2019-11-24 04:30:50', '150.00', 'CASH', NULL, '', 'COMPLETED', 'SALE', 1, '2019-11-24 10:00:50', NULL, NULL),
(16, 1, 1, 31, '2020-01-05 02:06:42', '817.00', 'CARD', NULL, '', 'COMPLETED', 'SALE', 1, '2020-01-05 07:36:42', NULL, NULL),
(17, 1, 2, 34, '2020-07-29 07:23:01', '960.00', 'CASH', NULL, '', 'COMPLETED', 'SALE', 2, '2020-07-29 11:53:01', NULL, NULL),
(18, 1, 6, 6, '2021-07-05 03:54:26', '640.00', 'CARD', NULL, 'Amount Paid', 'COMPLETED', 'PURCHASE', 6, '2021-07-05 13:54:26', NULL, NULL),
(19, 1, 5, 7, '2021-11-28 06:58:49', '1480.00', 'CASH', NULL, 'nope', 'COMPLETED', 'PURCHASE', 6, '2021-11-28 05:58:49', NULL, NULL),
(20, 1, 5, 8, '2023-10-14 07:36:55', '320.00', 'CASH', NULL, '', 'COMPLETED', 'PURCHASE', 6, '2023-10-14 17:36:55', NULL, NULL),
(21, 1, 5, 9, '2023-10-14 07:37:05', '320.00', 'CASH', NULL, '', 'COMPLETED', 'PURCHASE', 6, '2023-10-14 17:37:05', NULL, NULL),
(22, 1, 5, 10, '2023-10-14 07:37:16', '320.00', 'CASH', NULL, '', 'COMPLETED', 'PURCHASE', 6, '2023-10-14 17:37:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `app_id`, `name`, `type`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Cash', 'CASH', '', 6, '2019-11-10 21:29:41', 0, '2019-11-10 10:29:41'),
(2, 1, 'CARD', 'CARD', 'ACTIVE', 6, '2020-07-28 23:52:52', 0, '2020-07-28 12:52:52'),
(3, 1, '', '', 'ACTIVE', 6, '2023-10-14 23:09:52', 0, '2023-10-14 17:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `parant_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `code` varchar(25) CHARACTER SET latin1 NOT NULL,
  `upc_code` varchar(50) CHARACTER SET latin1 NOT NULL,
  `hsn_sac_code` varchar(50) CHARACTER SET latin1 NOT NULL,
  `rate` int(11) NOT NULL,
  `special_rate` int(11) NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `short_desc` varchar(100) COLLATE utf8_bin NOT NULL,
  `stock` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `quantity` varchar(20) COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin NOT NULL,
  `image_status` int(11) NOT NULL DEFAULT 1,
  `min_order_qty` int(11) NOT NULL,
  `product_type` enum('SALES','PURCHASE','','') CHARACTER SET latin1 NOT NULL DEFAULT 'SALES',
  `status` enum('ACTIVE','INACTIVE','','') CHARACTER SET latin1 NOT NULL DEFAULT 'ACTIVE',
  `sorting` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `parant_id`, `app_id`, `name`, `code`, `upc_code`, `hsn_sac_code`, `rate`, `special_rate`, `description`, `short_desc`, `stock`, `tax_id`, `unit_id`, `quantity`, `image`, `image_status`, `min_order_qty`, `product_type`, `status`, `sorting`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, 'அச்சு முறுக்கு', 'R30610190001', 'R30610190001', 'R30610190001', 450, 420, 'முறுக்கு என்பது உளுந்து மாவு, அரிசிமாவு, கலந்து உருவாக்கப்படும் ஒரு பலகாரம் ஆகும்.\r\n\r\n', 'முறுக்கு என்பது உளுந்து மாவு, அரிசிமாவு, கலந்து உருவாக்கப்படும் ஒரு பலகாரம் ஆகும்.\r\n\r\n', 100, 0, 1, '500', '5.jpg', 1, 1, '', 'ACTIVE', 1, 1, '2019-10-06 10:30:02', 0, '2019-10-06 10:30:02'),
(2, 1, 1, 'அரிசி முறுக்கு', 'R30610190002', 'R30610190002', 'R30610190002', 350, 320, 'முறுக்கு என்பது உளுந்து மாவு, அரிசிமாவு, கலந்து உருவாக்கப்படும் ஒரு பலகாரம் ஆகும்.\r\n\r\n', 'முறுக்கு என்பது உளுந்து மாவு, அரிசிமாவு, கலந்து உருவாக்கப்படும் ஒரு பலகாரம் ஆகும்.', 100, 0, 1, '500', '6.jpg', 1, 1, '', 'ACTIVE', 1, 1, '2019-10-06 10:35:53', 0, '2019-10-06 10:35:53'),
(3, 1, 1, 'தேங்காய்ப்பால் முறுக்கு', 'R30610190003', 'R30610190003', 'R30610190003', 350, 320, 'முறுக்கு என்பது உளுந்து மாவு, அரிசிமாவு, கலந்து உருவாக்கப்படும் ஒரு பலகாரம் ஆகும்.', 'முறுக்கு என்பது உளுந்து மாவு, அரிசிமாவு, கலந்து உருவாக்கப்படும் ஒரு பலகாரம் ஆகும்.', 100, 0, 1, '500', '7.jpg', 1, 1, '', 'ACTIVE', 1, 1, '2019-10-06 10:35:53', 0, '2019-10-06 10:35:53'),
(4, 2, 1, 'கடலை மிட்டாய்', 'R30610190004', 'R30610190004', 'R30610190004', 150, 120, 'கடலை மிட்டாய் என்பது உடைத்த நிலக்கடலை, கருப்பட்டி அல்லது வெல்லம் கொண்டு செய்யப்படும் இனிப்புச் சுவையுடைய ஒரு தின்பண்டம்', 'கடலை மிட்டாய் என்பது உடைத்த நிலக்கடலை, கருப்பட்டி அல்லது வெல்லம் கொண்டு செய்யப்படும் இனிப்புச் சுவைய', 100, 0, 1, '500', '2.jpg', 1, 1, '', 'ACTIVE', 1, 1, '2019-10-06 10:35:53', 0, '2019-10-06 10:35:53'),
(5, 2, 1, 'Kadalai Mittai', '64545', '654+6', '6455+', 230, 250, 'dfdasdfa', 'dfsadafasd', 50, 0, 0, '', '', 1, 0, 'SALES', 'ACTIVE', 0, 6, '2019-10-15 22:49:25', 0, '2019-10-15 22:49:25'),
(6, 5, 1, 'மிச்சர்', 'rqweerq', '452452', '42354', 150, 0, 'மிச்சர்', 'மிச்சர்', 200, 0, 1, '500', '', 1, 0, 'SALES', 'ACTIVE', 0, 6, '2019-11-01 12:51:54', 0, '2019-11-01 12:51:54'),
(7, 5, 1, 'முறுக்கு', '5wertewr', '5t5435', '5y5634563', 150, 0, 'முறுக்கு', 'முறுக்கு', 800, 1, 1, '600', '', 1, 0, 'SALES', 'ACTIVE', 0, 6, '2019-11-01 12:56:05', 0, '2019-11-01 12:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) UNSIGNED NOT NULL,
  `app_id` int(11) UNSIGNED NOT NULL,
  `supplier_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED DEFAULT NULL,
  `purchase_no` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `charges` decimal(10,2) DEFAULT NULL,
  `roundoff` decimal(5,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `payment_status` enum('NIL','PARTIAL','PAID') NOT NULL DEFAULT 'NIL',
  `status` enum('DRAFT','COLLECTED','PURCHASED','CANCELED','HOLD','REJECTED') NOT NULL DEFAULT 'DRAFT',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `app_id`, `supplier_id`, `order_id`, `purchase_no`, `date`, `due_date`, `reference`, `amount`, `discount`, `tax`, `charges`, `roundoff`, `total`, `terms`, `description`, `payment_status`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 3, NULL, '1596566905', '2020-08-04', NULL, 'R5f29ad7906c96', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'NIL', 'COLLECTED', '2020-08-04 13:18:25', 6, NULL, NULL),
(2, 1, 3, NULL, '1625396264', '2021-07-04', NULL, 'R60e194285a5a6', '1060.00', '0.00', '0.00', NULL, NULL, '1060.00', NULL, NULL, 'NIL', 'COLLECTED', '2021-07-04 10:57:44', 6, NULL, NULL),
(4, 1, 3, NULL, '1625492886', '2021-07-05', NULL, 'R60e30d961b97f', '640.00', '0.00', '0.00', NULL, NULL, '640.00', NULL, NULL, 'NIL', 'COLLECTED', '2021-07-05 13:48:06', 6, NULL, NULL),
(5, 1, 3, NULL, '1625493019', '2021-07-05', NULL, 'R60e30e1b6da9d', '640.00', '0.00', '0.00', NULL, NULL, '640.00', NULL, NULL, 'NIL', 'COLLECTED', '2021-07-05 13:50:19', 6, NULL, NULL),
(6, 1, 3, NULL, '1625493266', '2021-07-05', NULL, 'R60e30f129bd21', '640.00', '0.00', '0.00', NULL, NULL, '640.00', NULL, NULL, 'NIL', 'COLLECTED', '2021-07-05 13:54:26', 6, NULL, NULL),
(7, 1, 5, NULL, '1638079129', '2021-11-28', NULL, 'R61a31a99107e1', '1480.00', '0.00', '0.00', NULL, NULL, '1480.00', NULL, NULL, 'NIL', 'COLLECTED', '2021-11-28 05:58:49', 6, NULL, NULL),
(8, 1, 5, NULL, '1697305015', '2023-10-14', NULL, 'R652ad1b7c9cc3', '320.00', '0.00', '0.00', NULL, NULL, '320.00', NULL, NULL, 'NIL', 'COLLECTED', '2023-10-14 17:36:55', 6, NULL, NULL),
(9, 1, 5, NULL, '1697305025', '2023-10-14', NULL, 'R652ad1c1e39da', '0.00', '0.00', '0.00', NULL, NULL, '0.00', NULL, NULL, 'NIL', 'COLLECTED', '2023-10-14 17:37:05', 6, NULL, NULL),
(10, 1, 5, NULL, '1697305036', '2023-10-14', NULL, 'R652ad1cc4e888', '0.00', '0.00', '0.00', NULL, NULL, '0.00', NULL, NULL, 'NIL', 'COLLECTED', '2023-10-14 17:37:16', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product`
--

CREATE TABLE `purchase_product` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `discount_type` enum('PERCENTAGE','FIXED') NOT NULL DEFAULT 'PERCENTAGE',
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `tax_id` int(11) UNSIGNED DEFAULT NULL,
  `tax_amount` decimal(10,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `sorting` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`id`, `purchase_id`, `product_id`, `product_name`, `description`, `quantity`, `rate`, `amount`, `discount_value`, `discount_type`, `discount_amount`, `tax_id`, `tax_amount`, `total`, `sorting`) VALUES
(1, 1, 3, NULL, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(2, 1, 3, NULL, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(3, 1, 2, NULL, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(4, 1, 1, NULL, NULL, '1.00', '420.00', '420.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '420.00', 1),
(5, 4, 3, NULL, NULL, '2.00', '320.00', '640.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '640.00', 1),
(6, 5, 3, NULL, NULL, '2.00', '320.00', '640.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '640.00', 1),
(7, 6, 3, NULL, NULL, '2.00', '320.00', '640.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '640.00', 1),
(8, 7, 3, NULL, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(9, 7, 2, NULL, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1),
(10, 7, 1, NULL, NULL, '2.00', '420.00', '840.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '840.00', 1),
(11, 8, 3, NULL, NULL, '1.00', '320.00', '320.00', NULL, 'PERCENTAGE', NULL, 0, '0.00', '320.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  `companytype_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `column` text NOT NULL,
  `render` varchar(100) NOT NULL DEFAULT 'grid',
  `params` text NOT NULL,
  `sql` text NOT NULL,
  `function` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sorting` smallint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `class`, `key`, `value`, `type`, `context`, `created_at`, `updated_at`) VALUES
(1, 'Config\\App', 'companyName', 'Agaval POS', 'string', NULL, '2024-01-16 22:09:58', '2024-01-16 22:10:44'),
(2, 'Config\\App', 'companyMobile', '9585048650', 'string', NULL, '2024-01-16 22:09:58', '2024-01-16 22:10:44'),
(3, 'Config\\App', 'companyPhone', '9585048650', 'string', NULL, '2024-01-16 22:09:58', '2024-01-16 22:10:44'),
(4, 'Config\\App', 'companyEmail', 'rajar0572@gmail.com', 'string', NULL, '2024-01-16 22:09:58', '2024-01-16 22:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `percentage` decimal(8,2) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `default_tax` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `name`, `percentage`, `reg_no`, `status`, `default_tax`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'GST 28%', '28.00', 'GST254234866', 'ACTIVE', 'NO', '2024-01-21 16:31:27', '2024-01-21 16:33:54', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `reference_id` varchar(50) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `transaction_app_id` varchar(50) NOT NULL,
  `type` enum('Gpay','PhonePe','PayTm','Cash','Other') NOT NULL,
  `status` enum('PENDING','SUCCESS','CONFIRM','REJECT','WAITING','COMPLETE') NOT NULL DEFAULT 'PENDING',
  `name` varchar(50) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `command` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `reference_id`, `transaction_id`, `transaction_app_id`, `type`, `status`, `name`, `booking_id`, `user_id`, `amount`, `command`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '905', 2147483647, '2147483647', 'Gpay', '', 'Raja', 6, 0, 2000, '', '2019-09-01 23:26:31', 0, '0000-00-00 00:00:00', 0),
(2, '905', 2147483647, '2147483647', 'Gpay', '', '43245dfa', 6, 0, 2000, '', '2019-09-02 21:14:42', 0, '0000-00-00 00:00:00', 0),
(3, '905', 0, '0', 'PhonePe', '', '', 6, 0, 2000, '', '2019-09-02 21:28:21', 0, '0000-00-00 00:00:00', 0),
(4, '0905d73de5bbf3f9', 2147483647, '45234245321212', 'Gpay', '', 'Raja', 2, 0, 2000, '', '2019-09-07 22:14:11', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Grams', 'Grams Description', 'ACTIVE', '2024-01-21 22:05:06', NULL, 1, NULL),
(2, 'Nos', 'Nos Description', 'ACTIVE', '2024-01-22 21:53:30', '2024-01-22 22:08:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `address` tinytext NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `first_name`, `last_name`, `mobile`, `birth_date`, `address`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'rajar0572@gmail.com', 'RajaR', 'Raja Raman', '', '7845227090', NULL, '', '$2y$10$51IzUABqoRVjB/sYrQt55.9D9K13Tel9vpolIW/hd5j68EM3xuqy.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-01-06 18:10:02', '2024-01-06 18:10:02', NULL),
(2, 'rajar0573@gmail.com', 'RajaRaman', '', '', '', NULL, '', '$2y$10$nn5hcjWI0K5VIsA2EwMZLOX/q.YEhW/J/QwzulWwSLsh1PEvn4skK', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-05 21:54:15', '2024-02-05 21:54:15', NULL),
(3, 'rajar0575@gmail.com', 'RajaRaman15', '', '', '', NULL, '', '$2y$10$pcgoPsFCJScAZ.RCja4N.OYI/fsLGYe/Gw/nCXrRWD2wj3iOCwkHm', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-05 21:56:00', '2024-02-05 21:56:00', NULL),
(4, 'superadmin@gmail.com', 'SuperAdmin', '', '', '', NULL, '', '$2y$10$XSKyUnsseVjvjKgKIchmUuHw8t0M3tKl46tz1hTEKA4W1WL0WFw6q', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-05 21:57:45', '2024-02-05 21:57:45', NULL),
(5, 'rajar0512@gmail.com', 'RajaRaman14', 'Raja', 'R', '7845227090', '0000-00-00', 'Anandhathandavapuram', '$2y$10$/g91uvGSGUngTKb5gsekveK54QkO94rDwasSwVngwB176br75b0/W', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-05 22:12:10', '2024-02-05 22:12:10', NULL),
(6, 'raja1572@gmail.com', 'RajaRaman11', 'Raja', 'R', '7845227090', '0000-00-00', 'Anandhathandavapuram', '$2y$10$SzqeY8pXccfy/0IFSwXYe.1QsOjpQcIdLyWwSE91N3gOOoB/hES.O', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-05 22:13:43', '2024-02-05 22:13:43', NULL),
(7, 'rajar172@gmail.com', 'RajaRaman1', 'Raja', 'R', '7845227090', '0000-00-00', 'Anandhathandavapuram', '$2y$10$GrN0qhR1vvj6CTvOqp3.v.IKefjKZZx6VkUNfDmgVc49x9jw7zBti', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-05 22:14:50', '2024-02-05 22:14:50', NULL),
(8, 'rajar111@gmail.com', 'LathaR', 'Raja', 'Raman', '9585048650', '0000-00-00', 'Anandhathandavapuram', '$2y$10$nMdGnZgF14U6/V8oIxj.0u71J7gaDzgX9K43Ia6E121Bp17DgMtim', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-05 22:20:08', '2024-02-05 22:20:08', NULL),
(9, 'agaval@gmail.com', 'Agaval', 'Agaval', 'Pos', '7845227090', '1992-03-15', 'Anandhathandavapuram', '$2y$10$iVtDuAWXrcq2rcGQOn1hSuID7vqrvZXkLDZqW/8dEvYkY7k0C.jM.', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 1, 0, '2024-02-06 21:49:02', '2024-02-06 21:49:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_product`
--
ALTER TABLE `purchase_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
