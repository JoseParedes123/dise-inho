<?php

// Configuración de la base de datos

$servername = "localhost"; // Generalmente "localhost" para entornos locales

$username = "root";        // Usuario por defecto de MySQL en XAMPP/WAMP

$password = "";            // Contraseña por defecto (vacía) en XAMPP/WAMP
    
$dbname = "samazon";       // Nombre de la base de datos que crearon

$table  = "usuario";



// Crear conexión - corregido los nombres de variables

$conn = new mysqli($servername, $username, $password, $dbname);



// Verificar conexión

if ($conn->connect_error) {

    die("Conexión fallida: " . $conn->connect_error);

}

// Verificar si el formulario ha sido enviado (método POST)

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario y sanitizarlos

    $Nombre = $conn->real_escape_string($_POST['nombre']);

    $Apellido = $conn->real_escape_string($_POST['apellido']);

    $EMail = $conn->real_escape_string($_POST['correo']);

    $ContraseñaContraseña = $conn->real_escape_string($_POST['password']);

    $Numero_telefono = $conn->real_escape_string($_POST['telefono']);

    $DNI = $conn->real_escape_string($_POST['DNI']);

    $Tarjeta = $conn->real_escape_string($_POST['Tarjeta']);

    $Edad = $conn->real_escape_string($_POST['Edad']);





    // Preparar la consulta SQL - corregido nombre de tabla a 'usuario'

    $sql = "INSERT INTO usuario (Nombre, Apellido, EMail, Contraseña, Numero_telefono, DNI, Tarjeta, edad) VALUES ('$Nombre', '$Apellido', '$EMail', '$Contraseña', '$Numero_telefono', '$DNI', '$Tarjeta', '$Edad')";



    // Ejecutar la consulta

    if ($conn->query($sql) === TRUE) {

        echo "<!DOCTYPE html>

                <html lang='es'>

                <head>

                    <meta charset='UTF-8'>

                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

                    <title>Resultado del Ingreso</title>

                    <style>

                        body { font-family: Arial, sans-serif; background-color: rgb(17, 17, 17); display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; text-align: center; }

                        .message-box { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 400px; max-width: 90%; }

                        h2 { color: #28a745; margin-bottom: 20px; }

                        p { margin-bottom: 20px; }

                        a { display: inline-block; padding: 10px 20px; background-color: #d61d1d; color: white; border-radius: 4px; text-decoration: none; transition: background-color 0.3s ease; }

                        a:hover { background-color: #0056b3; }

                    </style>

                </head>

                <body>

                    <div class='message-box'>

                        <h2>¡Éxito!</h2>

                        <p>Puede ingresar.</p>

                        <a href='/dise-inho/Guterake.php'>ir al inicio</a>


                    </div>

                </body>

                </html>";

    } else {

        echo "<!DOCTYPE html>

                <html lang='es'>

                <head>

                    <meta charset='UTF-8'>

                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

                    <title>Error de Ingreso</title>

                    <style>

                        body { font-family: Arial, sans-serif; background-color:rgb(0, 0, 0); display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; text-align: center; }

                        .message-box { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 400px; max-width: 90%; }

                        h2 { color: #dc3545; margin-bottom: 20px; }

                        p { margin-bottom: 20px; }

                        a { display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 4px; text-decoration: none; transition: background-color 0.3s ease; }

                        a:hover { background-color: #0056b3; }

                    </style>

                </head>

                <body>

                    <div class='message-box'>

                        <h2>¡Error!</h2>

                        <p>Error al ingresar: " . $conn->error . "</p>

                    </div>

                </body>

                </html>";

    }

}

// Cerrar conexión

$conn->close();

?>