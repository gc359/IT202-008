ALTER TABLE `Users`
ADD COLUMN `first_name` VARCHAR(50) DEFAULT '' AFTER `password`,
ADD COLUMN `last_name` VARCHAR(50) DEFAULT '' AFTER `first_name`;
