<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de la base de datos (¡VERIFICA TUS CREDENCIALES!)
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "samazon";

// 1. Establecer la cabecera de la respuesta como texto plano para evitar basura HTML
header('Content-Type: text/plain');

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    die("Error de conexión: " . $conn->connect_error); 
}

// 2. Obtener ID del usuario
session_start();
// Usamos Cantidad_producto porque así está en tu archivo SQL samazon (1).sql
$columna_cantidad = 'Cantidad_producto'; 
$ID_Usuario = 1; 

if (!isset($ID_Usuario)) {
    http_response_code(401);
    die("Error: Usuario no autenticado.");
}

// --- INICIO DE LA TRANSACCIÓN (Para asegurar que todos los pasos se completen o ninguno) ---
$conn->autocommit(FALSE);

// A. Insertar en la tabla 'pedido' y obtener el nuevo ID
$sql_insert_pedido = "INSERT INTO pedido (ID_Usuario) VALUES (?)";
$stmt_pedido = $conn->prepare($sql_insert_pedido);
if (!$stmt_pedido) {
    $conn->rollback();
    http_response_code(500);
    die("Error al preparar INSERT pedido: " . $conn->error);
}
$stmt_pedido->bind_param("i", $ID_Usuario);
if (!$stmt_pedido->execute()) {
    $conn->rollback();
    http_response_code(500);
    die("Error al ejecutar INSERT pedido: " . $stmt_pedido->error);
}
$ID_Pedido = $conn->insert_id; // Obtener el ID de la cabecera del pedido
$stmt_pedido->close();

// B. Transferir productos de 'carrito' a 'detalle_pedido'
// Esta consulta selecciona y luego inserta en la nueva tabla
$sql_transfer = "INSERT INTO detalle_pedido (ID_Pedido, ID_Producto, {$columna_cantidad})
                 SELECT ?, c.ID_Producto, c.{$columna_cantidad} 
                 FROM carrito c
                 WHERE c.ID_Usuario = ?";
                 
$stmt_transfer = $conn->prepare($sql_transfer);
if (!$stmt_transfer) {
    $conn->rollback();
    http_response_code(500);
    die("Error al preparar INSERT detalle: " . $conn->error);
}
$stmt_transfer->bind_param("ii", $ID_Pedido, $ID_Usuario);
if (!$stmt_transfer->execute()) {
    $conn->rollback();
    http_response_code(500);
    die("Error al ejecutar TRANSFER detalle: " . $stmt_transfer->error);
}
$rows_transferred = $stmt_transfer->affected_rows;
$stmt_transfer->close();

if ($rows_transferred == 0) {
    // Si no había productos en el carrito, borramos el pedido que acabamos de crear
    $conn->rollback();
    die("Error: No hay productos en el carrito para realizar el pedido.");
}

// C. Obtener detalles del pedido para el mensaje final
$sql_details = "SELECT p.Nombre_producto, d.{$columna_cantidad}
                FROM detalle_pedido d
                JOIN producto p ON d.ID_Producto = p.ID_Producto
                WHERE d.ID_Pedido = ?";
$stmt_details = $conn->prepare($sql_details);
$stmt_details->bind_param("i", $ID_Pedido);
$stmt_details->execute();
$result_details = $stmt_details->get_result();
$stmt_details->close();

$products_list = [];
$total_items = 0;
while ($row = $result_details->fetch_assoc()) {
    $products_list[] = $row[$columna_cantidad] . "x " . $row['Nombre_producto'];
    $total_items += $row[$columna_cantidad];
}

// D. Vaciar el carrito (DELETE)
$sql_clear = "DELETE FROM carrito WHERE ID_Usuario = ?";
$stmt_clear = $conn->prepare($sql_clear);
$stmt_clear->bind_param("i", $ID_Usuario);

if (!$stmt_clear->execute()) {
    $conn->rollback(); // Revertir todo si falla el DELETE final
    http_response_code(500);
    die("Error al vaciar el carrito: " . $stmt_clear->error);
}
$stmt_clear->close();

// --- FIN DE LA TRANSACCIÓN: Si todo fue bien, confirmar los cambios ---
$conn->commit();

// 3. Imprimir el mensaje de éxito
$response_message = "¡Pedido realizado con éxito!\n\n";
$response_message .= "ID del Pedido: " . $ID_Pedido . "\n";
$response_message .= "Se han procesado " . $total_items . " artículos.\n";
$response_message .= "Detalles del pedido:\n";

foreach ($products_list as $product_detail) {
    $response_message .= "- " . $product_detail . "\n";
}

echo $response_message;
$conn->close();
exit;