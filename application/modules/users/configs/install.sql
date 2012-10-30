SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`enabled` ENUM('YES','NO') NOT NULL DEFAULT 'NO',
	`register_ts` INT(11) NOT NULL DEFAULT '0',
	`lastvizit_ts` INT(11) NOT NULL DEFAULT '0',
	`checked_out_by` INT(11) NULL,
	`checked_out_ts` INT(11) NOT NULL DEFAULT '0',
	`created_by` INT(11) NULL,
	`created_ts` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email` ASC),
	INDEX `created_by` (`created_by` ASC),
	INDEX `checked_out_by` (`checked_out_by` ASC),
	CONSTRAINT `users_ibfk_1`
		FOREIGN KEY (`created_by` )
		REFERENCES `users` (`id` )
		ON DELETE SET NULL,
	CONSTRAINT `users_ibfk_2`
		FOREIGN KEY (`checked_out_by` )
		REFERENCES `users` (`id` )
		ON DELETE SET NULL
)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;

INSERT INTO `users` (
	`id`, `email`, `password`, `enabled`, `register_ts`
) VALUES (
	NULL, 'admin@site.com', '21232f297a57a5a743894a0e4a801fc3', 'YES', UNIX_TIMESTAMP()
);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;