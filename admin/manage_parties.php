<!-- ========== PARTIES ========== -->

<!-- ========== Add a party as a whole, with all candidates ========== -->

<?php
session_start();

// Initialize session storage for parties
if (!isset($_SESSION['parties'])) {
    $_SESSION['parties'] = [];
}

// Add Party
if (isset($_POST['add_party'])) {
    $party = [
        'name' => $_POST['party_name'],
        'candidates' => []
    ];

    for ($i = 0; $i < 5; $i++) {
    $name = trim($_POST['candidate_name'][$i]);

    if (!empty($name)) {
        $party['candidates'][] = ['name' => $name];
    }
}


    $_SESSION['parties'][] = $party;
}

// Delete Party
if (isset($_POST['delete_party'])) {
    $index = $_POST['delete_index'];
    unset($_SESSION['parties'][$index]);
    $_SESSION['parties'] = array_values($_SESSION['parties']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Parties</title>
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
    <h1>Manage Parties</h1>

   <!-- ======= PARTY FORM ======= -->
    <section class="party-form">
        <form method="POST" class="cardParty">
            <h3>Add New Party</h3>

            <div class="form-group">
                <label class="form-label">Party Name</label>
                <div class="form-row">
                    <input type="text" id="party_name" name="party_name" required>
                </div>
            </div>
            <div class="candidate-section">
                <label class="form-label">Candidates</label>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="candidate-box">
                        <input type="text" name="candidate_name[]" placeholder="Candidate <?= $i + 1 ?>">
                    </div>
                <?php endfor; ?>
            </div>
            <div class="addPartyButton">
                <button type="submit" name="add_party" class="submit-btn-inline">Add Party</button>
            </div>
            
        </form>
    </section>

    <!-- ======= PARTY LIST ======= -->
    <section class="Partycards">
        <div class="card existing-parties-container">
            <div class="existing-parties-title">
                <h1>Existing Parties</h1>
            </div>
            <div class="existing-parties-list">
                <?php foreach ($_SESSION['parties'] as $index => $party): ?>
                    <div class="card inner-party-card">
                        <h3><?= htmlspecialchars($party['name']) ?></h3>
                        <ul style="text-align:left;">
                            <?php foreach ($party['candidates'] as $candidate): ?>
                                <li><?= htmlspecialchars($candidate['name']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <form method="POST" class="delete-form">
                            <input type="hidden" name="delete_index" value="<?= $index ?>">
                            <button type="submit" name="delete_party" class="deletepartyButton">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>




</main>

</body>
</html>
