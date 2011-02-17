-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 16, 2011 at 08:58 PM
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
-- Table structure for table `mwp_sessions`
-- 

CREATE TABLE `mwp_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `mwp_sessions`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `mwp_users`
-- 

INSERT INTO `mwp_users` VALUES (3, 'jogi', '21232f297a57a5a743894a0e4a801fc3', 1);