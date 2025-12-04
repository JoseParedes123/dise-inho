<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE EMail = '$correo' AND Contraseña = '$contraseña'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $usuario; // Guardar todos los datos
        $_SESSION['EMail'] = $usuario['EMail']; // Guardar email específicamente
        $_SESSION['usuario_id'] = isset($usuario['id']) ? $usuario['id'] : null;
        header("Location: cuentas.php");
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos'); window.location='IniciarSesion.php';</script>";
    }
}
$conn->close();
?>
