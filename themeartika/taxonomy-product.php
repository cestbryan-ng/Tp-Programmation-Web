<?php
/**
 * Template pour afficher une catégorie de produits spécifique
 * Utilisé pour Art Abstrait, Peinture Paysage, Pop Art, etc.
 * Même design que la page popArt
 */

get_header();

// Récupérer la catégorie actuelle
$current_category = get_queried_object();
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
                        $image_id = $product->get_image_id();
                        
                        if ($image_id) {
                            echo wp_get_attachment_image($image_id, 'woocommerce_thumbnail', false, array(
                                'alt' => get_the_title(),
                                'class' => 'artwork-image'
                            ));
                        } elseif (has_post_thumbnail()) {
                            the_post_thumbnail('woocommerce_thumbnail', array(
                                'alt' => get_the_title(),
                                'class' => 'artwork-image'
                            ));
                        } else {
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
                            <!-- Bouton Ajouter au panier dans l'overlay -->
                            <button class="btn-add-cart-overlay ajax_add_to_cart" data-product_id="<?php echo $product->get_id(); ?>" onclick="event.preventDefault(); event.stopPropagation();">
                                Ajouter au panier
                            </button>
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
            
            <?php woocommerce_pagination(); ?>
            
        <?php else : ?>
            
            <p>Aucun produit trouvé dans cette catégorie.</p>
            
        <?php endif; ?>
    </div>
</div>

<style>
/* Styles identiques à popArt */
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

.artwork-image-wrapper {
    position: relative !important;
    width: 100% !important;
    padding-top: 125% !important;
    overflow: hidden !important;
    background: #f5f5f5 !important;
}

.artwork-card {
    opacity: 1 !important;
    visibility: visible !important;
}

/* Bouton Ajouter au panier dans l'overlay */
.btn-add-cart-overlay {
    margin-top: 15px;
    padding: 12px 24px;
    background: white;
    color: #1a1a1a;
    border: none;
    border-radius: 25px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-add-cart-overlay:hover {
    background: #1a1a1a;
    color: white;
    transform: translateY(-2px);
}

.btn-add-cart-overlay:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Notification d'ajout au panier */
.notification {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #2ecc71;
    color: white;
    padding: 16px 24px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    font-size: 15px;
    font-weight: 500;
    z-index: 10000;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.notification.show {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
// Script pour gérer les filtres
jQuery(document).ready(function($) {
    console.log('Script filtres chargé');
    
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
        $('input[type="checkbox"]').on('change', applyFilters);
        $('#priceApplyBtn').on('click', applyFilters);
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
        
        window.location.href = url.toString();
    }
    
    console.log('Filtres initialisés avec succès');
});
</script>

<?php get_footer(); ?>