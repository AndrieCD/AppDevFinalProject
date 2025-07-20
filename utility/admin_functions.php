<?php
    require_once 'db_connect.php';

    // functions to manage admins

    function insert_admin($email, $password) {
        global $pdo;
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("
            INSERT INTO admins (email, password) 
            VALUES (:email, :password)
        ");

        return $stmt->execute([
            ':email' => $email,
            ':password' => $hashed
        ]);
    }

    function get_all_admins() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, email, password FROM admins");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function delete_admin($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM admins WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    function getadminByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>