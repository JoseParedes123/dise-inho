<?php
// Configuración de la base de datos (¡AJUSTA TUS CREDENCIALES!)
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "samazon";

// Conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    die("Error de conexión a la base de datos.");
}

// 1. Obtener ID del usuario (Asumimos ID 1)
session_start();
$ID_Usuario = 1; 

// 2. Obtener el ID del producto del POST de JavaScript
$product_id = $_POST['product_id'] ?? null;

if (empty($product_id)) {
    http_response_code(400); // Bad Request
    die("Error: ID de producto no proporcionado para eliminar.");
}

// 3. Consulta DELETE para eliminar el producto completo del carrito del usuario
// Nota: Un DELETE de un producto en el carrito borra TODAS las instancias de ese producto.
$sql_delete = "DELETE FROM carrito 
               WHERE ID_Usuario = ? AND ID_Producto = ?";
$stmt_delete = $conn->prepare($sql_delete);

if (!$stmt_delete) {
    http_response_code(500);
    die("Error al preparar la consulta de borrado: " . $conn->error);
}

$stmt_delete->bind_param("ii", $ID_Usuario, $product_id);

if ($stmt_delete->execute()) {
    // Si la eliminación fue exitosa (aunque no haya filas afectadas, es un éxito)
    if ($stmt_delete->affected_rows > 0) {
        echo "Producto (ID: " . $product_id . ") eliminado de la BD.";
    } else {
        echo "El producto (ID: " . $product_id . ") ya no estaba en la BD.";
    }
} else {
    // Si hay un error de ejecución de MySQL
    http_response_code(500);
    echo "Error al ejecutar DELETE en la base de datos: " . $stmt_delete->error;
}

$stmt_delete->close();
$conn->close();
exit;