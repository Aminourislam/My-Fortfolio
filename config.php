<?php
$host = 'sql307.infinityfree.com';
$dbname = 'if0_39931409_portfolio';
$username = 'if0_39931409';
$password = 'MoTtgPkWeiE';       

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>