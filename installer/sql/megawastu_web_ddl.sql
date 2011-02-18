DROP TABLE IF EXISTS `mwp_news`;

CREATE TABLE `mwp_news` (
  `id` int(11) NOT NULL auto_increment,
  `headline` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `author` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `mwp_sessions`;

CREATE TABLE `mwp_sessions` (
`session_id` varchar(40) NOT NULL default '0',
`ip_address` varchar(16) NOT NULL default '0',
`user_agent` varchar(50) NOT NULL,
`last_activity` int(10) unsigned NOT NULL default '0',
`user_data` text NOT NULL DEFAULT '',
PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mwp_users`;

CREATE TABLE `mwp_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;