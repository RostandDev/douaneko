-- MySQL dump 10.19  Distrib 10.3.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Douaneko
-- ------------------------------------------------------
-- Server version	10.3.34-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t_cityHallAdministrators`
--

DROP TABLE IF EXISTS `t_cityHallAdministrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_cityHallAdministrators` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(40) NOT NULL,
  `_access_level` enum('reader','editor') DEFAULT 'reader',
  `_last_name` varchar(160) NOT NULL,
  `_first_name` varchar(160) NOT NULL,
  `_identifier` varchar(32) NOT NULL,
  `_password` varchar(70) NOT NULL,
  `_city_hall` bigint(20) NOT NULL,
  `_status` enum('valide','invalide') DEFAULT 'valide',
  `_inserted_at` datetime DEFAULT current_timestamp(),
  `_updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `fk_city_hall_city_hall_administrators` (`_city_hall`),
  CONSTRAINT `fk_city_hall_city_hall_administrators` FOREIGN KEY (`_city_hall`) REFERENCES `t_cityHalls` (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_cityHallAdministrators`
--

LOCK TABLES `t_cityHallAdministrators` WRITE;
/*!40000 ALTER TABLE `t_cityHallAdministrators` DISABLE KEYS */;
INSERT INTO `t_cityHallAdministrators` VALUES (1,'urtolkl<skl','reader','super','super','super','$2y$12$EgVWmDBceAlqb7j0SaHjTu/0EJvkG38G7DkBex3wt4E6qKlWC6MnO',1,'valide','2022-09-16 01:16:02','2022-09-16 01:16:02');
/*!40000 ALTER TABLE `t_cityHallAdministrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_cityHalls`
--

DROP TABLE IF EXISTS `t_cityHalls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_cityHalls` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(40) NOT NULL,
  `_name` varchar(160) NOT NULL,
  `_city` varchar(160) NOT NULL,
  `_postal_code` varchar(60) DEFAULT NULL,
  `_telephone` int(20) DEFAULT NULL,
  `_prefecture` varchar(160) DEFAULT NULL,
  `_status` enum('valide','invalide') DEFAULT 'valide',
  `_author` bigint(20) NOT NULL,
  `_inserted_at` datetime DEFAULT current_timestamp(),
  `_updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `fk_city_hall_tidd_administrators` (`_author`),
  CONSTRAINT `fk_city_hall_tidd_administrators` FOREIGN KEY (`_author`) REFERENCES `t_tiddAdministrators` (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_cityHalls`
--

LOCK TABLES `t_cityHalls` WRITE;
/*!40000 ALTER TABLE `t_cityHalls` DISABLE KEYS */;
INSERT INTO `t_cityHalls` VALUES (1,'JKLMMMM','CITY1','CITY','48PO',8954782,'UIFGIF','valide',1,'2022-09-16 01:15:12','2022-09-16 01:15:12');
/*!40000 ALTER TABLE `t_cityHalls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_media`
--

DROP TABLE IF EXISTS `t_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_media` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(255) NOT NULL,
  `_type` varchar(10) NOT NULL,
  `_extension` varchar(10) NOT NULL,
  `_size` bigint(20) NOT NULL,
  `_name` varchar(160) NOT NULL,
  `_inserted_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  UNIQUE KEY `u_media_uuid` (`_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_media`
--

LOCK TABLES `t_media` WRITE;
/*!40000 ALTER TABLE `t_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_programs`
--

DROP TABLE IF EXISTS `t_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_programs` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(40) NOT NULL,
  `_name` varchar(255) NOT NULL,
  `_place` text DEFAULT NULL,
  `_execution_date` date NOT NULL,
  `_status` enum('programed','executed') NOT NULL DEFAULT 'programed',
  `_executed_by` varchar(160) DEFAULT NULL,
  `_inserted_at` datetime DEFAULT current_timestamp(),
  `_updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_programs`
--

LOCK TABLES `t_programs` WRITE;
/*!40000 ALTER TABLE `t_programs` DISABLE KEYS */;
INSERT INTO `t_programs` VALUES (1,'c6b595de-6162-4a5f-90a1-9ee80e567ae8','Neto1',NULL,'2022-11-25','programed',NULL,'2022-09-16 01:48:57','2022-09-16 01:48:57');
/*!40000 ALTER TABLE `t_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_programsCityHalls`
--

DROP TABLE IF EXISTS `t_programsCityHalls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_programsCityHalls` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_city_hall` bigint(20) NOT NULL,
  `_program` bigint(20) NOT NULL,
  `_inserted_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `fk_programs_city_halls_programs` (`_program`),
  KEY `fk_programs_city_halls_city_hall` (`_city_hall`),
  CONSTRAINT `fk_programs_city_halls_city_hall` FOREIGN KEY (`_city_hall`) REFERENCES `t_cityHallAdministrators` (`_id`),
  CONSTRAINT `fk_programs_city_halls_programs` FOREIGN KEY (`_program`) REFERENCES `t_programs` (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_programsCityHalls`
--

LOCK TABLES `t_programsCityHalls` WRITE;
/*!40000 ALTER TABLE `t_programsCityHalls` DISABLE KEYS */;
INSERT INTO `t_programsCityHalls` VALUES (1,1,1,'2022-09-16 01:48:57');
/*!40000 ALTER TABLE `t_programsCityHalls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_reporters`
--

DROP TABLE IF EXISTS `t_reporters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_reporters` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(40) NOT NULL,
  `_last_name` varchar(160) NOT NULL,
  `_first_name` varchar(160) NOT NULL,
  `_telephone` bigint(20) NOT NULL,
  `_city` varchar(160) NOT NULL,
  `_email` varchar(255) NOT NULL,
  `_pseudo` varchar(32) NOT NULL,
  `_password` varchar(70) NOT NULL,
  `_status` enum('valide','invalide') DEFAULT 'valide',
  `_inserted_at` datetime DEFAULT current_timestamp(),
  `_updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  UNIQUE KEY `u_reporters_uuid` (`_uuid`),
  UNIQUE KEY `u_reporters_email` (`_email`),
  UNIQUE KEY `u_reporters_pseudo` (`_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_reporters`
--

LOCK TABLES `t_reporters` WRITE;
/*!40000 ALTER TABLE `t_reporters` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_reporters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_reporting`
--

DROP TABLE IF EXISTS `t_reporting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_reporting` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(40) NOT NULL,
  `_type` enum('savage','gutters') DEFAULT NULL,
  `_level` enum('1','2','3','4','5') NOT NULL,
  `_longitude` float NOT NULL,
  `_latitude` float NOT NULL,
  `_comment` text NOT NULL,
  `_reporter` bigint(20) NOT NULL,
  `_status` enum('valide','invalide') DEFAULT 'valide',
  `_sent_at` datetime DEFAULT current_timestamp(),
  `_updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `fk_reporting_reporters` (`_reporter`),
  CONSTRAINT `fk_reporting_reporters` FOREIGN KEY (`_reporter`) REFERENCES `t_reporters` (`_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_reporting`
--

LOCK TABLES `t_reporting` WRITE;
/*!40000 ALTER TABLE `t_reporting` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_reporting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_reportingMedia`
--

DROP TABLE IF EXISTS `t_reportingMedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_reportingMedia` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_reporting` bigint(20) NOT NULL,
  `_media` bigint(20) NOT NULL,
  `_inserted_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `fk_reporting_media_reporting` (`_media`),
  CONSTRAINT `fk_reporting_media_media` FOREIGN KEY (`_media`) REFERENCES `t_media` (`_id`),
  CONSTRAINT `fk_reporting_media_reporting` FOREIGN KEY (`_media`) REFERENCES `t_reporting` (`_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_reportingMedia`
--

LOCK TABLES `t_reportingMedia` WRITE;
/*!40000 ALTER TABLE `t_reportingMedia` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_reportingMedia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_tiddAdministrators`
--

DROP TABLE IF EXISTS `t_tiddAdministrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_tiddAdministrators` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(40) NOT NULL,
  `_last_name` varchar(160) NOT NULL,
  `_first_name` varchar(160) NOT NULL,
  `_email` varchar(255) NOT NULL,
  `_identifier` varchar(32) NOT NULL,
  `_telephone` bigint(20) NOT NULL,
  `_password` varchar(70) NOT NULL,
  `_access_level` enum('reader','editor') DEFAULT 'reader',
  `_status` enum('valide','invalide') DEFAULT 'valide',
  `_created_at` datetime DEFAULT current_timestamp(),
  `_updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  UNIQUE KEY `u_administrators_uuid` (`_uuid`),
  UNIQUE KEY `u_administrators_telephone` (`_telephone`),
  UNIQUE KEY `u_administrators_email` (`_email`),
  UNIQUE KEY `u_administrators_identifier` (`_identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_tiddAdministrators`
--

LOCK TABLES `t_tiddAdministrators` WRITE;
/*!40000 ALTER TABLE `t_tiddAdministrators` DISABLE KEYS */;
INSERT INTO `t_tiddAdministrators` VALUES (1,'urtolkl<skl','super','super','super@gmail.com','super',98754125,'$2y$12$EgVWmDBceAlqb7j0SaHjTu/0EJvkG38G7DkBex3wt4E6qKlWC6MnO','editor','valide','2022-09-16 01:08:12','2022-09-16 01:08:12'),(2,'bf29f137-73c7-4516-bdc8-f16be21bc5f9','root','root','root@gmail.com','root',11255582,'$2y$12$XhQglm7q.eaFKj3xDj42XexRCwZ9GjcpP3xYGMy8kERtFeMYLhfsK','reader','valide','2022-09-16 09:26:34','2022-09-16 09:26:34');
/*!40000 ALTER TABLE `t_tiddAdministrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_trashStatus`
--

DROP TABLE IF EXISTS `t_trashStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_trashStatus` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_full_level` int(3) NOT NULL,
  `_trash` bigint(20) NOT NULL,
  `_sent_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `fk_trashs` (`_trash`),
  CONSTRAINT `fk_trashs` FOREIGN KEY (`_trash`) REFERENCES `t_trashs` (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_trashStatus`
--

LOCK TABLES `t_trashStatus` WRITE;
/*!40000 ALTER TABLE `t_trashStatus` DISABLE KEYS */;
INSERT INTO `t_trashStatus` VALUES (1,90,5,'2022-09-16 23:04:22');
/*!40000 ALTER TABLE `t_trashStatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_trashs`
--

DROP TABLE IF EXISTS `t_trashs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_trashs` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_uuid` varchar(40) NOT NULL,
  `_name` varchar(160) NOT NULL,
  `_longitude` text NOT NULL,
  `_latitude` text NOT NULL,
  `_address` varchar(160) NOT NULL,
  `_status` enum('valide','invalide') DEFAULT 'valide',
  `_inserted_at` datetime DEFAULT current_timestamp(),
  `_updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  UNIQUE KEY `u_trashs_uuid` (`_uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_trashs`
--

LOCK TABLES `t_trashs` WRITE;
/*!40000 ALTER TABLE `t_trashs` DISABLE KEYS */;
INSERT INTO `t_trashs` VALUES (1,'98b34dca-98d4-48df-a273-791042dd2957','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:20:21','2022-09-16 01:20:21'),(2,'ccb54c55-0e3e-4b89-9d96-f3cf91e2ab5f','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:24:56','2022-09-16 01:24:56'),(3,'1bc7c374-51fd-487c-814a-17e42df4b1c9','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:26:47','2022-09-16 01:26:47'),(4,'fb01ba18-7090-4f1c-b43d-fc2a80fa6a38','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:30:26','2022-09-16 01:30:26'),(5,'f8a9fb55-0062-4ea3-9c56-3bb96cee7d2d','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:33:17','2022-09-16 01:33:17'),(6,'2de16957-8a62-44f4-be2b-dd9eb311c545','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:33:52','2022-09-16 01:33:52'),(7,'28b859a3-73fc-4d69-bb8b-bd4d8cbecf32','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:34:26','2022-09-16 01:34:26'),(8,'869a3a77-3962-4787-bfd8-6161772efb9b','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:36:05','2022-09-16 01:36:05'),(9,'35d6e60b-162f-44cf-9156-eaa7581c5261','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:36:34','2022-09-16 01:36:34'),(10,'067c5bbc-47eb-4658-8ad8-f95a36c99736','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:36:40','2022-09-16 01:36:40'),(11,'6cfe9b48-4ed2-4f25-84ff-a623d6105c3b','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:37:43','2022-09-16 01:37:43'),(12,'2fee3a9a-efb5-40a9-8028-fcebff6dcd72','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:38:04','2022-09-16 01:38:04'),(13,'c88ad817-b9ee-4a4a-afd8-4071aba38a00','PB-1','1.652','1.2255','PB Zone','valide','2022-09-16 01:38:20','2022-09-16 01:38:20');
/*!40000 ALTER TABLE `t_trashs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_trashsCityHalls`
--

DROP TABLE IF EXISTS `t_trashsCityHalls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_trashsCityHalls` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `_city_hall` bigint(20) NOT NULL,
  `_trash` bigint(20) NOT NULL,
  `_inserted_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `fk_trashs_city_halls_programs` (`_trash`),
  KEY `fk_trashs_city_halls_city_hall` (`_city_hall`),
  CONSTRAINT `fk_trashs_city_halls_city_hall` FOREIGN KEY (`_city_hall`) REFERENCES `t_cityHallAdministrators` (`_id`),
  CONSTRAINT `fk_trashs_city_halls_programs` FOREIGN KEY (`_trash`) REFERENCES `t_trashs` (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_trashsCityHalls`
--

LOCK TABLES `t_trashsCityHalls` WRITE;
/*!40000 ALTER TABLE `t_trashsCityHalls` DISABLE KEYS */;
INSERT INTO `t_trashsCityHalls` VALUES (1,1,13,'2022-09-16 01:38:20');
/*!40000 ALTER TABLE `t_trashsCityHalls` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-17  0:23:47
