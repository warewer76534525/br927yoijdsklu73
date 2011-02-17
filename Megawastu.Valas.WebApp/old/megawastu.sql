-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 02, 2011 at 08:32 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `megawastu`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `mwp_news`
-- 

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

