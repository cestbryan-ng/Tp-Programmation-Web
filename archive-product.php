<?php
/**
 * The Template for displaying product archives
 * 
 */

/**
 * Template pour l'archive des produits
 */

get_header('shop'); ?>

<div class="container">
    <?php 
    // Déterminer le type de page pour les filtres appropriés
    $page_type = 'default';
    
    if (is_product_category()) {
        $current_cat = get_queried_object();
        $cat_slug = isset($current_cat->slug) ? $current_cat->slug : '';
        $cat_id = isset($current_cat->term_id) ? $current_cat->term_id : 0;
        
        // Vérifier si c'est une sous-catégorie de Dessins
        $dessins_cat_ids = array();
        $dessins_slugs = array('dessin-portrait', 'dessin-rue', 'dessin-eau', 'dessins');
        
        if (in_array($cat_slug, $dessins_slugs)) {
            $page_type = 'dessins';
        } elseif (in_array($cat_slug, array('pop-art', 'art-abstrait', 'paysage', 'peintures'))) {
            $page_type = 'peintures';
        } elseif (in_array($cat_slug, array('toiles', 'pinceaux', 'pots-peinture', 'accessoires'))) {
            $page_type = 'accessoires';
        }
        
        // Alternative : vérifier par parent category
        if ($page_type === 'default' && $cat_id) {
            $parent_id = wp_get_post_parent_id($cat_id);
            $parent_cat = get_term($parent_id);
            
            if ($parent_cat && !is_wp_error($parent_cat)) {
                $parent_slug = $parent_cat->slug;
                
                if ($parent_slug === 'dessins' || $parent_slug === 'dessin-portrait') {
                    $page_type = 'dessins';
                } elseif ($parent_slug === 'peintures') {
                    $page_type = 'peintures';
                } elseif ($parent_slug === 'accessoires') {
                    $page_type = 'accessoires';
                }
            }
        }
    }
    
    // Afficher les filtres
    artika_display_filters($page_type);
    ?>
    
    <?php if (woocommerce_product_loop()) : ?>
        
        <?php woocommerce_product_loop_start(); ?>
        
        <?php while (have_posts()) : the_post(); ?>
            <?php wc_get_template_part('content', 'product'); ?>
        <?php endwhile; ?>
        
        <?php woocommerce_product_loop_end(); ?>
        
    <?php else : ?>
        
        <div class="artika-no-products">
            <p>Aucun produit trouvé.</p>
        </div>
        
    <?php endif; ?>
</div>

<?php get_footer('shop'); ?><?php
defined('ABSPATH') || exit;

// 'shop' est un bon paramètre, il permet de charger header-shop.php si vous en avez un
get_header('shop'); 
?>

    <div class="promo-banner">
        <p><?php echo get_theme_mod('promo_banner_text', 'Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.'); ?></p>
    </div>

    <div class="main-container">
        <div class="filter-trigger-wrapper">
            <button class="filter-trigger-btn" id="filterTriggerBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 4h16M6 10h8M9 16h2" stroke-linecap="round"/>
                </svg>
                <span><?php _e('Filtres', 'artika'); ?></span>
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
                    <span><?php _e('RÉDUIRE LES FILTRES', 'artika'); ?></span>
                    <span class="results-count" id="resultsCount">
                        (<?php 
                        $total_products = wc_get_loop_prop('total');
                        printf(_n('%d produit', '%d produits', $total_products, 'artika'), $total_products);
                        ?>)
                    </span>
                </button>
                <button class="reset-filters-btn" id="resetFiltersBtn" style="display: none;">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor">
                        <path d="M12 4L4 12M4 4l8 8" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <?php _e('Réinitialiser', 'artika'); ?>
                </button>
            </div>
            
            <div class="filter-content" id="filterContent">
                <div class="filter-sections">
                    
                    <?php if (is_active_sidebar('shop-sidebar')) : ?>
                        <?php dynamic_sidebar('shop-sidebar'); ?>
                    <?php else : ?>
                        <p><?php _e('Veuillez ajouter des widgets de filtre à la "Shop Sidebar" dans Apparence > Widgets.', 'artika'); ?></p>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>

        <div class="gallery-wrapper">
            <?php if (woocommerce_product_loop()) : ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php if (wc_get_loop_prop('total')) : ?>
                    <div class="gallery" id="gallery">
                        <?php
                        while (have_posts()) {
                            the_post();
                            global $product;
                        ?>
                        <div class="product-card">
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo woocommerce_get_product_thumbnail(); ?>
                                </a>
                                <?php if ($product->is_on_sale()) : ?>
                                    <span class="product-badge">
                                        <?php 
                                        $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
                                        echo '-' . $percentage . '%';
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <h4 class="product-name">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <p class="product-artist"><?php echo get_post_meta(get_the_ID(), '_artist_name', true); ?></p>
                                <p class="product-price"><?php echo $product->get_price_html(); ?></p>
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php woocommerce_pagination(); ?>

            <?php else : ?>
                <p class="woocommerce-info"><?php _e('Aucun produit trouvé.', 'artika'); ?></p>
            <?php endif; ?>
        </div>
    </div>

<?php
get_footer('shop');
?>