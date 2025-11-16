<?php
/**
 * Template pour afficher les produits (boutique)
 * Reprend le design de popArt.html avec les filtres
 */

get_header();
?>

<!-- CONTENEUR PRINCIPAL -->
<div class="main-container">
    
    <!-- BOUTON ENCOCHE FILTRES -->
    <div class="filter-trigger-wrapper">
        <button class="filter-trigger-btn" id="filterTriggerBtn">
            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 4h16M6 10h8M9 16h2" stroke-linecap="round"/>
            </svg>
            <span>Filtres</span>
            <svg class="chevron" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6l4 4 4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <!-- BANNIÈRE DE FILTRES -->
    <div class="filter-banner collapsed" id="filterBanner">
        <div class="filter-banner-header">
            <button class="filter-toggle-btn" id="filterToggleBtn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 4h16M2 10h10M2 16h6" stroke-linecap="round"/>
                </svg>
                <span>RÉDUIRE LES FILTRES</span>
                <span class="results-count" id="resultsCount">
                    (<?php echo wc_get_loop_prop('total'); ?> produits)
                </span>
            </button>
        </div>
        
        <div class="filter-content" id="filterContent">
            <div class="filter-sections">
                
                <!-- TAILLE -->
                <div class="filter-group">
                    <h3 class="filter-group-title">TAILLE</h3>
                    <div class="filter-options">
                        <?php
                        // Récupérer les termes de l'attribut "taille"
                        $tailles = get_terms(array(
                            'taxonomy' => 'pa_taille',
                            'hide_empty' => true,
                        ));
                        
                        if (!empty($tailles)) :
                            foreach ($tailles as $taille) :
                        ?>
                        <label class="filter-option">
                            <input type="checkbox" name="size" value="<?php echo esc_attr($taille->slug); ?>" 
                                <?php echo (isset($_GET['filter_taille']) && in_array($taille->slug, explode(',', $_GET['filter_taille']))) ? 'checked' : ''; ?>>
                            <span><?php echo esc_html($taille->name); ?></span>
                        </label>
                        <?php
                            endforeach;
                        else :
                            // Filtres par défaut si l'attribut n'existe pas encore
                        ?>
                        <label class="filter-option">
                            <input type="checkbox" name="size" value="petit">
                            <span>Petit (&lt; 50×70 cm)</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="size" value="moyen">
                            <span>Moyen (50×70 - 70×90 cm)</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="size" value="grand">
                            <span>Grand (&gt; 70×90 cm)</span>
                        </label>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- TECHNIQUE -->
                <div class="filter-group">
                    <h3 class="filter-group-title">TECHNIQUE</h3>
                    <div class="filter-options">
                        <?php
                        // Récupérer les termes de l'attribut "technique"
                        $techniques = get_terms(array(
                            'taxonomy' => 'pa_technique',
                            'hide_empty' => true,
                        ));
                        
                        if (!empty($techniques)) :
                            foreach ($techniques as $technique) :
                        ?>
                        <label class="filter-option">
                            <input type="checkbox" name="technique" value="<?php echo esc_attr($technique->slug); ?>"
                                <?php echo (isset($_GET['filter_technique']) && in_array($technique->slug, explode(',', $_GET['filter_technique']))) ? 'checked' : ''; ?>>
                            <span><?php echo esc_html($technique->name); ?></span>
                        </label>
                        <?php
                            endforeach;
                        else :
                        ?>
                        <label class="filter-option">
                            <input type="checkbox" name="technique" value="portrait">
                            <span>Portrait</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="technique" value="serigraphie">
                            <span>Sérigraphie</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="technique" value="lithographie">
                            <span>Lithographie</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="technique" value="estampe">
                            <span>Estampe</span>
                        </label>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- PRIX -->
                <div class="filter-group">
                    <h3 class="filter-group-title">PRIX</h3>
                    <div class="price-filter-wrapper">
                        <div class="price-inputs">
                            <div class="price-input-group">
                                <label>De</label>
                                <input type="number" id="priceMin" placeholder="0" min="0" step="10000" 
                                    value="<?php echo isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : ''; ?>">
                                <span>FCFA</span>
                            </div>
                            <div class="price-input-group">
                                <label>À</label>
                                <input type="number" id="priceMax" placeholder="500000" min="0" step="10000"
                                    value="<?php echo isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : ''; ?>">
                                <span>FCFA</span>
                            </div>
                        </div>
                        <button class="price-apply-btn" id="priceApplyBtn">APPLIQUER</button>
                    </div>
                </div>
                
                <!-- COULEUR -->
                <div class="filter-group">
                    <h3 class="filter-group-title">COULEUR</h3>
                    <div class="color-options">
                        <?php
                        $colors = array(
                            'beige' => '#F5F5DC',
                            'noir' => '#000000',
                            'bleu' => '#3498db',
                            'marron' => '#8B4513',
                            'vert' => '#2ecc71',
                            'gris' => '#95a5a6',
                            'orange' => '#e67e22',
                            'rose' => '#ff69b4',
                            'rouge' => '#e74c3c',
                            'blanc' => '#ffffff',
                            'jaune' => '#f1c40f'
                        );
                        
                        foreach ($colors as $color_name => $color_hex) :
                        ?>
                        <label class="color-option" title="<?php echo ucfirst($color_name); ?>">
                            <input type="checkbox" name="color" value="<?php echo esc_attr($color_name); ?>"
                                <?php echo (isset($_GET['filter_color']) && in_array($color_name, explode(',', $_GET['filter_color']))) ? 'checked' : ''; ?>>
                            <span class="color-circle" style="background-color: <?php echo esc_attr($color_hex); ?>; <?php echo $color_name === 'blanc' ? 'border: 1px solid #ddd;' : ''; ?>"></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- GALERIE -->
    <div class="gallery-wrapper">
        <?php if (woocommerce_product_loop()) : ?>
            
            <div class="gallery" id="gallery">
                <?php
                while (have_posts()) : the_post();
                    global $product;
                ?>
                
                <a href="<?php the_permalink(); ?>" class="artwork-card">
                    <div class="artwork-image-wrapper">
                        <?php 
                        // Récupérer l'image du produit de manière plus explicite
                        $image_id = $product->get_image_id();
                        
                        if ($image_id) {
                            // Afficher l'image avec la bonne taille
                            echo wp_get_attachment_image($image_id, 'woocommerce_thumbnail', false, array(
                                'alt' => get_the_title(),
                                'class' => 'artwork-image'
                            ));
                        } elseif (has_post_thumbnail()) {
                            // Fallback : utiliser l'image à la une
                            the_post_thumbnail('woocommerce_thumbnail', array(
                                'alt' => get_the_title(),
                                'class' => 'artwork-image'
                            ));
                        } else {
                            // Image par défaut si aucune image n'existe
                            echo '<img src="' . wc_placeholder_img_src('woocommerce_thumbnail') . '" alt="' . get_the_title() . '" class="artwork-image">';
                        }
                        ?>
                        
                        <?php if ($product->is_on_sale()) : ?>
                            <span class="artwork-badge">Promo</span>
                        <?php elseif ($product->is_featured()) : ?>
                            <span class="artwork-badge">Best-seller</span>
                        <?php endif; ?>
                        
                        <div class="artwork-overlay">
                            <div class="overlay-artist">
                                <?php 
                                $artist = get_post_meta(get_the_ID(), '_artist_name', true);
                                echo $artist ? esc_html($artist) : '';
                                ?>
                            </div>
                            <div class="overlay-price"><?php echo $product->get_price_html(); ?></div>
                        </div>
                    </div>
                    <div class="artwork-info">
                        <h3 class="artwork-title"><?php the_title(); ?></h3>
                        <p class="artwork-dimensions">
                            <?php 
                            $dimensions = get_post_meta(get_the_ID(), '_dimensions', true);
                            echo $dimensions ? esc_html($dimensions) : '';
                            ?>
                        </p>
                    </div>
                </a>
                
                <?php
                endwhile;
                ?>
            </div>
            
            <?php
            // Pagination
            woocommerce_pagination();
            ?>
            
        <?php else : ?>
            
            <p>Aucun produit trouvé.</p>
            
        <?php endif; ?>
    </div>
