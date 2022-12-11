-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 09:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `adminPassword`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Stand-in structure for view `alllogs`
-- (See below for the actual view)
--
CREATE TABLE `alllogs` (
);

-- --------------------------------------------------------

--
-- Table structure for table `libraryinfo`
--

CREATE TABLE `libraryinfo` (
  `ID` int(11) NOT NULL,
  `OccupiedSlots` int(11) NOT NULL,
  `UnoccupiedSlots` int(11) NOT NULL,
  `MaxSlots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libraryinfo`
--

INSERT INTO `libraryinfo` (`ID`, `OccupiedSlots`, `UnoccupiedSlots`, `MaxSlots`) VALUES
(1, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `libraryvisitors`
--

CREATE TABLE `libraryvisitors` (
  `SR_Code` varchar(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libraryvisitors`
--

INSERT INTO `libraryvisitors` (`SR_Code`, `Fullname`, `Status`) VALUES
('19-77909', 'MENDOZA, DRANEM RJ D.', 'ONLINE'),
('19-78869', 'LIWAG, JOHN HENRY B.', 'ONLINE'),
('19-78870', 'RYMAR JAMES LB. LIWAG', 'ONLINE'),
('19-78871', 'NIÑO JOSE B. LIWAG', 'ONLINE');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `ID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`ID`, `StudentID`, `timestamp`, `status`) VALUES
(1, '19-78869', '0000-00-00 00:00:00', ''),
(2, '33333', '2022-12-11 08:49:46', 'sdfghjklkjh');

-- --------------------------------------------------------

--
-- Structure for view `alllogs`
--
DROP TABLE IF EXISTS `alllogs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alllogs`  AS SELECT `logs`.`StudentID` AS `StudentID`, `libraryvisitors`.`Fullname` AS `Fullname`, `logs`.`In` AS `In`, `logs`.`Out` AS `Out` FROM (`logs` join `libraryvisitors` on(`logs`.`StudentID` = `libraryvisitors`.`SR_Code`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `libraryinfo`
--
ALTER TABLE `libraryinfo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `libraryvisitors`
--
ALTER TABLE `libraryvisitors`
  ADD PRIMARY KEY (`SR_Code`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
