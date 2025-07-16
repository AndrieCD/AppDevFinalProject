<?php
require_once 'db_connect.php';

function insert_candidate($name, $position_id, $party_id) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO candidates (name, position_id, party_id) VALUES (:name, :position_id, :party_id)");
    return $stmt->execute([
        ':name' => $name,
        ':position_id' => $position_id,
        ':party_id' => $party_id
    ]);
}

function get_all_candidates() {
    global $pdo;
    $stmt = $pdo->query("SELECT c.id, c.name, p.name AS party_name, pos.name AS position_name
                         FROM candidates c
                         JOIN partylists p ON c.party_id = p.id
                         JOIN positions pos ON c.position_id = pos.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function delete_candidate($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM candidates WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}
