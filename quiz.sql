-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2019 at 02:59 AM
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
(3, '15CS2201', 'Software Engineering'),
(4, '15CS2202', 'SE');

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
  `hashkey` text,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quesations`
--

INSERT INTO `quesations` (`quesation`, `a_option`, `b_option`, `c_option`, `d_option`, `quesation_marks`, `quesation_answer`, `answer_type`, `hashkey`, `id`) VALUES
('Testing AB', 'A', 'B', 'C', 'A', 20, 'A,B', 'multi', '21c3cb9bf95a4694d1e6c27941f77c79', 5),
('Testing A', 'A', 'B', 'C', 'D', 10, 'A', 'single', '21c3cb9bf95a4694d1e6c27941f77c79', 6);

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
('21c3cb9bf95a4694d1e6c27941f77c79', 'Testing', '4', '02:52:00', '2019-10-26', '2019-10-26', '04:58:00', 2, 20);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `quiz_id` text,
  `time` time DEFAULT NULL,
  `result_id` int(11) NOT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `marks`, `quiz_id`, `time`, `result_id`, `end_time`) VALUES
(160030462, 30, '21c3cb9bf95a4694d1e6c27941f77c79', '02:58:28', 38, '03:18:28');

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
(160030462, 3),
(160030462, 4);

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
(160030462, 'G SAI REVANTH', '160030462', '0336782301486a9ea6a22c659a5dbba4');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `email` varchar(150) NOT NULL,
  `password` text,
  `subject` int(11) DEFAULT NULL,
  `hashkey` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`email`, `password`, `subject`, `hashkey`) VALUES
('gunji.sairevanth@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '73c9384573f333c12acfaaa3c5060151');

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
('gunji.sairevanth@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'teacher', '2e9455b236e79285eb97463d28ae3e26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quesations`
--
ALTER TABLE `quesations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_name`
--
ALTER TABLE `quiz_name`
  ADD PRIMARY KEY (`hash`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `studets`
--
ALTER TABLE `studets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quesations`
--
ALTER TABLE `quesations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
