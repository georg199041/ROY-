-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 06 2012 г., 17:42
-- Версия сервера: 5.1.62-community
-- Версия PHP: 5.3.9-ZS5.6.0

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sunny_roy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `club_members`
--

DROP TABLE IF EXISTS `club_members`;
CREATE TABLE IF NOT EXISTS `club_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `contacts` text NOT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` int(11) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` text NOT NULL,
  `comment` text,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `ref_table`, `ref_id`, `name`, `email`, `ip`, `user_agent`, `comment`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, NULL, 'afwefwef', 'afewefrwe', 'afewfwefg', 'efwefgwegfasw', 'ewfrgtghrhqedfwe', NULL, NULL, NULL, NULL, NULL, 1350757817),
(2, NULL, NULL, 'efwerfw', 'ddddd', 'dddddd', 'ddddd', NULL, NULL, NULL, NULL, 1350758241, NULL, 1350758327);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `contents_categories`
--

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
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `contents_categories`
--

INSERT INTO `contents_categories` (`id`, `contents_categories_id`, `title`, `alias`, `description`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, 'Тестовая категория', 'test_category', '<description>', 'YES', NULL, NULL, NULL, 1352207530, NULL, NULL);

--
-- Триггеры `contents_categories`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_contents_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_contents_categories` BEFORE INSERT ON `contents_categories`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_contents_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_contents_categories` BEFORE UPDATE ON `contents_categories`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `contents_posts`
--

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
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `contents_posts`
--

INSERT INTO `contents_posts` (`id`, `contents_categories_id`, `title`, `alias`, `introtext`, `fulltext`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, 1, 'Тестовый контент', 'test_content', '<introtext>', '<fulltext>', 'YES', NULL, NULL, NULL, 1352207519, NULL, NULL);

--
-- Триггеры `contents_posts`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_contents_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_contents_posts` BEFORE INSERT ON `contents_posts`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_contents_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_contents_posts` BEFORE UPDATE ON `contents_posts`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `contents_static_posts`
--

DROP TABLE IF EXISTS `contents_static_posts`;
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
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `contents_static_posts`
--

INSERT INTO `contents_static_posts` (`id`, `title`, `alias`, `introtext`, `fulltext`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, 'Test static content', 'test_static', '<introtext>', '<fulltext>', 'YES', NULL, NULL, NULL, 1352207545, NULL, NULL);

--
-- Триггеры `contents_static_posts`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_contents_static_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_contents_static_posts` BEFORE INSERT ON `contents_static_posts`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_contents_static_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_contents_static_posts` BEFORE UPDATE ON `contents_static_posts`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `core_entity`
--

DROP TABLE IF EXISTS `core_entity`;
CREATE TABLE IF NOT EXISTS `core_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `faq_categories`
--

DROP TABLE IF EXISTS `faq_categories`;
CREATE TABLE IF NOT EXISTS `faq_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `faq_categories_id` (`faq_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `faq_new_questions`
--

