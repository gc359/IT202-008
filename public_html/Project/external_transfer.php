<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

// Get user's accounts
$db = getDB();
$stmt = $db->prepare('SELECT * FROM Accounts WHERE user_id = ?');
$stmt->execute([get_user_id()]);
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $src_account_id = $_POST['account_src'];
    $last_name = se($_POST, 'last_name', '', false);
    $account_last_four = se($_POST, 'last_4_account_num', '', false);
    $amount = se($_POST, 'amount', '', false);
    $memo = se($_POST, 'memo', '', false);

    // Lookup account_dest
    $stmt = $db->prepare('SELECT Accounts.id, Accounts.balance, Users.last_name FROM Accounts JOIN Users ON Accounts.user_id = Users.id WHERE Users.last_name = ? AND RIGHT(Accounts.account_number, 4) = ?');
    $stmt->execute([$last_name, $account_last_four]);
    $dest_account = $stmt->fetch(PDO::FETCH_ASSOC);


    // Check if source account belongs to user and has enough funds
    $stmt = $db->prepare('SELECT * FROM Accounts WHERE id = ? AND user_id = ? AND balance >= ?');
    $stmt->execute([$src_account_id, get_user_id(), $amount]);
    $src_account = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$src_account) {
        flash('Invalid source account or insufficient funds', 'danger');
    } else if (!$dest_account) {
        flash('Invalid destination account', 'danger');
    } else if ($amount <= 0) {
        flash('Amount must be a positive value', 'danger');
    } else {
        $src_new_balance = $src_account['balance'] - $amount;
        $dest_new_balance = $dest_account['balance'] + $amount;

        // Update account balances
        $stmt = $db->prepare('UPDATE Accounts SET balance = ? WHERE id = ?');
        $stmt->execute([$src_new_balance, $src_account_id]);
        $stmt->execute([$dest_new_balance, $dest_account['id']]);

        // Add transaction pair
        $stmt = $db->prepare('INSERT INTO Transactions (account_src, account_dest, balance_change, transaction_type, memo, expected_total, created, modified) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW()), (?, ?, ?, ?, ?, ?, NOW(), NOW())');

        // Account A losing funds to Account B
        $stmt->execute([$src_account_id, $dest_account['id'], -$amount, 'ext-transfer', $memo, $src_new_balance, $dest_account['id'], $src_account_id, $amount, 'ext-transfer', $memo, $dest_new_balance]);

        // Account B gaining funds from Account A
        $stmt->execute([$dest_account['id'], $src_account_id, $amount, 'ext-transfer', $memo, $dest_new_balance, $src_account_id, $dest_account['id'], -$amount, 'ext-transfer', $memo, $src_new_balance]);

        flash('Transfer successful', 'success');
    }
}

?>

<h1>External Transfer</h1>
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
  <div>
<label for="last_name">Destination User's Last Name:</label>
<input type="text" id="last_name" name="last_name" required>
      </div>
      <div>
      <label for="last_4_account_num">Destination Account Last 4 Digits:</label>
<input type="number" id="last_4_account_num" name="last_4_account_num" min="0000" max="9999" required>

      </div>
      <div>
<label for="amount">Amount:</label>
<input type="number" id="amount" name="amount" min="0.01" step="0.01" required>
      </div>
      <div>
<label for="memo">Memo:</label>
<input type="text" id="memo" name="memo">
      </div>
      <div>
<button type="submit" name="submit">Submit</button>
      </div>

</form>
<?php require(__DIR__ . "/../../partials/flash.php"); ?>