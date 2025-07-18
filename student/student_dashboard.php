<?php
require_once '../utility/init.php';
validateSession();

// Group candidates by position
$candidates_by_position = [];
foreach (get_all_candidates() as $candidate) {
    $position = $candidate['position_name'];
    $candidates_by_position[$position][] = $candidate;
}

// Get all positions
$positions = get_all_positions();

// Check if the user has already voted
$voter_id = $_SESSION['user_id'];
if (hasVoterVoted($voter_id)) {
    header("Location: votesuccess.php");
    exit();
}

// If the user has not voted, proceed to display the voting page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($positions as $position) {
        $position_name = $position['name'];
        $position_id = $position['id'];

        $input_name = strtolower(str_replace(' ', '_', $position_name));

        if (isset($_POST[$input_name])) {
            $candidate_id = $_POST[$input_name];
            castVote($voter_id, $candidate_id, $position_id);
        }
    }

    header("Location: votesuccess.php");
    exit();
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Voting Page</title>
  <link rel="stylesheet" href="../assets/css/student.css" />
</head>
<body>

  <!-- Top Navigation Bar -->
  <nav class="top-nav">
    <div class="nav-left">
      <img src="../assets/BobotoLogo.png" alt="BOBOTO Logo" class="nav-logo">
    </div>
    <div class="nav-right">
      <a href="#" class="nav-link">Vote</a>
      <a href="../logout.php" class="nav-link">Logout</a>
    </div>
  </nav>

  <!-- Welcome Banner (outside green nav) -->
  <div class="welcome-banner">
    <h2>Welcome!</h2>
  </div>

  <!-- Splash Screen -->
  <div id="splash-screen">
    <div class="splash-content">
      <img src="../assets/Logo.png" alt="Vote Logo" class="splash-logo" />
      <h1 style="font-size: 48px;">Your vote matters</h1>
    </div>
  </div>

  <!-- Main Dashboard Container -->
  <div class="dashboard-container">

    <!-- Election Info -->
    <section class="election-info">
      <h3>Student Organization Election 2025</h3>
      <p>Voting Period: July 20–25, 2025</p>
    </section>

    <!-- Voting Form -->
    <form class="voting-form" method="POST">

      <?php foreach ($candidates_by_position as $position => $candidates): ?>
        <div class="position-group">
            <h4><?= htmlspecialchars($position) ?></h4>
            <div class="candidate-grid">
                <?php foreach ($candidates as $candidate): ?>
                    <label class="candidate-card">
                        <input type="radio" 
                               name="<?= strtolower(str_replace(' ', '_', $position)) ?>" 
                               value="<?= $candidate['id'] ?>" 
                               required>
                        <h5><?= htmlspecialchars($candidate['name']) ?></h5>
                        <p><?= htmlspecialchars($candidate['party_name']) ?></p>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

      <!-- Submit Button -->
      <button type="submit" class="vote-now-btn">Submit Vote</button>
    </form>
  </div>

  <!-- Splash Screen Script -->
  <script>
    window.addEventListener("load", () => {
      const splash = document.getElementById("splash-screen");
      setTimeout(() => {
        splash.classList.add("fade-out");
      }, 2000); // Show for 2 seconds
    });
  </script>

</body>
</html>
