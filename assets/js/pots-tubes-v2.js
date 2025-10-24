// ====================================
// BASE DE DONNÉES FICTIVE DES PRODUITS
// ====================================
const colorMap = {
    argent: { name: "Argent Métallisée", code: "#C0C0C0" },
    beige: { name: "Beige Naturel", code: "#F5F5DC" },
    blanc: { name: "Blanc Pur", code: "#FFFFFF" },
    bleu: { name: "Bleu Royal", code: "#0000FF" },
    cyan: { name: "Cyan Éclatant", code: "#00FFFF" },
    gris: { name: "Gris Moderne", code: "#808080" },
    jaune: { name: "Jaune Soleil", code: "#FFFF00" },
    magenta: { name: "Magenta Vibrant", code: "#FF00FF" },
    marron: { name: "Marron Terre", code: "#8B4513" },
    noir: { name: "Noir Intense", code: "#000000" },
    orange: { name: "Orange Énergique", code: "#FFA500" },
    rose: { name: "Rose Tendre", code: "#FFC0CB" },
    rouge: { name: "Rouge Passion", code: "#FF0000" },
    turquoise: { name: "Turquoise Océan", code: "#40E0D0" },
    vert: { name: "Vert Nature", code: "#008000" },
    violet: { name: "Violet Mystique", code: "#800080" }
};

