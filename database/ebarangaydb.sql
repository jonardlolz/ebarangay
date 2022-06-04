-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 12:52 PM
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
  `brgyCaptain` int DEFAULT NULL,
  `Province` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cebu',
  `barangay_pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brgy_default.png',
  `brgyTelephone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brgyEmail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brgyCell` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`BarangayID`, `BarangayName`, `City`, `brgyCaptain`, `Province`, `barangay_pic`, `brgyTelephone`, `brgyEmail`, `brgyCell`, `Status`) VALUES
(1, 'Bakilid', 'Mandaue', 0, 'Cebu', 'brgy_default.png', NULL, NULL, NULL, 'Inactive'),
(2, 'Paknaan', 'Mandaue', 29, 'Cebu', '1651569540_279229236_386932233301025_5164515031778545769_n.jpg', '546-9872', 'paknaanBrgy@gmail.com', '09758423457', 'Active'),
(3, 'Maguikay', 'Mandaue', 50, 'Cebu', '1653653280_Screenshot (6).png', '123-4567', 'asdaga@gmail.com', '09754231657', 'Active'),
(4, 'Cambaro', 'Mandaue', NULL, 'Cebu', 'brgy_default.png', NULL, NULL, NULL, 'Inactive'),
(9, 'test', 'Paknaan', 53, 'Cebu', 'brgy_default.png', NULL, NULL, NULL, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `barangaylupon`
--

CREATE TABLE `barangaylupon` (
  `luponMemberID` int NOT NULL,
  `UsersID` int NOT NULL,
  `barangay` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(29, 'Struction', 'Mr', '2022-03-18 01:51:41', '2022-03-18 01:51:41', 'Test', 'Kamatis', 40, 13, 'Purok Leader'),
(31, 'Torts', 'Woshua', '2022-05-28 22:45:29', '2022-05-28 22:45:29', 'Test', 'Kamatis', 34, 20, 'Purok Leader'),
(32, 'Johnson', 'Xavier', '2022-05-28 22:45:36', '2022-05-28 22:45:36', 'Test', 'Kamatis', 28, 20, 'Purok Leader'),
(33, 'Johnson', 'Xavier', '2022-05-28 22:47:08', '2022-05-28 22:47:08', 'Test', 'Kamatis', 28, 21, 'Purok Leader'),
(35, 'Torts', 'Woshua', '2022-05-28 22:49:03', '2022-05-28 22:49:03', '', 'Kamatis', 34, 21, 'Purok Leader'),
(36, 'Plumber', 'Mr', '2022-05-30 10:01:43', '2022-05-30 10:01:43', '', 'Kamatis', 39, 24, 'Purok Leader'),
(37, 'Ville', 'Jackson', '2022-06-01 13:04:48', '2022-06-01 13:04:48', 'Test', 'Kamatis', 37, 25, 'Purok Leader'),
(38, 'Plumber', 'Mr', '2022-06-01 13:04:54', '2022-06-01 13:04:54', 'Test', 'Kamatis', 39, 25, 'Purok Leader'),
(39, 'Struction', 'Mr', '2022-06-01 13:05:00', '2022-06-01 13:05:00', 'Test', 'Kamatis', 40, 25, 'Purok Leader');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatID` int NOT NULL,
  `UsersID` int NOT NULL,
  `chatroomID` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `mesgdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'Not Read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatID`, `UsersID`, `chatroomID`, `message`, `mesgdate`, `status`) VALUES
(3, 28, 3, 'Test', '2022-05-15 17:43:46', 'Not Read'),
(4, 31, 3, 'Hello!', '2022-05-15 18:06:56', 'Not Read'),
(5, 31, 3, 'Test123', '2022-05-15 19:56:36', 'Not Read'),
(6, 31, 3, 'Test123', '2022-05-15 19:57:07', 'Not Read'),
(7, 31, 3, 'Test123', '2022-05-15 19:57:43', 'Not Read'),
(8, 31, 3, '', '2022-05-15 19:58:07', 'Not Read'),
(9, 31, 3, '', '2022-05-15 19:58:35', 'Not Read'),
(10, 31, 3, '', '2022-05-15 19:59:13', 'Not Read'),
(11, 31, 3, '', '2022-05-15 19:59:39', 'Not Read'),
(12, 31, 3, 'qweqwe', '2022-05-16 14:45:25', 'Not Read'),
(13, 31, 3, 'asdasd', '2022-05-16 14:45:27', 'Not Read'),
(14, 31, 3, 'dasdasd', '2022-05-16 14:45:43', 'Not Read'),
(15, 31, 3, 'aasv', '2022-05-16 14:45:44', 'Not Read'),
(16, 31, 4, 'asdasd', '2022-05-16 14:49:52', 'Not Read'),
(17, 31, 4, 'hello!', '2022-05-16 14:49:54', 'Not Read'),
(18, 31, 3, 'asdasd', '2022-05-16 16:31:41', 'Not Read'),
(19, 31, 3, 'fasf', '2022-05-16 16:31:42', 'Not Read'),
(20, 31, 4, 'adadasd', '2022-05-16 17:18:46', 'Not Read'),
(21, 34, 4, 'dasdasd', '2022-05-16 17:27:18', 'Not Read'),
(22, 34, 4, 'asfasf', '2022-05-16 17:27:19', 'Not Read'),
(23, 28, 5, 'Help! Daghan kaayo basura nag kalat ari, nya mga tao magsige ra pud ug labay!', '2022-05-16 21:14:43', 'Not Read'),
(24, 31, 5, 'chuchuchuchu', '2022-05-16 21:16:06', 'Not Read'),
(25, 31, 5, 'chuchu! ', '2022-05-16 21:16:08', 'Not Read'),
(26, 28, 6, 'OASIJDOAJDOASIJDOIJD', '2022-05-16 21:53:12', 'Not Read'),
(27, 34, 5, 'Hello!', '2022-05-16 21:56:28', 'Not Read'),
(28, 34, 5, 'asdasdjoj', '2022-05-16 21:59:52', 'Not Read'),
(29, 34, 5, 'asdadjahdiahdiuahdiuhdiauhdiuhdaidhiadhaisdhaisdhaihaidhiudhaidhaisdhaisduhaidshaisdhaisduhasiudh', '2022-05-16 22:00:31', 'Not Read'),
(30, 34, 5, 'aasdok asodkaspdo  pasdkpasokd  apsodkapkd adpoakpkaspdok asdokapksd', '2022-05-16 22:02:55', 'Not Read'),
(31, 34, 5, 'aspokasd okasdpokas poaksdp aoskdpaskdpa oksdpak pasodksapokd apo skdpaoskd poaksdpoak posk dpask poksapdok pasokdpok', '2022-05-16 22:03:06', 'Not Read'),
(32, 34, 5, 'hello maam ato na natawag basurero ara para malimpyo inyo area maam', '2022-05-16 22:08:00', 'Not Read'),
(33, 28, 7, '', '2022-05-17 13:57:12', 'Not Read'),
(34, 31, 7, 'asdasd', '2022-05-17 14:05:18', 'Not Read'),
(35, 34, 7, 'asdjoasjdoiaj', '2022-05-17 15:09:29', 'Not Read'),
(36, 31, 7, 'Hello ', '2022-05-17 16:17:34', 'Not Read'),
(37, 28, 8, 'Test', '2022-05-17 17:43:47', 'Not Read'),
(38, 29, 7, 'Hello!', '2022-05-17 19:21:22', 'Not Read'),
(39, 28, 9, 'diaper everywhere', '2022-05-18 10:56:43', 'Not Read'),
(40, 31, 9, 'hello, we heard your tantrums and we are ready to take action  of your ereklamo. Thank you .', '2022-05-18 11:07:01', 'Not Read'),
(41, 34, 9, 'your service is being taken care.', '2022-05-18 11:16:42', 'Not Read'),
(42, 34, 9, '*reklamo', '2022-05-18 11:16:58', 'Not Read'),
(43, 34, 9, 'service done!', '2022-05-18 11:17:05', 'Not Read'),
(44, 31, 9, 'bvm', '2022-05-18 11:21:10', 'Not Read'),
(45, 28, 6, 'qweqwe', '2022-05-19 16:57:09', 'Not Read'),
(46, 28, 6, 'asdsssssssssssssssssssssssssssssssssssssssssssssssssssssssssasdasdasdasdasdalsdjaodjaodjoasjfoasjaosijfaifs', '2022-05-19 17:02:23', 'Not Read'),
(47, 28, 6, 'aspdkapsdkasdkpsdasdad', '2022-05-19 17:02:32', 'Not Read'),
(48, 28, 6, '\n', '2022-05-19 17:02:34', 'Not Read'),
(49, 28, 6, 'asdad', '2022-05-19 17:02:39', 'Not Read'),
(50, 28, 6, 'asdas ashd aksjdh aksjdh aksjdh kaj shdkasj hdasjd haskjd haskd jhas dkjahsd kajhsd kajshd', '2022-05-19 17:06:52', 'Not Read'),
(51, 28, 6, '\n', '2022-05-19 17:43:14', 'Not Read'),
(52, 28, 6, '\n', '2022-05-19 17:43:17', 'Not Read'),
(53, 28, 6, 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', '2022-05-19 21:06:12', 'Not Read'),
(54, 28, 10, 'Test', '2022-05-19 23:22:09', 'Not Read'),
(55, 28, 11, 'Patakag labay sa iyang basura, gibadlong na nako kapila pero balikon gihapon niya. Ang labayan pa pud kay ari jd dapit sa among yuta nya kung badlongon siya pay mag suko! Palihug ko badlong nya purok leader!', '2022-05-19 23:33:57', 'Not Read'),
(56, 31, 10, 'asdasadasd', '2022-05-20 00:38:57', 'Not Read'),
(57, 31, 8, 'asdasdasdasdwqeqweqweqwewqwwwwwwwwwwwwwwwwwwwwwwwwwwww', '2022-05-20 01:17:20', 'Not Read'),
(58, 31, 8, ' ', '2022-05-20 01:17:32', 'Not Read'),
(59, 28, 12, 'Test', '2022-05-20 01:26:27', 'Not Read'),
(60, 34, 12, 'asdasd', '2022-05-20 02:45:46', 'Not Read'),
(61, 28, 13, 'test', '2022-05-21 21:22:01', 'Not Read'),
(62, 28, 14, 'Test', '2022-05-21 22:35:37', 'Not Read'),
(63, 28, 15, 'Test', '2022-05-22 20:05:52', 'Not Read'),
(64, 28, 16, 'test', '2022-05-25 00:41:26', 'Not Read'),
(65, 28, 17, 'Test', '2022-05-25 00:43:18', 'Not Read'),
(66, 28, 18, 'qwrqwr', '2022-05-25 01:41:05', 'Not Read'),
(67, 31, 16, 'qweqwe', '2022-05-26 04:54:17', 'Not Read'),
(68, 31, 16, 'asdasd', '2022-05-26 04:54:19', 'Not Read'),
(69, 28, 19, 'Test', '2022-05-28 03:00:42', 'Not Read'),
(70, 28, 3, 'asdasd', '2022-05-29 21:20:25', 'Not Read'),
(71, 28, 4, 'qweqew', '2022-05-29 21:23:24', 'Not Read');

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `chatroomID` int NOT NULL,
  `roomName` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `idreference` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`chatroomID`, `roomName`, `type`, `idreference`) VALUES
