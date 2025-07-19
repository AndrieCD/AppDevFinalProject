<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();
?>

<?php
    $positions = get_all_positions();
    $_SESSION['positions'] = $positions;
    $msg = '';

// Add Position
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_position'])) {
    $name = trim($_POST['position_name']);

    if (!empty($name)) {
        if (validatePositionName($name)) {
            $existingPosition = get_position_id_by_name($name);
            if ($existingPosition) {
                $msg = "Position name already exists.";
                // Optionally, you can redirect or handle this case differently
            }
            else {
                $added = add_position($name);
                if ($added) {
                    $_SESSION['positions'] = get_all_positions();
                    header("Location: manage_positions.php");
                    exit();
                } else {
                    $msg = "Failed to add position.";
                }
            }
        } else {
            $msg = "Invalid position name. It should contain only letters and spaces.";
        }
    } else {
        $msg = "Position name cannot be empty.";
    }
}

// Delete Position
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_position'])) {
    $idToDelete = $_POST['position_id'] ?? null;

    if ($idToDelete) {
        $deleted = delete_position($idToDelete);
        if ($deleted) {
            $_SESSION['positions'] = get_all_positions();
            header("Location: manage_positions.php");
            exit();
        } else {
            $msg = "Failed to delete position.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Positions</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>

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

<main class="position-manager">
    <h1 class="animated-title">Manage Voters</h1>

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
        <?php if (!empty($msg)) echo "<p class='error-message'>$msg</p>"; ?>
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
