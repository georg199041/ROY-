<?php

require_once 'Core/Model/Source/DbTable.php';

class Contents_Model_Source_Categories extends Core_Model_Source_DbTable
{
	public function install()
	{
		return;
	
$this->getAdapter()->query("
SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `contents_categories`;
CREATE TABLE IF NOT EXISTS `contents_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `contents_categories_id` (`contents_categories_id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `contents_categories_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `contents_categories_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_categories_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_categories_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TRIGGER `BEFORE_INSERT_CONTENTS_CATEGORIES` BEFORE INSERT ON `contents_categories`
FOR EACH ROW
BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END;

CREATE TRIGGER `BEFORE_UPDATE_CONTENTS_CATEGORIES` BEFORE UPDATE ON `contents_categories`
FOR EACH ROW
BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END;

INSERT INTO `contents_categories` (`id`, `contents_categories_id`, `title`, `alias`, `description`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, 'Тестовая категория', 'test_category', '<description>', 'YES', NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
");
	
	}
}