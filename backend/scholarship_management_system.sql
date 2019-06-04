-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2019 at 07:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--
CREATE DATABASE IF NOT EXISTS `sms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sms`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `contact`, `status`) VALUES
(2, 'admin@gmail.com', '$2y$10$iox6BT09JzfhnxQHSDvqruZfsso8dC9G6dKZLE3s9fKLSHAt7mFl6', 'Rahul', 'C', 'Bindrani', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `applicationID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `scholarshipID` int(11) NOT NULL,
  `appDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) DEFAULT 'Pending',
  `verifiedBySignatory` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationID`, `studentID`, `scholarshipID`, `appDate`, `status`, `verifiedBySignatory`) VALUES
(20, 15, 1, '2019-04-15 00:28:11', 'Rejected', 'Rejected'),
(30, 14, 2, '2019-05-25 11:23:29', 'Rejected', 'Rejected'),
(31, 15, 2, '2019-04-15 00:31:55', 'Processing', 'Approved'),
(32, 14, 4, '2019-04-15 11:00:57', 'Processing', 'Approved'),
(33, 4, 2, '2019-04-15 08:45:48', 'Pending', 'Pending'),
(34, 14, 19, '2019-04-15 15:39:26', 'Processing', 'Approved'),
(35, 14, 20, '2019-05-06 22:02:09', 'Pending', 'Pending'),
(36, 43, 20, '2019-05-31 20:22:24', 'Pending', 'Pending'),
(37, 43, 21, '2019-05-31 20:25:46', 'Pending', 'Pending'),
(38, 43, 22, '2019-06-02 19:54:13', 'Pending', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `upMail` varchar(255) NOT NULL,
  `num` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`upMail`, `num`) VALUES
('dishantd999@gmail.com', 744014),
('dishantd999@gmail.com', 287736),
('dishantd999@gmail.com', 851718),
('dishantd999@gmail.com', 517402),
('dishantd999@gmail.com', 979640);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `scholarshipID` int(11) NOT NULL,
  `sigID` int(11) NOT NULL,
  `schname` varchar(255) NOT NULL,
  `schlocation` varchar(255) NOT NULL,
  `schlocationfrom` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `religion` varchar(55) NOT NULL,
  `sch` varchar(30) NOT NULL,
  `appDeadline` date NOT NULL,
  `granteesNum` int(11) NOT NULL,
  `funding` varchar(20) NOT NULL,
  `description` varchar(4095) NOT NULL,
  `eligibility` varchar(4095) NOT NULL,
  `benefits` varchar(4095) NOT NULL,
  `apply` varchar(4095) NOT NULL,
  `links` varchar(1024) NOT NULL,
  `contact` varchar(1024) NOT NULL,
  `adminapproval` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`scholarshipID`, `sigID`, `schname`, `schlocation`, `schlocationfrom`, `degree`, `gender`, `religion`, `sch`, `appDeadline`, `granteesNum`, `funding`, `description`, `eligibility`, `benefits`, `apply`, `links`, `contact`, `adminapproval`) VALUES
(22, 8, 'abc', 'abcccc', 'abccccccc', 'graduation', 'male', 'christian', 'select', '2019-06-30', 12, '1200', 'abc', 'abc', 'abc', 'abc', 'abc', 'xyz', 'Pending'),
(23, 8, 'india', 'india', 'india', 'class8', 'male+female', 'Parsi, ', 'visual_art', '2019-07-20', 12, '1200', 'india', 'india', 'india', 'india', 'india', 'india', 'Pending'),
(24, 8, 'xyz', 'xyz', 'xyz', 'phd', 'male+female', 'Muslim', 'sports_talent', '2019-06-30', 12, '1200', 'xyzxyz', 'xyz', 'xyz', 'xyz', 'xyz', 'xyz', 'Pending'),
(25, 8, 'pqr', 'pqr', 'pqr', 'postgraduation', 'female', 'Sikh', 'science_maths_based', '2019-06-29', 12, '1200', 'pqr', 'pqr', 'pqr', 'pqr', 'pqr', 'pqr', 'Pending'),
(26, 8, 'def', 'def', 'def', 'class12passed', 'male+female', 'jain, ', 'means_based', '2019-06-22', 12, '1200', 'def', 'def', 'def', 'def', 'def', 'def', 'Pending'),
(27, 8, 'my', 'my', 'my', 'class1', 'male+female', 'jain<br/>', 'merit_based', '2019-06-23', 12, '1200', 'my', 'my', 'my', 'myu', 'my', 'my', 'Pending'),
(28, 8, 'ok', 'ok', 'ok', 'class1', 'male', 'hindu, ', 'merit_based', '2019-06-23', 12, '1200', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'Pending'),
(29, 8, 'ppp', 'ppp', 'ppp', 'class1', 'male+female', 'buddhism,christian,Muslim', 'merit_based', '2019-06-30', 12, '1200', 'ppp', 'ppp', 'ppp', 'ppp', 'ppp', 'ppp', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `signatory`
--

CREATE TABLE `signatory` (
  `sigID` int(11) NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`sigID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `position`, `contact`, `status`) VALUES
