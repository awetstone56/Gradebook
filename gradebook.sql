-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2016 at 11:31 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `classID` int(2) NOT NULL,
  `type` varchar(20) NOT NULL,
  `assignmentName` varchar(20) NOT NULL,
  `studentID` int(3) NOT NULL,
  `grade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`classID`, `type`, `assignmentName`, `studentID`, `grade`) VALUES
(20, 'Homework', 'hw1', 4, 70),
(20, 'Homework', 'hw1', 5, 90),
(20, 'Homework', 'hw1', 6, 97),
(20, 'Homework', 'hw2', 4, 89),
(20, 'Homework', 'hw2', 5, 88),
(20, 'Homework', 'hw2', 6, 84),
(20, 'Quizzes', 'quiz1', 4, 95),
(20, 'Quizzes', 'quiz1', 5, 98),
(20, 'Quizzes', 'quiz1', 6, 90),
(20, 'Quizzes', 'quiz2', 4, 88),
(20, 'Quizzes', 'quiz2', 5, 92),
(20, 'Quizzes', 'quiz2', 6, 100),
(20, 'Tests', 'final', 4, 97),
(20, 'Tests', 'final', 5, 93),
(20, 'Tests', 'final', 6, 87),
(20, 'Tests', 'midterm', 4, 89),
(20, 'Tests', 'midterm', 5, 94),
(20, 'Tests', 'midterm', 6, 42),
(21, 'Homework', 'hw1', 4, 100),
(21, 'Homework', 'hw1', 5, 100),
(21, 'Homework', 'hw1', 6, 100),
(21, 'Homework', 'hw2', 4, 92),
(21, 'Homework', 'hw2', 5, 93),
(21, 'Homework', 'hw2', 6, 0),
(21, 'projects', 'project1', 4, 80),
(21, 'Projects', 'project1', 5, 95),
(21, 'Projects', 'project1', 6, 85),
(21, 'Projects', 'project2', 4, 100),
(21, 'Projects', 'project2', 5, 100),
(21, 'Projects', 'project2', 6, 100),
(21, 'Tests', 'final', 4, 92),
(21, 'Tests', 'final', 5, 98),
(21, 'Tests', 'final', 6, 99),
(21, 'Tests', 'midterm', 4, 85),
(21, 'Tests', 'midterm', 5, 88),
(21, 'Tests', 'midterm', 6, 97);

-- --------------------------------------------------------

--
-- Table structure for table `assignmenttype`
--

CREATE TABLE `assignmenttype` (
  `classID` int(2) NOT NULL,
  `gradeWorth` int(3) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmenttype`
--

INSERT INTO `assignmenttype` (`classID`, `gradeWorth`, `type`) VALUES
(20, 20, 'Homework'),
(21, 15, 'Homework'),
(21, 40, 'Projects'),
(20, 25, 'Quizzes'),
(20, 55, 'Tests'),
(21, 45, 'Tests');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classID` int(2) NOT NULL,
  `className` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `className`) VALUES
(20, 'Databases'),
(21, 'Networks');

-- --------------------------------------------------------

--
-- Table structure for table `finalgrade`
--

CREATE TABLE `finalgrade` (
  `classID` int(2) NOT NULL,
  `studentID` int(3) NOT NULL,
  `finalGrade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finalgrade`
--

INSERT INTO `finalgrade` (`classID`, `studentID`, `finalGrade`) VALUES
(20, 4, 89.925),
(20, 5, 92.975),
(20, 6, 77.325),
(21, 4, 90.225),
(21, 5, 95.325),
(21, 6, 88.6);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(3) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `name`) VALUES
(6, 'Alex'),
(5, 'Barrett'),
(4, 'Cole');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`classID`,`type`,`assignmentName`,`studentID`),
  ADD KEY `fk of studentID` (`studentID`);

--
-- Indexes for table `assignmenttype`
--
ALTER TABLE `assignmenttype`
  ADD PRIMARY KEY (`type`,`classID`),
  ADD KEY `classID` (`classID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classID`);

--
-- Indexes for table `finalgrade`
--
ALTER TABLE `finalgrade`
  ADD PRIMARY KEY (`classID`,`studentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`classID`,`type`) REFERENCES `assignmenttype` (`classID`, `type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk of studentID` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `assignmenttype`
--
ALTER TABLE `assignmenttype`
  ADD CONSTRAINT `assignmenttype_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
