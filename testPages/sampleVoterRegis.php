<?php
require_once '../utility/voter_functions.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (insert_voter($email, $password)) {
        $msg = "✅ Voter registered!";
    } else {
        $msg = "❌ Error: Email may already exist.";
    }
}
?>

<h2>Register Voter</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required minlength="6"><br><br>
    <button type="submit">Register</button>
</form>

<p><?= $msg ?></p>
<a href="view_voters.php">View Voters</a>
