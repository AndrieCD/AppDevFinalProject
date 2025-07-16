<?php
session_start();
require_once '../utility/voter_functions.php'; // Adjust path as needed
require_once '../utility/validation.php'; // Adjust path as needed

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!validateEmail($email)) {
        $msg = "❗ Invalid email format.";
    } else {
        $voter = getVoterByEmail($email);
        // also check if admin is logging in
        $admin = getAdminByEmail($email);
        if (!$voter || !$admin) {
            $msg = "❌ Email not found.";
        } else {
            // check voter password
            if ($voter && password_verify($password, $voter['password'])) {
                // ✅ Successful login
                $_SESSION['voter_id'] = $voter['id'];
                $_SESSION['voter_email'] = $voter['email'];
                header("Location: voter_dashboard.php"); // redirect to main voter page
                exit;
            } else {
                $msg = "❌ Incorrect password.";
            }

            // check admin password
            if ($admin && password_verify($password, $admin['password'])) {
                // ✅ Successful admin login
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_email'] = $admin['email'];
                header("Location: admin_dashboard.php"); // redirect to main admin page
                exit;
            } else {
                $msg = "❌ Incorrect password.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
</head>
<body>
    <h2>Student Login</h2>
    <form method="POST">
        <fieldset style="max-width: 400px;">
            <legend><strong>Form Title</strong></legend>

            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" required><br><br>

            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required><br><br>

            <button type="submit">Submit</button>
        </fieldset>
    </form>
    <?php if (!empty($msg)) echo "<p>$msg</p>"; ?>
</body>
</html>
