<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<h1>My Accounts</h1>
<?php
// Assume $user_id is the ID of the current user
list_accounts($user_id);
?>



<?php
function list_accounts($user_id) {
    $db = getDB();
    
    // Prepare the SQL statement
    $stmt = $db->prepare('SELECT account_number, account_type, modified, balance FROM Accounts WHERE user_id = ? LIMIT 5');
    $stmt->execute([$user_id]);
    
    // Fetch the results
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the results in a table
    echo '<table>';
    echo '<tr><th>Account Number</th><th>Account Type</th><th>Modified</th><th>Balance</th></tr>';
    foreach ($accounts as $account) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($account['account_number']) . '</td>';
        echo '<td>' . htmlspecialchars($account['account_type']) . '</td>';
        echo '<td>' . htmlspecialchars($account['modified']) . '</td>';
        echo '<td>' . htmlspecialchars($account['balance']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>


<?php
require(__DIR__ . "/../../partials/flash.php");
?>