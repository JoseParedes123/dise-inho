<?php
session_start();

// Verificar si el usuario está autenticado
if (empty($_SESSION['usuario'])) {
    // Si no hay usuario en sesión, redirigir a crear cuenta
    header('Location: Crear.php');
    exit;
}

// Obtener los datos del usuario desde la sesión
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="cuentas.css">
    <style>
    .volver-btn {
        position: absolute;
        top: 20px;
        left: 20px;
    }
    
    .btn-volver {
        display: inline-block;
        background-color: #dc3545;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    
    .btn-volver:hover {
        background-color: #c82333;
    }
</style>
</head>
<body class="cuenta-body">
    <div class="cuenta-container">
        <h1>Mi Cuenta</h1>
        <div class="info-box">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['Nombre']); ?></p>
            <p><strong>Apellido:</strong> <?php echo htmlspecialchars($usuario['Apellido']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['EMail']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['Numero_telefono']); ?></p>
            <p><strong>DNI:</strong> <?php echo htmlspecialchars($usuario['DNI']); ?></p>
            <p><strong>Edad:</strong> <?php echo htmlspecialchars($usuario['edad']); ?></p>
        </div>
        <div class="acciones">
            <a href="CerrarSesion.php" class="btn">Cerrar Sesión</a>
        </div>
        <div class="volver-btn">
            <a href="Guterake.php" class="btn-volver">← Volver</a>
        </div>
    </div>
</body>
</html>
