-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: openvpnmysql    Database: kubergpt_dev
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `price_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'subscription',
  `environment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'live',
  `tag_lines` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,'price_1N1OiiJsg0XlNoye9zvZx2js','Gold',500.00,NULL,'2023-04-27 13:40:31','media/various/ecom_product3.png','Our premium','subscription','live','[\"S\\u00e5 f\\u00e5r du da ogs\\u00e5 bare det hele\",\"Bring nothing - just start the window and you\'re on\",\"GPT-4 !\"]'),(2,'price_1N1OhZJsg0XlNoyeHp4NvlIH','Silver',135.00,NULL,'2023-04-27 13:41:56','media/various/ecom_product2.png','Just per hour','subscription','live','[\"Pay in advance\",\"Runs for a month\"]'),(3,'price_1N1OgmJsg0XlNoyeN2AeLqFr','Rent for 24 hours',12.00,NULL,'2023-04-27 13:41:33','media/various/ecom_product1.png','Just per hour','subscription','live','[\"\\\"Meter billing\\\"\",\"Billed as youuse - after first hour which will be billed for 1 hour no matter what, but afterwards, you can turn on\\/off as you wish\",\"You can \\\"pause\\\" for up to 1 week.\",\"Medbring selvn\\u00f8gler\",\"Each hour after 24 hours will be settled at \\u20ac 0.5 \\/hour\"]'),(4,'A','INTRODUCTION OFFER - 2 DAYS FOR ONLY',6.75,NULL,'2023-04-27 13:43:00','media/various/ecom_product3.png','Everything from our premium product','subscription','live','[\"Everything from ourpremium product\",\"Limited uptake\",\"You can renew for as long as the offer is active.\"]'),(5,'A','Rent per hour - pay in advance',1.00,NULL,'2023-04-27 13:43:28','media/various/ecom_product1.png','Minimum 6 hours','subscription','live','[\"Minimum 6 hours\",\"Medbring selv n\\u00f8gler\",\"Norecurring withdrawals\"]');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-27 11:43:55
