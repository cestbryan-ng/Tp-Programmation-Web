// ====================================
// TABLEAU DES ACCESSOIRES (DESSINS SPÉCIFIQUES)
// ==================================== 
const accessoires = [
    { id: 1, nom: "Esquisse Moderne", description: "Dessin au fusain de Stanley Kustamin.", prix: 15000, image: "assets/images/stanley-kustamin-OKR8bAiU_sY-unsplash.jpg" },
    { id: 2, nom: "Abstraction Bleue", description: "Oeuvre numérique de Susan Wilkinson.", prix: 22000, image: "assets/images/susan-wilkinson-HwRiIX60p9M-unsplash.jpg" },
    { id: 3, nom: "Formes Géométriques", description: "Dessin abstrait de Susan Wilkinson.", prix: 18000, image: "assets/images/susan-wilkinson-OeVC4pYLWH4-unsplash.jpg" },
    { id: 4, nom: "Composition Rose", description: "Design minimaliste par Susan Wilkinson.", prix: 19500, image: "assets/images/susan-wilkinson-pYquLiPamPc-unsplash.jpg" },
    { id: 5, nom: "Palette Pastel", description: "Couleurs douces de Susan Wilkinson.", prix: 17000, image: "assets/images/susan-wilkinson-Sl1h2dP4cyU-unsplash.jpg" },
    { id: 6, nom: "Contraste Vif", description: "Illustration haute en couleur de Susan Wilkinson.", prix: 21000, image: "assets/images/susan-wilkinson-ZqDz4s56h0M-unsplash.jpg" },
    { id: 7, nom: "Motif Répétitif", description: "Œuvre de Susan Wilkinson explorant la répétition.", prix: 16500, image: "assets/images/susan-wilkinson-zzzpgcaPMTc-unsplash.jpg" },
    { id: 8, nom: "Vieille Carte I", description: "Collection de la New York Public Library.", prix: 11000, image: "assets/images/the-new-york-public-library-aN2vUZXy1WY-unsplash.jpg" },
    { id: 9, nom: "Illustration Botanique", description: "Planche d'herbier de la NY Public Library.", prix: 13500, image: "assets/images/the-new-york-public-library-B6utjpRWmlw-unsplash.jpg" },
    { id: 10, nom: "Lavis Architectural", description: "Dessin d'architecture de la NY Public Library.", prix: 14000, image: "assets/images/the-new-york-public-library-_BFkoqX5vN4-unsplash.jpg" },
    { id: 11, nom: "Faune Exotique", description: "Gravure d'animaux de la NY Public Library.", prix: 16000, image: "assets/images/the-new-york-public-library-PPLRYRZ8iJM-unsplash.jpg" },
    { id: 12, nom: "Étude d'Oiseau", description: "Dessin classique de la NY Public Library.", prix: 12500, image: "assets/images/the-new-york-public-library-Qt3Pf1fNaqs-unsplash.jpg" },
    { id: 13, nom: "Plan Urbain", description: "Ancien plan de ville de la NY Public Library.", prix: 18500, image: "assets/images/the-new-york-public-library-Sai6QVPi8Aw-unsplash.jpg" },
    { id: 14, nom: "Fragment Historique", description: "Document ancien de la NY Public Library.", prix: 9500, image: "assets/images/the-new-york-public-library-wtx3HO4amVU-unsplash.jpg" },
    { id: 15, nom: "Gravure Bleue", description: "Illustration encre de la NY Public Library.", prix: 14500, image: "assets/images/the-new-york-public-library-zPxCdKcj-PQ-unsplash.jpg" }
];
// ====================================
// ÉTAT DES FILTRES
// ====================================
let filters = {
    priceMin: null,
    priceMax: null,
    searchTerm: ''
};

// ====================================
// INITIALISATION
// ====================================
document.addEventListener('DOMContentLoaded', function() {
    renderGallery(accessoires); 
    initializeFilters();
    updateResultsCount(accessoires.length);
    updateCartCount(0); // Initialisation du compteur
    initializeSearch(); 
});

// ====================================
// GESTION DE LA RECHERCHE PAR TEXTE
// ====================================
function initializeSearch() {
    const searchInput = document.querySelector('.search-input');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filters.searchTerm = this.value.toLowerCase().trim();
            applyFilters();
        });
    }
}

