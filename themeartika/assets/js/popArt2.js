// ====================================
// IMPORTANT : Version adaptée pour WordPress
// Les produits sont déjà affichés par PHP, pas besoin de les recréer en JS
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
    console.log('PopArt JS chargé - Version WordPress');
    
    // NE PAS appeler renderGallery au chargement
    // Les produits sont déjà affichés par PHP
    
    initializeFilters();
    initializeFilterToggle();
    initializeFilterTrigger();
    
    // Compter les produits existants
    updateResultsCount();
});

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
    // Construire l'URL avec les paramètres de filtre
    const url = new URL(window.location);
    
    // Filtres taille
    if (filters.size.length > 0) {
        url.searchParams.set('filter_taille', filters.size.join(','));
    } else {
        url.searchParams.delete('filter_taille');
    }
    
    // Filtres technique
    if (filters.technique.length > 0) {
        url.searchParams.set('filter_technique', filters.technique.join(','));
    } else {
        url.searchParams.delete('filter_technique');
    }
    
    // Filtres couleur
    if (filters.color.length > 0) {
        url.searchParams.set('filter_color', filters.color.join(','));
    } else {
        url.searchParams.delete('filter_color');
    }
    
    // Filtre prix
    if (filters.priceMin !== null) {
        url.searchParams.set('min_price', filters.priceMin);
    } else {
        url.searchParams.delete('min_price');
    }
    
    if (filters.priceMax !== null) {
        url.searchParams.set('max_price', filters.priceMax);
    } else {
        url.searchParams.delete('max_price');
    }
    
    // Recharger la page avec les nouveaux filtres
    window.location.href = url.toString();
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
    const priceMin = document.getElementById('priceMin');
    const priceMax = document.getElementById('priceMax');
    if (priceMin) priceMin.value = '';
    if (priceMax) priceMax.value = '';
    
    // Rediriger vers la page sans paramètres
    window.location.href = window.location.pathname;
}

function updateResetButton() {
    const hasActiveFilters = 
        filters.size.length > 0 ||
        filters.technique.length > 0 ||
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
    
    if (!triggerBtn || !filterBanner) {
        console.error('Bouton trigger ou bannière non trouvés');
        return;
    }
    
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

function updateResultsCount() {
    const gallery = document.getElementById('gallery');
    if (!gallery) return;
    
    const count = gallery.querySelectorAll('.artwork-card').length;
    const resultsCount = document.getElementById('resultsCount');
    
    if (resultsCount) {
        resultsCount.textContent = `(${count} produit${count > 1 ? 's' : ''})`;
    }
}

// ====================================
// GESTION DU PANIER (Simplifié)
// ====================================
function updateCartCount() {
    // Le panier est géré par WooCommerce
    // Cette fonction est conservée pour compatibilité
    const cartCount = document.querySelector('.cart-count');
    if (cartCount && typeof wc_add_to_cart_params !== 'undefined') {
        // Le compteur est mis à jour automatiquement par WooCommerce
        console.log('Panier géré par WooCommerce');
    }
}

// Initialiser au chargement
updateCartCount();
updateResetButton();

// Log pour débogage
console.log('PopArt JS initialisé avec succès');
console.log('Nombre de produits affichés:', document.querySelectorAll('.artwork-card').length);