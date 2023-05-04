-- Create a system user if they don't exist
INSERT IGNORE INTO Users (id, email, password)
VALUES (-1, 'system_user@mydomain.com', 'supersecret');
