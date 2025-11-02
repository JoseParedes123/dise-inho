<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Datos de conexión a la base de datos
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

// Recibir datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? NULL;
$dni = $_POST['DNI'] ?? NULL;
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Validación simple
if ($password !== $confirm_password) {
    echo "Las contraseñas no coinciden. <a href='Crear.php'>Volver</a>";
    exit;
}

// Preparar y ejecutar consulta segura
$stmt = $conn->prepare("INSERT INTO usuario (Nombre, Apellido, EMail, Contraseña, Numero_telefono, DNI) VALUES (?, ?, ?, ?, ?, ?)");
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashear contraseña
$stmt->bind_param("ssssii", $nombre, $apellido, $correo, $hashed_password, $telefono, $dni);
if ($stmt->execute()) {
    // Redirigir a Guterake.php
    header("Location: Guterake.php");
    exit;
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();