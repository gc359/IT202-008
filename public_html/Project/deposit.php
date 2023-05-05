<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

// Get user's accounts
$db = getDB();
$stmt = $db->prepare('SELECT * FROM Accounts WHERE user_id = ?');
$stmt->execute([get_user_id()]);
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $account_id = $_POST['account'];
  $amount = $_POST['amount'];
  $memo = $_POST['memo'];

  // Check if account belongs to user
  $stmt = $db->prepare('SELECT * FROM Accounts WHERE id = ? AND user_id = ?');
  $stmt->execute([$account_id, get_user_id()]);
  $account = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$account) {
    flash('Invalid account selected');
  } else {
    $new_balance = $account['balance'] + $amount;

    // Update account balance
    $stmt = $db->prepare('UPDATE Accounts SET balance = ? WHERE id = ?');
    $stmt->execute([$new_balance, $account_id]);

    // Add transaction pair
    $world_account_number = "world";
    $world_account_id = null;
    $stmt = $db->prepare('SELECT * FROM Accounts WHERE account_number = ?');
    $stmt->execute([$world_account_number]);
    $world_account = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($world_account) {
      // If the world account exists, fetch its ID
      $world_account_id = $world_account['id'];
    } else {
      $stmt = $db->prepare('INSERT INTO Accounts (account_number, user_id, balance, account_type) VALUES (?, ?, ?, ?)');
      $stmt->execute([$world_account_number, -1, 0, 'world']);
      $world_account_id = $db->lastInsertId();
    }

    // If the world account ID is a negative value, assume it won't change across migrations and use the hardcoded ID
    // Otherwise, fetch the world account's ID
    if ($world_account_id < 0) {
      $world_account_id = abs($world_account_id); // Remove the negative sign
    } else {
      $stmt = $db->prepare('SELECT * FROM Accounts WHERE account_number = ?');
      $stmt->execute([$world_account_number]);
      $world_account = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($world_account) {
        $world_account_id = $world_account['id'];
      } else {
        // If the world account doesn't exist, use the hardcoded ID and label it as such
        $world_account_id = -1; // Label the hardcoded ID as referring to the "world" account
      }
    }

    // Calculate the expected balance of the world account
    $world_account_balance = $world_account['balance'] - $amount;

    // Add two transaction records - deposit from user account, withdrawal from "world" account
    $stmt = $db->prepare('INSERT INTO Transactions (account_src, account_dest, balance_change, transaction_type, memo, expected_total, created, modified) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW()), (?, ?, ?, ?, ?, ?, NOW(), NOW())');

    // Account A gaining funds from Account B
    $stmt->execute([$world_account_id, $account_id, $amount, 'deposit', $memo, $world_account_balance, $account_id, $world_account_id, -$amount, 'withdrawal', $memo, $new_balance]);

    // Account B losing funds to Account A
     $stmt->execute([$account_id, $world_account_id, -$amount, 'withdrawal', $memo, $new_balance, $world_account_id, $account_id, $amount, 'deposit', $memo, $world_account_balance]);


    // Update the balance of each account
    $stmt = $db->prepare('UPDATE Accounts SET balance = ?, modified = NOW() WHERE id = ?');
    $stmt->execute([$new_balance, $account_id]);
    $stmt->execute([$world_account_balance, $world_account_id]);

      flash('Withdrawal successful');
    
  }
}
?>


<h1>Deposit</h1>
<form method="POST">
  <label for="account">Account:</label>
  <select id="account" name="account">
    <?php foreach ($accounts as $account): ?>
      <?php if ($account['account_type'] !== 'world'): ?>
        <option value="<?= $account['id'] ?>">
          <?= $account['account_number'] ?> - <?= number_format($account['balance'], 2) ?>
        </option>
      <?php endif; ?>
    <?php endforeach; ?>
  </select>

  <label for="amount">Amount:</label>
  <input type="number" id="amount" name="amount" min="1" step="0.01" required>

  <label for="memo">Memo:</label>
  <input type="text" id="memo" name="memo">

  <button type="submit" name="submit">Submit</button>
</form>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>
