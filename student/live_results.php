<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vote Success</title>
  <link rel="stylesheet" href="../assets/css/student.css" />
</head>
<body>

  <!-- Top Navigation -->
  <nav class="top-nav">
    <div class="nav-left">
<img src="../assets/BobotoLogo.png"alt="BOBOTO Logo" class="nav-logo">
    </div>
    <div class="nav-right">
      <a href="#" class="nav-link">Vote</a>
      <a href="../logout.php" class="nav-link">Logout</a>
    </div>
  </nav>

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


</body>
</html>
