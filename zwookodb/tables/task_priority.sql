--
-- Table structure for table `task_status`
--
DROP TABLE IF EXISTS `task_priority`;
CREATE TABLE `task_priority` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
