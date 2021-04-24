-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: askLantic
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `askLantic__notifications`
--

DROP TABLE IF EXISTS `askLantic__notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `askLantic__notifications` (
  `notifId` int NOT NULL AUTO_INCREMENT,
  `usrId` int NOT NULL,
  `mesg` text NOT NULL,
  `time` bigint DEFAULT NULL,
  `link` text,
  PRIMARY KEY (`notifId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `askLantic__notifications`
--

LOCK TABLES `askLantic__notifications` WRITE;
/*!40000 ALTER TABLE `askLantic__notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `askLantic__notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `askLantic__questions`
--

DROP TABLE IF EXISTS `askLantic__questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `askLantic__questions` (
  `quesId` int NOT NULL AUTO_INCREMENT,
  `titl` text,
  `ques` text NOT NULL,
  `usrId` int NOT NULL,
  `time` bigint DEFAULT NULL,
  `tags` text,
  `rprt` json DEFAULT NULL,
  `view` int DEFAULT NULL,
  `isCmnt` int DEFAULT NULL,
  PRIMARY KEY (`quesId`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `askLantic__questions`
--

LOCK TABLES `askLantic__questions` WRITE;
/*!40000 ALTER TABLE `askLantic__questions` DISABLE KEYS */;
INSERT INTO `askLantic__questions` VALUES (98,'Apache Pig Load data with comma and space (How can I do?)','Here is my question: I wonder know how to load these data:\r\n\r\nInput data:\r\n18 (John, Mary)\r\n22 (Austin, Sunny)\r\n78 (Richard, Alice)\r\n87 (Johnny,)\r\n\r\nAnd I want load these data to the variable A\r\n\r\nSo I write this:\r\n\r\n[C]A = Load \'data\' AS (age:int, couple:(husband:chararray, wife:chararray));[!]\r\n\r\nBut when I Dumped A the result give me like this:\r\n(,)\r\n(,)\r\n(,)\r\n(,)\r\n\r\nBut I wanna like this:\r\n(18,(John, Mary))\r\n(22,(Austin, Sunny))\r\n(78,(Richard, Alice))\r\n(87,(Johnny,))\r\nHow can I fix it?',20,1619269064,'hadoop apache_pig','{\"abs\": 0, \"inv\": 0, \"spm\": 0, \"typ\": 0, \"rptr\": \"\"}',3,NULL),(99,'SQL How to query a column text contains an array [&ldquo;val1&rdquo;, &ldquo;val2&rdquo;] and retrieves all the entries of this table','I have a problem with SQL logic, I have to check if the value of the category which is an array and which is in the database matches the numeric value to retrieve all the elements that match, need to help please\r\n\r\nin my table product i have save category column like varchar this: [\"1\", \"2\", \"3\"]\r\n\r\nand this is my request :\r\n\r\n[C]SELECT id as product_id, name as product_name,\r\n       price as product_price, image as product_image,\r\n       rating as product_rating, review as product_review\r\nFROM products\r\nWHERE category IN(?)\r\nORDER BY product_sale DESC\r\nLIMIT ?, ?[!]\r\nI want to decode the category column with JSON_DECODE() to verify.. help!\r\n\r\n',20,1619269138,'sql','{\"abs\": 0, \"inv\": 0, \"spm\": 0, \"typ\": 0, \"rptr\": \"\"}',1,NULL),(100,'CORS issue in Chrome though Access-Control-Allow-Origin header is present','A developer added new DELETE (blog) endpoint, which basicly copied the existing and working DELETE endpoint for a different resource (page). It works on his PC but I cannot test the code because Chrome does not run the DELETE method because of missing CORS header. The attached picture shows Chrome dev tools screenshots for OPTION + DELETE/POST requests. I have checked that OPTIONS is always run and it returns a CORS header for localhost. This is sufficient to POST a picture or DELETE a page. But the same header is not enough for Chrome for DELETE blog. I cannot see any difference or explanation.\r\n\r\nBackend is written in NodeJS\r\n\r\nThis code works on my PC: https://github.com/literakl/mezinamiridici/blob/master/backend/src/handlers/pages/deletePage.js\r\n\r\n[C]module.exports = (app) => {\r\n  app.options(\'/v1/pages/:pageId\', auth.cors);\r\n  app.delete(\'/v1/pages/:pageId\', auth.required, auth.cms_admin, auth.cors, async (req, res) => {\r\n[!]\r\nThis code works on developer\'s Chrome and Firefox but fails on my Chrome or Edge \r\nhttps://github.com/literakl/mezinamiridici/blob/master/backend/src/handlers/items/deleteBlog.js\r\n\r\n[C]module.exports = (app) => {\r\n  app.options(\'/v1/blog/:blogId\', auth.cors);    \r\n  app.delete(\'/v1/blog/:blogId\', auth.required, auth.cors, async (req, res) => {[!]',20,1619269305,'javascript google_chrome cors','{\"abs\": 0, \"inv\": 0, \"spm\": 0, \"typ\": 0, \"rptr\": \"\"}',1,NULL),(101,'how to create PDB file threejs pdb loader','I have a requirement to create 3D view of molecules in HTML5. I came across three.js pdb loader. It takes .pdb\" file to create 3d view of molecules. I am looking for pdf files for below set of molecules.\r\n[C]  C5H10, C5H8, H2, H2O, HCN, NH3, O2, N2, CO2, HCl, CCl4, Cl2, NCl3,\r\n  OCl2, SCl2, H2S, C2H6S, CH4S, S8, C6H12O6[!]',20,1619269474,'javascript threejs html5_canvas','{\"abs\": 0, \"inv\": 0, \"spm\": 0, \"typ\": 0, \"rptr\": \"\"}',1,NULL);
/*!40000 ALTER TABLE `askLantic__questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `askLantic__userData`
--

DROP TABLE IF EXISTS `askLantic__userData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `askLantic__userData` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `usern` text NOT NULL,
  `email` text NOT NULL,
  `paswd` text NOT NULL,
  `prfpc` text,
  `reput` int DEFAULT '0',
  `timeSpent` text,
  `socialVisit` varchar(5) DEFAULT '',
  `accCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `askLantic__userData`
--

LOCK TABLES `askLantic__userData` WRITE;
/*!40000 ALTER TABLE `askLantic__userData` DISABLE KEYS */;
INSERT INTO `askLantic__userData` VALUES (20,'rpd512','rhiddhiprasad@gmail.com','806ed538b53747e4fc05355d00a50e54',NULL,0,'1619272800','','2021-04-24 12:56:28');
/*!40000 ALTER TABLE `askLantic__userData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `askLantic__votePost`
--

DROP TABLE IF EXISTS `askLantic__votePost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `askLantic__votePost` (
  `uId` int NOT NULL,
  `pId` int NOT NULL,
  `vte` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `askLantic__votePost`
--

LOCK TABLES `askLantic__votePost` WRITE;
/*!40000 ALTER TABLE `askLantic__votePost` DISABLE KEYS */;
/*!40000 ALTER TABLE `askLantic__votePost` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-24 22:41:36