const productsDatabase = [
    {
        id: 1,
        title: "Argent Métallisée",
        type: "pot",
        price: 12500,
        image: "assets/images/pots/argent.jpg",
        color: "argent",
        bestseller: true,
        detailPage: "product-detail.html?id=1"
    },
    {
        id: 2,
        title: "Beige Naturel",
        type: "pot",
        price: 8500,
        image: "assets/images/pots/beige.jpg",
        color: "beige",
        bestseller: false,
        detailPage: "product-detail.html?id=2"
    },
    {
        id: 3,
        title: "Blanc Pur",
        type: "pot",
        price: 7500,
        image: "assets/images/pots/blanc.jpg",
        color: "blanc",
        bestseller: false,
        detailPage: "product-detail.html?id=3"
    },
    {
        id: 4,
        title: "Bleu Royal",
        type: "pot",
        price: 9500,
        image: "assets/images/pots/bleu.jpg",
        color: "bleu",
        bestseller: false,
        detailPage: "product-detail.html?id=4"
    },
    {
        id: 5,
        title: "Cyan Éclatant",
        type: "pot",
        price: 10500,
        image: "assets/images/pots/cyan.jpg",
        color: "cyan",
        bestseller: true,
        detailPage: "product-detail.html?id=5"
    },
    {
        id: 6,
        title: "Gris Moderne",
        type: "pot",
        price: 8000,
        image: "assets/images/pots/gris.jpg",
        color: "gris",
        bestseller: false,
        detailPage: "product-detail.html?id=6"
    },
    {
        id: 7,
        title: "Jaune Soleil",
        type: "pot",
        price: 9000,
        image: "assets/images/pots/jaune.jpg",
        color: "jaune",
        bestseller: false,
        detailPage: "product-detail.html?id=7"
    },
    {
        id: 8,
        title: "Magenta Vibrant",
        type: "pot",
        price: 11500,
        image: "assets/images/pots/magenta.jpg",
        color: "magenta",
        bestseller: true,
        detailPage: "product-detail.html?id=8"
    },
    {
        id: 9,
        title: "Marron Terre",
        type: "pot",
        price: 8500,
        image: "assets/images/pots/marron.jpg",
        color: "marron",
        bestseller: false,
        detailPage: "product-detail.html?id=9"
    },
    {
        id: 10,
        title: "Noir Intense",
        type: "pot",
        price: 7500,
        image: "assets/images/pots/noir.jpg",
        color: "noir",
        bestseller: false,
        detailPage: "product-detail.html?id=10"
    },
    {
        id: 11,
        title: "Orange Énergique",
        type: "pot",
        price: 9500,
        image: "assets/images/pots/orange.jpg",
        color: "orange",
        bestseller: false,
        detailPage: "product-detail.html?id=11"
    },
    {
        id: 12,
        title: "Rose Tendre",
        type: "pot",
        price: 9000,
        image: "assets/images/pots/rose.jpg",
        color: "rose",
        bestseller: false,
        detailPage: "product-detail.html?id=12"
    },
    {
        id: 13,
        title: "Rouge Passion",
        type: "pot",
        price: 10000,
        image: "assets/images/pots/rouge.jpg",
        color: "rouge",
        bestseller: false,
        detailPage: "product-detail.html?id=13"
    },
    {
        id: 14,
        title: "Turquoise Océan",
        type: "pot",
        price: 11000,
        image: "assets/images/pots/turquoise.jpg",
        color: "turquoise",
        bestseller: true,
        detailPage: "product-detail.html?id=14"
    },
    {
        id: 15,
        title: "Vert Nature",
        type: "pot",
        price: 9500,
        image: "assets/images/pots/vert.jpg",
        color: "vert",
        bestseller: false,
        detailPage: "product-detail.html?id=15"
    },
    {
        id: 16,
        title: "Violet Mystique",
        type: "pot",
        price: 10500,
        image: "assets/images/pots/violet.jpg",
        color: "violet",
        bestseller: false,
        detailPage: "product-detail.html?id=16"
    },
    {
        id: 17,
        title: "Argent Métallisée",
        type: "tube",
        price: 6500,
        image: "assets/images/tubes/argent.png",
        color: "argent",
        bestseller: true,
        detailPage: "product-detail.html?id=17"
    },
    {
        id: 18,
        title: "Beige Naturel",
        type: "tube",
        price: 4500,
        image: "assets/images/tubes/beige.png",
        color: "beige",
        bestseller: false,
        detailPage: "product-detail.html?id=18"
    },
    {
        id: 19,
        title: "Blanc Pur",
        type: "tube",
        price: 3500,
        image: "assets/images/tubes/blanc.png",
        color: "blanc",
        bestseller: false,
        detailPage: "product-detail.html?id=19"
    },
    {
        id: 20,
        title: "Bleu Royal",
        type: "tube",
        price: 5500,
        image: "assets/images/tubes/bleu.png",
        color: "bleu",
        bestseller: false,
        detailPage: "product-detail.html?id=20"
    },
    {
        id: 21,
        title: "Cyan Éclatant",
        type: "tube",
        price: 6500,
        image: "assets/images/tubes/cyan.png",
        color: "cyan",
        bestseller: true,
        detailPage: "product-detail.html?id=21"
    },
    {
        id: 22,
        title: "Gris Moderne",
        type: "tube",
        price: 4000,
        image: "assets/images/tubes/gris.png",
        color: "gris",
        bestseller: false,
        detailPage: "product-detail.html?id=22"
    },
    {
        id: 23,
        title: "Jaune Soleil",
        type: "tube",
        price: 5000,
        image: "assets/images/tubes/jaune.png",
        color: "jaune",
        bestseller: false,
        detailPage: "product-detail.html?id=23"
    },
    {
        id: 24,
        title: "Magenta Vibrant",
        type: "tube",
        price: 7500,
        image: "assets/images/tubes/magenta.png",
        color: "magenta",
        bestseller: true,
        detailPage: "product-detail.html?id=24"
    },
    {
        id: 25,
        title: "Marron Terre",
        type: "tube",
        price: 4500,
        image: "assets/images/tubes/marron.png",
        color: "marron",
        bestseller: false,
        detailPage: "product-detail.html?id=25"
    },
    {
        id: 26,
        title: "Noir Intense",
        type: "tube",
        price: 3500,
        image: "assets/images/tubes/noir.png",
        color: "noir",
        bestseller: false,
        detailPage: "product-detail.html?id=26"
    },
    {
        id: 27,
        title: "Orange Énergique",
        type: "tube",
        price: 5500,
        image: "assets/images/tubes/orange.png",
        color: "orange",
        bestseller: false,
        detailPage: "product-detail.html?id=27"
    },
    {
        id: 28,
        title: "Rose Tendre",
        type: "tube",
        price: 5000,
        image: "assets/images/tubes/rose.png",
        color: "rose",
        bestseller: false,
        detailPage: "product-detail.html?id=28"
    },
    {
        id: 29,
        title: "Rouge Passion",
        type: "tube",
        price: 6000,
        image: "assets/images/tubes/rouge.png",
        color: "rouge",
        bestseller: false,
        detailPage: "product-detail.html?id=29"
    },
    {
        id: 30,
        title: "Turquoise Océan",
        type: "tube",
        price: 7000,
        image: "assets/images/tubes/turquoise.png",
        color: "turquoise",
        bestseller: true,
        detailPage: "product-detail.html?id=30"
    },
    {
        id: 31,
        title: "Vert Nature",
        type: "tube",
        price: 5500,
        image: "assets/images/tubes/vert.png",
        color: "vert",
        bestseller: false,
        detailPage: "product-detail.html?id=31"
    },
    {
        id: 32,
        title: "Violet Mystique",
        type: "tube",
        price: 6500,
        image: "assets/images/tubes/violet.png",
        color: "violet",
        bestseller: false,
        detailPage: "product-detail.html?id=32"
    }
];

