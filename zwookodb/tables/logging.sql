DROP TABLE IF EXISTS `logging`;
CREATE TABLE `logging` (
  `id` int NOT NULL AUTO_INCREMENT,
  `log_id` varchar(36) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;