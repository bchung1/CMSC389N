-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2018 at 11:07 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Name` varchar(150) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Tag` varchar(20) NOT NULL,
  `Color` char(7) NOT NULL,
  `Time` int(11) NOT NULL,
  `DueDate` date NOT NULL,
  `StartDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Name`, `Username`, `Tag`, `Color`, `Time`, `DueDate`, `StartDate`, `startTime`, `endTime`) VALUES
('414', 'brian', 'Exam', 'blue', 120, '2018-04-16', '2018-04-16', '14:00:00', '00:00:00'),
('414', 'collin', 'Exam', 'blue', 120, '2018-04-16', '2018-04-16', '00:00:00', '00:00:00'),
('CMSC389N Exam\r\n', 'jake', 'Exam', 'blue', 120, '2018-04-03', '2018-04-10', '09:00:00', '11:00:00'),
('CMSC414 Project Meeting', 'jake', 'Meeting', 'blue', 180, '2018-04-05', '2018-04-16', '15:00:00', '17:30:00'),
('CMSC422 Exam', 'jake', 'Exam', 'blue', 120, '2018-04-06', '2018-04-10', '18:00:00', '19:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD UNIQUE KEY `Composite` (`Name`,`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
