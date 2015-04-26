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

DROP TABLE IF EXISTS `photos`;

CREATE TABLE `photos` (
  `id` bigint(64) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `secret` char(16) NOT NULL,
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

DROP TABLE IF EXISTS `development_log`;

CREATE TABLE `development_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `roll_id` bigint(64) unsigned NOT NULL,
  `developed` int(10) unsigned NOT NULL,
  `developer` varchar(255) DEFAULT NULL,
  `development_temp` varchar(255) DEFAULT NULL,
  `development_time` int(10) unsigned NOT NULL,
  `development_notes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lab_log`;

CREATE TABLE `lab_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mixing_date` int(10) unsigned NOT NULL,
  `chem_name` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;  

DROP TABLE IF EXISTS ShlongUrls;

CREATE TABLE ShlongUrls (
    `id` bigint(64) unsigned NOT NULL AUTO_INCREMENT,
    `short_url`   VARCHAR(255) NOT NULL,
    `long_url`    TEXT,
    `shortened`   TIMESTAMP,
    INDEX `long_urls` (long_url(255)),
    PRIMARY KEY (`id`),
    UNIQUE KEY `short` (`short_url`)
) ENGINE=InnoDB, CHARACTER SET utf8;

DROP TABLE IF EXISTS `ApiKeys`;

CREATE TABLE `ApiKeys` (
  `id` bigint(20) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `role_id` tinyint(3) unsigned NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `app_secret` varchar(64) NOT NULL,
  `app_callback` varchar(255) NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `app_title` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `deleted` int(11) unsigned NOT NULL,
  `disabled` int(11) unsigned NOT NULL,
  `last_modified` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `by_key` (`api_key`),
  KEY `by_user` (`user_id`,`deleted`,`created`),
  KEY `by_role` (`role_id`,`deleted`,`created`),
  KEY `by_role_created` (`role_id`,`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `OAuth2AccessTokens`;

CREATE TABLE `OAuth2AccessTokens` (
  `id` bigint(20) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `api_key_id` bigint(20) unsigned NOT NULL,
  `api_key_role_id` tinyint(3) unsigned NOT NULL,
  `access_token` varchar(64) NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `perms` tinyint(3) unsigned NOT NULL,
  `last_modified` int(11) unsigned NOT NULL,
  `expires` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `by_api_key` (`api_key_id`,`expires`,`created`),
  KEY `by_user_key` (`user_id`,`api_key_id`,`expires`, `api_key_role_id`),
  KEY `by_user` (`user_id`,`expires`, `api_key_role_id`),
  KEY `by_token` (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `OAuth2GrantTokens`;

CREATE TABLE `OAuth2GrantTokens` (
  `code` varchar(40) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `api_key_id` varchar(40) NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `perms` tinyint(3) unsigned NOT NULL,
  `ttl` int(11) unsigned NOT NULL,
  PRIMARY KEY (`code`),
  KEY `by_user_key` (`user_id`,`api_key_id`),
  KEY `by_created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
