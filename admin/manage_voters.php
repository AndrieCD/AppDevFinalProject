<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();
?>

<?php
    // Initialize voters list if not set
    $voters = get_all_voters();
    $_SESSION['voters'] = $voters;



// Delete voter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_voter'])) {
    $idToDelete = $_POST['delete_voter'] ?? null;

    if ($idToDelete) {
        $deleted = delete_voter($idToDelete);
        if ($deleted) {
            $_SESSION['voters'] = get_all_voters();
            header("Location: manage_voters.php");
            exit();
        } else {
            $error = "Failed to delete voter.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Voters</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>

<!-- ======= NAVBAR ======= -->
<div class="navbar">
    <div class="logo">
        <img src="../assets/bobotoIcon.png" alt="Logo" class="logo-img">
        <span class="logo-text">admin</span>
    </div>
    <ul class="nav-links">
       <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="manage_parties.php">Parties</a></li>
        <li><a href="manage_positions.php">Positions</a></li>
        <li><a href="manage_voters.php">Voters</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>
</div>

<!-- ======= MAIN CONTENT ======= -->
<main class="PartyManager">
    <h1 class="animated-title">Manage Voters</h1>

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
                                    <td><?= $voter['has_voted'] ? 'Voted' : 'Not Voted' ?></td>
                                    <td>
                                        <button type="submit" name="delete_voter" value="<?= $voter['id'] ?>" class="btn-delete">Delete</button>
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
