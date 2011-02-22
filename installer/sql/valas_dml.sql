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

insert  into `currency`(`name`,`type`) values ('AUD','SNAP'),('AUDIDR','SNAP'),('CAD','SNAP'),('CADIDR','SNAP'),('CHF','SNAP'),('CHFIDR','SNAP'),('CNY','SINTESIS'),('CNYIDR','SINTESIS'),('EURIDR','SNAP'),('GBP','SNAP'),('GBPIDR','SNAP'),('HKD','SINTESIS'),('HKDIDR','SINTESIS'),('IDR','SINTESIS'),('INR','SINTESIS'),('INRIDR','SINTESIS'),('JPY','SNAP'),('JPYIDR','SNAP'),('KRW','SINTESIS'),('KRWIDR','SINTESIS'),('MYR','SINTESIS'),('MYRIDR','SNAP'),('NZD','SNAP'),('NZDIDR','SNAP'),('PHP','SINTESIS'),('PHPIDR','SINTESIS'),('SAR','SINTESIS'),('SARIDR','SINTESIS'),('SGD','SNAP'),('SGDIDR','SNAP'),('THB','SINTESIS'),('THBIDR','SINTESIS'),('TWD','SNAP'),('TWDIDR','SNAP'),('XAU','SNAP'),('XAUIDR','SNAP');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
