<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?> | Galerie d'Art</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Bannière Promotionnelle -->
    <div class="promo-banner">
        <p>Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.</p>
    </div>

    <!-- HEADER / NAVIGATION -->
    <header class="header">
        <div class="container-header">
            
            <!-- Logo (image cliquable) -->
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ARTIKA_blk.png" alt="Artika">
                </a>
            </div>
            
            <!-- Menu de navigation WordPress -->
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => false,
                    'menu_class' => 'nav-list',
                    'fallback_cb' => false
                ));
                ?>
            </nav>
            
            <!-- Actions utilisateur (Recherche, Login, Panier) -->
            <div class="header-actions">
                
                <!-- Icône de recherche -->
                <div class="search-wrapper">
                    <button class="search-icon" aria-label="Rechercher">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M14 14L18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <!-- Champ de recherche WordPress -->
                    <div class="search-dropdown">
                        <form role="search" method="get" action="<?php echo home_url('/'); ?>">
                            <input type="search" placeholder="Rechercher une œuvre, un artiste..." value="<?php echo get_search_query(); ?>" name="s" class="search-input">
                        </form>
                    </div>
                </div>
                
                <!-- Icône Login -->
                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="icon-btn" aria-label="Se connecter" title="Se connecter">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <circle cx="10" cy="6" r="3.5" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M3 17c0-3 2.5-5.5 7-5.5s7 2.5 7 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                
                <!-- Icône Panier WooCommerce -->
                <a href="<?php echo wc_get_cart_url(); ?>" class="icon-btn cart-icon" aria-label="Panier">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M1 1h2l2.5 10h10l2.5-8H5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <circle cx="8" cy="17" r="1.2" fill="currentColor"/>
                        <circle cx="15" cy="17" r="1.2" fill="currentColor"/>
                    </svg>
                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
                
            </div>
            
        </div>
    </header>