// ====================================
// ÉTAT DES FILTRES
// ====================================
let filters = {
    type: [],
    color: [],
    priceMin: null,
    priceMax: null
};

// ====================================
// INITIALISATION
// ====================================
document.addEventListener('DOMContentLoaded', function() {
    renderGallery(productsDatabase);
    initializeFilters();
    initializeFilterToggle();
    initializeFilterTrigger();
});

// ====================================
// RENDU DE LA GALERIE
// ====================================
function renderGallery(products) {
    const gallery = document.getElementById('gallery');
    gallery.innerHTML = '';
    
    products.forEach(product => {
        const card = document.createElement('div');
        card.className = 'artwork-card';
        card.onclick = () => window.location.href = product.detailPage;
        
        const colorInfo = colorMap[product.color];
        
        card.innerHTML = `
            <div class="artwork-image-wrapper">
                <img src="${product.image}" alt="${product.title}">
                ${product.bestseller ? '<span class="artwork-badge">Best-seller</span>' : ''}
                <div class="artwork-overlay">
                    <div class="overlay-artist">${product.type === 'pot' ? 'Pot' : 'Tube'}</div>
                    <div class="overlay-price">${formatPrice(product.price)} FCFA</div>
                </div>
            </div>
            <div class="artwork-info">
                <h3 class="artwork-title">${product.title}</h3>
                <div class="artwork-color-info">
                    <span class="color-preview" style="background-color: ${colorInfo.code}"></span>
                    <span class="color-code">${colorInfo.code}</span>
                </div>
                <p class="artwork-type">${product.type === 'pot' ? 'Pot de peinture' : 'Tube de peinture'}</p>
            </div>
        `;
        
        gallery.appendChild(card);
    });
    
    updateResultsCount(products.length);
}

// ====================================
// SYSTÈME DE FILTRES
// ====================================
function initializeFilters() {
    // Filtres type
    document.querySelectorAll('input[name="type"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateFilter('type', this.value, this.checked);
        });
    });
    
    // Filtres couleur
    document.querySelectorAll('input[name="color"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateFilter('color', this.value, this.checked);
        });
    });
    
    // Filtre prix
    document.getElementById('priceApplyBtn').addEventListener('click', function() {
        const minValue = document.getElementById('priceMin').value;
        const maxValue = document.getElementById('priceMax').value;
        
        filters.priceMin = minValue ? parseInt(minValue) : null;
        filters.priceMax = maxValue ? parseInt(maxValue) : null;
        
        applyFilters();
    });
    
    // Réinitialiser tous les filtres
    document.getElementById('resetFiltersBtn').addEventListener('click', resetAllFilters);
}

