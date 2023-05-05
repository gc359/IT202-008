<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>


<form method="POST">
  <button type="submit" name="create_account">Create Checking Account</button>
</form>

<?php
if (isset($_POST['create_account'])) {
  // Call the create_checking_account() function when the button is pressed
  //$id = get_user_id();
  $id = get_user_id();
  $result = create_checking_account($id);
  
  // Check the result and redirect to the Accounts page if successful
  if ($result === 'Success: Account created successfully.') {
    header('Location: accounts.php');
    exit;
  } else {
    echo $result;
  }
}

?>


<?php

// Generate a random 12 character account number
function generate_account_number() {
    $db = getDB();
    
    // Generate a random 12 character account number
    $account_number = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 12);
    
    // Check if the account number already exists in the database
    $stmt = $db->prepare('SELECT COUNT(*) FROM Accounts WHERE account_number = ?');
    $stmt->execute([$account_number]);
    $count = $stmt->fetchColumn();
    
    // If the account number already exists, regenerate and check again
    while ($count > 0) {
        $account_number = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 12);
        $stmt->execute([$account_number]);
        $count = $stmt->fetchColumn();
    }
    
    return $account_number;
}

// Create a new checking account for a user
function create_checking_account($user_id) {
    $db = getDB();

    // Generate a unique account number
    $account_number = generate_account_number();

    // Set the account type as checking
    $account_type = 'checking';

    // Ensure starting balance of $0
    $starting_balance = 0.00;

    // Subtract $5 from the world account balance
    $world_account_number = '000000000000'; // world account number
    $stmt = $db->prepare('UPDATE Accounts SET balance = balance - ? WHERE account_number = ?');
    $stmt->execute([5.00, $world_account_number]);
    $affected_rows = $stmt->rowCount();

    if ($affected_rows === 0) {
        return 'Error: Unable to create account. Unable to subtract $5 from the world account balance.';
    }

    // Begin a transaction
    $db->beginTransaction();

    try {
        // Insert the new account into the Accounts table
        $stmt = $db->prepare('INSERT INTO Accounts (account_number, user_id, balance, account_type) VALUES (?, ?, ?, ?)');
        $stmt->execute([$account_number, $user_id, $starting_balance, $account_type]);

        // Get the ID of the newly created account
        $account_id = $db->lastInsertId();

        // Insert a transaction record for the initial deposit
        $stmt = $db->prepare('INSERT INTO Transactions (account_src, account_dest, balance_change, transaction_type, memo, expected_total) VALUES (?, ?, ?, ?, ?, ?), (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$world_account_number, $account_id, -5.00, 'withdrawal', 'Initial account creation fee', -5.00, $account_id, $world_account_number, 5.00, 'deposit', 'Initial deposit', 5.00]);

        // Commit the transaction
        $db->commit();

        // Redirect the user to their Accounts page
        header('Location: accounts.php');
        flash('Success: Account created successfully.');
        exit();

    } catch (PDOException $e) {
        // Roll back the transaction on error
        $db->rollBack();

        // Return error message
        flash($e);
    }
}




?>


<?php
require(__DIR__ . "/../../partials/flash.php");
?>