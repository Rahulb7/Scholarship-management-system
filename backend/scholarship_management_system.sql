-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2019 at 02:04 PM
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
  `sigID` int(11) DEFAULT NULL,
  `scholarshipID` int(11) NOT NULL,
  `appDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `appstatus` varchar(20) NOT NULL DEFAULT 'Pending',
  `verifiedBySignatory` varchar(20) NOT NULL DEFAULT 'Pending',
  `previous_appstatus` varchar(20) NOT NULL,
  `previous_verifiedBySignatory` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationID`, `studentID`, `sigID`, `scholarshipID`, `appDate`, `appstatus`, `verifiedBySignatory`, `previous_appstatus`, `previous_verifiedBySignatory`) VALUES
(38, 43, 8, 22, '2019-06-06 13:58:58', 'inactive', 'currently blocked', 'Rejected', 'Rejected'),
(39, 43, 8, 23, '2019-06-06 13:40:15', 'Processing', 'Approved', 'Processing', 'Approved'),
(40, 43, 8, 25, '2019-06-06 11:20:19', 'Pending', 'Pending', 'Pending', 'Pending'),
(41, 43, 7, 31, '2019-06-07 16:17:26', 'Pending', 'Pending', 'Pending', 'Pending'),
(42, 43, 8, 30, '2019-06-07 16:16:50', 'Pending', 'Pending', 'Pending', 'Pending'),
(43, 43, 8, 26, '2019-06-07 08:51:11', 'Pending', 'Pending', '', ''),
(44, 44, 8, 23, '2019-06-07 11:20:22', 'Pending', 'Pending', '', '');

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
  `adminapproval` varchar(20) NOT NULL,
  `previous_adminapproval` varchar(20) NOT NULL,
  `schstatus` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`scholarshipID`, `sigID`, `schname`, `schlocation`, `schlocationfrom`, `degree`, `gender`, `religion`, `sch`, `appDeadline`, `granteesNum`, `funding`, `description`, `eligibility`, `benefits`, `apply`, `links`, `contact`, `adminapproval`, `previous_adminapproval`, `schstatus`) VALUES
