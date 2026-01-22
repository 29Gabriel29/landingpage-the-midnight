<?php
session_start();

// 1. Verificación de sesión
if (empty($_SESSION['admin_logged'])) {
    header("Location: admin_login.php");
    exit;
}

// 2. Conexión a la base de datos
require_once __DIR__ . '/config.php';


try {
    $stmt = $conn->query("SELECT * FROM fans ORDER BY id DESC");
    $fans = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $fans = [];
    $error_db = "Error de base de datos";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fans List - The Midnight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

<style>
    /* 1. Contenedor con scroll para móviles */
    .tabla-wrapper {
        overflow-x: auto;
        background: rgba(0, 0, 0, 0.6);
        border-radius: 12px;
        padding: 5px;
        margin-top: 20px;
        border: 1px solid rgba(213, 0, 249, 0.3); /* Borde exterior muy fino */
    }
    
    /* 2. Reset de la tabla para que no se superponga */
    .synth-table {
        border: none !important; /* Quitamos el borde grueso de 8px */
        border-collapse: collapse !important;
        width: 100%;
    }

    /* 3. Estilo de las celdas (Cuerpo) */
    .synth-table td {
        padding: 8px 12px !important;
        border-bottom: 1px solid rgba(213, 0, 249, 0.1) !important; /* Línea divisoria sutil */
        font-size: 14px;
        color: #fff;
    }

    /* 4. Encabezados con toque fluorescente */
    .synth-table th {
        background-color: rgba(74, 20, 140, 0.5);
        color: #ff00ff !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px !important;
        font-size: 13px;
        border-bottom: 2px solid #d500f9 !important; /* Solo línea neón abajo del cabezal */
    }

    /* 5. Botón de eliminar compacto (Corregido) */
    .btn-delete {
        all: unset; /* Limpiamos estilos heredados */
        display: inline-block;
        padding: 5px 15px;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        color: #fff;
        background: #ff1744;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        line-height: 1;
        border: 1px solid transparent;
    }

    .btn-delete:hover {
        background: #b2102f;
        box-shadow: 0 0 8px rgba(255, 23, 68, 0.6);
        transform: translateY(-1px);
    }

    /* 6. Evitar que el form de la celda genere espacios extra */
    .synth-table form {
        margin: 0 !important;
        padding: 0 !important;
        display: flex;
        justify-content: center;
    }

    /* Ajuste para el texto del ID y Email */
    .id-cell { color: #d500f9; font-weight: bold; }
    .email-cell { opacity: 0.8; font-size: 0.9em; }
</style>

</head>
<body style="min-height: 100vh;">
<div class="container" style="width: 95%; max-width: 1200px; padding-top: 30px;">
    
    <h3 class="dynamic-header center">Registered Fans</h3>

    <?php if (isset($error_db)): ?>
        <p class="red-text center"><?= $error_db ?></p>
    <?php endif; ?>

    <div class="tabla-wrapper">
        <table class="centered highlight synth-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($fans)): ?>
                    <?php foreach ($fans as $fan): ?>
                    <tr>
			<td class="id-cell"><?= $fan['id'] ?></td>
                        <td><?= htmlspecialchars($fan['nombre']) ?></td>
                        <td><span style="font-size: 0.9em;"><?= htmlspecialchars($fan['email']) ?></span></td>
                        <td>
                            <form action="delete_fan.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $fan['id'] ?>">
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="center">No fans registered yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="center" style="margin-top: 40px; padding-bottom: 40px;">
        <a href="logout.php" class="btn synth-btn">Logout</a>
        <p><a href="index.html" class="white-text" style="font-size: 0.8em; opacity: 0.7;">← Home</a></p>
    </div>
</div>
</body>
</html>
