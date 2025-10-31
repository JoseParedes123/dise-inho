<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-content-wrapper">
        <div class="container">
            <h2>Crear cuenta</h2>
            <form action="REGISTRAR.php" method="POST" id="form-registro" novalidate>
                <div class="form-group">
                    <label for="nombre"><strong>Nombre:</strong></label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido"><strong>Apellido:</strong></label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="correo"><strong>Correo Electrónico:</strong></label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                    <label for="telefono"><strong>Número Telefónico:</strong></label>
                    <input type="number" id="telefono" name="telefono">
                </div>
                <div class="form-group">
                    <label for="DNI"><strong>DNI:</strong></label>
                    <input type="number" id="DNI" name="DNI">
                </div>
                <div class="form-group">
                    <label for="password"><strong>Contraseña:</strong></label>
                    <input type="password" id="password" name="password" minlength="6" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password"><strong>Confirmar contraseña:</strong></label>
                    <input type="password" id="confirm_password" name="confirm_password" minlength="6" required>
                </div>
                <button type="submit">Crear cuenta</button>
                <p class="small-note">Al crear una cuenta aceptas los términos y condiciones.</p>
            </form>
            <div class="Textinho">
                <span><p>Guterake joeshop</p></span>
                <a href="IniciarSesion.php" class="link-consulta">¿Ya tienes cuenta? Iniciar sesión</a>
            </div>
        </div>
    </div>


    <script src="java.js"></script>
</body>
</html>