<?php
/**
 * Fichier functions.php du thème Artika
 * Ce fichier configure ton thème WordPress et intègre WooCommerce
 */

// Empêcher l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// 1. Support de WooCommerce
function artika_add_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'artika_add_woocommerce_support');

// 2. Charger les styles CSS
function artika_enqueue_styles() {
    // Style principal
    wp_enqueue_style('artika-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Tes fichiers CSS existants
    wp_enqueue_style('artika-accueil', get_template_directory_uri() . '/assets/css/accueil.css', array(), '1.0.0');
    wp_enqueue_style('artika-popart', get_template_directory_uri() . '/assets/css/popArt.css', array(), '1.0.0');
    wp_enqueue_style('artika-popart2', get_template_directory_uri() . '/assets/css/popArt2.css', array(), '1.0.0');
    
    // CSS inline pour corriger l'affichage des images produits
    $custom_css = "
        .woocommerce .products .product img,
        .artwork-image-wrapper img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            display: block !important;
        }
        
        .woocommerce ul.products li.product .woocommerce-loop-product__link img {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
        }
        
        /* Fix pour les images qui ne s'affichent pas */
        .artwork-card img {
            max-width: 100% !important;
            height: auto !important;
            display: block !important;
        }
        
        .artwork-image-wrapper {
            background-color: #f5f5f5 !important;
        }
        
        /* Fix pour la bannière qui couvre le header */
        .promo-banner {
            position: relative !important;
            z-index: 999 !important;
        }
        
        .header {
            position: sticky !important;
            top: 0 !important;
            z-index: 1000 !important;
            margin-top: 0 !important;
        }
        
        /* Ajouter de l'espace en haut du contenu pour compenser le header fixe */
        body:not(.home) .main-container,
        body:not(.home) .hero,
        body:not(.home) .collections {
            margin-top: 140px !important;
        }
        
        body.home .hero {
            margin-top: 110px !important;
        }
    ";
    wp_add_inline_style('artika-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'artika_enqueue_styles');

// 3. Charger les scripts JavaScript
function artika_enqueue_scripts() {
    // Ton fichier JavaScript pour la page d'accueil
    wp_enqueue_script('artika-accueil', get_template_directory_uri() . '/assets/js/accueil.js', array('jquery'), '1.0.0', true);
    
    // NE PAS charger popArt2.js sur toutes les pages
    // Il interfère avec l'affichage des images sur la page boutique
    // Le JavaScript nécessaire pour les filtres est maintenant dans archive-product.php
    
    // Passer des données PHP à JavaScript (utile pour le panier)
    wp_localize_script('artika-accueil', 'artika_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('artika_nonce'),
        'cart_url' => wc_get_cart_url()
    ));
}
add_action('wp_enqueue_scripts', 'artika_enqueue_scripts');

// Ajouter un script pour gérer l'ajout au panier via AJAX partout
function artika_add_cart_scripts() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Mise à jour du compteur de panier
        function updateCartCount() {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'get_cart_count'
                },
                success: function(response) {
                    if (response.success) {
                        $('.cart-count').text(response.data.count);
                    }
                }
            });
        }
        
        // Gestion de l'ajout au panier via AJAX
        $(document).on('click', '.ajax_add_to_cart', function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var product_id = $button.data('product_id');
            
            $button.text('Ajout...').prop('disabled', true);
            
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'add_to_cart_ajax',
                    product_id: product_id
                },
                success: function(response) {
                    if (response.success) {
                        $button.text('Ajouté !');
                        updateCartCount();
                        
                        // Afficher une notification
                        var notification = $('<div class="notification show">Produit ajouté au panier !</div>');
                        $('body').append(notification);
                        
                        setTimeout(function() {
                            notification.removeClass('show');
                            setTimeout(function() {
                                notification.remove();
                            }, 300);
                        }, 2000);
                        
                        setTimeout(function() {
                            $button.text('Ajouter au panier').prop('disabled', false);
                        }, 2000);
                    }
                },
                error: function() {
                    $button.text('Erreur').prop('disabled', false);
                    setTimeout(function() {
                        $button.text('Ajouter au panier').prop('disabled', false);
                    }, 2000);
                }
            });
        });
        
        // Mise à jour initiale du compteur
        updateCartCount();
    });
    </script>
    <?php
}
add_action('wp_footer', 'artika_add_cart_scripts');

// AJAX : Obtenir le nombre d'articles dans le panier
function artika_get_cart_count() {
    wp_send_json_success(array(
        'count' => WC()->cart->get_cart_contents_count()
    ));
}
add_action('wp_ajax_get_cart_count', 'artika_get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'artika_get_cart_count');

// AJAX : Ajouter au panier
function artika_add_to_cart_ajax() {
    $product_id = intval($_POST['product_id']);
    
    if ($product_id) {
        WC()->cart->add_to_cart($product_id);
        wp_send_json_success(array(
            'count' => WC()->cart->get_cart_contents_count()
        ));
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_add_to_cart_ajax', 'artika_add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart_ajax', 'artika_add_to_cart_ajax');

// 4. Enregistrer les menus de navigation
function artika_register_menus() {
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'artika'),
        'footer' => __('Menu Footer', 'artika')
    ));
}
add_action('init', 'artika_register_menus');

