-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2023 at 08:39 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `Allocated`
--

CREATE TABLE `Allocated` (
  `reg_no` varchar(32) DEFAULT NULL,
  `yearAllocated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Allocated`
--

INSERT INTO `Allocated` (`reg_no`, `yearAllocated`) VALUES
('BIT/16/SS/001', 3),
('219', 1);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `reg_no` varchar(15) NOT NULL,
  `semester` set('One','Two','All') NOT NULL,
  `year` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`reg_no`, `semester`, `year`) VALUES
('219', 'All', 1),
('BIS/15/PE/006', 'All', 1),
('BIT/16/SS/001', 'One', 3);

-- --------------------------------------------------------

--
-- Table structure for table `applicationperiod`
--

CREATE TABLE `applicationperiod` (
  `openingDate` date DEFAULT NULL,
  `closingDate` date DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicationperiod`
--

INSERT INTO `applicationperiod` (`openingDate`, `closingDate`, `status`) VALUES
('2023-05-01', '2023-05-31', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `disability`
--

CREATE TABLE `disability` (
  `reg_no` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `filename` varchar(255) NOT NULL
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

CREATE TABLE `home` (
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
('BIS/15/PE/006', '', 'Kalumba', 'Lilongwe'),
('201953293003', '', 'malili', 'Lilongwe'),
('2019', '', 'malili', 'Lilongwe'),
('2019', '', 'malili', 'Lilongwe'),
('2019', '', 'malili', 'Lilongwe'),
('2019', '', 'malili', 'Lilongwe'),
('2020', '', 'malili', 'Lilongwe'),
('219', '', 'gggg', 'sa'),
('2023', '', 'mz', 'nzuzu');

-- --------------------------------------------------------

--
-- Table structure for table `hosteltbl`
--

CREATE TABLE `hosteltbl` (
  `hostel_id` int(11) NOT NULL,
  `hostel_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `date_received` date DEFAULT NULL,
  `time_received` time DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `reg_no`, `message`, `viewed`, `date_received`, `time_received`, `sender`) VALUES
(4, 'BIS/15/PE/006', 'You have successfully applied for accomodation', 1, '2021-07-31', NULL, NULL),
(5, 'BIS/15/PE/006', 'This is testing testing', 1, '2021-07-21', NULL, NULL),
(6, 'BIS/15/PE/006', 'You have successfully booked a room', 0, '2021-08-02', '10:20:49', 'No Reply'),
(7, 'BIS/15/PE/006', 'You have successfully booked a room', 1, '2021-08-02', '10:25:51', 'No Reply'),
(8, 'BIT/16/SS/001', 'You have successfully applied for accomodation', 0, NULL, NULL, NULL),
(9, 'BIT/16/SS/001', 'You have successfully booked a room', 1, '2021-08-04', '03:49:39', 'No Reply'),
(10, '219', 'You have successfully applied for Accommodation', 1, '2023-05-03', '10:38:57', 'No Reply'),
(11, 'BIT/16/SS/001', 'Your application for accommodation has been successful. You have been allocated', 0, '2023-05-12', '02:41:33', 'No Reply'),
(12, 'BIT/16/SS/001', 'Your application for accommodation has been successful. You have been allocated', 0, '2023-05-12', '07:32:11', 'No Reply'),
(13, '219', 'Your application for accommodation has been successful. You have been allocated', 1, '2023-05-12', '07:32:42', 'No Reply'),
(14, '219', 'You have successfully booked a room', 0, '2023-05-12', '07:33:16', 'No Reply');

-- --------------------------------------------------------

--
-- Table structure for table `residence`
--

CREATE TABLE `residence` (
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
('BIS/15/PE/006', 'Zingwangwa', 'Pa Dream Center', 'Blantyre'),
('201953293003', 'Lilongwe', 'Nchinji road', 'Lilongwe'),
('2019', 'Lilongwe', 'Nchinji road', 'Lilongwe'),
('2019', 'Lilongwe', 'Nchinji road', 'Lilongwe'),
('2019', 'Lilongwe', 'Nchinji road', 'Lilongwe'),
('2019', 'Lilongwe', 'Nchinji road', 'Lilongwe'),
('2020', 'Lilongwe', 'Nchinji road', 'Lilongwe'),
('219', 'Lilongwe', 'Nchinji road', 'Lilongwe'),
('2023', 'china', 'nanjing', 'pokchu');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `hostel_id` int(11) NOT NULL,
  `room_name` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `hostel_id`, `room_name`) VALUES
(1, 1, 'A235'),
(2, 1, 'A234'),
(3, 2, 'B101');

-- --------------------------------------------------------

--
-- Table structure for table `roombookingperiod`
--

CREATE TABLE `roombookingperiod` (
  `openingDate` date DEFAULT NULL,
  `closingDate` date DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roombookingperiod`
--

INSERT INTO `roombookingperiod` (`openingDate`, `closingDate`, `status`) VALUES
('2023-05-01', '2023-05-31', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `roombookings`
--

CREATE TABLE `roombookings` (
  `id` int(11) NOT NULL,
  `studentId` varchar(15) NOT NULL,
  `roomId` varchar(10) NOT NULL,
  `hostelId` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roombookings`
--

INSERT INTO `roombookings` (`id`, `studentId`, `roomId`, `hostelId`) VALUES
(5, 'BIT/16/SS/001', '2', 'hostelId'),
(4, 'BIS/15/PE/006', '1', 'hostelId'),
(6, '219', '3', 'hostelId');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `reg_no` varchar(15) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `maiden_name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `gender` set('Male','Female') NOT NULL,
  `program` varchar(50) NOT NULL,
  `dob` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `firstname`, `maiden_name`, `surname`, `gender`, `program`, `dob`) VALUES
('BIT/16/SS/001', 'Fray', 'M', 'Hepen', 'Male', 'BIT', '1994-04-25'),
('BIS/15/PE/005', 'Ellias', 'E', 'Mgala', 'Male', 'BIS', '2017-05-26'),
('2020', 'sasu', 'golden', 'frank', 'Male', 'CSC', '1993-02-24'),
('2019', 'Golden', 'gxx', 'Sasu', 'Male', 'computer science', '2000-04-23'),
('219', 'ndzalama', 'xxx', 'zz', 'Male', 'CSC', '2000-04-24'),
('2023', 'Matthews', 'nyasulu', 'hh', 'Female', 'MET', '2023-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) DEFAULT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `surname` varchar(32) DEFAULT NULL,
  `role` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `surname`, `role`) VALUES
(NULL, 'admin', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, 'Admin'),
(NULL, 'supa', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, 'Supervisor'),
(NULL, '2019', '25d55ad283aa400af464c76d713c07ad', 'Golden', 'Sasu', 'Student'),
(NULL, '2020', '25d55ad283aa400af464c76d713c07ad', 'sasu', 'frank', 'Student'),
(NULL, '219', '25d55ad283aa400af464c76d713c07ad', 'ndzalama', 'zz', 'Student'),
(NULL, '2023', '25d55ad283aa400af464c76d713c07ad', 'Matthews', 'hh', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`reg_no`,`semester`,`year`);

--
-- Indexes for table `disability`
--
ALTER TABLE `disability`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `hosteltbl`
--
ALTER TABLE `hosteltbl`
  ADD PRIMARY KEY (`hostel_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `roombookings`
--
ALTER TABLE `roombookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hosteltbl`
--
ALTER TABLE `hosteltbl`
  MODIFY `hostel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roombookings`
--
ALTER TABLE `roombookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
