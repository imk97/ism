CREATE TABLE IF NOT EXISTS `#__Visitor` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    -- `title` varchar(255) NULL,
    `daily` int(10) NOT NULL,
    `monthly` int(10) NOT NULL,
    `total` int(10) NOT NULL,
    `latest_update` varchar(255) NULL,

    PRIMARY KEY (`id`)
)   ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `#__Visitor` (`daily`, `monthly`, `total`) VALUES (0, 0, 0);