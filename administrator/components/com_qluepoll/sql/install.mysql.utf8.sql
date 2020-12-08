DROP TABLE IF EXISTS `#__qluepoll`;
DROP TABLE IF EXISTS `#__qluepoll_answer`;
DROP TABLE IF EXISTS `#__qluepoll_votes`;

CREATE TABLE IF NOT EXISTS `#__qluepoll` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`title` TEXT(128) NOT NULL,
	`question` TEXT(300) NOT NULL,
	`votes` INT NOT NULL DEFAULT '0',
	`category_id` INT,
	`allow_multiple` INT DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `#__qluepoll_answer` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`poll_id` INT,
	`name` TEXT,
	`votes` INT DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `#__qluepoll_votes` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`poll_id` INT NOT NULL,
	`awnser_id` INT NOT NULL,
	`ip` TEXT NOT NULL,
	`country_code` TEXT,
	`user_id` INT,
	`voted_at` TIMESTAMP,
	PRIMARY KEY (`id`)
);

INSERT INTO `#__qluepoll` (`title`, `question`) VALUES
('Example Poll', 'Do you like this example poll?');

INSERT INTO `#__qluepoll_answer` (`poll_id`, `name`) VALUES
(1, 'Apples'),
(1, 'Oranges'),
(1, 'Bananas');