<?php
    require_once 'db_connect.php';

    function insert_voter($email, $password) {
        global $pdo;
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("
            INSERT INTO voters (email, password, has_voted) 
            VALUES (:email, :password, 0)
        ");

        return $stmt->execute([
            ':email' => $email,
            ':password' => $hashed
        ]);
    }

    function get_all_voters() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, email, password, has_voted FROM voters");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function delete_voter($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM voters WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    function getVoterByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM voters WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>