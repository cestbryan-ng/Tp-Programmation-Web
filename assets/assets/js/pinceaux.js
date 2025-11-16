// ====================================
// TABLEAU DES ACCESSOIRES (CHEMINS CORRIGÉS)
// Les chemins d'images commencent par '/' pour un lien absolu depuis la racine
// de votre projet (dossier Tp-Programmation-Web-tp1-dev).
// ==================================== 
const accessoires = [
    { id: 1, nom: "Pointe Ronde N°4", description: "Fibre synthétique, idéal pour les détails fins et l'aquarelle.", prix: 2500, image: "assets/images/36000cccedf589f2791101b6b27da0f7.jpg" },
    { id: 2, nom: "Plat Carré N°10", description: "Soies synthétiques rigides, parfait pour les aplats et l'acrylique.", prix: 3200, image: "assets/images/0917b9ffee0f07d58f2a63ee77a7b26c.jpg" },
    { id: 3, nom: "Langue de Chat N°8", description: "Idéal pour les bords doux, les dégradés et le travail en épaisseur (huile/acrylique).", prix: 4500, image: "assets/images/1cf933e6ad16b2356851a6843e26f0a9.jpg" },
    { id: 4, nom: "Set Calligraphie Chine (5pcs)", description: "Pinceaux en poils de chèvre/loup pour encre et Sumi-e, pointe très fine.", prix: 12000, image: "assets/images/219acf043cadd3b510ecf34982cc469d.jpg" },
    { id: 5, nom: "Éventail N°6", description: "Permet des effets de texture, d'herbe, ou d'adoucir des contours sur huile et acrylique.", prix: 2900, image: "assets/images/36000cccedf589f2791101b6b27da0f7.jpg" },
    { id: 6, nom: "Spalter Synthétique (50mm)", description: "Grande brosse plate pour lavis larges, fonds et gesso sur toile.", prix: 5800, image: "assets/images/36ad309418f4dfe259fad34df15f5c97.jpg" },
    { id: 7, nom: "Traceur/Liner N°0", description: "Poils extra longs pour des lignes très fines, fluides et de la calligraphie.", prix: 2100, image: "assets/images/380cda2546b07825eec13bc58347f3f5.jpg" },
    { id: 8, nom: "Lavis Petit-Gris N°6", description: "Poils très absorbants, idéal pour les grands lavis et mouiller le papier aquarelle.", prix: 6500, image: "assets/images/3daa56639249c1649bc88f0b5c26a08e.jpg" },
    { id: 9, nom: "Biseauté N°12", description: "Permet de tracer des lignes nettes et de couvrir de petites surfaces.", prix: 3500, image: "assets/images/40b6461c0d9357316754d8778cc2e8f6.jpg" },
    { id: 10, nom: "Biseauté Précision N°2", description: "Pointe précise pour les petits détails et les lignes dures en acrylique/huile.", prix: 2400, image: "assets/images/42e200b4d2e62f6089661a96c47f1652.jpg" },
    { id: 11, nom: "Ronde Martre Kolinsky N°6", description: "Haut de gamme, élasticité et rétention d'eau maximales pour aquarelle et détails.", prix: 15000, image: "assets/images/4d18920f3e5c5932c641047b35d5791b.jpg" },
    { id: 12, nom: "Usé Bombé N°14", description: "Pour estomper les bords, fondre les couleurs et créer des effets de feuilles (huile/acrylique).", prix: 4100, image: "assets/images/73ab2677e804c696ed8b854f98edd14c.jpg" },
    { id: 13, nom: "Ronde Aquarelle N°16", description: "Pointe fine sur brosse large, excellent pour les lavis et les détails en aquarelle.", prix: 7500, image: "assets/images/74f66bdbea5d8eb2d4aab978e3ef6d17.jpg" },
    { id: 14, nom: "Éventail N°4", description: "Pour la création de textures légères, le lissage et les effets spéciaux.", prix: 2700, image: "assets/images/9bf2fab0bf79734b85b74541e7b4740c.jpg" },
    { id: 15, nom: "Plat Carré N°6", description: "Pour les surfaces moyennes, les lignes épaisses et le travail à l'acrylique.", prix: 2500, image: "assets/images/9d6c285a79664b26998f795f9f58e56a.jpg" }
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

// ====================================
// RENDU DE LA GALERIE
// ====================================
function renderGallery(items) {
    const gallery = document.getElementById('gallery');
    if (!gallery) return;

    gallery.innerHTML = ''; 

    items.forEach(item => {
        const card = document.createElement('div');
        card.className = 'artwork-card';
        card.innerHTML = `
            <div class="artwork-image">
                <img src="${item.image}" alt="${item.nom}">
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