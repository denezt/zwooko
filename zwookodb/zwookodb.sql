--
-- Table structure for table `asset`
--

DROP DATABASE IF EXISTS `zwookodb`;

CREATE DATABASE IF NOT EXISTS `zwookodb`;

USE `zwookodb`;

-- Load All Database Tables
select ("Loading Assets Table...") as '';
source tables/asset.sql;
select ("Loading Task Type Table...") as '';
source tables/task_type.sql;
select ("Loading User Status Table...") as '';
source tables/user_status.sql;
select ("Loading User Table...") as '';
source tables/user.sql;
select ("Loading Task Priority Table...") as '';
source tables/task_priority.sql;
select ("Loading Task Status Table...") as '';
source tables/task_status.sql;
select ("Loading Task Table...") as '';
source tables/task.sql;
select ("Loading Logging Type Table...") as '';
source tables/log_type.sql;
select ("Loading Log Manager...") as '';
source tables/logging.sql;


-- Load All Database views
select ("Loading Task Queue Table...") as '';
source views/task_queue.sql;
select ("Loading Task Count Table...") as '';
source views/task_count.sql;
select ("Loading Task Accomplished Table...") as '';
source task_accomplished.sql;

-- Load all Database data
select ("Loading Asset Data Table...") as '';
source data/asset_records.sql
select ("Loading Task Type Data Table...") as '';
source data/task_type_records.sql
select ("Loading Task Status Data Table...") as '';
source data/task_status_records.sql
select ("Loading User Status Data Table...") as '';
source data/user_status_records.sql
select ("Loading User Data Table...") as '';
source data/user_records.sql
select ("Loading Task Data Table...") as '';
source data/task_records.sql
