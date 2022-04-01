-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 01:25 PM
-- Server version: 8.0.28
-- PHP Version: 8.0.9

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
  `BarangayID` int NOT NULL,
  `BarangayName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `City` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Active` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'True',
  `brgyCaptain` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`BarangayID`, `BarangayName`, `City`, `Active`, `brgyCaptain`) VALUES
(1, 'Bakilid', 'Mandaue', 'False', NULL),
(2, 'Paknaan', 'Mandaue', 'True', 29),
(3, 'Maguikay', 'Mandaue', 'False', NULL),
(4, 'Cambaro', 'Mandaue', 'False', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidateID` int NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `platform` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purok` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UsersID` int NOT NULL,
  `electionID` int NOT NULL,
  `position` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
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
  `CommentsID` int NOT NULL,
  `UsersID` int NOT NULL,
  `PostID` int NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documentpurpose`
--

CREATE TABLE `documentpurpose` (
  `purposeID` int NOT NULL,
  `purpose` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `barangayDoc` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `barangay` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `studentDiscount` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `seniorDiscount` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pwdDiscount` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentpurpose`
--

INSERT INTO `documentpurpose` (`purposeID`, `purpose`, `barangayDoc`, `price`, `barangay`, `studentDiscount`, `seniorDiscount`, `pwdDiscount`) VALUES
(1, 'Employment', 'Barangay Clearance', '100', 'Paknaan', '0', '0', '0'),
(3, 'Ayuda', 'Indigency Clearance', '0', 'Paknaan', '0', '0', '0'),
(4, 'Test', 'Indigency Clearance', '0', 'Paknaan', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `documenttype`
--

CREATE TABLE `documenttype` (
  `DocumentID` int NOT NULL,
  `documentName` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `barangayID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `electionID` int NOT NULL,
  `electionTitle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `electionStatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paused',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barangay` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
  `ReklamoID` int NOT NULL,
  `reklamoType` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CreatedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `UpdatedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedBy` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedOn` datetime DEFAULT NULL,
  `complaintLevel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Minor',
  `complainee` int DEFAULT NULL,
  `scheduledSummon` date DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `barangay` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purok` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamo`
--

INSERT INTO `ereklamo` (`ReklamoID`, `reklamoType`, `detail`, `status`, `CreatedOn`, `UpdatedOn`, `comment`, `checkedBy`, `checkedOn`, `complaintLevel`, `complainee`, `scheduledSummon`, `UsersID`, `barangay`, `purok`) VALUES
(11, 'Kuryente', 'No electricity in the area', 'Resolved', '2022-03-04 20:35:16', '2022-03-04 20:35:16', 'Test', 'Torts, Woshua', '2022-03-07 01:00:41', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis'),
(12, 'Resident', 'Noise', 'Scheduled', '2022-03-17 16:37:52', '2022-03-17 16:37:52', 'Test', 'Handson, Roxy', '2022-03-17 22:35:10', 'Major', 34, '2022-03-30', 28, 'Paknaan', 'Kamatis'),
(14, 'Resident', 'Disregard of trashes', 'Scheduled', '2022-03-17 23:27:34', '2022-03-17 23:27:34', 'Test', 'Handson, Roxy', '2022-03-27 20:15:43', 'Major', 34, '2022-03-28', 28, 'Paknaan', 'Kamatis'),
(15, 'Kuryente', 'No electricity in the area', 'Respondents sent', '2022-03-22 18:52:24', '2022-03-22 18:52:24', 'Test ', 'Johnson, Xavier', '2022-03-26 21:02:23', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis'),
(16, 'Resident', 'Noise', 'Scheduled', '2022-03-24 14:46:52', '2022-03-24 14:46:52', 'Test', 'Handson, Roxy', '2022-03-27 20:46:55', 'Major', 29, '2022-03-28', 28, 'Paknaan', 'Kamatis'),
(17, 'Kuryente', 'No electricity in the area', 'Respondents sent', '2022-03-26 21:45:36', '2022-03-26 21:45:36', 'Test', 'Purok Leader', '2022-03-26 21:45:47', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis'),
(18, 'Resident', 'Disregard of trashes', 'Scheduled', '2022-03-26 22:56:12', '2022-03-26 22:56:12', 'Test', 'Handson, Roxy', '2022-03-27 20:46:59', 'Major', 30, '2022-03-28', 28, 'Paknaan', 'Kamatis'),
(19, 'Kuryente', 'No electricity in the area', 'Respondents sent', '2022-03-28 15:31:45', '2022-03-28 15:31:45', '', 'Purok Leader', '2022-03-29 08:15:04', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis'),
(20, 'Resident', 'Disregard of trashes', 'Reschedule', '2022-03-28 17:13:02', '2022-03-28 17:13:02', 'Test', 'Elbertson, Jeremy', '2022-03-28 22:21:10', 'Major', 39, '2022-03-30', 28, 'Paknaan', 'Kamatis');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Not Read',
  `UsersID` int DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
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
(69, 'A resident has requested a Barangay Clearance', 'request', 'Not Read', NULL, 'Purok Leader', '2022-03-29 07:31:09', '2022-03-29 07:31:09'),
(70, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-03-29 07:36:50', '2022-03-29 07:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `OfficialID` int DEFAULT NULL,
  `NationalID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residentID` int DEFAULT NULL,
  `electedOn` date DEFAULT NULL,
  `updatedOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostID` int NOT NULL,
  `UsersID` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postMessage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `PurokID` int NOT NULL,
  `PurokName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `BarangayName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Active` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'True',
  `purokLeader` int DEFAULT NULL
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
  `reportID` int NOT NULL,
  `ReportType` varchar(50) NOT NULL,
  `reportMessage` varchar(200) DEFAULT NULL,
  `UsersID` int NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `userBarangay` varchar(50) DEFAULT NULL,
  `userPurok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportID`, `ReportType`, `reportMessage`, `UsersID`, `created_on`, `updated_on`, `userBarangay`, `userPurok`) VALUES
(1, 'eReklamo', 'Test Test has resolved ereklamo#$id', 0, '2022-02-24 20:07:11', '2022-02-24 20:07:11', 'Paknaan', 'Kamatis'),
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
(64, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 24', 37, '2022-03-29 07:57:02', '2022-03-29 07:57:02', 'Paknaan', 'Kamatis');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int NOT NULL,
  `documentType` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requestedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `approvedOn` datetime DEFAULT NULL,
  `approvedBy` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `status` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `userBarangay` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userPurok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentMode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `requesturl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `documentType`, `purpose`, `requestedOn`, `approvedOn`, `approvedBy`, `amount`, `status`, `userBarangay`, `userPurok`, `paymentMode`, `userType`, `UsersID`, `requesturl`) VALUES
(21, 'Barangay Clearance', 'Employment', '2022-03-28 15:21:47', '2022-03-28 16:21:58', 'Handson, Roxy', 50, 'Released', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, ''),
(22, 'Cedula', 'Employment', '2022-03-28 16:16:12', '2022-03-28 16:27:44', 'Handson, Roxy', 20, 'Released', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/9647c47bb7a82b4798cc7cafddfc7bd1'),
(23, 'Cedula', 'Employment', '2022-03-28 16:31:39', '2022-03-28 17:06:50', 'Ville, Jackson', 20, 'Paid', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/53a59cfd1e256b4064170e8c9cf222a0'),
(24, 'Barangay Clearance', 'Employment', '2022-03-29 07:31:09', '2022-03-29 07:57:02', 'Ville, Jackson', 50, 'Paid', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/a65846399caff7957c8923eaed155192'),
(25, 'Cedula', 'Employment', '2022-03-29 07:36:50', '2022-03-29 07:55:07', 'Ville, Jackson', 20, 'Paid', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/c1dde9784e9bb636fc718b4d0da11692');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleID` int NOT NULL,
  `scheduleDate` date DEFAULT NULL,
  `ereklamoID` int DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `complainee` int DEFAULT NULL,
  `forAll` varchar(10) DEFAULT 'False',
  `scheduleTitle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleID`, `scheduleDate`, `ereklamoID`, `UsersID`, `complainee`, `forAll`, `scheduleTitle`) VALUES
(15, '2022-03-30', 20, 28, 39, 'False', 'Test title');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersID` int NOT NULL,
  `Firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilStat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailAdd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersPwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userGender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(129) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userBarangay` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userPurok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneNum` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teleNum` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VerifyStatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `userCity` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `Status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `isRenting` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'False',
  `landlordName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'None',
  `landlordContact` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'NONE',
  `barangayPos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'None',
  `userAddress` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userHouseNum` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `emailAdd`, `username`, `usersPwd`, `userGender`, `userType`, `profile_pic`, `userBarangay`, `userPurok`, `phoneNum`, `teleNum`, `VerifyStatus`, `userCity`, `Status`, `isRenting`, `landlordName`, `landlordContact`, `barangayPos`, `userAddress`, `userHouseNum`) VALUES
(27, 'Craige Jonard', 'Noel', 'Baring', '2000-01-08', 'Single', 'craigejonard@gmail.com', 'admin', '$2y$10$UEq1Wgm7o57pp1kueghFh.rcR3C4OLo3fDV8YPV6Rln17VMV9Cxh2', 'Male', 'Admin', 'profile_picture.jpg', NULL, NULL, NULL, NULL, 'Pending', '', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '001'),
(28, 'Xavier', 'Noel', 'Johnson', '2000-01-01', 'Single', 'xavier.johnson@gmail.com', 'resident1', '$2y$10$..PLFwgk8icProv4dHWmruXNRuedfpg9dq7cnvxdb/MNWdItpbt/e', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'Electrician', 'Plaridel Street', '002'),
(29, 'Jeremy', 'Psycho', 'Elbertson', '1981-08-23', 'Single', 'jeremyelbertson@gmail.com', 'captain1', '$2y$10$Z6oSDH5WbQ1idlHl6Z48w.notdDAOGLo4JrrEC8WFwEGq6XhWLEQa', 'Male', 'Captain', '1647869940_RobloxScreenShot20220318_181434207.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '003'),
(30, 'Roxy', 'Tabby', 'Handson', '1991-02-01', 'Single', 'handson.tabby@gmail.com', 'secretary1', '$2y$10$7MPFKH3XG/uUamFPUQJnyuIfwpkmhl31F7Owu7A4mXHJW.HceFUBq', 'Female', 'Secretary', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '004'),
(31, 'Purok', 'Leader', 'Leader', '1987-11-11', 'Single', 'purokleader@gmail.com', 'purokLeader1', '$2y$10$GXZUfl.RHuhPT9OHoRL.sOiI9keF1TAy178G79p12h1/M9SRGd0pW', 'Male', 'Purok Leader', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '005'),
(32, 'Resident', 'User', 'User', '2020-02-12', 'Single', 'resident@gmail.com', 'resident2', '$2y$10$oua0FAN7GbEUsSuGAfwrEO4bzUdTLgEt5atpy549A0uMhexXUV6OO', 'Male', 'Resident', 'profile_picture.jpg', 'Pajo', 'Kamanggahan', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Quezon National Highway', '2154'),
(34, 'Woshua', 'Etch', 'Torts', '2017-11-25', 'Single', 'woshua@gmail.com', 'tanodResident', '$2y$10$r1tpz1YRzITj1SYgiq99Re2573PkqyytJkonuaAwCb/kNo46ceI.W', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'Tanod', 'Plaridel Street', '006'),
(37, 'Jackson', 'Me', 'Ville', '2011-11-11', 'Single', 'treasurer@gmail.com', 'treasurer1', '$2y$10$4afrff9nv2rPHjPwgBwUw.4Uf8OIVYwSlzJibdqElFU4fag3R/.we', 'Male', 'Treasurer', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, 'N/A', 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '007'),
(39, 'Mr', 'Plum', 'Plumber', '2013-02-22', 'Single', 'plumber@gmail.com', 'plumberResident', '$2y$10$88iJPGIsWukfR3BdiQPcYeCF/BTDogUL8ulVD7RQ8blCQzWTuwCqq', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'National Highway ', '231'),
(40, 'Mr', 'Con', 'Struction', '1999-02-20', 'Single', 'construction@gmail.com', 'constructionResident', '$2y$10$OfQqSRF.nA7JA9UDwXpbee2r9.KHb9/lUW0jW2qnf/ki7/4nBxLeq', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel St.', '2414');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `voteID` int NOT NULL,
  `candidateID` int NOT NULL,
  `UsersID` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `electionID` int NOT NULL
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
  MODIFY `BarangayID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidateID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `documentpurpose`
--
ALTER TABLE `documentpurpose`
  MODIFY `purposeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documenttype`
--
ALTER TABLE `documenttype`
  MODIFY `DocumentID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ereklamo`
--
ALTER TABLE `ereklamo`
  MODIFY `ReklamoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `PurokID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangay`
--
ALTER TABLE `barangay`
  ADD CONSTRAINT `barangay_ibfk_1` FOREIGN KEY (`brgyCaptain`) REFERENCES `users` (`UsersID`);

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