DROP TABLE IF EXISTS `faq_new_questions`;
CREATE TABLE IF NOT EXISTS `faq_new_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `faq_posts`
--

DROP TABLE IF EXISTS `faq_posts`;
CREATE TABLE IF NOT EXISTS `faq_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `faq_categories_id` (`faq_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `feedback_messages`
--

DROP TABLE IF EXISTS `feedback_messages`;
CREATE TABLE IF NOT EXISTS `feedback_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `feedback_phones`
--

DROP TABLE IF EXISTS `feedback_phones`;
CREATE TABLE IF NOT EXISTS `feedback_phones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `comment` text,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `fiends_organizations`
--

DROP TABLE IF EXISTS `fiends_organizations`;
CREATE TABLE IF NOT EXISTS `fiends_organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `fiends_personalities`
--

DROP TABLE IF EXISTS `fiends_personalities`;
CREATE TABLE IF NOT EXISTS `fiends_personalities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `languages_translations`
--

DROP TABLE IF EXISTS `languages_translations`;
CREATE TABLE IF NOT EXISTS `languages_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_field` varchar(255) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `languages_id` (`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `navigation_pages`
--

DROP TABLE IF EXISTS `navigation_pages`;
CREATE TABLE IF NOT EXISTS `navigation_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navigation_pages_id` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `type` enum('URI','MVC') NOT NULL DEFAULT 'URI',
  `uri` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `params` text,
  `route` varchar(255) DEFAULT NULL,
  `reset_params` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `encode_url` enum('YES','NO') NOT NULL DEFAULT 'YES',
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
  KEY `navigation_pages_id` (`navigation_pages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `navigation_pages`
--

INSERT INTO `navigation_pages` (`id`, `navigation_pages_id`, `label`, `type`, `uri`, `action`, `controller`, `module`, `params`, `route`, `reset_params`, `encode_url`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, 'Administration', 'MVC', NULL, 'index', 'admin-index', 'default', NULL, NULL, 'YES', 'YES', 'YES', NULL, NULL, NULL, 1352207573, NULL, NULL);

--
-- Триггеры `navigation_pages`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_navigation_pages`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_navigation_pages` BEFORE INSERT ON `navigation_pages`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_navigation_pages`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_navigation_pages` BEFORE UPDATE ON `navigation_pages`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `navigation_roles`
--

DROP TABLE IF EXISTS `navigation_roles`;
CREATE TABLE IF NOT EXISTS `navigation_roles` (
  `navigation_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `type` enum('ALLOW','DENY') NOT NULL DEFAULT 'ALLOW',
  KEY `navigation_id` (`navigation_id`),
  KEY `roles_id` (`roles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `navigation_roles`
--

INSERT INTO `navigation_roles` (`navigation_id`, `roles_id`, `type`) VALUES
(2, 1, 'ALLOW');

-- --------------------------------------------------------

--
-- Структура таблицы `newsletter_subscribers`
--

DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `newsletter_templates`
--

DROP TABLE IF EXISTS `newsletter_templates`;
CREATE TABLE IF NOT EXISTS `newsletter_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_from` varchar(255) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_message` text NOT NULL,
  `start_at` int(11) DEFAULT NULL,
  `finish_at` int(11) DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news_categories`
--

DROP TABLE IF EXISTS `news_categories`;
CREATE TABLE IF NOT EXISTS `news_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `news_categories_id` (`news_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news_posts`
--

DROP TABLE IF EXISTS `news_posts`;
CREATE TABLE IF NOT EXISTS `news_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_categories_id` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `introtext` text,
  `fulltext` text,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `news_categories_id` (`news_categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `news_posts`
--

INSERT INTO `news_posts` (`id`, `news_categories_id`, `alias`, `introtext`, `fulltext`, `title`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, NULL, NULL, NULL, 'qwertyuiop[', NULL, 0, NULL, 1351433384, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `params_categories`
--

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
  KEY `params_categories_id` (`params_categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `params_categories`
--

INSERT INTO `params_categories` (`id`, `params_categories_id`, `title`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, 'Тестовая категория', 'YES', NULL, NULL, NULL, 1352207891, NULL, NULL);

--
-- Триггеры `params_categories`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_categories` BEFORE INSERT ON `params_categories`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_categories` BEFORE UPDATE ON `params_categories`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `params_names`
--

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
  KEY `params_types_code` (`params_types_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `params_names`
--

INSERT INTO `params_names` (`id`, `params_categories_id`, `title`, `params_types_code`, `params_sources_id`, `predefined_source`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, 'Icon', 'TEXT', NULL, NULL, 'YES', NULL, NULL, NULL, 1352207662, NULL, NULL);

--
-- Триггеры `params_names`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_names`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_names` BEFORE INSERT ON `params_names`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_names`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_names` BEFORE UPDATE ON `params_names`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `params_references`
--

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
  KEY `params_categories_id` (`params_categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `params_references`
--

INSERT INTO `params_references` (`id`, `ref_table`, `ref_parentid`, `params_categories_id`, `params_names_id`, `inheritable`) VALUES
(1, 'contents_posts', NULL, NULL, 1, 'YES');

-- --------------------------------------------------------

--
-- Структура таблицы `params_sources`
--

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
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `params_sources`
--

INSERT INTO `params_sources` (`id`, `ref_table`, `ref_field`, `ref_parentid`, `ref_type`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, 'contents_static_posts', 'id', NULL, 'LIST', 'YES', NULL, NULL, NULL, 1352207682, NULL, NULL);

--
-- Триггеры `params_sources`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_sources`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_sources` BEFORE INSERT ON `params_sources`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_sources`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_sources` BEFORE UPDATE ON `params_sources`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `params_types`
--

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
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `params_types`
--

INSERT INTO `params_types` (`id`, `title`, `code`, `source_required`, `enabled`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, 'Generic select element', 'SELECT', 'YES', 'YES', NULL, NULL, NULL, 1352207801, NULL, 1352211787),
(2, NULL, 'TEXT', 'NO', 'YES', NULL, NULL, NULL, 1352207801, NULL, NULL);

--
-- Триггеры `params_types`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_types`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_types` BEFORE INSERT ON `params_types`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_types`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_types` BEFORE UPDATE ON `params_types`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `params_values`
--

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
  KEY `params_names_id` (`params_names_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `params_values`
--

INSERT INTO `params_values` (`id`, `params_names_id`, `value`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, 'icon.png', NULL, NULL, NULL, 1352207701, NULL, NULL);

--
-- Триггеры `params_values`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_params_values`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_params_values` BEFORE INSERT ON `params_values`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP() ;
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
		SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP() ;
	ELSE
		SET `NEW`.`checked_out_ts` = NULL ;
	END IF ;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_params_values`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_params_values` BEFORE UPDATE ON `params_values`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `photogallery_albums`
--

DROP TABLE IF EXISTS `photogallery_albums`;
CREATE TABLE IF NOT EXISTS `photogallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photogallery_albums_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `photogallery_albums_id` (`photogallery_albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `photogallery_photos`
--

DROP TABLE IF EXISTS `photogallery_photos`;
CREATE TABLE IF NOT EXISTS `photogallery_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photogallery_albums_id` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `introtext` text,
  `fulltext` text,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `photogallery_albums_id` (`photogallery_albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `publications_categories`
--

DROP TABLE IF EXISTS `publications_categories`;
CREATE TABLE IF NOT EXISTS `publications_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publications_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `publications_categories_id` (`publications_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `publications_posts`
--

DROP TABLE IF EXISTS `publications_posts`;
CREATE TABLE IF NOT EXISTS `publications_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publications_categories_id` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `introtext` text,
  `fulltext` text,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `publications_categories_id` (`publications_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `recommendations`
--

DROP TABLE IF EXISTS `recommendations`;
CREATE TABLE IF NOT EXISTS `recommendations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `rewiews`
--

DROP TABLE IF EXISTS `rewiews`;
CREATE TABLE IF NOT EXISTS `rewiews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `scope_or_function` varchar(255) DEFAULT NULL,
  `posted_ts` int(11) NOT NULL,
  `message` text NOT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `system` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `roles_id` (`roles_id`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `roles_id`, `alias`, `system`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, NULL, 'Super administrator', 'NO', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `function` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `contacts` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `system` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `register_ts` int(11) DEFAULT NULL,
  `lastvizit_ts` int(11) DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `enabled`, `system`, `register_ts`, `lastvizit_ts`, `checked_out_by`, `checked_out_ts`, `created_by`, `created_ts`, `modified_by`, `modified_ts`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'YES', 'NO', 1350741357, 0, NULL, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  KEY `roles_id` (`roles_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users_roles`
--

INSERT INTO `users_roles` (`id`, `users_id`, `roles_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `videogallery_albums`
--

DROP TABLE IF EXISTS `videogallery_albums`;
CREATE TABLE IF NOT EXISTS `videogallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `videogallery_albums_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `videogallery_albums_id` (`videogallery_albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `videogallery_videos`
--

DROP TABLE IF EXISTS `videogallery_videos`;
CREATE TABLE IF NOT EXISTS `videogallery_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `videogallery_albums_id` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `introtext` text,
  `fulltext` text,
  `title` varchar(255) NOT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `videogallery_albums_id` (`videogallery_albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `club_members`
--
ALTER TABLE `club_members`
  ADD CONSTRAINT `club_members_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `club_members_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `club_members_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_4` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_5` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_6` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contents_categories`
--
ALTER TABLE `contents_categories`
  ADD CONSTRAINT `contents_categories_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_categories_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_categories_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_categories_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contents_posts`
--
ALTER TABLE `contents_posts`
  ADD CONSTRAINT `contents_posts_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_posts_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_posts_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_posts_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contents_static_posts`
--
ALTER TABLE `contents_static_posts`
  ADD CONSTRAINT `contents_static_posts_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_static_posts_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contents_static_posts_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD CONSTRAINT `faq_categories_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_categories_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_categories_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_categories_ibfk_4` FOREIGN KEY (`faq_categories_id`) REFERENCES `faq_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `faq_new_questions`
--
ALTER TABLE `faq_new_questions`
  ADD CONSTRAINT `faq_new_questions_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_new_questions_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_new_questions_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `faq_posts`
--
ALTER TABLE `faq_posts`
  ADD CONSTRAINT `faq_posts_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_posts_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_posts_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_posts_ibfk_4` FOREIGN KEY (`faq_categories_id`) REFERENCES `faq_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `feedback_messages`
--
ALTER TABLE `feedback_messages`
  ADD CONSTRAINT `feedback_messages_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_messages_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_messages_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `feedback_phones`
--
ALTER TABLE `feedback_phones`
  ADD CONSTRAINT `feedback_phones_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_phones_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_phones_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `fiends_organizations`
--
ALTER TABLE `fiends_organizations`
  ADD CONSTRAINT `fiends_organizations_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fiends_organizations_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fiends_organizations_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `fiends_personalities`
--
ALTER TABLE `fiends_personalities`
  ADD CONSTRAINT `fiends_personalities_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fiends_personalities_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fiends_personalities_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_ibfk_4` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_ibfk_5` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_ibfk_6` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `languages_translations`
--
ALTER TABLE `languages_translations`
  ADD CONSTRAINT `languages_translations_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_translations_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_translations_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_translations_ibfk_4` FOREIGN KEY (`languages_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `navigation_pages`
--
ALTER TABLE `navigation_pages`
  ADD CONSTRAINT `navigation_pages_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `navigation_pages_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `navigation_pages_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `navigation_pages_ibfk_4` FOREIGN KEY (`navigation_pages_id`) REFERENCES `navigation_pages` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `navigation_roles`
--
ALTER TABLE `navigation_roles`
  ADD CONSTRAINT `navigation_roles_ibfk_2` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `navigation_roles_ibfk_3` FOREIGN KEY (`navigation_id`) REFERENCES `navigation_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD CONSTRAINT `newsletter_subscribers_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `newsletter_subscribers_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `newsletter_subscribers_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `newsletter_subscribers_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `newsletter_templates`
--
ALTER TABLE `newsletter_templates`
  ADD CONSTRAINT `newsletter_templates_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `newsletter_templates_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `newsletter_templates_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news_categories`
--
ALTER TABLE `news_categories`
  ADD CONSTRAINT `news_categories_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `news_categories_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `news_categories_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `news_categories_ibfk_4` FOREIGN KEY (`news_categories_id`) REFERENCES `news_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news_posts`
--
ALTER TABLE `news_posts`
  ADD CONSTRAINT `news_posts_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `news_posts_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `news_posts_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `news_posts_ibfk_4` FOREIGN KEY (`news_categories_id`) REFERENCES `news_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `params_categories`
--
ALTER TABLE `params_categories`
  ADD CONSTRAINT `params_categories_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_categories_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_categories_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_categories_ibfk_4` FOREIGN KEY (`params_categories_id`) REFERENCES `params_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `params_names`
--
ALTER TABLE `params_names`
  ADD CONSTRAINT `params_names_ibfk_1` FOREIGN KEY (`params_categories_id`) REFERENCES `params_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `params_names_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_names_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_names_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_names_ibfk_5` FOREIGN KEY (`params_types_code`) REFERENCES `params_types` (`code`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `params_references`
--
ALTER TABLE `params_references`
  ADD CONSTRAINT `params_references_ibfk_1` FOREIGN KEY (`params_categories_id`) REFERENCES `params_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `params_references_ibfk_2` FOREIGN KEY (`params_names_id`) REFERENCES `params_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `params_sources`
--
ALTER TABLE `params_sources`
  ADD CONSTRAINT `params_sources_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_sources_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_sources_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `params_types`
--
ALTER TABLE `params_types`
  ADD CONSTRAINT `params_types_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_types_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_types_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `params_values`
--
ALTER TABLE `params_values`
  ADD CONSTRAINT `params_values_ibfk_1` FOREIGN KEY (`params_names_id`) REFERENCES `params_names` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_values_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_values_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `params_values_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `photogallery_albums`
--
ALTER TABLE `photogallery_albums`
  ADD CONSTRAINT `photogallery_albums_ibfk_1` FOREIGN KEY (`photogallery_albums_id`) REFERENCES `photogallery_albums` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `photogallery_albums_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `photogallery_albums_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `photogallery_albums_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `photogallery_photos`
--
ALTER TABLE `photogallery_photos`
  ADD CONSTRAINT `photogallery_photos_ibfk_1` FOREIGN KEY (`photogallery_albums_id`) REFERENCES `photogallery_albums` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `photogallery_photos_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `photogallery_photos_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `photogallery_photos_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `publications_categories`
--
ALTER TABLE `publications_categories`
  ADD CONSTRAINT `publications_categories_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `publications_categories_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `publications_categories_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `publications_categories_ibfk_4` FOREIGN KEY (`publications_categories_id`) REFERENCES `publications_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `publications_posts`
--
ALTER TABLE `publications_posts`
  ADD CONSTRAINT `publications_posts_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `publications_posts_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `publications_posts_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `publications_posts_ibfk_4` FOREIGN KEY (`publications_categories_id`) REFERENCES `publications_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `recommendations_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `recommendations_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rewiews`
--
ALTER TABLE `rewiews`
  ADD CONSTRAINT `rewiews_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `rewiews_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `rewiews_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `roles_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `contents_static_posts` (`modified_by`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_5` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_6` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_roles_ibfk_2` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `videogallery_albums`
--
ALTER TABLE `videogallery_albums`
  ADD CONSTRAINT `videogallery_albums_ibfk_1` FOREIGN KEY (`videogallery_albums_id`) REFERENCES `videogallery_albums` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `videogallery_albums_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `videogallery_albums_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `videogallery_albums_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `videogallery_videos`
--
ALTER TABLE `videogallery_videos`
  ADD CONSTRAINT `videogallery_videos_ibfk_1` FOREIGN KEY (`videogallery_albums_id`) REFERENCES `videogallery_albums` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `videogallery_videos_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `videogallery_videos_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `videogallery_videos_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
