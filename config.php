<?php
// Database (Apunta a las variables de entorno de Render)
define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));

$conn = new PDO(
    "pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME,
    DB_USER,
    DB_PASS,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// Resend (API de envio de Emails)
define('RESEND_API_KEY', getenv('RESEND_API_KEY'));
define('RESEND_FROM', getenv('RESEND_FROM'));
