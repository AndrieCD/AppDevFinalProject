<!-- ========== INDEX ========== -->
<!-- ========== HomePage/Landing Page after mag login ========== -->

<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>
<body>

    <!-- Navbar -->
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

    <!-- Main Dashboard Content -->
    <main class="dashboard">
        <h1>Welcome, Admin</h1>
        <div class="IndexCards">
            <div class="IndexCards">
            <a href="manage_parties.php" class="IndexCard">Manage Parties</a>
            <a href="manage_positions.php" class="IndexCard">Manage Positions</a>
            <a href="manage_voters.php" class="IndexCard">Manage Voters</a>
            </div>
        </div>
    </main>

</body>
</html>
