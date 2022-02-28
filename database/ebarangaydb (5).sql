-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 03:37 PM
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
  `BarangayName` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Active` varchar(20) NOT NULL DEFAULT 'True'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`BarangayID`, `BarangayName`, `City`, `Active`) VALUES
(1, 'Bakilid', 'Mandaue', 'True'),
(2, 'Paknaan', 'Mandaue', 'True'),
(3, 'Maguikay', 'Mandaue', 'True'),
(4, 'Cambaro', 'Mandaue', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidateID` int NOT NULL,
  `UsersID` int NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `position` varchar(20) NOT NULL,
  `electionID` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `platform` varchar(200) DEFAULT NULL,
  `purok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidateID`, `UsersID`, `lastname`, `firstname`, `position`, `electionID`, `created_at`, `updated_at`, `platform`, `purok`) VALUES
(1, 11, 'Baring', 'Craige Jonard', 'Captain', 1, '2021-12-01 21:34:29', '2021-12-01 21:34:29', 'I\'ll pave a better tomorrow!', ''),
(5, 11, 'Barings', 'Craige Jonard', 'Secretary', 1, '2021-12-03 23:10:14', '2021-12-03 23:10:14', 'I want to be secretary!', 'Kamanggahan'),
(6, 12, 'Cadavero', 'Sajid', 'Captain', 1, '2021-12-03 23:10:43', '2021-12-03 23:10:43', 'I want to be Captain!', 'Test'),
(7, 22, 'Pepito', 'Rosvie', 'Treasurer', 1, '2021-12-03 23:11:24', '2021-12-03 23:11:24', 'I want to be Treasurer!', 'Kamatis'),
(8, 13, 'Baring', 'Craven Johnzen', 'Purok Leader', 1, '2021-12-03 23:11:49', '2021-12-03 23:11:49', 'I want to be Purok Leader!', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentsID` int NOT NULL,
  `UsersID` int NOT NULL,
  `PostID` int NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentsID`, `UsersID`, `PostID`, `comment`, `date_created`) VALUES