(3, 'ereklamo#34', 'ereklamo', 34),
(4, 'ereklamo#32', 'ereklamo', 32),
(5, 'ereklamo#35', 'ereklamo', 35),
(6, 'ereklamo#36', 'ereklamo', 36),
(7, 'ereklamo#33', 'ereklamo', 33),
(8, 'ereklamo#31', 'ereklamo', 31),
(9, 'ereklamo#37', 'ereklamo', 37),
(10, 'ereklamo#41', 'ereklamo', 41),
(11, 'ereklamo#42', 'ereklamo', 42),
(12, 'ereklamo#38', 'ereklamo', 38),
(13, 'ereklamo#43', 'ereklamo', 43),
(14, 'ereklamo#44', 'ereklamo', 44),
(15, 'ereklamo#40', 'ereklamo', 40),
(16, 'ereklamo#45', 'ereklamo', 45),
(17, 'ereklamo#46', 'ereklamo', 46),
(18, 'ereklamo#47', 'ereklamo', 47),
(19, 'ereklamo#48', 'ereklamo', 48);

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentsID`, `UsersID`, `PostID`, `comment`, `date_created`) VALUES
(29, 29, 77, 'qwerqwer', '2022-06-01 05:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactID` int NOT NULL,
  `contactName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactNum` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `BarangayID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `purposeID` int NOT NULL,
  `purpose` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangayDoc` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documentpurpose`
--

INSERT INTO `documentpurpose` (`purposeID`, `purpose`, `barangay`, `barangayDoc`) VALUES
(3, 'Claim Ayuda', 'Paknaan', 3),
(5, 'Notarization', 'Paknaan', 1),
(6, 'Employment', 'Paknaan', 1),
(10, 'Proof of Residency', 'Paknaan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `documenttype`
--

CREATE TABLE `documenttype` (
  `DocumentID` int NOT NULL,
  `documentName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangayName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'All',
  `documentDesc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowFee` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'True',
  `docPrice` int NOT NULL DEFAULT '0',
  `VoterRequired` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False',
  `minimumMos` int NOT NULL DEFAULT '6',
  `allowLessee` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requireLessorNote` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documenttype`
--

INSERT INTO `documenttype` (`DocumentID`, `documentName`, `barangayName`, `documentDesc`, `allowFee`, `docPrice`, `VoterRequired`, `minimumMos`, `allowLessee`, `requireLessorNote`) VALUES
(1, 'Cedula', 'Paknaan', '', 'True', 0, 'False', 6, 'True', 'True'),
(2, 'Barangay Clearance', 'Paknaan', '', 'True', 125, 'False', 6, 'True', 'True'),
(3, 'Indigency Clearance', 'Paknaan', '', 'False', 0, 'False', 6, 'True', 'True'),
(9, 'Barangay Clearance', 'Maguikay', '', 'True', 125, 'True', 6, 'False', 'False'),
(13, 'Fencing Permit', 'Paknaan', '', 'True', 250, 'False', 0, 'False', 'False');

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
(21, 'test', 'Finished', '29', '2022-05-28 22:46:59', '2022-05-28 22:46:59', 'Paknaan', 'Kamatis'),
(23, 'Test', 'Cancelled', '29', '2022-05-28 23:03:33', '2022-05-28 23:03:33', 'Paknaan', 'Apple'),
(24, 'TEst', 'Cancelled', '29', '2022-05-29 23:01:51', '2022-05-29 23:01:51', 'Paknaan', 'Kamatis'),
(25, 'Purok Leader Election', 'Ongoing', '29', '2022-06-01 13:04:33', '2022-06-01 13:04:33', 'Paknaan', 'Kamatis');

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
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedBy` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkedOn` datetime DEFAULT NULL,
  `complaintLevel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Minor',
  `complainee` int DEFAULT NULL,
  `scheduledSummon` date DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `barangay` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purok` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rescheduleCounter` int NOT NULL DEFAULT '0',
  `reklamoFee` int NOT NULL DEFAULT '0',
  `paymenturl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamo`
--

INSERT INTO `ereklamo` (`ReklamoID`, `reklamoType`, `detail`, `status`, `CreatedOn`, `UpdatedOn`, `comment`, `checkedBy`, `checkedOn`, `complaintLevel`, `complainee`, `scheduledSummon`, `UsersID`, `barangay`, `purok`, `rescheduleCounter`, `reklamoFee`, `paymenturl`) VALUES
(31, 'Complaint to Resident', 'Drugs', 'Send to LUPON', '2022-04-19 22:30:13', '2022-04-19 22:30:13', 'Test', 'Jeremy Elbertson', '2022-05-23 04:23:28', 'Major', 34, '2022-05-27', 28, 'Paknaan', 'Kamatis', 0, 150, 'https://getpaid.gcash.com/checkout/9590717a307b998fa8620a275c12aca9'),
(32, 'Garbages', 'Improper disposal', 'Resolved', '2022-04-19 22:30:53', '2022-04-19 22:30:53', 'Test', 'Leader, Purok', '2022-05-16 21:17:44', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(33, 'Complaint to Resident', 'Drugs', 'Send to LUPON', '2022-04-25 15:21:20', '2022-04-25 15:21:20', '', 'Jeremy Elbertson', '2022-05-22 02:22:44', 'Major', 34, '2022-05-18', 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(34, 'Garbage', 'Improper disposal', 'Resolved', '2022-05-14 21:14:56', '2022-05-14 21:14:56', 'Test', 'Leader, Purok', '2022-05-16 17:00:03', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(35, 'Garbage', 'Improper disposal', 'Incoming', '2022-05-16 21:14:09', '2022-05-16 21:14:09', 'Help! Daghan kaayo basura nag kalat ari, nya mga tao magsige ra pud ug labay!', 'Woshua Torts', '2022-05-16 22:43:33', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(36, 'Garbage', 'Improper disposal', 'Resolved', '2022-05-16 21:52:37', '2022-05-16 21:52:37', 'OASIJDOAJDOASIJDOIJD', 'Purok Leader', '2022-05-21 22:57:02', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(37, 'Garbage', 'Improper disposal', 'Resolved', '2022-05-18 10:54:10', '2022-05-18 10:54:10', 'diaper everywhere', 'Leader, Purok', '2022-05-25 00:42:15', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(38, 'Garbage', 'Improper disposal', 'Resolved', '2022-05-19 15:41:18', '2022-05-19 15:41:18', 'Test', 'Purok Leader', '2022-05-21 22:47:35', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(39, 'Complaint to Resident', '', 'Pending', '2022-05-19 21:21:44', '2022-05-19 21:21:44', 'Test', NULL, NULL, '', 34, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(40, 'Complaint to Resident', '', 'Resolved', '2022-05-19 21:25:01', '2022-05-19 21:25:01', 'Test', 'Leader, Purok', '2022-05-25 00:41:34', 'Major', 1, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(41, 'Complaint to Resident', '', 'Scheduled', '2022-05-19 21:29:19', '2022-05-19 21:29:19', 'Test', 'Handson, Roxy', '2022-05-22 00:02:49', 'Major', 41, '2022-06-01', 28, 'Paknaan', 'Kamatis', 0, 150, 'https://getpaid.gcash.com/checkout/9bd484811873ff175c67b1cc3bb3af8c'),
(42, 'Complaint to Resident', '', 'Resolved', '2022-05-19 23:27:41', '2022-05-19 23:27:41', 'Patakag labay sa iyang basura, gibadlong na nako kapila pero balikon gihapon niya. Ang labayan pa pud kay ari jd dapit sa among yuta nya kung badlongon siya pay mag suko! Palihug ko badlong nya purok leader!', 'Purok Leader', '2022-05-21 23:44:00', 'Major', 39, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(43, 'Garbage', 'Improper disposal', 'Resolved', '2022-05-21 18:26:28', '2022-05-21 18:26:28', 'test', 'Test', '2022-05-21 22:28:16', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(44, 'Garbage', 'Improper disposal', 'Resolved', '2022-05-21 22:35:21', '2022-05-21 22:35:21', 'Test', 'Purok Leader', '2022-05-21 22:45:53', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(45, 'Complaint to Resident', '', 'To Captain', '2022-05-25 00:27:35', '2022-05-25 00:27:35', 'test', 'Jackson Ville', '2022-05-25 01:44:28', 'Major', 39, NULL, 28, 'Paknaan', 'Kamatis', 0, 150, 'https://getpaid.gcash.com/checkout/f1f89ea1ab1a7a8cbc6b6157300de43b'),
(46, 'Garbage', 'Improper disposal', 'Ongoing', '2022-05-25 00:43:03', '2022-05-25 00:43:03', 'Test', 'Leader, Purok', '2022-05-25 00:43:18', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL),
(47, 'Complaint to Resident', '', 'To Captain', '2022-05-25 01:40:47', '2022-05-25 01:40:47', 'qwrqwr', 'Jackson Ville', '2022-05-25 01:44:31', 'Major', 1, NULL, 28, 'Paknaan', 'Kamatis', 0, 150, 'https://getpaid.gcash.com/checkout/064bb8101ca1e84c54c6b5ade4aa907b'),
(48, 'Garbage', 'Improper disposal', 'Ongoing', '2022-05-28 02:57:51', '2022-05-28 02:57:51', 'Test', 'Leader, Purok', '2022-05-28 03:00:42', 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ereklamocategory`
--

