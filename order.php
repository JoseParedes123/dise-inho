<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samazon - Tu tienda online de confianza</title>
    <link rel="shortcut icon" href="https://steamcdn-a.akamaihd.net/apps/tf2/blog/images/favicon.ico">
    <link rel="stylesheet" href="Order.css">
    <script src="order.js" defer></script>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="Guterake.php" class="logo-link">
                <img src="samazon_logo.png" alt="Samazon Logo" class="logo">
            </a>
            
            <div class="search-bar">
                <input type="text" placeholder="Buscar productos...">
                <button>🔍</button>
            </div>
            
            <div class="nav-links">
                <a href="cuentas.php" class="nav-link">Cuenta</a>
                <a href="order.php" class="cart-icon">
                    🛒 Pedidos
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </header>

    <main class="order-container">
        <h2>Mi Carrito</h2>
        <div class="table-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="orderList">
                    <!-- Los productos se cargarán aquí dinámicamente -->
                </tbody>
            </table>
        </div>
        <div class="cart-summary">
            <div class="cart-total">
                <span>Total:</span>
                <span id="cartTotal">$0.00</span>
            </div>
            <button id="checkoutButton" class="checkout-button">Realizar Pedido</button>
        </div>
    </main>

    <script src="order.js"></script>