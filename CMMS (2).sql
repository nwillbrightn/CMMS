-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2024 at 09:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CMMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `CMMSSession`
--

CREATE TABLE `CMMSSession` (
  `sessId` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `ipAddress` varchar(50) NOT NULL,
  `userAgent` varchar(1000) NOT NULL,
  `sessionDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `documentID` int(11) NOT NULL,
  `filePath` varchar(100) NOT NULL,
  `meetingCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EmployeeDetails`
--

CREATE TABLE `EmployeeDetails` (
  `empID` int(11) NOT NULL,
  `fName` varchar(15) NOT NULL,
  `sName` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwords` varchar(20) NOT NULL,
  `department` varchar(15) NOT NULL,
  `rank` varchar(10) DEFAULT NULL,
  `dateRegistered` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `EmployeeDetails`
--

INSERT INTO `EmployeeDetails` (`empID`, `fName`, `sName`, `username`, `passwords`, `department`, `rank`, `dateRegistered`) VALUES
(1, '', '', 'admin', '12Terry', '', 'admin', '2024-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meetingId` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `descriptions` varchar(400) NOT NULL,
  `department` varchar(15) NOT NULL,
  `tarehe` varchar(10) NOT NULL,
  `muda` varchar(10) NOT NULL,
  `endTime` varchar(10) NOT NULL,
  `venue` varchar(20) NOT NULL,
  `meetingCode` varchar(25) NOT NULL,
  `dateCreated` date NOT NULL DEFAULT current_timestamp(),
  `location` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `rId` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `meetingCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `viewed`
--

CREATE TABLE `viewed` (
  `invitationId` int(11) NOT NULL,
  `meetingCode` varchar(25) NOT NULL,
  `viewed` varchar(20) NOT NULL,
  `dateViewed` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CMMSSession`
--
ALTER TABLE `CMMSSession`
  ADD PRIMARY KEY (`sessId`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`documentID`);

--
-- Indexes for table `EmployeeDetails`
--
ALTER TABLE `EmployeeDetails`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meetingId`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`rId`);

--
-- Indexes for table `viewed`
--
ALTER TABLE `viewed`
  ADD PRIMARY KEY (`invitationId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CMMSSession`
--
ALTER TABLE `CMMSSession`
  MODIFY `sessId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `documentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EmployeeDetails`
--
ALTER TABLE `EmployeeDetails`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meetingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `rId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `viewed`
--
ALTER TABLE `viewed`
  MODIFY `invitationId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
