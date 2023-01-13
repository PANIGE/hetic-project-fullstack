CREATE DATABASE  IF NOT EXISTS `hpfs` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hpfs`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: hpfs
-- ------------------------------------------------------
-- Server version	5.7.37-log

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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_admin_idx` (`owner`),
  CONSTRAINT `users_admin` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'panini',1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planning`
--

DROP TABLE IF EXISTS `planning`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emitter` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `begin` bigint(20) NOT NULL,
  `end` bigint(20) NOT NULL,
  `objective` double NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `planning_emitter_idx` (`emitter`),
  KEY `planning_group_idx` (`group_id`),
  CONSTRAINT `planning_emitter` FOREIGN KEY (`emitter`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `planning_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planning`
--

LOCK TABLES `planning` WRITE;
/*!40000 ALTER TABLE `planning` DISABLE KEYS */;
/*!40000 ALTER TABLE `planning` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emitter` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `begin` bigint(20) NOT NULL,
  `end` bigint(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `report_emitter_idx` (`emitter`),
  KEY `report_group_idx` (`group_id`),
  CONSTRAINT `report_emitter` FOREIGN KEY (`emitter`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `report_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emitter` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `value` double NOT NULL,
  `reason` varchar(2000) NOT NULL,
  `unix` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emitter_id_idx` (`emitter`),
  KEY `transac_type_idx` (`type`),
  KEY `transac_group_idx` (`group_id`),
  CONSTRAINT `emitter_id` FOREIGN KEY (`emitter`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transac_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transac_type` FOREIGN KEY (`type`) REFERENCES `transactions_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions_types`
--

DROP TABLE IF EXISTS `transactions_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_short` varchar(4) NOT NULL,
  `name_full` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions_types`
--

LOCK TABLES `transactions_types` WRITE;
/*!40000 ALTER TABLE `transactions_types` DISABLE KEYS */;
INSERT INTO `transactions_types` VALUES (1,'AAAA','BBBB');
/*!40000 ALTER TABLE `transactions_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pw_hash` varchar(250) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '1',
  `part` double NOT NULL DEFAULT '0',
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'NICOLAS','ALARY','EDTRFYTUGYHIUOJPO','ZDZDZD',3,0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_group`
--

DROP TABLE IF EXISTS `users_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_group` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  KEY `users_group_member_idx` (`uid`),
  KEY `group_group_member_idx` (`gid`),
  CONSTRAINT `group_group_member` FOREIGN KEY (`gid`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_group_member` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_group`
--

LOCK TABLES `users_group` WRITE;
/*!40000 ALTER TABLE `users_group` DISABLE KEYS */;
INSERT INTO `users_group` VALUES (1,1);
/*!40000 ALTER TABLE `users_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webtokens`
--

DROP TABLE IF EXISTS `webtokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `webtokens` (
  `token` varchar(2000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_ip` varchar(39) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  PRIMARY KEY (`token`),
  KEY `user_token_idx` (`user_id`),
  CONSTRAINT `user_token` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webtokens`
--

LOCK TABLES `webtokens` WRITE;
/*!40000 ALTER TABLE `webtokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `webtokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-13 14:40:45
