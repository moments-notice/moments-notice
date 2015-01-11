DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deleted` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `password` char(64) DEFAULT NULL,
  `conf_code` char(24) DEFAULT NULL,
  `confirmed` int(10) unsigned NOT NULL,
  `cluster_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `by_email` (`email`),
  UNIQUE KEY `by_username` (`username`,`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users_password_reset`;

CREATE TABLE `users_password_reset` (
  `user_id` int(10) unsigned NOT NULL,
  `reset_code` char(32) DEFAULT NULL,
  `created` int(10) unsigned NOT NULL,
  UNIQUE KEY `by_code` (`reset_code`),
  KEY `by_user` (`user_id`),
  KEY `by_timestamp` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users_address`;

CREATE TABLE `users_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `street1` varchar(255) DEFAULT NULL,
  `street2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shipping_address_id` int(10) unsigned NOT NULL,
  `roll_id` bigint(64) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `shipped` int(10) unsigned NOT NULL,
  `returned` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `rolls`;

CREATE TABLE `rolls` (
  `id` bigint(64) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `emulsion_id` int(10) unsigned NOT NULL,
  `exp_date` int(10) unsigned NOT NULL,
  `film_type` varchar(255) DEFAULT NULL,
  `film_brand` varchar(255) DEFAULT NULL,
  `film_name` varchar(255) DEFAULT NULL,
  `film_speed` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `InviteCodes`;

CREATE TABLE `InviteCodes` (
  `code` char(12) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `redeemed` int(10) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  `invited_by` int(11) unsigned NOT NULL,
  UNIQUE KEY `by_code` (`code`),
  KEY `by_email` (`email`),
  KEY `by_created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
