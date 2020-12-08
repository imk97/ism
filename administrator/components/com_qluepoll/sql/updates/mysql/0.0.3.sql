DROP TABLE IF EXISTS `#__qluepoll`;

CREATE TABLE `#__qluepoll` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`title` TEXT(128) NOT NULL,
	`question` TEXT(300) NOT NULL,
	`votes` INT NOT NULL DEFAULT '0',
	`allow_multiple` INT DEFAULT '0',
	PRIMARY KEY (`id`)
);

INSERT INTO `#__qluepoll` (`title`, `question`) VALUES
('Example Poll', 'Do you like this example poll?');