<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artika - Là où l'art prend vie</title>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/combined.css" type="text/css"/>
</head>
<body>

    <!-- 
         BANNIÈRE PROMOTIONNELLE
         Barre fixe en haut du site
     -->
    <div class="promo-banner">
        <p>Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.</p>
    </div>

    <!-- 
         HEADER / NAVIGATION
         Section réutilisable pour toutes les pages
     -->
    <header class="header">
        <div class="container-header">
            
            <!-- Logo (image cliquable) -->
            <div class="logo">
                <a href="artika.html">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/ARTIKA_blk.png" alt="Artika">
                </a>
            </div>
            
            <!-- Menu de navigation avec mega menu -->
            <nav class="main-nav">
                <ul class="nav-list">
                    
                    <!-- Menu Peintures avec sous-catégories -->
                    <li class="nav-item has-megamenu">
                        <a href="#" class="nav-link">Peintures</a>
                        
                        <!-- Mega Menu Peintures -->
                        <div class="megamenu">
                            <div class="megamenu-content">
                                <div class="megamenu-links">
                                    <h3 class="megamenu-title">Explorez nos peintures</h3>
                                    <ul class="megamenu-list">
                                        <li><a href="artAbstrait.html">Art Abstrait</a></li>
                                        <li><a href="peinturepaysage.html">Peinture Paysage</a></li>
                                        <li><a href="popArt.html">Peinture Pop Art</a></li>
                                    </ul>
                                </div>
                                <!-- Images décoratives -->
                                <div class="megamenu-images">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/materiel.jpg" alt="Peinture 1" class="megamenu-img img-1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/product1.jpg" alt="Peinture 2" class="megamenu-img img-2">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/materiel.jpg" alt="Peinture 3" class="megamenu-img img-3">
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Menu Accessoires -->
                    <li class="nav-item has-megamenu">
                        <a href="#" class="nav-link">Accessoires</a>
                        
                        <!-- Mega Menu Accessoires -->
                        <div class="megamenu">
                            <div class="megamenu-content">
                                <div class="megamenu-links">
                                    <h3 class="megamenu-title">Matériel de création</h3>
                                    <ul class="megamenu-list">
                                        <li><a href="latoilehtml2.html">Toiles</a></li>
                                        <li><a href="pinceaux.html">Pinceaux</a></li>
                                        <li><a href="pots-tubes.html">Pots de peinture</a></li>
                                    </ul>
                                </div>
                                <div class="megamenu-images">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/materiel.jpg" alt="Accessoire 1" class="megamenu-img img-1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/peintures.jpg" alt="Accessoire 2" class="megamenu-img img-2">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/sculptures.jpg" alt="Accessoire 3" class="megamenu-img img-3">
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Menu Dessins -->
                    <li class="nav-item has-megamenu">
                        <a href="#" class="nav-link">Dessins de beaux arts</a>
                        
                        <!-- Mega Menu Dessins -->
                        <div class="megamenu">
                            <div class="megamenu-content">
                                <div class="megamenu-links">
                                    <h3 class="megamenu-title">Art du dessin</h3>
                                    <ul class="megamenu-list">
                                        <li><a href="dessin_portrait.html">Dessin de portrait</a></li>
                                        <li><a href="DessinRue.html">Dessin de rue</a></li>
                                        <li><a href="dessins.html">Dessin à eau</a></li>
                                    </ul>
                                </div>
                                <div class="megamenu-images">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/peintures.jpg" alt="Dessin 1" class="megamenu-img img-1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/hero.jpg" alt="Dessin 2" class="megamenu-img img-2">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/accueil/product1.jpg" alt="Dessin 3"class="megamenu-img img-3">
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Séparateur visuel (espace) -->
                    <li class="nav-separator"></li>
                    
                    <!-- Liens simples -->
                    <li class="nav-item"><a href="magasins.html" class="nav-link">Nos magasins</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">À propos</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo esc_url( home_url('/single-product') ); ?>">Produits</a>
                    </li>
                </ul>
            </nav>
            
            <!-- Actions utilisateur (Recherche, Login, Panier) -->
            <div class="header-actions">
                
                <!-- Icône de recherche (avec champ au survol) -->
                <div class="search-wrapper">
                    <button class="search-icon" aria-label="Rechercher">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M14 14L18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <!-- Champ de recherche qui apparaît au survol -->
                    <div class="search-dropdown">
                        <input type="text" placeholder="Rechercher une œuvre, un artiste..." class="search-input">
                    </div>
                </div>
                
                <!-- Icône Login -->
                <a href="login.html" class="icon-btn" aria-label="Se connecter" title="Se connecter">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <circle cx="10" cy="6" r="3.5" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M3 17c0-3 2.5-5.5 7-5.5s7 2.5 7 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                
                <!-- Icône Panier -->
                <a href="#" class="icon-btn cart-icon" aria-label="Panier">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M1 1h2l2.5 10h10l2.5-8H5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <circle cx="8" cy="17" r="1.2" fill="currentColor"/>
                        <circle cx="15" cy="17" r="1.2" fill="currentColor"/>
                    </svg>
                    <span class="cart-count">0</span>
                </a>
                
            </div>
            
        </div>
    </header>
