--
-- View structure for view `task_count`
--

USE zwookodb;
DROP VIEW IF EXISTS `task_count`;

CREATE VIEW `task_count` AS
select
  sum(case
    when `task_type` in ('Main')
    then 1
    else 0 end)  as main_issues,
  sum(
    case when `task_type` in ('Task')
    then 1
    else 0 end)  as task_issues,
  sum(
    case when `task_type` in ('Bug')
    then 1
    else 0 end)  as bug_issues,
  sum(
    case when `task_type` in ('Feature')
    then 1
    else 0 end)  as feature_issues
from task_queue;

USE zwookodb;
select * from task_count;
