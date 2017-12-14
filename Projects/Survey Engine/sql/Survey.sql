-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: survey
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','admin@gmail.com','$2y$10$jEFy5y68K2SV4Uot8RRQlu.zjSV764vljyLUdRCP9QB5f0bejluvS');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answer_entity`
--

DROP TABLE IF EXISTS `answer_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer_entity` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text,
  `choice` int(11) DEFAULT NULL,
  `id_question` int(11) NOT NULL,
  `id_survey` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_answer`,`id_question`,`id_survey`,`id_user`),
  KEY `fk_answer_entity_question_entity1_idx` (`id_question`,`id_survey`),
  CONSTRAINT `fk_answer_entity_question_entity1` FOREIGN KEY (`id_question`, `id_survey`) REFERENCES `question_entity` (`id_question`, `id_survey`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer_entity`
--

LOCK TABLES `answer_entity` WRITE;
/*!40000 ALTER TABLE `answer_entity` DISABLE KEYS */;
INSERT INTO `answer_entity` VALUES (252,'Sodium',0,66,42,0),(253,'Iron',0,66,42,0),(254,'Gold',0,66,42,0),(255,'Uranium',0,66,42,0),(256,'Oxygen',0,66,42,0),(257,'water',0,67,42,0),(258,'milk',0,67,42,0),(259,'soda',0,67,42,0),(260,'koolaid',0,67,42,0),(261,'gatorade',0,67,42,0),(262,'1',0,68,43,0),(263,'2',0,68,43,0),(264,'3',0,68,43,0),(265,'4',0,68,43,0),(266,'5',0,68,43,0),(267,'1',0,69,43,0),(268,'2',0,69,43,0),(269,'3',0,69,43,0),(270,'4',0,69,43,0),(271,'5',0,69,43,0);
/*!40000 ALTER TABLE `answer_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_entity`
--

DROP TABLE IF EXISTS `question_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_entity` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `id_survey` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_question`,`id_survey`,`id_user`),
  KEY `fk_question_entity_survey_entity1_idx` (`id_survey`),
  CONSTRAINT `fk_question_entity_survey_entity1` FOREIGN KEY (`id_survey`) REFERENCES `survey_entity` (`id_survey`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_entity`
--

LOCK TABLES `question_entity` WRITE;
/*!40000 ALTER TABLE `question_entity` DISABLE KEYS */;
INSERT INTO `question_entity` VALUES (66,'NaCl',42,0),(67,'h20',42,0),(68,'How are you feeling today?',43,0),(69,'Are you in any pain?',43,0);
/*!40000 ALTER TABLE `question_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result_entity`
--

DROP TABLE IF EXISTS `result_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result_entity` (
  `id_choice` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) DEFAULT NULL,
  `answer` text,
  `id_survey` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_choice`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result_entity`
--

LOCK TABLES `result_entity` WRITE;
/*!40000 ALTER TABLE `result_entity` DISABLE KEYS */;
INSERT INTO `result_entity` VALUES (49,66,'Sodium',42),(50,67,'water',42),(51,66,'Sodium',42),(52,67,'water',42),(53,66,'Sodium',42),(54,67,'water',42),(55,66,'Iron',42),(56,67,'milk',42),(57,66,'Gold',42),(58,67,'koolaid',42),(59,68,'1',43),(60,69,'1',43);
/*!40000 ALTER TABLE `result_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_entity`
--

DROP TABLE IF EXISTS `survey_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_entity` (
  `id_survey` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_survey`,`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_entity`
--

LOCK TABLES `survey_entity` WRITE;
/*!40000 ALTER TABLE `survey_entity` DISABLE KEYS */;
INSERT INTO `survey_entity` VALUES (42,'test',0),(43,'Feeling today',0);
/*!40000 ALTER TABLE `survey_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'trevor ','trev@gmail.com','$2y$10$mWw5t3fEFvd4U2U9CULdveNLFp5KMnDpO8X69XDfjU.axPK716MDK ');
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

-- Dump completed on 2017-12-13 11:22:34
