SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `params_references`;
CREATE TABLE IF NOT EXISTS `params_references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` varchar(255) NOT NULL,
  `ref_parentid` int(11) DEFAULT NULL,
  `params_categories_id` int(11) DEFAULT NULL,
  `params_names_id` int(11) DEFAULT NULL,
  `inheritable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`id`),
  KEY `params_names_id` (`params_names_id`),
  KEY `params_categories_id` (`params_categories_id`),
  CONSTRAINT `params_references_ibfk_1` FOREIGN KEY (`params_categories_id`) REFERENCES `params_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `params_references_ibfk_2` FOREIGN KEY (`params_names_id`) REFERENCES `params_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `params_references` (`id`, `ref_table`, `ref_parentid`, `params_categories_id`, `params_names_id`, `inheritable`) VALUES
(1, 'contents_posts', NULL, NULL, 1, 'YES');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
