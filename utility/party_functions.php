<?php
require_once 'db_connect.php';
require_once 'candidate_functions.php';

function insert_party($name) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO elections (name) VALUES (:name)");
    $stmt->execute([':name' => $name]);
    return $pdo->lastInsertId(); // return party ID
}

function get_all_parties_with_candidates() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT 
            p.id AS party_id, 
            p.name AS party_name, 
            c.id AS candidate_id, 
            c.name AS candidate_name, 
            pos.name AS position
        FROM elections p
        LEFT JOIN candidates c ON c.party_id = p.id
        LEFT JOIN positions pos ON c.position_id = pos.id
        ORDER BY p.name, pos.name
    ");

    $rawData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $parties = [];

    foreach ($rawData as $row) {
        $partyId = $row['party_id'];

        if (!isset($parties[$partyId])) {
            $parties[$partyId] = [
                'party_id' => $partyId,
                'party_name' => $row['party_name'],
                'candidates' => []
            ];
        }

        // avoid null candidates
        if (!empty($row['candidate_id'])) {
            $parties[$partyId]['candidates'][] = [
                'candidate_id' => $row['candidate_id'],
                'candidate_name' => $row['candidate_name'],
                'position' => $row['position']
            ];
        }
    }

    return array_values($parties); // reset keys
}


function delete_party($id) {
    global $pdo;
    // delete candidates
    $pdo->prepare("DELETE FROM candidates WHERE party_id = :id")->execute([':id' => $id]);

    // delete the party
    $stmt = $pdo->prepare("DELETE FROM elections WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

function get_party_id_by_name($name) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM elections WHERE name = :name");
    $stmt->execute([':name' => $name]);
    return $stmt->fetchColumn();
}