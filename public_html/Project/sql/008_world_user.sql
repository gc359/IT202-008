-- Create a world account in the Accounts table (if it doesn't exist)
INSERT IGNORE INTO Accounts (id, account_number, user_id, balance, account_type)
VALUES (-1, '000000000000', -1, 0, 'world');
