// Mapeo de categorías a IDs de productos
const categoryProductMap = {
    'productos1': [7, 8, 9, 10, 11, 12],        // Electrónica
    'productos2': [1, 2, 3, 4, 5, 6],           // Informática
    'productos3': [13, 14, 15, 16, 17, 18],     // Hogar y Cocina
    'productos4': [19, 20, 21, 22, 23, 24],     // Libros
    'productos5': [25, 26, 27, 28, 29, 30],     // Juguetes y Juegos
    'productos6': [31, 32, 33, 34, 35, 36]      // Deportes
};

// Obtener la categoría actual
function getCurrentCategory() {
    const currentPage = window.location.pathname.split('/').pop().replace('.html', '').replace('.php', '');
    return currentPage;
}

// Obtener los productos de la categoría actual
function getCurrentCategoryProducts() {
    const category = getCurrentCategory();
    const productIds = categoryProductMap[category] || [];
    
    const products = [];
    productIds.forEach(id => {
        if (productData[id]) {
            products.push({
                id: id,
                ...productData[id]
            });
        }
    });
    // Si es la página principal (Guterake), intentar obtener productos desde el DOM
    const currentPage = getCurrentCategory();
    if ((products.length === 0) && (currentPage.toLowerCase() === 'guterake' || currentPage === '' || currentPage.toLowerCase() === 'index')) {
        const domIds = getProductIdsFromDOM();
        domIds.forEach(id => {
            if (productData[id]) products.push({ id: id, ...productData[id] });
        });
    }
    return products;
}

// Obtener el rango de precios de la categoría actual
function getCategoryPriceRange() {
    const products = getCurrentCategoryProducts();
    if (products.length > 0) {
        const prices = products.map(p => parseFloat(p.price));
        const min = Math.floor(Math.min(...prices));
        const max = Math.ceil(Math.max(...prices));
        return { min, max };
    }

    // Si no hay productos desde productData, y estamos en la página principal, intentar rango desde DOM
    const currentPage = getCurrentCategory();
    if (currentPage.toLowerCase() === 'guterake' || currentPage === '' || currentPage.toLowerCase() === 'index') {
        const domRange = getPriceRangeFromDOM();
        if (domRange) return domRange;
    }

    // Fallback: usar todo productData si existe
    if (typeof productData === 'object') {
        const allPrices = Object.values(productData).map(p => parseFloat(p.price)).filter(p => !isNaN(p));
        if (allPrices.length > 0) {
            return { min: Math.floor(Math.min(...allPrices)), max: Math.ceil(Math.max(...allPrices)) };
        }
    }

    return { min: 0, max: 1000 };
}

// Helpers: leer IDs y precios desde el DOM sin modificar el DOM
function getProductIdsFromDOM() {
    const ids = new Set();
    document.querySelectorAll('.products-container .product-card .add-to-cart').forEach(btn => {
        const v = btn.getAttribute('data-product-id');
        const id = v ? parseInt(v) : NaN;
        if (!isNaN(id)) ids.add(id);
    });
    document.querySelectorAll('.products-container .product-card').forEach(card => {
        const v = card.getAttribute('data-product-id');
        const id = v ? parseInt(v) : NaN;
        if (!isNaN(id)) ids.add(id);
    });
    return Array.from(ids);
}

function getPriceRangeFromDOM() {
    const prices = [];
    document.querySelectorAll('.products-container .product-card .product-price').forEach(pe => {
        const text = (pe.textContent || '').trim();
        const cleaned = text.replace(/[^0-9.,]/g, '').replace(/,/g, '.');
        const num = parseFloat(cleaned);
        if (!isNaN(num)) prices.push(num);
    });
    if (prices.length === 0) return null;
    return { min: Math.floor(Math.min(...prices)), max: Math.ceil(Math.max(...prices)) };
}

// Inicializar el filtro de precio
document.addEventListener('DOMContentLoaded', () => {
    initPriceFilter();
});

