// Base de données des œuvres d'art (avec catégories multiples)
const artworks = [
    {
        id: 1,
        image: "assets/images/paysage1.jpg",
        title: "les pyramides d'Egypte",
        artist: "Sophie Dubois",
        details: "Estampe numérique • 60 × 80 cm",
        price: "285.000 FCFA",
        badge: "Best-seller",
        categories: ["desert", "ciel"]
    },
    {
        id: 2,
        image: "assets/images/paysage2.jpg",
        title: "Horizon d'elephant",
        artist: "Jean-Marc Laurent",
        details: "Sérigraphie • 50 × 70 cm",
        price: "195.000 FCFA",
        badge: null,
        categories: ["campagne", "ciel"]
    },
    {
        id: 3,
        image: "assets/images/paysage3.jpg",
        title: "beau marche",
        artist: "Amina Kamara",
        details: "Lithographie • 70 × 90 cm",
        price: "425.000 FCFA",
        badge: "Nouveau",
        categories: ["urbain"]
    },
    {
        id: 4,
        image: "assets/images/paysage4.jpg",
        title: "Lumière du Soir",
        artist: "Pierre Nkomo",
        details: "Estampe • 40 × 60 cm",
        price: "155.000 FCFA",
        badge: null,
        categories: ["ciel", "campagne"]
    },
    {
        id: 5,
        image: "assets/images/paysage5.jpg",
        title: "vue du quartier",
        artist: "Claire Mbarga",
        details: "Gravure • 55 × 75 cm",
        price: "320.000 FCFA",
        badge: "Best-seller",
        categories: ["urbain", "ciel"]
    },
    {
        id: 6,
        image: "assets/images/paysage6.jpg",
        title: "Douceur Matinale",
        artist: "David Essono",
        details: "Estampe numérique • 45 × 65 cm",
        price: "175.000 FCFA",
        badge: null,
        categories: ["campagne", "ciel"]
    },
    {
        id: 7,
        image: "assets/images/paysage7.jpg",
        title: "Plage Éternel",
        artist: "Isabelle Fotso",
        details: "Sérigraphie • 60 × 80 cm",
        price: "265.000 FCFA",
        badge: null,
        categories: ["plages", "ciel"]
    },
    {
        id: 8,
        image: "assets/images/paysage8.jpg",
        title: "mont Cameroun",
        artist: "Thomas Onana",
        details: "Lithographie • 50 × 70 cm",
        price: "235.000 FCFA",
        badge: "Best-seller",
        categories: ["montagnes", "ciel"]
    },
    {
        id: 9,
        image: "assets/images/paysage9.jpg",
        title: "Col boreal",
        artist: "Marie Ngono",
        details: "Estampe • 70 × 90 cm",
        price: "385.000 FCFA",
        badge: null,
        categories: ["montagnes", "ciel"]
    },
    {
        id: 10,
        image: "assets/images/paysage10.jpg",
        title: "Jardin Secret",
        artist: "Léa Tchoumba",
        details: "Estampe • 55 × 75 cm",
        price: "295.000 FCFA",
        badge: null,
        categories: ["forets", "campagne"]
    },
    {
        id: 11,
        image: "assets/images/paysage11.jpg",
        title: "Expression Moderne",
        artist: "Marc Atangana",
        details: "Sérigraphie • 65 × 85 cm",
        price: "340.000 FCFA",
        badge: "Nouveau",
        categories: ["urbain", "ciel"]
    },
    {
        id: 12,
        image: "assets/images/paysage12.jpg",
        title: "Fraîcheur de montagne",
        artist: "Nadège Manga",
        details: "Lithographie • 50 × 70 cm",
        price: "215.000 FCFA",
        badge: null,
        categories: ["montagnes", "forets"]
    },
    {
        id: 13,
        image: "assets/images/paysage13.jpg",
        title: "Fraîcheur Tropicale",
        artist: "Nadège Manga",
        details: "Lithographie • 50 × 70 cm",
        price: "215.000 FCFA",
        badge: null,
        categories: ["forets", "plages"]
    },
    {
        id: 14,
        image: "assets/images/paysage14.jpg",
        title: "lac Tropicale",
        artist: "Nadège Manga",
        details: "Lithographie • 50 × 70 cm",
        price: "215.000 FCFA",
        badge: null,
        categories: ["plages", "forets"]
    },
    {
        id: 15,
        image: "assets/images/paysage15.jpg",
        title: "Fraîcheur Tropicale",
        artist: "Nadège Manga",
        details: "Lithographie • 50 × 70 cm",
        price: "215.000 FCFA",
        badge: null,
        categories: ["forets", "campagne"]
    },
    {
        id: 16,
        image: "assets/images/paysage16.jpg",
        title: "Harmonie Colorée",
        artist: "Paul Bekolo",
        details: "Estampe • 60 × 80 cm",
        price: "275.000 FCFA",
        badge: null,
        categories: ["desert", "ciel"]
    },
    {
        id: 17,
        image: "assets/images/paysage17.jpg",
        title: "Le nil du Soir",
        artist: "Pierre Nkomo",
        details: "Estampe • 40 × 60 cm",
        price: "155.000 FCFA",
        badge: null,
        categories: ["plages", "ciel"]
    },
    {
        id: 18,
        image: "assets/images/paysage18.jpg",
        title: "Le pecheur du Soir",
        artist: "Pierre Nkomo",
        details: "Estampe • 40 × 60 cm",
        price: "155.000 FCFA",
        badge: null,
        categories: ["plages", "ciel"]
    },
    {
        id: 19,
        image: "assets/images/paysage0.jpg",
        title: "Le spinx",
        artist: "Pierre Nkomo",
        details: "Estampe • 40 × 60 cm",
        price: "155.000 FCFA",
        badge: null,
        categories: ["desert", "ciel"]
    }
];

