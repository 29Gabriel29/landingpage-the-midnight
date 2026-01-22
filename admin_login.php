<?php
session_start();
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin123');
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
        $_SESSION['admin_logged'] = true;
        header("Location: list_fans.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}

if (!empty($_SESSION['admin_logged'])) {
    header("Location: list_fans.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - The Midnight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="valign-wrapper" style="min-height: 100vh;">
<div class="container center">
    
    <h3 class="dynamic-header">Admin Access</h3>

    <?php if ($error): ?>
        <div class="chip red white-text"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" style="margin-top: 20px;">
        <div class="input-field">
            <i class="material-icons prefix">person</i>
            <input type="text" name="user" id="user" required>
            <label for="user">Username</label>
        </div>

        <div class="input-field">
            <i class="material-icons prefix">lock</i>
            <input type="password" name="pass" id="pass" required>
            <label for="pass">Password</label>
        </div>

        <button class="btn-large synth-btn" type="submit" style="width: 100%;">
            Login
        </button>
        
        <div style="margin-top: 30px;">
            <a href="index.html" class="white-text" style="letter-spacing: 2px;">
                ← Back to Home
            </a>
        </div>
    </form>
</div>
</body>
</html>
