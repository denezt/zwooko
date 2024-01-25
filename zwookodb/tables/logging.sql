-- Create the Logging Table for Application Monitoring
USE `zwookodb`;

DROP TABLE IF EXISTS `logging`;

CREATE TABLE `logging` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entered_on` DATETIME default CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `uuid` varchar(36) DEFAULT NULL,
  `message` text,
  `type_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `user_id` (`user_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `logging_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `logging_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `log_type` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;