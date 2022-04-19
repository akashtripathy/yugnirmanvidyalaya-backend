-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2022 at 05:04 PM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u984052071_yug_nirman_vid`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_admission`
--

CREATE TABLE `new_admission` (
  `id` int(11) NOT NULL,
  `phone_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caste` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_school` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_branch` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_aadhar_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_edu_qualification` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_occupation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_annual_income` int(11) DEFAULT NULL,
  `mother_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_aadhar_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_edu_qualification` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_occupation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_annual_income` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_admission`
--

INSERT INTO `new_admission` (`id`, `phone_no`, `name`, `dob`, `gender`, `blood_group`, `nationality`, `caste`, `religion`, `aadhar_no`, `class`, `distance`, `previous_school`, `image`, `address`, `s_branch`, `father_name`, `father_aadhar_no`, `father_edu_qualification`, `father_occupation`, `father_annual_income`, `mother_name`, `mother_aadhar_no`, `mother_edu_qualification`, `mother_occupation`, `mother_annual_income`) VALUES
(1, '8249784899', 'reeta tripathy', '2009-01-01', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Surendra tripathy', NULL, NULL, NULL, NULL, 'Jyotsna', NULL, NULL, NULL, NULL),
(2, '8249784999', 'reeta tripathy', '2009-01-01', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Surendra tripathy', NULL, NULL, NULL, NULL, 'Jyotsna', NULL, NULL, NULL, NULL),
(3, '8249784889', 'reeta tripathy', '2009-01-01', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Surendra tripathy', NULL, NULL, NULL, NULL, 'Jyotsna', NULL, NULL, NULL, NULL),
(5, '9937429462', 'Akash Tripath', '2016-02-01', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Surendra Tripathy', NULL, NULL, NULL, NULL, 'J Tripathy', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_family_info`
--

CREATE TABLE `students_family_info` (
  `id` int(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `father_name` varchar(30) NOT NULL,
  `father_aadhar_no` varchar(250) DEFAULT NULL,
  `father_edu_qualification` text DEFAULT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `father_annual_income` int(11) NOT NULL,
  `mother_name` varchar(30) NOT NULL,
  `mother_aadhar_no` varchar(250) DEFAULT NULL,
  `mother_edu_qualification` text DEFAULT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `mother_annual_income` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_family_info`
--

INSERT INTO `students_family_info` (`id`, `phone_no`, `father_name`, `father_aadhar_no`, `father_edu_qualification`, `father_occupation`, `father_annual_income`, `mother_name`, `mother_aadhar_no`, `mother_edu_qualification`, `mother_occupation`, `mother_annual_income`) VALUES
(21, '8249784125', 'Surendra tripathy', '895455045', '10', 'driver', 100000, 'Jyotsna', '094938573333', '10', 'hw', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_info`
--

CREATE TABLE `students_info` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `nationality` varchar(10) NOT NULL DEFAULT 'INDIAN',
  `caste` varchar(15) NOT NULL,
  `relogion` varchar(10) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `aadhar_no` varchar(250) DEFAULT NULL,
  `class` int(11) NOT NULL,
  `distance` int(100) NOT NULL,
  `previous_school` varchar(250) DEFAULT NULL,
  `image` text NOT NULL,
  `address` text NOT NULL,
  `s_branch` enum('nua sarsara','barahagoda') NOT NULL DEFAULT 'nua sarsara'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_info`
--

INSERT INTO `students_info` (`id`, `name`, `dob`, `gender`, `blood_group`, `nationality`, `caste`, `relogion`, `phone_no`, `aadhar_no`, `class`, `distance`, `previous_school`, `image`, `address`, `s_branch`) VALUES
(32, 'Akash Tripathy', '2004-01-01', 'male', 'O+', 'Indian', 'Brahman', 'Hindu', '8249784125', '8584383983', 2, 5, 'hhh', 'null', 'sarsara', 'nua sarsara');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_table`
--

CREATE TABLE `teacher_table` (
  `id` int(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `subjects_offered` text DEFAULT NULL,
  `qualifications` text NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `role` varchar(15) NOT NULL,
  `account` varchar(10) NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone_no`, `name`, `role`, `account`, `created_at`) VALUES
(1, '8249784125', 'akash tripathy', 'admin', 'active', '2022-03-13 22:06:09'),
(16, '8917370398', 'Hemanta Kumar Mahapatra', 'admin', 'active', '2022-04-16 05:53:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `new_admission`
--
ALTER TABLE `new_admission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `aadhar_no` (`aadhar_no`);

--
-- Indexes for table `students_family_info`
--
ALTER TABLE `students_family_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `father_aadhar_no` (`father_aadhar_no`),
  ADD UNIQUE KEY `mother_aadhar_no` (`mother_aadhar_no`);

--
-- Indexes for table `students_info`
--
ALTER TABLE `students_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `aadhar_no` (`aadhar_no`);

--
-- Indexes for table `teacher_table`
--
ALTER TABLE `teacher_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_no` (`phone_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `new_admission`
--
ALTER TABLE `new_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_family_info`
--
ALTER TABLE `students_family_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students_info`
--
ALTER TABLE `students_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `teacher_table`
--
ALTER TABLE `teacher_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students_family_info`
--
ALTER TABLE `students_family_info`
  ADD CONSTRAINT `students_family_info_ibfk_1` FOREIGN KEY (`phone_no`) REFERENCES `users` (`phone_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students_info`
--
ALTER TABLE `students_info`
  ADD CONSTRAINT `students_info_ibfk_1` FOREIGN KEY (`phone_no`) REFERENCES `users` (`phone_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_table`
--
ALTER TABLE `teacher_table`
  ADD CONSTRAINT `teacher_table_ibfk_1` FOREIGN KEY (`phone_no`) REFERENCES `users` (`phone_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
