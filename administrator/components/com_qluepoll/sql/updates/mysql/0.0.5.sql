DROP TABLE IF EXISTS `#__qluepoll_answer`;
DROP TABLE IF EXISTS `#__qluepoll_votes`;

CREATE TABLE `#__qluepoll_answer` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`poll_id` INT,
	`name` TEXT,
	`votes` INT DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE `#__qluepoll_votes` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`poll_id` INT NOT NULL,
	`awnser_id` INT NOT NULL,
	`ip` TEXT NOT NULL,
	PRIMARY KEY (`id`)
);


ALTER TABLE `#__qluepoll_votes` ADD `country_code` TEXT;
ALTER TABLE `#__qluepoll_votes` ADD `user_id` INT;
ALTER TABLE `#__qluepoll_votes` ADD `voted_at` TIMESTAMP;
