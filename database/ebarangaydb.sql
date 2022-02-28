-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 01:48 AM
-- Server version: 10.4.20-MariaDB
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
  `BarangayID` int(11) NOT NULL,
  `BarangayName` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Active` varchar(20) NOT NULL DEFAULT 'True'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `candidateID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `position` varchar(20) NOT NULL,
  `electionID` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `platform` varchar(200) DEFAULT NULL,
  `purok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `CommentsID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `electionID` int(11) NOT NULL,
  `electionTitle` varchar(50) NOT NULL,
  `electionStatus` varchar(20) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionID`, `electionTitle`, `electionStatus`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Term 2021-2022', 'Active', '22', '2021-11-30 20:34:05', '2021-11-30 20:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `ereklamo`
--

CREATE TABLE `ereklamo` (
  `ReklamoID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `reklamoType` varchar(120) DEFAULT NULL,
  `detail` varchar(120) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT current_timestamp(),
  `UpdatedOn` datetime DEFAULT current_timestamp(),
  `comment` varchar(120) DEFAULT NULL,
  `checkedBy` varchar(120) DEFAULT NULL,
  `checkedOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ereklamo`
--

INSERT INTO `ereklamo` (`ReklamoID`, `UsersID`, `reklamoType`, `detail`, `status`, `CreatedOn`, `UpdatedOn`, `comment`, `checkedBy`, `checkedOn`) VALUES
(1, 11, 'Kuryente', 'Power outtages', 'Resolved', '2021-11-07 22:49:14', '2021-11-24 21:25:46', 'Area keeps having brownouts', 'Pepito, Rosvie', '2021-11-24 21:28:13'),
(2, 11, 'Resident', 'Noise', 'Resolved', '2021-11-25 16:25:49', '2021-11-25 16:25:49', '5am mag disco', 'Pepito, Rosvie', '2021-11-25 16:27:51'),
(3, 11, 'Resident', 'Disregard of trashes', 'Resolved', '2021-12-06 22:24:41', '2021-12-06 22:24:41', 'Batig nawng si abie', 'Captain, Captain', '2021-12-06 22:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Not read',
  `UsersID` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `message`, `type`, `status`, `UsersID`, `created_at`, `updated_at`) VALUES