function initPriceFilter() {
    // Buscar el contenedor de filtros de múltiples formas para garantizar compatibilidad
    let filterContainer = document.querySelector('.sidebar > div[style*="margin-top"]');
    
    // Si no se encuentra, crear uno
    if (!filterContainer) {
        // Buscar la sección de filtros por el h3
        const filterHeader = Array.from(document.querySelectorAll('.sidebar h3')).find(h => h.textContent.includes('Filtros'));
        if (filterHeader && filterHeader.nextElementSibling) {
            filterContainer = filterHeader.nextElementSibling;
        }
    }
    
    if (!filterContainer) return;

    const priceRange = getCategoryPriceRange();
    
    // Crear el HTML del filtro de precio
    const filterHTML = `
        <div class="price-filter">
            <label for="price-range" style="display: block; margin-bottom: 10px; font-weight: bold;">Rango de Precio</label>
            <div class="price-range-container">
                <input type="range" id="price-min" class="price-slider" min="${priceRange.min}" max="${priceRange.max}" value="${priceRange.min}" step="1">
                <input type="range" id="price-max" class="price-slider" min="${priceRange.min}" max="${priceRange.max}" value="${priceRange.max}" step="1">
            </div>
            <div class="price-display">
                <span class="price-min-display">$${priceRange.min.toFixed(2)}</span>
                <span class="price-separator">-</span>
                <span class="price-max-display">$${priceRange.max.toFixed(2)}</span>
            </div>
            <button class="price-reset-btn" style="margin-top: 10px; width: 100%; padding: 8px; background-color: #ff9900; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Limpiar Filtro</button>
        </div>
    `;
    
    filterContainer.innerHTML = filterHTML;
    
    // Agregar event listeners
    const priceMinSlider = document.getElementById('price-min');
    const priceMaxSlider = document.getElementById('price-max');
    const resetBtn = document.querySelector('.price-reset-btn');
    
    priceMinSlider.addEventListener('input', updatePriceFilter);
    priceMaxSlider.addEventListener('input', updatePriceFilter);
    resetBtn.addEventListener('click', resetPriceFilter);
    
    // Asegurar que el valor mín no sea mayor al máx
    priceMinSlider.addEventListener('input', () => {
        if (parseFloat(priceMinSlider.value) > parseFloat(priceMaxSlider.value)) {
            priceMinSlider.value = priceMaxSlider.value;
        }
    });
    
    priceMaxSlider.addEventListener('input', () => {
        if (parseFloat(priceMaxSlider.value) < parseFloat(priceMinSlider.value)) {
            priceMaxSlider.value = priceMinSlider.value;
        }
    });
}

function updatePriceFilter() {
    const priceMin = parseFloat(document.getElementById('price-min').value);
    const priceMax = parseFloat(document.getElementById('price-max').value);
    
    // Actualizar los textos de los precios
    document.querySelector('.price-min-display').textContent = `$${priceMin.toFixed(2)}`;
    document.querySelector('.price-max-display').textContent = `$${priceMax.toFixed(2)}`;
    
    // Obtener los productos de la categoría
    const productCards = document.querySelectorAll('.products-container .product-card');
    
    productCards.forEach(card => {
        const priceText = card.querySelector('.product-price').textContent;
        // Limpiar el texto: remover $ y espacios, luego convertir a número
        const price = parseFloat(priceText.replace('$', '').trim());
        
        // Mostrar u ocultar según el rango
        if (price >= priceMin && price <= priceMax) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

function resetPriceFilter() {
    const priceRange = getCategoryPriceRange();
    const priceMinSlider = document.getElementById('price-min');
    const priceMaxSlider = document.getElementById('price-max');
    
    priceMinSlider.value = priceRange.min;
    priceMaxSlider.value = priceRange.max;
    
    // Actualizar display
    document.querySelector('.price-min-display').textContent = `$${priceRange.min.toFixed(2)}`;
    document.querySelector('.price-max-display').textContent = `$${priceRange.max.toFixed(2)}`;
    
    // Mostrar todos los productos
    const productCards = document.querySelectorAll('.products-container .product-card');
    productCards.forEach(card => {
        card.style.display = '';
    });
}
