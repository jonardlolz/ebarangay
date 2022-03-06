-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2022 at 03:11 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`BarangayID`, `BarangayName`, `City`, `Active`) VALUES
(1, 'Bakilid', 'Mandaue', 'False'),
(2, 'Paknaan', 'Mandaue', 'True'),
(3, 'Maguikay', 'Mandaue', 'False'),
(4, 'Cambaro', 'Mandaue', 'False'),
(5, 'Pajo', 'Lapu-Lapu', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidateID` int NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `platform` varchar(200) DEFAULT NULL,
  `purok` varchar(20) NOT NULL,
  `UsersID` int NOT NULL,
  `electionID` int NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidateID`, `lastname`, `firstname`, `created_at`, `updated_at`, `platform`, `purok`, `UsersID`, `electionID`, `position`) VALUES
(12, 'Johnson', 'Xavier', '2022-03-04 01:21:14', '2022-03-04 01:21:14', 'Test', 'Kamatis', 28, 8, 'Purok Leader'),
(13, 'Johnson', 'Xavier', '2022-03-04 11:18:33', '2022-03-04 11:18:33', 'Test', 'Kamatis', 28, 8, 'Purok Leader'),
(14, 'Torts', 'Woshua', '2022-03-04 11:24:11', '2022-03-04 11:24:11', 'Test', 'Kamatis', 34, 8, 'Purok Leader');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `electionID` int NOT NULL,
  `electionTitle` varchar(50) NOT NULL,
  `electionStatus` varchar(20) NOT NULL DEFAULT 'Paused',
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barangay` varchar(50) DEFAULT NULL,
  `purok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionID`, `electionTitle`, `electionStatus`, `created_by`, `created_at`, `updated_at`, `barangay`, `purok`) VALUES
(8, 'Term 2023-2024', 'Paused', '29', '2022-03-04 01:03:33', '2022-03-04 01:03:33', 'Paknaan', 'Kamatis'),
(9, 'Term 2026-2027', 'Paused', '29', '2022-03-04 10:45:26', '2022-03-04 10:45:26', 'Paknaan', 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamo`
--

