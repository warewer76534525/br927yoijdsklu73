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
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `currency` */

insert  into `currency`(`name`,`type`) values ('AUD','SNAP'),('JPY','SNAP'),('MYR','SINTESIS');

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
) ENGINE=InnoDB AUTO_INCREMENT=7880 DEFAULT CHARSET=latin1;

/*Data for the table `rates_log` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


DROP TABLE IF EXISTS `mwp_news`;

CREATE TABLE `mwp_news` (
  `id` int(11) NOT NULL auto_increment,
  `headline` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `author` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `mwp_news`
-- 

INSERT INTO `mwp_news` VALUES (1, 'testing aplikasi update', 'coba ini adalah isi dari content yang baru di update', 1, '2011-01-25 21:19:30', 'guest');
INSERT INTO `mwp_news` VALUES (2, 'testing aplikasi yang kedua untuk news', 'testing aplikasi yang kedua untuk news', 2, '2011-01-25 21:33:28', 'guest');

-- --------------------------------------------------------

-- 
-- Table structure for table `mwp_session`
-- 

DROP TABLE IF EXISTS `mwp_session`;

CREATE TABLE `mwp_session` (
  `id` int(11) NOT NULL auto_increment,
  `auth` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `mwp_session`
-- 

INSERT INTO `mwp_session` VALUES (3, 1, '2011-02-02 11:20:36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:2.0b9) Gecko/20100101 Firefox/4.0b9');

-- --------------------------------------------------------

-- 
-- Table structure for table `mwp_users`
-- 
DROP TABLE IF EXISTS `mwp_users`;

CREATE TABLE `mwp_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `mwp_users`
-- 

