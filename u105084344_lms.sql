-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 09:24 PM
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
-- Database: `u105084344_lms`
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
(14, 'shiv thakre', 's@gmail.com', '$2y$10$FpfDrfuiz0cdnh4t20QwTueG8KF4iR1waoj1hIFUGcVT.W5zTfenm', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(16, 'steve jobs', 'steve@gmail.com', '$2y$10$OJ3TvsoJncMjHVoq5lSLt.TEg0KdZgO5cQsZPZENrO13p3hAENLeW', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(22, 'Shrutika Munde', 'mundeshrutika7@gmail.com', '$2y$10$UrgHLmZwsprx4KAT9f8/COL9VSwNepgGJmmf5D9WxjlgG9gNIRN42', 'uploads/wallpaperflare.com_wallpaper (3).jpg'),
(25, 'RSL ADMIN', 'admin@gmail.com', '$2y$10$LzdZRCwHea97YB3U0KzkkeFdCf/cNZQTMR6TfQuAHyQ.2lwnz2XeS', 'uploads/pic-1.jpg'),
(27, 'Elkana Sampath', 'elkanasampath@gmail.com', '$2y$10$lXlT6mYZQt4s4CdeCkoOVOcCuG9BoVus0.zUsQ1QHztVhODslGnWC', 'uploads/bgk2.jpg'),
(28, 'Arun Nair', 'arun@gmail.com', '$2y$10$M42qgouk/aaCEoEIPuuXheXuN94Uxj7/0ErakSr8wBk33NkzOaaL6', 'uploads/kakashi.jpg'),
(29, 'Mihir Bhuwad', 'mihir@gmail.com', '$2y$10$tjSxtuVZQcfdV1ggaL5tz.vhpO24SzcP5pzeI3krv7i/sD1yMjOzC', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(46, 'Sayali Munde', 'sayalimunde@gmail.com', '$2y$10$L2uaWf2qdWlFrA0wYI4Z.e/m4G2Xjr1aBq4YC0y5D92iy.dzRDDXy', 'uploads/White Minimalist Profile LinkedIn Banner.png');

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
(29, '43', 'RSL Student', 'Web Development'),
(30, '45', 'Mihir Bhuwad', 'html'),
(31, '45', 'Mihir Bhuwad', 'java'),
(32, '56', 'Test ing 2', 'JAVA'),
(33, '60', 'Raj', 'Python'),
(34, '61', 'virat', 'full stack');

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
(23, '25', 'RSL ADMIN', 'Web Development'),
(24, '29', 'Mihir Bhuwad', 'HTML Course'),
(25, '29', 'Mihir Bhuwad', 'html'),
(26, '29', 'Mihir Bhuwad', 'java'),
(27, '30', 'Test ing', 'JAVA'),
(28, '30', 'Test ing', 'Python'),
(29, '31', 'Rohit sharma ', 'full stack');

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
(9, 'Java Development', 'day 1 ', 1, 'https://www.youtube.com/', 'https://www.youtube.com/', '1', 'uploads/65d9821203382_u105084344_LMS.sql'),
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
(39, 'Web Development', 'Html Day 5', 5, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(40, 'java', 'core java', 1, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '', ''),
(43, 'Python', 'python', 1, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(44, 'Python', 'python2', 2, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(45, 'Python', 'python 3', 3, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(46, 'Python', 'python', 4, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(47, 'Python', 'python', 5, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(48, 'full stack', 'html', 1, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(49, 'full stack', 'css', 2, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(50, 'full stack', 'javascript', 3, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(51, 'full stack', 'java', 4, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(52, 'full stack', 'interview', 5, 'https://www.udemy.com/cou', 'https://docs.google.com/d', '1', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),
(53, 'Java Development', 'Day 11', 11, 'https://www.udemy.com/cou', 'https://www.udemy.com/', '', ''),
(54, 'Java Development', 'Day 12', 12, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(55, 'Java Development', 'Day 13', 13, 'https://www.udemy.com/cou', 'https://www.udemy.com/', '', ''),
(56, 'Java Development', 'Day 14', 14, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(57, 'Java Development', 'DAY 15', 15, 'https://www.udemy.com/cou', 'https://www.youtube.com/', '', ''),
(58, 'Java Development', 'DAY 16', 16, 'https://www.udemy.com/cou', 'https://www.youtube.com/', '', ''),
(59, 'Java Development', 'DAY 17', 17, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(60, 'Java Development', 'DAY 18', 18, 'https://www.udemy.com/', 'https://www.udemy.com/', '', ''),
(61, 'Java Development', 'DAY 19', 19, 'https://www.udemy.com/', 'https://www.youtube.com/', '', ''),
(62, 'Java Development', 'DAY 20', 20, 'https://www.udemy.com/', 'https://www.youtube.com/', '', '');

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
(1, 'HTML Course', 'HTML Complete course', '7'),
(14, 'Machine Learning', 'Learn ML', '30'),
(15, 'Java Development', 'Learn Java', '20'),
(16, 'Web Development', 'Web Development', '15'),
(17, 'HTML Course', 'html', '5'),
(19, 'Java ', 'CORE JAVA ', '10');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `is_createdby_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_createdby_superadmin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `course_id`, `message`, `admin_id`, `is_createdby_admin`, `is_createdby_superadmin`, `created_at`, `updated_at`) VALUES
(1, 17, 'welcome', 29, 0, 1, '2024-02-20 02:34:46', '2024-02-20 02:34:46'),
(2, 17, 'hello', 29, 1, 0, '2024-02-20 02:35:14', '2024-02-20 02:35:14'),
(3, 0, 'hi', 0, 0, 1, '2024-02-20 10:36:53', '2024-02-20 10:36:53'),
(4, 17, 'hello', 29, 0, 1, '2024-02-20 10:37:20', '2024-02-20 10:37:20'),
(5, 17, 'hello', 29, 1, 0, '2024-02-20 10:37:43', '2024-02-20 10:37:43'),
(6, 18, 'welcome', 29, 0, 1, '2024-02-20 15:43:15', '2024-02-20 15:43:15'),
(7, 18, 'hi', 29, 1, 0, '2024-02-20 15:44:14', '2024-02-20 15:44:14'),
(8, 17, 'hello', 29, 0, 1, '2024-02-20 15:44:49', '2024-02-20 15:44:49'),
(9, 17, 'welcome', 29, 1, 0, '2024-02-20 15:45:10', '2024-02-20 15:45:10'),
(10, 20, 'hello', 30, 0, 1, '2024-02-21 11:29:14', '2024-02-21 11:29:14'),
(11, 0, 'welcome', 0, 0, 1, '2024-02-21 11:30:10', '2024-02-21 11:30:10'),
(12, 20, 'hello', 30, 1, 0, '2024-02-21 11:30:43', '2024-02-21 11:30:43'),
(13, 17, 'hello', 30, 1, 0, '2024-02-21 11:31:03', '2024-02-21 11:31:03'),
(14, 21, 'hello', 31, 0, 1, '2024-02-21 16:20:02', '2024-02-21 16:20:02'),
(15, 0, 'welcome', 0, 0, 1, '2024-02-21 16:20:12', '2024-02-21 16:20:12'),
(16, 21, 'hello', 31, 1, 0, '2024-02-21 16:20:33', '2024-02-21 16:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `notification_records`
--

CREATE TABLE `notification_records` (
  `id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_records`
--

INSERT INTO `notification_records` (`id`, `notification_id`, `student_id`, `is_read`) VALUES
(1, 1, 23, 0),
(2, 1, 29, 0),
(3, 1, 30, 0),
(4, 1, 31, 0),
(5, 1, 40, 0),
(6, 1, 43, 1),
(7, 1, 44, 0),
(8, 1, 45, 1),
(9, 1, 53, 0),
(10, 1, 54, 0),
(11, 2, 23, 0),
(12, 2, 29, 0),
(13, 2, 30, 0),
(14, 2, 31, 0),
(15, 2, 40, 0),
(16, 2, 43, 1),
(17, 2, 44, 0),
(18, 2, 45, 1),
(19, 2, 53, 0),
(20, 2, 54, 0),
(21, 3, 23, 0),
(22, 3, 29, 0),
(23, 3, 30, 0),
(24, 3, 31, 0),
(25, 3, 40, 0),
(26, 3, 43, 1),
(27, 3, 44, 0),
(28, 3, 45, 1),
(29, 3, 53, 0),
(30, 3, 54, 0),
(31, 3, 55, 0),
(32, 4, 23, 0),
(33, 4, 29, 0),
(34, 4, 30, 0),
(35, 4, 31, 0),
(36, 4, 40, 0),
(37, 4, 43, 1),
(38, 4, 44, 0),
(39, 4, 45, 1),
(40, 4, 53, 0),
(41, 4, 54, 0),
(42, 5, 23, 0),
(43, 5, 29, 0),
(44, 5, 30, 0),
(45, 5, 31, 0),
(46, 5, 40, 0),
(47, 5, 43, 1),
(48, 5, 44, 0),
(49, 5, 45, 1),
(50, 5, 53, 0),
(51, 5, 54, 0),
(52, 8, 23, 0),
(53, 8, 29, 0),
(54, 8, 30, 0),
(55, 8, 31, 0),
(56, 8, 40, 0),
(57, 8, 43, 1),
(58, 8, 44, 0),
(59, 8, 45, 1),
(60, 8, 53, 0),
(61, 8, 54, 0),
(62, 9, 23, 0),
(63, 9, 29, 0),
(64, 9, 30, 0),
(65, 9, 31, 0),
(66, 9, 40, 0),
(67, 9, 43, 1),
(68, 9, 44, 0),
(69, 9, 45, 1),
(70, 9, 53, 0),
(71, 9, 54, 0),
(72, 11, 23, 0),
(73, 11, 29, 0),
(74, 11, 30, 0),
(75, 11, 31, 0),
(76, 11, 40, 0),
(77, 11, 43, 1),
(78, 11, 44, 0),
(79, 11, 45, 0),
(80, 11, 53, 0),
(81, 11, 54, 0),
(82, 11, 55, 0),
(83, 11, 56, 0),
(84, 11, 57, 0),
(85, 11, 58, 0),
(86, 11, 59, 0),
(87, 11, 60, 1),
(88, 13, 60, 1),
(89, 14, 61, 1),
(90, 15, 23, 0),
(91, 15, 29, 0),
(92, 15, 30, 0),
(93, 15, 31, 0),
(94, 15, 40, 0),
(95, 15, 43, 1),
(96, 15, 44, 0),
(97, 15, 45, 0),
(98, 15, 53, 0),
(99, 15, 54, 0),
(100, 15, 55, 0),
(101, 15, 56, 0),
(102, 15, 57, 0),
(103, 15, 58, 0),
(104, 15, 59, 0),
(105, 15, 60, 0),
(106, 15, 61, 1),
(107, 16, 61, 1);

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
  `image_path` varchar(255) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `active_course_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_student`
--

INSERT INTO `register_student` (`id`, `name`, `profession`, `email`, `password`, `image_path`, `created_by`, `active_course_id`) VALUES
(23, 'Allan Manoah', 'front end developer', 'allan@gmail.com', '$2y$10$31y/C6ApO8MSeiJXCBVLKuUosmNvypBT.bqr8zhwdTCW1chapnTPq', 'uploads/chainsaw-man-bloody-makima-jk6xs8rc4zqibr8f.jpg', '29', '17'),
(29, 'Joseph Damo', 'Analyst', 'joseph@gmail.com', '$2y$10$nPEaaenBkl4byXt7pHI/Du1OIJuD/79ygOb8fyPdDDdiIsEVfCMAu', 'uploads/makima1.png', '29', '17'),
(30, 'Monika Sharma', 'full stack developer', 'monika@gmail.com', '$2y$10$8ACP00XQv0uPQesOCUS1J.b5cJ8adaA9oibYPNmFLKZ4Lubyucp.O', 'uploads/pexels-giorgio-de-angelis-1413412.jpg', '29', '17'),
(31, 'Mitali H', 'backend developer', 'mitali@gmail.com', '$2y$10$ZIRKFDCkQGGlXBrSPF0RN.mr1wwf6d9bWH6h6X9C1LNfICZ21ti5O', 'uploads/Makima.600.3804369.jpg', '29', '17'),
(40, 'Shrutika Munde', 'full stack developer', 'mundeshrutika7@gmail.com', '$2y$10$mpK49H79xsBOb3zveugWw.1d.jJsmMf/jEcE7x17fG96KPY0LW2VS', 'uploads/c71c3ca400f742dcedff716b2fc5962c.jpg', '29', '17'),
(43, 'RSL Student', 'full stack developer', 'student@gmail.com', '$2y$10$KIfWtw9x0bL26NcOHvruQuEXMHn5bWE892Xjnx9TfuGLCuggBCmua', 'uploads/pic-1.jpg', '29', '17'),
(44, 'Elkana Sampath', 'full stack developer', 'elkanasampath@gmail.com', '$2y$10$5xjLpGChA1deFgsgNKdGeOzMKdACaUDQyPjuPPeFpCiptcTA2vVWC', 'uploads/603117_original_1843x4096.jpg', '29', '17'),
(45, 'Mihir Bhuwad', 'developer', 'm@gmail.com', '$2y$10$dS82JJG6.yHzNk8qvkGYYOjIjAc7jl1I7YB2Z7GbuKD2EC6QOif46', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg', '29', '17'),
(55, 'hello', '', 'hello@gmail.com', '$2y$10$KoE5Re6831O3IKSbzWg0GuuxAPwnIvajiNb/oCqHI4GFxtLAy5lHu', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg', '29', '14'),
(56, 'Test ing 2', '', 'test@g.com', '$2y$10$FN6.QEnb.e9OcL5NdHAv7OcfRSLsoWWDfb1l37sgqLXjiYk8wTM.e', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg', '30', '1'),
(57, 'Mihir Bhuwad', '', 'mihir@gmail.com', '$2y$10$8zc1G0qSLzs3tdEDY5XP6ukoMbsK0z.A3/2jZQypjiUeog5uZdRXu', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg', '30', '1'),
(58, 'Test ing', '', 'test@g.com', '$2y$10$h0uO.btpE/IS9A/GQ2kp.ewCSbHZM0F2s2EB52SeFmW3LUqmqW4HS', 'uploads/51f07a9274c577f6df844fe1f579fe0c.jpg', '30', '19');

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_records`
--
ALTER TABLE `notification_records`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `admin_student_course`
--
ALTER TABLE `admin_student_course`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `assign_admin`
--
ALTER TABLE `assign_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `create_course`
--
ALTER TABLE `create_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification_records`
--
ALTER TABLE `notification_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `register_student`
--
ALTER TABLE `register_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
