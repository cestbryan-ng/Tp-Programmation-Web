// ====================================
// BASE DE DONNÉES FICTIVE DES ŒUVRES PAYSAGE
// ====================================
const artworksDatabase = [
    {
        id: 1,
        title: "les pyramides d'Egypte",
        artist: "Sophie Dubois",
        price: 285000,
        dimensions: "60 × 80 cm",
        image: "assets/images/paysage1.jpg",
        size: "moyen",
        technique: "estampe",
        colors: ["beige", "orange", "bleu"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=1"
    },
    {
        id: 2,
        title: "Horizon d'elephant",
        artist: "Jean-Marc Laurent",
        price: 195000,
        dimensions: "50 × 70 cm",
        image: "assets/images/paysage2.jpg",
        size: "moyen",
        technique: "sérigraphie",
        colors: ["orange", "marron", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=2"
    },
    {
        id: 3,
        title: "beau marche",
        artist: "Amina Kamara",
        price: 425000,
        dimensions: "70 × 90 cm",
        image: "assets/images/paysage3.jpg",
        size: "grand",
        technique: "lithographie",
        colors: ["vert", "marron", "beige"],
        bestseller: false,
        nouveau: true,
        detailPage: "artwork-detail.html?id=3"
    },
    {
        id: 4,
        title: "Lumière du Soir",
        artist: "Pierre Nkomo",
        price: 155000,
        dimensions: "40 × 60 cm",
        image: "assets/images/paysage4.jpg",
        size: "petit",
        technique: "estampe",
        colors: ["orange", "rose", "jaune"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=4"
    },
    {
        id: 5,
        title: "vue du quartier",
        artist: "Claire Mbarga",
        price: 320000,
        dimensions: "55 × 75 cm",
        image: "assets/images/paysage5.jpg",
        size: "moyen",
        technique: "gravure",
        colors: ["marron", "vert", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=5"
    },
    {
        id: 6,
        title: "Douceur Matinale",
        artist: "David Essono",
        price: 175000,
        dimensions: "45 × 65 cm",
        image: "assets/images/paysage6.jpg",
        size: "petit",
        technique: "estampe",
        colors: ["bleu", "vert", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=6"
    },
    {
        id: 7,
        title: "Plage Éternel",
        artist: "Isabelle Fotso",
        price: 265000,
        dimensions: "60 × 80 cm",
        image: "assets/images/paysage7.jpg",
        size: "moyen",
        technique: "sérigraphie",
        colors: ["bleu", "beige", "jaune"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=7"
    },
    {
        id: 8,
        title: "mont Cameroun",
        artist: "Thomas Onana",
        price: 235000,
        dimensions: "50 × 70 cm",
        image: "assets/images/paysage8.jpg",
        size: "moyen",
        technique: "lithographie",
        colors: ["vert", "gris", "bleu"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=8"
    },
    {
        id: 9,
        title: "Col boreal",
        artist: "Marie Ngono",
        price: 385000,
        dimensions: "70 × 90 cm",
        image: "assets/images/paysage9.jpg",
        size: "grand",
        technique: "estampe",
        colors: ["bleu", "gris", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=9"
    },
    {
        id: 10,
        title: "Jardin Secret",
        artist: "Léa Tchoumba",
        price: 295000,
        dimensions: "55 × 75 cm",
        image: "assets/images/paysage10.jpg",
        size: "moyen",
        technique: "estampe",
        colors: ["vert", "marron", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=10"
    },
    {
        id: 11,
        title: "Expression Moderne",
        artist: "Marc Atangana",
        price: 340000,
        dimensions: "65 × 85 cm",
        image: "assets/images/paysage11.jpg",
        size: "grand",
        technique: "sérigraphie",
        colors: ["marron", "beige", "orange"],
        bestseller: false,
        nouveau: true,
        detailPage: "artwork-detail.html?id=11"
    },
    {
        id: 12,
        title: "Fraîcheur de montagne",
        artist: "Nadège Manga",
        price: 215000,
        dimensions: "50 × 70 cm",
        image: "assets/images/paysage12.jpg",
        size: "moyen",
        technique: "lithographie",
        colors: ["vert", "bleu", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=12"
    },
    {
        id: 13,
        title: "Fraîcheur Tropicale",
        artist: "Nadège Manga",
        price: 215000,
        dimensions: "50 × 70 cm",
        image: "assets/images/paysage13.jpg",
        size: "moyen",
        technique: "lithographie",
        colors: ["vert", "bleu", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=13"
    },
    {
        id: 14,
        title: "lac Tropicale",
        artist: "Nadège Manga",
        price: 215000,
        dimensions: "50 × 70 cm",
        image: "assets/images/paysage14.jpg",
        size: "moyen",
        technique: "lithographie",
        colors: ["bleu", "vert", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=14"
    },
    {
        id: 15,
        title: "Fraîcheur Tropicale",
        artist: "Nadège Manga",
        price: 215000,
        dimensions: "50 × 70 cm",
        image: "assets/images/paysage15.jpg",
        size: "moyen",
        technique: "lithographie",
        colors: ["vert", "marron", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=15"
    },
    {
        id: 16,
        title: "Harmonie du desert",
        artist: "Paul Bekolo",
        price: 275000,
        dimensions: "60 × 80 cm",
        image: "assets/images/paysage16.jpg",
        size: "moyen",
        technique: "estampe",
        colors: ["orange", "beige", "jaune"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=16"
    },
    {
        id: 17,
        title: "Le nil du Soir",
        artist: "Pierre Nkomo",
        price: 155000,
        dimensions: "40 × 60 cm",
        image: "assets/images/paysage17.jpg",
        size: "petit",
        technique: "estampe",
        colors: ["bleu", "orange", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=17"
    },
    {
        id: 18,
        title: "Le pecheur du Soir",
        artist: "Pierre Nkomo",
        price: 155000,
        dimensions: "40 × 60 cm",
        image: "assets/images/paysage18.jpg",
        size: "petit",
        technique: "estampe",
        colors: ["orange", "rose", "bleu"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=18"
    },
    {
        id: 19,
        title: "Le spinx",
        artist: "Pierre Nkomo",
        price: 155000,
        dimensions: "40 × 60 cm",
        image: "assets/images/paysage0.jpg",
        size: "petit",
        technique: "estampe",
        colors: ["beige", "orange", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=19"
    }
];

// ====================================
// ÉTAT DES FILTRES
// ====================================
let filters = {
    size: [],
    technique: [],
    color: [],
    priceMin: null,
    priceMax: null
};

// ====================================
// INITIALISATION
// ====================================
document.addEventListener('DOMContentLoaded', function() {
    renderGallery(artworksDatabase);
    initializeFilters();
    initializeFilterToggle();
    initializeFilterTrigger();
});

// ====================================
// RENDU DE LA GALERIE
// ====================================
function renderGallery(artworks) {
    const gallery = document.getElementById('gallery');
    gallery.innerHTML = '';
    
    artworks.forEach(artwork => {
        const card = document.createElement('div');
        card.className = 'artwork-card';
        card.onclick = () => window.location.href = artwork.detailPage;
        
        let badgeHTML = '';
        if (artwork.bestseller) {
            badgeHTML = '<span class="badge">Best-seller</span>';
        } else if (artwork.nouveau) {
            badgeHTML = '<span class="badge">Nouveau</span>';
        }
        
        card.innerHTML = `
            <div class="artwork-image">
                <img src="${artwork.image}" alt="${artwork.title}">
                ${badgeHTML}
            </div>
            <div class="artwork-info">
                <div class="artist-name">${artwork.artist}</div>
                <div class="artwork-title">${artwork.title}</div>
                <div class="artwork-details">${artwork.technique} • ${artwork.dimensions}</div>
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
    
    // Filtres technique
    document.querySelectorAll('input[name="technique"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateFilter('technique', this.value, this.checked);
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
    let filteredArtworks = artworksDatabase.filter(artwork => {
        // Filtre taille
        if (filters.size.length > 0 && !filters.size.includes(artwork.size)) {
            return false;
        }
        
        // Filtre technique
        if (filters.technique.length > 0 && !filters.technique.includes(artwork.technique)) {
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
        technique: [],
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
    renderGallery(artworksDatabase);
    updateResetButton();
}

function updateResetButton() {
    const hasActiveFilters = 
        filters.size.length > 0 ||
        filters.technique.length > 0 ||
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
