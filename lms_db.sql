-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 09:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `profile_image`) VALUES
(3, 'rahul', 'rahul@g.com', '$2y$10$ZtMASAIz4T/RW', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(4, 'ram', 'ram@g.com', '$2y$10$xV.4EPkj2QwTw', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(14, 'shiv thakre', 's@gmail.com', '$2y$10$FpfDrfuiz0cdnh4t20QwTueG8KF4iR1waoj1hIFUGcVT.W5zTfenm', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(16, 'steve jobs', 'steve@gmail.com', '$2y$10$OJ3TvsoJncMjHVoq5lSLt.TEg0KdZgO5cQsZPZENrO13p3hAENLeW', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(22, 'Shrutika Munde', 'mundeshrutika7@gmail.com', '$2y$10$UrgHLmZwsprx4KAT9f8/COL9VSwNepgGJmmf5D9WxjlgG9gNIRN42', 'uploads/wallpaperflare.com_wallpaper (3).jpg'),
(25, 'RSL ADMIN', 'admin@gmail.com', '$2y$10$LzdZRCwHea97YB3U0KzkkeFdCf/cNZQTMR6TfQuAHyQ.2lwnz2XeS', 'uploads/pic-1.jpg'),
(27, 'Elkana Sampath', 'elkanasampath@gmail.com', '$2y$10$lXlT6mYZQt4s4CdeCkoOVOcCuG9BoVus0.zUsQ1QHztVhODslGnWC', 'uploads/bgk2.jpg'),
(28, 'Arun Nair', 'arun@gmail.com', '$2y$10$M42qgouk/aaCEoEIPuuXheXuN94Uxj7/0ErakSr8wBk33NkzOaaL6', 'uploads/kakashi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin_student_course`
--

CREATE TABLE `admin_student_course` (
  `id` int(10) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_student_course`
--

INSERT INTO `admin_student_course` (`id`, `student_id`, `name`, `course_name`) VALUES
(17, '44', 'Elkana Sampath', 'Java Development'),
(21, '43', 'RSL Student', 'Java Development'),
(22, '23', 'Allan Manoah', 'Java Development'),
(25, '40', 'Shrutika Munde', 'Java Development'),
(27, '40', 'Shrutika Munde', 'Machine Learning'),
(28, '43', 'RSL Student', 'Machine Learning'),
(29, '43', 'RSL Student', 'Web Development');

-- --------------------------------------------------------

--
-- Table structure for table `assign_admin`
--

CREATE TABLE `assign_admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_admin`
--

INSERT INTO `assign_admin` (`id`, `admin_id`, `name`, `course_name`) VALUES
(6, '', 'Elkana Sampath', 'Java Development'),
(11, '27', 'Elkana Sampath', 'Machine Learning'),
(18, '25', 'RSL ADMIN', 'Java Development'),
(19, '22', 'Shrutika Munde', 'Java Development'),
(20, '25', 'RSL ADMIN', 'Machine Learning'),
(23, '25', 'RSL ADMIN', 'Web Development');

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `id` int(10) NOT NULL,
  `course_name` varchar(25) NOT NULL,
  `course_description` varchar(25) NOT NULL,
  `course_day` int(11) NOT NULL,
  `course_link` varchar(25) NOT NULL,
  `practical_link` varchar(25) NOT NULL,
  `completed` varchar(50) NOT NULL,
  `uploaded_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`id`, `course_name`, `course_description`, `course_day`, `course_link`, `practical_link`, `completed`, `uploaded_file`) VALUES
(1, 'Web Development', 'HTML Basics', 1, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/Blk1.png'),
(8, 'Web Development', 'html tags', 2, 'https://www.youtube.com/', 'https://www.youtube.com/', '', ''),
(9, 'Java Development', 'day 1 ', 1, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/65cf211a90afe_IDE1.png'),
(10, 'Java Development', 'day 2', 2, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/65cf22a5b6356_Hand gesture3.png'),
(11, 'Java Development', 'day 3', 3, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/65cf22ba50781_Extraction4.png'),
(12, 'Java Development', 'day 4', 4, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/AtmVr.jpg'),
(13, 'Java Development', 'day 5', 5, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/Extraction1.png'),
(14, 'Java Development', 'day 6', 6, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/blk.png'),
(15, 'Java Development', 'day 7', 7, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/Blk1.png'),
(16, 'Java Development', 'day 8', 8, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/chainsaw-man-bloody-makima-jk6xs8rc4zqibr8f.jpg'),
(24, 'Java Development', 'day 9', 9, 'https://www.youtube.com/', 'https://www.youtube.com/', '', ''),
(25, 'Java Development', 'Day 10', 10, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(26, 'HTML Course', 'Day 1', 1, 'https://www.youtube.com/', 'https://www.udemy.com/', '', ''),
(27, 'HTML Course', 'Day 2', 2, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(28, 'HTML Course', 'Day 3', 3, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(29, 'HTML Course', 'Day 4', 4, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(30, 'HTML Course', 'Day 5', 5, 'https://www.udemy.com/', 'https://www.w3schools.com', '', ''),
(31, 'Machine Learning', 'Day 1', 1, 'https://www.udemy.com/', 'https://www.udemy.com/', '1', 'uploads/Munde-Resume-.pdf'),
(32, 'Machine Learning', 'Day 2', 2, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(33, 'Machine Learning', 'Day 3', 3, 'https://www.udemy.com/', 'https://www.youtube.com/', '', ''),
(34, 'Machine Learning', 'Day 4', 4, 'https://www.youtube.com/', 'https://www.youtube.com/', '', ''),
(35, 'Machine Learning', 'Day 5', 5, 'https://www.youtube.com/', 'https://www.udemy.com/', '', ''),
(36, 'Machine Learning', 'Day 6', 6, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(37, 'Web Development', 'Html elements', 3, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(38, 'Web Development', 'HTML', 4, 'https://www.youtube.com/', 'https://www.youtube.com/', '', ''),
(39, 'Web Development', 'Html Day 5', 5, 'https://www.udemy.com/', 'https://www.udemy.com/', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `create_course`
--

CREATE TABLE `create_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `course_duration` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `create_course`
--

INSERT INTO `create_course` (`course_id`, `course_name`, `course_description`, `course_duration`) VALUES
(1, 'HTML Course', 'HTML Complete course', '18'),
(14, 'Machine Learning', 'Learn ML', '30'),
(15, 'Java Development', 'Learn Java', '20'),
(16, 'Web Development', 'Web Development', '15');

-- --------------------------------------------------------

--
-- Table structure for table `register_student`
--

CREATE TABLE `register_student` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_student`
--

INSERT INTO `register_student` (`id`, `name`, `profession`, `email`, `password`, `image_path`) VALUES
(23, 'Allan Manoah', 'backend developer', 'allan@gmail.com', '$2y$10$31y/C6ApO8MSeiJXCBVLKuUosmNvypBT.bqr8zhwdTCW1chapnTPq', 'uploads/chainsaw-man-bloody-makima-jk6xs8rc4zqibr8f.jpg'),
(29, 'Joseph Damo', 'Analyst', 'joseph@gmail.com', '$2y$10$nPEaaenBkl4byXt7pHI/Du1OIJuD/79ygOb8fyPdDDdiIsEVfCMAu', 'uploads/makima1.png'),
(30, 'Monika Sharma', 'full stack developer', 'monika@gmail.com', '$2y$10$8ACP00XQv0uPQesOCUS1J.b5cJ8adaA9oibYPNmFLKZ4Lubyucp.O', 'uploads/pexels-giorgio-de-angelis-1413412.jpg'),
(31, 'Mitali H', 'backend developer', 'mitali@gmail.com', '$2y$10$ZIRKFDCkQGGlXBrSPF0RN.mr1wwf6d9bWH6h6X9C1LNfICZ21ti5O', 'uploads/Makima.600.3804369.jpg'),
(40, 'Shrutika Munde', 'full stack developer', 'mundeshrutika7@gmail.com', '$2y$10$mpK49H79xsBOb3zveugWw.1d.jJsmMf/jEcE7x17fG96KPY0LW2VS', 'uploads/shrutika photo.jpeg'),
(43, 'RSL Student', 'full stack developer', 'student@gmail.com', '$2y$10$KIfWtw9x0bL26NcOHvruQuEXMHn5bWE892Xjnx9TfuGLCuggBCmua', 'uploads/pic-1.jpg'),
(44, 'Elkana Sampath', 'full stack developer', 'elkanasampath@gmail.com', '$2y$10$5xjLpGChA1deFgsgNKdGeOzMKdACaUDQyPjuPPeFpCiptcTA2vVWC', 'uploads/603117_original_1843x4096.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'superadmin@gmail.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_student_course`
--
ALTER TABLE `admin_student_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_admin`
--
ALTER TABLE `assign_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_course`
--
ALTER TABLE `create_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `register_student`
--
ALTER TABLE `register_student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `admin_student_course`
--
ALTER TABLE `admin_student_course`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `assign_admin`
--
ALTER TABLE `assign_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `create_course`
--
ALTER TABLE `create_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `register_student`
--
ALTER TABLE `register_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
