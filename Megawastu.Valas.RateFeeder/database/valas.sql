/*
SQLyog Ultimate - MySQL GUI v8.21 
MySQL - 5.1.43-community : Database - valas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`valas` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `valas`;

/*Table structure for table `rates` */

DROP TABLE IF EXISTS `rates`;

CREATE TABLE `rates` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `currency` varchar(5) NOT NULL,
  `bid` double NOT NULL,
  `ask` double NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `currency_index` (`currency`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `rates` */

insert  into `rates`(`id`,`currency`,`bid`,`ask`,`timestamp`) values (1,'IDR',0,0,'2011-01-18 06:43:01'),(2,'YUI',5,6,'2011-01-18 06:43:01'),(3,'AUD',3,2,'2011-01-18 06:43:01'),(4,'IDR',0,0,'2011-01-18 09:03:57'),(5,'YUI',5,6,'2011-01-18 09:03:57'),(6,'AUD',3,2,'2011-01-18 09:03:57'),(7,'IDR',0,0,'2011-01-19 20:03:09'),(8,'YUI',5,6,'2011-01-19 20:03:09'),(9,'AUD',3,2,'2011-01-19 20:03:09'),(10,'IDR',0,0,'2011-01-19 20:03:27'),(11,'YUI',5,6,'2011-01-19 20:03:27'),(12,'AUD',3,2,'2011-01-19 20:03:27'),(13,'IDR',0,0,'2011-01-19 20:03:47'),(14,'YUI',5,6,'2011-01-19 20:03:47'),(15,'AUD',3,2,'2011-01-19 20:03:47'),(16,'IDR',0,0,'2011-01-19 21:16:15'),(17,'YUI',5,6,'2011-01-19 21:16:15'),(18,'AUD',3,2,'2011-01-19 21:16:15');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
