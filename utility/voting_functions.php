<?php
    require_once 'db_connect.php';

function hasVoterVoted($voter_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT has_voted FROM voters WHERE id = ?");
    $stmt->execute([$voter_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result && $result['has_voted'];
}

function castVote($voter_id, $candidate_id) {
    global $pdo;

    // Check if voter has already voted
    if (hasVoterVoted($voter_id)) {
        return ['success' => false, 'message' => '❌ You have already voted.'];
    }

    // Insert vote
    $stmt = $pdo->prepare("INSERT INTO votes (voter_id, candidate_id) VALUES (?, ?)");
    $voteSuccess = $stmt->execute([$voter_id, $candidate_id]);

    if ($voteSuccess) {
        // Update voter's status
        $updateStmt = $pdo->prepare("UPDATE voters SET has_voted = 1 WHERE id = ?");
        $updateStmt->execute([$voter_id]);

        return ['success' => true, 'message' => '✅ Vote successfully cast.'];
    } else {
        return ['success' => false, 'message' => '❌ Failed to cast vote. Please try again.'];
    }
}


?>