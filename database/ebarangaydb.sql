-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2022 at 01:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebarangaydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `BarangayID` int(11) NOT NULL,
  `BarangayName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `City` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brgyCaptain` int(11) DEFAULT NULL,
  `Province` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cebu',
  `barangay_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brgy_default.png',
  `brgyTelephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brgyEmail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brgyCell` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`BarangayID`, `BarangayName`, `City`, `brgyCaptain`, `Province`, `barangay_pic`, `brgyTelephone`, `brgyEmail`, `brgyCell`, `Status`) VALUES
(1, 'Bakilid', 'Mandaue', 0, 'Cebu', 'brgy_default.png', NULL, NULL, NULL, 'Inactive'),
(2, 'Paknaan', 'Mandaue', 29, 'Cebu', 'brgy_default.png', '546-9872', 'craigejonard@gmail.com', '09758423457', 'Active'),
(3, 'Maguikay', 'Mandaue', NULL, 'Cebu', 'brgy_default.png', NULL, NULL, NULL, 'Inactive'),
(4, 'Cambaro', 'Mandaue', NULL, 'Cebu', 'brgy_default.png', NULL, NULL, NULL, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidateID` int(11) NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `platform` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purok` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UsersID` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  `position` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidateID`, `lastname`, `firstname`, `created_at`, `updated_at`, `platform`, `purok`, `UsersID`, `electionID`, `position`) VALUES
(25, 'Johnson', 'Xavier', '2022-03-18 00:05:43', '2022-03-18 00:05:43', 'Test', 'Kamatis', 28, 11, 'Purok Leader'),
(26, 'Johnson', 'Xavier', '2022-03-18 01:51:17', '2022-03-18 01:51:17', 'Test', 'Kamatis', 28, 13, 'Purok Leader'),
(27, 'Plumber', 'Mr', '2022-03-18 01:51:25', '2022-03-18 01:51:25', 'Test', 'Kamatis', 39, 13, 'Purok Leader'),
(28, 'Torts', 'Woshua', '2022-03-18 01:51:34', '2022-03-18 01:51:34', 'Test', 'Kamatis', 34, 13, 'Purok Leader'),
(29, 'Struction', 'Mr', '2022-03-18 01:51:41', '2022-03-18 01:51:41', 'Test', 'Kamatis', 40, 13, 'Purok Leader');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentsID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactID` int(11) NOT NULL,
  `contactName` varchar(20) NOT NULL,
  `contactNum` varchar(20) NOT NULL,
  `BarangayID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactID`, `contactName`, `contactNum`, `BarangayID`) VALUES
(2, 'PNP', '', 2),
(3, 'asdasd', '(032)340-5560', 2);

-- --------------------------------------------------------

--
-- Table structure for table `documentpurpose`
--