function updateFilter(filterType, value, isChecked) {
    if (isChecked) {
        if (!filters[filterType].includes(value)) {
            filters[filterType].push(value);
        }
    } else {
        filters[filterType] = filters[filterType].filter(v => v !== value);
    }
    
    applyFilters();
}

function applyFilters() {
    let filteredProducts = productsDatabase.filter(product => {
        // Filtre type
        if (filters.type.length > 0 && !filters.type.includes(product.type)) {
            return false;
        }
        
        // Filtre couleur
        if (filters.color.length > 0 && !filters.color.includes(product.color)) {
            return false;
        }
        
        // Filtre prix
        if (filters.priceMin !== null && product.price < filters.priceMin) {
            return false;
        }
        if (filters.priceMax !== null && product.price > filters.priceMax) {
            return false;
        }
        
        return true;
    });
    
    renderGallery(filteredProducts);
    updateResetButton();
}

function resetAllFilters() {
    // Réinitialiser l'état
    filters = {
        type: [],
        color: [],
        priceMin: null,
        priceMax: null
    };
    
    // Décocher toutes les checkboxes
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        cb.checked = false;
    });
    
    // Réinitialiser les champs de prix
    document.getElementById('priceMin').value = '';
    document.getElementById('priceMax').value = '';
    
    // Réafficher toutes les œuvres
    renderGallery(productsDatabase);
    updateResetButton();
}

function updateResetButton() {
    const hasActiveFilters = 
        filters.type.length > 0 ||
        filters.color.length > 0 ||
        filters.priceMin !== null ||
        filters.priceMax !== null;
    
    const resetBtn = document.getElementById('resetFiltersBtn');
    resetBtn.style.display = hasActiveFilters ? 'flex' : 'none';
}

// ====================================
// TOGGLE DE LA BANNIÈRE DE FILTRES
// ====================================
function initializeFilterTrigger() {
    const triggerBtn = document.getElementById('filterTriggerBtn');
    const filterBanner = document.getElementById('filterBanner');
    
    triggerBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const isCollapsed = filterBanner.classList.contains('collapsed');
        
        if (isCollapsed) {
            // Ouvrir la bannière
            filterBanner.classList.remove('collapsed');
            filterBanner.classList.remove('inner-collapsed');
            triggerBtn.classList.add('active');
        } else {
            // Fermer la bannière
            filterBanner.classList.add('collapsed');
            triggerBtn.classList.remove('active');
        }
    });
}

function initializeFilterToggle() {
    const toggleBtn = document.getElementById('filterToggleBtn');
    const filterBanner = document.getElementById('filterBanner');
    
    if (!toggleBtn) {
        console.error('Bouton toggle non trouvé');
        return;
    }
    
    toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        filterBanner.classList.toggle('inner-collapsed');
        
        const isCollapsed = filterBanner.classList.contains('inner-collapsed');
        const textSpan = toggleBtn.querySelector('span');
        if (textSpan) {
            textSpan.textContent = isCollapsed ? 'AFFICHER LES FILTRES' : 'RÉDUIRE LES FILTRES';
        }
    });
}

// ====================================
// UTILITAIRES
// ====================================
function formatPrice(price) {
    return price.toLocaleString('fr-FR').replace(/\s/g, ' ');
}

function updateResultsCount(count) {
    const resultsCount = document.getElementById('resultsCount');
    resultsCount.textContent = `(${count} produit${count > 1 ? 's' : ''})`;
}

// ====================================
// GESTION DU PANIER (Simplifié)
// ====================================
function updateCartCount() {
    // Simulation - à adapter selon votre système
    document.querySelector('.cart-count').textContent = '0';
}

updateCartCount();