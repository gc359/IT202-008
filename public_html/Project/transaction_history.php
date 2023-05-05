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

// Pagination variables
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Filter variables
$filter_type = $_GET['filter_type'] ?? null;
$filter_start_date = $_GET['filter_start_date'] ?? null;
$filter_end_date = $_GET['filter_end_date'] ?? null;

// Build query for filtering transactions
$where_conditions = ['src.id = ? OR dest.id = ?'];
$where_params = [$account_id, $account_id];

if ($filter_type) {
    $where_conditions[] = 'Transactions.transaction_type = ?';
    $where_params[] = $filter_type;
}

if ($filter_start_date) {
    $where_conditions[] = 'Transactions.created >= ?';
    $where_params[] = $filter_start_date;
}

if ($filter_end_date) {
    $where_conditions[] = 'Transactions.created <= ?';
    $where_params[] = $filter_end_date;
}

$where_clause = '';
if (count($where_conditions) > 0) {
    $where_clause = ' WHERE ' . implode(' AND ', $where_conditions);
}

// Query the database for the transaction history with filters and pagination
$stmt = $db->prepare('SELECT COUNT(*) FROM Transactions 
    JOIN Accounts AS src ON Transactions.account_src = src.id 
    JOIN Accounts AS dest ON Transactions.account_dest = dest.id' . $where_clause);
$stmt->execute($where_params);
$total_results = $stmt->fetchColumn();

$stmt = $db->prepare('SELECT Transactions.*, src.account_number AS src_account_number, dest.account_number AS dest_account_number FROM Transactions 
    JOIN Accounts AS src ON Transactions.account_src = src.id 
    JOIN Accounts AS dest ON Transactions.account_dest = dest.id' . $where_clause . '
    ORDER BY Transactions.created DESC 
    LIMIT ? OFFSET ?');
    foreach ($where_params as $i => $param) {
        $stmt->bindValue($i + 1, $param);
    }
    $stmt->bindValue(count($where_params) + 1, (int) $limit, PDO::PARAM_INT);
    $stmt->bindValue(count($where_params) + 2, (int) $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_pages = ceil($total_results / $limit);
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

<form method="GET">
    <input type="hidden" name="account_id" value="<?= $account_id ?>">
    <label for="filter_start_date">Start Date:</label>
    <input type="date" id="filter_start_date" name="filter_start_date" value="<?= isset($_GET['filter_start_date']) ? $_GET['filter_start_date'] : '' ?>">

    <label for="filter_end_date">End Date:</label>
    <input type="date" id="filter_end_date" name="filter_end_date" value="<?= isset($_GET['filter_end_date']) ? $_GET['filter_end_date'] : '' ?>">

    <label for="filter_type">Transaction Type:</label>
    <select id="filter_type" name="filter_type">
        <option value="">All</option>
        <option value="deposit" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'deposit' ? 'selected' : '' ?>>Deposit</option>
        <option value="withdrawal" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'withdrawal' ? 'selected' : '' ?>>Withdrawal</option>
        <option value="transfer" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'transfer' ? 'selected' : '' ?>>Transfer</option>
    </select>

    <button type="submit">Filter</button>
</form>



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
            <?php if (!empty($filter_type) && $transaction['transaction_type'] !== $filter_type) continue; ?>
            <tr>
                <td><?= $transaction['account_src'] ?></td>
                <td><?= $transaction['account_dest'] ?></td>
                <td><?= $transaction['transaction_type'] ?></td>
                <td><?= number_format($transaction['balance_change'], 2) ?></td>
                <td><?= number_format($transaction['expected_total'], 2) ?></td>
                <td><?= $transaction['memo'] ?></td>
                <td><?= $transaction['created'] ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <?php if ($total_pages > 1) : ?>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="?account_id=<?= $account_id ?>&page=<?= $page - 1 ?>&filter_start_date=<?= $filter_start_date ?>&filter_end_date=<?= $filter_end_date ?>&filter_type=<?= $filter_type ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <?php if ($i == $page) : ?>
                <span class="current"><?= $i ?></span>
            <?php else : ?>
                <a href="?account_id=<?= $account_id ?>&page=<?= $i ?>&filter_start_date=<?= $filter_start_date ?>&filter_end_date=<?= $filter_end_date ?>&filter_type=<?= $filter_type ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $total_pages) : ?>
            <a href="?account_id=<?= $account_id ?>&page=<?= $page + 1 ?>&filter_start_date=<?= $filter_start_date ?>&filter_end_date=<?= $filter_end_date ?>&filter_type=<?= $filter_type ?>">Next</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

    <?php endif; ?>
    <a href="my_accounts.php">Back to My Accounts</a>
    </body>
    </html>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>