USE `zwookodb`;

DROP TABLE IF EXISTS `log_type`;

CREATE TABLE `log_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;