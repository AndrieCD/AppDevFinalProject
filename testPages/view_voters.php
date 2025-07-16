<?php
require_once '../utility/voter_functions.php';

// Handle delete action
if (isset($_GET['delete'])) {
    delete_voter($_GET['delete']);
}

$voters = get_all_voters();
?>

<h2>Registered Voters</h2>
<?php if (count($voters) > 0): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Email</th>
            <th>Has Voted?</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($voters as $voter): ?>
            <tr>
                <td><?= htmlspecialchars($voter['email']) ?></td>
                <td><?= $voter['has_voted'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="?delete=<?= $voter['id'] ?>" onclick="return confirm('Delete this voter?')">🗑 Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p><em>No voters found.</em></p>
<?php endif; ?>


<br>
<a href="register_voter.php">Register New Voter</a>
