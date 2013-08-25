DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
 `handle` varchar(25) NOT NULL,
 `rating` double NOT NULL,
 `mean` double NOT NULL,
 `volatility` double NOT NULL,
 `rating2v2` double NOT NULL,
 `mean2v2` double NOT NULL,
 `volatility2v2` double NOT NULL,
 `join_date` date NOT NULL,
 `email` varchar(255) NOT NULL,
 `avatar` varchar(255) NOT NULL,
 `gender` varchar(1) NOT NULL,
 `country` varchar(255) NOT NULL,
 `quote` varchar(1024) DEFAULT NULL,
 UNIQUE KEY `handle` (`handle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `map` varchar(255) NOT NULL,
 `handle_p1` varchar(255) NOT NULL,
 `rating_p1` double NOT NULL,
 `handle_p2` varchar(255) NOT NULL,
 `rating_p2` double NOT NULL,
 `faction_p1` varchar(255) NOT NULL,
 `faction_p2` varchar(255) NOT NULL,
 `leader_p1` varchar(255) NOT NULL,
 `leader_p2` varchar(255) NOT NULL,
 `winner` varchar(2) NOT NULL,
 `sports_p1` int(11) NOT NULL,
 `sports_p2` int(11) NOT NULL,
 `replay` blob NOT NULL,
 `date` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `games2v2`;

CREATE TABLE `games2v2` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `map` varchar(255) NOT NULL,
 `handle_w1` varchar(255) NOT NULL,
 `rating_w1` double NOT NULL,
 `handle_w2` varchar(255) NOT NULL,
 `rating_w2` double NOT NULL,
 `handle_l1` varchar(255) NOT NULL,
 `rating_l1` double NOT NULL,
 `handle_l2` varchar(255) NOT NULL,
 `rating_l2` double NOT NULL,
 `faction_w1` varchar(255) NOT NULL,
 `faction_w2` varchar(255) NOT NULL,
 `faction_l1` varchar(255) NOT NULL,
 `faction_l2` varchar(255) NOT NULL,
 `leader_w1` varchar(255) NOT NULL,
 `leader_w2` varchar(255) NOT NULL,
 `leader_l1` varchar(255) NOT NULL,
 `leader_l2` varchar(255) NOT NULL,
 `winner1` varchar(2) NOT NULL,
 `winner2` varchar(2) NOT NULL,
 `replay` blob NOT NULL,
 `date` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `game_id` int(11) NOT NULL,
 `handle` varchar(255) NOT NULL,
 `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `text` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `comments2v2`;

CREATE TABLE `comments2v2` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `game_id` int(11) NOT NULL,
 `handle` varchar(255) NOT NULL,
 `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `text` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
