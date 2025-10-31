<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="cuentas.css">
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
        </div>
        <div class="acciones">
            <a href="CerrarSesion.php" class="btn">Cerrar Sesión</a>
            <a href="editar_cuenta.php" class="btn">Editar Datos</a>
        </div>
    </div>
</body>
</html>
