<?php
session_start();

// Sample positions (replace with DB-fetch if needed)
if (!isset($_SESSION['positions'])) {
    $_SESSION['positions'] = [
        ['id' => 1, 'name' => 'President'],
        ['id' => 2, 'name' => 'Vice President'],
        ['id' => 3, 'name' => 'Secretary'],
        ['id' => 4, 'name' => 'Treasurer']
    ];
}

if (!isset($_SESSION['parties'])) {
    $_SESSION['parties'] = [];
}

// Add Party
if (isset($_POST['add_party'])) {
    $party = [
        'name' => $_POST['party_name'],
        'candidates' => []
    ];

    for ($i = 0; $i < count($_POST['candidate_name']); $i++) {
        $name = trim($_POST['candidate_name'][$i]);
        $positionId = $_POST['candidate_position_id'][$i];

        if (!empty($name) && !empty($positionId)) {
            $party['candidates'][] = [
                'name' => $name,
                'position_id' => $positionId
            ];
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

// Helper: Get position name by ID
function getPositionName($id) {
    foreach ($_SESSION['positions'] as $pos) {
        if ($pos['id'] == $id) return $pos['name'];
    }
    return 'Unknown';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Parties</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script>
        const positions = <?= json_encode($_SESSION['positions']) ?>;
        let candidateCount = 0;

        function addCandidate(name = "", selectedPositionId = "") {
            candidateCount++;

            const container = document.getElementById('candidate-container');
            const candidateDiv = document.createElement('div');
            candidateDiv.className = 'candidate-box';

            let positionOptions = `<option value="">Select Position</option>`;
            positions.forEach(pos => {
                const selected = pos.id == selectedPositionId ? "selected" : "";
                positionOptions += `<option value="${pos.id}" ${selected}>${pos.name}</option>`;
            });

            candidateDiv.innerHTML = `
                <input type="text" name="candidate_name[]" placeholder="Candidate ${candidateCount}" value="${name}" required>
                <select name="candidate_position_id[]" required>
                    ${positionOptions}
                </select>
                <button type="button" onclick="removeCandidate(this)">Remove</button>
            `;

            container.appendChild(candidateDiv);
        }

        function removeCandidate(button) {
            button.parentElement.remove();
        }
    </script>
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
                    <input type="text" name="party_name" required>
                </div>
            </div>

            <div class="candidate-section">
                <label class="form-label">Candidates</label>
                <div id="candidate-container"></div>
                <button type="button" onclick="addCandidate()" class="add-candidate-btn">+ Add Candidate</button>
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
                                <li>
                                    <?= htmlspecialchars($candidate['name']) ?> -
                                    <em><?= htmlspecialchars(getPositionName($candidate['position_id'])) ?></em>
                                </li>
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

<script>
    // Add one candidate field by default
    window.onload = () => {
        addCandidate();
    };
</script>

</body>
</html>
