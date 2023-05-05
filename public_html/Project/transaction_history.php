<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

// Get account number from URL parameter
if (isset($_GET['account_number'])) {
    $account_number = $_GET['account_number'];
} else {
    // Handle the error case
    $account_number = null; // Or set a default value
}


// Get account details
$db = getDB();
$stmt = $db->prepare('SELECT * FROM Accounts WHERE account_number = ?');
$stmt->execute([$account_number]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);

// Get transaction history for account
$stmt = $db->prepare('SELECT Transactions.id, 
account_src.account_number AS src_account_number, 
account_dest.account_number AS dest_account_number, 
balance_change, 
transaction_type, 
memo, 
expected_total, 
Transactions.created 
FROM Transactions 
JOIN Accounts AS account_src ON Transactions.account_src = account_src.id 
JOIN Accounts AS account_dest ON Transactions.account_dest = account_dest.id 
WHERE account_src.account_number = ? OR account_dest.account_number = ? 
ORDER BY Transactions.created DESC 
LIMIT 10');
$stmt->execute([$account_number, $account_number]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction History</title>
</head>
<body>

<h1>Transaction History for Account <?php echo isset($account['account_number']) ? $account['account_number'] : '' ?></h1>


<?php if (isset($account) && $account !== false): ?>
    <h2>Account Details</h2>
    <ul>
        <li>Account Type: <?= $account['account_type'] ?></li>
        <li>Balance: <?= $account['balance'] !== null ? number_format($account['balance'], 2) : '' ?></li>
        <li>Opened: <?= $account['created'] ?></li>
    </ul>
<?php else: ?>
    <p>Account not found.</p>
<?php endif; ?>

<h2>Transaction History</h2>

<?php if (count($transactions) > 0) : ?>
    <table>
        <thead>
            <tr>
                <th>Source Account</th>
                <th>Destination Account</th>
                <th>Transaction Type</th>
                <th>Change in Balance</th>
                <th>Expected Total</th>
                <th>Memo</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?= $transaction['src_account_number'] ?></td>
                    <td><?= $transaction['dest_account_number'] ?></td>
                    <td><?= $transaction['transaction_type'] ?></td>
                    <td><?= number_format($transaction['balance_change'], 2) ?></td>
                    <td><?= number_format($transaction['expected_total'], 2) ?></td>
                    <td><?= $transaction['memo'] ?></td>
                    <td><?= $transaction['created'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No transactions found for this account.</p>
<?php endif ?>

<a href="my_accounts.php">Back to My Accounts</a>

</body>
</html>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>
