-- MySQL dump 10.13  Distrib 5.1.69, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: casterbuddy
-- ------------------------------------------------------
-- Server version	5.1.69

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
-- Table structure for table `premade`
--

DROP TABLE IF EXISTS `premade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `premade` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `RecDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Active` tinyint(1) DEFAULT '1',
  `Title` varchar(100) DEFAULT NULL,
  `FileName` varchar(100) DEFAULT NULL,
  `Width` int(4) DEFAULT '0',
  `Height` int(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `premade`
--

LOCK TABLES `premade` WRITE;
/*!40000 ALTER TABLE `premade` DISABLE KEYS */;
INSERT INTO `premade` VALUES (1,'2016-02-24 16:21:44',1,'Instant access','1',200,135),(2,'2016-02-24 16:21:44',1,'Free gift','2',200,135),(3,'2016-02-24 16:21:44',1,'Free products and instant access','3',200,135),(4,'2016-02-24 20:03:23',1,'Tips, tricks and techniques','4',200,141),(5,'2016-02-24 16:21:44',1,'Unique and special offer','5',200,135),(6,'2016-02-24 20:04:04',1,'Video 6','6',200,141),(7,'2016-02-24 20:04:21',1,'Video 7','7',200,141),(8,'2016-02-24 20:04:35',1,'Video 8','8',200,141),(9,'2016-02-24 20:04:57',1,'Video 9','9',200,141),(10,'2016-02-24 20:05:16',1,'Video 10','10',200,141),(11,'2016-02-24 20:05:46',1,'Video 11','11',200,140),(12,'2016-02-24 20:06:05',1,'Video 12','12',200,140),(13,'2016-02-24 20:06:29',1,'Video 13','13',200,140),(14,'2016-02-24 20:06:46',1,'Video 14','14',200,140),(15,'2016-02-24 20:07:14',1,'Video 15','15',200,141),(16,'2016-02-24 20:07:34',1,'Video 16','16',200,141),(17,'2016-02-24 20:07:54',1,'Video 17','17',200,141),(18,'2016-02-24 20:08:28',1,'Video 18','18',200,141),(19,'2016-02-24 20:08:45',1,'Video 19','19',200,141),(20,'2016-02-24 20:09:06',1,'Video 20','20',200,141),(21,'2016-02-24 20:09:36',1,'Video 21','21',200,141),(22,'2016-02-24 20:10:16',1,'Video 22','22',200,141),(23,'2016-02-24 20:10:40',1,'Video 23','23',200,133),(24,'2016-02-24 20:11:43',1,'Video 24','24',200,133),(25,'2016-02-24 20:11:46',1,'Video 25','25',200,133),(26,'2016-02-24 20:11:50',1,'Video 26','26',200,133),(27,'2016-02-24 20:11:53',1,'Video 27','27',200,133),(28,'2016-02-24 16:21:44',1,'Video 1','1',300,203),(29,'2016-02-24 16:21:44',1,'Video 2','2',300,203),(30,'2016-02-24 16:21:44',1,'Video 3','3',300,203),(31,'2016-02-24 22:07:12',1,'Video 4','4',300,211),(32,'2016-02-24 16:21:44',1,'Video 5','5',300,203),(33,'2016-02-24 22:09:26',1,'Video 6','6',300,211),(34,'2016-02-24 22:09:44',1,'Video 7','7',300,211),(35,'2016-02-24 22:10:30',1,'Video 8','8',300,211),(36,'2016-02-24 22:10:34',1,'Video 9','9',300,211),(37,'2016-02-24 22:10:38',1,'Video 10','10',300,211),(38,'2016-02-24 22:11:07',1,'Video 11','11',300,210),(39,'2016-02-24 22:11:58',1,'Video 12','12',300,210),(40,'2016-02-24 22:12:04',1,'Video 13','13',300,210),(41,'2016-02-24 22:12:09',1,'Video 14','14',300,210),(42,'2016-02-24 22:12:25',1,'Video 15','15',300,211),(43,'2016-02-24 22:14:29',1,'Video 16','16',300,211),(44,'2016-02-24 22:14:34',1,'Video 17','17',300,211),(45,'2016-02-24 22:14:37',1,'Video 18','18',300,211),(46,'2016-02-24 22:14:43',1,'Video 19','19',300,211),(47,'2016-02-24 22:14:47',1,'Video 20','20',300,211),(48,'2016-02-24 22:14:50',1,'Video 21','21',300,211),(49,'2016-02-24 22:14:55',1,'Video 22','22',300,211),(50,'2016-02-24 22:16:36',1,'Video 23','23',300,200),(51,'2016-02-24 22:16:40',1,'Video 24','24',300,200),(52,'2016-02-24 22:16:44',1,'Video 25','25',300,200),(53,'2016-02-24 22:16:49',1,'Video 26','26',300,200),(54,'2016-02-24 22:16:54',1,'Video 27','27',300,200),(55,'2016-02-24 20:13:08',1,'Instant access','1',400,271),(56,'2016-02-24 20:14:21',1,'Free gift','2',400,271),(57,'2016-02-24 20:14:25',1,'Free products and instant access','3',400,271),(58,'2016-02-24 20:18:21',1,'Tips, tricks and techniques','4',400,282),(59,'2016-02-24 20:19:10',1,'Unique and special offer','5',400,271),(60,'2016-02-24 16:23:55',1,'Video 6','6',400,282),(61,'2016-02-24 16:23:55',1,'Video 7','7',400,282),(62,'2016-02-24 16:23:55',1,'Video 8','8',400,282),(63,'2016-02-24 16:23:55',1,'Video 9','9',400,282),(64,'2016-02-24 16:23:55',1,'Video 10','10',400,282),(65,'2016-02-24 21:58:45',1,'Video 11','11',400,280),(66,'2016-02-24 21:59:30',1,'Video 12','12',400,280),(67,'2016-02-24 22:00:05',1,'Video 13','13',400,280),(68,'2016-02-24 22:00:08',1,'Video 14','14',400,280),(69,'2016-02-24 16:23:55',1,'Video 15','15',400,282),(70,'2016-02-24 16:23:55',1,'Video 16','16',400,282),(71,'2016-02-24 16:23:55',1,'Video 17','17',400,282),(72,'2016-02-24 16:23:55',1,'Video 18','18',400,282),(73,'2016-02-24 16:23:55',1,'Video 19','19',400,282),(74,'2016-02-24 16:23:56',1,'Video 20','20',400,282),(75,'2016-02-24 16:23:56',1,'Video 21','21',400,282),(76,'2016-02-24 16:23:56',1,'Video 22','22',400,282),(77,'2016-02-24 22:03:41',1,'Video 23','23',400,266),(78,'2016-02-24 22:04:27',1,'Video 24','24',400,266),(79,'2016-02-24 22:04:32',1,'Video 25','25',400,266),(80,'2016-02-24 22:04:38',1,'Video 26','26',400,266),(81,'2016-02-24 22:04:43',1,'Video 27','27',400,266),(82,'2016-03-08 07:45:05',1,'Video 28','28',200,141),(83,'2016-03-08 07:45:05',1,'Video 28','28',300,211),(84,'2016-03-08 07:45:05',1,'Video 28','28',400,282),(85,'2016-03-08 07:45:05',1,'Video 29','29',200,141),(86,'2016-03-08 07:45:05',1,'Video 29','29',300,211),(87,'2016-03-08 07:45:05',1,'Video 29','29',400,282),(88,'2016-03-08 07:45:05',1,'Video 30','30',200,141),(89,'2016-03-08 07:45:05',1,'Video 30','30',300,211),(90,'2016-03-08 07:45:05',1,'Video 30','30',400,282),(91,'2016-03-08 07:45:05',1,'Video 31','31',200,141),(92,'2016-03-08 07:45:05',1,'Video 31','31',300,211),(93,'2016-03-08 07:45:05',1,'Video 31','31',400,282),(94,'2016-03-08 07:45:05',1,'Video 32','32',200,141),(95,'2016-03-08 07:45:05',1,'Video 32','32',300,211),(96,'2016-03-08 07:45:05',1,'Video 32','32',400,282);
/*!40000 ALTER TABLE `premade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `RecDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Active` tinyint(1) DEFAULT '1',
  `Title` varchar(100) DEFAULT NULL,
  `FileName` varchar(100) DEFAULT NULL,
  `uid` varchar(40) DEFAULT NULL,
  `Width` int(4) DEFAULT '0',
  `Height` int(4) DEFAULT '0',
  `MaxFrame` int(6) NOT NULL,
  `Duration` int(4) NOT NULL,
  `HasShadow` tinyint(1) DEFAULT '0',
  `ExitOnEnd` tinyint(1) DEFAULT '1',
  `ValidURL` varchar(100) DEFAULT NULL,
  `ViewCount` int(10) DEFAULT '0',
  `ViewRemaining` int(10) DEFAULT '0',
  `Plan` int(2) DEFAULT '0',
  `Position` int(1) DEFAULT '0',
  `OffsetX` int(4) DEFAULT '0',
  `OffsetY` int(4) DEFAULT '0',
  `GlassBG` tinyint(1) DEFAULT '0',
  `Url` varchar(100) DEFAULT NULL,
  `TextLine1` varchar(100) DEFAULT NULL,
  `TextLine2` varchar(100) DEFAULT NULL,
  `TextPosition` int(1) DEFAULT '0',
  `TextShowSec` int(4) DEFAULT '-1',
  `TextShowDuration` int(4) DEFAULT '-1',
  `TextStyling` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(30) DEFAULT NULL,
  `PhonePosition` int(1) DEFAULT '0',
  `PhoneShowSec` int(4) DEFAULT '-1',
  `PhoneShowDuration` int(4) DEFAULT '-1',
  `PhoneStyling` varchar(100) DEFAULT NULL,
  `ButtonLabel` varchar(30) DEFAULT NULL,
  `ButtonPosition` int(1) DEFAULT '0',
  `ButtonShowSec` int(11) DEFAULT '-1',
  `ButtonShowDuration` int(11) DEFAULT '-1',
  `ButtonStyling` varchar(100) DEFAULT NULL,
  `FormButtonLabel` varchar(100) DEFAULT NULL,
  `FormPosition` int(1) DEFAULT '0',
  `FormShowSec` int(4) DEFAULT '-1',
  `FormShowDuration` int(4) DEFAULT '-1',
  `ButtonCode` text,
  `FormCode` text,
  `DisplayAfter` int(4) DEFAULT '0',
  `DisplayAutomatically` tinyint(4) DEFAULT '1',
  `CookieLife` int(4) DEFAULT '10',
  `StopShowingWhen` tinyint(2) DEFAULT '0',
  `DimmedBG` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (63,1,'2016-03-24 14:17:00',1,'Premade video','23','cd211a5437fb8f377cf3445810ac9420eb64d4e5',200,133,0,0,0,1,NULL,4,96,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(64,1,'2016-03-24 14:16:21',1,'Premade video','24','6c89c4863d6be5608bc8ac3b68253c557a0118d0',200,133,0,0,0,1,NULL,2,98,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(65,1,'2016-03-24 14:16:39',1,'Premade video','25','4db599b112e41d1ce9046e09aa0a25bf11814dc4',400,266,0,0,0,1,NULL,2,98,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(66,1,'2016-03-24 14:40:08',1,'New video','11.mp4','d1f77010ffbc710a5c8efdd47a6cf91f182bee3a',300,168,102,0,0,1,NULL,2,98,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(62,1,'2016-03-23 18:04:15',1,'New video','video1.mp4','fd9adb9b8e23091c390a051be82c4fd509b3629b',400,224,52,0,0,1,NULL,2,98,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(43,2,'2016-03-07 20:45:39',1,'New video','video1.mp4','547c0dc9c25224832521177b92939ffae78b0d4f',300,168,52,0,0,1,NULL,4,1000,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(61,1,'2016-03-23 23:28:51',1,'Premade video','10','b3ddf42a0345af27e8a2e1f741d454018080c389',400,282,0,0,0,1,NULL,22,78,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(59,1,'2016-03-23 16:10:32',1,'Premade video','13','4f1e690beb0bd2a8e1263d4f2852caa70e957969',400,280,0,0,0,1,NULL,46,54,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0),(44,2,'2016-03-07 20:45:39',1,'Premade video','23','6792d6c3aab997d1a02b8c8fbd3ddbd258582511',300,200,0,0,0,1,NULL,2,1000,0,0,0,0,0,NULL,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,-1,-1,NULL,NULL,0,1,10,0,0);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `RecDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Name` varchar(40) DEFAULT NULL,
  `Surename` varchar(40) DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `UserName` varchar(20) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `MaxUsers` int(2) NOT NULL DEFAULT '0',
  `Active` tinyint(1) DEFAULT '0',
  `PaymentDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2016-02-03 23:43:11',NULL,NULL,NULL,'george','f7c3bc1d808e04732adf679965ccc34ca7ae3441',0,0,'0000-00-00'),(2,'2016-03-05 09:59:07',NULL,NULL,NULL,'george1','c63b19f1e4c8b5f76b25c49b8b87f57d8e4872a1',0,0,'0000-00-00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'casterbuddy'
--

--
-- Dumping routines for database 'casterbuddy'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-25 12:09:08
