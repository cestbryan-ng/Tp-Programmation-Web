// ====================================
// BASE DE DONNÉES FICTIVE DES ŒUVRES
// ====================================
const artworksDatabase = [
    {
        id: 1,
        title: "Anette Tjaerby",
        artist: "Arthur Boyle",
        price: 385000,
        dimensions: "80 × 100 cm",
        image: "assets/images/Anette Tjaerby.jpeg",
        size: "grand",
        technique: "portrait",
        colors: ["rouge", "noir", "blanc"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=1"
    },
    {
        id: 2,
        title: "Believe your dreams",
        artist: "Synthia Mah",
        price: 95000,
        dimensions: "50 × 70 cm",
        image: "assets/images/Img2.jpeg",
        size: "moyen",
        technique: "sérigraphie",
        colors: ["jaune", "noir", "blanc"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=2"
    },
    {
        id: 3,
        title: "Multiface",
        artist: "Arnaud Owona",
        price: 125000,
        dimensions: "70 × 90 cm",
        image: "assets/images/Img3.jpeg",
        size: "grand",
        technique: "lithographie",
        colors: ["bleu", "rouge", "vert", "jaune"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=3"
    },
    {
        id: 4,
        title: "Marylin Monroe",
        artist: "Mdr",
        price: 435000,
        dimensions: "40 × 60 cm",
        image: "assets/images/Img4.jpeg",
        size: "petit",
        technique: "portrait",
        colors: ["rose", "noir", "blanc"],
        bestseller: false ,
        detailPage: "artwork-detail.html?id=4"
    },
    {
        id: 5,
        title: "Scarface",
        artist: "Adamou Njoya",
        price: 300000,
        dimensions: "55 × 75 cm",
        image: "assets/images/Img5.jpeg",
        size: "moyen",
        technique: "portrait",
        colors: ["rouge", "noir", "blanc"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=5"
    },
    {
        id: 6,
        title: "Femme noire",
        artist: "Cynthia Essono",
        price: 125000,
        dimensions: "45 × 65 cm",
        image: "assets/images/Img6.jpeg",
        size: "petit",
        technique: "portrait",
        colors: ["orange", "bleu", "noir"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=6"
    },
    {
        id: 7,
        title: "Arc-en-ciel Éternel",
        artist: "Anabelle Ngono",
        price: 305000,
        dimensions: "60 × 80 cm",
        image: "assets/images/arc-en-ciel eternel.jpeg",
        size: "moyen",
        technique: "portrait",
        colors: ["rouge", "bleu", "vert", "jaune", "orange"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=7"
    },
    {
        id: 8,
        title: "The mourner",
        artist: "Thomas Andre",
        price: 135000,
        dimensions: "50 × 70 cm",
        image: "assets/images/The cry.jpeg",
        size: "moyen",
        technique: "lithographie",
        colors: ["bleu", "noir", "blanc"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=8"
    },
    {
        id: 9,
        title: "The romantic city",
        artist: "Marie curie",
        price: 385000,
        dimensions: "70 × 90 cm",
        image: "assets/images/Paris by Lobo.jpeg",
        size: "grand",
        technique: "estampe",
        colors: ["rose", "bleu", "blanc"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=9"
    },
    {
        id: 10,
        title: "Multiculturalisme",
        artist: "Léa Kenfack",
        price: 295000,
        dimensions: "55 × 75 cm",
        image: "assets/images/Multicuturalisme.jpeg",
        size: "moyen",
        technique: "estampe",
        colors: ["rouge", "vert", "jaune", "noir"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=10"
    },
    {
        id: 11,
        title: "Culture pop",
        artist: "Cynthia Etoundi",
        price: 225000,
        dimensions: "45 × 65 cm",
        image: "assets/images/Culture pop.jpeg",
        size: "petit",
        technique: "portrait",
        colors: ["rouge", "bleu", "jaune"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=11"
    },
    {
        id: 12,
        title: "Bizarrerie",
        artist: "Leon marchand",
        price: 305000,
        dimensions: "60 × 80 cm",
        image: "assets/images/Bizarerrie.jpeg",
        size: "moyen",
        technique: "portrait",
        colors: ["vert", "rose", "noir"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=12"
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
// ====================================
// RENDU DE LA GALERIE
// ====================================
function renderGallery(artworks) {
    const gallery = document.getElementById('gallery');
    gallery.innerHTML = '';
    
    artworks.forEach(artwork => {
        // MODIFIÉ : 'div' est devenu 'a'
        const card = document.createElement('a');
        card.className = 'artwork-card';
        
        // AJOUTÉ : Le lien dynamique
        card.href = `description.html?id=${artwork.id}&category=popArt`;

        // L'ancien "onclick" a été supprimé
        
        card.innerHTML = `
            <div class="artwork-image-wrapper">
                <img src="${artwork.image}" alt="${artwork.title}">
                ${artwork.bestseller ? '<span class="artwork-badge">Best-seller</span>' : ''}
                <div class="artwork-overlay">
                    <div class="overlay-artist">${artwork.artist}</div>
                    <div class="overlay-price">${formatPrice(artwork.price)} FCFA</div>
                </div>
            </div>
            <div class="artwork-info">
                <h3 class="artwork-title">${artwork.title}</h3>
                <p class="artwork-dimensions">${artwork.dimensions}</p>
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
        console.log('Bouton filtre cliqué'); // Debug
        
        const isCollapsed = filterBanner.classList.contains('collapsed');
        console.log('État collapsed:', isCollapsed); // Debug
        
        if (isCollapsed) {
            // Ouvrir la bannière
            filterBanner.classList.remove('collapsed');
            filterBanner.classList.remove('inner-collapsed');
            triggerBtn.classList.add('active');
            console.log('Bannière ouverte'); // Debug
        } else {
            // Fermer la bannière
            filterBanner.classList.add('collapsed');
            triggerBtn.classList.remove('active');
            console.log('Bannière fermée'); // Debug
        }
    });
}

function initializeFilterToggle() {
    const toggleBtn = document.getElementById('filterToggleBtn');
    const filterBanner = document.getElementById('filterBanner');
    
    if (!toggleBtn) {
        console.error('Bouton toggle non trouvé'); // Debug
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