<?php
$nombre = $_GET['nombre'] ?? null;
$error  = $_GET['error'] ?? null;
// Manejo de posibilidades al enviar el formulario
if ($error) {
    $mainMessage = "Oops!";
    $subMessage  = "Something went wrong. Please try again with a valid name and email.";
} elseif ($nombre) {
    $safeName = htmlspecialchars($nombre);
    $mainMessage = "Welcome, $safeName!";
    $subMessage  = "You're officially part of The Midnight inner circle. Check your email for updates.";
} else {
    $mainMessage = "YOU'RE IN.";
    $subMessage  = "Welcome to the inner circle of The Midnight. Check your email for future transmissions.";
}

if ($error === 'duplicado') {
    $mainMessage = "You're already in 👀";
    $subMessage  = "That email is already subscribed to The Midnight.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Welcome to the Club - The Midnight</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
</head>
<body class="valign-wrapper" style="min-height: 100vh;">
    <div class="container center white-text">
        <h1 class="dynamic-header" style="font-size: 4rem;">
            <?= $mainMessage ?>
        </h1>
        <h5 class="flow-text">
            <?= $subMessage ?>
        </h5>
        <br>
        <a href="index.html" class="btn-large synth-btn">Back to Home</a>
    </div>
</body>
</html>
