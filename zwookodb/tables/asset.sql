
DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `model` varchar(32) DEFAULT NULL,
  `version` varchar(32) DEFAULT NULL,
  `uuid` varchar(48) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
