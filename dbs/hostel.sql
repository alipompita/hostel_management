-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 06, 2021 at 04:47 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `reg_no` varchar(15) NOT NULL,
  `semester` set('One','Two','All') NOT NULL,
  `year` int(1) NOT NULL,
  PRIMARY KEY (`reg_no`,`semester`,`year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`reg_no`, `semester`, `year`) VALUES
('BIS/15/PE/006', 'All', 1),
('BIT/16/SS/001', 'One', 3);

-- --------------------------------------------------------

--
-- Table structure for table `disability`
--

DROP TABLE IF EXISTS `disability`;
CREATE TABLE IF NOT EXISTS `disability` (
  `reg_no` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`reg_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disability`
--

INSERT INTO `disability` (`reg_no`, `name`, `filename`) VALUES
('BLT/12/NE/001', 'Lame', 'steps.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

DROP TABLE IF EXISTS `home`;
CREATE TABLE IF NOT EXISTS `home` (
  `reg_no` varchar(15) NOT NULL,
  `village` varchar(20) NOT NULL,
  `ta` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`reg_no`, `village`, `ta`, `district`) VALUES
('BIT/16/SS/001', '', 'Chitonga', 'Zomba'),
('BIS/15/PE/005', '', 'Kalumba', 'Lilongwe'),
('BIS/15/PE/006', '', 'Kalumba', 'Lilongwe');

-- --------------------------------------------------------

--
-- Table structure for table `hosteltbl`
--

DROP TABLE IF EXISTS `hosteltbl`;
CREATE TABLE IF NOT EXISTS `hosteltbl` (
  `hostel_id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_name` varchar(20) NOT NULL,
  PRIMARY KEY (`hostel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hosteltbl`
--

INSERT INTO `hosteltbl` (`hostel_id`, `hostel_name`) VALUES
(1, 'Ndirande A'),
(2, 'Ndirande B'),
(3, 'Nyika A'),
(4, 'Nyika B'),
(5, 'Kapeni A'),
(6, 'Kapeni B'),
(7, 'Hilidi');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `date_received` date DEFAULT NULL,
  `time_received` time DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `reg_no`, `message`, `viewed`, `date_received`, `time_received`, `sender`) VALUES
(4, 'BIS/15/PE/006', 'You have successfully applied for accomodation', 1, '2021-07-31', NULL, NULL),
(5, 'BIS/15/PE/006', 'This is testing testing', 1, '2021-07-21', NULL, NULL),
(6, 'BIS/15/PE/006', 'You have successfully booked a room', 0, '2021-08-02', '10:20:49', 'No Reply'),
(7, 'BIS/15/PE/006', 'You have successfully booked a room', 1, '2021-08-02', '10:25:51', 'No Reply'),
(8, 'BIT/16/SS/001', 'You have successfully applied for accomodation', 0, NULL, NULL, NULL),
(9, 'BIT/16/SS/001', 'You have successfully booked a room', 1, '2021-08-04', '03:49:39', 'No Reply');

-- --------------------------------------------------------

--
-- Table structure for table `residence`
--

DROP TABLE IF EXISTS `residence`;
CREATE TABLE IF NOT EXISTS `residence` (
  `reg_no` varchar(15) NOT NULL,
  `place` varchar(20) NOT NULL,
  `street` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `residence`
--

INSERT INTO `residence` (`reg_no`, `place`, `street`, `district`) VALUES
('BIT/16/SS/001', 'Chichiri', 'Polyechnic', 'Blantyre'),
('BIS/15/PE/005', 'Zingwangwa', 'Zingwangwa', 'Blantyre'),
('BIS/15/PE/006', 'Zingwangwa', 'Pa Dream Center', 'Blantyre');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_id` int(11) NOT NULL,
  `room_name` varchar(15) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `hostel_id`, `room_name`) VALUES
(1, 1, 'A235'),
(2, 1, 'A234'),
(3, 2, 'B101');

-- --------------------------------------------------------

--
-- Table structure for table `roombookings`
--

DROP TABLE IF EXISTS `roombookings`;
CREATE TABLE IF NOT EXISTS `roombookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(15) NOT NULL,
  `roomId` varchar(10) NOT NULL,
  `hostelId` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roombookings`
--

INSERT INTO `roombookings` (`id`, `studentId`, `roomId`, `hostelId`) VALUES
(5, 'BIT/16/SS/001', '2', 'hostelId'),
(4, 'BIS/15/PE/006', '1', 'hostelId');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `reg_no` varchar(15) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `maiden_name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `gender` set('Male','Female') NOT NULL,
  `program` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  PRIMARY KEY (`reg_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `firstname`, `maiden_name`, `surname`, `gender`, `program`, `dob`) VALUES
('BIT/16/SS/001', 'Fray', 'M', 'Hepen', 'Male', 'BIT', '1994-04-25'),
('BIS/15/PE/005', 'Ellias', 'E', 'Mgala', 'Male', 'BIS', '2017-05-26'),
('BIS/15/PE/006', 'Ellias', 'Jan', 'Mgala', 'Male', 'BIS', '2014-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('BIT/16/SS/001', '202cb962ac59075b964b07152d234b70'),
('BIS/15/PE/005', 'c20ad4d76fe97759aa27a0c99bff6710'),
('BIS/15/PE/006', 'c20ad4d76fe97759aa27a0c99bff6710');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