// 5. Configuration du logo
function artika_custom_logo_setup() {
    $defaults = array(
        'height' => 35,
        'width' => 120,
        'flex-height' => true,
        'flex-width' => true,
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'artika_custom_logo_setup');

// 6. Enregistrer les zones de widgets (pour le footer par exemple)
function artika_widgets_init() {
    register_sidebar(array(
        'name' => __('Footer 1', 'artika'),
        'id' => 'footer-1',
        'description' => __('Zone de widget pour la première colonne du footer', 'artika'),
        'before_widget' => '<div class="footer-column">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer 2', 'artika'),
        'id' => 'footer-2',
        'description' => __('Zone de widget pour la deuxième colonne du footer', 'artika'),
        'before_widget' => '<div class="footer-column">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'artika_widgets_init');

// 7. Ajouter des attributs personnalisés pour les filtres WooCommerce
function artika_register_product_attributes() {
    // Taille
    if (!taxonomy_exists('pa_taille')) {
        wc_create_attribute(array(
            'name' => 'Taille',
            'slug' => 'taille',
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ));
    }
    
    // Technique
    if (!taxonomy_exists('pa_technique')) {
        wc_create_attribute(array(
            'name' => 'Technique',
            'slug' => 'technique',
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ));
    }
}
add_action('init', 'artika_register_product_attributes');

// 8. Modifier l'affichage des produits WooCommerce (garder le même style)
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

// 9. Personnaliser le nombre de produits par page
function artika_products_per_page() {
    return 12; // Comme dans ton design
}
add_filter('loop_shop_per_page', 'artika_products_per_page', 20);

// 10. Personnaliser les colonnes de la grille produits
function artika_loop_columns() {
    return 4; // 4 colonnes comme dans ton design
}
add_filter('loop_shop_columns', 'artika_loop_columns');

// 11. Support des images à la une
add_theme_support('post-thumbnails');

// 12. Support du titre dynamique
add_theme_support('title-tag');

// 13. Support HTML5
add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
));

// 14. Ajouter des filtres personnalisés pour WooCommerce
function artika_product_query_filters($query) {
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        $meta_query = array();
        
        // Filtre par prix
        if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
            $meta_query[] = array(
                'key' => '_price',
                'value' => intval($_GET['min_price']),
                'compare' => '>=',
                'type' => 'NUMERIC'
            );
        }
        
        if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
            $meta_query[] = array(
                'key' => '_price',
                'value' => intval($_GET['max_price']),
                'compare' => '<=',
                'type' => 'NUMERIC'
            );
        }
        
        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
        
        // Filtres par attributs (taille, technique, couleur)
        $tax_query = array();
        
        if (isset($_GET['filter_taille']) && !empty($_GET['filter_taille'])) {
            $tailles = explode(',', $_GET['filter_taille']);
            $tax_query[] = array(
                'taxonomy' => 'pa_taille',
                'field' => 'slug',
                'terms' => $tailles,
                'operator' => 'IN'
            );
        }
        
        if (isset($_GET['filter_technique']) && !empty($_GET['filter_technique'])) {
            $techniques = explode(',', $_GET['filter_technique']);
            $tax_query[] = array(
                'taxonomy' => 'pa_technique',
                'field' => 'slug',
                'terms' => $techniques,
                'operator' => 'IN'
            );
        }
        
        if (isset($_GET['filter_color']) && !empty($_GET['filter_color'])) {
            $colors = explode(',', $_GET['filter_color']);
            $tax_query[] = array(
                'taxonomy' => 'pa_couleur',
                'field' => 'slug',
                'terms' => $colors,
                'operator' => 'IN'
            );
        }
        
        if (!empty($tax_query)) {
            $tax_query['relation'] = 'AND';
            $query->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'artika_product_query_filters');

// 15. Ajouter un champ personnalisé "Artiste" dans l'admin des produits
function artika_add_custom_product_fields() {
    woocommerce_wp_text_input(array(
        'id' => '_artist_name',
        'label' => __('Nom de l\'artiste', 'artika'),
        'placeholder' => 'Ex: Marie Dubois',
        'desc_tip' => 'true',
        'description' => __('Le nom de l\'artiste qui a créé cette œuvre', 'artika')
    ));
    
    woocommerce_wp_text_input(array(
        'id' => '_dimensions',
        'label' => __('Dimensions', 'artika'),
        'placeholder' => 'Ex: 80 × 100 cm',
        'desc_tip' => 'true',
        'description' => __('Les dimensions de l\'œuvre', 'artika')
    ));
}
add_action('woocommerce_product_options_general_product_data', 'artika_add_custom_product_fields');

// 16. Sauvegarder les champs personnalisés
function artika_save_custom_product_fields($post_id) {
    $artist_name = isset($_POST['_artist_name']) ? sanitize_text_field($_POST['_artist_name']) : '';
    update_post_meta($post_id, '_artist_name', $artist_name);
    
    $dimensions = isset($_POST['_dimensions']) ? sanitize_text_field($_POST['_dimensions']) : '';
    update_post_meta($post_id, '_dimensions', $dimensions);
}
add_action('woocommerce_process_product_meta', 'artika_save_custom_product_fields');