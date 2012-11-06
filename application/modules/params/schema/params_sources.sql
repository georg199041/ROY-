SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `params_sources`;
CREATE TABLE IF NOT EXISTS `params_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` varchar(255) NOT NULL,
  `ref_field` varchar(255) NOT NULL,
  `ref_parentid` int(11) DEFAULT NULL,
  `ref_type` enum('LIST','TREE') NOT NULL DEFAULT 'LIST',
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
  CONSTRAINT `params_sources_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_sources_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `params_sources_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_sources`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_sources` BEFORE INSERT ON `params_sources`
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

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_sources`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_sources` BEFORE UPDATE ON `params_sources`
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

INSERT INTO `params_sources` (`id`, `ref_table`, `ref_field`, `ref_parentid`, `ref_type`, `enabled`) VALUES
(1, 'contents_static_posts', 'id', NULL, 'LIST', 'YES');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
