<?php
/**
 * functions.php du thème Artika
 */

// --- 1. SUPPORT DE BASE DU THÈME ---

function artika_theme_setup() {
    // A. Activer le support pour WooCommerce
    add_theme_support( 'woocommerce' );
    
    // B. Activer les images mises en avant (pour les produits et articles)
    add_theme_support( 'post-thumbnails' );

    // C. Enregistrer les emplacements de menu
    register_nav_menus( array(
        // 'primary-menu' correspond à ce que vous avez dans header.php
        'primary-menu' => __( 'Menu Principal (Header)', 'artika' ), 
        // 'footer-menu' correspond à ce que vous avez dans footer.php
        'footer-menu'  => __( 'Menu Pied de Page', 'artika' ),
    ) );

    // D. Permet à WordPress de gérer le titre <title>
    add_theme_support( 'title-tag' );
}
// Exécute cette fonction après le chargement du thème
add_action( 'after_setup_theme', 'artika_theme_setup' );


// --- 2. ENREGISTREMENT DE LA ZONE DE WIDGETS (POUR LES FILTRES) ---

/**
 * Enregistre notre "Shop Sidebar" pour les filtres WooCommerce.
 */
function artika_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Barre Latérale Boutique (Filtres)', 'artika' ),
        'id'            => 'shop-sidebar',
        'description'   => __( 'Ajoutez vos widgets de filtre WooCommerce ici.', 'artika' ),
        // Utilise vos classes CSS de 'archive-product.php' pour un style cohérent
        'before_widget' => '<div id="%1$s" class="widget %2$s filter-group">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title filter-group-title">',
        'after_title'   => '</h3>',
    ) );
}
// Exécute cette fonction lors de l'initialisation des widgets
add_action( 'widgets_init', 'artika_widgets_init' );


// --- 3. MISE EN FILE D'ATTENTE (ENQUEUE) DES STYLES ET SCRIPTS ---

/**
 * Charge tous les CSS et JS.
 */
function artika_theme_scripts() {
    
    // --- CHARGEMENT DU CSS ---
    
    // Charge le 'style.css' principal (pour les infos du thème)
    wp_enqueue_style( 
        'artika-style', 
        get_stylesheet_uri(),
        array(),
        '1.0'
    );
    
    // Charge votre 'combined.css' (meilleure pratique que les @import)
    // Assurez-vous que ce fichier existe bien dans 'assets/css/'
    wp_enqueue_style( 
        'artika-main-styles',
        get_template_directory_uri() . '/assets/css/combined.css',
        array('artika-style'), // Dépend du style principal
        '1.0'
    );

    // --- CHARGEMENT DU JS ---
    // On charge le bon JS pour la bonne page, dans le footer (true)
    
    $js_path = get_template_directory_uri() . '/assets/js/';

    // Si on est sur la page d'accueil (front-page.php)
    if ( is_front_page() ) {
        wp_enqueue_script( 
            'artika-accueil', 
            $js_path . 'accueil.js', // (Assurez-vous que ce fichier existe)
            array(), 
            '1.0', 
            true // Charger dans le footer
        );
    }
    
    // Si on est sur la page "Mon Compte" (login/signup)
    elseif ( is_account_page() ) { 
         wp_enqueue_script( 
            'artika-login', 
            $js_path . 'login.js', // (gérera le login.html)
            array(), 
            '1.0', 
            true 
        );
         wp_enqueue_script( 
            'artika-signup', 
            $js_path . 'signup.js', // (gérera le signup.html)
            array(), 
            '1.0', 
            true 
        );
    }
    
    // Si on est sur une page boutique (archive ou single)
    elseif ( is_woocommerce() ) {
        // (Peut-être un JS pour la galerie ou les filtres)
        wp_enqueue_script( 
            'artika-shop', 
            $js_path . 'shop.js', 
            array(), 
            '1.0', 
            true 
        );
    }
}
// Exécute cette fonction pour charger les scripts/styles
add_action( 'wp_enqueue_scripts', 'artika_theme_scripts' );
// Inclure les fonctions de filtres Artika
require_once get_template_directory().'/artika-filters-functions.php';

?>
