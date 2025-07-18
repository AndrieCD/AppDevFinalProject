<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();
?>

<?php
    $parties = get_all_parties_with_candidates();
    $_SESSION['parties'] = $parties;

    if (!isset($_SESSION['positions'])) {
        $_SESSION['positions'] = get_all_positions(); 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_party'])) {
        $partyName = trim($_POST['party_name']);
        $candidates = $_POST['candidate_name'] ?? [];
        $positions = $_POST['candidate_position_id'] ?? [];

        // Validate party name
        if (!validatePartyName($partyName)) {
            $error = "Invalid party name. It should be at least 5 letters long and contain only letters.";

            // check if party name already exists
            $existingParty = get_party_id_by_name($partyName);
            if ($existingParty) {
                $error = "Party name already exists.";
            } else {
                $partyId = insert_party($partyName);
                $_SESSION['parties'] = get_all_parties_with_candidates();
                
                foreach ($candidates as $index => $name) {
                    if (!empty($name) && !empty($positions[$index])) {
                        insert_candidate($name, $positions[$index], $partyId);
                    }
                }
                
                header("Location: manage_parties.php");
                exit();
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_party'])) {
        $partyId = $_POST['party_id'] ?? null;

        if ($partyId) {
            delete_party($partyId);
            $_SESSION['parties'] = get_all_parties_with_candidates();
            header("Location: manage_parties.php");
            exit();
        }
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
       <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="manage_parties.php">Parties</a></li>
        <li><a href="manage_positions.php">Positions</a></li>
        <li><a href="manage_voters.php">Voters</a></li>
        <li><a href="../logout.php">Logout</a></li>
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

                <!-- Display existing parties -->
                <?php foreach ($parties as $party): ?>
                    <div class="card inner-party-card">
                        <h3><?= htmlspecialchars($party['party_name']) ?></h3>
                        <ul style="text-align:left;">
                            <?php foreach ($party['candidates'] as $candidate): ?>
                                <li>
                                    <?= htmlspecialchars($candidate['candidate_name']) ?> -
                                    <em><?= htmlspecialchars($candidate['position']) ?></em>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <form method="POST" class="delete-form">
                            <input type="hidden" name="party_id" value="<?= $party['party_id'] ?>">
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