(20, 24, 50, 'asdwq', '2021-12-06 22:08:06'),
(21, 24, 51, 'Hello', '2021-12-06 22:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `electionID` int NOT NULL,
  `electionTitle` varchar(50) NOT NULL,
  `electionStatus` varchar(20) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barangay` varchar(50) DEFAULT NULL,
  `purok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionID`, `electionTitle`, `electionStatus`, `created_by`, `created_at`, `updated_at`, `barangay`, `purok`) VALUES
(1, 'Term 2021-2022', 'Finished', '22', '2021-11-30 20:34:05', '2021-11-30 20:34:05', 'Pajo', 'Kamatis');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamo`
--

CREATE TABLE `ereklamo` (
  `ReklamoID` int NOT NULL,
  `UsersID` int NOT NULL,
  `reklamoType` varchar(120) DEFAULT NULL,
  `detail` varchar(120) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `UpdatedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(120) DEFAULT NULL,
  `checkedBy` varchar(120) DEFAULT NULL,
  `checkedOn` datetime DEFAULT NULL,
  `complaintLevel` varchar(50) DEFAULT 'Minor',
  `complainee` int DEFAULT NULL,
  `scheduledSummon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ereklamo`
--

INSERT INTO `ereklamo` (`ReklamoID`, `UsersID`, `reklamoType`, `detail`, `status`, `CreatedOn`, `UpdatedOn`, `comment`, `checkedBy`, `checkedOn`, `complaintLevel`, `complainee`, `scheduledSummon`) VALUES
(1, 11, 'Kuryente', 'Power outtages', 'Resolved', '2021-11-07 22:49:14', '2021-11-24 21:25:46', 'Area keeps having brownouts', 'Pepito, Rosvie', '2021-11-24 21:28:13', 'Minor', NULL, NULL),
(2, 11, 'Resident', 'Noise', 'Resolved', '2021-11-25 16:25:49', '2021-11-25 16:25:49', '5am mag disco', 'Pepito, Rosvie', '2021-11-25 16:27:51', 'Minor', NULL, NULL),
(3, 11, 'Resident', 'Disregard of trashes', 'Resolved', '2021-12-06 22:24:41', '2021-12-06 22:24:41', 'Batig nawng si abie', 'Captain, Captain', '2021-12-06 22:29:28', 'Minor', NULL, NULL),
(6, 11, 'Resident', 'Abusive', 'Resolved', '2022-02-13 00:27:13', '2022-02-13 00:27:13', 'Test', 'Captain, Captain', '2022-02-18 21:10:36', 'Major', 22, '2022-02-19'),
(7, 11, 'Tubig', 'No water in the area', 'Resolved', '2022-02-24 18:09:40', '2022-02-24 18:09:40', 'test', 'Baring, Caitleen', '2022-02-24 20:15:15', 'Minor', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'Not Read',
  `UsersID` int DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `message`, `type`, `status`, `UsersID`, `position`, `created_at`, `updated_at`) VALUES
(1, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Not Read', NULL, 'Secretary', '2022-02-12 23:32:31', '2022-02-12 23:32:31'),
(2, 'A resident has submitted a reklamo: Resident', 'ereklamo', 'Not Read', NULL, 'Secretary', '2022-02-13 00:27:13', '2022-02-13 00:27:13'),
(4, 'Your eReklamo has been scheduled.', 'ereklamo', 'Not Read', 11, 'Resident', '2022-02-18 21:10:36', '2022-02-18 21:10:36'),
(6, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-02-18 22:17:18', '2022-02-18 22:17:18'),
(7, 'A resident has requested a Barangay Clearance', 'request', 'Not Read', NULL, 'Secretary', '2022-02-18 22:17:26', '2022-02-18 22:17:26'),
(8, 'A resident has submitted a reklamo: Tubig', 'ereklamo', 'Not Read', NULL, 'Purok Leader', '2022-02-24 18:09:40', '2022-02-24 18:09:40'),
(9, 'A resident has requested a Barangay Clearance', 'request', 'Not Read', NULL, 'Secretary', '2022-02-24 18:12:41', '2022-02-24 18:12:41'),
(11, 'Your eReklamo has been responded.', 'ereklamo', 'Not Read', 7, 'Resident', '2022-02-24 20:15:15', '2022-02-24 20:15:15'),
(12, 'A resident has submitted a reklamo: Tubig', 'ereklamo', 'Not Read', NULL, 'Purok Leader', '2022-02-24 20:28:09', '2022-02-24 20:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `OfficialID` int DEFAULT NULL,
  `NationalID` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `residentID` int DEFAULT NULL,
  `electedOn` date DEFAULT NULL,
  `updatedOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostID` int NOT NULL,
  `UsersID` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `postMessage` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`PostID`, `UsersID`, `username`, `userType`, `postMessage`, `date_created`) VALUES
(11, 12, 'sajidcadavero', 'Resident', 'Test 3', '2021-10-20 11:04:31'),
(36, 11, 'jonardlolz', 'Resident', 'thoughts and prayers', '2021-11-04 11:13:00'),
(41, 11, 'jonardlolz', 'Resident', 'test', '2021-11-04 21:33:39'),
(42, 11, 'jonardlolz', 'Resident', 'test', '2021-11-04 21:34:35'),
(43, 11, 'jonardlolz', 'Resident', 'test2', '2021-11-04 21:35:30'),
(44, 11, 'jonardlolz', 'Resident', 'test3', '2021-11-04 21:38:24'),
(45, 11, 'jonardlolz', 'Resident', 'test', '2021-11-04 21:39:44'),
(46, 11, 'jonardlolz', 'Resident', 'test4', '2021-11-04 21:44:29'),
(47, 11, 'jonardlolz', 'Resident', 'rwqr', '2021-11-04 21:45:19'),
(48, 11, 'jonardlolz', 'Resident', 'dwqd', '2021-11-04 21:47:10'),
(49, 11, 'jonardlolz', 'Resident', 'sadwq', '2021-11-04 21:48:42'),
(50, 11, 'jonardlolz', 'Resident', 'test', '2021-11-05 17:42:31'),
(51, 11, 'jonardlolz', 'Resident', 'test', '2021-11-05 17:43:05'),
(52, 11, 'jonardlolz', 'Resident', 'test', '2021-11-05 17:44:25'),
(53, 11, 'jonardlolz', 'Resident', 'test', '2021-11-05 17:44:45'),
(54, 11, 'jonardlolz', 'Resident', 'test', '2021-11-05 17:49:54'),
(55, 11, 'jonardlolz', 'Resident', 'test2', '2021-11-05 17:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `purok`
--

CREATE TABLE `purok` (
  `PurokID` int NOT NULL,
  `PurokName` varchar(20) NOT NULL,
  `BarangayName` varchar(20) NOT NULL,
  `Active` varchar(20) NOT NULL DEFAULT 'True'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purok`
--

INSERT INTO `purok` (`PurokID`, `PurokName`, `BarangayName`, `Active`) VALUES
(1, 'Kamatis', 'Paknaan', 'True'),
(2, 'Berde', 'Bakilid', 'True'),
(3, 'Piattos', 'Maguikay', 'True'),
(4, 'Pula', 'Bakilid', 'True'),
(5, 'Nova', 'Maguikay', 'True'),
(6, 'Chippy', 'Maguikay', 'True'),
(7, 'Sprite', 'Cambaro', 'True'),
(8, 'Coke', 'Cambaro', 'True'),
(9, 'Apple', 'Paknaan', 'True'),
(10, 'Papayas', 'Paknaan', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` int NOT NULL,
  `ReportType` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `reportMessage` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `UsersID` int NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `userBarangay` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userPurok` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportID`, `ReportType`, `reportMessage`, `UsersID`, `created_on`, `updated_on`, `userBarangay`, `userPurok`) VALUES
(1, 'eReklamo', 'Test Test has resolved ereklamo#$id', 0, '2022-02-24 20:07:11', '2022-02-24 20:07:11', 'Pajo', 'Kamatis'),
(2, 'eReklamo', 'Purok Leader Caitleen has resolved ereklamo#7', 23, '2022-02-24 20:15:16', '2022-02-24 20:15:16', 'Pajo', 'Kamatis');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int NOT NULL,
  `UsersID` int NOT NULL,
  `documentType` varchar(120) NOT NULL,
  `purpose` varchar(120) NOT NULL,
  `requestedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `approvedOn` datetime DEFAULT NULL,
  `approvedBy` varchar(120) DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL,
  `userBarangay` varchar(50) DEFAULT NULL,
  `userPurok` varchar(50) DEFAULT NULL,
  `paymentMode` varchar(50) DEFAULT NULL,
  `userType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `UsersID`, `documentType`, `purpose`, `requestedOn`, `approvedOn`, `approvedBy`, `amount`, `status`, `userBarangay`, `userPurok`, `paymentMode`, `userType`) VALUES
(2, 11, 'brgyClearance', 'Employment', '2021-11-25 16:23:35', '2021-11-25 16:27:21', 'Pepito, Rosvie', 0, 'Approved', NULL, NULL, NULL, NULL),
(3, 11, 'Cedula', 'Employment', '2021-12-05 11:24:23', '2021-12-05 11:25:12', 'Pepito, Rosvie', 0, 'Approved', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleID` int NOT NULL,
  `scheduleDate` date DEFAULT NULL,
  `ereklamoID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleID`, `scheduleDate`, `ereklamoID`) VALUES
(2, '2022-02-18', NULL),
(4, '2022-02-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersID` int NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Middlename` varchar(50) DEFAULT NULL,
  `Lastname` varchar(50) NOT NULL,
  `dateofbirth` varchar(50) NOT NULL,
  `civilStat` varchar(50) NOT NULL,
  `emailAdd` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `usersPwd` varchar(255) DEFAULT NULL,
  `userGender` varchar(50) DEFAULT NULL,
  `userType` varchar(50) DEFAULT NULL,
  `profile_pic` varchar(129) DEFAULT NULL,
  `userBarangay` varchar(50) DEFAULT NULL,
  `userPurok` varchar(50) DEFAULT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `teleNum` varchar(20) DEFAULT NULL,
  `NationalID` varchar(120) NOT NULL,
  `VerifyStatus` varchar(20) NOT NULL DEFAULT 'Pending',
  `userCity` varchar(30) NOT NULL DEFAULT 'None',
  `Status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `emailAdd`, `username`, `usersPwd`, `userGender`, `userType`, `profile_pic`, `userBarangay`, `userPurok`, `phoneNum`, `teleNum`, `NationalID`, `VerifyStatus`, `userCity`, `Status`) VALUES
(11, 'Craige Jonard', 'Noels', 'Barings', '2000-01-08', 'Single', 'craigejonard@gmail.com', 'jonardlolz', '$2y$10$K6Zkx.YH2y0g0m33wAc7Q.8KhMKvhHvsCur4qhw9qyGCusJagnnku', 'Male', 'Resident', '1634666100_gru.png', 'Pajo', 'Kamatis', '999999', 'N/A', '', 'Pending', 'None', 'Active'),
(12, 'Sajid', 'Manito', 'Cadavero', '2000-11-15', 'Single', 'cadaverosajid@gmail.com', 'sajidcadavero', '$2y$10$.kSmGRxGlKh/w7qlr/JbfOHadGYxel22MINmsi.WEe.2d1GPRU8aW', 'Male', 'Resident', 'profile_picture.jpg', 'Test', 'Test', NULL, NULL, '', 'Pending', 'None', 'Active'),
(13, 'Craven Johnzen', 'Noel', 'Baring', '2000-11-08', 'Single', 'cravenjohnzen@gmail.com', 'johnzen', '$2y$10$XwKnYul153sHbFfkIQsZfubFmRQskanLa.uLxrjHP47Bp3Ldo3.ui', 'Male', 'Resident', 'profile_picture.jpg', 'Test', 'Test', NULL, NULL, '1234-5678-9123-4567', 'Pending', 'None', 'Active'),
(15, 'Null', 'Null', 'Null', '0001-01-01', 'Single', 'Null@gmail.com', 'admin', '$2y$10$jn27UBTK1djlbR1AOEcPAe9LhvZgg2caCdTSmNCdNwv63qNI.nwQ2', 'Male', 'Admin', 'profile_picture.jpg', 'Null', 'Null', NULL, NULL, '0000-0000-0000-0000', 'Pending', 'Mandaue', 'Active'),
(22, 'Rosvie', 'Ruizo', 'Pepito', '1999-08-23', 'Single', 'pepitorosvie@gmail.com', 'pepitorosvie', '$2y$10$66c6RivqwloDJyE3lojVWOfLxyfflfPx5BJONrQ3KAkdlQ4bs.6Ka', 'Male', 'Secretary', 'profile_picture.jpg', 'Pajo', 'Kamatis', '095487785423', '(032)340-5560', '2222-2222-2222-2222', 'Pending', 'Mandaue', 'Inactive'),
(23, 'Caitleen', 'Noel', 'Baring', '1111-11-11', 'Single', 'caitleenjhoyce@gmail.com', 'caitleenJhoyce', '$2y$10$L.MhYe18oF0B8s2m39YsHuCJ.RXYO1qOoIN1PyqddNkjRYxUQGiiu', 'Female', 'Purok Leader', 'profile_picture.jpg', 'Pajo', 'Kamatis', '098752145632', NULL, '7894-5612-3785-4245', 'Verified', 'None', 'Active'),
(24, 'Captain', 'Captain', 'Captain', '2002-10-25', 'Single', 'captain@gmail.com', 'captain1', '$2y$10$Naf9ZWeha2YmDCe1oOKDjeZHLdDDJ5F3ZVFIHeadhBWnlgCPy86CS', 'Male', 'Captain', 'profile_picture.jpg', 'Pajo', 'Kamatis', '09758423457', '(032)340-7854', '5555-5555-5555-5555', 'Pending', 'Mandaue', 'Active');

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
  `position` varchar(50) NOT NULL,
  `electionID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`BarangayID`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidateID`),
  ADD KEY `electionID` (`electionID`),
  ADD KEY `UsersID` (`UsersID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentsID`),
  ADD KEY `UsersID` (`UsersID`),
  ADD KEY `PostID` (`PostID`);

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
  ADD PRIMARY KEY (`PurokID`);

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
  MODIFY `BarangayID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidateID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ereklamo`
--
ALTER TABLE `ereklamo`
  MODIFY `ReklamoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `PurokID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`electionID`) REFERENCES `election` (`electionID`),
  ADD CONSTRAINT `candidates_ibfk_2` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`) ON DELETE CASCADE;

--
-- Constraints for table `ereklamo`
--
ALTER TABLE `ereklamo`
  ADD CONSTRAINT `ereklamo_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`);

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
