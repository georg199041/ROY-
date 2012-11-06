SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `params_types`;
CREATE TABLE IF NOT EXISTS `params_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `source_required` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `params_types_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_types_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_types_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_types`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_types` BEFORE INSERT ON `params_types`
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

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_types`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_types` BEFORE UPDATE ON `params_types`
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

INSERT INTO `params_types` (`id`, `title`, `code`, `source_required`, `enabled`) VALUES
(1, NULL, 'SELECT', 'YES', 'YES'),
(2, NULL, 'TEXT', 'NO', 'YES');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
