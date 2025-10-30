// ====================================
// BASE DE DONNÉES DES DESSINS DE PORTRAIT
// ====================================
const artworksDatabase = [
    {
        id: 1,
        title: "Portrait enfant",
        artist: "John Matos Crash",
        price: 20000,
        dimensions: "30 × 40 cm",
        image: "assets/images/dessin_portrait/enfant_01.jpeg",
        size: "petit",
        style: "couleur",
        colors: ["marron", "beige"],
        bestseller: true
    },
    {
        id: 2,
        title: "Enfant nature",
        artist: "Barbara Kroll",
        price: 4000,
        dimensions: "64 × 49 cm",
        image: "assets/images/dessin_portrait/femme_01.jpeg",
        size: "grand",
        style: "couleur",
        colors: ["marron", "beige", "vert"]
    },
    {
        id: 3,
        title: "Œil",
        artist: "Reinaldo Chavez",
        price: 12500,
        dimensions: "16 × 11 cm",
        image: "assets/images/dessin_portrait/femme1_oeil.jpeg",
        size: "petit",
        style: "realiste",
        colors: ["noir", "blanc", "gris"]
    },
    {
        id: 4,
        title: "Portrait femme",
        artist: "Kirill Postovit",
        price: 7000,
        dimensions: "50 × 71 cm",
        image: "assets/images/dessin_portrait/femme2.jpeg",
        size: "grand",
        style: "realiste",
        colors: ["noir", "blanc"]
    },
    {
        id: 5,
        title: "Portrait admiratif",
        artist: "Frédéric Bruly Bouabré",
        price: 8000,
        dimensions: "15 × 11 cm",
        image: "assets/images/dessin_portrait/femme3.jpeg",
        size: "petit",
        style: "couleur",
        colors: ["marron", "beige", "rouge"]
    },
    {
        id: 6,
        title: "Le photographe",
        artist: "Gabrielle Rul",
        price: 15000,
        dimensions: "21 × 29 cm",
        image: "assets/images/dessin_portrait/femme4.jpeg",
        size: "petit",
        style: "realiste",
        colors: ["noir", "blanc", "gris"]
    },
    {
        id: 7,
        title: "Lèvres",
        artist: "Marie Dubois",
        price: 10000,
        dimensions: "30 × 40 cm",
        image: "assets/images/dessin_portrait/femme4_levre.jpeg",
        size: "moyen",
        style: "realiste",
        colors: ["rose", "rouge", "blanc"]
    },
    {
        id: 8,
        title: "Visage abstrait",
        artist: "Sophie Martin",
        price: 12000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/femme5_afrique.jpeg",
        size: "moyen",
        style: "abstrait",
        colors: ["noir", "blanc", "marron"]
    },
    {
        id: 9,
        title: "Lèvre milieu",
        artist: "Sophie Martin",
        price: 10000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/femme5_levre.jpeg",
        size: "moyen",
        style: "realiste",
        colors: ["rose", "rouge", "blanc"]
    },
    {
        id: 10,
        title: "Visage persuasif",
        artist: "Sophie Martin",
        price: 5000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/femme6.jpeg",
        size: "moyen",
        style: "couleur",
        colors: ["bleu", "rouge", "jaune"]
    },
    {
        id: 11,
        title: "Femme tatouée",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/femme_tatoue1.jpeg",
        size: "moyen",
        style: "couleur",
        colors: ["bleu", "noir", "vert"]
    },
    {
        id: 12,
        title: "Masque",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/masque.jpeg",
        size: "moyen",
        style: "couleur",
        colors: ["marron", "beige", "rouge"]
    },
    {
        id: 13,
        title: "Portrait d'histoire",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_enfant1.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc", "gris"]
    },
    {
        id: 14,
        title: "Kids",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_enfant2.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc"]
    },
    {
        id: 15,
        title: "Femme NB",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_femme1.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc", "gris"]
    },
    {
        id: 16,
        title: "Dessin de face",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_femme2.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc"]
    },
    {
        id: 17,
        title: "Portrait homme",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_homme1.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc", "gris"]
    },
    {
        id: 18,
        title: "Homme NB",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_homme2.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc"]
    },
    {
        id: 19,
        title: "Dessin Bob Marley",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_homme3.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc", "gris"]
    },
    {
        id: 20,
        title: "Dessin abstrait",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_homme4.jpeg",
        size: "moyen",
        style: "abstrait",
        colors: ["noir", "blanc"]
    },
    {
        id: 21,
        title: "Figure africaine",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/nb_homme5.jpeg",
        size: "moyen",
        style: "noir-blanc",
        colors: ["noir", "blanc", "gris"]
    },
    {
        id: 22,
        title: "Figure africaine",
        artist: "Sophie Martin",
        price: 9000,
        dimensions: "42 × 30 cm",
        image: "assets/images/dessin_portrait/femme_04.jpeg",
        size: "moyen",
        style: "couleur",
        colors: ["orange", "marron", "beige"]
    }
];

// ====================================
// ÉTAT DES FILTRES
// ====================================
let filters = {
    size: [],
    style: [],
    color: [],
    priceMin: null,
    priceMax: null
};

