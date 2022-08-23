--
-- Table structure for table `task_status`
--
DROP TABLE IF EXISTS `task_status`;
CREATE TABLE `task_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
