// La clave que usaremos para guardar el conteo en el almacenamiento local
    const STORAGE_KEY = 'cartCount';

    // 1. Obtener los elementos del DOM
    const cartCountElement = document.querySelector('.cart-count');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // 2. Función para OBTENER el conteo desde localStorage (o 0 si no existe)
    function getCartCountFromStorage() {
        const storedCount = localStorage.getItem(STORAGE_KEY);
        // Si hay un valor guardado, lo convierte a número; si no, devuelve 0.
        return storedCount ? parseInt(storedCount) : 0;
    }

    // 3. Inicializar el contador con el valor guardado
    let cartCount = getCartCountFromStorage();

    // 4. Actualizar el display del carrito inmediatamente al cargar la página
    cartCountElement.textContent = cartCount;

    // 5. Función para incrementar el contador y GUARDAR el nuevo valor
    function incrementCartCount() {
        // Aumentar el contador en 1
        cartCount++;
        
        // **GUARDAR** el nuevo valor en el almacenamiento local
        localStorage.setItem(STORAGE_KEY, cartCount);
        
        // Actualizar el texto del elemento en el HTML (el número que ve el usuario)
        cartCountElement.textContent = cartCount;
        
        console.log(`Producto añadido. Total persistente en carrito: ${cartCount}`);
    }

    // 6. Asignar el evento click a cada botón de "Añadir al carrito"
    addToCartButtons.forEach(button => {
        button.addEventListener('click', incrementCartCount);
    });

    // OPCIONAL: Función para reiniciar el carrito (útil para pruebas o al finalizar una compra)
    function resetCart() {
        localStorage.removeItem(STORAGE_KEY); // Elimina la clave del almacenamiento
        cartCount = 0; // Reinicia la variable
        cartCountElement.textContent = 0; // Actualiza el display
        console.log("Carrito reseteado.");
    }
    // Puedes llamar a resetCart() en algún otro botón si lo deseas.
    // window.onload = resetCart; // Esto lo reiniciaría en cada carga, ¡no lo hagas!