// Sauvegarder la galerie originale pour le rendu
let originalGallery = null;

// ====================================
// INITIALISATION
// ====================================
document.addEventListener('DOMContentLoaded', function() {
    // Sauvegarder la galerie HTML originale
    const gallery = document.querySelector('.gallery');
    if (gallery) {
        originalGallery = gallery.cloneNode(true);
    }
    
    initializeFilters();
    initializeFilterToggle();
    initializeFilterTrigger();
    updateResultsCount(artworksDatabase.length);
});

// ====================================
// RENDU DE LA GALERIE
// ====================================
function renderGallery(artworks) {
    const gallery = document.querySelector('.gallery');
    if (!gallery) return;
    
    gallery.innerHTML = '';
    
    artworks.forEach(artwork => {
        const card = document.createElement('div');
        card.className = 'artwork-card';
        
        card.innerHTML = `
            <div class="artwork-image">
                ${artwork.bestseller ? '<span class="badge">NOUVEAU</span>' : ''}
                <img src="${artwork.image}" alt="${artwork.title}">
            </div>
            <div class="artwork-info">
                <div class="artist-name">${artwork.title}</div>
                <div class="artwork-title">Par ${artwork.artist} - Dessin ${artwork.dimensions}</div>
                <div class="price">${formatPrice(artwork.price)} FCFA</div>
            </div>
        `;
        
        gallery.appendChild(card);
    });
    
    updateResultsCount(artworks.length);
}

// ====================================
// SYSTÈME DE FILTRES
// ====================================
function initializeFilters() {
    // Filtres taille
    document.querySelectorAll('input[name="size"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateFilter('size', this.value, this.checked);
        });
    });
    
    // Filtres style
    document.querySelectorAll('input[name="style"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateFilter('style', this.value, this.checked);
        });
    });
    
    // Filtres couleur
    document.querySelectorAll('input[name="color"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateFilter('color', this.value, this.checked);
        });
    });
    
    // Filtre prix
    const priceApplyBtn = document.getElementById('priceApplyBtn');
    if (priceApplyBtn) {
        priceApplyBtn.addEventListener('click', function() {
            const minValue = document.getElementById('priceMin').value;
            const maxValue = document.getElementById('priceMax').value;
            
            filters.priceMin = minValue ? parseInt(minValue) : null;
            filters.priceMax = maxValue ? parseInt(maxValue) : null;
            
            applyFilters();
        });
    }
    
    // Réinitialiser tous les filtres
    const resetBtn = document.getElementById('resetFiltersBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', resetAllFilters);
    }
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
    let filteredArtworks = artworksDatabase.filter(artwork => {
        // Filtre taille
        if (filters.size.length > 0 && !filters.size.includes(artwork.size)) {
            return false;
        }
        
        // Filtre style
        if (filters.style.length > 0 && !filters.style.includes(artwork.style)) {
            return false;
        }
        
        // Filtre couleur
        if (filters.color.length > 0) {
            const hasMatchingColor = filters.color.some(color => artwork.colors.includes(color));
            if (!hasMatchingColor) {
                return false;
            }
        }
        
        // Filtre prix
        if (filters.priceMin !== null && artwork.price < filters.priceMin) {
            return false;
        }
        if (filters.priceMax !== null && artwork.price > filters.priceMax) {
            return false;
        }
        
        return true;
    });
    
    renderGallery(filteredArtworks);
    updateResetButton();
}

function resetAllFilters() {
    // Réinitialiser l'état
    filters = {
        size: [],
        style: [],
        color: [],
        priceMin: null,
        priceMax: null
    };
    
    // Décocher toutes les checkboxes
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        cb.checked = false;
    });
    
    // Réinitialiser les champs de prix
    const priceMin = document.getElementById('priceMin');
    const priceMax = document.getElementById('priceMax');
    if (priceMin) priceMin.value = '';
    if (priceMax) priceMax.value = '';
    
    // Réafficher toutes les œuvres
    renderGallery(artworksDatabase);
    updateResetButton();
}

function updateResetButton() {
    const hasActiveFilters = 
        filters.size.length > 0 ||
        filters.style.length > 0 ||
        filters.color.length > 0 ||
        filters.priceMin !== null ||
        filters.priceMax !== null;
    
    const resetBtn = document.getElementById('resetFiltersBtn');
    if (resetBtn) {
        resetBtn.style.display = hasActiveFilters ? 'flex' : 'none';
    }
}

// ====================================
// TOGGLE DE LA BANNIÈRE DE FILTRES
// ====================================
function initializeFilterTrigger() {
    const triggerBtn = document.getElementById('filterTriggerBtn');
    const filterBanner = document.getElementById('filterBanner');
    
    if (!triggerBtn || !filterBanner) return;
    
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
    
    if (!toggleBtn || !filterBanner) return;
    
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
    if (resultsCount) {
        resultsCount.textContent = `(${count} produit${count > 1 ? 's' : ''})`;
    }
}

// ====================================
// GESTION DU PANIER
// ====================================
function updateCartCount() {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = '0';
    }
}

updateCartCount();