CREATE TABLE `ereklamocategory` (
  `reklamoCatID` int NOT NULL,
  `reklamoCatName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reklamoCatBrgy` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reklamoCatPriority` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reklamoFee` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamocategory`
--

INSERT INTO `ereklamocategory` (`reklamoCatID`, `reklamoCatName`, `reklamoCatBrgy`, `reklamoCatPriority`, `reklamoFee`) VALUES
(6, 'Garbage', 'Paknaan', 'Minor', 0),
(8, 'Barangay Infrastructures', 'Paknaan', 'Minor', 0),
(14, 'Residents', 'Paknaan', 'Minor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ereklamoreport`
--

CREATE TABLE `ereklamoreport` (
  `ereportID` int NOT NULL,
  `ReklamoID` int NOT NULL,
  `respondentID` int NOT NULL,
  `reportMessage` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reportStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamoreport`
--

INSERT INTO `ereklamoreport` (`ereportID`, `ReklamoID`, `respondentID`, `reportMessage`, `date`, `reportStatus`) VALUES
(5, 32, 34, 'SampleMEssage', '2022-05-17 18:42:18', ''),
(6, 35, 34, 'Test', '2022-05-17 18:42:18', ''),
(8, 33, 31, 'test', '2022-05-17 18:42:18', ''),
(9, 31, 31, 'test', '2022-05-17 23:20:56', ''),
(10, 31, 31, 'test', '2022-05-17 23:24:44', ''),
(11, 31, 31, 'Test', '2022-05-17 23:27:25', ''),
(12, 37, 34, 'service was done immediately. ', '2022-05-18 11:17:56', ''),
(13, 36, 34, 'asdafqwqweqweqweadsdasdasdasd', '2022-05-20 01:59:36', ''),
(14, 38, 34, '', '2022-05-20 02:41:06', ''),
(15, 38, 34, '', '2022-05-20 02:41:52', ''),
(16, 38, 34, 'rqwrwqr', '2022-05-20 02:42:47', ''),
(17, 38, 34, 'rwqrqwrqw', '2022-05-20 02:43:59', ''),
(18, 38, 34, '', '2022-05-20 17:23:16', ''),
(19, 38, 34, 'Test', '2022-05-20 17:37:54', ''),
(20, 38, 34, 'tqwqwe', '2022-05-21 15:04:35', ''),
(21, 38, 34, 'qwew', '2022-05-21 17:00:12', 'Resolved'),
(22, 38, 34, 'qwew', '2022-05-21 17:00:12', ''),
(23, 38, 34, 'tetqwe', '2022-05-21 18:40:29', 'Resolved'),
(24, 38, 34, 'tetqwe', '2022-05-21 18:40:30', ''),
(25, 38, 34, 'qweqweq', '2022-05-21 18:40:41', 'Unresolved'),
(26, 38, 34, 'qweqweq', '2022-05-21 18:40:41', ''),
(27, 38, 34, 'qwrqwrqwr', '2022-05-21 18:40:48', 'Resolved'),
(28, 38, 34, 'qwrqwrqwr', '2022-05-21 18:40:48', ''),
(29, 38, 34, 'qwrw', '2022-05-21 19:09:03', 'Resolved'),
(30, 38, 34, 'Test', '2022-05-21 20:52:56', 'Resolved'),
(31, 43, 31, 'TEst', '2022-05-21 22:14:06', 'Resolved'),
(32, 38, 31, 'Test', '2022-05-21 22:14:31', 'Resolved'),
(53, 44, 34, 'test', '2022-05-21 22:36:05', 'Resolved'),
(57, 44, 31, 'Test', '2022-05-21 22:45:53', 'Resolved'),
(58, 38, 31, 'test', '2022-05-21 22:47:35', 'Resolved'),
(60, 36, 31, 'Test', '2022-05-21 22:57:02', 'Resolved'),
(63, 42, 31, 'test', '2022-05-21 23:44:00', 'Resolved'),
(64, 41, 31, 'test', '2022-05-21 23:45:43', 'Forward to Captain'),
(67, 33, 29, 'test', '2022-05-22 02:22:44', 'Forward to LUPON'),
(68, 31, 29, 'Reschedule', '2022-05-22 02:23:48', 'Reschedule'),
(69, 31, 29, 'Test', '2022-05-23 04:23:28', 'Forward to LUPON'),
(70, 45, 31, 'Test', '2022-05-25 00:52:40', ''),
(71, 47, 31, 'Test', '2022-05-25 01:41:17', 'Forward to Captain'),
(72, 45, 31, 'qwew qweqweqw qeqwe qe', '2022-05-25 01:43:44', 'Forward to Captain');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamotype`
--

CREATE TABLE `ereklamotype` (
  `reklamoTypeID` int NOT NULL,
  `reklamoTypeName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reklamoCatID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamotype`
--

INSERT INTO `ereklamotype` (`reklamoTypeID`, `reklamoTypeName`, `reklamoCatID`) VALUES
(1, 'Improper disposal', 6),
(5, 'Broken Roads', 8),
(13, 'Solicitors', 14),
(14, 'Illegal Vendors', 14);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `membersID` int NOT NULL,
  `UsersID` int NOT NULL,
  `residentCatID` int NOT NULL,
  `createdOn` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Not Read',
  `UsersID` int DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(60, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Read', NULL, 'Secretary', '2022-03-28 17:13:02', '2022-03-28 17:13:02'),
(61, 'Your account verification has been approved!', 'Resident', 'Not Read', 39, NULL, '2022-03-28 21:40:09', '2022-03-28 21:40:09'),
(62, 'Your account verification has been approved!', 'Resident', 'Not Read', 40, NULL, '2022-03-28 21:40:11', '2022-03-28 21:40:11'),
(63, 'Your account verification has been approved!', 'Resident', 'Read', 34, NULL, '2022-03-28 21:40:13', '2022-03-28 21:40:13'),
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
(92, 'Your account verification has been approved!', 'Resident', 'Read', 41, NULL, '2022-01-10 13:22:33', '2022-01-10 13:22:33'),
(93, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 16:15:28', '2022-05-12 16:15:28'),
(94, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 16:17:58', '2022-05-12 16:17:58'),
(95, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 16:18:36', '2022-05-12 16:18:36'),
(96, 'A resident has requested a Indigency Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 16:19:21', '2022-05-12 16:19:21'),
(97, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 16:23:56', '2022-05-12 16:23:56'),
(98, 'A resident has requested a Indigency Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 16:34:26', '2022-05-12 16:34:26'),
(99, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 17:05:19', '2022-05-12 17:05:19'),
(100, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 19:48:48', '2022-05-12 19:48:48'),
(101, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-12 21:21:14', '2022-05-12 21:21:14'),
(105, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-12 21:23:59', '2022-05-12 21:23:59'),
(107, 'The purok leader has approved your request for \'. Please process the payment ', 'request', 'Read', 30, 'Resident', '2022-05-12 21:28:52', '2022-05-12 21:28:52'),
(108, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-12 21:28:52', '2022-05-12 21:28:52'),
(109, 'The purok leader has approved your request for Barangay Clearance. Please process the payment', 'request', 'Read', 30, 'Resident', '2022-05-12 21:38:29', '2022-05-12 21:38:29'),
(110, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-12 21:38:29', '2022-05-12 21:38:29'),
(111, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-12 21:49:52', '2022-05-12 21:49:52'),
(112, 'Your Barangay Clearance is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 28, 'Resident', '2022-05-12 21:49:52', '2022-05-12 21:49:52'),
(113, 'Your account verification has been approved!', 'Resident', 'Not Read', 46, NULL, '2022-05-12 22:37:17', '2022-05-12 22:37:17'),
(114, 'Your account verification has been approved!', 'Resident', 'Not Read', 1, NULL, '2022-05-12 22:50:28', '2022-05-12 22:50:28'),
(115, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-14 21:14:56', '2022-05-14 21:14:56'),
(116, 'Your eReklamo#32 has been accepted by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-15 14:51:18', '2022-05-15 14:51:18'),
(117, 'Your eReklamo#34 has been accepted by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-15 16:32:38', '2022-05-15 16:32:38'),
(118, 'Your eReklamo#34 has been accepted by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-15 17:31:06', '2022-05-15 17:31:06'),
(119, 'Your eReklamo#34 has been accepted by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-15 17:33:08', '2022-05-15 17:33:08'),
(120, 'Your eReklamo#34 has been accepted by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-15 17:43:46', '2022-05-15 17:43:46'),
(121, 'Your eReklamo#34 has been resolved by Purok Leader Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-16 17:00:03', '2022-05-16 17:00:03'),
(122, 'Respondents has been sent for your ReklamoID#32', 'ereklamo', 'Read', 28, 'Resident', '2022-05-16 17:09:23', '2022-05-16 17:09:23'),
(123, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-16 21:14:09', '2022-05-16 21:14:09'),
(124, 'Your eReklamo#35 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-16 21:14:43', '2022-05-16 21:14:43'),
(125, 'Your eReklamo#32 has been resolved by Purok Leader Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-16 21:17:44', '2022-05-16 21:17:44'),
(126, 'Respondents has been sent for your ReklamoID#35', 'ereklamo', 'Read', 28, 'Resident', '2022-05-16 21:45:07', '2022-05-16 21:45:07'),
(127, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-16 21:52:37', '2022-05-16 21:52:37'),
(128, 'Your eReklamo#36 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-16 21:53:12', '2022-05-16 21:53:12'),
(129, 'Your eReklamo#31 is now being scheduled by Purok Leader.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 11:18:13', '2022-05-17 11:18:13'),
(130, 'Your eReklamo#31 is now being scheduled by Purok Leader.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 11:29:29', '2022-05-17 11:29:29'),
(131, 'Your eReklamo#33 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 13:57:12', '2022-05-17 13:57:12'),
(132, 'Your eReklamo#33 has been resolved by Purok Leader Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 15:48:42', '2022-05-17 15:48:42'),
(133, 'Your eReklamo#33 has been resolved by Purok Leader Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 16:09:02', '2022-05-17 16:09:02'),
(134, 'Your eReklamo#31 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 17:43:47', '2022-05-17 17:43:47'),
(135, 'Your ereklamo#33 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-17 17:44:11', '2022-05-17 17:44:11'),
(136, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Read', 34, NULL, '2022-05-17 17:44:11', '2022-05-17 17:44:11'),
(142, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 18:41:05', '2022-05-17 18:41:05'),
(143, 'Your eReklamo has been scheduled on 2022-05-19', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 18:57:28', '2022-05-17 18:57:28'),
(144, 'Your eReklamo has been scheduled on 2022-05-19', 'ereklamo', 'Read', 34, 'Resident', '2022-05-17 18:57:28', '2022-05-17 18:57:28'),
(145, 'An eReklamo has been scheduled on 2022-05-19', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-17 18:57:28', '2022-05-17 18:57:28'),
(146, 'Your eReklamo#33 has been rescheduled by Captain Jeremy.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 19:28:46', '2022-05-17 19:28:46'),
(147, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 19:38:29', '2022-05-17 19:38:29'),
(148, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 34, 'Resident', '2022-05-17 19:38:29', '2022-05-17 19:38:29'),
(149, 'An eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-17 19:38:29', '2022-05-17 19:38:29'),
(150, 'Your eReklamo#33 has been rescheduled by Captain Jeremy.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 20:21:54', '2022-05-17 20:21:54'),
(151, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 20:27:13', '2022-05-17 20:27:13'),
(152, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 34, 'Resident', '2022-05-17 20:27:13', '2022-05-17 20:27:13'),
(153, 'An eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-17 20:27:13', '2022-05-17 20:27:13'),
(154, 'Your eReklamo#33 has been rescheduled by Captain Jeremy.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 20:28:22', '2022-05-17 20:28:22'),
(155, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 20:29:23', '2022-05-17 20:29:23'),
(156, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 34, 'Resident', '2022-05-17 20:29:23', '2022-05-17 20:29:23'),
(157, 'An eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-17 20:29:23', '2022-05-17 20:29:23'),
(158, 'Your eReklamo#33 has been rescheduled by Captain Jeremy.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 20:32:44', '2022-05-17 20:32:44'),
(159, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 28, 'Resident', '2022-05-17 20:33:12', '2022-05-17 20:33:12'),
(160, 'Your eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', 34, 'Resident', '2022-05-17 20:33:12', '2022-05-17 20:33:12'),
(161, 'An eReklamo has been scheduled on 2022-05-18', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-17 20:33:12', '2022-05-17 20:33:12'),
(162, 'Your ereklamo#31 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-17 23:20:56', '2022-05-17 23:20:56'),
(163, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Read', 34, NULL, '2022-05-17 23:20:56', '2022-05-17 23:20:56'),
(164, 'Your ereklamo#31 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-17 23:24:44', '2022-05-17 23:24:44'),
(165, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Read', 34, NULL, '2022-05-17 23:24:44', '2022-05-17 23:24:44'),
(166, 'Your ereklamo#31 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-17 23:27:25', '2022-05-17 23:27:25'),
(167, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Read', 34, NULL, '2022-05-17 23:27:25', '2022-05-17 23:27:25'),
(169, 'An ereklamo is ready for scheduling!', 'eReklamo', 'Read', NULL, 'Secretary', '2022-05-18 01:09:39', '2022-05-18 01:09:39'),
(170, 'Your payment for the ereklamo#31 has been confirmed by the Treasurer! Please await for your schedule', 'eReklamo', 'Read', 28, 'Resident', '2022-05-18 01:09:39', '2022-05-18 01:09:39'),
(171, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-18 10:54:10', '2022-05-18 10:54:10'),
(172, 'Your eReklamo#37 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-18 10:56:43', '2022-05-18 10:56:43'),
(173, 'Respondents has been sent for your ReklamoID#37', 'ereklamo', 'Read', 28, 'Resident', '2022-05-18 11:10:44', '2022-05-18 11:10:44'),
(174, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-19 15:41:18', '2022-05-19 15:41:18'),
(175, 'Respondents has been sent for your ReklamoID#36', 'ereklamo', 'Read', 28, 'Resident', '2022-05-19 20:05:52', '2022-05-19 20:05:52'),
(176, 'Resident Johnson, Xavier has sent a reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-19 21:21:44', '2022-05-19 21:21:44'),
(177, 'Resident Johnson, Xavier has sent a major reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-19 21:25:01', '2022-05-19 21:25:01'),
(178, 'Resident Johnson, Xavier has sent a major reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-19 21:29:19', '2022-05-19 21:29:19'),
(179, 'Your eReklamo#41 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-19 23:22:08', '2022-05-19 23:22:08'),
(180, 'Resident Johnson, Xavier has sent a major reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-19 23:27:41', '2022-05-19 23:27:41'),
(181, 'Your eReklamo#42 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-19 23:33:57', '2022-05-19 23:33:57'),
(182, 'Your eReklamo#38 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-20 01:26:27', '2022-05-20 01:26:27'),
(183, 'Respondents has been sent for your ReklamoID#38', 'ereklamo', 'Read', 28, 'Resident', '2022-05-20 02:04:21', '2022-05-20 02:04:21'),
(184, 'Resident Johnson, Xavier has sent a minor reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-21 18:26:28', '2022-05-21 18:26:28'),
(185, 'A responder has sent a report for ereklamo#38', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-21 19:09:03', '2022-05-21 19:09:03'),
(186, 'A responder has sent a report for ereklamo#38', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-21 20:52:56', '2022-05-21 20:52:56'),
(187, 'Your eReklamo#43 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-21 21:22:01', '2022-05-21 21:22:01'),
(188, 'Respondents has been sent for your ReklamoID#43', 'ereklamo', 'Read', 28, 'Resident', '2022-05-21 21:50:15', '2022-05-21 21:50:15'),
(189, 'Resident Johnson, Xavier has sent a minor reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-21 22:35:21', '2022-05-21 22:35:21'),
(190, 'Your eReklamo#44 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-21 22:35:37', '2022-05-21 22:35:37'),
(191, 'Respondents has been sent for your ReklamoID#44', 'ereklamo', 'Read', 28, 'Resident', '2022-05-21 22:35:46', '2022-05-21 22:35:46'),
(192, 'A responder has sent a report for ereklamo#44', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-21 22:36:05', '2022-05-21 22:36:05'),
(193, 'Purok Leader has resolved ereklamo#38', 'ereklamo', 'Read', 28, 'Purok Leader', '2022-05-21 22:47:35', '2022-05-21 22:47:35'),
(194, 'Purok Leader has resolved ereklamo#$id', 'ereklamo', 'Read', 28, 'Purok Leader', '2022-05-21 22:55:43', '2022-05-21 22:55:43'),
(195, 'Purok Leader has resolved ereklamo#36', 'ereklamo', 'Read', 28, 'Purok Leader', '2022-05-21 22:57:02', '2022-05-21 22:57:02'),
(200, 'Purok Leader has resolved your ereklamo#42', 'ereklamo', 'Read', 28, 'Purok Leader', '2022-05-21 23:44:00', '2022-05-21 23:44:00'),
(201, 'Your ereklamo#41 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-21 23:45:44', '2022-05-21 23:45:44'),
(202, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Read', 28, NULL, '2022-05-21 23:45:44', '2022-05-21 23:45:44'),
(203, 'An ereklamo is ready for scheduling!', 'eReklamo', 'Read', NULL, 'Secretary', '2022-05-21 23:46:23', '2022-05-21 23:46:23'),
(204, 'Your payment for the ereklamo#41 has been confirmed by the Treasurer! Please await for your schedule', 'eReklamo', 'Read', 28, 'Resident', '2022-05-21 23:46:23', '2022-05-21 23:46:23'),
(205, 'Your eReklamo has been scheduled on 2022-05-23', 'ereklamo', 'Read', 28, 'Resident', '2022-05-21 23:56:11', '2022-05-21 23:56:11'),
(206, 'Your eReklamo has been scheduled on 2022-05-23', 'ereklamo', 'Read', 34, 'Resident', '2022-05-21 23:56:11', '2022-05-21 23:56:11'),
(207, 'An eReklamo has been scheduled on 2022-05-23', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-21 23:56:11', '2022-05-21 23:56:11'),
(208, 'Your eReklamo has been scheduled on 2022-06-01', 'ereklamo', 'Read', 28, 'Resident', '2022-05-22 00:02:49', '2022-05-22 00:02:49'),
(209, 'Your eReklamo has been scheduled on 2022-06-01', 'ereklamo', 'Read', 41, 'Resident', '2022-05-22 00:02:49', '2022-05-22 00:02:49'),
(210, 'An eReklamo has been scheduled on 2022-06-01', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-22 00:02:49', '2022-05-22 00:02:49'),
(215, 'Captain has forward your reklamo#33 to the LUPON', 'ereklamo', 'Read', 28, 'Resident', '2022-05-22 02:22:44', '2022-05-22 02:22:44'),
(216, 'Captain has forward your reklamo#33 to the LUPON', 'ereklamo', 'Read', 34, 'Resident', '2022-05-22 02:22:44', '2022-05-22 02:22:44'),
(217, 'Captain rescheduled your ereklamo#31', 'ereklamo', 'Read', 28, 'Resident', '2022-05-22 02:23:48', '2022-05-22 02:23:48'),
(218, 'Captain rescheduled your ereklamo#31', 'ereklamo', 'Read', 34, 'Resident', '2022-05-22 02:23:48', '2022-05-22 02:23:48'),
(219, 'Your eReklamo has been scheduled on 2022-05-27', 'ereklamo', 'Read', 28, 'Resident', '2022-05-22 02:32:35', '2022-05-22 02:32:35'),
(220, 'Your eReklamo has been scheduled on 2022-05-27', 'ereklamo', 'Read', 34, 'Resident', '2022-05-22 02:32:35', '2022-05-22 02:32:35'),
(221, 'An eReklamo has been scheduled on 2022-05-27', 'ereklamo', 'Read', NULL, 'Captain', '2022-05-22 02:32:35', '2022-05-22 02:32:35'),
(222, 'Your eReklamo#40 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-22 20:05:52', '2022-05-22 20:05:52'),
(223, 'Captain has forward your reklamo#31 to the LUPON', 'ereklamo', 'Read', 28, 'Resident', '2022-05-23 04:23:28', '2022-05-23 04:23:28'),
(224, 'Captain has forward your reklamo#31 to the LUPON', 'ereklamo', 'Read', 34, 'Resident', '2022-05-23 04:23:28', '2022-05-23 04:23:28'),
(225, 'Resident Johnson, Xavier has sent a major reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-25 00:27:35', '2022-05-25 00:27:35'),
(226, 'Your eReklamo#45 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-25 00:41:26', '2022-05-25 00:41:26'),
(227, 'Your eReklamo#40 has been resolved by Purok Leader Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-25 00:41:34', '2022-05-25 00:41:34'),
(228, 'Your eReklamo#37 has been resolved by Purok Leader Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-25 00:42:15', '2022-05-25 00:42:15'),
(229, 'Resident Johnson, Xavier has sent a minor reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-25 00:43:03', '2022-05-25 00:43:03'),
(230, 'Your eReklamo#46 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-25 00:43:18', '2022-05-25 00:43:18'),
(231, 'Your ereklamo#45 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-25 00:52:40', '2022-05-25 00:52:40'),
(232, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Not Read', 39, NULL, '2022-05-25 00:52:40', '2022-05-25 00:52:40'),
(233, 'An ereklamo is ready for scheduling!', 'eReklamo', 'Read', NULL, 'Secretary', '2022-05-25 00:58:50', '2022-05-25 00:58:50'),
(234, 'Your payment for the ereklamo#45 has been confirmed by the Treasurer! Please await for your schedule', 'eReklamo', 'Read', 28, 'Resident', '2022-05-25 00:58:50', '2022-05-25 00:58:50'),
(235, 'Resident Johnson, Xavier has sent a major reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-25 01:40:47', '2022-05-25 01:40:47'),
(236, 'Your eReklamo#47 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-25 01:41:05', '2022-05-25 01:41:05'),
(237, 'Your ereklamo#47 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-25 01:41:19', '2022-05-25 01:41:19'),
(238, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Read', 28, NULL, '2022-05-25 01:41:19', '2022-05-25 01:41:19'),
(239, 'Your ereklamo#45 has been forwarded to Capt. Please process the payment.', 'ereklamo', 'Read', 28, NULL, '2022-05-25 01:43:46', '2022-05-25 01:43:46'),
(240, 'The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', 'Read', 28, NULL, '2022-05-25 01:43:46', '2022-05-25 01:43:46'),
(241, 'An ereklamo is ready for scheduling!', 'eReklamo', 'Read', NULL, 'Secretary', '2022-05-25 01:44:28', '2022-05-25 01:44:28'),
(242, 'Your payment for the ereklamo#45 has been confirmed by the Treasurer! Please await for your schedule', 'eReklamo', 'Read', 28, 'Resident', '2022-05-25 01:44:28', '2022-05-25 01:44:28'),
(243, 'An ereklamo is ready for scheduling!', 'eReklamo', 'Read', NULL, 'Secretary', '2022-05-25 01:44:31', '2022-05-25 01:44:31'),
(244, 'Your payment for the ereklamo#47 has been confirmed by the Treasurer! Please await for your schedule', 'eReklamo', 'Read', 28, 'Resident', '2022-05-25 01:44:31', '2022-05-25 01:44:31'),
(245, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-26 03:38:21', '2022-05-26 03:38:21'),
(246, 'The purok leader has approved your request for Barangay Clearance. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-26 05:01:38', '2022-05-26 05:01:38'),
(247, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-26 05:01:38', '2022-05-26 05:01:38'),
(248, 'Your account verification has been approved!', 'Resident', 'Not Read', 44, NULL, '2022-05-26 12:04:04', '2022-05-26 12:04:04'),
(257, 'Your account verification has been approved!', 'Resident', 'Read', 28, NULL, '2022-05-26 12:19:55', '2022-05-26 12:19:55'),
(260, 'Your account verification has been approved!', 'Resident', 'Not Read', 45, NULL, '2022-05-26 12:29:28', '2022-05-26 12:29:28'),
(261, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-26 14:46:38', '2022-05-26 14:46:38'),
(262, 'Your  is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 0, 'Resident', '2022-05-26 14:46:38', '2022-05-26 14:46:38'),
(263, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-26 14:46:45', '2022-05-26 14:46:45'),
(264, 'Your  is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 0, 'Resident', '2022-05-26 14:46:45', '2022-05-26 14:46:45'),
(265, 'A resident has requested a 2', 'request', 'Read', NULL, 'Purok Leader', '2022-05-27 02:46:40', '2022-05-27 02:46:40'),
(266, 'A resident has requested a 2', 'request', 'Read', NULL, 'Purok Leader', '2022-05-27 02:48:09', '2022-05-27 02:48:09'),
(267, 'A resident has requested a 1', 'request', 'Read', NULL, 'Purok Leader', '2022-05-27 02:50:29', '2022-05-27 02:50:29'),
(268, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-27 03:01:14', '2022-05-27 03:01:14'),
(269, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-27 03:02:09', '2022-05-27 03:02:09'),
(270, 'The purok leader has approved your request for Cedula. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-27 18:33:19', '2022-05-27 18:33:19'),
(271, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-27 18:33:19', '2022-05-27 18:33:19'),
(272, 'Resident Johnson, Xavier has sent a minor reklamo!', 'ereklamo', 'Read', NULL, 'Purok Leader', '2022-05-28 02:57:51', '2022-05-28 02:57:51'),
(273, 'Your eReklamo#48 is now being processed by Purok.', 'ereklamo', 'Read', 28, 'Resident', '2022-05-28 03:00:42', '2022-05-28 03:00:42'),
(274, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-28 03:41:59', '2022-05-28 03:41:59'),
(275, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-28 13:22:32', '2022-05-28 13:22:32'),
(276, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-28 13:26:12', '2022-05-28 13:26:12'),
(277, 'A resident has requested a Barangay Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-28 13:26:38', '2022-05-28 13:26:38'),
(278, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-28 13:28:50', '2022-05-28 13:28:50'),
(279, 'The purok leader has disapproved your request for Barangay Clearance. Reason: The request did not meet the requirements.', 'request', 'Read', 28, 'Resident', '2022-05-28 19:20:29', '2022-05-28 19:20:29'),
(280, 'The purok leader has approved your request for Cedula. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-28 19:24:41', '2022-05-28 19:24:41'),
(281, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 19:24:41', '2022-05-28 19:24:41'),
(282, 'The purok leader has approved your request for Cedula. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-28 19:24:46', '2022-05-28 19:24:46'),
(283, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 19:24:46', '2022-05-28 19:24:46'),
(284, 'The purok leader has approved your request for Barangay Clearance. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-28 19:24:52', '2022-05-28 19:24:52'),
(285, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 19:24:52', '2022-05-28 19:24:52'),
(286, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-28 19:25:18', '2022-05-28 19:25:18'),
(287, 'Your Cedula is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 28, 'Resident', '2022-05-28 19:25:18', '2022-05-28 19:25:18'),
(288, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-28 19:25:28', '2022-05-28 19:25:28'),
(289, 'Your Barangay Clearance is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 30, 'Resident', '2022-05-28 19:25:28', '2022-05-28 19:25:28'),
(290, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-28 20:04:43', '2022-05-28 20:04:43'),
(291, 'Your Cedula is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:04:43', '2022-05-28 20:04:43'),
(292, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-28 20:06:12', '2022-05-28 20:06:12'),
(293, 'Your Barangay Clearance is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:06:12', '2022-05-28 20:06:12'),
(294, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-28 20:07:03', '2022-05-28 20:07:03'),
(295, 'Your Barangay Clearance is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:07:03', '2022-05-28 20:07:03'),
(296, 'A new request is ready for release!', 'request', 'Read', NULL, 'Secretary', '2022-05-28 20:09:44', '2022-05-28 20:09:44'),
(297, 'Your Cedula is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:09:44', '2022-05-28 20:09:44'),
(298, 'Your Cedula is has been cancelled for not paying in time.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:10:01', '2022-05-28 20:10:01'),
(299, 'A resident has requested a Cedula', 'request', 'Read', NULL, 'Purok Leader', '2022-05-28 20:10:26', '2022-05-28 20:10:26'),
(300, 'The purok leader has approved your request for Cedula. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:10:51', '2022-05-28 20:10:51'),
(301, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 20:10:51', '2022-05-28 20:10:51'),
(302, 'The purok leader has approved your request for Barangay Clearance. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:10:54', '2022-05-28 20:10:54'),
(303, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 20:10:54', '2022-05-28 20:10:54'),
(304, 'The purok leader has approved your request for Cedula. Please process the payment.', 'request', 'Read', 28, 'Resident', '2022-05-28 20:10:58', '2022-05-28 20:10:58'),
(305, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 20:10:58', '2022-05-28 20:10:58'),
(306, 'A resident has requested a Indigency Clearance', 'request', 'Read', NULL, 'Purok Leader', '2022-05-28 20:16:25', '2022-05-28 20:16:25'),
(307, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 20:43:26', '2022-05-28 20:43:26'),
(308, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 20:50:29', '2022-05-28 20:50:29'),
(309, 'A new request is ready for payment', 'request', 'Read', NULL, 'Treasurer', '2022-05-28 20:52:12', '2022-05-28 20:52:12'),
(310, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-06-01 13:22:22', '2022-06-01 13:22:22');

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
  `barangay` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
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
(12, 'Sah', 'Bakilid', 'False', NULL),
(13, 'Mansanitas', 'Paknaan', 'True', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` int NOT NULL,
  `ReportType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reportMessage` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsersID` int NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `userBarangay` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userPurok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
(105, 'eReklamo', 'Captain has entered a new reklamo type for category type: Barangay Infrastructures', 29, '2022-04-15 20:18:59', '2022-04-15 20:18:59', 'Paknaan', 'Kamatis'),
(106, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 31', 31, '2022-05-12 16:25:51', '2022-05-12 16:25:51', 'Paknaan', 'Kamatis'),
(107, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 31', 37, '2022-05-12 16:26:50', '2022-05-12 16:26:50', 'Paknaan', 'Kamatis'),
(108, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 32', 31, '2022-05-12 16:51:04', '2022-05-12 16:51:04', 'Paknaan', 'Kamatis'),
(109, 'Request', 'Secretary Handson,Roxy has released the RequestID # 32', 30, '2022-05-12 17:02:38', '2022-05-12 17:02:38', 'Paknaan', 'Kamatis'),
(110, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 33', 31, '2022-05-12 17:06:25', '2022-05-12 17:06:25', 'Paknaan', 'Kamatis'),
(111, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 33', 37, '2022-05-12 17:11:34', '2022-05-12 17:11:34', 'Paknaan', 'Kamatis'),
(112, 'Request', 'Secretary Handson,Roxy has released the RequestID # 33', 30, '2022-05-12 17:14:17', '2022-05-12 17:14:17', 'Paknaan', 'Kamatis'),
(116, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 35', 31, '2022-05-12 21:23:59', '2022-05-12 21:23:59', 'Paknaan', 'Kamatis'),
(118, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 34', 31, '2022-05-12 21:28:52', '2022-05-12 21:28:52', 'Paknaan', 'Kamatis'),
(119, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 34', 31, '2022-05-12 21:38:29', '2022-05-12 21:38:29', 'Paknaan', 'Kamatis'),
(120, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 35', 37, '2022-05-12 21:49:52', '2022-05-12 21:49:52', 'Paknaan', 'Kamatis'),
(121, 'eReklamo', 'Captain has modified reklamo category #7', 29, '2022-05-14 16:33:14', '2022-05-14 16:33:14', 'Paknaan', 'Kamatis'),
(122, 'eReklamo', 'Captain has modified reklamo category #7', 29, '2022-05-14 16:44:41', '2022-05-14 16:44:41', 'Paknaan', 'Kamatis'),
(123, 'eReklamo', 'Captain has modified reklamo category #7', 29, '2022-05-14 16:48:29', '2022-05-14 16:48:29', 'Paknaan', 'Kamatis'),
(124, 'eReklamo', 'Captain has modified reklamo category #7', 29, '2022-05-14 17:02:20', '2022-05-14 17:02:20', 'Paknaan', 'Kamatis'),
(125, 'eReklamo', 'Captain has modified reklamo category #7', 29, '2022-05-14 17:02:38', '2022-05-14 17:02:38', 'Paknaan', 'Kamatis'),
(126, 'eReklamo', 'Captain has modified reklamo category #6', 29, '2022-05-14 17:02:48', '2022-05-14 17:02:48', 'Paknaan', 'Kamatis'),
(127, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-05-14 19:04:34', '2022-05-14 19:04:34', 'Paknaan', 'Kamatis'),
(128, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 20:30:49', '2022-05-14 20:30:49', 'Paknaan', 'Kamatis'),
(129, 'eReklamo', 'Captain has entered a new reklamo type for category type: Garbage', 29, '2022-05-14 20:39:47', '2022-05-14 20:39:47', 'Paknaan', 'Kamatis'),
(130, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 20:39:51', '2022-05-14 20:39:51', 'Paknaan', 'Kamatis'),
(131, 'eReklamo', 'Captain has entered a new reklamo category type: Test', 29, '2022-05-14 20:45:36', '2022-05-14 20:45:36', 'Paknaan', 'Kamatis'),
(132, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 20:48:52', '2022-05-14 20:48:52', 'Paknaan', 'Kamatis'),
(133, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 20:55:51', '2022-05-14 20:55:51', 'Paknaan', 'Kamatis'),
(134, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-05-14 20:56:25', '2022-05-14 20:56:25', 'Paknaan', 'Kamatis'),
(135, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 20:56:28', '2022-05-14 20:56:28', 'Paknaan', 'Kamatis'),
(136, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-05-14 20:56:36', '2022-05-14 20:56:36', 'Paknaan', 'Kamatis'),
(137, 'eReklamo', 'Captain has modified the reklamo type #10', 29, '2022-05-14 20:56:42', '2022-05-14 20:56:42', 'Paknaan', 'Kamatis'),
(138, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 20:56:45', '2022-05-14 20:56:45', 'Paknaan', 'Kamatis'),
(139, 'eReklamo', 'Captain has entered a new reklamo category type: test', 29, '2022-05-14 20:56:49', '2022-05-14 20:56:49', 'Paknaan', 'Kamatis'),
(140, 'eReklamo', 'Captain has modified reklamo category #12', 29, '2022-05-14 20:56:55', '2022-05-14 20:56:55', 'Paknaan', 'Kamatis'),
(141, 'eReklamo', 'Captain has entered a new reklamo type for category type: testqwewqe', 29, '2022-05-14 20:57:03', '2022-05-14 20:57:03', 'Paknaan', 'Kamatis'),
(142, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 20:57:07', '2022-05-14 20:57:07', 'Paknaan', 'Kamatis'),
(143, 'eReklamo', 'Captain has entered a new reklamo category type: test', 29, '2022-05-14 21:10:17', '2022-05-14 21:10:17', 'Paknaan', 'Kamatis'),
(144, 'eReklamo', 'Captain has entered a new reklamo type for category type: test', 29, '2022-05-14 21:10:28', '2022-05-14 21:10:28', 'Paknaan', 'Kamatis'),
(145, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-14 21:10:40', '2022-05-14 21:10:40', 'Paknaan', 'Kamatis'),
(146, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#32', 31, '2022-05-15 14:51:18', '2022-05-15 14:51:18', 'Paknaan', 'Kamatis'),
(147, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#34', 31, '2022-05-15 16:32:38', '2022-05-15 16:32:38', 'Paknaan', 'Kamatis'),
(148, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#34', 31, '2022-05-15 17:31:06', '2022-05-15 17:31:06', 'Paknaan', 'Kamatis'),
(149, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#34', 31, '2022-05-15 17:33:08', '2022-05-15 17:33:08', 'Paknaan', 'Kamatis'),
(150, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#34', 31, '2022-05-15 17:43:46', '2022-05-15 17:43:46', 'Paknaan', 'Kamatis'),
(151, 'eReklamo', 'Purok Leader Purok has resolved ereklamo#34', 31, '2022-05-16 17:00:03', '2022-05-16 17:00:03', 'Paknaan', 'Kamatis'),
(152, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-16 20:04:38', '2022-05-16 20:04:38', 'Paknaan', 'Kamatis'),
(153, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#35', 31, '2022-05-16 21:14:43', '2022-05-16 21:14:43', 'Paknaan', 'Kamatis'),
(154, 'eReklamo', 'Purok Leader Purok has resolved ereklamo#32', 31, '2022-05-16 21:17:44', '2022-05-16 21:17:44', 'Paknaan', 'Kamatis'),
(155, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#36', 31, '2022-05-16 21:53:12', '2022-05-16 21:53:12', 'Paknaan', 'Kamatis'),
(159, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-16 22:43:33', '2022-05-16 22:43:33', 'Paknaan', 'Kamatis'),
(160, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#31', 31, '2022-05-17 11:18:13', '2022-05-17 11:18:13', 'Paknaan', 'Kamatis'),
(161, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#31', 31, '2022-05-17 11:29:29', '2022-05-17 11:29:29', 'Paknaan', 'Kamatis'),
(162, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#33', 31, '2022-05-17 13:57:12', '2022-05-17 13:57:12', 'Paknaan', 'Kamatis'),
(163, 'eReklamo', 'Purok Leader Purok has resolved ereklamo#33', 31, '2022-05-17 15:48:42', '2022-05-17 15:48:42', 'Paknaan', 'Kamatis'),
(164, 'eReklamo', 'Purok Leader Purok has resolved ereklamo#33', 31, '2022-05-17 16:09:03', '2022-05-17 16:09:03', 'Paknaan', 'Kamatis'),
(166, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#31', 31, '2022-05-17 17:43:47', '2022-05-17 17:43:47', 'Paknaan', 'Kamatis'),
(167, 'eReklamo', 'Purok Leader has forwarded reklamo#33 to Captain', 31, '2022-05-17 17:44:11', '2022-05-17 17:44:11', 'Paknaan', 'Kamatis'),
(173, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#33 on 2022-05-18', 30, '2022-05-17 18:41:05', '2022-05-17 18:41:05', 'Paknaan', 'Kamatis'),
(174, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#33 on 2022-05-19', 30, '2022-05-17 18:57:28', '2022-05-17 18:57:28', 'Paknaan', 'Kamatis'),
(176, 'eReklamo', 'Captain Jeremy has rescheduled ereklamo#33', 29, '2022-05-17 19:28:46', '2022-05-17 19:28:46', 'Paknaan', 'Kamatis'),
(177, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#33 on 2022-05-18', 30, '2022-05-17 19:38:29', '2022-05-17 19:38:29', 'Paknaan', 'Kamatis'),
(178, 'eReklamo', 'Captain Jeremy has rescheduled ereklamo#33', 29, '2022-05-17 20:21:54', '2022-05-17 20:21:54', 'Paknaan', 'Kamatis'),
(179, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#33 on 2022-05-18', 30, '2022-05-17 20:27:13', '2022-05-17 20:27:13', 'Paknaan', 'Kamatis'),
(180, 'eReklamo', 'Captain Jeremy has rescheduled ereklamo#33', 29, '2022-05-17 20:28:22', '2022-05-17 20:28:22', 'Paknaan', 'Kamatis'),
(181, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#33 on 2022-05-18', 30, '2022-05-17 20:29:23', '2022-05-17 20:29:23', 'Paknaan', 'Kamatis'),
(182, 'eReklamo', 'Captain Jeremy has rescheduled ereklamo#33', 29, '2022-05-17 20:32:44', '2022-05-17 20:32:44', 'Paknaan', 'Kamatis'),
(183, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#33 on 2022-05-18', 30, '2022-05-17 20:33:12', '2022-05-17 20:33:12', 'Paknaan', 'Kamatis'),
(184, 'eReklamo', 'Captain has modified reklamo category #7', 29, '2022-05-17 21:44:47', '2022-05-17 21:44:47', 'Paknaan', 'Kamatis'),
(185, 'eReklamo', 'Purok Leader has forwarded reklamo#31 to Captain', 31, '2022-05-17 23:20:56', '2022-05-17 23:20:56', 'Paknaan', 'Kamatis'),
(186, 'eReklamo', 'Purok Leader has forwarded reklamo#31 to Captain', 31, '2022-05-17 23:24:44', '2022-05-17 23:24:44', 'Paknaan', 'Kamatis'),
(187, 'eReklamo', 'Purok Leader has forwarded reklamo#31 to Captain', 31, '2022-05-17 23:27:25', '2022-05-17 23:27:25', 'Paknaan', 'Kamatis'),
(190, 'eReklamo', 'Treasurer Jackson Ville has confirmed the payment of ereklamo#31', 37, '2022-05-18 01:07:53', '2022-05-18 01:07:53', 'Paknaan', 'Kamatis'),
(192, 'eReklamo', 'Treasurer Jackson Ville has confirmed the payment of ereklamo#31', 37, '2022-05-18 01:09:39', '2022-05-18 01:09:39', 'Paknaan', 'Kamatis'),
(193, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#37', 31, '2022-05-18 10:56:43', '2022-05-18 10:56:43', 'Paknaan', 'Kamatis'),
(194, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-18 11:17:56', '2022-05-18 11:17:56', 'Paknaan', 'Kamatis'),
(195, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#41', 31, '2022-05-19 23:22:08', '2022-05-19 23:22:08', 'Paknaan', 'Kamatis'),
(196, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#42', 31, '2022-05-19 23:33:57', '2022-05-19 23:33:57', 'Paknaan', 'Kamatis'),
(197, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#38', 31, '2022-05-20 01:26:27', '2022-05-20 01:26:27', 'Paknaan', 'Kamatis'),
(198, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-20 01:59:36', '2022-05-20 01:59:36', 'Paknaan', 'Kamatis'),
(199, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-20 02:41:06', '2022-05-20 02:41:06', 'Paknaan', 'Kamatis'),
(200, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-20 02:41:52', '2022-05-20 02:41:52', 'Paknaan', 'Kamatis'),
(201, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-20 02:42:47', '2022-05-20 02:42:47', 'Paknaan', 'Kamatis'),
(202, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-20 02:43:59', '2022-05-20 02:43:59', 'Paknaan', 'Kamatis'),
(204, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-20 17:23:16', '2022-05-20 17:23:16', 'Paknaan', 'Kamatis'),
(205, 'eReklamo', 'Respondent Woshua Torts has reported back to Purok Leader', 34, '2022-05-20 17:37:54', '2022-05-20 17:37:54', 'Paknaan', 'Kamatis'),
(206, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#43', 31, '2022-05-21 21:22:01', '2022-05-21 21:22:01', 'Paknaan', 'Kamatis'),
(207, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#44', 31, '2022-05-21 22:35:37', '2022-05-21 22:35:37', 'Paknaan', 'Kamatis'),
(210, 'eReklamo', 'Purok Leader has forwarded reklamo#41 to Captain', 31, '2022-05-21 23:45:44', '2022-05-21 23:45:44', 'Paknaan', 'Kamatis'),
(211, 'eReklamo', 'Treasurer Jackson Ville has confirmed the payment of ereklamo#41', 37, '2022-05-21 23:46:22', '2022-05-21 23:46:22', 'Paknaan', 'Kamatis'),
(212, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#31 on 2022-05-23', 30, '2022-05-21 23:56:11', '2022-05-21 23:56:11', 'Paknaan', 'Kamatis'),
(213, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#41 on 2022-06-01', 30, '2022-05-22 00:02:49', '2022-05-22 00:02:49', 'Paknaan', 'Kamatis'),
(214, 'eReklamo', 'Secretary Roxy has scheduled ereklamo#31 on 2022-05-27', 30, '2022-05-22 02:32:35', '2022-05-22 02:32:35', 'Paknaan', 'Kamatis'),
(215, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#40', 31, '2022-05-22 20:05:52', '2022-05-22 20:05:52', 'Paknaan', 'Kamatis'),
(216, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-22 20:08:41', '2022-05-22 20:08:41', 'Paknaan', 'Kamatis'),
(217, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-22 20:08:44', '2022-05-22 20:08:44', 'Paknaan', 'Kamatis'),
(218, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#45', 31, '2022-05-25 00:41:26', '2022-05-25 00:41:26', 'Paknaan', 'Kamatis'),
(219, 'eReklamo', 'Purok Leader Purok has resolved ereklamo#40', 31, '2022-05-25 00:41:34', '2022-05-25 00:41:34', 'Paknaan', 'Kamatis'),
(220, 'eReklamo', 'Purok Leader Purok has resolved ereklamo#37', 31, '2022-05-25 00:42:15', '2022-05-25 00:42:15', 'Paknaan', 'Kamatis'),
(221, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#46', 31, '2022-05-25 00:43:18', '2022-05-25 00:43:18', 'Paknaan', 'Kamatis'),
(222, 'eReklamo', 'Purok Leader has forwarded reklamo#45 to Captain', 31, '2022-05-25 00:52:40', '2022-05-25 00:52:40', 'Paknaan', 'Kamatis'),
(223, 'eReklamo', 'Treasurer Jackson Ville has confirmed the payment of ereklamo#45', 37, '2022-05-25 00:58:50', '2022-05-25 00:58:50', 'Paknaan', 'Kamatis'),
(224, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#47', 31, '2022-05-25 01:41:05', '2022-05-25 01:41:05', 'Paknaan', 'Kamatis'),
(225, 'eReklamo', 'Purok Leader has forwarded reklamo#47 to Captain', 31, '2022-05-25 01:41:19', '2022-05-25 01:41:19', 'Paknaan', 'Kamatis'),
(226, 'eReklamo', 'Purok Leader has forwarded reklamo#45 to Captain', 31, '2022-05-25 01:43:46', '2022-05-25 01:43:46', 'Paknaan', 'Kamatis'),
(227, 'eReklamo', 'Treasurer Jackson Ville has confirmed the payment of ereklamo#45', 37, '2022-05-25 01:44:28', '2022-05-25 01:44:28', 'Paknaan', 'Kamatis'),
(228, 'eReklamo', 'Treasurer Jackson Ville has confirmed the payment of ereklamo#47', 37, '2022-05-25 01:44:31', '2022-05-25 01:44:31', 'Paknaan', 'Kamatis'),
(229, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 36', 31, '2022-05-26 05:01:38', '2022-05-26 05:01:38', 'Paknaan', 'Kamatis'),
(230, 'Request', 'Treasurer Elbertson,Jeremy has confirmed the payment for RequestID# 7', 29, '2022-05-26 14:46:38', '2022-05-26 14:46:38', 'Paknaan', 'Kamatis'),
(231, 'Request', 'Treasurer Elbertson,Jeremy has confirmed the payment for RequestID# 7', 29, '2022-05-26 14:46:45', '2022-05-26 14:46:45', 'Paknaan', 'Kamatis'),
(232, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 41', 31, '2022-05-27 18:33:19', '2022-05-27 18:33:19', 'Paknaan', 'Kamatis'),
(233, 'Barangay', 'Admin has created a new Barangay: test', 27, '2022-05-27 20:29:32', '2022-05-27 20:29:32', NULL, NULL),
(234, 'Barangay', 'Admin has assigned 29 as the new Captain for Paknaan', 27, '2022-05-27 20:32:12', '2022-05-27 20:32:12', NULL, NULL),
(235, 'Barangay', 'Admin has assigned Xavier Johnson as the new Captain for Paknaan', 27, '2022-05-27 20:35:26', '2022-05-27 20:35:26', NULL, NULL),
(236, 'Barangay', 'Admin has assigned Jeremy Elbertson as the new Captain for Paknaan', 27, '2022-05-27 20:36:37', '2022-05-27 20:36:37', NULL, NULL),
(237, 'Account', 'Captain  has added a new Resident', 29, '2022-05-27 21:20:54', '2022-05-27 21:20:54', 'Paknaan', 'Kamatis'),
(238, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#48', 31, '2022-05-28 03:00:42', '2022-05-28 03:00:42', 'Paknaan', 'Kamatis'),
(239, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-05-28 03:11:12', '2022-05-28 03:11:12', 'Paknaan', 'Kamatis'),
(240, 'eReklamo', 'Captain has entered a new reklamo category type: Residents', 29, '2022-05-28 03:12:09', '2022-05-28 03:12:09', 'Paknaan', 'Kamatis'),
(241, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-05-28 03:12:21', '2022-05-28 03:12:21', 'Paknaan', 'Kamatis'),
(242, 'eReklamo', 'Captain has entered a new reklamo type for category type: Residents', 29, '2022-05-28 03:12:28', '2022-05-28 03:12:28', 'Paknaan', 'Kamatis'),
(243, 'Request', 'Purok Leader has disapproved request#45 for not meeting the requirements.', 31, '2022-05-28 19:20:29', '2022-05-28 19:20:29', 'Paknaan', 'Kamatis'),
(244, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 43', 31, '2022-05-28 19:24:41', '2022-05-28 19:24:41', 'Paknaan', 'Kamatis'),
(245, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 47', 31, '2022-05-28 19:24:46', '2022-05-28 19:24:46', 'Paknaan', 'Kamatis'),
(246, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 42', 31, '2022-05-28 19:24:52', '2022-05-28 19:24:52', 'Paknaan', 'Kamatis'),
(247, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 26', 37, '2022-05-28 19:25:18', '2022-05-28 19:25:18', 'Paknaan', 'Kamatis'),
(248, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 34', 37, '2022-05-28 19:25:28', '2022-05-28 19:25:28', 'Paknaan', 'Kamatis'),
(249, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 41', 37, '2022-05-28 20:04:43', '2022-05-28 20:04:43', 'Paknaan', 'Kamatis'),
(250, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 42', 37, '2022-05-28 20:06:12', '2022-05-28 20:06:12', 'Paknaan', 'Kamatis'),
(251, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 36', 37, '2022-05-28 20:07:03', '2022-05-28 20:07:03', 'Paknaan', 'Kamatis'),
(252, 'Request', 'Treasurer Ville,Jackson has confirmed the payment for RequestID# 43', 37, '2022-05-28 20:09:43', '2022-05-28 20:09:43', 'Paknaan', 'Kamatis'),
(253, 'Request', 'Treasurer Ville,Jackson has cancelled the payment for RequestID#47', 37, '2022-05-28 20:10:01', '2022-05-28 20:10:01', 'Paknaan', 'Kamatis'),
(254, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 48', 31, '2022-05-28 20:10:51', '2022-05-28 20:10:51', 'Paknaan', 'Kamatis'),
(255, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 46', 31, '2022-05-28 20:10:54', '2022-05-28 20:10:54', 'Paknaan', 'Kamatis'),
(256, 'Request', 'Purok Leader Leader,Purok has approved the RequestID # 44', 31, '2022-05-28 20:10:58', '2022-05-28 20:10:58', 'Paknaan', 'Kamatis'),
(257, 'eReklamo', 'Captain has entered a new reklamo category type: Test', 29, '2022-06-02 20:16:38', '2022-06-02 20:16:38', 'Paknaan', 'Kamatis'),
(258, 'eReklamo', 'Captain has entered a new reklamo category type: test', 29, '2022-06-02 20:18:57', '2022-06-02 20:18:57', 'Paknaan', 'Kamatis'),
(259, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-06-02 20:19:01', '2022-06-02 20:19:01', 'Paknaan', 'Kamatis'),
(260, 'eReklamo', 'Captain has entered a new reklamo type for category type: Test', 29, '2022-06-02 20:20:31', '2022-06-02 20:20:31', 'Paknaan', 'Kamatis'),
(261, 'eReklamo', 'Captain has deleted the reklamo type #', 29, '2022-06-02 20:20:35', '2022-06-02 20:20:35', 'Paknaan', 'Kamatis');

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
  `userType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `requesturl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `documentType`, `purpose`, `requestedOn`, `approvedOn`, `approvedBy`, `amount`, `status`, `userBarangay`, `userPurok`, `userType`, `UsersID`, `requesturl`) VALUES
(21, 'Barangay Clearance', 'Employment', '2022-03-28 15:21:47', '2022-03-28 16:21:58', 'Handson, Roxy', 50, 'Released', 'Paknaan', 'Kamatis', 'Secretary', 28, ''),
(22, 'Cedula', 'Employment', '2022-03-28 16:16:12', '2022-03-28 16:27:44', 'Handson, Roxy', 20, 'Released', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/9647c47bb7a82b4798cc7cafddfc7bd1'),
(23, 'Cedula', 'Employment', '2022-03-28 16:31:39', '2022-03-28 17:06:50', 'Ville, Jackson', 20, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/53a59cfd1e256b4064170e8c9cf222a0'),
(24, 'Barangay Clearance', 'Employment', '2022-03-29 07:31:09', '2022-03-29 07:57:02', 'Ville, Jackson', 50, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/a65846399caff7957c8923eaed155192'),
(25, 'Cedula', 'Employment', '2022-03-29 07:36:50', '2022-03-29 07:55:07', 'Ville, Jackson', 20, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/c1dde9784e9bb636fc718b4d0da11692'),
(26, 'Cedula', 'Test', '2022-04-02 15:27:45', '2022-05-28 19:25:18', 'Ville, Jackson', 222, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/e8c0afb83105fd0641490493e3d4d10e'),
(31, 'Cedula', 'Notarization', '2022-05-12 16:23:56', '2022-05-12 16:26:50', 'Ville, Jackson', 10, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/4be479841eeb3c2fcd99ee361aef98b7'),
(32, 'Indigency Clearance', 'Ayuda', '2022-05-12 16:34:26', '2022-05-12 17:02:38', 'Handson, Roxy', 0, 'Released', 'Paknaan', 'Kamatis', 'Secretary', 28, 'None'),
(33, 'Barangay Clearance', 'Proof of Residency', '2022-05-12 17:05:19', '2022-05-12 17:14:17', 'Handson, Roxy', 125, 'Released', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/6d395aefec4a271b6911d50dd8827336'),
(34, 'Barangay Clearance', 'Proof of Residency', '2022-05-12 19:48:48', '2022-05-28 19:25:28', 'Ville, Jackson', 125, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 30, 'https://getpaid.gcash.com/checkout/1feb8a4cf689cbfe5caabdfd8bdc6489'),
(35, 'Barangay Clearance', 'Proof of Residency', '2022-05-12 21:21:14', '2022-05-12 21:49:52', 'Ville, Jackson', 125, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/859f45f5d1bc00b484c652ba0e75deaf'),
(36, 'Barangay Clearance', 'Proof of Residency', '2022-05-26 03:38:21', '2022-05-28 20:07:03', 'Ville, Jackson', 125, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/722ce4fec2b7b9a7ff01ee49c8f5d6d7'),
(41, 'Cedula', 'Notarization', '2022-05-27 03:01:15', '2022-05-28 20:04:43', 'Ville, Jackson', 10, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/553c53cbe3db824b0aeb158724e62a31'),
(42, 'Barangay Clearance', 'Proof of Residency', '2022-05-27 03:02:09', '2022-05-28 20:06:12', 'Ville, Jackson', 125, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/2848babbc1ef60956297ed5f6b2bf769'),
(43, 'Cedula', 'Notarization', '2022-05-28 03:41:59', '2022-05-28 20:09:44', 'Ville, Jackson', 5, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 28, 'https://getpaid.gcash.com/checkout/10a2a013d186bb1c18961651f831bc5e'),
(44, 'Cedula', 'Notarization', '2022-05-28 13:22:33', '2022-05-28 20:10:58', 'Leader, Purok', 10, 'Approved', 'Paknaan', 'Kamatis', 'Treasurer', 28, 'https://getpaid.gcash.com/checkout/b32ff02643697da7643ac0b79383d57e'),
(45, 'Barangay Clearance', 'Proof of Residency', '2022-05-28 13:26:12', '2022-05-28 19:20:29', 'Purok Leader', 125, 'Disapproved', 'Paknaan', 'Kamatis', 'Purok Leader', 28, 'None'),
(46, 'Barangay Clearance', 'Proof of Residency', '2022-05-28 13:26:38', '2022-05-28 20:10:54', 'Leader, Purok', 125, 'Approved', 'Paknaan', 'Kamatis', 'Treasurer', 28, 'https://getpaid.gcash.com/checkout/b3e0f405a2576e44008f568076837894'),
(47, 'Cedula', 'Notarization', '2022-05-28 13:28:50', '2022-05-28 20:10:01', 'Ville, Jackson', 5, 'Cancelled', 'Paknaan', 'Kamatis', 'Treasurer', 28, 'https://getpaid.gcash.com/checkout/6be03bbaebb52c456a6ee72c3e5e215c'),
(48, 'Cedula', 'Notarization', '2022-05-28 20:10:26', '2022-05-28 20:10:51', 'Leader, Purok', 10, 'Approved', 'Paknaan', 'Kamatis', 'Treasurer', 28, 'https://getpaid.gcash.com/checkout/40a3bce6012cb4eed13de00c4d04c16e'),
(49, 'Indigency Clearance', 'Ayuda', '2022-05-28 20:16:25', NULL, NULL, 0, 'Pending', 'Paknaan', 'Kamatis', 'Purok Leader', 31, 'None'),
(50, 'Cedula', 'Notarization', '2022-05-28 20:43:26', NULL, NULL, 10, 'Approved', 'Paknaan', 'Kamatis', 'Treasurer', 31, 'None'),
(51, 'Cedula', 'Notarization', '2022-05-28 20:50:29', NULL, NULL, 5, 'Approved', 'Paknaan', 'Kamatis', 'Treasurer', 37, 'None'),
(52, 'Cedula', 'Notarization', '2022-05-28 20:52:12', NULL, NULL, 10, 'Approved', 'Paknaan', 'Kamatis', 'Treasurer', 37, 'None'),
(53, 'Cedula', 'Notarization', '2022-06-01 13:22:22', NULL, NULL, 10, 'Pending', 'Paknaan', 'Kamatis', 'Purok Leader', 28, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `requirementlist`
--

CREATE TABLE `requirementlist` (
  `requirementID` int NOT NULL,
  `requirementName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DocumentID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requirementlist`
--

INSERT INTO `requirementlist` (`requirementID`, `requirementName`, `DocumentID`) VALUES
(3, 'Valid ID', 2),
(4, 'Photocopy of Lot Title', 13);

-- --------------------------------------------------------

--
-- Table structure for table `residentcategory`
--

CREATE TABLE `residentcategory` (
  `residentCatID` int NOT NULL,
  `residentCatName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Barangay` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Purok` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `ResidentID` int NOT NULL,
  `Firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Middlename` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dateofbirth` datetime NOT NULL,
  `civilStat` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `dateResiding` datetime NOT NULL,
  `Voter` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Lessee` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `BarangayID` int NOT NULL,
  `PurokID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`ResidentID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `dateResiding`, `Voter`, `Lessee`, `BarangayID`, `PurokID`) VALUES
(1, 'qweqw', 'edsad', 'adqw', '2000-08-10 00:00:00', 'Single', '2000-01-07 00:00:00', 'True', 'False', 2, 1),
(2, 'yyyy', 'uuuu', 'iiii', '2018-02-12 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'True', 2, 1),
(3, 'oiqjwoqj', 'aidjoaidsjoa', 'qwijeqowijeo', '2000-01-01 00:00:00', 'Single', '2000-01-07 00:00:00', 'True', 'False', 2, 1),
(4, 'asfas', 'fasf', 'asfasf', '2022-05-19 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(5, 'Test', 'Test', 'Test', '2000-01-01 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(6, 'Mr', 'Con', 'Struction', '1999-02-20 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(7, 'Mr', 'Plum', 'Plumber', '2013-02-22 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(8, 'Jackson', 'Me', 'Ville', '2011-11-11 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(9, 'Woshua', 'Etch', 'Torts', '2017-11-25 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(10, 'Purok', 'Leader', 'Leader', '1987-11-11 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(11, 'Roxy', 'Tabby', 'Handson', '1991-02-01 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(12, 'Jeremy', 'Psycho', 'Elbertson', '1981-08-23 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(13, 'Xavier', 'Noez', 'Johnson', '2000-08-01 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 2, 1),
(14, 'qweqw', 'qweq', 'weqweqw', '2022-05-11 00:00:00', 'Married', '2000-01-07 00:00:00', 'False', 'False', 3, 3),
(15, 'aqweqwe', 'qdqw', 'dasdasd', '2022-05-25 00:00:00', 'Single', '2000-01-07 00:00:00', 'False', 'False', 3, 3),
(16, 'TEst', 'test', 'test', '2022-05-09 00:00:00', 'Married', '2000-01-07 00:00:00', 'False', 'False', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int NOT NULL,
  `scheduleDate` date DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `complainee` int DEFAULT NULL,
  `forAll` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'False',
  `scheduleTitle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ereklamoID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `scheduleDate`, `UsersID`, `complainee`, `forAll`, `scheduleTitle`, `ereklamoID`) VALUES
(1, '2022-05-05', 0, NULL, 'True', 'Test', 0),
(7, '2022-06-01', 28, 41, 'False', 'ereklamo#41', 41);

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
  `landlordName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'None',
  `landlordContact` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'NONE',
  `barangayPos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'None',
  `userAddress` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userHouseNum` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsLandlord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False',
  `isRenting` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False',
  `startedLiving` date DEFAULT NULL,
  `userSuffix` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretQuestion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretAnswer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsVoter` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `emailAdd`, `username`, `usersPwd`, `userGender`, `userType`, `profile_pic`, `userBarangay`, `userPurok`, `phoneNum`, `teleNum`, `VerifyStatus`, `userCity`, `Status`, `landlordName`, `landlordContact`, `barangayPos`, `userAddress`, `userHouseNum`, `IsLandlord`, `isRenting`, `startedLiving`, `userSuffix`, `secretQuestion`, `secretAnswer`, `IsVoter`) VALUES
(27, 'Craige Jonard', 'Noel', 'Baring', '2000-01-08', 'Single', 'craigejonard@gmail.com', 'admin', '$2y$10$UEq1Wgm7o57pp1kueghFh.rcR3C4OLo3fDV8YPV6Rln17VMV9Cxh2', 'Male', 'Admin', 'profile_picture.jpg', NULL, NULL, NULL, NULL, 'Verified', '', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '001', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(28, 'Xavier', 'Noez', 'Johnson', '2000-08-01', 'Single', 'xavier.johnson@gmail.com', 'resident1', '$2y$10$DcyVYXqRr6kf.R03tKa/1.0Vykumm2agobub3e217NP6wd/uG6Z7e', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Verified', '', 'Active', 'None', 'NONE', 'None', NULL, '002', 'False', 'False', '2000-01-07', '', 'What\'s the name of the school you first went to?', 'qwe', 'False'),
(29, 'Jeremy', 'Psycho', 'Elbertson', '1981-08-23', 'Single', 'jeremyelbertson@gmail.com', 'captain1', '$2y$10$wgirG5En9HiHhhtVzR50E.xdr2RunZl/L5QHs1AnwDfMu.9L7QT9G', 'Male', 'Captain', '1651569480_41qrwg4zxqv81.png', 'Paknaan', 'Kamatis', '09888888', NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '003', 'False', 'False', '2000-01-07', '', NULL, NULL, 'False'),
(30, 'Roxy', 'Tabby', 'Handson', '1991-02-01', 'Single', 'handson.tabby@gmail.com', 'secretary1', '$2y$10$7MPFKH3XG/uUamFPUQJnyuIfwpkmhl31F7Owu7A4mXHJW.HceFUBq', 'Female', 'Secretary', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '004', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(31, 'Purok', 'Leader', 'Leader', '1987-11-11', 'Single', 'purokleader@gmail.com', 'purokLeader1', '$2y$10$GXZUfl.RHuhPT9OHoRL.sOiI9keF1TAy178G79p12h1/M9SRGd0pW', 'Male', 'Purok Leader', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '005', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(32, 'Resident', 'User', 'User', '2020-02-12', 'Single', 'resident@gmail.com', 'resident2', '$2y$10$oua0FAN7GbEUsSuGAfwrEO4bzUdTLgEt5atpy549A0uMhexXUV6OO', 'Male', 'Resident', 'profile_picture.jpg', 'Pajo', 'Kamanggahan', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Quezon National Highway', '2154', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(34, 'Woshua', 'Etch', 'Torts', '2017-11-25', 'Single', 'woshua@gmail.com', 'tanodResident', '$2y$10$r1tpz1YRzITj1SYgiq99Re2573PkqyytJkonuaAwCb/kNo46ceI.W', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'Tanod', 'Plaridel Street', '006', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(37, 'Jackson', 'Me', 'Ville', '2011-11-11', 'Single', 'treasurer@gmail.com', 'treasurer1', '$2y$10$4afrff9nv2rPHjPwgBwUw.4Uf8OIVYwSlzJibdqElFU4fag3R/.we', 'Male', 'Treasurer', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, 'N/A', 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '007', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(39, 'Mr', 'Plum', 'Plumber', '2013-02-22', 'Single', 'plumber@gmail.com', 'plumberResident', '$2y$10$88iJPGIsWukfR3BdiQPcYeCF/BTDogUL8ulVD7RQ8blCQzWTuwCqq', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'National Highway ', '231', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(40, 'Mr', 'Con', 'Struction', '1999-02-20', 'Single', 'construction@gmail.com', 'constructionResident', '$2y$10$OfQqSRF.nA7JA9UDwXpbee2r9.KHb9/lUW0jW2qnf/ki7/4nBxLeq', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', 'Plaridel St.', '2414', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False'),
(54, 'Yasmin', 'Awer', 'Fisher', '2013-01-07', 'Single', 'qoidoajd@gmail.com', 'councilor1', '$2y$10$I.dFzFM6CSA0czScwNa6x.VERcxvs4RUCQ5r0BKtNF4c5Msp0RMYe', 'Female', 'Councilor', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '231', 'False', 'False', '2000-01-07', NULL, 'What is your mother\'s maiden name?', 'Test', 'False'),
(55, 'Isidro', 'Nidhogg', 'Nitzsche', '2016-01-13', 'Single', 'aosdjasfa@gmail.com', 'councilor2', '$2y$10$5CZU58IIllsB5tAntntoGOIXRs0uQI/U373rjOXdcOWtbHvnSfWHe', 'Male', 'Councilor', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '23', 'False', 'False', '2000-01-07', NULL, 'What is your mother\'s maiden name?', 'Test', 'False'),
(56, 'Kian', 'Schwit', 'Von', '2007-01-09', 'Single', 'aosijdo@gmail.com', 'councilor3', '$2y$10$hu5VlmOzwMBXuID0duSB7ONu2x37JQsb8GO11HRsf9jc32WWQ.Ska', 'Male', 'Councilor', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '784', 'False', 'False', '2000-01-07', NULL, 'What is your mother\'s maiden name?', 'Test', 'False'),
(57, 'Samson', 'Poer', 'Ritchie', '2001-02-06', 'Single', 'anzxmasd@gmail.com', 'councilor4', '$2y$10$Q.AEENJYxJ5F35sB7ILD9O/aWc3EktqVBCH8mgZZBLZ89Fv2PKNXS', 'Male', 'Councilor', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '23', 'False', 'False', '2000-01-07', NULL, 'What is your mother\'s maiden name?', 'Test', 'False'),
(58, 'Ralph', 'Wex', 'Roob', '2003-01-06', 'Single', 'anbckjzxnc@gmail.com', 'councilor5', '$2y$10$lk0mqswvVGePDgVk9Xi9AeNQy4OcsxFDIanWYbcjdsUACsnn8.Jxa', 'Male', 'Councilor', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '156', 'False', 'False', '2000-01-07', NULL, 'What is your first pet\'s name?', 'Test', 'False'),
(59, 'Hildr', 'Ryjr', 'Adelajda', '2008-06-01', 'Single', 'asmozkm@gmail.com', 'councilor6', '$2y$10$sGuxf7hKot1lg/xxPmiWLezVSP11YKhqWsgIKwfsU6nK629szChCq', 'Male', 'Councilor', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '123', 'False', 'False', '2000-01-07', NULL, 'What is your mother\'s maiden name?', 'Test', 'False'),
(60, 'Maria-Angeen', 'Ester', 'Coreen', '2003-01-21', 'Single', 'xcvlkkj@gmail.com', 'councilor7', '$2y$10$XhpGN5tTf6BO3P3yp4SDW.HupNGLBWnmabg3i/zOJgaRVmhfPT1w6', 'Female', 'Councilor', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'None', 'NONE', 'None', NULL, '765', 'False', 'False', '2000-01-07', NULL, 'What is your mother\'s maiden name?', 'Test', 'False');

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
(0, 33, 28, '2022-05-28 22:51:35', '2022-05-28 22:51:35', 'Purok Leader', 21),
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
-- Indexes for table `barangaylupon`
--
ALTER TABLE `barangaylupon`
  ADD PRIMARY KEY (`luponMemberID`),
  ADD KEY `UsersID` (`UsersID`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidateID`),
  ADD KEY `UsersID` (`UsersID`),
  ADD KEY `electionID` (`electionID`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatID`),
  ADD KEY `UsersID` (`UsersID`),
  ADD KEY `chatroomID` (`chatroomID`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`chatroomID`);

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
  ADD PRIMARY KEY (`purposeID`),
  ADD KEY `barangayDoc` (`barangayDoc`);

--
-- Indexes for table `documenttype`
--
ALTER TABLE `documenttype`
  ADD PRIMARY KEY (`DocumentID`);

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
-- Indexes for table `ereklamoreport`
--
ALTER TABLE `ereklamoreport`
  ADD PRIMARY KEY (`ereportID`),
  ADD KEY `ReklamoID` (`ReklamoID`),
  ADD KEY `respondentID` (`respondentID`);

--
-- Indexes for table `ereklamotype`
--
ALTER TABLE `ereklamotype`
  ADD PRIMARY KEY (`reklamoTypeID`),
  ADD KEY `reklamoCatID` (`reklamoCatID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`membersID`),
  ADD KEY `residentCatID` (`residentCatID`),
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
-- Indexes for table `requirementlist`
--
ALTER TABLE `requirementlist`
  ADD PRIMARY KEY (`requirementID`),
  ADD KEY `DocumentID` (`DocumentID`);

--
-- Indexes for table `residentcategory`
--
ALTER TABLE `residentcategory`
  ADD PRIMARY KEY (`residentCatID`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`ResidentID`),
  ADD KEY `BarangayID` (`BarangayID`),
  ADD KEY `PurokID` (`PurokID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
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
  MODIFY `BarangayID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barangaylupon`
--
ALTER TABLE `barangaylupon`
  MODIFY `luponMemberID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidateID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `chatroomID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documentpurpose`
--
ALTER TABLE `documentpurpose`
  MODIFY `purposeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `documenttype`
--
ALTER TABLE `documenttype`
  MODIFY `DocumentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ereklamo`
--
ALTER TABLE `ereklamo`
  MODIFY `ReklamoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ereklamocategory`
--
ALTER TABLE `ereklamocategory`
  MODIFY `reklamoCatID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ereklamoreport`
--
ALTER TABLE `ereklamoreport`
  MODIFY `ereportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `ereklamotype`
--
ALTER TABLE `ereklamotype`
  MODIFY `reklamoTypeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `membersID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `PurokID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `requirementlist`
--
ALTER TABLE `requirementlist`
  MODIFY `requirementID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `residentcategory`
--
ALTER TABLE `residentcategory`
  MODIFY `residentCatID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `ResidentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangaylupon`
--
ALTER TABLE `barangaylupon`
  ADD CONSTRAINT `barangaylupon_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`);

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`chatroomID`) REFERENCES `chatroom` (`chatroomID`) ON DELETE CASCADE;

--
-- Constraints for table `documentpurpose`
--
ALTER TABLE `documentpurpose`
  ADD CONSTRAINT `documentpurpose_ibfk_1` FOREIGN KEY (`barangayDoc`) REFERENCES `documenttype` (`DocumentID`);

--
-- Constraints for table `ereklamoreport`
--
ALTER TABLE `ereklamoreport`
  ADD CONSTRAINT `ereklamoreport_ibfk_1` FOREIGN KEY (`ReklamoID`) REFERENCES `ereklamo` (`ReklamoID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ereklamoreport_ibfk_2` FOREIGN KEY (`respondentID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE;

--
-- Constraints for table `ereklamotype`
--
ALTER TABLE `ereklamotype`
  ADD CONSTRAINT `ereklamotype_ibfk_1` FOREIGN KEY (`reklamoCatID`) REFERENCES `ereklamocategory` (`reklamoCatID`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`residentCatID`) REFERENCES `residentcategory` (`residentCatID`) ON DELETE CASCADE,
  ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE;

--
-- Constraints for table `requirementlist`
--
ALTER TABLE `requirementlist`
  ADD CONSTRAINT `requirementlist_ibfk_1` FOREIGN KEY (`DocumentID`) REFERENCES `documenttype` (`DocumentID`) ON DELETE CASCADE;

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_ibfk_1` FOREIGN KEY (`BarangayID`) REFERENCES `barangay` (`BarangayID`) ON DELETE CASCADE,
  ADD CONSTRAINT `residents_ibfk_2` FOREIGN KEY (`PurokID`) REFERENCES `purok` (`PurokID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