CREATE TABLE `documentpurpose` (
  `purposeID` int(11) NOT NULL,
  `purpose` varchar(20) NOT NULL,
  `barangayDoc` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `barangay` varchar(20) NOT NULL,
  `studentDiscount` varchar(20) NOT NULL,
  `seniorDiscount` varchar(20) NOT NULL,
  `pwdDiscount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documentpurpose`
--

INSERT INTO `documentpurpose` (`purposeID`, `purpose`, `barangayDoc`, `price`, `barangay`, `studentDiscount`, `seniorDiscount`, `pwdDiscount`) VALUES
(3, 'Ayuda', 'Indigency Clearance', '0', 'Paknaan', '0', '0', '0'),
(4, 'Test', 'Indigency Clearance', '0', 'Paknaan', '0', '0', '0'),
(5, 'Test', 'Cedula', '222', 'Paknaan', '0', '20', '0');

-- --------------------------------------------------------

--
-- Table structure for table `documenttype`
--

CREATE TABLE `documenttype` (
  `DocumentID` int(11) NOT NULL,
  `documentName` varchar(20) NOT NULL,
  `barangayID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `electionID` int(11) NOT NULL,
  `electionTitle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `electionStatus` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paused',
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `barangay` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purok` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionID`, `electionTitle`, `electionStatus`, `created_by`, `created_at`, `updated_at`, `barangay`, `purok`) VALUES
(11, 'Term 2022-2023', 'Finished', '29', '2022-03-13 06:01:32', '2022-03-13 06:01:32', 'Paknaan', 'Kamatis'),
(13, 'Term 2026-2027', 'Finished', '29', '2022-03-18 01:50:56', '2022-03-18 01:50:56', 'Paknaan', 'Kamatis'),
(19, 'Test', 'Paused', '29', '2022-03-31 20:38:35', '2022-03-31 20:38:35', 'Paknaan', 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamo`
--

CREATE TABLE `ereklamo` (
  `ReklamoID` int(11) NOT NULL,
  `reklamoType` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CreatedOn` datetime DEFAULT current_timestamp(),
  `UpdatedOn` datetime DEFAULT current_timestamp(),
  `comment` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedBy` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedOn` datetime DEFAULT NULL,
  `complaintLevel` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Minor',
  `complainee` int(11) DEFAULT NULL,
  `scheduledSummon` date DEFAULT NULL,
  `UsersID` int(11) DEFAULT NULL,
  `barangay` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purok` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamo`
--

INSERT INTO `ereklamo` (`ReklamoID`, `reklamoType`, `detail`, `status`, `CreatedOn`, `UpdatedOn`, `comment`, `checkedBy`, `checkedOn`, `complaintLevel`, `complainee`, `scheduledSummon`, `UsersID`, `barangay`, `purok`) VALUES
(31, 'Residents', 'Drugs', 'Pending', '2022-04-19 22:30:13', '2022-04-19 22:30:13', 'Test', NULL, NULL, 'Major', 34, NULL, 28, 'Paknaan', 'Kamatis'),
(32, 'Garbages', 'Improper disposal', 'Pending', '2022-04-19 22:30:53', '2022-04-19 22:30:53', 'Test', NULL, NULL, 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis'),
(33, 'Residents', 'Drugs', 'Pending', '2022-04-25 15:21:20', '2022-04-25 15:21:20', '', NULL, NULL, 'Major', 34, NULL, 28, 'Paknaan', 'Kamatis');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamocategory`
--

CREATE TABLE `ereklamocategory` (
  `reklamoCatID` int(11) NOT NULL,
  `reklamoCatName` varchar(50) NOT NULL,
  `reklamoCatBrgy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ereklamocategory`
--

INSERT INTO `ereklamocategory` (`reklamoCatID`, `reklamoCatName`, `reklamoCatBrgy`) VALUES
(6, 'Garbages', 'Paknaan'),
(7, 'Residents', 'Paknaan'),
(8, 'Barangay Infrastructures', 'Paknaan');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamotype`
--

CREATE TABLE `ereklamotype` (
  `reklamoTypeID` int(11) NOT NULL,
  `reklamoTypeName` varchar(100) NOT NULL,
  `reklamoTypePriority` varchar(20) NOT NULL,
  `reklamoCatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ereklamotype`
--

INSERT INTO `ereklamotype` (`reklamoTypeID`, `reklamoTypeName`, `reklamoTypePriority`, `reklamoCatID`) VALUES
(1, 'Improper disposal', 'Minor', 6),
(3, 'Drugs', 'Major', 7),
(4, 'Noise', 'Minor', 7),
(5, 'Broken Roads', 'Minor', 8),
(6, 'Broken Lightposts', 'Minor', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Not Read',
  `UsersID` int(11) DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `message`, `type`, `status`, `UsersID`, `position`, `created_at`, `updated_at`) VALUES
(15, 'Your account has been verified!', 'Resident', 'Read', 29, NULL, '2022-03-03 14:11:53', '2022-03-03 14:11:53'),
(16, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-03 19:57:47', '2022-03-03 19:57:47'),
(17, 'A resident has submitted a reklamo: Kuryente', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-03-04 17:56:52', '2022-03-04 17:56:52'),
(18, 'A resident has submitted a reklamo: Kuryente', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-03-04 20:35:16', '2022-03-04 20:35:16'),
(19, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-05 19:54:11', '2022-03-05 19:54:11'),
(20, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-05 20:01:29', '2022-03-05 20:01:29'),
(21, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-05 23:17:47', '2022-03-05 23:17:47'),
(22, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-05 23:19:34', '2022-03-05 23:19:34'),
(23, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Read', NULL, 'Secretary', '2022-03-17 16:37:52', '2022-03-17 16:37:52'),
(30, 'Your eReklamo has been scheduled on 2022-03-17', 'ereklamo', 'Read', 28, 'Resident', '2022-03-17 22:13:32', '2022-03-17 22:13:32'),
(31, 'Your eReklamo has been scheduled on 2022-03-30', 'ereklamo', 'Read', 28, 'Resident', '2022-03-17 22:35:10', '2022-03-17 22:35:10'),
(32, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Read', NULL, 'Secretary', '2022-03-17 23:10:50', '2022-03-17 23:10:50'),
(33, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Read', NULL, 'Secretary', '2022-03-17 23:27:34', '2022-03-17 23:27:34'),
(34, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-03-20 17:00:11', '2022-03-20 17:00:11'),
(35, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-03-21 11:11:15', '2022-03-21 11:11:15'),
(36, 'A resident has submitted a reklamo: Kuryente', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-03-22 18:52:24', '2022-03-22 18:52:24'),
(37, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Read', NULL, 'Secretary', '2022-03-24 14:46:52', '2022-03-24 14:46:52'),
(38, 'Your eReklamo#15 has been responded by Resident Xavier.', 'ereklamo', 'Read', 28, 'Resident', '2022-03-26 21:02:23', '2022-03-26 21:02:23'),
(39, 'A resident has submitted a reklamo: Kuryente', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-03-26 21:45:36', '2022-03-26 21:45:36'),
(40, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Read', NULL, 'Secretary', '2022-03-26 22:56:12', '2022-03-26 22:56:12'),
(41, 'Your eReklamo has been scheduled on 2022-03-28', 'ereklamo', 'Read', 34, 'Resident', '2022-03-27 20:15:43', '2022-03-27 20:15:43'),
(42, 'Your eReklamo$#16 has been responded by Captain Jeremy.', 'ereklamo', 'Read', 29, 'Resident', '2022-03-27 20:32:52', '2022-03-27 20:32:52'),
(43, 'Your eReklamo#16 has been responded by Captain Jeremy.', 'ereklamo', 'Read', 29, 'Resident', '2022-03-27 20:46:34', '2022-03-27 20:46:34'),
(44, 'Your eReklamo#18 has been responded by Captain Jeremy.', 'ereklamo', 'Read', 30, 'Resident', '2022-03-27 20:46:38', '2022-03-27 20:46:38'),
(45, 'Your eReklamo has been scheduled on 2022-03-28', 'ereklamo', 'Read', 29, 'Resident', '2022-03-27 20:46:55', '2022-03-27 20:46:55'),
(46, 'Your eReklamo has been scheduled on 2022-03-28', 'ereklamo', 'Read', 30, 'Resident', '2022-03-27 20:46:59', '2022-03-27 20:46:59'),
(47, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-03-27 21:11:24', '2022-03-27 21:11:24'),
(48, 'Your account verification has been approved!', 'Resident', 'Read', 37, NULL, '2022-03-27 21:42:51', '2022-03-27 21:42:51'),
(49, 'Your account verification has been approved!', 'Resident', 'Read', 29, NULL, '2022-03-27 21:42:54', '2022-03-27 21:42:54'),
(50, 'Your account verification has been approved!', 'Resident', 'Read', 31, NULL, '2022-03-27 21:42:57', '2022-03-27 21:42:57'),
(51, 'Your account verification has been approved!', 'Resident', 'Read', 30, NULL, '2022-03-27 21:43:01', '2022-03-27 21:43:01'),
(52, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-03-28 01:10:08', '2022-03-28 01:10:08'),
(53, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-28 12:07:25', '2022-03-28 12:07:25'),
(54, 'Your account verification has been approved!', 'Resident', 'Read', 28, NULL, '2022-03-28 13:32:12', '2022-03-28 13:32:12'),
(55, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-28 13:48:12', '2022-03-28 13:48:12'),
(56, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-03-28 15:21:47', '2022-03-28 15:21:47'),
(57, 'A resident has submitted a reklamo: Kuryente', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-03-28 15:31:45', '2022-03-28 15:31:45'),
(58, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-28 16:16:12', '2022-03-28 16:16:12'),
(59, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-28 16:31:39', '2022-03-28 16:31:39'),
(60, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Not Read', NULL, 'Secretary', '2022-03-28 17:13:02', '2022-03-28 17:13:02'),
(61, 'Your account verification has been approved!', 'Resident', 'Not Read', 39, NULL, '2022-03-28 21:40:09', '2022-03-28 21:40:09'),
(62, 'Your account verification has been approved!', 'Resident', 'Not Read', 40, NULL, '2022-03-28 21:40:11', '2022-03-28 21:40:11'),
(63, 'Your account verification has been approved!', 'Resident', 'Not Read', 34, NULL, '2022-03-28 21:40:13', '2022-03-28 21:40:13'),
(64, 'Your eReklamo#20 has been responded by Resident Woshua.', 'ereklamo', 'Read', 28, 'Resident', '2022-03-28 21:45:10', '2022-03-28 21:45:10'),
(65, 'Your eReklamo has been scheduled on 2022-03-30', 'ereklamo', 'Read', 39, 'Resident', '2022-03-28 21:53:42', '2022-03-28 21:53:42'),
(66, 'Your eReklamo#20 has been responded by Captain Jeremy.', 'ereklamo', 'Read', 28, 'Resident', '2022-03-28 22:04:27', '2022-03-28 22:04:27'),
(67, 'Your eReklamo#20 has been responded by Captain Jeremy.', 'ereklamo', 'Read', 28, 'Resident', '2022-03-28 22:20:44', '2022-03-28 22:20:44'),
(68, 'Your eReklamo#20 has been rescheduled by Captain Jeremy.', 'ereklamo', 'Read', 28, 'Resident', '2022-03-28 22:21:10', '2022-03-28 22:21:10'),
(69, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-03-29 07:31:09', '2022-03-29 07:31:09'),
(70, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-03-29 07:36:50', '2022-03-29 07:36:50'),
(71, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-04-02 15:27:45', '2022-04-02 15:27:45'),
(72, 'A resident has submitted a reklamo: Residents', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-15 21:07:51', '2022-04-15 21:07:51'),
(73, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 15:22:42', '2022-04-19 15:22:42'),
(74, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 21:16:58', '2022-04-19 21:16:58'),
(75, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 21:17:08', '2022-04-19 21:17:08'),
(76, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 22:15:05', '2022-04-19 22:15:05'),
(77, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 22:15:21', '2022-04-19 22:15:21'),
(78, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 22:15:32', '2022-04-19 22:15:32'),
(79, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 22:21:37', '2022-04-19 22:21:37'),
(80, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 22:30:13', '2022-04-19 22:30:13'),
(81, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-19 22:30:53', '2022-04-19 22:30:53'),
(82, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-04-25 15:21:20', '2022-04-25 15:21:20'),
(83, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-04-26 17:49:24', '2022-04-26 17:49:24'),
(84, 'Your account verification has been approved!', 'Resident', 'Not Read', 0, NULL, '2022-04-26 19:20:26', '2022-04-26 19:20:26'),
(85, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-04-26 19:21:57', '2022-04-26 19:21:57'),
(86, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-04-26 19:22:36', '2022-04-26 19:22:36'),
(87, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-04-26 19:22:57', '2022-04-26 19:22:57'),
(88, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-04-26 19:23:33', '2022-04-26 19:23:33'),
(89, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-04-26 19:24:41', '2022-04-26 19:24:41'),
(90, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-01-10 13:16:59', '2022-01-10 13:16:59'),
(91, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-01-10 13:17:46', '2022-01-10 13:17:46'),
(92, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-01-10 13:22:33', '2022-01-10 13:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `OfficialID` int(11) DEFAULT NULL,
  `NationalID` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residentID` int(11) DEFAULT NULL,
  `electedOn` date DEFAULT NULL,
  `updatedOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postMessage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `barangay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`PostID`, `UsersID`, `username`, `userType`, `postMessage`, `date_created`, `barangay`) VALUES
(69, 29, 'captain1', 'Captain', 'Vaccination for kids!! ', '2022-03-02 19:43:01', 'Paknaan');

-- --------------------------------------------------------

--
-- Table structure for table `purok`
--

CREATE TABLE `purok` (
  `PurokID` int(11) NOT NULL,
  `PurokName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BarangayName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Active` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'True',
  `purokLeader` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purok`
--

INSERT INTO `purok` (`PurokID`, `PurokName`, `BarangayName`, `Active`, `purokLeader`) VALUES
(1, 'Kamatis', 'Paknaan', 'True', 31),
(2, 'Berde', 'Bakilid', 'True', NULL),
(3, 'Piattos', 'Maguikay', 'True', NULL),
(4, 'Pula', 'Bakilid', 'True', NULL),
(5, 'Nova', 'Maguikay', 'True', NULL),
(6, 'Chippy', 'Maguikay', 'True', NULL),
(7, 'Sprite', 'Cambaro', 'True', NULL),
(8, 'Coke', 'Cambaro', 'True', NULL),
(9, 'Apple', 'Paknaan', 'False', NULL),
(10, 'Papayas', 'Paknaan', 'False', NULL),
(11, 'Kamanggahan', 'Pajo', 'True', NULL),
(12, 'Sah', 'Bakilid', 'False', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` int(11) NOT NULL,
  `ReportType` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reportMessage` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsersID` int(11) NOT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT current_timestamp(),
  `userBarangay` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userPurok` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportID`, `ReportType`, `reportMessage`, `UsersID`, `created_on`, `updated_on`, `userBarangay`, `userPurok`) VALUES
(2, 'eReklamo', 'Purok Leader Caitleen has resolved ereklamo#7', 23, '2022-02-24 20:15:16', '2022-02-24 20:15:16', 'Paknaan', 'Kamatis'),
(16, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#12 on 2022-03-30', 30, '2022-03-17 22:35:11', '2022-03-17 22:35:11', 'Paknaan', 'Kamatis'),
(17, 'eReklamo', 'Resident Xavier has resolved ereklamo#15', 28, '2022-03-26 21:02:23', '2022-03-26 21:02:23', 'Paknaan', 'Kamatis'),
(18, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#14 on 2022-03-28', 30, '2022-03-27 20:15:43', '2022-03-27 20:15:43', 'Paknaan', 'Kamatis'),
(19, 'eReklamo', 'Captain Jeremy has resolved ereklamo#16', 29, '2022-03-27 20:46:34', '2022-03-27 20:46:34', 'Paknaan', 'Kamatis'),
(20, 'eReklamo', 'Captain Jeremy has resolved ereklamo#18', 29, '2022-03-27 20:46:38', '2022-03-27 20:46:38', 'Paknaan', 'Kamatis'),
(21, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#16 on 2022-03-28', 30, '2022-03-27 20:46:55', '2022-03-27 20:46:55', 'Paknaan', 'Kamatis'),
(22, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#18 on 2022-03-28', 30, '2022-03-27 20:46:59', '2022-03-27 20:46:59', 'Paknaan', 'Kamatis'),
(23, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 01:18:24', '2022-03-28 01:18:24', 'Paknaan', 'Kamatis'),
(24, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 01:19:13', '2022-03-28 01:19:13', 'Paknaan', 'Kamatis'),
(25, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 01:21:46', '2022-03-28 01:21:46', 'Paknaan', 'Kamatis'),
(26, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 01:58:46', '2022-03-28 01:58:46', 'Paknaan', 'Kamatis'),
(27, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 02:01:37', '2022-03-28 02:01:37', 'Paknaan', 'Kamatis'),
(28, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 02:18:54', '2022-03-28 02:18:54', 'Paknaan', 'Kamatis'),
(31, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 03:06:46', '2022-03-28 03:06:46', 'Paknaan', 'Kamatis'),
(32, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 03:10:14', '2022-03-28 03:10:14', 'Paknaan', 'Kamatis'),
(33, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 03:29:03', '2022-03-28 03:29:03', 'Paknaan', 'Kamatis'),
(34, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 03:34:56', '2022-03-28 03:34:56', 'Paknaan', 'Kamatis'),
(35, 'Request', 'Secretary Handson,Roxy has released the RequestID # 18', 30, '2022-03-28 03:49:34', '2022-03-28 03:49:34', 'Paknaan', 'Kamatis'),
(36, 'Request', 'Secretary Handson,Roxy has released the RequestID # 19', 30, '2022-03-28 12:14:59', '2022-03-28 12:14:59', 'Paknaan', 'Kamatis'),
(37, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 21', 31, '2022-03-28 16:04:45', '2022-03-28 16:04:45', 'Paknaan', 'Kamatis'),
(38, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 21', 31, '2022-03-28 16:05:38', '2022-03-28 16:05:38', 'Paknaan', 'Kamatis'),
(39, 'Request', 'Secretary Handson,Roxy has released the RequestID # 21', 30, '2022-03-28 16:12:44', '2022-03-28 16:12:44', 'Paknaan', 'Kamatis'),
(40, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 22', 31, '2022-03-28 16:16:38', '2022-03-28 16:16:38', 'Paknaan', 'Kamatis'),
(41, 'Request', 'Secretary Handson,Roxy has released the RequestID # 21', 30, '2022-03-28 16:21:58', '2022-03-28 16:21:58', 'Paknaan', 'Kamatis'),
(42, 'Request', 'Secretary Handson,Roxy has released the RequestID # 22', 30, '2022-03-28 16:27:44', '2022-03-28 16:27:44', 'Paknaan', 'Kamatis'),
(43, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 23', 31, '2022-03-28 16:32:22', '2022-03-28 16:32:22', 'Paknaan', 'Kamatis'),
(47, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 23', 37, '2022-03-28 16:44:13', '2022-03-28 16:44:13', 'Paknaan', 'Kamatis'),
(48, 'Request', 'Treasurer Handson, Roxy has confirmed the payment for RequestID# 28', 37, '2022-03-28 16:52:01', '2022-03-28 16:52:01', 'Paknaan', 'Kamatis'),
(49, 'Request', 'Treasurer Handson, Roxy has confirmed the payment for RequestID# 28', 37, '2022-03-28 16:53:57', '2022-03-28 16:53:57', 'Paknaan', 'Kamatis'),
(50, 'Request', 'Treasurer Handson, Roxy has confirmed the payment for RequestID# 28', 37, '2022-03-28 16:54:11', '2022-03-28 16:54:11', 'Paknaan', 'Kamatis'),
(51, 'Request', 'Treasurer Handson, Roxy has confirmed the payment for RequestID# 28', 37, '2022-03-28 16:54:59', '2022-03-28 16:54:59', 'Paknaan', 'Kamatis'),
(52, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 23', 37, '2022-03-28 16:56:44', '2022-03-28 16:56:44', 'Paknaan', 'Kamatis'),
(55, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 23', 37, '2022-03-28 17:06:50', '2022-03-28 17:06:50', 'Paknaan', 'Kamatis'),
(56, 'eReklamo', 'Resident Woshua has resolved ereklamo#20', 34, '2022-03-28 21:45:10', '2022-03-28 21:45:10', 'Paknaan', 'Kamatis'),
(57, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#20 on 2022-03-30', 30, '2022-03-28 21:53:42', '2022-03-28 21:53:42', 'Paknaan', 'Kamatis'),
(58, 'eReklamo', 'Captain Jeremy has resolved ereklamo#20', 29, '2022-03-28 22:04:28', '2022-03-28 22:04:28', 'Paknaan', 'Kamatis'),
(59, 'eReklamo', 'Captain Jeremy has resolved ereklamo#20', 29, '2022-03-28 22:20:44', '2022-03-28 22:20:44', 'Paknaan', 'Kamatis'),
(60, 'eReklamo', 'Captain Jeremy has rescheduled ereklamo#20', 29, '2022-03-28 22:21:10', '2022-03-28 22:21:10', 'Paknaan', 'Kamatis'),
(61, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 24', 31, '2022-03-29 07:32:24', '2022-03-29 07:32:24', 'Paknaan', 'Kamatis'),
(62, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 25', 31, '2022-03-29 07:49:49', '2022-03-29 07:49:49', 'Paknaan', 'Kamatis'),
(63, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 25', 37, '2022-03-29 07:55:07', '2022-03-29 07:55:07', 'Paknaan', 'Kamatis'),
(64, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 24', 37, '2022-03-29 07:57:02', '2022-03-29 07:57:02', 'Paknaan', 'Kamatis'),
(65, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 26', 31, '2022-04-02 22:18:01', '2022-04-02 22:18:01', 'Paknaan', 'Kamatis'),
(70, 'eReklamo', 'Captain has entered a new reklamo category type: Test', 29, '2022-04-10 18:51:27', '2022-04-10 18:51:27', 'Paknaan', 'Kamatis'),
(71, 'eReklamo', 'Captain has entered a new reklamo type for category type: Test', 29, '2022-04-10 19:39:28', '2022-04-10 19:39:28', 'Paknaan', 'Kamatis'),
(72, 'eReklamo', 'Captain has entered a new reklamo category type: Test2', 29, '2022-04-10 19:51:46', '2022-04-10 19:51:46', 'Paknaan', 'Kamatis'),
(73, 'eReklamo', 'Captain has entered a new reklamo category type: Test2', 29, '2022-04-10 20:08:44', '2022-04-10 20:08:44', 'Paknaan', 'Kamatis'),
(74, 'eReklamo', 'Captain has entered a new reklamo category type: Garbage', 29, '2022-04-10 20:48:01', '2022-04-10 20:48:01', 'Paknaan', 'Kamatis'),
(75, 'eReklamo', 'Captain has entered a new reklamo category type: Residents', 29, '2022-04-10 20:48:08', '2022-04-10 20:48:08', 'Paknaan', 'Kamatis'),
(76, 'eReklamo', 'Captain has entered a new reklamo category type: Barangay Infrastructures', 29, '2022-04-10 20:48:46', '2022-04-10 20:48:46', 'Paknaan', 'Kamatis'),
(77, 'eReklamo', 'Captain has entered a new reklamo type for category type: Garbage', 29, '2022-04-10 20:48:58', '2022-04-10 20:48:58', 'Paknaan', 'Kamatis'),
(78, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-04-10 20:49:16', '2022-04-10 20:49:16', 'Paknaan', 'Kamatis'),
(79, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-04-10 20:52:50', '2022-04-10 20:52:50', 'Paknaan', 'Kamatis'),
(80, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-04-10 20:52:58', '2022-04-10 20:52:58', 'Paknaan', 'Kamatis'),
(81, 'eReklamo', 'Captain has entered a new reklamo type for category type: Barangay Infrastructures', 29, '2022-04-10 20:53:31', '2022-04-10 20:53:31', 'Paknaan', 'Kamatis'),
(82, 'eReklamo', 'Captain has entered a new reklamo type for category type: Barangay Infrastructures', 29, '2022-04-10 20:53:38', '2022-04-10 20:53:38', 'Paknaan', 'Kamatis'),
(83, 'eReklamo', 'Captain has modified the reklamo type #2', 29, '2022-04-12 12:56:58', '2022-04-12 12:56:58', 'Paknaan', 'Kamatis'),
(84, 'eReklamo', 'Captain has modified the reklamo type #2', 29, '2022-04-12 12:57:40', '2022-04-12 12:57:40', 'Paknaan', 'Kamatis'),
(85, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-04-12 13:11:57', '2022-04-12 13:11:57', 'Paknaan', 'Kamatis'),
(86, 'eReklamo', 'Captain has entered a new reklamo type for category type: Garbage', 29, '2022-04-12 14:04:17', '2022-04-12 14:04:17', 'Paknaan', 'Kamatis'),
(87, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-04-12 14:04:22', '2022-04-12 14:04:22', 'Paknaan', 'Kamatis'),
(88, 'eReklamo', 'Captain has entered a new reklamo type for category type: Garbage', 29, '2022-04-12 14:04:38', '2022-04-12 14:04:38', 'Paknaan', 'Kamatis'),
(89, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-04-12 14:04:49', '2022-04-12 14:04:49', 'Paknaan', 'Kamatis'),
(90, 'eReklamo', 'Captain has entered a new reklamo type for category type: Garbage', 29, '2022-04-12 14:05:16', '2022-04-12 14:05:16', 'Paknaan', 'Kamatis'),
(91, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-04-12 14:05:21', '2022-04-12 14:05:21', 'Paknaan', 'Kamatis'),
(93, 'eReklamo', 'Captain has modified reklamo category #6', 29, '2022-04-12 19:12:58', '2022-04-12 19:12:58', 'Paknaan', 'Kamatis'),
(94, 'eReklamo', 'Captain has entered a new reklamo category type: Test', 29, '2022-04-12 19:15:06', '2022-04-12 19:15:06', 'Paknaan', 'Kamatis'),
(95, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-04-12 19:15:09', '2022-04-12 19:15:09', 'Paknaan', 'Kamatis'),
(97, 'eReklamo', 'Captain has entered a new reklamo type for category type: Garbages', 29, '2022-04-12 19:28:31', '2022-04-12 19:28:31', 'Paknaan', 'Kamatis'),
(98, 'eReklamo', 'Captain has entered a new reklamo category type: Test', 29, '2022-04-12 19:28:36', '2022-04-12 19:28:36', 'Paknaan', 'Kamatis'),
(99, 'eReklamo', 'Captain has entered a new reklamo type for category type: Test', 29, '2022-04-12 19:28:41', '2022-04-12 19:28:41', 'Paknaan', 'Kamatis'),
(100, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-04-12 19:28:45', '2022-04-12 19:28:45', 'Paknaan', 'Kamatis'),
(101, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-04-15 20:15:53', '2022-04-15 20:15:53', 'Paknaan', 'Kamatis'),
(102, 'eReklamo', 'Captain has modified the reklamo type #1', 29, '2022-04-15 20:16:31', '2022-04-15 20:16:31', 'Paknaan', 'Kamatis'),
(103, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-04-15 20:18:44', '2022-04-15 20:18:44', 'Paknaan', 'Kamatis'),
(104, 'eReklamo', 'Captain has entered a new reklamo type for category type: Barangay Infrastructures', 29, '2022-04-15 20:18:52', '2022-04-15 20:18:52', 'Paknaan', 'Kamatis'),
(105, 'eReklamo', 'Captain has entered a new reklamo type for category type: Barangay Infrastructures', 29, '2022-04-15 20:18:59', '2022-04-15 20:18:59', 'Paknaan', 'Kamatis');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int(11) NOT NULL,
  `documentType` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requestedOn` datetime DEFAULT current_timestamp(),
  `approvedOn` datetime DEFAULT NULL,
  `approvedBy` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `userBarangay` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userPurok` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentMode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsersID` int(11) DEFAULT NULL,
  `requesturl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `documentType`, `purpose`, `requestedOn`, `approvedOn`, `approvedBy`, `amount`, `status`, `userBarangay`, `userPurok`, `paymentMode`, `userType`, `UsersID`, `requesturl`) VALUES
(21, 'Barangay Clearance', 'Employment', '2022-03-28 15:21:47', '2022-03-28 16:21:58', 'Handson, Roxy', 50, 'Released', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, ''),
(22, 'Cedula', 'Employment', '2022-03-28 16:16:12', '2022-03-28 16:27:44', 'Handson, Roxy', 20, 'Released', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/9647c47bb7a82b4798cc7cafddfc7bd1'),
(23, 'Cedula', 'Employment', '2022-03-28 16:31:39', '2022-03-28 17:06:50', 'Ville, Jackson', 20, 'Paid', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/53a59cfd1e256b4064170e8c9cf222a0'),
(24, 'Barangay Clearance', 'Employment', '2022-03-29 07:31:09', '2022-03-29 07:57:02', 'Ville, Jackson', 50, 'Paid', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/a65846399caff7957c8923eaed155192'),
(25, 'Cedula', 'Employment', '2022-03-29 07:36:50', '2022-03-29 07:55:07', 'Ville, Jackson', 20, 'Paid', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/c1dde9784e9bb636fc718b4d0da11692'),
(26, 'Cedula', 'Test', '2022-04-02 15:27:45', '2022-04-02 22:18:02', 'Leader, Purok', 222, 'Approved', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Treasurer', 28, 'https://getpaid.gcash.com/checkout/e8c0afb83105fd0641490493e3d4d10e');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleID` int(11) NOT NULL,
  `scheduleDate` date DEFAULT NULL,
  `UsersID` int(11) DEFAULT NULL,
  `complainee` int(11) DEFAULT NULL,
  `forAll` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'False',
  `scheduleTitle` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ereklamoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersID` int(11) NOT NULL,
  `Firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Middlename` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilStat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailAdd` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersPwd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userGender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(129) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userBarangay` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userPurok` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneNum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teleNum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VerifyStatus` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `userCity` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `Status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `landlordName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'None',
  `landlordContact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'NONE',
  `barangayPos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'None',
  `userAddress` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userHouseNum` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsLandlord` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False',
  `isRenting` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False',
  `startedLiving` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `emailAdd`, `username`, `usersPwd`, `userGender`, `userType`, `profile_pic`, `userBarangay`, `userPurok`, `phoneNum`, `teleNum`, `VerifyStatus`, `userCity`, `Status`, `landlordName`, `landlordContact`, `barangayPos`, `userAddress`, `userHouseNum`, `IsLandlord`, `isRenting`, `startedLiving`) VALUES
(27, 'Craige Jonard', 'Noel', 'Baring', '2000-01-08', 'Single', 'craigejonard@gmail.com', 'admin', '$2y$10$UEq1Wgm7o57pp1kueghFh.rcR3C4OLo3fDV8YPV6Rln17VMV9Cxh2', 'Male', 'Admin', 'profile_picture.jpg', NULL, NULL, NULL, NULL, 'Pending', '', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '001', 'False', 'False', '0000-00-00'),
(28, 'Xavier', 'Noez', 'Johnson', '2000-08-01', 'Single', 'xavier.johnson@gmail.com', 'resident1', '$2y$10$..PLFwgk8icProv4dHWmruXNRuedfpg9dq7cnvxdb/MNWdItpbt/e', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', '', 'Active', 'None', 'NONE', 'Electrician', 'Plaridel Street', '002', 'True', 'False', '0000-00-00'),
(29, 'Jeremy', 'Psycho', 'Elbertson', '1981-08-23', 'Single', 'jeremyelbertson@gmail.com', 'captain1', '$2y$10$n8rGNhBsHgiQvLEo/FDFduNRm/fIhD/g7fnfw.mYiTXI1IHG5ri4O', 'Male', 'Captain', '1647869940_RobloxScreenShot20220318_181434207.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '003', 'False', 'False', '0000-00-00'),
(30, 'Roxy', 'Tabby', 'Handson', '1991-02-01', 'Single', 'handson.tabby@gmail.com', 'secretary1', '$2y$10$7MPFKH3XG/uUamFPUQJnyuIfwpkmhl31F7Owu7A4mXHJW.HceFUBq', 'Female', 'Secretary', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '004', 'False', 'False', '0000-00-00'),
(31, 'Purok', 'Leader', 'Leader', '1987-11-11', 'Single', 'purokleader@gmail.com', 'purokLeader1', '$2y$10$GXZUfl.RHuhPT9OHoRL.sOiI9keF1TAy178G79p12h1/M9SRGd0pW', 'Male', 'Purok Leader', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '005', 'False', 'False', '0000-00-00'),
(32, 'Resident', 'User', 'User', '2020-02-12', 'Single', 'resident@gmail.com', 'resident2', '$2y$10$oua0FAN7GbEUsSuGAfwrEO4bzUdTLgEt5atpy549A0uMhexXUV6OO', 'Male', 'Resident', 'profile_picture.jpg', 'Pajo', 'Kamanggahan', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Quezon National Highway', '2154', 'False', 'False', '0000-00-00'),
(34, 'Woshua', 'Etch', 'Torts', '2017-11-25', 'Single', 'woshua@gmail.com', 'tanodResident', '$2y$10$r1tpz1YRzITj1SYgiq99Re2573PkqyytJkonuaAwCb/kNo46ceI.W', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'Tanod', 'Plaridel Street', '006', 'False', 'False', '0000-00-00'),
(37, 'Jackson', 'Me', 'Ville', '2011-11-11', 'Single', 'treasurer@gmail.com', 'treasurer1', '$2y$10$4afrff9nv2rPHjPwgBwUw.4Uf8OIVYwSlzJibdqElFU4fag3R/.we', 'Male', 'Treasurer', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, 'N/A', 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '007', 'False', 'False', '0000-00-00'),
(39, 'Mr', 'Plum', 'Plumber', '2013-02-22', 'Single', 'plumber@gmail.com', 'plumberResident', '$2y$10$88iJPGIsWukfR3BdiQPcYeCF/BTDogUL8ulVD7RQ8blCQzWTuwCqq', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'National Highway ', '231', 'False', 'False', '0000-00-00'),
(40, 'Mr', 'Con', 'Struction', '1999-02-20', 'Single', 'construction@gmail.com', 'constructionResident', '$2y$10$OfQqSRF.nA7JA9UDwXpbee2r9.KHb9/lUW0jW2qnf/ki7/4nBxLeq', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel St.', '2414', 'False', 'False', '0000-00-00'),
(41, 'Test', 'Test', 'Test', '2000-01-01', 'Single', 'asdoh@gmail.com', 'jonardlolz', '$2y$10$b8.b5D1NJ07gDio1zMsxs.25zxCwRN.q6zKbpmObWs/YCdzeQCxKu', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', '28', 'NONE', 'None', 'Test', '241', 'False', 'False', '2022-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `voteID` int(11) NOT NULL,
  `candidateID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `electionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`voteID`, `candidateID`, `UsersID`, `created_at`, `updated_at`, `position`, `electionID`) VALUES
(34, 25, 28, '2022-03-18 01:01:25', '2022-03-18 01:01:25', 'Purok Leader', 11),
(35, 26, 28, '2022-03-18 02:10:26', '2022-03-18 02:10:26', 'Purok Leader', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`BarangayID`),
  ADD KEY `userCaptain` (`brgyCaptain`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidateID`),
  ADD KEY `UsersID` (`UsersID`),
  ADD KEY `electionID` (`electionID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentsID`),
  ADD KEY `UsersID` (`UsersID`),
  ADD KEY `PostID` (`PostID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactID`),
  ADD KEY `contacts` (`BarangayID`);

--
-- Indexes for table `documentpurpose`
--
ALTER TABLE `documentpurpose`
  ADD PRIMARY KEY (`purposeID`);

--
-- Indexes for table `documenttype`
--
ALTER TABLE `documenttype`
  ADD PRIMARY KEY (`DocumentID`),
  ADD KEY `barangayID` (`barangayID`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`electionID`);

--
-- Indexes for table `ereklamo`
--
ALTER TABLE `ereklamo`
  ADD PRIMARY KEY (`ReklamoID`),
  ADD KEY `UsersID` (`UsersID`);

--
-- Indexes for table `ereklamocategory`
--
ALTER TABLE `ereklamocategory`
  ADD PRIMARY KEY (`reklamoCatID`);

--
-- Indexes for table `ereklamotype`
--
ALTER TABLE `ereklamotype`
  ADD PRIMARY KEY (`reklamoTypeID`),
  ADD KEY `reklamoCatID` (`reklamoCatID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UsersID` (`UsersID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `purok`
--
ALTER TABLE `purok`
  ADD PRIMARY KEY (`PurokID`),
  ADD KEY `userLeader` (`purokLeader`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `UsersID` (`UsersID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleID`),
  ADD KEY `ereklamoID` (`ereklamoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UsersID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`voteID`),
  ADD KEY `candidateID` (`candidateID`),
  ADD KEY `UsersID` (`UsersID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `BarangayID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documentpurpose`
--
ALTER TABLE `documentpurpose`
  MODIFY `purposeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documenttype`
--
ALTER TABLE `documenttype`
  MODIFY `DocumentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ereklamo`
--
ALTER TABLE `ereklamo`
  MODIFY `ReklamoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ereklamocategory`
--
ALTER TABLE `ereklamocategory`
  MODIFY `reklamoCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ereklamotype`
--
ALTER TABLE `ereklamotype`
  MODIFY `reklamoTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `PurokID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidates_ibfk_2` FOREIGN KEY (`electionID`) REFERENCES `election` (`electionID`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts` FOREIGN KEY (`BarangayID`) REFERENCES `barangay` (`BarangayID`) ON DELETE CASCADE;

--
-- Constraints for table `documenttype`
--
ALTER TABLE `documenttype`
  ADD CONSTRAINT `documenttype_ibfk_1` FOREIGN KEY (`barangayID`) REFERENCES `barangay` (`BarangayID`) ON DELETE CASCADE;

--
-- Constraints for table `ereklamo`
--
ALTER TABLE `ereklamo`
  ADD CONSTRAINT `ereklamo_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE;

--
-- Constraints for table `ereklamotype`
--
ALTER TABLE `ereklamotype`
  ADD CONSTRAINT `ereklamotype_ibfk_1` FOREIGN KEY (`reklamoCatID`) REFERENCES `ereklamocategory` (`reklamoCatID`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `purok`
--
ALTER TABLE `purok`
  ADD CONSTRAINT `purok_ibfk_1` FOREIGN KEY (`purokLeader`) REFERENCES `users` (`UsersID`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`ereklamoID`) REFERENCES `ereklamo` (`ReklamoID`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`candidateID`) REFERENCES `candidates` (`candidateID`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
