-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2016 at 01:29 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs192upsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceptedapps`
--

CREATE TABLE IF NOT EXISTS `acceptedapps` (
  `appID` int(11) NOT NULL,
  `startDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acceptedapps`
--

INSERT INTO `acceptedapps` (`appID`, `startDate`) VALUES
(20, '2016-04-17 18:10:53'),
(30, '2016-04-17 18:18:16'),
(25, '2016-04-17 19:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`) VALUES
(1, 'admin1@up.edu.ph', '$2y$10$mLC7.EDdiQUvKUZbFJOdHOLcDAHa0cyRXzJQU7RhULtBhAJFSLmCC', 'Ruby', 'Von', 'Rails'),
(2, 'admin2@up.edu.ph', '$2y$10$O8ht25FBho9kyuGcgWA6DOONEftwtzfVQykMsc1MfDHlYTCDfVBbC', 'Sa', 'Shi', 'Mii');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `applicationID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `scholarshipID` int(11) NOT NULL,
  `appDate` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `verifiedByAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationID`, `studentID`, `scholarshipID`, `appDate`, `status`, `verifiedByAdmin`) VALUES
(20, 1, 1, '2016-04-03 11:10:03', 1, 0),
(21, 1, 2, '2016-04-08 15:33:27', 1, 0),
(22, 1, 1, '2016-04-14 07:04:40', 1, 0),
(23, 2, 1, '2016-04-17 18:17:59', 1, 0),
(24, 3, 1, '2016-04-14 07:06:06', 1, 0),
(25, 4, 1, '2016-04-14 07:06:06', 1, 0),
(26, 1, 1, '2016-04-15 10:08:23', 1, 0),
(27, 1, 3, '2016-04-15 12:23:15', 1, 0),
(28, 2, 5, '2016-04-17 18:17:59', 1, 0),
(29, 1, 2, '2016-04-17 18:16:34', 1, 0),
(30, 2, 2, '2016-04-17 18:17:59', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `applicationform`
--

CREATE TABLE IF NOT EXISTS `applicationform` (
  `formID` int(11) NOT NULL,
  `scholarshipID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `collegeID` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`collegeID`, `name`) VALUES
(1, 'College of Architecture'),
(2, 'College of Arts and Letters'),
(3, 'Asian Center'),
(4, 'Asian Institute of Tourism'),
(5, 'Cesar E.A. Virata School of Business'),
(6, 'School of Economics'),
(7, 'College of Education'),
(8, 'College of Engineering'),
(9, 'College of Fine Arts'),
(10, 'College of Home Economics'),
(11, 'College of Human Kinetics'),
(12, 'Institute of Islamic Studies'),
(13, 'School of Labor and Industrial Relations'),
(14, 'College of Law'),
(15, 'School of Library and Information Studies'),
(16, 'College of Mass Communication'),
(17, 'College of Music'),
(18, 'National College of Public Administration and Governance'),
(19, 'College of Science'),
(20, 'College of Social Sciences and Philosophy'),
(21, 'College of Social Work and Community Development'),
(22, 'School of Statistics'),
(23, 'School of Urban and Regional Planning'),
(24, 'UP Diliman Extension Program in Olongapo'),
(25, 'UP Diliman Extension Program in Pampanga'),
(26, 'Archaeological Studies Program'),
(27, 'Technology Management Center');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE IF NOT EXISTS `dept` (
  `deptID` int(11) NOT NULL,
  `collegeID` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`deptID`, `collegeID`, `name`) VALUES
