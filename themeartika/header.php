<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- BANNIÈRE PROMOTIONNELLE -->
<div class="promo-banner">
    <p>Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.</p>
</div>

<!-- HEADER / NAVIGATION -->
<header class="header">
    <div class="container-header">
        
        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php if (has_custom_logo()) : 
                    the_custom_logo();
                else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ARTIKA_blk.png" alt="<?php bloginfo('name'); ?>">
                <?php endif; ?>
            </a>
        </div>
        
        <!-- Menu de navigation -->
        <nav class="main-nav">
            <ul class="nav-list">
                
                <!-- Menu Peintures -->
                <li class="nav-item has-megamenu">
                    <a href="#" class="nav-link">Peintures</a>
                    
                    <div class="megamenu">
                        <div class="megamenu-content">
                            <div class="megamenu-links">
                                <h3 class="megamenu-title">Explorez nos peintures</h3>
                                <ul class="megamenu-list">
                                    <?php
                                    // Récupérer dynamiquement les sous-catégories de "Peintures"
                                    $peintures_cat = get_term_by('slug', 'peintures', 'product_cat');
                                    if ($peintures_cat) {
                                        $sub_cats = get_terms(array(
                                            'taxonomy' => 'product_cat',
                                            'parent' => $peintures_cat->term_id,
                                            'hide_empty' => false,
                                        ));
                                        
                                        if (!empty($sub_cats)) {
                                            foreach ($sub_cats as $sub_cat) {
                                                echo '<li><a href="' . esc_url(get_term_link($sub_cat)) . '">' . esc_html($sub_cat->name) . '</a></li>';
                                            }
                                        } else {
                                            // Liens par défaut si pas de sous-catégories
                                            echo '<li><a href="' . esc_url(get_term_link(get_term_by('slug', 'art-abstrait', 'product_cat'))) . '">Art Abstrait</a></li>';
                                            echo '<li><a href="' . esc_url(get_term_link(get_term_by('slug', 'peinture-paysage', 'product_cat'))) . '">Peinture Paysage</a></li>';
                                            echo '<li><a href="' . esc_url(get_term_link(get_term_by('slug', 'pop-art', 'product_cat'))) . '">Peinture Pop Art</a></li>';
                                        }
                                    } else {
                                        // Si la catégorie Peintures n'existe pas encore
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/art-abstrait/')) . '">Art Abstrait</a></li>';
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/peinture-paysage/')) . '">Peinture Paysage</a></li>';
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/pop-art/')) . '">Peinture Pop Art</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="megamenu-images">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/materiel.jpg" alt="Peinture 1" class="megamenu-img img-1">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/product1.jpg" alt="Peinture 2" class="megamenu-img img-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/materiel.jpg" alt="Peinture 3" class="megamenu-img img-3">
                            </div>
                        </div>
                    </div>
                </li>
                
                <!-- Menu Accessoires -->
                <li class="nav-item has-megamenu">
                    <a href="#" class="nav-link">Accessoires</a>
                    
                    <div class="megamenu">
                        <div class="megamenu-content">
                            <div class="megamenu-links">
                                <h3 class="megamenu-title">Matériel de création</h3>
                                <ul class="megamenu-list">
                                    <?php
                                    $accessoires_cat = get_term_by('slug', 'accessoires', 'product_cat');
                                    if ($accessoires_cat) {
                                        $sub_cats = get_terms(array(
                                            'taxonomy' => 'product_cat',
                                            'parent' => $accessoires_cat->term_id,
                                            'hide_empty' => false,
                                        ));
                                        
                                        if (!empty($sub_cats)) {
                                            foreach ($sub_cats as $sub_cat) {
                                                echo '<li><a href="' . esc_url(get_term_link($sub_cat)) . '">' . esc_html($sub_cat->name) . '</a></li>';
                                            }
                                        } else {
                                            echo '<li><a href="' . esc_url(home_url('/categorie-produit/toiles/')) . '">Toiles</a></li>';
                                            echo '<li><a href="' . esc_url(home_url('/categorie-produit/pinceaux/')) . '">Pinceaux</a></li>';
                                            echo '<li><a href="' . esc_url(home_url('/categorie-produit/pots-tubes/')) . '">Pots de peinture</a></li>';
                                        }
                                    } else {
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/toiles/')) . '">Toiles</a></li>';
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/pinceaux/')) . '">Pinceaux</a></li>';
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/pots-tubes/')) . '">Pots de peinture</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="megamenu-images">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/materiel.jpg" alt="Accessoire 1" class="megamenu-img img-1">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/peintures.jpg" alt="Accessoire 2" class="megamenu-img img-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/sculptures.jpg" alt="Accessoire 3" class="megamenu-img img-3">
                            </div>
                        </div>
                    </div>
                </li>
                
                <!-- Menu Dessins -->
                <li class="nav-item has-megamenu">
                    <a href="#" class="nav-link">Dessins de beaux arts</a>
                    
                    <div class="megamenu">
                        <div class="megamenu-content">
                            <div class="megamenu-links">
                                <h3 class="megamenu-title">Art du dessin</h3>
                                <ul class="megamenu-list">
                                    <?php
                                    $dessins_cat = get_term_by('slug', 'dessins', 'product_cat');
                                    if ($dessins_cat) {
                                        $sub_cats = get_terms(array(
                                            'taxonomy' => 'product_cat',
                                            'parent' => $dessins_cat->term_id,
                                            'hide_empty' => false,
                                        ));
                                        
                                        if (!empty($sub_cats)) {
                                            foreach ($sub_cats as $sub_cat) {
                                                echo '<li><a href="' . esc_url(get_term_link($sub_cat)) . '">' . esc_html($sub_cat->name) . '</a></li>';
                                            }
                                        } else {
                                            echo '<li><a href="' . esc_url(home_url('/categorie-produit/dessin-portrait/')) . '">Dessin de portrait</a></li>';
                                            echo '<li><a href="' . esc_url(home_url('/categorie-produit/dessin-rue/')) . '">Dessin de rue</a></li>';
                                            echo '<li><a href="' . esc_url(home_url('/categorie-produit/dessin-eau/')) . '">Dessin à eau</a></li>';
                                        }
                                    } else {
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/dessin-portrait/')) . '">Dessin de portrait</a></li>';
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/dessin-rue/')) . '">Dessin de rue</a></li>';
                                        echo '<li><a href="' . esc_url(home_url('/categorie-produit/dessin-eau/')) . '">Dessin à eau</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="megamenu-images">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/peintures.jpg" alt="Dessin 1" class="megamenu-img img-1">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/hero.jpg" alt="Dessin 2" class="megamenu-img img-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/product1.jpg" alt="Dessin 3" class="megamenu-img img-3">
                            </div>
                        </div>
                    </div>
                </li>
                
                <li class="nav-separator"></li>
                
                <li class="nav-item"><a href="<?php echo esc_url(home_url('/magasins')); ?>" class="nav-link">Nos magasins</a></li>
                <li class="nav-item"><a href="<?php echo esc_url(home_url('/a-propos')); ?>" class="nav-link">À propos</a></li>
            </ul>
        </nav>
        
        <!-- Actions utilisateur -->
        <div class="header-actions">
            
            <!-- Recherche -->
            <div class="search-wrapper">
                <button class="search-icon" aria-label="Rechercher">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M14 14L18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="search-dropdown">
                    <?php echo get_product_search_form(false); ?>
                </div>
            </div>
            
            <!-- Login -->
            <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="icon-btn" aria-label="Se connecter" title="Se connecter">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <circle cx="10" cy="6" r="3.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M3 17c0-3 2.5-5.5 7-5.5s7 2.5 7 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </a>
            
            <!-- Panier -->
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="icon-btn cart-icon" aria-label="Panier">
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

<!-- MINI-PANIER (panneau latéral) -->
<div class="mini-panier" id="miniPanier">
    <div class="mini-panier-header">
        <h3>Mon Panier</h3>
        <button class="mini-panier-close" onclick="fermerMiniPanier()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
    
    <?php if (WC()->cart->is_empty()) : ?>
        <!-- Message panier vide -->
        <div class="mini-panier-vide" id="panierVide">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                <circle cx="40" cy="40" r="38" stroke="#E5E5E5" stroke-width="4"/>
                <path d="M20 20l40 40M20 60l40-40" stroke="#E5E5E5" stroke-width="4" stroke-linecap="round"/>
            </svg>
            <p>Votre panier est vide</p>
            <button class="btn-continuer" onclick="fermerMiniPanier()">Continuer mes achats</button>
        </div>
    <?php else : ?>
        <!-- Contenu du panier -->
        <div class="mini-panier-contenu" id="panierContenu">
            <div class="mini-panier-liste" id="listeProduitsPanier">
                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                        $product_permalink = $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
                ?>
                <div class="mini-panier-item">
                    <?php
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                    if (!$product_permalink) {
                        echo $thumbnail;
                    } else {
                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                    }
                    ?>
                    <div class="mini-panier-info">
                        <h4><?php echo wp_kses_post($_product->get_name()); ?></h4>
                        <p class="mini-panier-prix"><?php echo WC()->cart->get_product_price($_product); ?> x <?php echo $cart_item['quantity']; ?></p>
                    </div>
                    <button class="mini-panier-supprimer" onclick="window.location.href='<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>'">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
            
            <div class="mini-panier-footer">
                <div class="mini-panier-total">
                    <span>Total :</span>
                    <span class="total-prix" id="totalPanier"><?php echo WC()->cart->get_cart_total(); ?></span>
                </div>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn-voir-panier">Voir le panier</a>
                <button class="btn-continuer-achats" onclick="fermerMiniPanier()">Continuer mes achats</button>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Overlay pour fermer le mini-panier -->
<div class="mini-panier-overlay" id="miniPanierOverlay" onclick="fermerMiniPanier()"></div>

<script>
function fermerMiniPanier() {
    document.getElementById('miniPanier').classList.remove('open');
    document.getElementById('miniPanierOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

// Ouvrir le mini-panier au clic sur l'icône
document.addEventListener('DOMContentLoaded', function() {
    const cartIcon = document.querySelector('.cart-icon');
    if (cartIcon) {
        cartIcon.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('miniPanier').classList.add('open');
            document.getElementById('miniPanierOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
});
</script>