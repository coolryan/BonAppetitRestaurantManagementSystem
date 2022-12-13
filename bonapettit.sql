-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: bonappetit
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

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
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredient` (
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meal_order`
--

DROP TABLE IF EXISTS `meal_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meal_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `restaurant_table_id` int DEFAULT NULL,
  `in_store` tinyint NOT NULL DEFAULT '1',
  `server_id` int DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `tip` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `server_id` (`server_id`),
  KEY `restaurant_table_id` (`restaurant_table_id`),
  CONSTRAINT `meal_order_ibfk_1` FOREIGN KEY (`server_id`) REFERENCES `user` (`id`),
  CONSTRAINT `meal_order_ibfk_2` FOREIGN KEY (`restaurant_table_id`) REFERENCES `restaurant_table` (`restaurant_table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meal_order`
--

LOCK TABLES `meal_order` WRITE;
/*!40000 ALTER TABLE `meal_order` DISABLE KEYS */;
INSERT INTO `meal_order` VALUES (9,1,1,12,'2022-12-10 17:05:26',0.00),(11,3,1,3,'2022-12-13 13:00:57',35.00),(12,3,1,3,'2022-12-13 13:04:12',35.00),(13,3,1,3,'2022-12-13 13:04:47',35.00),(14,3,1,3,'2022-12-13 13:05:31',35.00),(15,3,1,3,'2022-12-13 13:05:39',35.00),(16,4,1,3,'2022-12-13 13:14:51',12.00),(17,NULL,0,NULL,'2022-12-13 20:45:28',23.00),(18,NULL,0,NULL,'2022-12-13 20:45:37',23.00),(19,NULL,0,NULL,'2022-12-13 20:45:56',23.00),(20,5,1,3,'2022-12-13 20:48:02',10.00);
/*!40000 ALTER TABLE `meal_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meal_order_menu_item`
--

DROP TABLE IF EXISTS `meal_order_menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meal_order_menu_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meal_order_id` int NOT NULL,
  `menu_item_id` int DEFAULT NULL,
  `instructions` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meal_order_id` (`meal_order_id`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `meal_order_menu_item_ibfk_1` FOREIGN KEY (`meal_order_id`) REFERENCES `meal_order` (`id`),
  CONSTRAINT `meal_order_menu_item_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_item` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meal_order_menu_item`
--

LOCK TABLES `meal_order_menu_item` WRITE;
/*!40000 ALTER TABLE `meal_order_menu_item` DISABLE KEYS */;
INSERT INTO `meal_order_menu_item` VALUES (1,9,2,''),(2,9,1,'No cheese'),(3,11,1,'Extra cheese'),(4,11,1,'No pickles'),(5,11,3,''),(6,11,3,''),(7,11,4,'No nuts'),(8,11,5,''),(9,11,6,''),(10,11,7,'No onions'),(11,11,7,''),(12,12,1,'Extra cheese'),(13,12,1,'No pickles'),(14,12,3,''),(15,12,3,''),(16,12,4,'No nuts'),(17,12,5,''),(18,12,6,''),(19,12,7,'No onions'),(20,12,7,''),(21,13,1,'Extra cheese'),(22,13,1,'No pickles'),(23,13,3,''),(24,13,3,''),(25,13,4,'No nuts'),(26,13,5,''),(27,13,6,''),(28,13,7,'No onions'),(29,13,7,''),(30,14,1,'Extra cheese'),(31,14,1,'No pickles'),(32,14,3,''),(33,14,3,''),(34,14,4,'No nuts'),(35,14,5,''),(36,14,6,''),(37,14,7,'No onions'),(38,14,7,''),(39,15,1,'Extra cheese'),(40,15,1,'No pickles'),(41,15,3,''),(42,15,3,''),(43,15,4,'No nuts'),(44,15,5,''),(45,15,6,''),(46,15,7,'No onions'),(47,15,7,''),(48,16,1,'Well done'),(49,16,1,'Well done'),(50,16,4,''),(51,16,7,''),(52,16,7,''),(53,17,1,'Extra cheese'),(54,17,1,''),(55,17,2,''),(56,17,3,''),(57,17,3,''),(58,17,4,'Extra cream'),(59,17,5,''),(60,17,5,''),(61,17,7,'No onions'),(62,18,1,'Extra cheese'),(63,18,1,''),(64,18,2,''),(65,18,3,''),(66,18,3,''),(67,18,4,'Extra cream'),(68,18,5,''),(69,18,5,''),(70,18,7,'No onions'),(71,19,1,'Extra cheese'),(72,19,1,''),(73,19,2,''),(74,19,3,''),(75,19,3,''),(76,19,4,'Extra cream'),(77,19,5,''),(78,19,5,''),(79,19,7,'No onions'),(80,20,2,''),(81,20,2,''),(82,20,3,'Extra pecans');
/*!40000 ALTER TABLE `meal_order_menu_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_category`
--

DROP TABLE IF EXISTS `menu_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_category` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_category`
--

LOCK TABLES `menu_category` WRITE;
/*!40000 ALTER TABLE `menu_category` DISABLE KEYS */;
INSERT INTO `menu_category` VALUES ('Appetizers'),('Desserts'),('Main Dishes');
/*!40000 ALTER TABLE `menu_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_item`
--

DROP TABLE IF EXISTS `menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `category` varchar(50) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `category` (`category`),
  CONSTRAINT `menu_item_ibfk_1` FOREIGN KEY (`category`) REFERENCES `menu_category` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_item`
--

LOCK TABLES `menu_item` WRITE;
/*!40000 ALTER TABLE `menu_item` DISABLE KEYS */;
INSERT INTO `menu_item` VALUES (1,'Classic Burger','Juicy 100% angus burger with extra sharp vermont cheddar cheese on a brioche bun.',18.99,1,'Main Dishes',NULL),(2,'Turkey Burger','Lean smoked turkey with swiss chese on an onion bun.',15.99,1,'Main Dishes',NULL),(3,'Pumpkin Cheesecake','Freshly made pumpkin cheesecake with whipped cream.',8.99,1,'Desserts',''),(4,'Ice Cream Sundae','Vanilla, chocolate, and strawberry ice cream with bananas, nuts, and whipped cream.',6.99,1,'Desserts',NULL),(5,'Jalapaño Poppers','Breaded jalapeño peppers served with salsa.',6.99,1,'Appetizers',NULL),(6,'Quesadilla','Fresh qusadilla with cheddar and mozzarella cheese, served with salsa.',7.49,1,'Appetizers','/images/menu/quesadilla.jpeg'),(7,'Pizza','Yummy large pizza with everything.',13.58,1,'Main Dishes','/images/menu/Pizza.png');
/*!40000 ALTER TABLE `menu_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_item_ingredient`
--

DROP TABLE IF EXISTS `menu_item_ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_item_ingredient` (
  `menu_item` int NOT NULL,
  `ingredient_name` varchar(30) NOT NULL,
  `serving_size` decimal(5,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`menu_item`,`ingredient_name`),
  KEY `ingredient_name` (`ingredient_name`),
  CONSTRAINT `menu_item_ingredient_ibfk_1` FOREIGN KEY (`menu_item`) REFERENCES `menu_item` (`id`),
  CONSTRAINT `menu_item_ingredient_ibfk_2` FOREIGN KEY (`ingredient_name`) REFERENCES `ingredient` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_item_ingredient`
--

LOCK TABLES `menu_item_ingredient` WRITE;
/*!40000 ALTER TABLE `menu_item_ingredient` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_item_ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_table`
--

DROP TABLE IF EXISTS `reservation_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation_table` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `party_size` int NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `patron_name` varchar(50) NOT NULL,
  `patron_phone` varchar(50) NOT NULL,
  `patron_email` varchar(75) NOT NULL,
  `restaurant_table_id` int DEFAULT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `restaurant_table_id` (`restaurant_table_id`),
  CONSTRAINT `reservation_table_ibfk_1` FOREIGN KEY (`restaurant_table_id`) REFERENCES `restaurant_table` (`restaurant_table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_table`
--

LOCK TABLES `reservation_table` WRITE;
/*!40000 ALTER TABLE `reservation_table` DISABLE KEYS */;
INSERT INTO `reservation_table` VALUES (1,4,'2022-12-01','18:24:00','Steven Ford','1231231234','steve@ford.com',9),(2,7,'2022-12-02','08:32:00','Bob Greenly','213123523566','bob@greenly.com',17),(3,5,'2022-12-01','19:45:00','Juan Juancho','1231231234','juan@juancho.com',9),(4,10,'2022-11-16','18:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(5,2,'2022-11-24','17:30:00','Vincent Horton','123123124','vincent@horton.com',1),(6,7,'2022-11-24','17:46:00','Natalie Davis','1231231234','natalie@davis.com',17),(7,10,'2022-11-24','16:30:00','Callum Ruiz','1231231234','callum@ruiz.com',18),(8,5,'2022-11-24','17:45:00','Isla Klein','1231231234','isla@klein.com',9),(9,6,'2022-11-24','16:15:00','Axel Harris','1231231234','axel@harris.com',10),(10,3,'2022-11-24','16:35:00','Eduardo Shultz','1231232134','eduardo@shultz.com',5),(11,3,'2022-11-24','18:45:00','Delaney Waters','1231231234','delaney@waters.com',6),(13,4,'2022-11-24','15:45:00','Wyatt Davis','1231231234','Wyatt@Davis.com',6),(14,5,'2022-11-24','17:40:00','Brooklyn Watts','123121324','Brooklyn@Watts.com',11),(15,2,'2022-11-23','17:40:00','Brooklyn Watts','123121324','Brooklyn@Watts.com',1),(16,2,'2022-11-23','18:20:00','Rylan Wood','123121324','Rylan@Wood.com',2),(17,2,'2022-11-23','07:30:00','Miracle Houston','123121324','Miracle@Houston.com',1),(18,5,'2022-11-23','13:30:00','Adeline Stewart','123121324','Adeline@Stewart.com',9),(19,6,'2022-11-23','13:20:00','Thea Waters','123121324','Thea@Waters.com',10),(20,6,'2022-11-25','13:30:00','Arianna Horton','123121324','Arianna@Horton.com',9),(21,7,'2022-11-25','15:30:00','Athena Tyler','123121324','Athena@Tyler.com',17),(22,3,'2022-11-25','16:30:00','Raelyn Hall','123121324','Raelyn@Hall.com',5),(23,3,'2022-11-26','16:30:00','Juliana Schultz','123121324','Juliana@Schultz.com',5),(24,10,'2022-11-26','18:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(25,8,'2022-11-26','07:40:00','Bob Greenly','213123523566','bob@greenly.com',17),(26,4,'2022-11-27','16:30:00','Raelyn Hall','123121324','Raelyn@Hall.com',9),(27,5,'2022-11-27','17:40:00','Brooklyn Watts','123121324','Brooklyn@Watts.com',10),(28,6,'2022-11-28','16:30:00','Julianna Schultz','123121324','Juliana@Schultz.com',10),(29,5,'2022-11-28','17:45:00','Isla Klein','1231231234','isla@klein.com',9),(30,8,'2022-11-29','16:30:00','Johnny Butler','123121324','Johnny@Butler.com',18),(31,10,'2022-11-29','17:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(32,2,'2022-11-30','16:30:00','Chase Diaz','123121324','Chase@Diaz.com',1),(33,2,'2022-11-30','07:30:00','Miracle Houston','123121324','Miracle@Houston.com',1),(34,5,'2022-11-30','14:20:00','Adeline Stewart','123121324','Adeline@Stewart.com',9),(35,2,'2022-10-01','17:40:00','Brooklyn Watts','123121324','Brooklyn@Watts.com',1),(36,2,'2022-10-02','18:20:00','Rylan Wood','123121324','Rylan@Wood.com',2),(37,2,'2022-10-02','07:30:00','Miracle Houston','123121324','Miracle@Houston.com',1),(38,5,'2022-10-22','13:30:00','Adeline Stewart','123121324','Adeline@Stewart.com',9),(39,6,'2022-10-03','13:20:00','Thea Waters','123121324','Thea@Waters.com',10),(40,6,'2022-10-04','13:30:00','Arianna Horton','123121324','Arianna@Horton.com',9),(41,7,'2022-10-05','15:30:00','Athena Tyler','123121324','Athena@Tyler.com',17),(42,3,'2022-10-06','16:30:00','Raelyn Hall','123121324','Raelyn@Hall.com',5),(43,3,'2022-10-07','16:30:00','Juliana Schultz','123121324','Juliana@Schultz.com',5),(44,10,'2022-10-08','18:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(45,8,'2022-10-09','07:40:00','Bob Greenly','213123523566','bob@greenly.com',17),(46,4,'2022-10-10','16:30:00','Raelyn Hall','123121324','Raelyn@Hall.com',9),(47,5,'2022-10-11','17:40:00','Brooklyn Watts','123121324','Brooklyn@Watts.com',10),(48,6,'2022-10-12','16:30:00','Julianna Schultz','123121324','Juliana@Schultz.com',10),(49,5,'2022-10-13','17:45:00','Isla Klein','1231231234','isla@klein.com',9),(50,8,'2022-10-14','16:30:00','Johnny Butler','123121324','Johnny@Butler.com',18),(51,10,'2022-10-15','17:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(52,2,'2022-10-16','16:30:00','Chase Diaz','123121324','Chase@Diaz.com',1),(53,2,'2022-10-17','07:30:00','Miracle Houston','123121324','Miracle@Houston.com',1),(54,5,'2022-11-18','14:20:00','Adeline Stewart','123121324','Adeline@Stewart.com',9),(55,10,'2022-10-19','17:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(56,2,'2022-10-20','16:30:00','Chase Diaz','123121324','Chase@Diaz.com',1),(57,2,'2022-10-21','07:30:00','Miracle Houston','123121324','Miracle@Houston.com',1),(58,5,'2022-11-22','14:20:00','Adeline Stewart','123121324','Adeline@Stewart.com',9),(59,2,'2022-10-23','17:40:00','Brooklyn Watts','123121324','Brooklyn@Watts.com',1),(60,2,'2022-10-23','18:20:00','Rylan Wood','123121324','Rylan@Wood.com',2),(61,2,'2022-10-23','07:30:00','Miracle Houston','123121324','Miracle@Houston.com',1),(62,5,'2022-10-23','13:30:00','Adeline Stewart','123121324','Adeline@Stewart.com',9),(63,6,'2022-10-23','13:20:00','Thea Waters','123121324','Thea@Waters.com',10),(64,6,'2022-10-25','13:30:00','Arianna Horton','123121324','Arianna@Horton.com',9),(65,7,'2022-10-25','15:30:00','Athena Tyler','123121324','Athena@Tyler.com',17),(66,3,'2022-10-25','16:30:00','Raelyn Hall','123121324','Raelyn@Hall.com',5),(67,3,'2022-10-26','16:30:00','Juliana Schultz','123121324','Juliana@Schultz.com',5),(68,10,'2022-10-26','18:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(69,8,'2022-10-26','07:40:00','Bob Greenly','213123523566','bob@greenly.com',17),(70,4,'2022-10-27','16:30:00','Raelyn Hall','123121324','Raelyn@Hall.com',9),(71,5,'2022-10-27','17:40:00','Brooklyn Watts','123121324','Brooklyn@Watts.com',10),(72,6,'2022-10-28','16:30:00','Julianna Schultz','123121324','Juliana@Schultz.com',10),(73,5,'2022-10-28','17:45:00','Isla Klein','1231231234','isla@klein.com',9),(74,8,'2022-10-29','16:30:00','Johnny Butler','123121324','Johnny@Butler.com',18),(75,10,'2022-10-29','17:30:00','Natalie Davis','1231231234','natalie@davis.com',17),(76,2,'2022-10-30','16:30:00','Chase Diaz','123121324','Chase@Diaz.com',1),(77,2,'2022-10-30','07:30:00','Miracle Houston','123121324','Miracle@Houston.com',1),(78,5,'2022-10-30','14:20:00','Adeline Stewart','123121324','Adeline@Stewart.com',9),(79,5,'2022-12-13','18:15:00','Frodo Baggins','1231231234','frodo@baggins.com',9);
/*!40000 ALTER TABLE `reservation_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurant` (
  `restaurant_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `address` varchar(120) NOT NULL,
  `cuisine_type` varchar(30) NOT NULL,
  `back_story` varchar(1500) NOT NULL,
  PRIMARY KEY (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES (1,'Bon Appetiti','10th Street Ave, NYC, NY, 113642, USA','American','Ted and James Bradley were born and raised in New York City, NY. In early 1920s, they open the Bon Appetit Paris restaruarnt in small town of Glen Cove, NY. They always holding to tehir true motto The Best Food, The Best Restaurant. Many people loved so that they decide about it to their friends and family. Unforuntely, over the course of years since 1920s, they were grow tire the orginal location and decide to open up newer and better version the restaurant. but then the popularity went down due to the great depression. The orginal owners got sick and malnurshed during at the time and they decesse and the restuarnt was closed for long time. After many years had pass. Unknown new oweners some how gain the opportunity in 21th century and decide to create website about this restaurant and had modern day touches to it.');
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_table`
--

DROP TABLE IF EXISTS `restaurant_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurant_table` (
  `restaurant_table_id` int NOT NULL AUTO_INCREMENT,
  `table_number` int NOT NULL,
  `max_chairs` int NOT NULL,
  `restaurant_id` int NOT NULL,
  PRIMARY KEY (`restaurant_table_id`),
  UNIQUE KEY `table_number` (`table_number`,`restaurant_id`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `restaurant_table_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_table`
--

LOCK TABLES `restaurant_table` WRITE;
/*!40000 ALTER TABLE `restaurant_table` DISABLE KEYS */;
INSERT INTO `restaurant_table` VALUES (1,1,2,1),(2,2,2,1),(3,3,2,1),(4,4,2,1),(5,5,3,1),(6,6,3,1),(7,7,3,1),(8,8,3,1),(9,9,6,1),(10,10,6,1),(11,11,6,1),(12,12,6,1),(13,13,6,1),(14,14,6,1),(15,15,6,1),(16,16,6,1),(17,17,10,1),(18,18,10,1),(19,19,10,1),(20,20,10,1);
/*!40000 ALTER TABLE `restaurant_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_schedule`
--

DROP TABLE IF EXISTS `staff_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `staff_schedule_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_schedule`
--

LOCK TABLES `staff_schedule` WRITE;
/*!40000 ALTER TABLE `staff_schedule` DISABLE KEYS */;
INSERT INTO `staff_schedule` VALUES (1,6,'2022-12-06 06:00:00','2022-12-06 18:59:00'),(2,9,'2022-12-07 06:00:00','2022-12-07 16:00:00'),(3,9,'2022-12-08 06:00:00','2022-12-08 16:00:00'),(4,9,'2022-12-09 06:00:00','2022-12-09 16:00:00'),(5,9,'2022-12-10 06:00:00','2022-12-10 16:00:00'),(6,9,'2022-12-11 06:00:00','2022-12-11 16:00:00'),(7,9,'2022-12-12 06:00:00','2022-12-12 16:00:00'),(8,9,'2022-12-13 06:00:00','2022-12-13 16:00:00'),(9,9,'2022-12-15 06:00:00','2022-12-15 16:00:00'),(10,9,'2022-12-16 06:00:00','2022-12-16 16:00:00'),(11,9,'2022-12-17 06:00:00','2022-12-17 16:00:00'),(12,9,'2022-12-21 06:00:00','2022-12-21 16:00:00'),(13,9,'2022-12-22 06:00:00','2022-12-22 16:00:00'),(14,9,'2022-12-23 06:00:00','2022-12-23 16:00:00'),(15,10,'2022-12-07 10:30:00','2022-12-07 21:00:00'),(16,10,'2022-12-08 10:30:00','2022-12-08 21:00:00'),(17,10,'2022-12-09 10:30:00','2022-12-09 23:00:00'),(18,10,'2022-12-10 10:30:00','2022-12-10 23:00:00'),(19,10,'2022-12-13 10:30:00','2022-12-13 21:00:00'),(20,10,'2022-12-15 10:30:00','2022-12-15 21:00:00'),(21,10,'2022-12-16 10:30:00','2022-12-16 23:00:00'),(22,10,'2022-12-17 10:30:00','2022-12-17 23:00:00'),(23,10,'2022-12-21 10:30:00','2022-12-21 21:00:00'),(24,10,'2022-12-22 10:30:00','2022-12-22 21:00:00'),(25,11,'2022-12-07 06:00:00','2022-12-07 16:00:00'),(26,11,'2022-12-08 06:00:00','2022-12-08 16:00:00'),(27,11,'2022-12-09 06:00:00','2022-12-09 16:00:00'),(28,11,'2022-12-10 06:00:00','2022-12-10 16:00:00'),(29,11,'2022-12-11 06:00:00','2022-12-11 16:00:00'),(30,11,'2022-12-12 06:00:00','2022-12-12 16:00:00'),(31,11,'2022-12-13 06:00:00','2022-12-13 16:00:00'),(32,11,'2022-12-14 06:00:00','2022-12-14 16:00:00'),(33,11,'2022-12-16 06:00:00','2022-12-16 16:00:00'),(34,11,'2022-12-17 06:00:00','2022-12-17 16:00:00'),(35,11,'2022-12-21 06:00:00','2022-12-21 16:00:00'),(36,11,'2022-12-22 06:00:00','2022-12-22 16:00:00'),(37,11,'2022-12-23 06:00:00','2022-12-23 16:00:00'),(38,12,'2022-12-07 10:30:00','2022-12-07 21:00:00'),(39,12,'2022-12-08 10:30:00','2022-12-08 21:00:00'),(40,12,'2022-12-09 10:30:00','2022-12-09 23:00:00'),(41,12,'2022-12-10 10:30:00','2022-12-10 23:00:00'),(42,12,'2022-12-13 10:30:00','2022-12-13 21:00:00'),(43,12,'2022-12-15 10:30:00','2022-12-15 21:00:00'),(44,12,'2022-12-16 10:30:00','2022-12-16 23:00:00'),(45,12,'2022-12-17 10:30:00','2022-12-17 23:00:00'),(46,12,'2022-12-18 07:00:00','2022-12-18 16:30:00'),(47,12,'2022-12-21 10:30:00','2022-12-21 21:00:00'),(48,12,'2022-12-22 10:30:00','2022-12-22 21:00:00'),(49,13,'2022-12-07 10:30:00','2022-12-07 19:00:00'),(50,13,'2022-12-08 10:30:00','2022-12-08 19:00:00'),(51,13,'2022-12-09 10:30:00','2022-12-09 21:00:00'),(52,13,'2022-12-10 10:30:00','2022-12-10 21:00:00'),(53,13,'2022-12-14 10:30:00','2022-12-14 19:00:00'),(54,13,'2022-12-15 10:30:00','2022-12-15 21:00:00'),(55,13,'2022-12-16 10:30:00','2022-12-16 21:00:00'),(56,13,'2022-12-17 10:30:00','2022-12-17 21:00:00'),(57,13,'2022-12-18 07:00:00','2022-12-18 16:30:00'),(58,13,'2022-12-19 10:30:00','2022-12-19 19:00:00'),(59,13,'2022-12-20 10:30:00','2022-12-20 19:00:00'),(60,13,'2022-12-23 10:30:00','2022-12-23 19:00:00');
/*!40000 ALTER TABLE `staff_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(75) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_type` int NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type` (`user_type`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'steven@cromb.com','Steven','Cromb','0040f2abc2cff0c8f59883b99ae9fab6',1,'2022-11-04 00:00:00',1,'1231231234'),(4,'bob@villa.com','Bob','Villa','0040f2abc2cff0c8f59883b99ae9fab6',2,'2022-11-22 00:00:00',1,'1231231234'),(6,'henry@seruvani.com','Henry','Seruvani','465918f634ae09b32120351cfb4c871c',3,'2022-12-05 00:00:00',1,'2131231245'),(8,'julie@civuty.com','Julie','Civuty','be1e79a1b76d87084fcc6a9621fc0eed',3,'2022-12-06 00:00:00',1,'3463463467'),(9,'xavier@radin.com','Xavier','Radin','0040f2abc2cff0c8f59883b99ae9fab6',3,'2022-12-06 11:03:05',1,'1231231234'),(10,'ruby@vanca.com','Rubia','Vanca','0040f2abc2cff0c8f59883b99ae9fab6',2,'2022-12-06 00:00:00',1,'1231231234'),(11,'ted@yaniston.com','Ted','Yaniston','0040f2abc2cff0c8f59883b99ae9fab6',3,'2022-12-06 11:03:05',1,'1231231234'),(12,'jessica@aroyu.com','Jessica','Aroyu','0040f2abc2cff0c8f59883b99ae9fab6',3,'2022-12-06 11:03:05',1,'1231231234'),(13,'sarah@lim.com','Sarah','Lim','0040f2abc2cff0c8f59883b99ae9fab6',3,'2022-12-06 11:03:05',1,'1231231234');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (2,'manager'),(1,'owner'),(3,'staff');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-13 23:02:24
