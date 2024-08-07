-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 12:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminn`
--

CREATE TABLE `adminn` (
  `adminnID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminn`
--

INSERT INTO `adminn` (`adminnID`, `firstName`, `lastName`, `gender`, `email`, `pwd`, `created_at`) VALUES
(1001, 'william', 'me', 'male', '1234@gmail.com', '1234', '2024-07-15 16:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent') NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `classID`, `studentID`, `date`, `status`, `duration`) VALUES
(1, 1, 3, '2024-07-25', 'present', 10),
(2, 1, 10022, '2024-07-25', 'present', 10),
(3, 1, 3, '2024-07-26', 'absent', 9),
(5, 1, 3, '2024-07-24', 'present', 7),
(6, 1, 1, '2024-07-19', 'present', 6),
(7, 1, 10023, '2024-08-07', 'present', 4),
(8, 1, 10023, '2024-08-14', 'absent', 8);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classID` int(11) NOT NULL,
  `className` varchar(100) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `className`, `departmentID`) VALUES
(1, 'Music Notes', 1),
(2, 'OOP', 2),
(3, 'culture101', 3);

-- --------------------------------------------------------

--
-- Table structure for table `class_versions`
--

CREATE TABLE `class_versions` (
  `versionID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `term` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_versions`
--

INSERT INTO `class_versions` (`versionID`, `classID`, `teacherID`, `term`) VALUES
(1, 1, 1001, 'Fall 2024'),
(2, 2, 1001, 'Fall 2024'),
(3, 3, 1001, 'Fall 2024'),
(4, 1, 1001, 'Semester 3');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departmentID` int(11) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `departmentDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departmentID`, `departmentName`, `departmentDescription`) VALUES
(1, 'Department of Music', 'fun fun fun'),
(2, 'Department of Engineering', 'yeayeayea'),
(3, 'Department of culture', 'culture'),
(4, 'department of arts', 'pictures');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollmentID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `versionID` int(11) NOT NULL,
  `enrollmentDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollmentID`, `studentID`, `versionID`, `enrollmentDate`) VALUES
(1, 3, 1, '2024-07-25 11:00:37'),
(2, 10022, 2, '2024-07-27 13:15:41'),
(3, 10023, 3, '2024-08-07 11:49:32'),
(4, 10023, 4, '2024-08-07 11:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `firstName`, `lastName`, `gender`, `email`, `pwd`, `created_at`) VALUES
(1, 'wiilaim', 'mwaijande', 'male', 'w123@gmail.com', '$2y$10$C58nbhE2I7YqPOJs8R8C8epkyDCzxYfnVGPU0vYdOGFNi5lvmsKbK', '2024-07-15 16:26:47'),
(2, 'james', 'mwaijande', 'male', '123@icloud.com', '$2y$10$nnjGdf9EIlofOF3oYqYIcuylzOvQdih5LO7zS3cbaao.NW.5j/toK', '2024-07-15 19:27:24'),
(3, 'batheal', 'ayisi', 'female', 'ayisi@gmail.com', '$2y$10$XgbD658LckMEGim7lOS3ZeFpe0whwORljXYlSzejoAFAt9f2z0C0q', '2024-07-25 10:52:17'),
(10022, 'fan', 'fan', 'male', 'fan@fan.com', 'fan', '2024-07-25 13:37:19'),
(10023, 'james', 'book', 'male', 'egg@gmail.com', '12345', '2024-08-07 11:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `firstName`, `lastName`, `gender`, `email`, `pwd`, `created_at`) VALUES
(1001, 'Francis', 'Aaron', 'male', 'fm@gmiil.com', '1234', '2024-07-16 17:41:21'),
(1004, 'fan', 'ban', 'male', 'fan12@fan.com', '1234', '2024-08-02 15:47:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminn`
--
ALTER TABLE `adminn`
  ADD PRIMARY KEY (`adminnID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`),
  ADD UNIQUE KEY `unique_attendance` (`classID`,`studentID`,`date`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `class_versions`
--
ALTER TABLE `class_versions`
  ADD PRIMARY KEY (`versionID`),
  ADD KEY `classID` (`classID`),
  ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentID`),
  ADD UNIQUE KEY `departmentName` (`departmentName`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollmentID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `versionID` (`versionID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminn`
--
ALTER TABLE `adminn`
  MODIFY `adminnID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_versions`
--
ALTER TABLE `class_versions`
  MODIFY `versionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10024;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`departmentID`);

--
-- Constraints for table `class_versions`
--
ALTER TABLE `class_versions`
  ADD CONSTRAINT `class_versions_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`),
  ADD CONSTRAINT `class_versions_ibfk_2` FOREIGN KEY (`teacherID`) REFERENCES `teacher` (`teacherID`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`versionID`) REFERENCES `class_versions` (`versionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
