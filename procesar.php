<?php

require_once 'config.php';

try {
    $conn = new PDO(
        "pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Error conexión DB");
}

$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email'] ?? '');

if (!$nombre || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Datos inválidos");
}

// 1️⃣ Guardar en DB
$stmt = $conn->prepare(
    "INSERT INTO fans (nombre, email) VALUES (:n, :e)"
);
$stmt->execute([
    ':n' => $nombre,
    ':e' => $email
]);

// 2️⃣ Enviar email con Resend
$emailData = [
    "from" => RESEND_FROM,
    "to" => [$email],
    "subject" => "You're in ✨",
    "html" => "
        <h1>You're in, $nombre.</h1>
        <p>Welcome to the inner circle of <strong>The Midnight</strong>.</p>
        <p>Stay tuned for future transmissions.</p>
    "
];

$ch = curl_init('https://api.resend.com/emails');
curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . RESEND_API_KEY,
        'Content-Type: application/json'
    ],
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => json_encode($emailData)
]);

$response = curl_exec($ch);

error_log('=== RESEND DEBUG START ===');

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    error_log('Resend CURL error: ' . curl_error($ch));
} else {
    error_log("Resend HTTP Code: $httpCode");
    error_log("Resend Raw Response: $response");
}

error_log('=== RESEND DEBUG END ===');

curl_close($ch);




// 3️⃣ Redirigir (aunque el mail falle)
header("Location: confirmation.php?nombre=" . urlencode($nombre));
exit;