// Catégories de filtres
const filterCategories = [
    { name: "Tout", value: "all", icon: "🎨" },
    { name: "Montagnes", value: "montagnes", icon: "⛰️" },
    { name: "Plages / Océans", value: "plages", icon: "🏖️" },
    { name: "Forêts", value: "forets", icon: "🌲" },
    { name: "Désert", value: "desert", icon: "🏜️" },
    { name: "Campagne", value: "campagne", icon: "🌾" },
    { name: "Urbain", value: "urbain", icon: "🏙️" },
    { name: "Ciel", value: "ciel", icon: "☁️" }
];

// Variable pour stocker le filtre actuel
let currentFilter = "all";
let filterVisible = false;

// Fonction pour créer une carte d'œuvre d'art
function createArtworkCard(artwork) {
    return `
        <div class="artwork-card" data-categories="${artwork.categories.join(',')}">
            <div class="artwork-image">
                <img src="${artwork.image}" alt="${artwork.title}">
                ${artwork.badge ? `<span class="badge">${artwork.badge}</span>` : ''}
            </div>
            <div class="artwork-info">
                <div class="artist-name">${artwork.artist}</div>
                <div class="artwork-title">${artwork.title}</div>
                <div class="artwork-details">${artwork.details}</div>
                <div class="price">${artwork.price}</div>
            </div>
        </div>
    `;
}

// Fonction pour afficher les œuvres filtrées
function displayArtworks(filter = "all") {
    const gallery = document.querySelector('.gallery');
    
    if (!gallery) return;
    
    // Filtrer les œuvres (une œuvre est affichée si elle contient la catégorie)
    const filteredArtworks = filter === "all" 
        ? artworks 
        : artworks.filter(artwork => artwork.categories.includes(filter));
    
    // Afficher les œuvres
    gallery.innerHTML = filteredArtworks.map(artwork => createArtworkCard(artwork)).join('');
    
    // Animation d'apparition
    const cards = gallery.querySelectorAll('.artwork-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 50);
    });
    
    // Afficher le nombre de résultats
    updateResultCount(filteredArtworks.length);
}

// Fonction pour mettre à jour le compteur de résultats
function updateResultCount(count) {
    const resultCount = document.querySelector('.result-count');
    if (resultCount) {
        resultCount.textContent = `${count} œuvre${count > 1 ? 's' : ''} disponible${count > 1 ? 's' : ''}`;
    }
}

// Fonction pour afficher/masquer les filtres
function toggleFilters() {
    const filterSection = document.querySelector('.filter-section');
    const filterToggleBtn = document.querySelector('.filter-toggle-btn');
    
    if (!filterSection || !filterToggleBtn) return;
    
    filterVisible = !filterVisible;
    
    if (filterVisible) {
        filterSection.classList.add('visible');
        filterToggleBtn.classList.add('active');
        document.body.classList.add('filters-open');
        filterToggleBtn.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M5 5L15 15M5 15L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span>Fermer</span>
        `;
    } else {
        filterSection.classList.remove('visible');
        filterToggleBtn.classList.remove('active');
        document.body.classList.remove('filters-open');
        filterToggleBtn.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M2 4h16M5 10h10M8 16h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span>Filtres</span>
        `;
    }
}

// Fonction pour créer le bouton de filtre dans le header
function createFilterToggleButton() {
    const headerActions = document.querySelector('.header-actions');
    
    if (!headerActions) return;
    
    // Créer le bouton de filtre
    const filterToggleBtn = document.createElement('button');
    filterToggleBtn.className = 'filter-toggle-btn icon-btn';
    filterToggleBtn.setAttribute('aria-label', 'Afficher les filtres');
    filterToggleBtn.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M2 4h16M5 10h10M8 16h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>Filtres</span>
    `;
    
    // Insérer le bouton avant l'icône de recherche
    const searchWrapper = headerActions.querySelector('.search-wrapper');
    headerActions.insertBefore(filterToggleBtn, searchWrapper);
    
    // Ajouter l'événement click
    filterToggleBtn.addEventListener('click', toggleFilters);
}

// Fonction pour créer les boutons de filtre
function createFilterButtons() {
    const body = document.body;
    
    // Créer la section de filtres fixe
    const filterSection = document.createElement('div');
    filterSection.className = 'filter-section';
    filterSection.innerHTML = `
        <div class="container">
            <div class="filter-header">
                <h2 class="filter-title">Explorer nos paysages</h2>
                <p class="result-count">${artworks.length} œuvres disponibles</p>
            </div>
            <div class="filters">
                ${filterCategories.map(category => `
                    <button class="filter-btn ${category.value === 'all' ? 'active' : ''}" 
                            data-filter="${category.value}">
                        <span class="filter-icon">${category.icon}</span>
                        <span class="filter-name">${category.name}</span>
                    </button>
                `).join('')}
            </div>
        </div>
    `;
    
    // Insérer après le header
    const header = document.querySelector('.header');
    if (header && header.parentNode) {
        header.parentNode.insertBefore(filterSection, header.nextSibling);
    }
    
    // Ajouter les événements aux boutons
    const filterButtons = filterSection.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Retirer la classe active de tous les boutons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');
            
            // Obtenir la valeur du filtre
            const filter = this.getAttribute('data-filter');
            currentFilter = filter;
            
            // Afficher les œuvres filtrées
            displayArtworks(filter);
        });
    });
}

// Fonction d'initialisation
function init() {
    // Créer le bouton de filtre dans le header
    createFilterToggleButton();
    
    // Créer les boutons de filtre
    createFilterButtons();
    
    // Afficher toutes les œuvres au chargement
    displayArtworks("all");
}

// Lancer l'initialisation quand le DOM est chargé
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}