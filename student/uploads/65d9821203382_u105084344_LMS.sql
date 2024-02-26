-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: lms_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_student_course`
--

DROP TABLE IF EXISTS `admin_student_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_student_course` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_student_course`
--

LOCK TABLES `admin_student_course` WRITE;
/*!40000 ALTER TABLE `admin_student_course` DISABLE KEYS */;
INSERT INTO `admin_student_course` VALUES (17,'44','Elkana Sampath','Java Development'),(21,'43','RSL Student','Java Development'),(22,'23','Allan Manoah','Java Development'),(25,'40','Shrutika Munde','Java Development'),(27,'40','Shrutika Munde','Machine Learning'),(28,'43','RSL Student','Machine Learning'),(29,'43','RSL Student','Web Development'),(30,'45','Mihir Bhuwad','html'),(31,'45','Mihir Bhuwad','java'),(32,'56','Test ing 2','JAVA'),(33,'60','Raj','Python'),(34,'61','virat','full stack');
/*!40000 ALTER TABLE `admin_student_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (3,'rahul','rahul@g.com','$2y$10$ZtMASAIz4T/RW','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(4,'ram','ram@g.com','$2y$10$xV.4EPkj2QwTw','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(14,'shiv thakre','s@gmail.com','$2y$10$FpfDrfuiz0cdnh4t20QwTueG8KF4iR1waoj1hIFUGcVT.W5zTfenm','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(16,'steve jobs','steve@gmail.com','$2y$10$OJ3TvsoJncMjHVoq5lSLt.TEg0KdZgO5cQsZPZENrO13p3hAENLeW','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(22,'Shrutika Munde','mundeshrutika7@gmail.com','$2y$10$UrgHLmZwsprx4KAT9f8/COL9VSwNepgGJmmf5D9WxjlgG9gNIRN42','uploads/wallpaperflare.com_wallpaper (3).jpg'),(25,'RSL ADMIN','admin@gmail.com','$2y$10$LzdZRCwHea97YB3U0KzkkeFdCf/cNZQTMR6TfQuAHyQ.2lwnz2XeS','uploads/pic-1.jpg'),(27,'Elkana Sampath','elkanasampath@gmail.com','$2y$10$lXlT6mYZQt4s4CdeCkoOVOcCuG9BoVus0.zUsQ1QHztVhODslGnWC','uploads/bgk2.jpg'),(28,'Arun Nair','arun@gmail.com','$2y$10$M42qgouk/aaCEoEIPuuXheXuN94Uxj7/0ErakSr8wBk33NkzOaaL6','uploads/kakashi.jpg'),(29,'Mihir Bhuwad','mihir@gmail.com','$2y$10$tjSxtuVZQcfdV1ggaL5tz.vhpO24SzcP5pzeI3krv7i/sD1yMjOzC','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(30,'Test ing','test@g.com','$2y$10$J1Yj8aLVvsLJXpYZJzRZqee6Zvr6tTQoXJY3wdxcH140NgvU3x58e','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(31,'Rohit sharma ','rohit@g.com','$2y$10$unTC8vh8UtgqJn9Jw3VM.OQTN/i4NbKtQ6cmJ.yzds.zy8.8Ezxhi','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assign_admin`
--

DROP TABLE IF EXISTS `assign_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assign_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_admin`
--

LOCK TABLES `assign_admin` WRITE;
/*!40000 ALTER TABLE `assign_admin` DISABLE KEYS */;
INSERT INTO `assign_admin` VALUES (6,'','Elkana Sampath','Java Development'),(11,'27','Elkana Sampath','Machine Learning'),(18,'25','RSL ADMIN','Java Development'),(19,'22','Shrutika Munde','Java Development'),(20,'25','RSL ADMIN','Machine Learning'),(23,'25','RSL ADMIN','Web Development'),(24,'29','Mihir Bhuwad','HTML Course'),(25,'29','Mihir Bhuwad','html'),(26,'29','Mihir Bhuwad','java'),(27,'30','Test ing','JAVA'),(28,'30','Test ing','Python'),(29,'31','Rohit sharma ','full stack');
/*!40000 ALTER TABLE `assign_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_details`
--

DROP TABLE IF EXISTS `course_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(25) NOT NULL,
  `course_description` varchar(25) NOT NULL,
  `course_day` int(11) NOT NULL,
  `course_link` varchar(25) NOT NULL,
  `practical_link` varchar(25) NOT NULL,
  `completed` varchar(50) NOT NULL,
  `uploaded_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_details`
--

LOCK TABLES `course_details` WRITE;
/*!40000 ALTER TABLE `course_details` DISABLE KEYS */;
INSERT INTO `course_details` VALUES (1,'Web Development','HTML Basics',1,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/Blk1.png'),(8,'Web Development','html tags',2,'https://www.youtube.com/','https://www.youtube.com/','',''),(9,'Java Development','day 1 ',1,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/65cf211a90afe_IDE1.png'),(10,'Java Development','day 2',2,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/65cf22a5b6356_Hand gesture3.png'),(11,'Java Development','day 3',3,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/65cf22ba50781_Extraction4.png'),(12,'Java Development','day 4',4,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/AtmVr.jpg'),(13,'Java Development','day 5',5,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/Extraction1.png'),(14,'Java Development','day 6',6,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/blk.png'),(15,'Java Development','day 7',7,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/Blk1.png'),(16,'Java Development','day 8',8,'https://www.youtube.com/','https://www.youtube.com/','1','uploads/chainsaw-man-bloody-makima-jk6xs8rc4zqibr8f.jpg'),(24,'Java Development','day 9',9,'https://www.youtube.com/','https://www.youtube.com/','',''),(25,'Java Development','Day 10',10,'https://www.udemy.com/','https://www.udemy.com/','',''),(26,'HTML Course','Day 1',1,'https://www.youtube.com/','https://www.udemy.com/','',''),(27,'HTML Course','Day 2',2,'https://www.udemy.com/','https://www.udemy.com/','',''),(28,'HTML Course','Day 3',3,'https://www.udemy.com/','https://www.udemy.com/','',''),(29,'HTML Course','Day 4',4,'https://www.udemy.com/','https://www.udemy.com/','',''),(30,'HTML Course','Day 5',5,'https://www.udemy.com/','https://www.w3schools.com','',''),(31,'Machine Learning','Day 1',1,'https://www.udemy.com/','https://www.udemy.com/','1','uploads/Munde-Resume-.pdf'),(32,'Machine Learning','Day 2',2,'https://www.udemy.com/','https://www.udemy.com/','',''),(33,'Machine Learning','Day 3',3,'https://www.udemy.com/','https://www.youtube.com/','',''),(34,'Machine Learning','Day 4',4,'https://www.youtube.com/','https://www.youtube.com/','',''),(35,'Machine Learning','Day 5',5,'https://www.youtube.com/','https://www.udemy.com/','',''),(36,'Machine Learning','Day 6',6,'https://www.udemy.com/','https://www.udemy.com/','',''),(37,'Web Development','Html elements',3,'https://www.udemy.com/','https://www.udemy.com/','',''),(38,'Web Development','HTML',4,'https://www.youtube.com/','https://www.youtube.com/','',''),(39,'Web Development','Html Day 5',5,'https://www.udemy.com/','https://www.udemy.com/','',''),(40,'java','core java',1,'https://www.udemy.com/cou','https://docs.google.com/d','',''),(41,'JAVA','HELLO',2,'https://www.udemy.com/cou','https://docs.google.com/d','',''),(42,'JAVA','new course',3,'https://www.udemy.com/cou','https://docs.google.com/d','',''),(43,'Python','python',1,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(44,'Python','python2',2,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(45,'Python','python 3',3,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(46,'Python','python',4,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(47,'Python','python',5,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(48,'full stack','html',1,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(49,'full stack','css',2,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(50,'full stack','javascript',3,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(51,'full stack','java',4,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg'),(52,'full stack','interview',5,'https://www.udemy.com/cou','https://docs.google.com/d','1','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg');
/*!40000 ALTER TABLE `course_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `create_course`
--

DROP TABLE IF EXISTS `create_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `create_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `course_duration` varchar(11) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `create_course`
--

LOCK TABLES `create_course` WRITE;
/*!40000 ALTER TABLE `create_course` DISABLE KEYS */;
INSERT INTO `create_course` VALUES (1,'HTML Course','HTML Complete course','3'),(14,'Machine Learning','Learn ML','30'),(15,'Java Development','Learn Java','20'),(16,'Web Development','Web Development','15'),(17,'html','html','5'),(19,'JAVA','CORE JAVA','10'),(20,'Python','Python','5'),(21,'full stack','HTML, CSS, javascript &amp; Java','5');
/*!40000 ALTER TABLE `create_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `is_createdby_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_createdby_superadmin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,17,'welcome',29,0,1,'2024-02-20 02:34:46','2024-02-20 02:34:46'),(2,17,'hello',29,1,0,'2024-02-20 02:35:14','2024-02-20 02:35:14'),(3,0,'hi',0,0,1,'2024-02-20 10:36:53','2024-02-20 10:36:53'),(4,17,'hello',29,0,1,'2024-02-20 10:37:20','2024-02-20 10:37:20'),(5,17,'hello',29,1,0,'2024-02-20 10:37:43','2024-02-20 10:37:43'),(6,18,'welcome',29,0,1,'2024-02-20 15:43:15','2024-02-20 15:43:15'),(7,18,'hi',29,1,0,'2024-02-20 15:44:14','2024-02-20 15:44:14'),(8,17,'hello',29,0,1,'2024-02-20 15:44:49','2024-02-20 15:44:49'),(9,17,'welcome',29,1,0,'2024-02-20 15:45:10','2024-02-20 15:45:10'),(10,20,'hello',30,0,1,'2024-02-21 11:29:14','2024-02-21 11:29:14'),(11,0,'welcome',0,0,1,'2024-02-21 11:30:10','2024-02-21 11:30:10'),(12,20,'hello',30,1,0,'2024-02-21 11:30:43','2024-02-21 11:30:43'),(13,17,'hello',30,1,0,'2024-02-21 11:31:03','2024-02-21 11:31:03'),(14,21,'hello',31,0,1,'2024-02-21 16:20:02','2024-02-21 16:20:02'),(15,0,'welcome',0,0,1,'2024-02-21 16:20:12','2024-02-21 16:20:12'),(16,21,'hello',31,1,0,'2024-02-21 16:20:33','2024-02-21 16:20:33');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_records`
--

DROP TABLE IF EXISTS `notification_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_records`
--

LOCK TABLES `notification_records` WRITE;
/*!40000 ALTER TABLE `notification_records` DISABLE KEYS */;
INSERT INTO `notification_records` VALUES (1,1,23,0),(2,1,29,0),(3,1,30,0),(4,1,31,0),(5,1,40,0),(6,1,43,0),(7,1,44,0),(8,1,45,1),(9,1,53,0),(10,1,54,0),(11,2,23,0),(12,2,29,0),(13,2,30,0),(14,2,31,0),(15,2,40,0),(16,2,43,0),(17,2,44,0),(18,2,45,1),(19,2,53,0),(20,2,54,0),(21,3,23,0),(22,3,29,0),(23,3,30,0),(24,3,31,0),(25,3,40,0),(26,3,43,0),(27,3,44,0),(28,3,45,1),(29,3,53,0),(30,3,54,0),(31,3,55,0),(32,4,23,0),(33,4,29,0),(34,4,30,0),(35,4,31,0),(36,4,40,0),(37,4,43,0),(38,4,44,0),(39,4,45,1),(40,4,53,0),(41,4,54,0),(42,5,23,0),(43,5,29,0),(44,5,30,0),(45,5,31,0),(46,5,40,0),(47,5,43,0),(48,5,44,0),(49,5,45,1),(50,5,53,0),(51,5,54,0),(52,8,23,0),(53,8,29,0),(54,8,30,0),(55,8,31,0),(56,8,40,0),(57,8,43,0),(58,8,44,0),(59,8,45,1),(60,8,53,0),(61,8,54,0),(62,9,23,0),(63,9,29,0),(64,9,30,0),(65,9,31,0),(66,9,40,0),(67,9,43,0),(68,9,44,0),(69,9,45,1),(70,9,53,0),(71,9,54,0),(72,11,23,0),(73,11,29,0),(74,11,30,0),(75,11,31,0),(76,11,40,0),(77,11,43,0),(78,11,44,0),(79,11,45,0),(80,11,53,0),(81,11,54,0),(82,11,55,0),(83,11,56,0),(84,11,57,0),(85,11,58,0),(86,11,59,0),(87,11,60,1),(88,13,60,1),(89,14,61,1),(90,15,23,0),(91,15,29,0),(92,15,30,0),(93,15,31,0),(94,15,40,0),(95,15,43,0),(96,15,44,0),(97,15,45,0),(98,15,53,0),(99,15,54,0),(100,15,55,0),(101,15,56,0),(102,15,57,0),(103,15,58,0),(104,15,59,0),(105,15,60,0),(106,15,61,1),(107,16,61,1);
/*!40000 ALTER TABLE `notification_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `register_student`
--

DROP TABLE IF EXISTS `register_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `register_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `active_course_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `register_student`
--

LOCK TABLES `register_student` WRITE;
/*!40000 ALTER TABLE `register_student` DISABLE KEYS */;
INSERT INTO `register_student` VALUES (23,'Allan Manoah','backend developer','allan@gmail.com','$2y$10$31y/C6ApO8MSeiJXCBVLKuUosmNvypBT.bqr8zhwdTCW1chapnTPq','uploads/chainsaw-man-bloody-makima-jk6xs8rc4zqibr8f.jpg','29','17'),(29,'Joseph Damo','Analyst','joseph@gmail.com','$2y$10$nPEaaenBkl4byXt7pHI/Du1OIJuD/79ygOb8fyPdDDdiIsEVfCMAu','uploads/makima1.png','29','17'),(30,'Monika Sharma','full stack developer','monika@gmail.com','$2y$10$8ACP00XQv0uPQesOCUS1J.b5cJ8adaA9oibYPNmFLKZ4Lubyucp.O','uploads/pexels-giorgio-de-angelis-1413412.jpg','29','17'),(31,'Mitali H','backend developer','mitali@gmail.com','$2y$10$ZIRKFDCkQGGlXBrSPF0RN.mr1wwf6d9bWH6h6X9C1LNfICZ21ti5O','uploads/Makima.600.3804369.jpg','29','17'),(40,'Shrutika Munde','full stack developer','mundeshrutika7@gmail.com','$2y$10$mpK49H79xsBOb3zveugWw.1d.jJsmMf/jEcE7x17fG96KPY0LW2VS','uploads/shrutika photo.jpeg','29','17'),(43,'RSL Student','full stack developer','student@gmail.com','$2y$10$KIfWtw9x0bL26NcOHvruQuEXMHn5bWE892Xjnx9TfuGLCuggBCmua','uploads/pic-1.jpg','29','17'),(44,'Elkana Sampath','full stack developer','elkanasampath@gmail.com','$2y$10$5xjLpGChA1deFgsgNKdGeOzMKdACaUDQyPjuPPeFpCiptcTA2vVWC','uploads/603117_original_1843x4096.jpg','29','17'),(45,'Mihir Bhuwad','developer','m@gmail.com','$2y$10$dS82JJG6.yHzNk8qvkGYYOjIjAc7jl1I7YB2Z7GbuKD2EC6QOif46','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','29','17'),(53,'hi','14','test@g.com','$2y$10$hgG4K8j.rH/1YXWXvmLsyumy05NQUd2EQoPax.2Ivwe4JLAp4Z5a2','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','29','17'),(54,'test','','test@g.com','$2y$10$gVI4/9TPvdulLc28uHQxQONUjv0wzMHXRq1umqgNhvTlbZ7..gXg6','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','29','17'),(55,'hello','','hello@gmail.com','$2y$10$KoE5Re6831O3IKSbzWg0GuuxAPwnIvajiNb/oCqHI4GFxtLAy5lHu','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','29','14'),(56,'Test ing 2','','test@g.com','$2y$10$FN6.QEnb.e9OcL5NdHAv7OcfRSLsoWWDfb1l37sgqLXjiYk8wTM.e','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','30','1'),(57,'Mihir Bhuwad','','mihir@gmail.com','$2y$10$8zc1G0qSLzs3tdEDY5XP6ukoMbsK0z.A3/2jZQypjiUeog5uZdRXu','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','30','1'),(58,'Test ing','','test@g.com','$2y$10$h0uO.btpE/IS9A/GQ2kp.ewCSbHZM0F2s2EB52SeFmW3LUqmqW4HS','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','30','19'),(59,'Hello','','hello@gmail.com','$2y$10$eREJQxSr1NqaHt84USAAPelX/BZqhMFI5v0C8wUxASyaG6Xkpm0V.','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','30','19'),(60,'Raj','','raj@g.com','$2y$10$jou7h8P1J2zVDx0xFCTF1OhlS.yxotKYSIJ4s8Bdlr5Tv7ARoUFM2','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','30','17'),(61,'virat','','virat@g.com','$2y$10$khwe.shAXff0jQN.aj4XoO753BeZ1BzYleT22Av/8fHlCrqoeYqUK','uploads/51f07a9274c577f6df844fe1f579fe0c.jpg','31','21');
/*!40000 ALTER TABLE `register_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin@gmail.com','12345678');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-21 17:08:47
