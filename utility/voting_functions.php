<?php
    require_once 'db_connect.php';

function hasVoterVoted($voter_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT has_voted FROM users WHERE id = ?");
    $stmt->execute([$voter_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result && $result['has_voted'];
}

function castVote($voter_id, $candidate_id, $position_id) {
    global $pdo;

    // Insert vote
    $stmt = $pdo->prepare("INSERT INTO votes (voter_id, candidate_id, position_id) VALUES (?, ?, ?)");
    $voteSuccess = $stmt->execute([$voter_id, $candidate_id, $position_id]);

    if ($voteSuccess) {
        // Update voter's status
        $updateStmt = $pdo->prepare("UPDATE users SET has_voted = 1 WHERE id = ?");
        $updateStmt->execute([$voter_id]);

        return ['success' => true, 'message' => '✅ Vote successfully cast.'];
    } else {
        return ['success' => false, 'message' => '❌ Failed to cast vote. Please try again.'];
    }
}

function getVoteResultsGroupedByPosition() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT 
            c.id AS candidate_id, 
            c.name AS candidate_name, 
            p.name AS party_name, 
            pos.name AS position_name,
            COUNT(v.id) AS vote_count
        FROM candidates c
        LEFT JOIN votes v ON c.id = v.candidate_id
        JOIN elections p ON c.party_id = p.id
        JOIN positions pos ON c.position_id = pos.id
        GROUP BY c.id, p.name, pos.name
        ORDER BY pos.name ASC, vote_count DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>