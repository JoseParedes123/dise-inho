<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ingreso de Usuario</title>
</head>
<body>
    <div class="main-content-wrapper">
        <div class="container">
            <h2>Iniciar Sesion</h2>
            <form action="Guardar_usuario.php" method="POST">
                <div class="form-group">
                    <label for="correo"><strong>Correo Electrónico:</strong></label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                    <label for="password"><strong>Contraseña:</strong></label>
                    <input type="password" id="password" name="password" minlength="6" required>
                </div>
                <button type="submit">Ingresar Usuario</button>
            </form>
            <div class="Textinho">
                <p class="small-note"><span>Corporativa Guterake joeshop</span></p>
                <a href="Crear.php" class="link-consulta">¿No tienes una cuenta?</a>
            </div>
        </div>
    </div>


    <script src="java.js"></script>
</body>
</html>