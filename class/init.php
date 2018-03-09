<?php
class init{
	public function init(){
		$db = new db();
		$not_pre="";
		if (pre=='') {
			$not_pre="CREATE TABLE IF NOT EXISTS `users` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(250) NOT NULL DEFAULT '',
			  `login` varchar(250) NOT NULL DEFAULT '',
			  `password` varchar(250) NOT NULL DEFAULT '',
			  `url` varchar(250) NOT NULL DEFAULT '',
			  `pre` varchar(250) NOT NULL DEFAULT '',
			  `time_create` varchar(250) NOT NULL DEFAULT '',
			  `time_update` varchar(250) NOT NULL DEFAULT '',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
			
			$not_pre.="CREATE TABLE IF NOT EXISTS `error_log` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(250) NOT NULL DEFAULT '',
			  `who` varchar(250) NOT NULL DEFAULT '',
			  `pre` varchar(250) NOT NULL DEFAULT '',
			  `q` varchar(250) NOT NULL DEFAULT '',
			  `array` text,
			  `time_create` varchar(250) NOT NULL DEFAULT '',
			  `time_update` varchar(250) NOT NULL DEFAULT '',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		} else {
			$not_pre.="CREATE TABLE IF NOT EXISTS `".pre."users` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `login` varchar(250) NOT NULL DEFAULT '',
			  `password` varchar(250) NOT NULL DEFAULT '',
			  `time_create` varchar(250) NOT NULL DEFAULT '',
			  `time_update` varchar(250) NOT NULL DEFAULT '',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
			
			$not_pre.="CREATE TABLE IF NOT EXISTS `".pre."videos` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(500) NOT NULL DEFAULT '',
			  `body` text,
			  `time_create` varchar(250) NOT NULL DEFAULT '',
			  `time_update` varchar(250) NOT NULL DEFAULT '',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
			
			$not_pre.="CREATE TABLE IF NOT EXISTS `".pre."vebinars` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(500) NOT NULL DEFAULT '',
			  `body` text,
			  `date` varchar(500) NOT NULL DEFAULT '',
			  `time_create` varchar(250) NOT NULL DEFAULT '',
			  `time_update` varchar(250) NOT NULL DEFAULT '',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		}
		
		if ($not_pre!='') { $rows = $db->link->exec($not_pre); }

		$db->link = null;
	}
}
?>