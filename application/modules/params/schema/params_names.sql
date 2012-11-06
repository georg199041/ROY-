SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;

START TRANSACTION;

DROP TABLE IF EXISTS `params_names`;
CREATE TABLE IF NOT EXISTS `params_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `params_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `params_types_code` varchar(255) DEFAULT NULL,
  `params_sources_id` int(11) DEFAULT NULL,
  `predefined_source` text,
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
  KEY `params_types_code` (`params_types_code`),
  CONSTRAINT `params_names_ibfk_1` FOREIGN KEY (`params_categories_id`) REFERENCES `params_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `params_names_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_names_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_names_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_names_ibfk_5` FOREIGN KEY (`params_types_code`) REFERENCES `params_types` (`code`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_names`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_names` BEFORE INSERT ON `params_names`
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

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_names`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_names` BEFORE UPDATE ON `params_names`
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

INSERT INTO `params_names` (`id`, `params_categories_id`, `title`, `params_types_code`, `params_sources_id`, `predefined_source`, `enabled`) VALUES
(1, NULL, 'Icon', 'TEXT', NULL, NULL, 'YES');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
