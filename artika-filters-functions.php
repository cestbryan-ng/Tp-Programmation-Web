<?php
/**
 * ARTIKA FILTERS - Fonctions Backend VERSION FINALE
 * Gestion des filtres WooCommerce
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue des scripts et styles pour les filtres Artika
 */
function artika_enqueue_filter_assets() {
    // Vérifier qu'on est sur une page de produits
    if (!is_shop() && !is_product_category() && !is_product_tag()) {
        return;
    }
    
    // CSS
    wp_enqueue_style(
        'artika-filters',
        get_template_directory_uri() . '/assets/css/artika-filters.css',
        array(),
        '1.0.2'
    );
    
    // JavaScript
    wp_enqueue_script(
        'artika-filters',
        get_template_directory_uri() . '/assets/js/artika-filters.js',
        array('jquery'),
        '1.0.2',
        true
    );
    
    // Localiser le script
    wp_localize_script('artika-filters', 'artikaFiltersData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('artika_filter_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'artika_enqueue_filter_assets');

/**
 * Afficher le système de filtres
 */
function artika_display_filters($page_type = 'default') {
    ?>
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

    <div class="filter-banner collapsed" id="filterBanner">
        <div class="filter-banner-header">
            <button class="filter-toggle-btn" id="filterToggleBtn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 4h16M2 10h10M2 16h6" stroke-linecap="round"/>
                </svg>
                <span>RÉDUIRE LES FILTRES</span>
                <span class="results-count" id="resultsCount">
                    (<?php 
                    $total_products = wc_get_loop_prop('total');
                    if (!$total_products) {
                        $total_products = artika_get_product_count();
                    }
                    printf(_n('%d produit', '%d produits', $total_products, 'artika'), $total_products);
                    ?>)
                </span>
            </button>
            <button class="reset-filters-btn" id="resetFiltersBtn" style="display: none;">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor">
                    <path d="M12 4L4 12M4 4l8 8" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Réinitialiser
            </button>
        </div>
        
        <div class="filter-content" id="filterContent">
            <div class="filter-sections">
                <?php 
                // Afficher les filtres selon le type de page
                switch ($page_type) {
                    case 'peintures':
                        artika_display_peintures_filters();
                        break;
                    case 'dessins':
                        artika_display_dessins_filters();
                        break;
                    case 'accessoires':
                        artika_display_accessoires_filters();
                        break;
                    default:
                        artika_display_default_filters();
                        break;
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="artika-filter-loader" style="display: none;">
        <p>Chargement des produits...</p>
    </div>
    <?php
}

/**
 * Filtres pour les dessins
 */
function artika_display_dessins_filters() {
    ?>
    <!-- TAILLE -->
    <div class="filter-group">
        <h3 class="filter-group-title">TAILLE</h3>
        <div class="filter-options">
            <label class="filter-option">
                <input type="checkbox" name="size" value="petit">
                <span>Petit (< 30×40 cm)</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="size" value="moyen">
                <span>Moyen (30×40 - 50×70 cm)</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="size" value="grand">
                <span>Grand (> 50×70 cm)</span>
            </label>
        </div>
    </div>

    <!-- TECHNIQUE -->
    <div class="filter-group">
        <h3 class="filter-group-title">TECHNIQUE</h3>
        <div class="filter-options">
            <label class="filter-option">
                <input type="checkbox" name="technique" value="realiste">
                <span>Réaliste</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="technique" value="noir-blanc">
                <span>Noir et blanc</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="technique" value="couleur">
                <span>Couleur</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="technique" value="abstrait">
                <span>Abstrait</span>
            </label>
        </div>
    </div>
     
    <?php artika_display_price_filter(); ?>
    <?php artika_display_color_filter(); ?>
    <?php
}

/**
 * Filtres pour les peintures
 */
function artika_display_peintures_filters() {
    ?>
    <!-- TAILLE -->
    <div class="filter-group">
        <h3 class="filter-group-title">TAILLE</h3>
        <div class="filter-options">
            <label class="filter-option">
                <input type="checkbox" name="size" value="petit">
                <span>Petit (< 50×70 cm)</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="size" value="moyen">
                <span>Moyen (50×70 - 70×90 cm)</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="size" value="grand">
                <span>Grand (> 70×90 cm)</span>
            </label>
        </div>
    </div>
    
    <!-- TECHNIQUE -->
    <div class="filter-group">
        <h3 class="filter-group-title">TECHNIQUE</h3>
        <div class="filter-options">
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
        </div>
    </div>
    
    <?php artika_display_price_filter(); ?>
    <?php artika_display_color_filter(); ?>
    <?php
}

/**
 * Filtres pour les accessoires
 */
function artika_display_accessoires_filters() {
    ?>
    <!-- CATÉGORIE -->
    <div class="filter-group">
        <h3 class="filter-group-title">CATÉGORIE</h3>
        <div class="filter-options">
            <label class="filter-option">
                <input type="checkbox" name="artika_category" value="toiles">
                <span>Toiles</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="artika_category" value="pinceaux">
                <span>Pinceaux</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="artika_category" value="peinture">
                <span>Pots de peinture</span>
            </label>
        </div>
    </div>
    
    <?php artika_display_price_filter(); ?>
    <?php artika_display_color_filter(); ?>
    <?php
}

/**
 * Filtres par défaut
 */
function artika_display_default_filters() {
    ?>
    <!-- TAILLE -->
    <div class="filter-group">
        <h3 class="filter-group-title">TAILLE</h3>
        <div class="filter-options">
            <label class="filter-option">
                <input type="checkbox" name="size" value="petit">
                <span>Petit</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="size" value="moyen">
                <span>Moyen</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="size" value="grand">
                <span>Grand</span>
            </label>
        </div>
    </div>
    
    <!-- TECHNIQUE -->
    <div class="filter-group">
        <h3 class="filter-group-title">TECHNIQUE</h3>
        <div class="filter-options">
            <label class="filter-option">
                <input type="checkbox" name="technique" value="realiste">
                <span>Réaliste</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="technique" value="abstrait">
                <span>Abstrait</span>
            </label>
            <label class="filter-option">
                <input type="checkbox" name="technique" value="couleur">
                <span>Couleur</span>
            </label>
        </div>
    </div>
    
    <?php 
    artika_display_price_filter();
    artika_display_color_filter();
}

/**
 * Filtre de prix
 */
function artika_display_price_filter() {
    ?>
    <div class="filter-group">
        <h3 class="filter-group-title">PRIX</h3>
        <div class="price-filter-wrapper">
            <div class="price-inputs">
                <div class="price-input-group">
                    <label>De</label>
                    <input type="number" id="priceMin" placeholder="0" min="0" step="1000">
                    <span>FCFA</span>
                </div>
                <div class="price-input-group">
                    <label>À</label>
                    <input type="number" id="priceMax" placeholder="500000" min="0" step="1000">
                    <span>FCFA</span>
                </div>
            </div>
            <button class="price-apply-btn" id="priceApplyBtn">APPLIQUER</button>
        </div>
    </div>
    <?php
}

/**
 * Filtre de couleur
 */
function artika_display_color_filter() {
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
    ?>
    <div class="filter-group">
        <h3 class="filter-group-title">COULEUR</h3>
        <div class="color-options">
            <?php foreach ($colors as $name => $hex): ?>
                <label class="color-option" title="<?php echo ucfirst($name); ?>">
                    <input type="checkbox" name="color" value="<?php echo $name; ?>">
                    <span class="color-circle" style="background-color: <?php echo $hex; ?><?php echo $name === 'blanc' ? '; border: 1px solid #ddd' : ''; ?>;"></span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

/**
 * Obtenir le nombre de produits
 */
function artika_get_product_count() {
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    
    if (is_product_category()) {
        $current_cat = get_queried_object();
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $current_cat->term_id
            )
        );
    }
    
    $query = new WP_Query($args);
    return $query->found_posts;
}

/**
 * AJAX Handler - Filtrage des produits
 */
function artika_ajax_filter_products() {
    // Vérification du nonce
    check_ajax_referer('artika_filter_nonce', 'nonce');
    
    // Récupérer les filtres
    $filters = isset($_POST['filters']) ? $_POST['filters'] : array();
    
    // Log pour debug
    error_log('ARTIKA FILTERS - Filtres reçus: ' . print_r($filters, true));
    
    // Construire la requête WooCommerce
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => array('relation' => 'AND'),
        'tax_query' => array('relation' => 'AND')
    );
    
    // Conserver la catégorie actuelle
    if (is_product_category()) {
        $current_cat = get_queried_object();
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $current_cat->term_id
        );
    }
    
    // Filtre de prix
    if (!empty($filters['priceMin']) || !empty($filters['priceMax'])) {
        $price_meta = array(
            'key' => '_price',
            'type' => 'NUMERIC'
        );
        
        if (!empty($filters['priceMin']) && !empty($filters['priceMax'])) {
            $price_meta['value'] = array($filters['priceMin'], $filters['priceMax']);
            $price_meta['compare'] = 'BETWEEN';
        } elseif (!empty($filters['priceMin'])) {
            $price_meta['value'] = $filters['priceMin'];
            $price_meta['compare'] = '>=';
        } elseif (!empty($filters['priceMax'])) {
            $price_meta['value'] = $filters['priceMax'];
            $price_meta['compare'] = '<=';
        }
        
        $args['meta_query'][] = $price_meta;
    }
    
    // Filtres par attributs
    $filter_mapping = array(
        'sizes' => 'pa_taille',
        'techniques' => 'pa_technique',
        'colors' => 'pa_couleur',
        'categories' => 'product_cat'
    );
    
    foreach ($filter_mapping as $filter_key => $taxonomy) {
        if (!empty($filters[$filter_key]) && is_array($filters[$filter_key])) {
            $args['tax_query'][] = array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $filters[$filter_key],
                'operator' => 'IN'
            );
        }
    }
    
    // Log la requête
    error_log('ARTIKA FILTERS - Args de requête: ' . print_r($args, true));
    
    // Exécuter la requête
    $query = new WP_Query($args);
    
    // Générer le HTML des produits
    ob_start();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            ?>
            <a href="<?php the_permalink(); ?>" class="artwork-card">
                <div class="artwork-image">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                    <?php if ($product->is_on_sale()) : ?>
                        <span class="badge">
                            <?php 
                            $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
                            echo '-' . $percentage . '%';
                            ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="artwork-info">
                    <div class="artist-name"><?php the_title(); ?></div>
                    <div class="artwork-title">
                        <?php 
                        $artist = get_post_meta(get_the_ID(), '_artist_name', true);
                        if ($artist) {
                            echo 'Par ' . esc_html($artist);
                        }
                        ?>
                    </div>
                    <div class="price"><?php echo $product->get_price_html(); ?></div>
                </div>
            </a>
            <?php
        }
    } else {
        echo '<div class="artika-no-products"><p>Aucun produit ne correspond à vos critères.</p></div>';
    }
    
    $html = ob_get_clean();
    wp_reset_postdata();
    
    // Log le résultat
    error_log('ARTIKA FILTERS - Produits trouvés: ' . $query->found_posts);
    
    // Retourner la réponse
    wp_send_json_success(array(
        'html' => $html,
        'count' => $query->found_posts
    ));
}
add_action('wp_ajax_artika_filter_products', 'artika_ajax_filter_products');
add_action('wp_ajax_nopriv_artika_filter_products', 'artika_ajax_filter_products');