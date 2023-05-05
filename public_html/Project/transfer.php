<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

// Get user's accounts
$db = getDB();
$stmt = $db->prepare('SELECT * FROM Accounts WHERE user_id = ?');
$stmt->execute([get_user_id()]);
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $src_account_id = $_POST['account_src'];
    $dest_account_id = $_POST['account_dest'];
    $amount = $_POST['amount'];
    $memo = $_POST['memo'];

    // Check if both accounts belong to user
    $stmt = $db->prepare('SELECT * FROM Accounts WHERE id = ? AND user_id = ?');
    $stmt->execute([$src_account_id, get_user_id()]);
    $src_account = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->execute([$dest_account_id, get_user_id()]);
    $dest_account = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$src_account || !$dest_account) {
        flash('Invalid accounts selected');
    } else if ($src_account['balance'] < $amount) {
        flash('Insufficient funds');
    } else {
        $src_new_balance = $src_account['balance'] - $amount;
        $dest_new_balance = $dest_account['balance'] + $amount;

        // Update account balances
        $stmt = $db->prepare('UPDATE Accounts SET balance = ? WHERE id = ?');
        $stmt->execute([$src_new_balance, $src_account_id]);
        $stmt->execute([$dest_new_balance, $dest_account_id]);

        // Add transaction pair
        $stmt = $db->prepare('INSERT INTO Transactions (account_src, account_dest, balance_change, transaction_type, memo, expected_total, created, modified) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW()), (?, ?, ?, ?, ?, ?, NOW(), NOW())');

        // Account A losing funds to Account B
        $stmt->execute([$src_account_id, $dest_account_id, -$amount, 'transfer', $memo, $src_new_balance, $dest_account_id, $src_account_id, $amount, 'transfer', $memo, $dest_new_balance]);

        // Account B gaining funds from Account A
        $stmt->execute([$dest_account_id, $src_account_id, $amount, 'transfer', $memo, $dest_new_balance, $src_account_id, $dest_account_id, -$amount, 'transfer', $memo, $src_new_balance]);

        flash('Transfer successful');
    }
}

?>
<h1>Transfer Between Accounts</h1>

<form method="POST">
  <label for="from_account">From Account:</label>
  <select id="from_account" name="account_src">
    <?php foreach ($accounts as $account): ?>
      <?php if ($account['account_type'] !== 'world'): ?>
        <option value="<?= $account['id'] ?>">
          <?= $account['account_number'] ?> - <?= number_format($account['balance'], 2) ?>
        </option>
      <?php endif; ?>
    <?php endforeach; ?>
  </select>

  <label for="to_account">To Account:</label>
  <select id="to_account" name="account_dest">
    <?php foreach ($accounts as $account): ?>
      <?php if ($account['account_type'] !== 'world'): ?>
        <option value="<?= $account['id'] ?>">
          <?= $account['account_number'] ?> - <?= number_format($account['balance'], 2) ?>
        </option>
      <?php endif; ?>
    <?php endforeach; ?>
  </select>
  <div>
  <label for="amount">Amount:</label>
  <input type="number" id="amount" name="amount" min="1" step="0.01" required>
      </div>
      <div>
  <label for="memo">Memo:</label>
  <input type="text" id="memo" name="memo">
      </div>
      <div>
  <button type="submit" name="submit">Submit</button>
      </div>
  <div>
    <a href="external_transfer.php" class="btn btn-primary">External Transfer</a>
  </div>


<?php require(__DIR__ . "/../../partials/flash.php"); ?>