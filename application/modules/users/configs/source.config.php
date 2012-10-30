<?php

return "
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`created_ts` int(11) NULL DEFAULT '0',
	`created_by` int(11) NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE KEY `email` (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

ALTER TABLE `users` ADD INDEX `created_by` (`created_by`);
ALTER TABLE `users` ADD CONSTRAINT `users_created_by2users_id` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
";