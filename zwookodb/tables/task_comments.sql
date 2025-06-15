

CREATE TABLE task_comments (`id` INT(20) AUTO_INCREMENT,
`uuid` VARCHAR(48),
`entered_on` DATETIME DEFAULT CURRENT_TIMESTAMP,
`comment` text(512),
PRIMARY KEY(`id`));
