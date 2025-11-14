// La clave que usaremos para guardar el array de IDs en el almacenamiento local
const STORAGE_KEY = 'cartItems'; 

// **Datos de los productos (debe coincidir con los IDs de Guterake.php y tu DB)**
const productData = {
    "1": { name: "Computadora Gaming Pro", price: 899.99, image: "https://m.media-amazon.com/images/I/81JlCSDZ3AL._AC_SL1500_.jpg" },
    "2": { name: "Laptop Ultraligera", price: 749.99, image: "https://m.media-amazon.com/images/I/811QpiYXe-L.jpg" },
    "3": { name: "Tablet Multiusos", price: 399.99, image: "https://i.blogs.es/b9e28b/samsung-galaxy-tab-s9-ultra/450_1000.jpeg" },
    "4": { name: "Monitor Curvo 32\"", price: 429.99, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2z-aU2zBYvMAKOdJ2E1DPGYRfZ2X4ncP8Tw&s" },
    "5": { name: "Teclado Mecánico RGB", price: 89.99, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2z-aU2zBYvMAKOdJ2E1DPGYRfZ2X4ncP8Tw&s" },
    "6": { name: "Ratón Inalámbrico", price: 49.99, image: "https://www.cdmarket.com.ar/image/0/600_750-380621_2.jpg" },
    "7": { name: "Arduino UNO", price: 12299.0, image :"https://http2.mlstatic.com/D_NQ_NP_2X_700019-MLA43774141940_102020-F.webp"},
    "8": { name: "Protoboard", price: 4700.00, image: "https://acdn-us.mitiendanube.com/stores/975/836/products/343401-mla20324226619_062015-o-084c6ca10b68a6830615565089237035-640-0.jpg" },
    "9": { name: "Cables Para Macho Hembra 20cm Protoboard 40 Unidades", price: 3099.00, image: "https://http2.mlstatic.com/D_NQ_NP_2X_932756-MLA49547535658_042022-F.webp" },
    "10": { name: "Sensor Distancia Ultrasonido Ultrasonico Sr04 Hc Arduino", price: 4099.00, image: "https://www.electronicamendoza.com.ar/content/images/thumbs/606b3a7b0fa6c30001740f83_sensor-ultrasonico_600.jpeg" },
    "11": { name: "Modulo Detector Sensor De Obstaculos Infrarrojo Pic Arduino", price: 3344.00, image: "https://http2.mlstatic.com/D_NQ_NP_2X_933341-MLA52961108416_122022-F.webp" },
    "12": { name: "Kit 600 Resistencias 1/4 1% 30 Valores Diversos", price: 13410.00, image: "https://http2.mlstatic.com/D_NQ_NP_2X_956308-MLA41027229144_032020-F.webp" },
    "13": { name: "Cocina Pro", price: 55999.00, image: "https://www.giudice.com.ar/recursos/productos/51869.jpg" },
    "14": { name: "Bacha de cocina", price: 28450.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjyyqPiswRwtFjXYrh4CseX37MMq-L76otcw&s" },
    "15": { name: "Licuadora", price: 11890.00, image: "https://diegohogar.com.ar/wp-content/uploads/2024/12/4643.1-1.png" },
    "16": { name: "Horno", price: 37150.00, image: "https://ruizmoreno.com.ar/web-experto/representations/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBaDhKIiwiZXhwIjpudWxsLCJwdXIiOiJibG9iX2lkIn19--5624747740a7ead9220299514cde3ecff8ff53cb/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHdDRG9MY21WemFYcGxTU0lOTmpBd2VEWXdNRDRHT2daRlZEb01ZMjl1ZG1WeWREb0pkMlZpY0RvTWNYVmhiR2wwZVdrMyIsImV4cCI6bnVsbCwicHVyIjoidmFyaWF0aW9uIn19--cacb882242e1e3b094895554dc819a16bfacb8f6/23%20(61).png" },
    "17": { name: "Microondas", price: 21399.00, image: "https://saturnohogar.vtexassets.com/arquivos/ids/160036-800-800?v=638754007470400000&width=800&height=800&aspect=true" },
    "18": { name: "Set de Cubiertos", price: 9250.00, image: "https://volfar.vtexassets.com/arquivos/ids/445119-800-auto?v=638192368687100000&width=800&height=auto&aspect=true" },
    "19": { name: "Odisea", price: 3599.00, image: "https://cdn.zendalibros.com/wp-content/uploads/odisea-homero.jpg" },
    "20": { name: "El Principito", price: 2100.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwnK5d0o6hQnZZhI3e7scbSbXnB2OYH49o0A&s" },
    "21": { name: "Alicia en el País de las Maravillas", price: 3850.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkWN7Cwz2Cq3pl39-bgNap_tM_E0uCgmCoLQ&s" },
    "22": { name: "Harry Potter Saga Completa", price: 25990.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTV8LDVYqRup1JgrU9K0dEpsuTkvYDV0ukR-w&s" },
    "23": { name: "IT", price: 4999.00, image: "https://www.librosmackay.cl/wp-content/uploads/2020/05/IT.jpg" },
    "24": { name: "La Caída de Berlín", price: 5200.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRi5j9gxCK_DAd9YWeTVVZerWBiRzXOJgrpYA&s" },
    "25": { name: "Nintendo Switch", price: 359990.00, image: "https://laferiadelniño.com/wp-content/uploads/2024/10/28-09-24-21-300x300.jpg" },
    "26": { name: "Xbox Series X", price: 410500.00, image: "https://spacegamer.com.ar/img/Public/1058-producto-seriesx-8229.jpg" },
    "27": { name: "Playstation 5", price: 399990.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdCAvlff4mwodNgut1QEEjSjVz2xtg7wqnRA&s" },
    "28": { name: "Juguete Muñeco Spiderman", price: 12500.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6FyxwzBaAWggBhjnXe92cvt85ZUuLLVoPVw&s" },
    "29": { name: "Muñeco de Sonic", price: 8990.00, image: "https://http2.mlstatic.com/D_NQ_NP_606804-MLA51636229149_092022-O.webp" },
    "30": { name: "VideoJuego Atari", price: 22990.00, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4x72bQQE4i9R3MpuONynVx5gSdBEvyenxAA&s" },
    "31": { name: "Balón Primera división", price: 899.99, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_p6XlnHA7oI6UdHEqOEisRM8Ch_JhxRxaDg&s" },
    "32": { name: "Balón de Basket", price: 749.99, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQf-90OiRXL85ChUasPi9J29oSHeBt7lIXRfg&s" },
    "33": { name: "Balón de Voley", price: 399.99, image: "https://ferreira.vtexassets.com/arquivos/ids/514486/stk_4015_1.jpg?v=638844663217530000" },
    "34": { name: "Pelota de beisbol", price: 429.99, image: "https://i.pinimg.com/736x/30/65/e3/3065e3e5df582c95ce623b769629cae3.jpg" },
    "35": { name: "Raqueta de Tennis", price: 89.99, image: "https://acdn-us.mitiendanube.com/stores/001/338/510/products/101552100-pd-gen11-u-1-68f7e9f5faface80c317422258931546-640-0.webp" },
    "36": { name: "Camiseta Selección Argentina", price: 49.99, image: "https://afaar.vtexassets.com/arquivos/ids/156638/IP8400_FC_eCom.jpg?v=638459540536700000" }
};

// 1. Obtener los elementos del DOM
const cartCountElement = document.querySelector('.cart-count');
const addToCartButtons = document.querySelectorAll('.add-to-cart');

// 2. Función para OBTENER el array de IDs desde localStorage
function getCartItemsFromStorage() {
    const storedItems = localStorage.getItem(STORAGE_KEY);
    try {
        return storedItems ? JSON.parse(storedItems) : [];
    } catch (e) {
        console.error("Error al parsear el carrito desde localStorage:", e);
        return [];
    }
}
function processOrder() {
    const confirmation = confirm("¿Estás seguro de que quieres realizar el pedido? Una vez confirmado, tu carrito se vaciará.");
    
    if (confirmation) {
        // Llama al script PHP que procesará y vaciará el carrito
        fetch('processOrder.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            // Aquí podrías enviar datos adicionales si fuera necesario, como un ID de usuario.
            // Por ahora, solo enviamos una señal.
            body: 'action=complete'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en el servidor al procesar el pedido.');
            }
            return response.text();
        })
        .then(data => {
            console.log('Respuesta del servidor:', data);
            alert(data); // Muestra el mensaje de éxito del servidor.

            // 1. Vaciar el carrito visualmente y del localStorage
            cartItems = [];
            localStorage.setItem(STORAGE_KEY, JSON.stringify(cartItems));
            
            // 2. Refrescar la vista de pedidos para que no aparezcan más productos
            renderCart(); 

            // 3. Actualizar el contador del carrito
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = 0;
            }
            
        })
        .catch(error => {
            console.error('Error al realizar el pedido:', error);
            alert('Hubo un error al realizar el pedido. Intenta de nuevo.');
        });
    }
}

// **AÑADIR EVENT LISTENER**
// Asegúrate de que esta línea se ejecute cuando el DOM esté cargado y el botón exista (en order.php)
document.addEventListener('DOMContentLoaded', () => {
    const orderButton = document.getElementById('realizar-pedido-btn');
    if (orderButton) {
        orderButton.addEventListener('click', processOrder);
    }});
// 3. Inicializar el array del carrito
let cartItems = getCartItemsFromStorage();

// 4. Actualizar el display del carrito inmediatamente al cargar la página
if (cartCountElement) {
    cartCountElement.textContent = cartItems.length;
}

// 5. Función para añadir el ID del producto
function addToCart(event) {
    // Obtenemos el ID del producto que se está añadiendo
    const productId = event.currentTarget.getAttribute('data-product-id');

    // 1. Lógica para el Local Storage (Mantener el carrito local)
    cartItems.push(productId);
    localStorage.setItem(STORAGE_KEY, JSON.stringify(cartItems));

    // 2. Notificar al contador
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cartItems.length;
    }

    // 3. 🚀 NUEVA LÓGICA: Agregar a la Base de Datos mediante fetch
    fetch('../addToCart.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        // Enviamos el ID del producto y la cantidad (que es 1)
        body: `product_id=${productId}&quantity=1`
    })
    .then(response => {
        if (!response.ok) {
            // Manejar errores de servidor (404, 500)
            return response.text().then(text => { throw new Error(text) });
        }
        return response.text();
    })
    .then(data => {
        // Muestra el mensaje de éxito del servidor PHP en la consola
        console.log("Respuesta de la BD:", data); 
    })
    .catch(error => {
        // Muestra un error si la base de datos falla
        console.error('Error al agregar producto a la BD:', error);
        // Puedes cambiar esto a un mensaje menos molesto si lo deseas
        alert('Advertencia: El producto se agregó localmente, pero hubo un error al guardarlo en la base de datos.');
    });
}

// 6. Asignar el evento click a cada botón de "Añadir al carrito"
addToCartButtons.forEach(button => {
    button.addEventListener('click', addToCart);
});

// OPCIONAL: Función para reiniciar el carrito (manteniendo la petición original)
function resetCart() {
    localStorage.removeItem(STORAGE_KEY); 
    cartItems = []; 
    if (cartCountElement) {
        cartCountElement.textContent = 0; 
    }
    console.log("Carrito reseteado.");
}

/* --------------------------------------------------
   LÓGICA PARA LA PÁGINA DE PEDIDOS (order.php)
   -------------------------------------------------- */

// Función para agrupar IDs y calcular la cantidad de cada producto
function getCartSummary(items) {
    const summary = {};
    items.forEach(id => {
        // Contar la cantidad de cada ID
        summary[id] = (summary[id] || 0) + 1;
    });

    const detailedSummary = [];
    for (const id in summary) {
        const productInfo = productData[id];
        if (productInfo) {
            const quantity = summary[id];
            const subtotal = productInfo.price * quantity;
            detailedSummary.push({
                id: id,
                name: productInfo.name,
                price: productInfo.price,
                image: productInfo.image,
                quantity: quantity,
                subtotal: subtotal.toFixed(2)
            });
        }
    }
    return detailedSummary;
}

// Función principal para renderizar el carrito
function renderCart() {
    const orderList = document.getElementById('orderList');
    const cartTotalElement = document.getElementById('cartTotal');
    
    // Si no encuentra los elementos (estamos en Guterake.php), simplemente termina.
    if (!orderList || !cartTotalElement) return; 

    const summary = getCartSummary(cartItems);
    let grandTotal = 0;
    orderList.innerHTML = ''; // Limpiar el carrito existente
    
    if (summary.length === 0) {
        orderList.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 20px;">Tu carrito está vacío.</td></tr>';
        cartTotalElement.textContent = `$0.00`;
        return;
    }

    summary.forEach(item => {
        grandTotal += parseFloat(item.subtotal);
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;"></td>
            <td>${item.name}</td>
            <td>$${item.price.toFixed(2)}</td>
            <td>
                <input type="number" value="${item.quantity}" min="1" data-product-id="${item.id}" class="item-quantity" style="width: 60px;">
            </td>
            <td>$${item.subtotal}</td>
            <td><button class="remove-item" data-product-id="${item.id}">Eliminar</button></td>
        `;
        orderList.appendChild(row);
    });

    // Actualizar el total
    cartTotalElement.textContent = `$${grandTotal.toFixed(2)}`;

    // Añadir listeners para eliminar y cambiar cantidad
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', removeItem);
    });
    document.querySelectorAll('.item-quantity').forEach(input => {
        input.addEventListener('change', updateQuantity);
    });
}

// Función para eliminar un producto (elimina TODAS las instancias de ese ID)
// Función para eliminar un producto (elimina TODAS las instancias de ese ID)
function removeItem(event) {
    const productIdToRemove = event.currentTarget.getAttribute('data-product-id');
    
    // 1. Eliminar del Local Storage (Lógica existente)
    cartItems = cartItems.filter(id => id !== productIdToRemove);
    localStorage.setItem(STORAGE_KEY, JSON.stringify(cartItems));
    
    // 2. 🚀 NUEVA LÓGICA: Eliminar de la Base de Datos
    fetch('deleteFromCart.php', { // <--- Llama al nuevo archivo PHP
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        // Enviamos el ID del producto a eliminar
        body: `product_id=${productIdToRemove}`
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.text();
    })
    .then(data => {
        // Muestra el mensaje de éxito en consola
        console.log("Producto eliminado de la BD:", data); 
    })
    .catch(error => {
        console.error('Error al eliminar producto de la BD:', error);
        alert('Advertencia: El producto se eliminó localmente, pero hubo un error al borrarlo de la base de datos.');
    });


    // 3. Volver a renderizar y actualizar el contador (Lógica existente)
    renderCart();
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cartItems.length;
    }
}

// Función para actualizar la cantidad de un producto
function updateQuantity(event) {
    const productId = event.currentTarget.getAttribute('data-product-id');
    const newQuantity = parseInt(event.currentTarget.value);

    if (newQuantity <= 0) {
        removeItem({ currentTarget: { getAttribute: () => productId } });
        return;
    }

    const filteredItems = cartItems.filter(id => id !== productId);

    for (let i = 0; i < newQuantity; i++) {
        filteredItems.push(productId);
    }

    cartItems = filteredItems;
    localStorage.setItem(STORAGE_KEY, JSON.stringify(cartItems));
    
    renderCart();
    if (cartCountElement) {
        cartCountElement.textContent = cartItems.length;
    }
}


// Ejecutar la función de renderizado cuando la página de pedidos cargue
// El DOMContentLoaded asegura que todos los elementos existan antes de llamar a renderCart.
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('orderList')) {
        renderCart();
    }
});