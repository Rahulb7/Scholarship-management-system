-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 07:54 PM
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
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`) VALUES
(2, 'admin@gmail.com', '$2y$10$iox6BT09JzfhnxQHSDvqruZfsso8dC9G6dKZLE3s9fKLSHAt7mFl6', 'Rahul', 'C', 'Bindrani');

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
(35, 14, 20, '2019-05-06 22:02:09', 'Pending', 'Pending');

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
  `gender` varchar(10) NOT NULL,
  `religion` varchar(20) NOT NULL,
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
(1, 4, 'COOPERATE', '', '', 'phd', '', '', '', '2016-02-05', 5, '0', 'Donec ut pellentesque quam. Proin tincidunt vehicula nisi ut euismod. Praesent molestie accumsan turpis quis gravida. In turpis mauris, pharetra rutrum dapibus id, pellentesque vitae quam. Curabitur ornare, justo quis auctor aliquam, massa augue semper massa, sagittis consectetur turpis odio in augue.', '', '', '', '', '', 'Approved'),
(2, 4, 'Joint Japan/World Bank Graduate Scholarship Program 2019', '', '', 'diploma', '', '', '', '2019-04-25', 10, '2000', 'The World Bank is providing students from India and other World Bank Member Developing Countries an opportunity to apply for Master’s and Postgraduate courses at selected universities of higher education in USA, Africa and Japan; by availing tuition fee waivers and other academic/non-academic benefits (including living expenses and VISA expenses) with this scholarship program. With these scholarships, students will get a chance to channelize their experience in national development programs to attain new skills and contribute to their countries’ social and economic development.', '', '', '', '', '', 'Approved'),
(3, 4, 'abc', 'Gujarat', 'Gujarat', 'postgraduation', 'male', 'Muslim, ', 'science', '2019-04-30', 10, '50% Fees', 'abc', 'abc', 'abc', 'abc', 'abc', 'abc', 'Approved'),
(4, 4, 'Inlaks Scholarships 2019', 'Gujarat', 'Gujarat', 'postgraduation', 'both', 'christian, ', 'merit', '2019-05-16', 100, '50% Fees', 'Inlaks Shivdasani Foundation invites applications from graduates in India who wish to pursue their higher education at top American, European and UK institutions. The Inlaks Scholarships 2019 is an opportunity for students to get a scholarship of up to USD 100,000 for funding requirements including tuition fee. The aim of the scholarship programme is to provide students with exceptional academic talent an opportunity to broaden their vision and improve their skills, thus making them a future vehicle of change in their environment.', 'The scholarship opportunity is open for:Students holding a good first degree from a recognised university (Graduate students)Indian citizens who are a resident of India at the time of application ', 'The selected scholars will receive the following benefits:Full waiver of tuition fee Adequate living expensesOne-way travel expense', 'Follow the below steps to apply:Step 1: Visit the online application portal.\r\nStep 2: Accept the Privacy Policy for Applicants.\r\nStep 3: Provide relevant information including personal information, university education, working experience/projects pursued, proposed programme, references etc.', 'Apply online linkLatest scholarship linkOthers', 'Email: info@inlaksfoundation.org', 'Approved'),
(18, 4, 'abc', 'abc', 'abc', 'class2', 'male', 'hindu, ', 'merit', '2019-04-28', 1, '1', 'a', 'a', 'a', 'a', 'a', 'a', 'Rejected'),
(19, 4, 'MYSY', 'Gujarat', 'Gujarat', 'phd', 'both', 'christian, ', 'merit', '2019-05-11', 10, '50% Fees', 'xyz', 'xyz', 'xyz', 'xyz', 'xyz', 'xyz', 'Approved'),
(20, 4, '2020mysy', 'a', 'a', 'phd', 'male', 'jain, ', 'merit', '2019-06-15', 12, '1200', 'a', 'aa', 'a', 'a', 'a', 'a', 'Approved');

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
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`sigID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `position`) VALUES
(4, 'sig@gmail.com', '$2y$10$J00d19prfCv315fdFK.RpujK9oZw563cAqX0JxVnXikIUBjOCbWwa', 'Arjun', 'C', 'Bindrani', '');

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
(14, 'student@gmail.com', '$2y$10$1RQ3TGDQ/8s4J9xcV/Lbwum63I864U4s0kOqrkE3jsUzlweaa.xsO', 'Dishant', 'N', 'doshi', 'India', 'Male', '1999-02-19', 'Idar', 'Anand', '', '', '', '', '', '8128962439', 'IT', 'GCET'),
(15, 'bindrani.rb7@gmail.com', '$2y$10$RtyJJRSzW7hQnDubxEHgtunvuFBIupozvodSfeQ3wFwsHL0clDqXS', 'Rahul', 'Chandraprakash', 'Bindrani', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', 'G.H.Patel College');

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
  MODIFY `applicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `scholarshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `sigID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
