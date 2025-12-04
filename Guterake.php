<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samazon - Tu tienda online de confianza</title>
    <link rel="shortcut icon" href="https://steamcdn-a.akamaihd.net/apps/tf2/blog/images/favicon.ico">
    <link rel="stylesheet" href="Guterake.css">
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

    <div class="main-container">
        <aside class="sidebar">
            <h3>Categorías</h3>
            <ul class="category-list">                
                <li><a href="../dise-inho/categorias/productos1.html">Electrónica</a></li>
                <li><a href="../dise-inho/categorias/productos2.html">Informática</a></li>
                <li><a href="../dise-inho/categorias/productos3.html">Hogar y Cocina</a></li>
                <li><a href="../dise-inho/categorias/productos4.html">Libros</a></li>
                <li><a href="../dise-inho/categorias/productos5.html">Juguetes y Juegos</a></li>
                <li><a href="../dise-inho/categorias/productos6.html">Deportes</a></li>
            </ul>
            
            <h3 style="margin-top: 20px;">Filtros</h3>
            <div style="margin-top: 10px;">
               </div>
        </aside>

        <main class="products-container">
            <div class="product-card">
                <img src="https://m.media-amazon.com/images/I/81JlCSDZ3AL._AC_SL1500_.jpg" alt="Computadora de escritorio" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Computadora Gaming Pro</h3>
                    <p class="product-description">PC de alto rendimiento con procesador Intel i7, 16GB RAM, SSD 1TB y tarjeta gráfica RTX 3060.</p>
                    <div class="product-price">$899.99</div>
                    <button class="add-to-cart" data-product-id="1">Añadir al carrito</button>
                </div>
            </div>

            <div class="product-card">
                <img src="https://m.media-amazon.com/images/I/811QpiYXe-L.jpg" alt="Laptop" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Laptop Ultraligera</h3>
                    <p class="product-description">Portátil de 14 pulgadas, peso inferior a 1kg, batería de 12 horas y pantalla táctil Full HD.</p>
                    <div class="product-price">$749.99</div>
                    <button class="add-to-cart" data-product-id="2">Añadir al carrito</button>
                </div>
            </div>

            <div class="product-card">
                <img src="https://i.blogs.es/b9e28b/samsung-galaxy-tab-s9-ultra/450_1000.jpeg" alt="Tablet" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Tablet Multiusos</h3>
                    <p class="product-description">Tablet de 10 pulgadas con stylus incluido, ideal para trabajo creativo y entretenimiento.</p>
                    <div class="product-price">$399.99</div>
                    <button class="add-to-cart" data-product-id="3">Añadir al carrito</button>
                </div>
            </div>

            <div class="product-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2z-aU2zBYvMAKOdJ2E1DPGYRfZ2X4ncP8Tw&s" alt="Monitor" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Monitor Curvo 32"</h3>
                    <p class="product-description">Pantalla curva con resolución 4K, tasa de refresco 144Hz y tecnología FreeSync.</p>
                    <div class="product-price">$429.99</div>
                    <button class="add-to-cart" data-product-id="4">Añadir al carrito</button>
                </div>
            </div>

            <div class="product-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2z-aU2zBYvMAKOdJ2E1DPGYRfZ2X4ncP8Tw&s" alt="Teclado" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Teclado Mecánico RGB</h3>
                    <p class="product-description">Teclado gaming con switches mecánicos, iluminación RGB personalizable y reposamuñecas.</p>
                    <div class="product-price">$89.99</div>
                    <button class="add-to-cart" data-product-id="5">Añadir al carrito</button>
                </div>
            </div>

            <div class="product-card">
                <img src="https://www.cdmarket.com.ar/image/0/600_750-380621_2.jpg" alt="Ratón" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Ratón Inalámbrico</h3>
                    <p class="product-description">Ratón ergonómico con sensor de alta precisión, batería de larga duración y diseño ambidiestro.</p>
                    <div class="product-price">$49.99</div>
                    <button class="add-to-cart" data-product-id="6">Añadir al carrito</button>
                </div>
            </div>
        </main>
    </div>
    <script src="Guterake.js"></script>
    <script src="priceFilter.js"></script>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>Conócenos</h4>
                <ul>
                    <li><a href="#">Trabajar en Samazon</a></li>
                    <li><a href="#">Información corporativa</a></li>
                    <li><a href="#">Departamento de prensa</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Gana dinero con nosotros</h4>
                <ul>
                    <li><a href="#">Vender en Samazon</a></li>
                    <li><a href="#">Vender en Samazon Business</a></li>
                    <li><a href="#">Programa de afiliados</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Métodos de pago</h4>
                <ul>
                    <li><a href="#">Tarjetas de crédito</a></li>
                    <li><a href="#">Tarjetas de débito</a></li>
                    <li><a href="#">Pago en efectivo</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>¿Necesitas ayuda?</h4>
                <ul>
                    <li><a href="#">Samazon y COVID-19</a></li>
                    <li><a href="#">Cuenta y login</a></li>
                    <li><a href="#">Centro de ayuda</a></li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>© 2023 Samazon Corporation, todos los derechos reservados. Samazon, el logotipo de Samazon, Joeshop y el logotipo de Joeshop son marcas comerciales y/o marcas comerciales registradas de Samazon Corporation.</p>
        </div>
    </footer>
</body>
</html>