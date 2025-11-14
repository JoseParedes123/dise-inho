<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Resto del código...
// Configuración de la base de datos
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "samazon";

// Conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // Error 500 si falla la conexión
    http_response_code(500);
    die("Error de conexión a la base de datos.");
}

// 1. Obtener ID del usuario (Asumimos ID 1 para pruebas)
// En un sistema real, usarías: session_start(); $ID_Usuario = $_SESSION['ID_Usuario'];
$ID_Usuario = 1; 

// 2. Obtener datos del POST de JavaScript
$product_id = $_POST['product_id'] ?? null;
// Usaremos el nombre de columna CORRECTO: Cantidad (o Cantidad_producto, ajusta según tu BD)
$columna_cantidad = 'Cantidad_producto'; // Ajustar a 'Cantidad_producto' si ese es el nombre correcto

if (empty($product_id)) {
    http_response_code(400); // Bad Request
    die("Error: ID de producto no proporcionado.");
}

// 3. Comprobar si el producto ya existe en el carrito
$sql_check = "SELECT ID_Compra, {$columna_cantidad} FROM carrito 
              WHERE ID_Usuario = ? AND ID_Producto = ?";
$stmt_check = $conn->prepare($sql_check);

if (!$stmt_check) {
    http_response_code(500);
    die("Error al preparar la consulta de verificación: " . $conn->error);
}

$stmt_check->bind_param("ii", $ID_Usuario, $product_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$stmt_check->close();

if ($result_check->num_rows > 0) {
    // 4. El producto existe: ACTUALIZAR la cantidad (+1)
    $row = $result_check->fetch_assoc();
    $nueva_cantidad = $row[$columna_cantidad] + 1;

    $sql_update = "UPDATE carrito SET {$columna_cantidad} = ? 
                   WHERE ID_Usuario = ? AND ID_Producto = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("iii", $nueva_cantidad, $ID_Usuario, $product_id);
    
    if (!$stmt_update->execute()) {
        http_response_code(500);
        die("Error al actualizar cantidad: " . $stmt_update->error);
    }
    $stmt_update->close();
    echo "Producto actualizado en el carrito. Nueva cantidad: " . $nueva_cantidad;

} else {
    // 5. El producto NO existe: INSERTAR nueva fila con cantidad = 1
    $sql_insert = "INSERT INTO carrito (ID_Usuario, ID_Producto, {$columna_cantidad}) 
                   VALUES (?, ?, 1)";
    $stmt_insert = $conn->prepare($sql_insert);
    
    if (!$stmt_insert) {
        http_response_code(500);
        die("Error al preparar la consulta de inserción: " . $conn->error);
    }
    
    $stmt_insert->bind_param("ii", $ID_Usuario, $product_id);

    if (!$stmt_insert->execute()) {
        http_response_code(500);
        die("Error al insertar producto: " . $stmt_insert->error);
    }
    $stmt_insert->close();
    echo "Nuevo producto insertado en el carrito.";
}

$conn->close();
exit; // Asegura que el script termine limpiamente