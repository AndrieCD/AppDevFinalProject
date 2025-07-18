<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();

// Initialize voters list if not set
if (!isset($_SESSION['voters'])) {
    $_SESSION['voters'] = [];
}

// Add voter
if (isset($_POST['add_voter'])) {
    $email = trim($_POST['voter_email']);
    if (!empty($email)) {
        $_SESSION['voters'][] = ['email' => $email, 'voted' => false];
    }
}

// Delete voter
if (isset($_POST['delete_voter'])) {
    $index = $_POST['delete_voter'];
    unset($_SESSION['voters'][$index]);
    $_SESSION['voters'] = array_values($_SESSION['voters']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Voters</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<!-- ======= NAVBAR ======= -->
<div class="navbar">
    <div class="logo">
        <img src="../assets/bobotoIcon.png" alt="Logo" class="logo-img">
        <span class="logo-text">admin</span>
    </div>
    <ul class="nav-links">
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="manage_parties.php">Parties</a></li>
        <li><a href="manage_positions.php">Positions</a></li>
        <li><a href="manage_voters.php" class="active">Voters</a></li>
        <li><a href="#">Logout</a></li>
    </ul>
</div>

<!-- ======= MAIN CONTENT ======= -->
<main class="PartyManager">
    <h1>Manage Voters</h1>

    <!-- ======= ADD VOTER ======= -->
    <section class="AddPartySection">
        <div class="card add-party-card">
            <h2>Add New Voter</h2>
            <form method="POST" class="voter-form">
                <input type="email" name="voter_email" required placeholder="Enter voter email" class="voter-input">
                <button type="submit" name="add_voter" class="btn-add-voter">Add Voter</button>
            </form>
        </div>
    </section>

    <!-- ======= VOTER LIST ======= -->
    <section class="Partycards">
        <div class="card existing-parties-container">
            <div class="existing-parties-title">
                <h2>Voter List</h2>
            </div>
            <div class="table-wrapper">
                <form method="POST">
                    <table class="voter-table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['voters'] as $index => $voter): ?>
                                <tr>
                                    <td><?= htmlspecialchars($voter['email']) ?></td>
                                    <td><?= $voter['voted'] ? 'Voted' : 'Not Voted' ?></td>
                                    <td>
                                        <button type="submit" name="delete_voter" value="<?= $index ?>" class="btn-delete">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($_SESSION['voters'])): ?>
                                <tr>
                                    <td colspan="3" style="text-align: center;">No voters added yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </section>
</main>

</body>
</html>
