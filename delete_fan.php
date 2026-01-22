<?php
session_start();

if (empty($_SESSION['admin_logged'])) {
    header("Location: admin_login.php");
    exit;
}
// Mencionamos a config para que mire las variables
require_once __DIR__ . '/config.php';
// Manejo de excepciones
try {
    $conn = new PDO(
        "pgsql:host=$host;dbname=$db",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("DB connection error");
}

$id = $_POST['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM fans WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: list_fans.php");
exit;