function renderGallery(items) {
    const gallery = document.getElementById('gallery');
    if (!gallery) return;

    gallery.innerHTML = ''; 

    items.forEach(item => {
        // CORRECTION: Ajout du '/' pour un chemin absolu si non présent
        const imagePath = item.image.startsWith('/') ? item.image : '/' + item.image;

        // MODIFIÉ : 'div' est devenu 'a'
        const card = document.createElement('a');
        card.className = 'artwork-card';

        // AJOUTÉ : Le lien dynamique
        card.href = `description.html?id=${item.id}&category=dessinsEau`;

        card.innerHTML = `
            <div class="artwork-image">
                <img src="${imagePath}" alt="${item.nom}">
            </div>
            <div class="artwork-info">
                <div class="artwork-title">${item.nom}</div>
                <div class="artwork-details">${item.description}</div>
                <div class="price">${item.prix.toLocaleString('fr-FR')} FCFA</div>
            </div>
        `;
        gallery.appendChild(card);
    });

    updateResultsCount(items.length);
}
// ====================================
// APPLICATION DES FILTRES (Prix et Recherche)
// ====================================
function applyFilters() {
    let filtered = accessoires.filter(item => {
        // 1. Filtrage par PRIX
        const min = filters.priceMin !== null ? filters.priceMin : -Infinity;
        const max = filters.priceMax !== null ? filters.priceMax : Infinity;
        if (item.prix < min || item.prix > max) return false;

        // 2. Filtrage par RECHERCHE
        const searchTerm = filters.searchTerm;
        if (searchTerm) {
            const nomMatch = item.nom.toLowerCase().includes(searchTerm);
            const descriptionMatch = item.description.toLowerCase().includes(searchTerm);
            
            if (!nomMatch && !descriptionMatch) return false;
        }
        
        return true;
    });

    renderGallery(filtered);
}

// ====================================
// GESTION DES AUTRES FILTRES (Prix et Boutons)
// ====================================
function initializeFilters() {
    const priceApplyBtn = document.getElementById('priceApplyBtn');
    const resetFiltersBtn = document.getElementById('resetFiltersBtn');
    
    // Filtre de prix
    if (priceApplyBtn) {
        priceApplyBtn.addEventListener('click', function() {
            const minValue = parseInt(document.getElementById('priceMin').value) || null;
            const maxValue = parseInt(document.getElementById('priceMax').value) || null;
            filters.priceMin = minValue;
            filters.priceMax = maxValue;
            applyFilters();
            if (filters.priceMin !== null || filters.priceMax !== null) {
                if (resetFiltersBtn) resetFiltersBtn.style.display = 'inline-flex';
            }
        });
    }

    // Bouton de réinitialisation
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', function() {
            document.getElementById('priceMin').value = '';
            document.getElementById('priceMax').value = '';
            filters.priceMin = null;
            filters.priceMax = null;
            filters.searchTerm = ''; 

            const searchInput = document.querySelector('.search-input');
            if (searchInput) searchInput.value = '';

            resetFiltersBtn.style.display = 'none';
            renderGallery(accessoires);
        });
    }

    // Gestion du bouton 'Filtres' mobile/tablette
    const filterTriggerBtn = document.getElementById('filterTriggerBtn');
    const filterBanner = document.getElementById('filterBanner');
    const filterToggleBtn = document.getElementById('filterToggleBtn');

    if (filterTriggerBtn && filterBanner) {
        filterTriggerBtn.addEventListener('click', () => {
            filterBanner.classList.toggle('collapsed');
            filterTriggerBtn.classList.toggle('active');
        });
    }
    
    // Gestion du bouton 'RÉDUIRE LES FILTRES' à l'intérieur de la bannière
    if (filterToggleBtn && filterBanner) {
         filterToggleBtn.addEventListener('click', () => {
            filterBanner.classList.add('collapsed');
            if (filterTriggerBtn) filterTriggerBtn.classList.remove('active');
        });
    }
}

// ====================================
// MISE À JOUR DU COMPTEUR DE RÉSULTATS
// ====================================
function updateResultsCount(count) {
    const resultsCountElement = document.getElementById('resultsCount');
    if (resultsCountElement) {
        resultsCountElement.textContent = `(${count} produit${count > 1 ? 's' : ''})`;
    }
}

// ====================================
// GESTION DU PANIER (Rendue robuste)
// ====================================
function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count');
    
    // Vérifie si l'élément existe pour éviter le 'TypeError: ... is null'
    if (cartCountElement) { 
        cartCountElement.textContent = count.toString();
    }
}