(1, 1, 'N/A'),
(2, 2, 'Department of Art Studies'),
(3, 2, 'Department of English and Comparative Literature'),
(4, 2, 'Department of European Languages'),
(5, 2, 'Departamento ng Filipino at Panitikan ng Pilipinas'),
(6, 2, 'Department of Speech Communication and Theatre Arts'),
(7, 3, 'N/A'),
(8, 4, 'N/A'),
(9, 5, 'Department of Business Administration'),
(10, 5, 'Department of Accounting and Finance'),
(11, 6, 'N/A'),
(12, 7, 'N/A'),
(13, 8, 'Institute of Civil Engineering'),
(14, 8, 'Department of Chemical Engineering'),
(15, 8, 'Department of Computer Science'),
(16, 8, 'Institute of Electrical and Electronics Engineering'),
(17, 8, 'Department of Geodetic Engineering'),
(18, 8, 'Department of Industrial Engineering and Operations Research'),
(19, 8, 'Department of Mechanical Engineering'),
(20, 8, 'Department of Mining, Metallurgical, and Materials Engineering'),
(21, 8, 'Energy Engineering Program'),
(22, 8, 'Environmental Engineering Program'),
(23, 9, 'Department of Studio Arts'),
(24, 9, 'Department of Theory'),
(25, 9, 'Department of Visual Communication'),
(26, 9, 'CFA Graduate Program'),
(27, 10, 'Department of Clothing, Textiles and Interior Design'),
(28, 10, 'Department of Family Life and Child Development'),
(29, 10, 'Department of Food Science and Nutrition'),
(30, 10, 'Department of Home Economics Education'),
(31, 10, 'Department of Hotel, Restaurant and Institution Management'),
(32, 11, 'Department of Physical Education'),
(33, 11, 'Department of Sports Science'),
(34, 11, 'Graduate Studies Program'),
(35, 12, 'N/A'),
(36, 13, 'N/A'),
(37, 14, 'N/A'),
(38, 15, 'N/A'),
(39, 16, 'Department of Broadcast Communication'),
(40, 16, 'Department of Communication Research'),
(41, 16, 'Film Institute'),
(42, 16, 'Department of Journalism'),
(43, 16, 'Department of Graduate Studies'),
(44, 17, 'N/A'),
(45, 18, 'N/A'),
(46, 19, 'Institute of Biology'),
(47, 19, 'Institute of Chemistry'),
(48, 19, 'Institute of Environmental Science and Meteorology'),
(49, 19, 'Institute of Mathematics'),
(50, 19, 'National Institute of Molecular Biology and Biotechnology'),
(51, 19, 'Marine Science Institute'),
(52, 19, 'National Institute of Geological Sciences'),
(53, 19, 'National Institute of Physics'),
(54, 19, 'Materials Science and Engineering Program'),
(55, 20, 'Department of Anthropology'),
(56, 20, 'Department of Geography'),
(57, 20, 'Departamento ng Kasaysayan'),
(58, 20, 'Departamento ng Linggwistiks'),
(59, 20, 'Department of Philosophy'),
(60, 20, 'Department of Political Science'),
(61, 20, 'Department of Psychology'),
(62, 20, 'Department of Sociology'),
(63, 20, 'Population Institute'),
(64, 21, 'Department of Community Development'),
(65, 21, 'Department of Social Work'),
(66, 21, 'Department of Women and Development Studies'),
(67, 21, 'Doctor of Social Development Program'),
(68, 22, 'N/A'),
(69, 23, 'N/A'),
(70, 24, 'N/A'),
(71, 25, 'N/A'),
(72, 26, 'N/A'),
(73, 27, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `fieldname` varchar(255) NOT NULL,
  `formID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rejectedapps`
--

CREATE TABLE IF NOT EXISTS `rejectedapps` (
  `appID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rejectedapps`
--

INSERT INTO `rejectedapps` (`appID`) VALUES
(22),
(26),
(28);

-- --------------------------------------------------------

--
-- Table structure for table `released`
--

CREATE TABLE IF NOT EXISTS `released` (
  `appID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `released`
--

INSERT INTO `released` (`appID`, `status`) VALUES
(20, 1),
(30, 1),
(22, 0),
(25, 1),
(28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE IF NOT EXISTS `scholarship` (
  `scholarshipID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `benefactor` varchar(255) NOT NULL,
  `appDeadline` date NOT NULL,
  `numofGrantees` int(11) NOT NULL,
  `signatoryOrder` varchar(255) NOT NULL,
  `description` varchar(4095) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`scholarshipID`, `name`, `benefactor`, `appDeadline`, `numofGrantees`, `signatoryOrder`, `description`) VALUES
(1, 'COOPERATE', 'OIL', '2016-02-05', 5, '1,2,3,4', 'Donec ut pellentesque quam. Proin tincidunt vehicula nisi ut euismod. Praesent molestie accumsan turpis quis gravida. In turpis mauris, pharetra rutrum dapibus id, pellentesque vitae quam. Curabitur ornare, justo quis auctor aliquam, massa augue semper massa, sagittis consectetur turpis odio in augue.'),
(2, 'MOVE UP', 'OIL', '2016-02-05', 10, '2,4', 'In scelerisque magna nunc, id lacinia lacus porta blandit. Etiam id mollis magna. Sed vitae eros feugiat, lacinia lectus at, bibendum turpis. Fusce auctor massa in enim lacinia, iaculis pharetra elit tempor.'),
(3, 'Research/Creative Work Presentation in International Conferences', 'OIL', '2016-02-05', 6, '2,3,4', 'Nunc eu placerat sem. Mauris tellus metus, aliquam a mi et, gravida tincidunt enim. Mauris mollis tellus ipsum, eget cursus diam interdum sit amet.'),
(4, '', '', '0000-00-00', 0, '', 'Integer ac tellus velit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam convallis sem eget velit porttitor interdum.'),
(5, 'World Experts Lecture Series', 'OIL', '2016-02-05', 15, '2,4', 'Duis sed gravida justo. Donec posuere dictum eros vel scelerisque. Nullam quis congue ligula.'),
(12, 'JASSO', 'OILD-OVCAA', '2016-03-31', 15, '2,3,1', 'Aliquam vel eros nec erat porttitor lobortis sed ac purus. Maecenas suscipit ultrices aliquam. Sed aliquam, est id dictum pretium, ipsum lorem varius sapien, at porta dolor nisi vel lorem.'),
(13, 'RUSSE', 'OILD', '2016-03-30', 10, '1,3,5,8,10,6', 'Donec tempus eros arcu, nec blandit lorem tincidunt vitae. Curabitur consectetur porta faucibus. Aenean aliquam velit et tellus maximus pulvinar.'),
(14, 'FREES', 'OIL', '2016-03-23', 10, '3,6,9,4', 'Etiam non tincidunt sapien. Pellentesque tempor porttitor sem, et malesuada neque mattis aliquet. Vivamus egestas, velit at molestie maximus, nisi nunc rhoncus metus, nec suscipit metus quam a tellus.');

-- --------------------------------------------------------

--
-- Table structure for table `scholarshipsig`
--

CREATE TABLE IF NOT EXISTS `scholarshipsig` (
  `sigID` int(11) NOT NULL,
  `scholarshipID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signatory`
--

CREATE TABLE IF NOT EXISTS `signatory` (
  `sigID` int(11) NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`sigID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `position`) VALUES
(1, 'rvazanza@up.edu.ph', '$2y$10$5l7zH/fsluykrbzsJaiyE.1Q50C9UxzJMalSy8MDQTZN36fo4qbyq', 'Rhodora', 'V', 'Azanza', 'Assistant Vice-President for Academic Affairs and Director, OIL'),
(2, 'gpconcepcion@up.edu.ph', '$2y$10$Lge6w8PhcEmkcKGjMtlQNeyIrnpIvw3k24jgtsETqcndBvZ1thoN.', 'Gisela', 'P', 'Concepcion', 'Vice-President for Academic Affairs'),
(3, 'aepascual@up.edu.ph', '$2y$10$yqghqBcF436lDKMDjEiMRu3HKaPKlrDpI4Zedpcu1H7i6Yu1KHZbu', 'Alfredo', 'E', 'Pascual', 'President'),
(4, 'acmatias@up.edu.ph', '$2y$10$1trYzYng631T5wM4OKOxkOmT7srm8CWNB22sD4SU0yuyRRvF9XvlG', 'Aura', 'C', 'Matias', 'Dean, College of Engineering'),
(5, 'dlconcepcion@up.edu.ph', '$2y$10$JpXDxn/aNjlynmzk8SXBIexLQWiagNvwtVLgOtcHaSju6YqI0rxnq', 'Danilo', 'L', 'Concepcion', 'Dean, College of Law'),
(6, 'jsbuenconsejo@up.edu.ph', '$2y$10$388OK514LsmZkJqnjEUV/OHHhMW24CMQwFjlB9QiXlO.NH/bVH6yy', 'Jose', 'S', 'Buenconsejo', 'Dean, College of Music'),
(7, 'mvmendoza@up.edu.ph', '$2y$10$xnDJLSu8jAwDO2lu/xcib.BwE6FFdVl4E49Wy.K/akQ5lAG3lDQBq', 'Maria Fe', 'Villamejor', 'Mendoza', 'Dean, National College of Public Administration and Governance'),
(8, 'jpsale@up.edu.ph', '$2y$10$jjbzJaueF4d79IW3kLjZj.RwnaqGA4B6C0NW2Pu5jQToJzEtl1Cy6', 'Jonathan', 'P', 'Sale', 'Dean, School of Labor and Industrial Relations'),
(9, 'kbobile@up.edu.ph', '$2y$10$tIkQeNOZZDW4.e0.xE.EPepMaIE5odTHRk1zk8HQ6SM12AwgHDGTq', 'Kathleen Lourdes', 'B', 'Obile', 'Dean, School of Library and Information Studies'),
(10, 'ocsolon@up.edu.ph', '$2y$10$0GdhEQ.AQESzhHtGbrmeCuCENTBc6lmSbx.OUC3YXDaKc4e0n.qfC', 'Orville', 'C', 'Solon', 'Dean, School of Economics');

-- --------------------------------------------------------

--
-- Table structure for table `sigreturn`
--

CREATE TABLE IF NOT EXISTS `sigreturn` (
  `appID` int(11) NOT NULL,
  `returnedBy` int(11) NOT NULL,
  `returnedTo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sigstatus`
--

CREATE TABLE IF NOT EXISTS `sigstatus` (
  `sigID` int(11) NOT NULL,
  `applicationID` int(11) NOT NULL,
  `sStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sigstatus`
--

INSERT INTO `sigstatus` (`sigID`, `applicationID`, `sStatus`) VALUES
(1, 20, 1),
(2, 20, 1),
(2, 21, 1),
(4, 21, 0),
(1, 26, 1),
(1, 22, 1),
(2, 27, 1),
(3, 27, 1),
(4, 27, 1),
(3, 20, 1),
(4, 20, 1),
(2, 22, 0),
(2, 26, 0),
(1, 24, 1),
(2, 24, 1),
(3, 24, 1),
(4, 24, 1),
(2, 29, 1),
(4, 29, 1),
(2, 30, 1),
(4, 30, 1),
(1, 25, 1),
(2, 25, 1),
(3, 25, 1),
(4, 25, 1),
(2, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
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
  `presMunBrgy` varchar(255) DEFAULT NULL,
  `presProvCity` varchar(255) DEFAULT NULL,
  `presRegion` varchar(255) DEFAULT NULL,
  `permStreetAddr` varchar(255) DEFAULT NULL,
  `permMunBrgy` varchar(255) DEFAULT NULL,
  `permProvCity` varchar(255) DEFAULT NULL,
  `permRegion` varchar(255) DEFAULT NULL,
  `contactNo` int(20) DEFAULT NULL,
  `dept` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `nationality`, `gender`, `birthDate`, `birthPlace`, `presStreetAddr`, `presMunBrgy`, `presProvCity`, `presRegion`, `permStreetAddr`, `permMunBrgy`, `permProvCity`, `permRegion`, `contactNo`, `dept`, `college`) VALUES
(1, 'gggryffindor', '$2y$10$exXHDn2t/KOr3gFGgxApduw8TS.T/jMlQBTu5GtPB/UpoULIzm532', 'Cyan', 'G', 'Gryffindor', 'Filipino', 'Male', '1986-01-14', 'Manila', '123 ABC Street', 'DEF ', 'GHI City', 'JKL', 'same', 'same', 'same', 'same', 123456, 'Department of Computer Science ', 'College of Engineering '),
(2, 'ptregarde@up.edu.ph', '$2y$10$U57Dlt742pJ504DmkVIuZurVAjmClBQ6mIGvcaPvitey4/9E/h0jm', 'Patricia Ann', 'Torres', 'Regarde', 'Filipino', 'Female', '1997-06-05', 'Manila', '6132 Osias Street', 'Poblacion', 'Makati City', 'NCR', 'same', 'same', 'same', 'same', 123456, 'Department of Computer Science ', 'College of Engineering'),
(3, 'hhhufflepuff@up.edu.ph', '$2y$10$mEDnq1oGVI1s.Eelp.9xDe/rqJEJvJIsAqC/eHvYSRLATxfcPmwt6', 'Helga', 'H', 'Hufflepuff', 'Filipino', 'Female', '1992-09-02', 'Manila', '123 ABC Street', 'DEF', 'GHI City', 'JKL', 'same', 'same', 'same', 'same', 123456, 'Department of Computer Science', 'College of Engineering'),
(4, 'rrravenclaw@up.edu.ph', '$2y$10$sla8w/GTYg9c/cZVc7/g2uHgzATxfw5F7V3.YlKuVZDGUIR1WoXky', 'Rowena', 'R', 'Ravenclaw', 'Filipino', 'Female', '1995-07-19', 'Manila', '123 ABC Street', 'DEF', 'GHI City', 'JKL', '456 MNO Street ', 'PQR', 'STU City', 'VWX', 1234567, 'Institute of Civil Engineering', 'College of Engineering'),
(5, 'ssslytherin@up.edu.ph', '$2y$10$zZQeUxXYNPWQgv2z0TxnYuFkpfqA/BClISGArFiafz4aOFwkQZ8Mm', 'Salazar', 'S', 'Slytherin', 'Filipino', 'Male', '1986-06-28', 'Manila', '123 ABC Street', 'DEF', 'GHI City', 'JKL', 'same ', 'same', 'same', 'same', 123456, 'Electrical and Electronics Engineering Institute', 'College of Engineering'),
(6, 'ssnape@up.edu.ph', '$2y$10$7DpJ0aY2PL.zcF6fxAKmAu6RWeN/.FEV12nSSL7qi1LGcVyGcNtry', 'Severus', '', 'Snape', 'Filipino', 'Male', '1992-10-02', 'Manila', '123 ABC Street', 'DEF ', 'GHI City', 'JKL', 'same', 'same', 'same', 'same', 123456, 'Department of Industrial Engineering and Operations Research', 'College of Engineering'),
(7, 'nscamander@up.edu.ph', '$2y$10$MP8GocRrtGxYyxVO8A/udOgus8JfdRK8vHKh1/Xt5vJcgBY7.VaRq', 'Newt', '', 'Scamander', 'Filipino', 'Male', '1995-07-19', 'Manila', '123 ABC Street', 'DEF ', 'GHI City', 'JKL', 'same', 'same', 'same', 'same', 1234567, 'Department of Industrial Engineering and Operations Research', 'College of Engineering'),
(8, 'sblack@up.edu.ph', '$2y$10$HKxB1cyLdJT2g41OIIjeUO0NIHokAz119ZEPZQN2io6UI8AfN1R3K', 'Sirius', '', 'Black', 'Filipino', 'Male', '1989-08-26', 'Manila', '123 ABC Street', 'DEF', 'GHI City', 'JKL', 'same', 'same', 'same', 'same', 1234567, 'Department of Mechanical Engineering', 'College of Engineering'),
(9, 'llovegood@up.edu.ph', '$2y$10$jmodR6ON20YQFzb6UBgVP.vEtMqXFy8mR4WAAb6PEBZe4X.JdYpdS', 'Luna', '', 'Lovegood', 'Filipino', 'Female', '1994-01-05', 'Manila', '123 ABC Street', 'DEF', 'GHI City', 'JKL', 'same', 'same', 'same', 'same', 1234567, 'Department of Mechanical Engineering', 'College of Engineering'),
(10, 'mmcgonagall', '$2y$10$2C2vP5XidXK9mc1wOuF9AeIZwGG3Z23jif8Mb2u4l0Z04ABUXH55S', 'Minerva', '', 'McGonagall', 'Filipino', 'Female', '1980-06-27', 'Manila', '123 ABC Street', 'DEF', 'GHI City', 'JKL', 'same', 'same', 'same', 'same', 1234567, 'Department of Mining, Metallurgical and Materials Engineering', 'College of Engineering'),
(16, 'peter@up.edu.ph', '$2y$10$d60RWDF5FP4fp.xzHtDeU.NwWyuLN.yeCZ/c9lYydGV.UDaTkHEzm', 'Peter', 'Lol', 'Vee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Institute of Electrical and Electronics Engineering', 'College of Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `studentscholarship`
--

CREATE TABLE IF NOT EXISTS `studentscholarship` (
  `ssID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `scholarshipID` int(11) NOT NULL,
  `startDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentscholarship`
--

INSERT INTO `studentscholarship` (`ssID`, `studentID`, `scholarshipID`, `startDate`, `endDate`) VALUES
(1, 2, 1, '2016-02-19 10:50:23', '2017-02-19 10:50:23'),
(2, 9, 5, '2016-02-19 11:34:26', '2017-02-19 11:34:26'),
(3, 9, 5, '2016-02-19 11:34:26', '2017-02-19 11:34:26'),
(4, 1, 1, '2016-02-28 19:23:19', '2017-02-28 19:23:19'),
(5, 3, 1, '2016-02-28 19:24:06', '2017-02-28 19:24:06'),
(6, 5, 3, '2016-03-01 07:37:45', '2017-03-01 07:37:45'),
(7, 4, 4, '2016-03-01 07:37:46', '2017-03-01 07:37:46'),
(8, 1, 1, '2016-03-05 22:43:18', '2017-03-05 22:43:18'),
(9, 1, 4, '2016-03-05 22:47:44', '2017-03-05 22:47:44'),
(10, 1, 4, '2016-03-05 22:47:44', '2017-03-05 22:47:44'),
(11, 3, 1, '2016-03-18 06:49:43', '2017-03-18 06:49:43'),
(12, 1, 4, '2016-03-18 12:21:30', '2017-03-18 12:21:30'),
(13, 1, 4, '2016-03-18 12:21:30', '2017-03-18 12:21:30'),
(14, 1, 4, '2016-03-18 12:21:30', '2017-03-18 12:21:30'),
(15, 1, 4, '2016-03-18 12:21:30', '2017-03-18 12:21:30'),
(16, 1, 1, '2016-03-31 21:01:28', '2017-03-31 21:01:28'),
(17, 1, 2, '2016-04-03 06:42:03', '2017-04-03 06:42:03'),
(18, 1, 2, '2016-04-03 06:42:03', '2017-04-03 06:42:03'),
(19, 1, 2, '2016-04-03 07:17:43', '2017-04-03 07:17:43'),
(20, 1, 2, '2016-04-03 07:17:43', '2017-04-03 07:17:43'),
(21, 1, 2, '2016-04-03 07:17:43', '2017-04-03 07:17:43'),
(22, 1, 4, '2016-04-03 09:52:55', '2017-04-03 09:52:55'),
(23, 1, 4, '2016-04-03 09:52:55', '2017-04-03 09:52:55'),
(24, 1, 4, '2016-04-03 09:52:55', '2017-04-03 09:52:55'),
(25, 1, 4, '2016-04-03 09:52:55', '2017-04-03 09:52:55'),
(26, 1, 4, '2016-04-03 09:52:55', '2017-04-03 09:52:55'),
(27, 1, 5, '2016-04-03 09:54:06', '2017-04-03 09:54:06'),
(28, 1, 5, '2016-04-03 09:54:06', '2017-04-03 09:54:06'),
(29, 1, 5, '2016-04-03 09:54:06', '2017-04-03 09:54:06'),
(30, 1, 5, '2016-04-03 09:54:06', '2017-04-03 09:54:06'),
(31, 1, 5, '2016-04-03 09:54:06', '2017-04-03 09:54:06'),
(32, 1, 5, '2016-04-03 09:54:06', '2017-04-03 09:54:06'),
(33, 1, 1, '2016-04-03 11:10:03', '2017-04-03 11:10:03'),
(34, 1, 2, '2016-04-08 15:33:28', '2017-04-08 15:33:28'),
(35, 1, 2, '2016-04-08 15:33:28', '2017-04-08 15:33:28'),
(36, 1, 1, '2016-04-14 07:04:41', '2017-04-14 07:04:41'),
(37, 1, 1, '2016-04-14 07:04:41', '2017-04-14 07:04:41'),
(38, 1, 1, '2016-04-14 07:04:41', '2017-04-14 07:04:41'),
(39, 2, 1, '2016-04-14 07:06:06', '2017-04-14 07:06:06'),
(40, 3, 1, '2016-04-14 07:06:06', '2017-04-14 07:06:06'),
(41, 4, 1, '2016-04-14 07:06:06', '2017-04-14 07:06:06'),
(42, 1, 1, '2016-04-15 10:08:23', '2017-04-15 10:08:23'),
(43, 1, 1, '2016-04-15 10:08:23', '2017-04-15 10:08:23'),
(44, 1, 1, '2016-04-15 10:08:23', '2017-04-15 10:08:23'),
(45, 1, 1, '2016-04-15 10:08:23', '2017-04-15 10:08:23'),
(46, 1, 3, '2016-04-15 12:23:15', '2017-04-15 12:23:15'),
(47, 1, 3, '2016-04-15 12:23:15', '2017-04-15 12:23:15'),
(48, 1, 3, '2016-04-15 12:23:15', '2017-04-15 12:23:15'),
(49, 1, 3, '2016-04-15 12:23:15', '2017-04-15 12:23:15'),
(50, 1, 3, '2016-04-15 12:23:15', '2017-04-15 12:23:15'),
(51, 1, 2, '2016-04-17 18:16:34', '2017-04-17 18:16:34'),
(52, 1, 2, '2016-04-17 18:16:34', '2017-04-17 18:16:34'),
(53, 1, 2, '2016-04-17 18:16:34', '2017-04-17 18:16:34'),
(54, 1, 2, '2016-04-17 18:16:34', '2017-04-17 18:16:34'),
(55, 1, 2, '2016-04-17 18:16:34', '2017-04-17 18:16:34'),
(56, 1, 2, '2016-04-17 18:16:34', '2017-04-17 18:16:34'),
(57, 2, 2, '2016-04-17 18:17:59', '2017-04-17 18:17:59'),
(58, 2, 2, '2016-04-17 18:17:59', '2017-04-17 18:17:59'),
(59, 2, 2, '2016-04-17 18:17:59', '2017-04-17 18:17:59');

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
-- Indexes for table `applicationform`
--
ALTER TABLE `applicationform`
  ADD PRIMARY KEY (`formID`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`collegeID`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`deptID`);

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
-- Indexes for table `studentscholarship`
--
ALTER TABLE `studentscholarship`
  ADD PRIMARY KEY (`ssID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `applicationID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `applicationform`
--
ALTER TABLE `applicationform`
  MODIFY `formID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `collegeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `deptID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `scholarshipID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `sigID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `studentscholarship`
--
ALTER TABLE `studentscholarship`
  MODIFY `ssID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