CREATE TABLE `ereklamo` (
  `ReklamoID` int NOT NULL,
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
  `scheduledSummon` date DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `barangay` varchar(20) NOT NULL,
  `purok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ereklamo`
--

INSERT INTO `ereklamo` (`ReklamoID`, `reklamoType`, `detail`, `status`, `CreatedOn`, `UpdatedOn`, `comment`, `checkedBy`, `checkedOn`, `complaintLevel`, `complainee`, `scheduledSummon`, `UsersID`, `barangay`, `purok`) VALUES
(11, 'Kuryente', 'No electricity in the area', 'Pending', '2022-03-04 20:35:16', '2022-03-04 20:35:16', 'Test', NULL, NULL, 'Minor', 0, NULL, 28, 'Paknaan', 'Kamatis');

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
(15, 'Your account has been verified!', 'Resident', 'Not Read', 29, NULL, '2022-03-03 14:11:53', '2022-03-03 14:11:53'),
(16, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-03-03 19:57:47', '2022-03-03 19:57:47'),
(17, 'A resident has submitted a reklamo: Kuryente', 'ereklamo', 'Not Read', NULL, 'Purok Leader', '2022-03-04 17:56:52', '2022-03-04 17:56:52'),
(18, 'A resident has submitted a reklamo: Kuryente', 'ereklamo', 'Not Read', NULL, 'Purok Leader', '2022-03-04 20:35:16', '2022-03-04 20:35:16'),
(19, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-03-05 19:54:11', '2022-03-05 19:54:11'),
(20, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-03-05 20:01:29', '2022-03-05 20:01:29'),
(21, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-03-05 23:17:47', '2022-03-05 23:17:47'),
(22, 'A resident has requested a Cedula', 'request', 'Not Read', NULL, 'Purok Leader', '2022-03-05 23:19:34', '2022-03-05 23:19:34');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`PostID`, `UsersID`, `username`, `userType`, `postMessage`, `date_created`) VALUES
(69, 29, 'captain1', 'Captain', 'Vaccination for kids!! ', '2022-03-02 19:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `purok`
--

CREATE TABLE `purok` (
  `PurokID` int NOT NULL,
  `PurokName` varchar(20) NOT NULL,
  `BarangayName` varchar(20) NOT NULL,
  `Active` varchar(20) NOT NULL DEFAULT 'True'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(9, 'Apple', 'Paknaan', 'False'),
(10, 'Papayas', 'Paknaan', 'False'),
(11, 'Kamanggahan', 'Pajo', 'True');

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
  `documentType` varchar(120) NOT NULL,
  `purpose` varchar(120) NOT NULL,
  `requestedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `approvedOn` datetime DEFAULT NULL,
  `approvedBy` varchar(120) DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `status` varchar(120) DEFAULT 'Pending',
  `userBarangay` varchar(50) DEFAULT NULL,
  `userPurok` varchar(50) DEFAULT NULL,
  `paymentMode` varchar(50) DEFAULT NULL,
  `userType` varchar(50) DEFAULT NULL,
  `UsersID` int DEFAULT NULL,
  `paymentStatus` varchar(20) DEFAULT 'Not Paid',
  `requesturl` varchar(255) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `documentType`, `purpose`, `requestedOn`, `approvedOn`, `approvedBy`, `amount`, `status`, `userBarangay`, `userPurok`, `paymentMode`, `userType`, `UsersID`, `paymentStatus`, `requesturl`) VALUES
(14, 'Cedula', 'Employment', '2022-03-05 23:19:34', '2022-03-05 23:19:59', 'Handson, Roxy', 20, 'Releasing', 'Paknaan', 'Kamatis', 'Cash on Claim', 'Treasurer', 28, 'Not Paid', 'https://getpaid.gcash.com/checkout/984aecd3d2d6b170a9d8f7870e5262d0');

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
  `VerifyStatus` varchar(20) NOT NULL DEFAULT 'Pending',
  `userCity` varchar(30) NOT NULL DEFAULT 'None',
  `Status` varchar(20) NOT NULL DEFAULT 'Active',
  `isRenting` varchar(20) DEFAULT 'False',
  `landlordName` varchar(50) DEFAULT 'None',
  `landlordContact` varchar(50) DEFAULT 'NONE',
  `barangayPos` varchar(50) DEFAULT 'None',
  `userAddress` varchar(50) DEFAULT NULL,
  `userHouseNum` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `emailAdd`, `username`, `usersPwd`, `userGender`, `userType`, `profile_pic`, `userBarangay`, `userPurok`, `phoneNum`, `teleNum`, `VerifyStatus`, `userCity`, `Status`, `isRenting`, `landlordName`, `landlordContact`, `barangayPos`, `userAddress`, `userHouseNum`) VALUES
(27, 'Craige Jonard', 'Noel', 'Baring', '2000-01-08', 'Single', 'craigejonard@gmail.com', 'admin', '$2y$10$UEq1Wgm7o57pp1kueghFh.rcR3C4OLo3fDV8YPV6Rln17VMV9Cxh2', 'Male', 'Admin', 'profile_picture.jpg', NULL, NULL, NULL, NULL, 'Pending', '', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '001'),
(28, 'Xavier', 'Noel', 'Johnson', '2000-01-01', 'Single', 'xavier.johnson@gmail.com', 'resident1', '$2y$10$..PLFwgk8icProv4dHWmruXNRuedfpg9dq7cnvxdb/MNWdItpbt/e', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '002'),
(29, 'Jeremy', 'Psycho', 'Elbertson', '1981-08-23', 'Single', 'jeremyelbertson@gmail.com', 'captain1', '$2y$10$Z6oSDH5WbQ1idlHl6Z48w.notdDAOGLo4JrrEC8WFwEGq6XhWLEQa', 'Male', 'Captain', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '003'),
(30, 'Roxy', 'Tabby', 'Handson', '1991-02-01', 'Single', 'handson.tabby@gmail.com', 'secretary1', '$2y$10$7MPFKH3XG/uUamFPUQJnyuIfwpkmhl31F7Owu7A4mXHJW.HceFUBq', 'Female', 'Secretary', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '004'),
(31, 'Purok', 'Leader', 'Leader', '1987-11-11', 'Single', 'purokleader@gmail.com', 'purokLeader1', '$2y$10$GXZUfl.RHuhPT9OHoRL.sOiI9keF1TAy178G79p12h1/M9SRGd0pW', 'Male', 'Purok Leader', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', NULL, 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '005'),
(32, 'Resident', 'User', 'User', '2020-02-12', 'Single', 'resident@gmail.com', 'resident2', '$2y$10$oua0FAN7GbEUsSuGAfwrEO4bzUdTLgEt5atpy549A0uMhexXUV6OO', 'Male', 'Resident', 'profile_picture.jpg', 'Pajo', 'Kamanggahan', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Quezon National Highway', '2154'),
(34, 'Woshua', 'Etch', 'Torts', '2017-11-25', 'Single', 'woshua@gmail.com', 'tanodResident', '$2y$10$r1tpz1YRzITj1SYgiq99Re2573PkqyytJkonuaAwCb/kNo46ceI.W', 'Male', 'Resident', 'profile_picture.jpg', 'Paknaan', 'Kamatis', NULL, NULL, 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'Tanod', 'Plaridel Street', '006'),
(37, 'Jackson', 'Me', 'Ville', '2011-11-11', 'Single', 'treasurer@gmail.com', 'treasurer1', '$2y$10$4afrff9nv2rPHjPwgBwUw.4Uf8OIVYwSlzJibdqElFU4fag3R/.we', 'Male', 'Treasurer', 'profile_picture.jpg', 'Paknaan', 'Kamatis', '', 'N/A', 'Pending', 'Mandaue', 'Active', 'False', 'None', 'NONE', 'None', 'Plaridel Street', '007');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  MODIFY `BarangayID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidateID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ereklamo`
--
ALTER TABLE `ereklamo`
  MODIFY `ReklamoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `PurokID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
