-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 03:40 PM
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
(25, 'RSL ADMIN', 'admin@gmail.com', '$2y$10$LzdZRCwHea97YB3U0KzkkeFdCf/cNZQTMR6TfQuAHyQ.2lwnz2XeS', 'uploads/pic-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `assign_admin`
--

CREATE TABLE `assign_admin` (
  `id` int(11) NOT NULL,
  `admins_name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_admin`
--

INSERT INTO `assign_admin` (`id`, `admins_name`, `course_name`) VALUES
(1, 'Shrutika Munde', 'Java Development');

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
  `practical_link` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`id`, `course_name`, `course_description`, `course_day`, `course_link`, `practical_link`) VALUES
(1, 'Web Development', 'HTML Basics', 1, 'https://www.youtube.com/', 'https://www.youtube.com/'),
(2, 'Java Development', 'OOPs Concept', 1, 'https://www.youtube.com/', 'https://www.youtube.com/'),
(6, 'HTML Course', 'basic html', 1, 'https://www.udemy.com/cou', 'https://www.youtube.com/');

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
(4, 'Web Development', 'Web development refers to the creating, building, and maintaining of websites. It includes aspects such as web design, web publishing, web programming, and database management. It is the creation of an application that works over the internet i.e. website', '30 days'),
(5, 'Java Development', 'Java development is the process of creating applications using the Java programming language. Java is a high-level, object-oriented programming language that is designed to be portable, secure, and reliable. Java applications can run on a variety of platf', '30 days'),
(7, 'HTML Course', 'Web development refers to the creating, building, and maintaining of websites. It includes aspects such as web design, web publishing, web programming, and database management. It is the creation of an application that works over the internet i.e. website', '15 Days');

-- --------------------------------------------------------

--
-- Table structure for table `notification_records`
--

CREATE TABLE `notification_records` (
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
-- Dumping data for table `notification_records`
--

INSERT INTO `notification_records` (`id`, `course_id`, `message`, `admin_id`, `is_createdby_admin`, `is_createdby_superadmin`, `created_at`, `updated_at`) VALUES
(3, 0, 'hi', 14, 0, 1, '2024-02-07 16:27:07', '2024-02-07 16:27:07'),
(8, 2, 'hello', 0, 0, 1, '2024-02-07 20:49:59', '2024-02-07 20:49:59'),
(12, 1, 'hhhjjk', 0, 1, 0, '2024-02-07 21:01:14', '2024-02-07 21:01:14'),
(13, 1, 'hhhjjk', 0, 1, 0, '2024-02-07 21:01:32', '2024-02-07 21:01:32'),
(17, 3, 'jncusbhj', 0, 1, 0, '2024-02-07 21:08:50', '2024-02-07 21:08:50'),
(18, 2, 'snedlusehduj', 0, 1, 0, '2024-02-07 21:19:55', '2024-02-07 21:19:55'),
(20, 1, 'hello', 14, 0, 1, '2024-02-08 13:24:55', '2024-02-08 13:24:55'),
(21, 1, 'hello', 0, 1, 0, '2024-02-08 13:27:01', '2024-02-08 13:27:01'),
(22, 1, 'hi', 4, 0, 1, '2024-02-08 13:47:44', '2024-02-08 13:47:44'),
(23, 2, 'hello sir', 4, 0, 1, '2024-02-08 13:48:38', '2024-02-08 13:48:38'),
(27, 1, 'jbksoihsoivh', 0, 1, 0, '2024-02-09 17:42:05', '2024-02-09 17:42:05'),
(30, 17, 'holiday', 0, 1, 0, '2024-02-10 11:34:34', '2024-02-10 11:34:34'),
(31, 0, 'holiday', 0, 1, 0, '2024-02-10 12:01:53', '2024-02-10 12:01:53'),
(32, 0, '10-02-2024', 0, 1, 0, '2024-02-10 12:20:21', '2024-02-10 12:20:21');

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
(23, 'Allan Manoah', 'backend developer', 'allan@gmail.com', '$2y$10$rBspvUOGzX03VjS8eg/gJeBxYVl.Hx1ATyaAhMOWI1KwP0gVs9AZS', 'uploads/chainsaw-man-bloody-makima-jk6xs8rc4zqibr8f.jpg'),
(29, 'Joseph Damo', 'Analyst', 'joseph@gmail.com', '$2y$10$nPEaaenBkl4byXt7pHI/Du1OIJuD/79ygOb8fyPdDDdiIsEVfCMAu', 'uploads/makima1.png'),
(30, 'Monika Sharma', 'full stack developer', 'monika@gmail.com', '$2y$10$8ACP00XQv0uPQesOCUS1J.b5cJ8adaA9oibYPNmFLKZ4Lubyucp.O', 'uploads/pexels-giorgio-de-angelis-1413412.jpg'),
(31, 'Mitali H', 'backend developer', 'mitali@gmail.com', '$2y$10$ZIRKFDCkQGGlXBrSPF0RN.mr1wwf6d9bWH6h6X9C1LNfICZ21ti5O', 'uploads/Makima.600.3804369.jpg'),
(40, 'Shrutika Munde', 'full stack developer', 'mundeshrutika7@gmail.com', '$2y$10$mpK49H79xsBOb3zveugWw.1d.jJsmMf/jEcE7x17fG96KPY0LW2VS', 'uploads/shrutika photo.jpeg'),
(43, 'RSL Student', 'full stack developer', 'student@gmail.com', '$2y$10$KIfWtw9x0bL26NcOHvruQuEXMHn5bWE892Xjnx9TfuGLCuggBCmua', 'uploads/pic-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stdcourse`
--

CREATE TABLE `stdcourse` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `coursename` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `submission_file` varchar(255) DEFAULT NULL,
  `coursedescription` varchar(25) NOT NULL,
  `courselink` varchar(25) NOT NULL,
  `practicallink` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stdcourse`
--

INSERT INTO `stdcourse` (`id`, `student_id`, `coursename`, `date`, `is_completed`, `submission_file`, `coursedescription`, `courselink`, `practicallink`) VALUES
(4, 30, 'full stack developer', '2024-02-08', 0, NULL, 'hi', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(5, 42, 'full stack developer', '2024-02-08', 1, 'uploads/240 Core Java interview Questions.pdf', 'hi', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(6, 29, 'Analyst', '2024-02-09', 0, NULL, 'hi', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(7, 44, 'Analyst', '2024-02-09', 0, NULL, 'hi', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(19, 45, 'ML', '2024-02-08', 1, 'uploads/Hand gesture3.png', 'Complete the course', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(20, 45, 'ML', '2024-02-17', 0, NULL, 'complete the course', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(21, 40, 'developer', '2024-02-15', 1, 'uploads/VS Code Shortcuts.pdf', 'Complete', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(22, 41, 'developer', '2024-02-15', 1, 'uploads/GIT CheatSheet (2).pdf', 'Complete', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(23, 45, 'ML', '2024-02-07', 1, 'uploads/chainsaw-man-bloody-makima-jk6xs8rc4zqibr8f.jpg', 'complete', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(24, 46, 'ML', '2024-02-07', 0, NULL, 'complete', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(25, 45, 'ML', '2024-02-10', 0, NULL, 'hi', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(26, 46, 'ML', '2024-02-10', 0, NULL, 'hi', 'https://www.youtube.com/w', 'https://www.youtube.com/w'),
(0, 0, 'full stack developer', '2024-02-10', 0, NULL, 'java', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 0, 'full stack developer', '2024-02-10', 0, NULL, 'java', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 0, 'developer', '2024-02-10', 0, NULL, 'java', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 0, 'full stack developer', '2024-02-10', 0, NULL, 'java', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 0, 'full stack developer', '2024-02-10', 0, NULL, 'complete today', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-11', 0, NULL, 'java', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-11', 1, 'uploads/VS Code Shortcuts.pdf', 'java', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 42, 'full stack developer', '2024-02-11', 0, NULL, 'java', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-10', 0, NULL, 'complete today', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-10', 1, 'uploads/VS Code Shortcuts.pdf', 'complete today', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-10', 1, 'uploads/HTML NOTES.pdf', 'complete today', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-11', 0, NULL, 'java coding', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-11', 1, 'uploads/VS Code Shortcuts.pdf', 'java coding', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-11', 1, 'uploads/HTML NOTES.pdf', 'java coding', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-10', 0, NULL, 'complete', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-10', 1, 'uploads/VS Code Shortcuts.pdf', 'complete', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-10', 1, 'uploads/HTML NOTES.pdf', 'complete', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-10', 0, NULL, 'xx', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-10', 1, 'uploads/VS Code Shortcuts.pdf', 'xx', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-10', 1, 'uploads/HTML NOTES.pdf', 'xx', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-10', 0, NULL, 'complete today', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-10', 1, 'uploads/VS Code Shortcuts.pdf', 'complete today', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-10', 1, 'uploads/HTML NOTES.pdf', 'complete today', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-10', 0, NULL, 'test', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-10', 1, 'uploads/VS Code Shortcuts.pdf', 'test', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-10', 1, 'uploads/HTML NOTES.pdf', 'test', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-11', 0, NULL, 'testing courses', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-11', 1, 'uploads/VS Code Shortcuts.pdf', 'testing courses', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-11', 1, 'uploads/HTML NOTES.pdf', 'testing courses', 'https://www.udemy.com/', 'https://www.udemy.com/'),
(0, 30, 'full stack developer', '2024-02-10', 0, NULL, 'aqwsdf', 'https://www.udemy.com', 'https://www.udemy.com/'),
(0, 40, 'full stack developer', '2024-02-10', 1, 'uploads/VS Code Shortcuts.pdf', 'aqwsdf', 'https://www.udemy.com', 'https://www.udemy.com/'),
(0, 43, 'full stack developer', '2024-02-10', 0, NULL, 'aqwsdf', 'https://www.udemy.com', 'https://www.udemy.com/');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `assign_admin`
--
ALTER TABLE `assign_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `create_course`
--
ALTER TABLE `create_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification_records`
--
ALTER TABLE `notification_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `register_student`
--
ALTER TABLE `register_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
