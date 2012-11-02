<?php

require_once 'Core/Model/Source/DbTable.php';

class Contents_Model_Source_StaticPosts extends Core_Model_Source_DbTable
{
	public function install()
	{
		return;
		
$this->getAdapter()->query("
SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;

START TRANSACTION;

#DROP TABLE IF EXISTS `contents_static_posts`;
CREATE TABLE IF NOT EXISTS `contents_static_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `contents_static_posts_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_static_posts_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_static_posts_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `contents_static_posts` (`id`, `title`, `alias`, `introtext`, `fulltext`, `enabled`, `created_by`, `created_ts`) VALUES
(1, 'Test static content', 'test-static-alias', '<introtext>', '<fulltext>', 'YES', '1', UNIX_TIMESTAMP()),
(2, 'Other static content', 'other-static-alias', '<introtext>', '<fulltext>', 'YES', '1', UNIX_TIMESTAMP());
		
SET FOREIGN_KEY_CHECKS=1;

COMMIT;
");

	}
}