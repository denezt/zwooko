--
-- Temporary view structure for view `task_backlog`
--
DROP VIEW IF EXISTS `task_backlog`;
CREATE VIEW `task_backlog` AS
  select `t`.`id` AS `id`,
  `t`.`uuid` AS `task_uuid`,
  `tt`.`name` AS `task_type`,
  `ts`.`name` AS `status`,
  `a`.`name` AS `product_name`,
  `t`.`name` AS `task_name`,
  `t`.`description` AS `description`,
  `u`.`name` AS `employee`
  from (((
    (`task` `t` join `user` `u` on((`t`.`user_id` = `u`.`id`)))
    join `asset` `a` on((`a`.`id` = `t`.`asset_id`)))
    join `task_status` `ts` on((`ts`.`id` = `t`.`status_id`)))
    join `task_type` `tt` on((`tt`.`id` = `t`.`type_id`)))
  where (`ts`.`id` = 4) order by `t`.`id`;
