SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;

START TRANSACTION;

DROP TABLE IF EXISTS `params_categories`;
CREATE TABLE IF NOT EXISTS `params_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `params_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `params_categories_id` (`params_categories_id`),
  CONSTRAINT `params_categories_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_categories_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_categories_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_categories_ibfk_4` FOREIGN KEY (`params_categories_id`) REFERENCES `params_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_categories` BEFORE INSERT ON `params_categories`
FOR EACH ROW
BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END;
//
DELIMITER ;

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_categories` BEFORE UPDATE ON `params_categories`
FOR EACH ROW
BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END;
//
DELIMITER ;

INSERT INTO `params_categories` (`id`, `params_categories_id`, `title`, `enabled`) VALUES
(1, NULL, 'Тестовая категория', 'YES');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