</div>

<style>
/* Styles spécifiques pour corriger l'affichage des images */
.artwork-image-wrapper img.artwork-image,
.artwork-image-wrapper .attachment-woocommerce_thumbnail,
.artwork-image-wrapper .wp-post-image {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* S'assurer que le wrapper a la bonne taille */
.artwork-image-wrapper {
    position: relative !important;
    width: 100% !important;
    padding-top: 125% !important;
    overflow: hidden !important;
    background: #f5f5f5 !important;
}

/* Empêcher JavaScript de cacher les images */
.artwork-card {
    opacity: 1 !important;
    visibility: visible !important;
}

/* Animation au chargement */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.artwork-card {
    animation: fadeIn 0.5s ease-out;
    animation-fill-mode: forwards !important;
}
</style>

<script>
// Script pour gérer les filtres - Version WordPress
// Les images sont déjà chargées par PHP, on ne les recharge PAS en JavaScript

jQuery(document).ready(function($) {
    console.log('Script filtres chargé');
    
    // Vérifier que les images sont bien là
    const images = $('.artwork-image-wrapper img');
    console.log('Nombre d\'images trouvées:', images.length);
    
    // Si des images manquent, les afficher manuellement
    images.each(function() {
        if (!$(this).attr('src') || $(this).attr('src') === '') {
            console.error('Image sans src trouvée:', this);
        }
    });
    
    // Initialisation des filtres
    initializeFilterTrigger();
    initializeFilters();
    
    function initializeFilterTrigger() {
        $('#filterTriggerBtn').on('click', function(e) {
            e.preventDefault();
            const filterBanner = $('#filterBanner');
            const isCollapsed = filterBanner.hasClass('collapsed');
            
            if (isCollapsed) {
                filterBanner.removeClass('collapsed');
                $(this).addClass('active');
            } else {
                filterBanner.addClass('collapsed');
                $(this).removeClass('active');
            }
        });
        
        $('#filterToggleBtn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const filterBanner = $('#filterBanner');
            filterBanner.toggleClass('inner-collapsed');
            
            const isCollapsed = filterBanner.hasClass('inner-collapsed');
            const textSpan = $(this).find('span').first();
            if (textSpan.length) {
                textSpan.text(isCollapsed ? 'AFFICHER LES FILTRES' : 'RÉDUIRE LES FILTRES');
            }
        });
    }
    
    function initializeFilters() {
        // Gérer les changements de filtres
        $('input[type="checkbox"]').on('change', applyFilters);
        $('#priceApplyBtn').on('click', applyFilters);
        $('#resetFiltersBtn').on('click', resetFilters);
    }
    
    function applyFilters() {
        const url = new URL(window.location);
        
        // Filtres taille
        const sizes = [];
        $('input[name="size"]:checked').each(function() {
            sizes.push($(this).val());
        });
        if (sizes.length > 0) {
            url.searchParams.set('filter_taille', sizes.join(','));
        } else {
            url.searchParams.delete('filter_taille');
        }
        
        // Filtres technique
        const techniques = [];
        $('input[name="technique"]:checked').each(function() {
            techniques.push($(this).val());
        });
        if (techniques.length > 0) {
            url.searchParams.set('filter_technique', techniques.join(','));
        } else {
            url.searchParams.delete('filter_technique');
        }
        
        // Filtres couleur
        const colors = [];
        $('input[name="color"]:checked').each(function() {
            colors.push($(this).val());
        });
        if (colors.length > 0) {
            url.searchParams.set('filter_color', colors.join(','));
        } else {
            url.searchParams.delete('filter_color');
        }
        
        // Filtre prix
        const minPrice = $('#priceMin').val();
        const maxPrice = $('#priceMax').val();
        if (minPrice) {
            url.searchParams.set('min_price', minPrice);
        } else {
            url.searchParams.delete('min_price');
        }
        if (maxPrice) {
            url.searchParams.set('max_price', maxPrice);
        } else {
            url.searchParams.delete('max_price');
        }
        
        // Recharger la page avec les nouveaux filtres
        window.location.href = url.toString();
    }
    
    function resetFilters() {
        // Rediriger vers la page sans paramètres
        window.location.href = window.location.pathname;
    }
    
    console.log('Filtres initialisés avec succès');
});
</script>

<?php get_footer(); ?>