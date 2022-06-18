-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 04:18 AM
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
(13, 'Paknaan', 'Mandaue', 93, 'Cebu', '1655365140_Barangay.png', NULL, NULL, NULL, 'Active'),
(14, 'Bakilid', 'Mandaue', 109, 'Cebu', 'brgy_default.png', NULL, NULL, NULL, 'Active');

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
  `position` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidateID`, `lastname`, `firstname`, `created_at`, `updated_at`, `platform`, `purok`, `UsersID`, `electionID`, `position`, `status`) VALUES
(1, 'Wows', 'Yolo', '2022-06-16 02:47:33', '2022-06-16 02:47:33', 'test1', 'Kamatis', 110, 31, 'Purok Leader', 'Accepted'),
(2, 'Resident', 'Resident', '2022-06-16 02:47:47', '2022-06-16 02:47:47', '', 'Kamatis', 94, 31, 'Purok Leader', 'Pending'),
(3, 'Savior', 'Sakura', '2022-06-16 02:50:13', '2022-06-16 02:50:13', '', 'Kamatis', 111, 31, 'Purok Leader', 'Accepted'),
(4, 'Rex', 'Samurai', '2022-06-16 02:50:28', '2022-06-16 02:50:28', '', 'Kamatis', 112, 31, 'Purok Leader', 'Declined'),
(5, 'Resident', 'Resident', '2022-06-16 09:40:04', '2022-06-16 09:40:04', 'Test', 'Kamatis', 94, 32, 'Purok Leader', 'Accepted');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatID`, `UsersID`, `chatroomID`, `message`, `mesgdate`, `status`) VALUES
(1, 110, 27, 'cchbdfg', '2022-06-15 23:51:43', 'Not Read'),
(2, 100, 27, 'test', '2022-06-15 23:51:59', 'Not Read');

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `chatroomID` int NOT NULL,
  `roomName` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `idreference` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`chatroomID`, `roomName`, `type`, `idreference`) VALUES
(27, 'ereklamo#56', 'ereklamo', 56);

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
(5, 'VECO', '354-45687', 13);

-- --------------------------------------------------------

--
-- Table structure for table `documentpurpose`
--

