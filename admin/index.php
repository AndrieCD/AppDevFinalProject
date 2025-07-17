<!-- ========== INDEX ========== -->
<!-- ========== HomePage/Landing Page after mag login ========== -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
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
            <div class="IndexCard"><a href="manage_parties.php">Manage Parties</a></div>
            <div class="IndexCard"><a href="manage_positions.php">Manage Positions</a></div>
            <div class="IndexCard"><a href="manage_voters.php">Manage Voters</a></div>
        </div>
    </main>

</body>
</html>
