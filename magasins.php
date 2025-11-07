<?php
/**
 * Template Name: Page Nos Magasins
 * Description: Template personnalisé pour la page Nos Magasins
 */
 get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Magasins - Artika</title>
    <!-- CSS de la page d'accueil pour le header/footer -->
    <link rel="stylesheet" href="assets/css/accueil.css">
    <!-- CSS spécifique à la page magasins -->
    <link rel="stylesheet" href="assets/css/magasins.css">
</head>


    <!-- 
         HERO SECTION
         Grande image avec texte d'introduction
     -->
    <section class="stores-hero">
        <div class="stores-hero-image"></div>
        <div class="stores-hero-overlay"></div>
        <div class="stores-hero-content">
            <h1 class="stores-hero-title">Nos Magasins</h1>
            <p class="stores-hero-subtitle">Le cœur battant d'Artika. Explorez nos collections, essayez vos œuvres préférées et vivez l'expérience Artika en personne.</p>
        </div>
    </section>

    <!-- 
         SECTION "CE QUI VOUS ATTEND EN MAGASIN"
         4 cartes expliquant l'expérience en magasin
     -->
    <section class="store-experience">
        <div class="container">
            <h2 class="section-title-stores">Ce qui vous attend en magasin</h2>
            <p class="section-subtitle">De nouveaux arrivages au service personnalisé, faire ses achats en personne offre des avantages uniques. Voici comment nous rendons l'expérience aussi confortable et agréable que nos œuvres.</p>
            
            <div class="experience-grid">
                
                <!-- Carte 1 -->
                <div class="experience-card">
                    <div class="experience-image">
                        <img src="assets/images/magasins/experience1.jpg" alt="Nouvelles collections">
                    </div>
                    <h3 class="experience-title">Nouvelles Collections en Avant-Première</h3>
                    <p class="experience-desc">Soyez les premiers à voir et à toucher nos derniers styles, œuvres fraîches et collections saisonnières avant qu'elles ne partent.</p>
                </div>
                
                <!-- Carte 2 -->
                <div class="experience-card">
                    <div class="experience-image">
                        <img src="assets/images/magasins/experience2.jpg" alt="Service personnalisé">
                    </div>
                    <h3 class="experience-title">Service Personnalisé</h3>
                    <p class="experience-desc">Bénéficiez d'un accompagnement personnalisé, de conseils artistiques et de recommandations de vrais experts qui connaissent leur métier.</p>
                </div>
                
                <!-- Carte 3 -->
                <div class="experience-card">
                    <div class="experience-image">
                        <img src="assets/images/magasins/experience3.jpg" alt="Expérience confortable">
                    </div>
                    <h3 class="experience-title">Une Expérience Agréable</h3>
                    <p class="experience-desc">Pas de pression. Pas de stress. Juste beaucoup d'espace, de bonnes vibrations et le temps de trouver votre œuvre parfaite.</p>
                </div>
                
                <!-- Carte 4 -->
                <div class="experience-card">
                    <div class="experience-image">
                        <img src="assets/images/magasins/experience4.jpg" alt="Retours faciles">
                    </div>
                    <h3 class="experience-title">Retours et Échanges Faciles</h3>
                    <p class="experience-desc">Pas tout à fait satisfait ? Passez en magasin pour échanger ou retourner. Sans carton, sans formulaire, sans tracas.</p>
                </div>
                
            </div>
        </div>
    </section>

    <!-- 
         SECTION LISTE DES MAGASINS
         Organisée par pays et ville
     -->
    <section class="store-directory">
        <div class="container">
            
            <h2 class="section-title-stores">Localisateur de Magasins</h2>
            <p class="directory-intro">Recherchez votre magasin le plus proche ci-dessous ou consultez la liste complète de nos emplacements.</p>
            
            <!-- Barre de recherche -->
            <div class="store-search">
                <input type="text" placeholder="Rechercher par ville ou pays..." class="store-search-input">
                <button class="store-search-btn">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2"/>
                        <path d="M14 14L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            
            <!-- Liste des magasins par pays -->
            <div class="stores-list">
                
                <!-- CAMEROUN -->
                <div class="country-section">
                    <h3 class="country-name">Cameroun</h3>
                    
                    <div class="stores-grid">
                        <!-- Magasin Yaoundé -->
                        <div class="store-card">
                            <div class="store-location">
                                <h4 class="store-city">Yaoundé</h4>
                                <p class="store-district">Bastos</p>
                            </div>
                            <div class="store-details">
                                <p class="store-address">Avenue Rosa Parks, Quartier Bastos</p>
                                <p class="store-address">Yaoundé, Cameroun</p>
                                <a href="tel:+237222123456" class="store-phone">+237 222 12 34 56</a>
                            </div>
                            <div class="store-hours">
                                <p class="hours-title">Horaires d'ouverture</p>
                                <p class="hours-detail">Lun - Sam : 9h00 - 19h00</p>
                                <p class="hours-detail">Dim : 10h00 - 18h00</p>
                            </div>
                            <a href="#" class="store-link">Voir les détails →</a>
                        </div>
                        
                        <!-- Magasin Douala -->
                        <div class="store-card">
                            <div class="store-location">
                                <h4 class="store-city">Douala</h4>
                                <p class="store-district">Akwa</p>
                            </div>
                            <div class="store-details">
                                <p class="store-address">Boulevard de la Liberté, Akwa</p>
                                <p class="store-address">Douala, Cameroun</p>
                                <a href="tel:+237233456789" class="store-phone">+237 233 45 67 89</a>
                            </div>
                            <div class="store-hours">
                                <p class="hours-title">Horaires d'ouverture</p>
                                <p class="hours-detail">Lun - Sam : 9h00 - 19h00</p>
                                <p class="hours-detail">Dim : 10h00 - 18h00</p>
                            </div>
                            <a href="#" class="store-link">Voir les détails →</a>
                        </div>
                    </div>
                </div>
                
                <!-- CÔTE D'IVOIRE -->
                <div class="country-section">
                    <h3 class="country-name">Côte d'Ivoire</h3>
                    
                    <div class="stores-grid">
                        <!-- Magasin Abidjan -->
                        <div class="store-card">
                            <div class="store-location">
                                <h4 class="store-city">Abidjan</h4>
                                <p class="store-district">Plateau</p>
                            </div>
                            <div class="store-details">
                                <p class="store-address">Avenue Chardy, Plateau</p>
                                <p class="store-address">Abidjan, Côte d'Ivoire</p>
                                <a href="tel:+2252720123456" class="store-phone">+225 27 20 12 34 56</a>
                            </div>
                            <div class="store-hours">
                                <p class="hours-title">Horaires d'ouverture</p>
                                <p class="hours-detail">Lun - Sam : 8h30 - 19h30</p>
                                <p class="hours-detail">Dim : 10h00 - 17h00</p>
                            </div>
                            <a href="#" class="store-link">Voir les détails →</a>
                        </div>
                    </div>
                </div>
                
                <!-- SÉNÉGAL -->
                <div class="country-section">
                    <h3 class="country-name">Sénégal</h3>
                    
                    <div class="stores-grid">
                        <!-- Magasin Dakar -->
                        <div class="store-card">
                            <div class="store-location">
                                <h4 class="store-city">Dakar</h4>
                                <p class="store-district">Almadies</p>
                            </div>
                            <div class="store-details">
                                <p class="store-address">Route des Almadies, Zone 14</p>
                                <p class="store-address">Dakar, Sénégal</p>
                                <a href="tel:+221338201234" class="store-phone">+221 33 820 12 34</a>
                            </div>
                            <div class="store-hours">
                                <p class="hours-title">Horaires d'ouverture</p>
                                <p class="hours-detail">Lun - Sam : 9h00 - 20h00</p>
                                <p class="hours-detail">Dim : 10h00 - 18h00</p>
                            </div>
                            <a href="#" class="store-link">Voir les détails →</a>
                        </div>
                    </div>
                </div>
                
                <!-- GABON -->
                <div class="country-section">
                    <h3 class="country-name">Gabon</h3>
                    
                    <div class="stores-grid">
                        <!-- Magasin Libreville -->
                        <div class="store-card">
                            <div class="store-location">
                                <h4 class="store-city">Libreville</h4>
                                <p class="store-district">Centre-ville</p>
                            </div>
                            <div class="store-details">
                                <p class="store-address">Boulevard de l'Indépendance</p>
                                <p class="store-address">Libreville, Gabon</p>
                                <a href="tel:+24101234567" class="store-phone">+241 01 23 45 67</a>
                            </div>
                            <div class="store-hours">
                                <p class="hours-title">Horaires d'ouverture</p>
                                <p class="hours-detail">Lun - Sam : 9h00 - 19h00</p>
                                <p class="hours-detail">Dim : Fermé</p>
                            </div>
                            <a href="#" class="store-link">Voir les détails →</a>
                        </div>
                    </div>
                </div>
                
                <!-- CONGO -->
                <div class="country-section">
                    <h3 class="country-name">Congo</h3>
                    
                    <div class="stores-grid">
                        <!-- Magasin Brazzaville -->
                        <div class="store-card">
                            <div class="store-location">
                                <h4 class="store-city">Brazzaville</h4>
                                <p class="store-district">Poto-Poto</p>
                            </div>
                            <div class="store-details">
                                <p class="store-address">Avenue Félix Éboué, Poto-Poto</p>
                                <p class="store-address">Brazzaville, Congo</p>
                                <a href="tel:+24206123456" class="store-phone">+242 06 123 456</a>
                            </div>
                            <div class="store-hours">
                                <p class="hours-title">Horaires d'ouverture</p>
                                <p class="hours-detail">Lun - Sam : 8h00 - 18h00</p>
                                <p class="hours-detail">Dim : 10h00 - 16h00</p>
                            </div>
                            <a href="#" class="store-link">Voir les détails →</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- 
         SECTION CTA (Appel à l'action)
         Bannière encourageant à visiter un magasin
     -->
    <section class="stores-cta">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Visitez-nous en Magasin</h2>
                <p class="cta-text">Découvrez nos collections, rencontrez nos experts et vivez l'expérience Artika. Nous avons hâte de vous accueillir.</p>
                <a href="#" class="btn-cta">Trouver un magasin près de chez vous</a>
            </div>
        </div>
    </section>
<?php get_footer(); ?>
