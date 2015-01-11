ALTER TABLE `orders`
ADD  COLUMN `shipped` int(10) unsigned NOT NULL AFTER `created`,
ADD  COLUMN `returned` int(10) unsigned NOT NULL AFTER `shipped`;