CREATE TABLE `documentpurpose` (
  `purposeID` int NOT NULL,
  `purpose` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `barangay` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `barangayDoc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentpurpose`
--

INSERT INTO `documentpurpose` (`purposeID`, `purpose`, `barangay`, `barangayDoc`) VALUES
(7, 'Scholarship', 'Paknaan', 26),
(8, 'Employment', 'Paknaan', 26);

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
  `requireLessorNote` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documenttype`
--

INSERT INTO `documenttype` (`DocumentID`, `documentName`, `barangayName`, `documentDesc`, `allowFee`, `docPrice`, `VoterRequired`, `minimumMos`, `allowLessee`, `requireLessorNote`, `status`) VALUES
(26, 'Barangay Clearance', 'Paknaan', '', 'True', 100, 'True', 0, 'False', 'False', 'Active'),
(27, 'Test', 'Paknaan', '', 'True', 1, 'True', 0, 'False', 'False', 'Inactive');

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
(31, 'Purok Leader - Kamatis', 'Finished', '93', '2022-06-16 02:47:05', '2022-06-16 02:47:05', 'Paknaan', 'Kamatis'),
(32, 'Test', 'Paused', '93', '2022-06-16 09:39:54', '2022-06-16 09:39:54', 'Paknaan', 'Kamatis');

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
  `paymenturl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `councilorID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamo`
--

INSERT INTO `ereklamo` (`ReklamoID`, `reklamoType`, `detail`, `status`, `CreatedOn`, `UpdatedOn`, `comment`, `checkedBy`, `checkedOn`, `complaintLevel`, `complainee`, `scheduledSummon`, `UsersID`, `barangay`, `purok`, `rescheduleCounter`, `reklamoFee`, `paymenturl`, `councilorID`) VALUES
(56, 'Garbage', 'Improper disposal', 'Resolved', '2022-06-15 23:50:45', '2022-06-15 23:50:45', 'cchbdfg', 'Purok Leader', '2022-06-16 01:01:43', 'Minor', 102, NULL, 110, 'Paknaan', 'Kamatis', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ereklamocategory`
--

CREATE TABLE `ereklamocategory` (
  `reklamoCatID` int NOT NULL,
  `reklamoCatName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reklamoCatBrgy` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reklamoFee` int NOT NULL DEFAULT '0',
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `reklamoCatPriority` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Minor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamocategory`
--

INSERT INTO `ereklamocategory` (`reklamoCatID`, `reklamoCatName`, `reklamoCatBrgy`, `reklamoFee`, `status`, `reklamoCatPriority`) VALUES
(18, 'Garbage', 'Paknaan', 0, 'Active', 'Minor');

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
  `reportStatus` varchar(20) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ereklamoreport`
--

INSERT INTO `ereklamoreport` (`ereportID`, `ReklamoID`, `respondentID`, `reportMessage`, `date`, `reportStatus`, `barangay`, `purok`) VALUES
(88, 56, 100, 'resolced', '2022-06-16 01:01:43', 'Resolved', 'Paknaan', 'Kamatis');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamotype`
--

CREATE TABLE `ereklamotype` (
  `reklamoTypeID` int NOT NULL,
  `reklamoTypeName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reklamoCatID` int NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ereklamotype`
--

INSERT INTO `ereklamotype` (`reklamoTypeID`, `reklamoTypeName`, `reklamoCatID`, `status`) VALUES
(20, 'Improper disposal', 18, 'Active');

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
(422, 'Your account verification has been approved!', 'Resident', 'Read', 94, NULL, '2022-06-15 09:39:11', '2022-06-15 09:39:11'),
(423, 'Your account verification has been denied!', 'Resident', 'Not Read', 0, NULL, '2022-06-15 23:13:54', '2022-06-15 23:13:54'),
(424, 'Your account verification has been approved!', 'Resident', 'Read', 111, NULL, '2022-06-15 23:23:00', '2022-06-15 23:23:00'),
(425, 'Your account verification has been approved!', 'Resident', 'Read', 112, NULL, '2022-06-15 23:27:12', '2022-06-15 23:27:12'),
(426, 'Your account verification has been approved!', 'Resident', 'Read', 110, NULL, '2022-06-15 23:27:18', '2022-06-15 23:27:18'),
(427, 'A new request is ready for payment', 'request', 'Not Read', NULL, 'Treasurer', '2022-06-15 23:28:11', '2022-06-15 23:28:11'),
(428, 'A resident has requested a Barangay Clearance', 'request', 'Not Read', NULL, 'Purok Leader', '2022-06-15 23:50:32', '2022-06-15 23:50:32'),
(429, 'Resident Wows, Yolo has sent a minor reklamo!', 'ereklamo', 'Not Read', NULL, 'Purok Leader', '2022-06-15 23:50:46', '2022-06-15 23:50:46'),
(430, 'Your eReklamo#56 is now being processed by Purok.', 'ereklamo', 'Read', 110, 'Resident', '2022-06-15 23:51:43', '2022-06-15 23:51:43'),
(431, 'The purok leader has disapproved your request for Barangay Clearance. Reason: invalid', 'request', 'Read', 110, 'Resident', '2022-06-16 00:38:28', '2022-06-16 00:38:28'),
(432, 'Purok Leader has resolved your ereklamo#56', 'ereklamo', 'Read', 110, 'Resident', '2022-06-16 01:01:43', '2022-06-16 01:01:43'),
(433, 'A new request is ready for release!', 'request', 'Not Read', NULL, 'Secretary', '2022-06-16 01:58:08', '2022-06-16 01:58:08'),
(434, 'Your Barangay Clearance is now ready for release! Please claim it at the barangay hall.', 'request', 'Read', 100, 'Resident', '2022-06-16 01:58:08', '2022-06-16 01:58:08'),
(435, 'You have been nominated to run as Purok Leader by your Captain! Please click here to accept or decline the nomination!', 'nomination', 'Read', 110, 'Resident', '2022-06-16 02:47:33', '2022-06-16 02:47:33'),
(436, 'You have been nominated to run as Purok Leader by your Captain! Please click here to accept or decline the nomination!', 'nomination', 'Read', 94, 'Resident', '2022-06-16 02:47:47', '2022-06-16 02:47:47'),
(437, 'You have been nominated to run as Purok Leader by your Captain! Please click here to accept or decline the nomination!', 'nomination', 'Read', 111, 'Resident', '2022-06-16 02:50:13', '2022-06-16 02:50:13'),
(438, 'You have been nominated to run as Purok Leader by your Captain! Please click here to accept or decline the nomination!', 'nomination', 'Read', 112, 'Resident', '2022-06-16 02:50:28', '2022-06-16 02:50:28'),
(439, 'Your account verification has been denied!', 'Resident', 'Not Read', 0, NULL, '2022-06-16 09:26:08', '2022-06-16 09:26:08'),
(440, 'Your account verification has been approved!', 'Resident', 'Read', 118, NULL, '2022-06-16 09:27:32', '2022-06-16 09:27:32'),
(441, 'A resident has requested a Barangay Clearance', 'request', 'Not Read', NULL, 'Purok Leader', '2022-06-16 09:29:51', '2022-06-16 09:29:51'),
(442, 'The purok leader has disapproved your request for Barangay Clearance. Reason: Invalid requirements', 'request', 'Read', 118, 'Resident', '2022-06-16 09:31:24', '2022-06-16 09:31:24'),
(443, 'You have been nominated to run as Purok Leader by your Captain! Please click here to accept or decline the nomination!', 'nomination', 'Read', 94, 'Resident', '2022-06-16 09:40:04', '2022-06-16 09:40:04');

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
(79, 93, 'captain1', 'Captain', 'Vaccinations are now open!! ', '2022-06-15 17:41:01', 'Paknaan');

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
(29, 'Kamatis', 'Paknaan', 'True', 100),
(37, 'Chippy', 'Bakilid', 'True', 113),
(42, 'Piattos', 'Bakilid', 'True', NULL),
(44, 'Sili', 'Paknaan', 'True', NULL);

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
(322, 'Barangay', 'Admin has created a new Barangay: Paknaan', 27, '2022-06-15 01:34:38', '2022-06-15 01:34:38', NULL, NULL),
(323, 'Barangay', 'Barangay has updated Barangay Paknaan', 27, '2022-06-15 01:34:49', '2022-06-15 01:34:49', NULL, NULL),
(324, 'eReklamo', 'Captain has entered a new reklamo category type: Garbage', 93, '2022-06-15 15:47:05', '2022-06-15 15:47:05', 'Paknaan', 'Kamatis'),
(325, 'eReklamo', 'Captain has entered a new reklamo type for category type: Garbage', 93, '2022-06-15 15:47:23', '2022-06-15 15:47:23', 'Paknaan', 'Kamatis'),
(326, 'Barangay', 'Admin has created a new Barangay: Bakilid', 27, '2022-06-15 22:30:10', '2022-06-15 22:30:10', NULL, NULL),
(327, 'Barangay', 'Admin has assigned Jeremy Elberson as the new Captain for Paknaan', 27, '2022-06-15 22:57:10', '2022-06-15 22:57:10', NULL, NULL),
(328, 'Barangay', 'Admin has assigned Captain Bakilid as the new Captain for Bakilid', 27, '2022-06-15 23:03:40', '2022-06-15 23:03:40', NULL, NULL),
(329, 'eReklamo', 'Purok Leader Purok has accepted ereklamo#56', 100, '2022-06-15 23:51:43', '2022-06-15 23:51:43', 'Paknaan', 'Kamatis');

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
(58, 'Barangay Clearance', 'Scholarship', '2022-06-15 23:28:11', '2022-06-16 01:58:08', 'Treasurer, Treasurer', 100, 'Paid', 'Paknaan', 'Kamatis', 'Secretary', 100, 'None'),
(59, 'Barangay Clearance', 'Employment', '2022-06-15 23:50:33', '2022-06-16 00:38:27', 'Purok Leader', 100, 'Disapproved', 'Paknaan', 'Kamatis', 'Purok Leader', 110, 'None'),
(60, 'Barangay Clearance', 'Scholarship', '2022-06-16 09:29:51', '2022-06-16 09:31:24', 'Purok Leader', 100, 'Disapproved', 'Paknaan', 'Kamatis', 'Purok Leader', 118, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `requestreport`
--

CREATE TABLE `requestreport` (
  `requestreportID` int NOT NULL,
  `RequestID` int NOT NULL,
  `officerID` int NOT NULL,
  `reportMessage` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `reportStatus` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barangay` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `purok` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestreport`
--

INSERT INTO `requestreport` (`requestreportID`, `RequestID`, `officerID`, `reportMessage`, `reportStatus`, `amount`, `date`, `barangay`, `purok`) VALUES
(38, 59, 100, 'invalid', 'Disapproved', 100, '2022-06-16 00:38:27', 'Paknaan', 'Kamatis'),
(39, 58, 101, 'Treasurer Treasurer,Treasurer has confirmed the payment for RequestID# 58', 'Paid', 100, '2022-06-16 01:58:08', '', ''),
(40, 60, 100, 'Invalid requirements', 'Disapproved', 100, '2022-06-16 09:31:24', 'Paknaan', 'Kamatis');

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
(9, 'Valid ID', 26);

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
(1, '2021-02-09', 27, NULL, 'True', 'Test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userreport`
--

CREATE TABLE `userreport` (
  `userreportID` int NOT NULL,
  `UsersID` int NOT NULL,
  `OfficerID` int NOT NULL,
  `reportMessage` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `reportStatus` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `barangay` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `purok` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userreport`
--

INSERT INTO `userreport` (`userreportID`, `UsersID`, `OfficerID`, `reportMessage`, `reportStatus`, `date`, `barangay`, `purok`) VALUES
(1, 94, 93, 'Purok Leader has verified this account.', 'Verify', '2022-06-15 09:39:11', 'Paknaan', 'Kamatis'),
(2, 97, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 09:47:45', 'Paknaan', 'Kamatis'),
(3, 98, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 10:25:48', 'Paknaan', 'Kamatis'),
(4, 99, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 10:32:28', 'Paknaan', 'Kamatis'),
(5, 100, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 15:54:48', 'Paknaan', 'Kamatis'),
(6, 101, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:16:07', 'Paknaan', 'Kamatis'),
(7, 102, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:24:20', 'Paknaan', 'Kamatis'),
(8, 103, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:29:46', 'Paknaan', 'Kamatis'),
(9, 104, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:32:53', 'Paknaan', 'Kamatis'),
(10, 105, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:35:26', 'Paknaan', 'Kamatis'),
(11, 106, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:37:45', 'Paknaan', 'Kamatis'),
(12, 107, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:40:11', 'Paknaan', 'Kamatis'),
(13, 108, 93, 'Captain has added a new Resident', 'Add', '2022-06-15 20:42:36', 'Paknaan', 'Kamatis'),
(14, 112, 100, 'wrong requirements', 'Unverify', '2022-06-15 23:13:54', 'Paknaan', 'Kamatis'),
(15, 111, 93, 'Purok Leader has verified this account.', 'Verify', '2022-06-15 23:23:00', 'Paknaan', 'Kamatis'),
(16, 112, 100, 'Purok Leader has verified this account.', 'Verify', '2022-06-15 23:27:12', 'Paknaan', 'Kamatis'),
(17, 110, 100, 'Purok Leader has verified this account.', 'Verify', '2022-06-15 23:27:18', 'Paknaan', 'Kamatis'),
(18, 113, 109, 'Captain has added a new Resident', 'Add', '2022-06-16 09:09:48', 'Bakilid', 'Chippy'),
(19, 114, 109, 'Captain has added a new Resident', 'Add', '2022-06-16 09:12:02', 'Bakilid', 'Chippy'),
(20, 115, 109, 'Captain has added a new Resident', 'Add', '2022-06-16 09:15:08', 'Bakilid', 'Chippy'),
(21, 118, 93, 'Invalid requirements, please resend your requirements.', 'Unverify', '2022-06-16 09:26:08', 'Paknaan', 'Kamatis'),
(22, 118, 100, 'Purok Leader has verified this account.', 'Verify', '2022-06-16 09:27:32', 'Paknaan', 'Kamatis');

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
  `IsVoter` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False',
  `councilorRole` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `emailAdd`, `username`, `usersPwd`, `userGender`, `userType`, `profile_pic`, `userBarangay`, `userPurok`, `phoneNum`, `teleNum`, `VerifyStatus`, `userCity`, `Status`, `landlordName`, `landlordContact`, `barangayPos`, `userAddress`, `userHouseNum`, `IsLandlord`, `isRenting`, `startedLiving`, `userSuffix`, `secretQuestion`, `secretAnswer`, `IsVoter`, `councilorRole`, `created_on`, `updated_on`) VALUES
(27, 'Craige Jonard', 'Noel', 'Baring', '2000-01-08', 'Single', 'craigejonard@gmail.com', 'admin', '$2y$10$UEq1Wgm7o57pp1kueghFh.rcR3C4OLo3fDV8YPV6Rln17VMV9Cxh2', 'Male', 'Admin', '1655227980_1653529200_20220524_202416.png.jpg', NULL, NULL, NULL, NULL, 'Verified', '', 'Active', 'None', 'NONE', 'None', 'Plaridel Street', '001', 'False', 'False', '2000-01-07', NULL, NULL, NULL, 'False', NULL, '2022-06-12 04:31:46', '2022-06-12 04:35:34'),
(93, 'Jeremy', 'Psycho', 'Elberson', '2022-06-06', 'Single', 'asodajsdio@gmail.com', 'captain1', '$2y$10$bOhm4DMvi2radMtgu7N8ROzUBEKKrGGmoQEfY6B4dkCFB0gsbjLy6', 'Male', 'Captain', '1655303100_1653575520_RobloxScreenShot20220318_181126843.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', '', '123', 'False', 'False', '2012-06-14', NULL, NULL, NULL, 'True', NULL, '2022-06-15 02:23:51', '2022-06-15 02:23:51'),
(94, 'Resident', 'Resident', 'Resident', '1987-02-18', 'Single', 'resident@gmail.com', 'resident1', '$2y$10$CpzCjYeywrIRhQnTS2n7meGkMNQnXDa8bNoXb4BjgFSgwWpDQ6SUO', 'Male', 'Resident', '1655256300_ERD Diagram 06-03-22 (2).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '12', 'False', 'False', '1992-06-25', '', 'What is your mother\'s maiden name?', 'Resident', 'True', 'TEst', '2022-06-15 09:25:51', '2022-06-15 09:39:10'),
(96, 'ihiuh', 'ihiuh', 'iuh', '2022-06-07', 'Single', 'asdjoasdj@gmail.com', 'resident2', '$2y$10$ksHnqoKKCgtPhsEx/qK25OacObpJQf9fjw.g15dNAmEH2186JGfXa', 'Male', 'Resident', '1655257020_1633943100_gru.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'None', 'Active', 'None', 'NONE', 'None', NULL, '21', 'False', 'False', '2022-06-13', 'iuh', 'What is your mother\'s maiden name?', 'Test', 'True', NULL, '2022-06-15 09:37:26', '2022-06-15 09:37:26'),
(99, 'Secretary', 'Secretary', 'Secretary', '2022-06-13', 'Single', 'asdohasiodj@gmail.com', 'secretary1', '$2y$10$2Yv6uhWqm.40hLgGf0a2Ue9hUAFMlb5slhbEZbi/DIHOUK/CHVmh2', 'Male', 'Secretary', '1655260320_1636115280_Capture.JPG', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '123', 'False', 'False', '2022-06-12', NULL, NULL, NULL, 'True', NULL, '2022-06-15 10:32:28', '2022-06-15 10:32:28'),
(100, 'Purok', 'L', 'Leader', '2015-02-02', 'Single', 'ashdiashd@gmail.com', 'purokleader1', '$2y$10$Iz5vnbVgobsvB2NV7YrDzukGmD5Z9YJPXclfFeMq/MdqtUp4VW8um', 'Male', 'Purok Leader', '1655279640_Screenshot (6).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '321', 'False', 'False', '2015-01-16', NULL, NULL, NULL, 'True', NULL, '2022-06-15 15:54:47', '2022-06-15 15:54:47'),
(101, 'Treasurer', 'Treasurer', 'Treasurer', '2000-01-15', 'Single', 'treasurer@gmail.com', 'treasurer1', '$2y$10$hw.C/jU3l/iue8Z7A11FMeqyBHrqOGZ.NFL.05xW3ka/VcJ4.5KGi', 'Male', 'Treasurer', '1655295360_1653586560_Screenshot (6).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '1125', 'False', 'True', '2008-06-12', NULL, NULL, NULL, 'False', NULL, '2022-06-15 20:16:05', '2022-06-15 20:16:05'),
(102, 'Juan', '-', 'Councilor', '1998-01-13', 'Single', 'councilorone@gmail.com', 'councilor1', '$2y$10$pXmns1PGKQsZkvdtiIqOMumCMyFFKA/2s9r0kV3QRVDgY7hGUxb9S', 'Female', 'Councilor', '1655295840_285571718_751194962552495_5114760615446740962_n.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '321', 'False', 'True', '2000-01-03', NULL, NULL, NULL, 'False', 'Health and Sanitation', '2022-06-15 20:24:20', '2022-06-15 20:24:20'),
(103, 'Tojo', '-', 'Councilor', '1997-01-15', 'Single', 'tojo@gmail.com', 'councilor2', '$2y$10$..3d/2dsdjCdwu8EKuAvvusT454hKC4xJapcV8.RnF1Zn3bdYCmyy', 'Male', 'Councilor', '1655296140_ERD Diagram 06-03-22 (1).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '13', 'False', 'True', '2003-03-06', NULL, NULL, NULL, 'False', 'Peace and Order', '2022-06-15 20:29:45', '2022-06-15 20:29:45'),
(104, 'Sanji', '-', 'Councilor', '1983-06-17', 'Married', 'sanji@gmail.com', 'councilor3', '$2y$10$ITBpZ8bbxVTPqCyEYiaB2OTXHgNCRjMAuc4o22RLesHu3xSrmlF/e', 'Male', 'Councilor', '1655296320_eBarangay use case (1).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '15', 'False', 'True', '1994-06-21', NULL, NULL, NULL, 'False', 'Education', '2022-06-15 20:32:53', '2022-06-15 20:32:53'),
(105, 'Yonji', '-', 'Councilor', '1975-09-12', 'Single', 'yonji@gmail.com', 'councilor4', '$2y$10$Uo3uzV4HLwnl5Kvldm4PpOmitR4I3HeQ72Zxwn7PS9lFvfFaLWfUK', 'Female', 'Councilor', '1655296500_Blank diagram.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '14', 'False', 'True', '2000-05-03', NULL, NULL, NULL, 'False', 'Information', '2022-06-15 20:35:25', '2022-06-15 20:35:25'),
(106, 'Gouji', '-', 'Councilor', '1992-07-05', 'Single', 'gouji@gmail.com', 'councilor5', '$2y$10$9K.2gEvmO2Du0iectW/jZe3j3YeDu8jr1eodf3S15AY56r1q0xHR2', 'Female', 'Councilor', '1655296620_Blank diagram.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '20', 'False', 'True', '2000-11-26', NULL, NULL, NULL, 'False', 'Environment', '2022-06-15 20:37:45', '2022-06-15 20:37:45'),
(107, 'Siyes', '-', 'Coucilor', '1999-09-12', 'Single', 'siyes@gmail.com', 'councilor6', '$2y$10$767C1IicWpDsVMNSUXpHQuCIRl/lNUJaXrFekfw9UME7ss5daKXEq', 'Male', 'Councilor', '1655296800_eBarangay use case (1).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '45', 'False', 'True', '2002-03-09', NULL, NULL, NULL, 'False', 'Youth', '2022-06-15 20:40:11', '2022-06-15 20:40:11'),
(108, 'Siyete', '-', 'Councilor', '1989-02-12', 'Single', 'siyete@gmail.com', 'councilor7', '$2y$10$2IpwsJ9vls99TUDaHFTDpuL46Ud.FnTCy6XT0z.G5ci7DYzkZL3yi', 'Female', 'Councilor', '1655296920_eBarangay use case (1).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '78', 'False', 'True', '2001-05-12', NULL, NULL, NULL, 'False', 'Economy', '2022-06-15 20:42:36', '2022-06-15 20:42:36'),
(109, 'Captain', '-', 'Bakilid', '1985-09-26', 'Single', 'bakilidcaptain@gmail.com', 'captain2', '$2y$10$50CG/N9ORNSCBK23hvAHDux6shGj0kZctnVl0RM9lj1FURYISW0oW', 'Male', 'Captain', '1655305320_20220524_202416.png.jpg', 'Bakilid', 'Chippy', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', '', '23', 'False', 'False', '2000-11-23', NULL, NULL, NULL, 'True', NULL, '2022-06-15 23:02:15', '2022-06-15 23:02:15'),
(110, 'Yolo', '-', 'Wows', '1991-12-15', 'Single', 'yolo@gmail.com', 'resident3', '$2y$10$wMzbWZjrD6WHpjAsKS1a5OdLxunSILd0gnjR6Hzqdjb17VlPg/CRi', 'Male', 'Resident', '1655305560_ERD 05-29-22.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '78', 'False', 'False', '1999-02-14', '', 'What is your first pet\'s name?', 'yolo', 'True', NULL, '2022-06-15 23:06:40', '2022-06-15 23:27:18'),
(111, 'Sakura', '-', 'Savior', '1998-05-04', 'Married', 'sakura@gmail.com', 'resident4', '$2y$10$xCZRdHKEV13/WRtZQoqlzO4MPfC0hqc2zGjatwMUKf8gKDAzGx7f2', 'Female', 'Resident', '1655305740_eBarangay use case (1).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '56', 'False', 'False', '2000-05-18', '', 'What is your mother\'s maiden name?', 'sakura', 'True', NULL, '2022-06-15 23:09:08', '2022-06-15 23:23:00'),
(112, 'Samurai', '-', 'Rex', '1985-03-28', 'Male', 'samurai@gmail.com', 'resident5', '$2y$10$GGm6ASpXZld6Le6faELEnedKkKPfHUDXmumMW7xLwyutWSIpewd2u', 'Male', 'Resident', '1655306760_Blank diagram (1).png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '89', 'False', 'False', '1995-07-23', '', 'What is your mother\'s maiden name?', 'samurai', 'True', NULL, '2022-06-15 23:12:05', '2022-06-15 23:27:12'),
(113, 'Purok ', 'Leader', 'Bakilid', '1989-12-23', 'Single', 'pleaderbakilid@gmail.com', 'leaderbakilid', '$2y$10$ianjaWth8EyjURQ2TK2GuOA7oJQPy2RrBIZOzdsx.rVtmtBgXr4eG', 'Female', 'Purok Leader', '1655341740_ERD 05-29-22.png', 'Bakilid', 'Chippy', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '60', 'False', 'True', '2000-05-30', NULL, NULL, NULL, 'False', NULL, '2022-06-16 09:09:48', '2022-06-16 09:09:48'),
(114, 'Secretary', '-', 'Bakilid', '1990-07-05', 'Single', 'secbalikid@gmail.com', 'secbakilid', '$2y$10$adh0uKcUGg7sY/eDtRlb7.TPl9R2YjvoWsEvj2ndl.eiR0/o898.u', 'Male', 'Secretary', '1655341920_ERD 05-29-22.png', 'Bakilid', 'Chippy', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '56', 'False', 'True', '1999-08-19', NULL, NULL, NULL, 'False', NULL, '2022-06-16 09:12:02', '2022-06-16 09:12:02'),
(115, 'Treasurer', 'Treas', 'Bakilid', '1984-06-26', 'Single', 'treasbakilid@gmail.com', 'treasbakilid', '$2y$10$Y5ptw4QeTT5iCV2xTUbMh.9ivzGzaB9Y9SEc06ysXXW3jD69/g0U.', 'Female', 'Treasurer', '1655342100_ERD Diagram 06-03-22.png', 'Bakilid', 'Chippy', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '89', 'False', 'True', '1999-08-27', NULL, NULL, NULL, 'False', NULL, '2022-06-16 09:15:08', '2022-06-16 09:15:08'),
(116, 'Name', 'Middle', 'Last', '1999-02-21', 'Single', 'name@gmail.com', 'bakilid1', '$2y$10$AF8LUwvCQOsgNxD4dSeiner2dRsduJVDL5GLycZuFMaU1A6HgkeLy', 'Male', 'Resident', '1655342220_ERD Diagram 06-03-22.png', 'Bakilid', 'Chippy', NULL, NULL, 'Pending', 'None', 'Active', 'None', 'NONE', 'None', NULL, '6', 'False', 'False', '2001-05-08', '', 'What is your mother\'s maiden name?', 'name', 'True', NULL, '2022-06-16 09:17:43', '2022-06-16 09:17:43'),
(117, 'Hulu', '-', 'Swift', '1971-05-04', 'Single', 'swift@gmail.com', 'bakilid2', '$2y$10$f4ZnvnyjvudnkEB1ovQpQOiJuJipNJa0ZeDWyy6n9cAiWXBzyhvcO', 'Female', 'Resident', '1655342520_20220524_202416.png.jpg', 'Bakilid', 'Chippy', NULL, NULL, 'Pending', 'None', 'Active', 'None', 'NONE', 'None', NULL, '7', 'False', 'False', '2004-04-29', '', 'What is your mother\'s maiden name?', 'Test', 'True', NULL, '2022-06-16 09:22:40', '2022-06-16 09:22:40'),
(118, 'Test', 'Test', 'Test', '2022-06-06', 'Male', 'test@gmail.com', 'testaccount', '$2y$10$It.ESC.eLMLFZ0LzmLgox.mISxYx8YnRjeaOk7/EgH2PURWt0/Or.', 'Male', 'Resident', '1655342760_RobloxScreenShot20220318_181126843.png', 'Paknaan', 'Kamatis', NULL, NULL, 'Verified', 'None', 'Active', 'None', 'NONE', 'None', NULL, '32', 'False', 'False', '2022-06-13', '', 'What is your mother\'s maiden name?', 'Test', 'True', NULL, '2022-06-16 09:24:51', '2022-06-16 09:27:32');

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
(1, 1, 94, '2022-06-16 03:13:25', '2022-06-16 03:13:25', 'Purok Leader', 31),
(2, 1, 110, '2022-06-16 03:15:09', '2022-06-16 03:15:09', 'Purok Leader', 31),
(3, 3, 111, '2022-06-16 03:15:58', '2022-06-16 03:15:58', 'Purok Leader', 31),
(4, 1, 100, '2022-06-16 03:17:27', '2022-06-16 03:17:27', 'Purok Leader', 31),
(5, 1, 104, '2022-06-16 03:19:15', '2022-06-16 03:19:15', 'Purok Leader', 31),
(6, 3, 103, '2022-06-16 03:19:44', '2022-06-16 03:19:44', 'Purok Leader', 31);

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
-- Indexes for table `requestreport`
--
ALTER TABLE `requestreport`
  ADD PRIMARY KEY (`requestreportID`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `officerID` (`officerID`);

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
-- Indexes for table `userreport`
--
ALTER TABLE `userreport`
  ADD PRIMARY KEY (`userreportID`);

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
  MODIFY `BarangayID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `barangaylupon`
--
ALTER TABLE `barangaylupon`
  MODIFY `luponMemberID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidateID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `chatroomID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documentpurpose`
--
ALTER TABLE `documentpurpose`
  MODIFY `purposeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documenttype`
--
ALTER TABLE `documenttype`
  MODIFY `DocumentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ereklamo`
--
ALTER TABLE `ereklamo`
  MODIFY `ReklamoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `ereklamocategory`
--
ALTER TABLE `ereklamocategory`
  MODIFY `reklamoCatID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ereklamoreport`
--
ALTER TABLE `ereklamoreport`
  MODIFY `ereportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `ereklamotype`
--
ALTER TABLE `ereklamotype`
  MODIFY `reklamoTypeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `membersID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `PurokID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `requestreport`
--
ALTER TABLE `requestreport`
  MODIFY `requestreportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `requirementlist`
--
ALTER TABLE `requirementlist`
  MODIFY `requirementID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `residentcategory`
--
ALTER TABLE `residentcategory`
  MODIFY `residentCatID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `ResidentID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userreport`
--
ALTER TABLE `userreport`
  MODIFY `userreportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `documentpurpose_ibfk_1` FOREIGN KEY (`barangayDoc`) REFERENCES `documenttype` (`DocumentID`) ON DELETE CASCADE;

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
-- Constraints for table `requestreport`
--
ALTER TABLE `requestreport`
  ADD CONSTRAINT `requestreport_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `request` (`RequestID`),
  ADD CONSTRAINT `requestreport_ibfk_2` FOREIGN KEY (`officerID`) REFERENCES `users` (`UsersID`);

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
