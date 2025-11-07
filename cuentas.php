<?php
session_start();

// Mostrar errores para depuración (quitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "samazon";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = null;

// Función helper: buscar posible email dentro de la sesión
function session_get_email() {
    $keys = ['EMail','email','correo','Correo','user_email','usuario_email'];
    foreach ($keys as $k) {
        if (!empty($_SESSION[$k])) return $_SESSION[$k];
    }
    // si hay un array 'usuario' con datos
    if (!empty($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $subkeys = ['EMail','email','correo','Correo'];
        foreach ($subkeys as $sk) {
            if (!empty($_SESSION['usuario'][$sk])) return $_SESSION['usuario'][$sk];
        }
    }
    // a veces guardan el correo en 'nombre' o 'nombreUsuario' (poco habitual, pero intentar)
    if (!empty($_SESSION['nombre']) && filter_var($_SESSION['nombre'], FILTER_VALIDATE_EMAIL)) return $_SESSION['nombre'];
    if (!empty($_SESSION['correo']) && filter_var($_SESSION['correo'], FILTER_VALIDATE_EMAIL)) return $_SESSION['correo'];
    return null;
}

// Intento 1: usar email si está en sesión
$email_sess = session_get_email();
if ($email_sess) {
    $sql = "SELECT Nombre, Apellido, EMail, `Contraseña` AS pass, Numero_telefono, DNI, edad FROM usuario WHERE EMail = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email_sess);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();
    } else {
        // error en prepare al buscar por email (raro), mostrar el error para depuración
        die("Error en la consulta por EMail: " . $conn->error);
    }
}

// Intento 2: si no hay email en sesión o no se encontró fila, intentar por usuario_id si existe y si la tabla tiene columna 'id'
if (!$usuario && isset($_SESSION['usuario_id'])) {
    // comprobar existencia de la columna 'id' para evitar el error "Unknown column 'id'"
    $check = $conn->query("SHOW COLUMNS FROM usuario LIKE 'id'");
    if ($check && $check->num_rows > 0) {
        $usuario_id = (int) $_SESSION['usuario_id'];
        $sql2 = "SELECT Nombre, Apellido, EMail, `Contraseña` AS pass, Numero_telefono, DNI, edad FROM usuario WHERE id = ?";
        $stmt2 = $conn->prepare($sql2);
        if ($stmt2) {
            $stmt2->bind_param("i", $usuario_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $usuario = $result2->fetch_assoc();
            $stmt2->close();
        } else {
            die("Error en la consulta por id: " . $conn->error);
        }
    }
}

// Opcional: intento 3 (fallback) — buscar por Nombre si se guarda sólo el nombre en sesión
if (!$usuario && !empty($_SESSION['nombre'])) {
    $nombre_sess = $_SESSION['nombre'];
    $sql3 = "SELECT Nombre, Apellido, EMail, `Contraseña` AS pass, Numero_telefono, DNI, edad FROM usuario WHERE Nombre = ? LIMIT 1";
    $stmt3 = $conn->prepare($sql3);
    if ($stmt3) {
        $stmt3->bind_param("s", $nombre_sess);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $usuario = $result3->fetch_assoc();
        $stmt3->close();
    }
}

// Si aún no hay usuario, limpiar sesión y redirigir a crear.php
if (!$usuario) {
    session_unset();
    session_destroy();
    header('Location: crear.php');
    exit;
}

$conn->close();
?>
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
            <p><strong>Contraseña:</strong> ********</p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['Numero_telefono']); ?></p>
            <p><strong>DNI:</strong> <?php echo htmlspecialchars($usuario['DNI']); ?></p>
            <p><strong>Edad:</strong> <?php echo htmlspecialchars($usuario['edad']); ?></p>
        </div>
        <div class="acciones">
            <a href="CerrarSesion.php" class="btn">Cerrar Sesión</a>
            <a href="editar_cuenta.php" class="btn">Editar Datos</a>
        </div>
    </div>
</body>
</html>
