// ====================================
// BASE DE DONNÉES FICTIVE DES ŒUVRES PAYSAGE
// ====================================
const artworksDatabase = [
    {
        id: 1,
        title: "Matin sur Douala",
        artist: "Joseph Etoundi",
        price: 245000,
        dimensions: "60 × 80 cm",
        image: "assets/images/rue1.png",
        size: "moyen",
        technique: "estampe",
        colors: ["gris", "orange", "bleu"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=1"
    },
    {
        id: 2,
        title: "Rue des Artisans",
        artist: "Clarisse Ndongo",
        price: 185000,
        dimensions: "50 × 70 cm",
        image: "assets/images/rue2.png",
        size: "moyen",
        technique: "sérigraphie",
        colors: ["marron", "ocre", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=2"
    },
    {
        id: 3,
        title: "Marché Central",
        artist: "Amina Kamara",
        price: 395000,
        dimensions: "70 × 90 cm",
        image: "assets/images/rue3.png",
        size: "grand",
        technique: "lithographie",
        colors: ["rouge", "jaune", "brun"],
        bestseller: true,
        nouveau: true,
        detailPage: "artwork-detail.html?id=3"
    },
    {
        id: 4,
        title: "Crépuscule Urbain",
        artist: "Pierre Nkomo",
        price: 165000,
        dimensions: "40 × 60 cm",
        image: "assets/images/rue4.png",
        size: "petit",
        technique: "estampe",
        colors: ["orange", "violet", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=4"
    },
    {
        id: 5,
        title: "Ruelle des Fleurs",
        artist: "Claire Mbarga",
        price: 310000,
        dimensions: "55 × 75 cm",
        image: "assets/images/rue5.png",
        size: "moyen",
        technique: "gravure",
        colors: ["rose", "vert", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=5"
    },
    {
        id: 6,
        title: "Vieille Rue de Yaoundé",
        artist: "David Essono",
        price: 195000,
        dimensions: "45 × 65 cm",
        image: "assets/images/rue6.png",
        size: "petit",
        technique: "estampe",
        colors: ["beige", "marron", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=6"
    },
    {
        id: 7,
        title: "Boulevard du Soleil",
        artist: "Isabelle Fotso",
        price: 275000,
        dimensions: "60 × 80 cm",
        image: "assets/images/rue7.png",
        size: "moyen",
        technique: "sérigraphie",
        colors: ["jaune", "orange", "bleu"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=7"
    },
    {
        id: 8,
        title: "Ronde des Moto-Taxis",
        artist: "Thomas Onana",
        price: 225000,
        dimensions: "50 × 70 cm",
        image: "assets/images/rue8.png",
        size: "moyen",
        technique: "lithographie",
        colors: ["vert", "jaune", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=8"
    },
    {
        id: 9,
        title: "Matin Pluvieux",
        artist: "Marie Ngono",
        price: 365000,
        dimensions: "70 × 90 cm",
        image: "assets/images/rue9.png",
        size: "grand",
        technique: "estampe",
        colors: ["bleu", "gris", "blanc"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=9"
    },
    {
        id: 10,
        title: "Café du Carrefour",
        artist: "Léa Tchoumba",
        price: 285000,
        dimensions: "55 × 75 cm",
        image: "assets/images/rue10.png",
        size: "moyen",
        technique: "estampe",
        colors: ["marron", "orange", "gris"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=10"
    },
    {
        id: 11,
        title: "Soirée à Bonapriso",
        artist: "Marc Atangana",
        price: 335000,
        dimensions: "65 × 85 cm",
        image: "assets/images/rue11.png",
        size: "grand",
        technique: "sérigraphie",
        colors: ["bleu", "jaune", "violet"],
        bestseller: true,
        nouveau: true,
        detailPage: "artwork-detail.html?id=11"
    },
    {
        id: 12,
        title: "Rue des Potiers",
        artist: "Nadège Manga",
        price: 215000,
        dimensions: "50 × 70 cm",
        image: "assets/images/rue12.png",
        size: "moyen",
        technique: "lithographie",
        colors: ["beige", "vert", "marron"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=12"
    },
    {
        id: 13,
        title: "Ambiance du Quartier",
        artist: "Paul Bekolo",
        price: 255000,
        dimensions: "50 × 70 cm",
        image: "assets/images/rue13.png",
        size: "moyen",
        technique: "estampe",
        colors: ["rouge", "gris", "beige"],
        bestseller: false,
        detailPage: "artwork-detail.html?id=13"
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


function renderGallery(artworks) {
    const gallery = document.getElementById('gallery');
    gallery.innerHTML = '';
    
    artworks.forEach(artwork => {
        // MODIFIÉ : 'div' est devenu 'a'
        const card = document.createElement('a');
        card.className = 'artwork-card';
        
        // AJOUTÉ : Le lien dynamique
        card.href = `description.html?id=${artwork.id}&category=dessinRue`;
        
        // L'ancien "onclick" a été supprimé
        
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
