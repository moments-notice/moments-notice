ALTER TABLE `rolls`
ADD  COLUMN `emulsion_id` int(10) unsigned NOT NULL AFTER `created`,
ADD  COLUMN `exp_date` int(10) unsigned NOT NULL AFTER `emulsion_id`,
ADD  COLUMN `film_type` varchar(255) DEFAULT NULL AFTER `exp_date`,
ADD  COLUMN `film_brand` varchar(255) DEFAULT NULL AFTER `film_type`,
ADD  COLUMN `film_name` varchar(255) DEFAULT NULL AFTER `film_brand`,
ADD  COLUMN `film_speed` int(10) unsigned NOT NULL AFTER `film_name`;
