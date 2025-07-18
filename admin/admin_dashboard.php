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
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="manage_parties.php">Parties</a></li>
        <li><a href="manage_positions.php">Positions</a></li>
        <li><a href="manage_voters.php">Voters</a></li>
        <li><a href="../logout.php">Logout</a></li>
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

        <br>

          <!-- Live Results -->
        <div class="wrapper">
        <!-- Display results here -->
            <?php
                $resultsRaw = getVoteResultsGroupedByPosition();

                // Group results by position
                $resultsByPosition = [];
                foreach ($resultsRaw as $row) {
                    $position = $row['position_name'];
                    $resultsByPosition[$position][] = $row;
                }
            ?>
            <?php if (empty($resultsByPosition)): ?>
            <p>No votes yet.</p>
            <?php else: ?>
            <h2 style="text-align:center;">Live Election Results</h2>
            <?php foreach ($resultsByPosition as $position => $candidates): ?>
                <section class="position-results">
                <h3><?= htmlspecialchars($position) ?></h3>
                <div class="results-container">
                    <?php foreach ($candidates as $candidate): ?>
                    <div class="result-card">
                        <h4><?= htmlspecialchars($candidate['candidate_name']) ?></h4>
                        <p><strong>Party:</strong> <?= htmlspecialchars($candidate['party_name']) ?></p>
                        <p><strong>Votes:</strong> <?= $candidate['vote_count'] ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                </section>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>
