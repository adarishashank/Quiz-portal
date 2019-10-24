-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2019 at 02:37 PM
-- Server version: 5.7.27-0ubuntu0.19.04.1
-- PHP Version: 7.2.19-0ubuntu0.19.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--
CREATE DATABASE IF NOT EXISTS `quiz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quiz`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` text,
  `course_name` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`) VALUES
(3, '15CS2201', 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `quesations`
--

CREATE TABLE `quesations` (
  `quesation` text,
  `a_option` text,
  `b_option` text,
  `c_option` text,
  `d_option` text,
  `quesation_marks` int(11) DEFAULT NULL,
  `quesation_answer` text,
  `answer_type` text,
  `hashkey` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quesations`
--

INSERT INTO `quesations` (`quesation`, `a_option`, `b_option`, `c_option`, `d_option`, `quesation_marks`, `quesation_answer`, `answer_type`, `hashkey`) VALUES
('<h1> element in HTML defines ', 'Headings', 'Hyperlink', 'HyperText', 'Html-text', 5, 'A', 'single', '8c9819adca12d1e7b6ac7359a3ab5c11'),
('Intensity of a color can be described through ', 'Hue', 'Saturation', 'Lightness', 'Grayscale', 5, 'B', 'single', '8c9819adca12d1e7b6ac7359a3ab5c11'),
('HTML links are defined with <a> tag and address is specified by attribute ', 'hlink', 'href', 'src', 'src-link', 5, 'B', 'single', '8c9819adca12d1e7b6ac7359a3ab5c11'),
('Testing', 'A', 'B', 'C', 'D', 10, 'B,C', 'multi', '69b3ed6c36548508589324bc024edf7e');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_name`
--

CREATE TABLE `quiz_name` (
  `hash` varchar(150) NOT NULL,
  `quiz_name` text,
  `course_name` text,
  `start_time` time DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `max_quesation` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_name`
--

INSERT INTO `quiz_name` (`hash`, `quiz_name`, `course_name`, `start_time`, `start_date`, `end_date`, `end_time`, `max_quesation`, `duration`) VALUES
('69b3ed6c36548508589324bc024edf7e', 'Testing', '3', '17:30:00', '2019-10-23', '2019-10-23', '18:00:00', 1, 20),
('8c9819adca12d1e7b6ac7359a3ab5c11', 'HTML', '3', '02:51:00', '2019-10-23', '2019-10-23', '04:30:00', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `quiz_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `student_id` int(11) DEFAULT NULL,
  `course` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`student_id`, `course`) VALUES
(160030462, 3);

-- --------------------------------------------------------

--
-- Table structure for table `studets`
--

CREATE TABLE `studets` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `password` text,
  `hashkey` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studets`
--

INSERT INTO `studets` (`id`, `name`, `password`, `hashkey`) VALUES
(160030462, 'G SAI REVANTH', '160030462', 'c8c1f62129441afffc1451f9e77e2791');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(150) NOT NULL,
  `password` text,
  `role` text,
  `hashkey` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `role`, `hashkey`) VALUES
('gunji.sairevanth@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'teacher', '068529cc8d7b50db6f8fe2de13f86b66');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_name`
--
ALTER TABLE `quiz_name`
  ADD PRIMARY KEY (`hash`);

--
-- Indexes for table `studets`
--
ALTER TABLE `studets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
