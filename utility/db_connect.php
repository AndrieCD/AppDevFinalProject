<?php

$MYSQL_HOSTNAME = "localhost";
$MYSQL_USER = "root";
$MYSQL_PASSWORD = "";
$MYSQL_DATABASE = "finalprojectdb";


try {
    $pdo = new PDO("mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE", $MYSQL_USER, $MYSQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}