(22, 8, 'abc', 'abcccc', 'abccccccc', 'graduation', 'male', 'christian', 'select', '2019-06-30', 12, '1200', 'rahul', 'abc', 'OKKKK', 'abc', 'abc', 'xyz', 'Pending', 'Approved', 'active'),
(23, 8, 'india', 'india', 'india', 'class8', 'male+female', 'Parsi, ', 'visual_art', '2019-07-20', 12, '1200', 'india', 'india', 'india', 'india', 'india', 'india', 'Approved', 'Approved', 'active'),
(24, 8, 'xyz', 'xyz', 'xyz', 'phd', 'male+female', 'Muslim', 'sports_talent', '2019-06-30', 12, '1200', 'xyzxyz', 'xyz', 'xyz', 'xyz', 'xyz', 'xyz', 'Pending', 'Pending', 'active'),
(25, 8, 'pqr', 'pqr', 'pqr', 'postgraduation', 'female', 'Sikh', 'science_maths_based', '2019-06-29', 12, '1200', 'pqr', 'pqr', 'pqr', 'pqr', 'pqr', 'pqr', 'Approved', 'Approved', 'active'),
(26, 8, 'def', 'def', 'def', 'class12passed', 'male+female', 'jain, ', 'means_based', '2019-06-22', 12, '1200', 'def', 'def', 'def', 'def', 'def', 'def', 'Approved', 'Approved', 'active'),
(27, 8, 'my', 'my', 'my', 'class1', 'male+female', 'jain<br/>', 'merit_based', '2019-06-23', 12, '1200', 'my', 'my', 'my', 'myu', 'my', 'my', 'Rejected', 'Rejected', 'active'),
(28, 8, 'ok', 'ok', 'ok', 'class1', 'male', 'hindu, ', 'merit_based', '2019-06-23', 12, '1200', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'Approved', 'Pending', 'active'),
(29, 8, 'ppp', 'ppp', 'ppp', 'class1', 'male+female', 'buddhism,christian,Muslim', 'merit_based', '2019-06-30', 12, '1200', 'ppp', 'ppp', 'ppp', 'ppp', 'ppp', 'ppp', 'Pending', 'Pending', 'active'),
(30, 8, 'dish', 'dish', 'dish', 'class1', 'female', 'buddhism,christian,hindu', 'merit_based', '2019-06-16', 100, '1500', 'dish <a href=\"https://www.google.com/\">click here</a>', 'dish', 'dish', 'dish', 'dish', 'dish', 'Approved', 'Approved', 'active'),
(31, 7, 'University of Bradford Half Free Academic Excellence Scholarship 2019 ', 'Gujarat', 'Gujarat', 'postgraduation', 'male+female', 'buddhism,christian,hindu,jain,Muslim,Parsi,Sikh', 'merit_based', '2019-07-06', 100, '50% of the fees', 'The University of Bradford, UK invites applications for the Half Free Academic Excellence Scholarship 2019 from undergraduate and postgraduate applicants. These scholarships are generated with an objective to celebrate the academic excellence of talented students. The selected scholars will have the opportunity to avail a scholarship worth half of the tuition fee. A total of 10 scholarships will be provided.', 'The following applicants are eligible to apply for the scholarship program:\r\n1. Should enter the respective programme in Year 0 (Foundation) or Year 1\r\n2. Must be applying for a full-time degree either undergraduate or postgraduate taught (not research)\r\n3. Must have been made an offer to study at the University of Bradford from September 2019\r\n4. Must score the equivalent of AAA in A-levels (for undergraduate study) or a first-class honours degree (for postgraduate study)\r\n5. Must be paying the tuition fee without any external financial aidOnly open to students whose courses will be based in Bradford\r\nNote: Any external or distance learning courses are not eligible for this award.', 'The selected scholars will be eligible for a scholarship worth half of the tuition fee.\r\nNote: The scholarship will be paid in subsequent years if progressing with an average of 60% or above.', 'Follow the steps to apply: \r\nStep 1: Download the application form by visiting the scholarship page. \r\nStep 2: Fill in the form with the required details. \r\nStep 3: Attach the necessary documents. \r\nStep 4: Submit the application form to the below address before the deadline (3 June 2019): Fees and Finance Team\r\nThe Hub\r\nStudent Registry Services\r\nUniversity of Bradford\r\nRichmond Road\r\nBradford\r\nBD7 1DP\r\nStep 5: Alternatively, the duly filled application can also be sent by email to scholarships@bradford.ac.uk with the subject HALF FEE ACADEMIC SCHOLARSHIPS.', 'Original website\r\n\r\nApply online link', 'University of Bradford,\r\nRichmond Road,\r\nBradford BD7 1DP, UK\r\n\r\nPhone: 01274 236637\r\nEmail: scholarships@bradford.ac.uk', 'Approved', 'Approved', 'active'),
(32, 7, 'abc abc abc abc', 'abc', 'abc', 'class3', 'female', 'buddhism,christian,hindu', 'merit_based', '2019-06-30', 100, '1000', 'abc', 'abc', 'abc', 'abc', 'abc', 'abc', 'Pending', 'Pending', 'active'),
(33, 8, 'ok', 'ok', 'ok', 'class5', 'male', 'buddhism,christian,hindu,jain,Muslim', 'means_based', '2019-06-29', 12, '2000', 'ok', 'ok', 'ok', 'ook', 'ok', 'ok', 'Pending', '', 'active');

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
  `organization/university` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`sigID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `organization/university`, `position`, `contact`, `status`) VALUES
(7, 'rahul.bindrani.poorna@gmail.com', '$2y$10$D151khT07zy3cx7BAgvkUu84zY5icZZ3tAqvsD6V/iXzPXL/.b6CK', 'Rahul', 'C', 'Bindrani', '', 'Manager', '', 'active'),
(8, 'arjunbd7@gmail.com', '$2y$10$Fjlsx3FEEunWm1dfwODvYeFhzNhAoMkaDq6iBHgGLaT62ebnRq4zO', 'Arjun', 'Chandraprakash', 'Bindrani', '', 'CEO', '', 'active');

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
  `college` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `nationality`, `gender`, `birthDate`, `birthPlace`, `presStreetAddr`, `presProvCity`, `presRegion`, `permStreetAddr`, `permProvCity`, `permRegion`, `contactNo`, `dept`, `college`, `status`) VALUES
(43, 'bindrani.rb7@gmail.com', '$2y$10$kaD0yN3fRZu9es6to1nVp.OK.dFE9Wp0peeHiEOVntlGH7EjKCi/i', 'Rahul', 'Chandraprakash', 'Bindrani', 'India', 'Male', '0000-00-00', 'Ahmedabad', '', '', '', '', '', '', '', '', '', 'active'),
(44, 'dishantd999@gmail.com', '$2y$10$fvzm.tlEs2VAqCph0Sr3TuQnp.2PjPW2LUYtxBdHdkhz4C7/FRuWu', 'Dishant', '', 'doshi', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'active'),
(45, 'rahulbindrani123@gmail.com', '$2y$10$RTrzzwxxBQU3LP5M4HmlHuYqSFWUhJpOiQNiwG3NNGabBQyxQ2cqm', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'active'),
(47, 'internwithicon@internshala.com', '$2y$10$RTJSf0Mzp8s5rsqNXWhZyuwRoGkoE3/2j3Gw5BRIexlxCQITwKmdq', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'active');

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
('arjunbd7@gmail.com', 1, 868906),
('internwithicon@internshala.com', 0, 133692);

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
  MODIFY `applicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `scholarshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `sigID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
