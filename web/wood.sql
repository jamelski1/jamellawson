-- MySQL dump 10.11
--
-- Host: localhost    Database: db_sestrong
-- ------------------------------------------------------
-- Server version	5.0.95

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
-- Table structure for table `Wood`
--

DROP TABLE IF EXISTS `Wood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Wood` (
  `wid` bigint(20) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `density` double default '0',
  `hardness` enum('soft','medium','hard','very hard') NOT NULL default 'medium',
  `workability` enum('very difficult','difficult','moderate','easy') NOT NULL default 'moderate',
  `color` varchar(64) NOT NULL,
  `notes` varchar(512) default NULL,
  PRIMARY KEY  (`wid`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Wood`
--

LOCK TABLES `Wood` WRITE;
/*!40000 ALTER TABLE `Wood` DISABLE KEYS */;
INSERT INTO `Wood` VALUES (1,'oak',45,'hard','moderate','red, white and brown','quater sawn oak is highly flecked'),(56,'Quarter Sawn White Oak',45,'hard','difficult','like white oak, but with &quot;fleck&quot;','Much more delicate and exciting than white oak that has been flat sawn.'),(4,'maple',42,'hard','difficult','white','always flat sawn out of sap wood only'),(5,'ebony',60,'very hard','very difficult','deep black','invisible grain'),(10,'elm',45,'hard','moderate','red','not much elm is left in the midwest, but its fine grain and light colors are beautiful.'),(15,'rosewood',44.3,'hard','difficult','brown, purple and black','Lovely grain, but it quickly sun tans to a very lighter shade.  Pretty expensive.'),(18,'padouk',42,'hard','moderate','orange, changes to brown','The brilliant orange color is very attractive, but padouk sun tans to an ugly brown -- also, the dust is highly toxic.');
/*!40000 ALTER TABLE `Wood` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-23 10:17:59
