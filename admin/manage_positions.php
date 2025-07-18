<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();

// // Initialize positions
// if (!isset($_SESSION['positions'])) {
//     $_SESSION['positions'] = [
//         ['id' => 1, 'name' => 'President'],
//         ['id' => 2, 'name' => 'Vice President'],
//         ['id' => 3, 'name' => 'Secretary'],
//         ['id' => 4, 'name' => 'Treasurer']
//     ];
// }

// Add Position
if (isset($_POST['add_position'])) {
    $name = trim($_POST['position_name']);
    if (!empty($name)) {
        $newId = count($_SESSION['positions']) > 0 
            ? max(array_column($_SESSION['positions'], 'id')) + 1 
            : 1;
        $_SESSION['positions'][] = ['id' => $newId, 'name' => $name];
    }
}

// Delete Position
if (isset($_POST['delete_position'])) {
    $idToDelete = $_POST['position_id'];
    $_SESSION['positions'] = array_filter($_SESSION['positions'], function ($pos) use ($idToDelete) {
        return $pos['id'] != $idToDelete;
    });
    $_SESSION['positions'] = array_values($_SESSION['positions']); // reindex
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Positions</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="navbar">
    <div class="logo">
        <img src="../assets/bobotoIcon.png" alt="Logo" class="logo-img">
        <span class="logo-text">admin</span>
    </div>
    <ul class="nav-links">
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="manage_parties.php">Parties</a></li>
        <li><a href="manage_positions.php" class="active">Positions</a></li>
        <li><a href="manage_voters.php">Voters</a></li>
        <li><a href="#">Logout</a></li>
    </ul>
</div>

<main class="position-manager">
    <h1>Manage Positions</h1>

    <!-- Add Position -->
    <section class="position-form">
        <form method="POST" class="position-card">
            <h2>Add New Position</h2>
            <div class="form-group">
                <label for="position_name" class="form-label">Position Name</label>
                <input type="text" name="position_name" id="position_name" required>
            </div>
            <button type="submit" name="add_position" class="btn-primary">Add Position</button>
        </form>
    </section>

    <!-- Existing Positions -->
    <section class="position-list">
        <div class="position-card">
            <h2>Existing Positions</h2>
            <ul class="position-ul">
                <?php foreach ($_SESSION['positions'] as $pos): ?>
                    <li class="position-item">
                        <span><?= htmlspecialchars($pos['name']) ?></span>
                        <form method="POST" class="delete-form">
                            <input type="hidden" name="position_id" value="<?= $pos['id'] ?>">
                            <button type="submit" name="delete_position" class="btn-delete">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
</main>

</body>
</html>
