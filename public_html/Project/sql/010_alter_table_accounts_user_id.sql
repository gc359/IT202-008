ALTER TABLE `Accounts` ADD CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `Users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
