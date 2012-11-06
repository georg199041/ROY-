SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `contents_posts`;
CREATE TABLE IF NOT EXISTS `contents_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `introtext` text,
  `fulltext` text,
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
  CONSTRAINT `contents_posts_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `contents_posts_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_posts_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_posts_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS `BEFORE_INSERT_contents_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_contents_posts` BEFORE INSERT ON `contents_posts`
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

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_contents_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_contents_posts` BEFORE UPDATE ON `contents_posts`
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

INSERT INTO `contents_posts` (`id`, `contents_categories_id`, `title`, `alias`, `introtext`, `fulltext`, `enabled`) VALUES
(1, 1, 'Тестовый контент', 'test_content', '<introtext>', '<fulltext>', 'YES');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;