(1, 'This is a test notification!', 'Resident', 'Not read', 11, '2021-12-07 01:17:46', '2021-12-07 01:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `OfficialID` int(11) DEFAULT NULL,
  `NationalID` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `residentID` int(11) DEFAULT NULL,
  `electedOn` date DEFAULT NULL,
  `updatedOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `postMessage` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `PurokID` int(11) NOT NULL,
  `PurokName` varchar(20) NOT NULL,
  `BarangayName` varchar(20) NOT NULL,
  `Active` varchar(20) NOT NULL DEFAULT 'True'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `documentType` varchar(120) NOT NULL,
  `purpose` varchar(120) NOT NULL,
  `requestedOn` datetime DEFAULT current_timestamp(),
  `approvedOn` datetime DEFAULT NULL,
  `approvedBy` varchar(120) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `UsersID`, `documentType`, `purpose`, `requestedOn`, `approvedOn`, `approvedBy`, `amount`, `status`) VALUES
(2, 11, 'brgyClearance', 'Employment', '2021-11-25 16:23:35', '2021-11-25 16:27:21', 'Pepito, Rosvie', 0, 'Approved'),
(3, 11, 'Cedula', 'Employment', '2021-12-05 11:24:23', '2021-12-05 11:25:12', 'Pepito, Rosvie', 0, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersID` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Firstname`, `Middlename`, `Lastname`, `dateofbirth`, `civilStat`, `emailAdd`, `username`, `usersPwd`, `userGender`, `userType`, `profile_pic`, `userBarangay`, `userPurok`, `phoneNum`, `teleNum`, `NationalID`, `VerifyStatus`, `userCity`, `Status`) VALUES
(11, 'Craige Jonard', 'Noels', 'Barings', '2000-01-08', 'Single', 'craigejonard@gmail.com', 'jonardlolz', '$2y$10$K6Zkx.YH2y0g0m33wAc7Q.8KhMKvhHvsCur4qhw9qyGCusJagnnku', 'Male', 'Resident', '1634666100_gru.png', 'Paknaan', 'Kamatis', '999999', 'N/A', '', 'Pending', 'None', 'Active'),
(12, 'Sajid', 'Manito', 'Cadavero', '2000-11-15', 'Single', 'cadaverosajid@gmail.com', 'sajidcadavero', '$2y$10$.kSmGRxGlKh/w7qlr/JbfOHadGYxel22MINmsi.WEe.2d1GPRU8aW', 'Male', 'Resident', 'profile_picture.jpg', 'Test', 'Test', NULL, NULL, '', 'Pending', 'None', 'Active'),
(13, 'Craven Johnzen', 'Noel', 'Baring', '2000-11-08', 'Single', 'cravenjohnzen@gmail.com', 'johnzen', '$2y$10$XwKnYul153sHbFfkIQsZfubFmRQskanLa.uLxrjHP47Bp3Ldo3.ui', 'Male', 'Resident', 'profile_picture.jpg', 'Test', 'Test', NULL, NULL, '1234-5678-9123-4567', 'Pending', 'None', 'Active'),
(15, 'Null', 'Null', 'Null', '0001-01-01', 'Single', 'Null@gmail.com', 'admin', '$2y$10$jn27UBTK1djlbR1AOEcPAe9LhvZgg2caCdTSmNCdNwv63qNI.nwQ2', 'Male', 'Admin', 'profile_picture.jpg', 'Null', 'Null', NULL, NULL, '0000-0000-0000-0000', 'Pending', 'Mandaue', 'Active'),
(21, 'QWE', 'Noels', 'Barings', '2021-11-21', 'Single', 'asdjasdijnasd@gmaill.com', 'iajsdasd', '$2y$10$C9Cpmdo7iptrMwewTqnhZewD1c4xMv9xi3t83zX7gyo4L8/Qg2XpC', 'Female', NULL, 'profile_picture.jpg', 'Pajo', 'Kamanggahan', NULL, NULL, '1111-1111-1111-1111', 'Pending', 'None', 'Inactive'),
(22, 'Rosvie', 'Ruizo', 'Pepito', '1999-08-23', 'Single', 'pepitorosvie@gmail.com', 'pepitorosvie', '$2y$10$66c6RivqwloDJyE3lojVWOfLxyfflfPx5BJONrQ3KAkdlQ4bs.6Ka', 'Male', 'Captain', 'profile_picture.jpg', 'Pajo', 'Kamatis', '095487785423', '(032)340-5560', '2222-2222-2222-2222', 'Pending', 'Mandaue', 'Inactive'),
(23, 'Caitleen', 'Noel', 'Baring', '1111-11-11', 'Single', 'caitleenjhoyce@gmail.com', 'caitleenJhoyce', '$2y$10$L.MhYe18oF0B8s2m39YsHuCJ.RXYO1qOoIN1PyqddNkjRYxUQGiiu', 'Female', 'Resident', 'profile_picture.jpg', 'Pajo', 'Kamatis', '098752145632', NULL, '7894-5612-3785-4245', 'Verified', 'None', 'Active'),
(24, 'Captain', 'Captain', 'Captain', '2002-10-25', 'Single', 'captain@gmail.com', 'captain1', '$2y$10$Naf9ZWeha2YmDCe1oOKDjeZHLdDDJ5F3ZVFIHeadhBWnlgCPy86CS', 'Male', 'Captain', 'profile_picture.jpg', NULL, NULL, '09758423457', '(032)340-7854', '5555-5555-5555-5555', 'Pending', 'Mandaue', 'Active'),
(25, 'Test', 'Test', 'Test', '2222-02-22', 'Married', 'qweqwd@gmail.com', 'test', '$2y$10$Okj1uCodCTmwxoSeAQ.3nu2fgv3AcBh7Kj.9TDlvKMynevvBau0By', 'Male', 'Resident', 'profile_picture.jpg', 'Pajo', 'Kamatis', NULL, NULL, '1231-2312-4124-1231', 'Pending', 'Mandaue', 'Active');

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
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`voteID`, `candidateID`, `UsersID`, `created_at`, `updated_at`, `position`) VALUES
(12, 1, 11, '2021-12-04 23:48:53', '2021-12-04 23:48:53', 'Captain'),
(13, 5, 11, '2021-12-04 23:48:53', '2021-12-04 23:48:53', 'Secretary'),
(14, 7, 11, '2021-12-04 23:48:53', '2021-12-04 23:48:53', 'Purok Leader'),
(15, 8, 11, '2021-12-04 23:48:53', '2021-12-04 23:48:53', 'Treasurer'),
(16, 6, 11, '2021-12-05 11:37:25', '2021-12-05 11:37:25', 'Captain'),
(17, 5, 11, '2021-12-05 11:37:25', '2021-12-05 11:37:25', 'Secretary'),
(18, 7, 11, '2021-12-05 11:37:25', '2021-12-05 11:37:25', 'Purok Leader'),
(19, 8, 11, '2021-12-05 11:37:25', '2021-12-05 11:37:25', 'Treasurer');

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
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UsersID` (`UsersID`);

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
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `UsersID` (`UsersID`);

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
  MODIFY `BarangayID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ereklamo`
--
ALTER TABLE `ereklamo`
  MODIFY `ReklamoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `purok`
--
ALTER TABLE `purok`
  MODIFY `PurokID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`);

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
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`candidateID`) REFERENCES `candidates` (`candidateID`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
