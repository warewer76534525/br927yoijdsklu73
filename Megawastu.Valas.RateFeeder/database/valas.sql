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

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `name` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`name`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `currency` */

insert  into `currency`(`name`,`type`) values ('AUD','SNAP'),('AUDIDR','SNAP'),('CAD','SNAP'),('CADIDR','SNAP'),('CHF','SNAP'),('CHFIDR','SNAP'),('CNY','SNAP'),('CNYIDR','SNAP'),('EURIDR','SNAP'),('GBP','SNAP'),('GBPIDR','SNAP'),('HKD','SNAP'),('HKDIDR','SNAP'),('INR','SNAP'),('INRIDR','SNAP'),('JPY','SNAP'),('JPYIDR','SNAP'),('KRW','SNAP'),('KRWIDR','SNAP'),('MYR','SINTESIS'),('MYRIDR','SNAP'),('NZD','SNAP'),('NZDIDR','SNAP'),('PHP','SNAP'),('PHPIDR','SNAP'),('SAR','SNAP'),('SARIDR','SNAP'),('SGD','SNAP'),('SGDIDR','SNAP'),('THB','SNAP'),('THBIDR','SNAP'),('TWD','SNAP'),('TWDIDR','SNAP'),('XAU','SNAP'),('XAUIDR','SNAP');

/*Table structure for table `rates_log` */

DROP TABLE IF EXISTS `rates_log`;

CREATE TABLE `rates_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `currency` varchar(5) NOT NULL,
  `bid` double NOT NULL,
  `ask` double NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `currency_index` (`currency`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rates_log` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
