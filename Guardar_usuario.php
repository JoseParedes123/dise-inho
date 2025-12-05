<?php
// 1. Iniciar la sesión al principio
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Datos de conexión a la base de datos (Reutilizados de tu código de registro)
$host = "localhost";
$db   = "samazon";
$user = "root";      
$pass = "";          // Cambiar por tu contraseña de MySQL

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// 3. Recibir datos del formulario de inicio de sesión
// Asumimos que los campos del formulario HTML son 'correo' y 'password'
$correo = $_POST['correo'] ?? '';
$dni = $_POST['DNI'] ?? NULL;
$password_ingresada = $_POST['password'] ?? '';
$login_exitoso = false;
$mensaje_error = "";

// 4. Preparar la consulta segura (Buscar usuario por email)
// Seleccionamos todos los datos del usuario
$stmt = $conn->prepare("SELECT ID_usuario, Nombre, Apellido, EMail, Numero_telefono, DNI, Tarjeta, edad, Contraseña FROM usuario WHERE EMail = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    // Usuario encontrado, obtener los datos
    $usuario = $resultado->fetch_assoc();
    $hash_contrasena_db = $usuario['Contraseña'];

    // 5. Verificar la contraseña con password_verify()
    if (password_verify($password_ingresada, $hash_contrasena_db)) {
        
        // ¡Inicio de Sesión Exitoso!
        $login_exitoso = true;
        
        // 6. Configurar variables de sesión
        $_SESSION['usuario'] = array(
            'ID_usuario' => $usuario['ID_usuario'],
            'Nombre' => $usuario['Nombre'],
            'Apellido' => $usuario['Apellido'],
            'EMail' => $usuario['EMail'],
            'Numero_telefono' => $usuario['Numero_telefono'],
            'DNI' => $usuario['DNI'],
            'Tarjeta' => $usuario['Tarjeta'],
            'edad' => $usuario['edad']
        );
        $_SESSION['EMail'] = $usuario['EMail'];
        $_SESSION['usuario_id'] = $usuario['ID_usuario'];
        
        // 7. Redirigir a la página de bienvenida
        header("Location: cuentas.php"); // Redirige a cuentas.php
        exit;
    } else {
        // Contraseña incorrecta
        $mensaje_error = "Credenciales incorrectas.";
    }
} else {
    // Email no encontrado
    $mensaje_error = "Credenciales incorrectas.";
}

// 8. Si falla el inicio de sesión, mostrar mensaje de error
if (!$login_exitoso) {
    echo "Error en el inicio de sesión: " . $mensaje_error . " <a href='compara_login.php'>Volver al Login</a>";
}

$stmt->close();
$conn->close();
?>