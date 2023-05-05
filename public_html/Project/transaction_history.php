<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>


<?php
// Get account id from URL parameter
if (isset($_GET['account_id'])) {
    $account_id = $_GET['account_id'];
} else {
    // Handle the error case
    $account_id = null; // Or set a default value
}

$db = getDB();
// Query the database for the account details
$stmt = $db->prepare('SELECT account_number, account_type, balance FROM Accounts WHERE id = ? AND user_id = ?');
$stmt->execute([$account_id, get_user_id()]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);

// Query the database for the transaction history
$stmt = $db->prepare('SELECT Transactions.*, src.account_number AS src_account_number, dest.account_number AS dest_account_number FROM Transactions 
    JOIN Accounts AS src ON Transactions.account_src = src.id 
    JOIN Accounts AS dest ON Transactions.account_dest = dest.id 
    WHERE src.id = ? OR dest.id = ? 
    ORDER BY Transactions.created DESC 
    LIMIT 10');
$stmt->execute([$account_id, $account_id]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction History</title>
</head>
<body>

<h1>Transaction History for Account <?= isset($account['account_number']) ? $account['account_number'] : '' ?></h1>

<?php if ($account) : ?>
    <h2>Account Details</h2>
    <ul>
        <li>Account Type: <?= $account['account_type'] ?></li>
        <li>Balance: <?= number_format($account['balance'], 2) ?></li>
    </ul>
<?php else : ?>
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
