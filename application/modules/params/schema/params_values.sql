SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `params_values`;
CREATE TABLE IF NOT EXISTS `params_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `params_names_id` int(11) DEFAULT NULL,
  `value` varchar(255) NOT NULL,
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
  KEY `params_names_id` (`params_names_id`),
  CONSTRAINT `params_values_ibfk_1` FOREIGN KEY (`params_names_id`) REFERENCES `params_names` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_values_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_values_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_values_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_values`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_values` BEFORE INSERT ON `params_values`
FOR EACH ROW
BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP() ;
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
		SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP() ;
	ELSE
		SET `NEW`.`checked_out_ts` = NULL ;
	END IF ;
END ;
//
DELIMITER ;

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_values`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_values` BEFORE UPDATE ON `params_values`
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

INSERT INTO `params_values` (`id`, `params_names_id`, `value`) VALUES
(1, NULL, 'icon.png');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
