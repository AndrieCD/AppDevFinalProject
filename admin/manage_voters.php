<?php
session_start();


// storage voters
if (!isset($_SESSION['voters'])) {
    $_SESSION['voters'] = [];
}


// delete
if (isset($_POST['delete_voter'])) {
    $index = $_POST['delete_voter'];
    unset($_SESSION['voters'][$index]);
    $_SESSION['voters'] = array_values($_SESSION['voters']);
}


// save button functionality ala pang ginagawa
if (isset($_POST['save'])) {
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
        <li><a href="manage_voters.php">Voters</a></li>
        <li><a href="#">Logout</a></li>
    </ul>
</div>


<!-- ======= MAIN CONTENT ======= -->
<main class="PartyManager">
    <h1>Manage Voters</h1>


    <!-- ======= EXISTING VOTERS LIST ======= -->
    <section class="Partycards">
        <div class="card existing-parties-container">
            <div class="existing-parties-title">
                <h1>Existing Voters</h1>
            </div>
            <div class="table-wrapper">
                <form method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Course/Program</th>
                                <th>Year Level</th>
                                <th>Section</th>
                                <th>Email</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                       <tbody>
                            <?php foreach ($_SESSION['voters'] as $index => $voter): ?>
                                <tr>
                                    <td><?= htmlspecialchars($voter['id']) ?></td>
                                    <td><?= htmlspecialchars($voter['name']) ?></td>
                                    <td><?= htmlspecialchars($voter['student_id']) ?></td>
                                    <td><?= htmlspecialchars($voter['course']) ?></td>
                                    <td><?= htmlspecialchars($voter['year_level']) ?></td>
                                    <td><?= htmlspecialchars($voter['section']) ?></td>
                                    <td><?= htmlspecialchars($voter['email']) ?></td>
                                    <td>
                                        <button type="submit" name="delete_voter" value="<?= $index ?>" class="delete-btn">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($_SESSION['voters'])): ?>
                                <tr><td colspan="8" style="text-align: center;">No voters added yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <button type="submit" name="save" class="save-btn">Save</button>
                </form>
            </div>
        </div>
    </section>
</main>


</body>
</html>