(7, 'rahul.bindrani.poorna@gmail.com', '$2y$10$D151khT07zy3cx7BAgvkUu84zY5icZZ3tAqvsD6V/iXzPXL/.b6CK', '', '', '', '', '', 'active'),
(8, 'arjunbd7@gmail.com', '$2y$10$Fjlsx3FEEunWm1dfwODvYeFhzNhAoMkaDq6iBHgGLaT62ebnRq4zO', 'Arjun', 'Chandraprakash', 'Bindrani', 'CEO', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `birthPlace` varchar(255) DEFAULT NULL,
  `presStreetAddr` varchar(255) DEFAULT NULL,
  `presProvCity` varchar(255) DEFAULT NULL,
  `presRegion` varchar(255) DEFAULT NULL,
  `permStreetAddr` varchar(255) DEFAULT NULL,
  `permProvCity` varchar(255) DEFAULT NULL,
  `permRegion` varchar(255) DEFAULT NULL,
  `contactNo` varchar(20) DEFAULT NULL,
  `dept` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `nationality`, `gender`, `birthDate`, `birthPlace`, `presStreetAddr`, `presProvCity`, `presRegion`, `permStreetAddr`, `permProvCity`, `permRegion`, `contactNo`, `dept`, `college`) VALUES
(43, 'bindrani.rb7@gmail.com', '$2y$10$kaD0yN3fRZu9es6to1nVp.OK.dFE9Wp0peeHiEOVntlGH7EjKCi/i', 'Rahul', 'Chandraprakash', 'Bindrani', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(44, 'dishantd999@gmail.com', '$2y$10$fvzm.tlEs2VAqCph0Sr3TuQnp.2PjPW2LUYtxBdHdkhz4C7/FRuWu', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(45, 'rahulbindrani123@gmail.com', '$2y$10$RTrzzwxxBQU3LP5M4HmlHuYqSFWUhJpOiQNiwG3NNGabBQyxQ2cqm', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `verify_signup`
--

CREATE TABLE `verify_signup` (
  `upMail` varchar(255) NOT NULL,
  `action` int(2) NOT NULL DEFAULT '0',
  `num` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verify_signup`
--

INSERT INTO `verify_signup` (`upMail`, `action`, `num`) VALUES
('bindrani.rb7@gmail.com', 1, 637939),
('dishantd999@gmail.com', 1, 501750),
('rahulbindrani123@gmail.com', 1, 327349),
('rahul.bindrani.poorna@gmail.com', 1, 421896),
('arjunbd7@gmail.com', 1, 868906);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`applicationID`);

--
-- Indexes for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`scholarshipID`);

--
-- Indexes for table `signatory`
--
ALTER TABLE `signatory`
  ADD PRIMARY KEY (`sigID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `applicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `scholarshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `sigID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
