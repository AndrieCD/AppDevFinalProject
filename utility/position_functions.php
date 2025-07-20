<?php
require_once 'db_connect.php';

function add_position($name) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO positions (name) VALUES (:name)");
    return $stmt->execute(['name' => htmlspecialchars($name)]);
}

function get_all_positions() {
    global $pdo;
    $stmt = $pdo->query("SELECT id, name FROM positions ORDER BY name ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function delete_position($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM positions WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}

// Upd position name
function update_position($id, $newName) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE positions SET name = :name WHERE id = :id");
    return $stmt->execute([
        'name' => htmlspecialchars($newName),
        'id' => $id
    ]);
}

function getPositionName($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM elections WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetchColumn();
}

// Get position ID by name
function get_position_id_by_name($name) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM positions WHERE name = :name");
    $stmt->execute([':name' => htmlspecialchars($name)]);
    return $stmt->fetchColumn();
}