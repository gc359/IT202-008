<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>


<?php

$user_id = get_user_id();
$db = getDB();
// Query the database for the user's accounts
$stmt = $db->prepare('SELECT account_number, account_type, modified, balance FROM Accounts WHERE user_id = ? ORDER BY modified DESC LIMIT 5');
$stmt->execute([$user_id]);
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Accounts</title>
</head>
<body>

<h1>My Accounts</h1>

<?php if (count($accounts) > 0) : ?>
    <table>
        <thead>
            <tr>
                <th>Account Number</th>
                <th>Account Type</th>
                <th>Last Modified</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accounts as $account) : ?>
                <tr>
                    <td><?= $account['account_number'] ?></td>
                    <td><?= $account['account_type'] ?></td>
                    <td><?= $account['modified'] ?></td>
                    <td><?= number_format($account['balance'], 2) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No accounts found.</p>
<?php endif ?>

<a href="create_account.php">Create New Account</a>

</body>
</html>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>