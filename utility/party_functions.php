<?php
require_once 'db_connect.php';
require_once 'candidate_functions.php';

function insert_party($name) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO partylists (name) VALUES (:name)");
    $stmt->execute([':name' => $name]);
    return $pdo->lastInsertId(); // return party ID
}

function get_all_parties_with_candidates() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT p.id AS party_id, p.name AS party_name, c.id AS candidate_id, c.name AS candidate_name, pos.name AS position
        FROM partylists p
        LEFT JOIN candidates c ON c.party_id = p.id
        LEFT JOIN positions pos ON c.position_id = pos.id
        ORDER BY p.name, pos.name
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function delete_party($id) {
    global $pdo;
    // First delete candidates linked to party
    $pdo->prepare("DELETE FROM candidates WHERE party_id = :id")->execute([':id' => $id]);

    // Then delete the party
    $stmt = $pdo->prepare("DELETE FROM partylists WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}
