/**
 * ARTIKA FILTERS - WordPress WooCommerce (VERSION FINALE CORRIGÉE)
 * Système de filtres dynamique et interactif
 */

(function($) {
    'use strict';

    // État des filtres - COHÉRENT avec le backend
    let artikaFilters = {
        categories: [],
        sizes: [],
        techniques: [],
        colors: [],
        priceMin: null,
        priceMax: null
    };

    // Initialisation au chargement du DOM
    $(document).ready(function() {
        console.log('🚀 Initialisation des filtres Artika...');
        initializeArtikaFilters();
        debugFilterStatus();
    });

    /**
     * Initialisation principale
     */
    function initializeArtikaFilters() {
        initializeFilterTrigger();
        initializeFilterToggle();
        initializeFilterCheckboxes();
        initializePriceFilter();
        initializeResetButton();
        updateProductCount();
    }

    /**
     * Bouton d'ouverture/fermeture de la bannière de filtres
     */
    function initializeFilterTrigger() {
        const triggerBtn = $('.artika-filter-trigger-btn, #filterTriggerBtn');
        const filterBanner = $('.artika-filter-banner, #filterBanner');
        
        if (triggerBtn.length && filterBanner.length) {
            console.log('✅ Bouton trigger trouvé');
            triggerBtn.on('click', function(e) {
                e.preventDefault();
                
                const isCollapsed = filterBanner.hasClass('collapsed');
                
                if (isCollapsed) {
                    filterBanner.removeClass('collapsed inner-collapsed');
                    triggerBtn.addClass('active');
                    console.log('📂 Filtres ouverts');
                } else {
                    filterBanner.addClass('collapsed');
                    triggerBtn.removeClass('active');
                    console.log('📁 Filtres fermés');
                }
            });
        } else {
            console.error('❌ Bouton trigger ou bannière non trouvé');
        }
    }

    /**
     * Bouton réduire/afficher les filtres
     */
    function initializeFilterToggle() {
        const toggleBtn = $('.artika-filter-toggle-btn, #filterToggleBtn');
        const filterBanner = $('.artika-filter-banner, #filterBanner');
        
        if (toggleBtn.length && filterBanner.length) {
            toggleBtn.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                filterBanner.toggleClass('inner-collapsed');
                
                const isCollapsed = filterBanner.hasClass('inner-collapsed');
                const textSpan = toggleBtn.find('span').first();
                
                if (textSpan.length) {
                    textSpan.text(isCollapsed ? 'AFFICHER LES FILTRES' : 'RÉDUIRE LES FILTRES');
                }
            });
        }
    }

    /**
     * Gestion des checkboxes de filtres - MULTI-SÉLECTEURS
     */
    function initializeFilterCheckboxes() {
        // Catégories
        $('input[name="artika_category"]').on('change', function() {
            console.log('📦 Catégorie sélectionnée:', $(this).val());
            updateFilter('categories', $(this).val(), $(this).is(':checked'));
        });
        
        // Tailles - Support des deux formats
        $('input[name="artika_size"], input[name="size"]').on('change', function() {
            console.log('📏 Taille sélectionnée:', $(this).val());
            updateFilter('sizes', $(this).val(), $(this).is(':checked'));
        });
        
        // Techniques - Support des TROIS formats possibles
        $('input[name="artika_technique"], input[name="technique"], input[name="artika_style"]').on('change', function() {
            console.log('🎨 Technique sélectionnée:', $(this).val());
            updateFilter('techniques', $(this).val(), $(this).is(':checked'));
        });
        
        // Couleurs - Support des deux formats
        $('input[name="artika_color"], input[name="color"]').on('change', function() {
            console.log('🌈 Couleur sélectionnée:', $(this).val());
            updateFilter('colors', $(this).val(), $(this).is(':checked'));
        });

        // Debug : afficher le nombre de checkboxes trouvées
        console.log('📊 Checkboxes trouvées:');
        console.log('- Catégories:', $('input[name="artika_category"]').length);
        console.log('- Tailles:', $('input[name="artika_size"], input[name="size"]').length);
        console.log('- Techniques:', $('input[name="artika_technique"], input[name="technique"]').length);
        console.log('- Couleurs:', $('input[name="artika_color"], input[name="color"]').length);
    }

    /**
     * Filtre de prix
     */
    function initializePriceFilter() {
        // Support des deux formats d'ID
        $('.artika-price-apply-btn, #priceApplyBtn').on('click', function() {
            const minValue = $('#artikaPriceMin, #priceMin').val();
            const maxValue = $('#artikaPriceMax, #priceMax').val();
            
            artikaFilters.priceMin = minValue ? parseInt(minValue) : null;
            artikaFilters.priceMax = maxValue ? parseInt(maxValue) : null;
            
            console.log('💰 Filtre prix appliqué:', artikaFilters.priceMin, '-', artikaFilters.priceMax);
            applyFilters();
        });
    }

    /**
     * Bouton de réinitialisation
     */
    function initializeResetButton() {
        $('.artika-reset-filters-btn, #resetFiltersBtn').on('click', function() {
            console.log('🔄 Réinitialisation des filtres');
            resetAllFilters();
        });
    }

    /**
     * Mise à jour d'un filtre
     */
    function updateFilter(filterType, value, isChecked) {
        if (isChecked) {
            if (!artikaFilters[filterType].includes(value)) {
                artikaFilters[filterType].push(value);
            }
        } else {
            artikaFilters[filterType] = artikaFilters[filterType].filter(v => v !== value);
        }
        
        console.log('📊 État des filtres mis à jour:', artikaFilters);
        applyFilters();
    }

    /**
     * Application des filtres via AJAX
     */
    function applyFilters() {
        console.log('🔍 Application des filtres...');
        console.log('Données envoyées:', artikaFilters);
        
        showLoader();
        
        $.ajax({
            url: artikaFiltersData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'artika_filter_products',
                nonce: artikaFiltersData.nonce,
                filters: artikaFilters
            },
            success: function(response) {
                console.log('✅ Réponse AJAX reçue:', response);
                
                if (response.success) {
                    // Chercher le bon conteneur de produits
                    let productsContainer = $('#gallery');
                    if (!productsContainer.length) {
                        productsContainer = $('.woocommerce ul.products');
                    }
                    if (!productsContainer.length) {
                        productsContainer = $('.gallery-wrapper .gallery');
                    }
                    
                    if (productsContainer.length) {
                        productsContainer.html(response.data.html);
                        console.log('✅ Produits mis à jour:', response.data.count, 'produits');
                    } else {
                        console.error('❌ Conteneur de produits non trouvé');
                    }
                    
                    // Mettre à jour le compteur
                    updateProductCount(response.data.count);
                    
                    // Afficher/masquer le bouton reset
                    updateResetButton();
                    
                    hideLoader();
                } else {
                    console.error('❌ Erreur de filtrage:', response.data ? response.data.message : 'Pas de message');
                    hideLoader();
                }
            },
            error: function(xhr, status, error) {
                console.error('❌ Erreur AJAX:', error);
                console.error('Détails:', xhr.responseText);
                hideLoader();
                
                // Afficher un message d'erreur à l'utilisateur
                alert('Erreur lors du filtrage. Veuillez rafraîchir la page.');
            }
        });
    }

    /**
     * Réinitialisation de tous les filtres
     */
    function resetAllFilters() {
        // Réinitialiser l'état
        artikaFilters = {
            categories: [],
            sizes: [],
            techniques: [],
            colors: [],
            priceMin: null,
            priceMax: null
        };
        
        // Décocher toutes les checkboxes - Support des deux formats
        $('input[type="checkbox"][name^="artika_"], input[type="checkbox"][name="size"], input[type="checkbox"][name="technique"], input[type="checkbox"][name="color"]').prop('checked', false);
        
        // Réinitialiser les champs de prix - Support des deux formats
        $('#artikaPriceMin, #artikaPriceMax, #priceMin, #priceMax').val('');
        
        // Recharger tous les produits
        applyFilters();
    }

    /**
     * Mise à jour du compteur de produits
     */
    function updateProductCount(count) {
        if (typeof count === 'undefined') {
            count = $('#gallery .product-card, .woocommerce ul.products li.product').length;
        }
        
        const resultsCount = $('.results-count, #resultsCount');
        if (resultsCount.length) {
            resultsCount.text('(' + count + ' produit' + (count > 1 ? 's' : '') + ')');
        }
    }

    /**
     * Afficher/masquer le bouton de réinitialisation
     */
    function updateResetButton() {
        const hasActiveFilters = 
            artikaFilters.categories.length > 0 ||
            artikaFilters.sizes.length > 0 ||
            artikaFilters.techniques.length > 0 ||
            artikaFilters.colors.length > 0 ||
            artikaFilters.priceMin !== null ||
            artikaFilters.priceMax !== null;
        
        const resetBtn = $('.artika-reset-filters-btn, #resetFiltersBtn');
        if (hasActiveFilters) {
            resetBtn.show();
        } else {
            resetBtn.hide();
        }
    }

    /**
     * Afficher le loader
     */
    function showLoader() {
        $('.artika-filter-loader').addClass('active').show();
        $('#gallery, .woocommerce ul.products, .gallery-wrapper').css('opacity', '0.5');
    }

    /**
     * Masquer le loader
     */
    function hideLoader() {
        $('.artika-filter-loader').removeClass('active').hide();
        $('#gallery, .woocommerce ul.products, .gallery-wrapper').css('opacity', '1');
    }

    /**
     * Debug - Afficher le statut des filtres
     */
    function debugFilterStatus() {
        console.log('📊 État initial des filtres:', artikaFilters);
        console.log('🔧 Configuration AJAX:', {
            url: artikaFiltersData.ajaxUrl,
            nonce: artikaFiltersData.nonce ? '✅ Présent' : '❌ Manquant'
        });
    }

})(jQuery);
