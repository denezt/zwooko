--
-- Table structure for table `task`
--
USE `zwookodb`;

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(512) DEFAULT NULL,
  `created_on` DATETIME default CURRENT_TIMESTAMP,
  `modified_on` DATETIME default CURRENT_TIMESTAMP,
  `type_id` int DEFAULT NULL,
  `uuid` varchar(48) DEFAULT NULL,
  `description` text,
  `status_id` int DEFAULT NULL,
  `asset_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `assignee_id` int DEFAULT NULL,
  `priority_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `type_id` (`type_id`),
  KEY `status_id` (`status_id`),
  KEY `priority_id` (`priority_id`),
  KEY `asset_id` (`asset_id`),
  KEY `user_id` (`user_id`),
  KEY `assignee_id` (`assignee_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `task_type` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `task_status` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `task_ibfk_3` FOREIGN KEY (`priority_id`) REFERENCES `task_priority` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `task_ibfk_4` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `task_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `task_ibfk_6` FOREIGN KEY (`assignee_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB CHARSET=latin1;

-- Adding a start date for the task
ALTER TABLE task ADD start_date datetime;
-- Adding a start date for the task
ALTER TABLE task ADD due_date datetime;
