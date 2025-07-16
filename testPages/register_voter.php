<?php
require_once '../utility/voter_functions.php';
require_once '../utility/validation.php';

$msg = '';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!validateEmail($email)) {
        $msg = "❗ Invalid email format.";
    } elseif (!validatePassword($password)) {
        $msg = "❗ Password must be at least 8 characters, with uppercase, lowercase, number, and special character.";
    } elseif (getVoterByEmail($email)) {
        $msg = "❗ Email already exists.";
    } else {
        if (insert_voter($email, $password)) {
            $msg = "✅ Voter registered successfully!";
        } else {
            $msg = "❌ Failed to register voter. Try again.";
        }
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
