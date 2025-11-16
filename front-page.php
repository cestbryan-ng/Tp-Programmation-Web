<?php
/**
 * Template Name: Page d'Accueil
 * Description: Template personnalisé pour la page d'accueil.
 */ 
get_header(); ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Artika - Là où l'art prend vie</title>
        <link rel="stylesheet" href="assets/css/accueil.css">
    </head>
    <!-- BANNIÃˆRE PROMOTIONNELLE -->
    <div class="promo-banner">
        <p><?php echo get_theme_mod('promo_banner_text', 'Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.'); ?></p>
    </div>

    <!-- MINI-PANIER (panneau latéral) -->
    <div class="mini-panier" id="miniPanier">
        <div class="mini-panier-header">
            <h3><?php _e('Mon Panier', 'artika'); ?></h3>
            <button class="mini-panier-close" onclick="fermerMiniPanier()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
        
        <!-- Message panier vide -->
        <div class="mini-panier-vide" id="panierVide">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                <circle cx="40" cy="40" r="38" stroke="#E5E5E5" stroke-width="4"/>
                <path d="M20 20l40 40M20 60l40-40" stroke="#E5E5E5" stroke-width="4" stroke-linecap="round"/>
            </svg>
            <p><?php _e('Votre panier est vide', 'artika'); ?></p>
            <button class="btn-continuer" onclick="fermerMiniPanier()"><?php _e('Continuer mes achats', 'artika'); ?></button>
        </div>
        
        <!-- Contenu du panier -->
        <div class="mini-panier-contenu" id="panierContenu" style="display: none;">
            <div class="mini-panier-liste" id="listeProduitsPanier">
                <?php echo do_shortcode('[woocommerce_cart]'); ?>
            </div>
            
            <div class="mini-panier-footer">
                <div class="mini-panier-total">
                    <span><?php _e('Total :', 'artika'); ?></span>
                    <span class="total-prix" id="totalPanier"><?php echo WC()->cart->get_cart_total(); ?></span>
                </div>
                <a href="<?php echo wc_get_cart_url(); ?>" class="btn-voir-panier"><?php _e('Voir le panier', 'artika'); ?></a>
                <button class="btn-continuer-achats" onclick="fermerMiniPanier()"><?php _e('Continuer mes achats', 'artika'); ?></button>
            </div>
        </div>
    </div>
    
    <!-- Overlay pour fermer le mini-panier -->
    <div class="mini-panier-overlay" id="miniPanierOverlay"></div>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-image" style="background-image: url('<?php echo get_theme_mod('hero_image', get_template_directory_uri() . '/assets/images/accueil/hero.jpg'); ?>');"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title"><?php echo get_theme_mod('hero_title', 'ARTIKA'); ?></h1>
            <p class="hero-subtitle"><?php echo get_theme_mod('hero_subtitle', 'Là où l\'art prend vie'); ?></p>
            <a href="#collections" class="btn-primary"><?php _e('Découvrir nos collections', 'artika'); ?></a>
        </div>
    </section>

    <!-- SECTION COLLECTIONS -->
    <section class="collections" id="collections">
        <div class="container">
            <h2 class="section-title"><?php _e('Nos Collections', 'artika'); ?></h2>
            
            <div class="collections-grid">
                <?php
                // Récupérer les catégories de produits WooCommerce
                $product_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => 0,
                    'number' => 3
                ));

                foreach ($product_categories as $category) :
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image = wp_get_attachment_url($thumbnail_id);
                ?>
                <div class="collection-card">
                    <div class="collection-image">
                        <img src="<?php echo $image ? $image : get_template_directory_uri() . '/assets/images/accueil/peintures.jpg'; ?>" alt="<?php echo esc_attr($category->name); ?>">
                        <div class="collection-overlay">
                            <a href="<?php echo get_term_link($category); ?>" class="collection-link"><?php _e('Explorer', 'artika'); ?></a>
                        </div>
                    </div>
                    <div class="collection-info">
                        <h3 class="collection-title"><?php echo esc_html($category->name); ?></h3>
                        <p class="collection-desc"><?php echo esc_html($category->description); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION ŒUVRES VEDETTES -->
    <section class="featured-products">
        <div class="container">
            <h2 class="section-title"><?php _e('Œuvres Vedettes', 'artika'); ?></h2>
            
            <div class="products-grid">
                <?php
                // Récupérer les produits en vedette
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field' => 'name',
                            'terms' => 'featured',
                        ),
                    ),
                );
                $featured_query = new WP_Query($args);

                if ($featured_query->have_posts()) :
                    while ($featured_query->have_posts()) : $featured_query->the_post();
                        global $product;
                ?>
                <div class="product-card">
                    <div class="product-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo woocommerce_get_product_thumbnail(); ?>
                        </a>
                        <?php if ($product->is_on_sale()) : ?>
                            <span class="product-badge badge-promo">-<?php echo round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100); ?>%</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h4 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p class="product-artist"><?php echo get_post_meta(get_the_ID(), '_artist_name', true); ?></p>
                        <p class="product-price"><?php echo $product->get_price_html(); ?></p>
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION TÉMOIGNAGES -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title"><?php _e('Ce que disent nos clients', 'artika'); ?></h2>
            
            <div class="testimonials-carousel">
                <div class="testimonial-track">
                    <?php
                    // Récupérer les témoignages (utiliser un Custom Post Type ou ACF)
                    $testimonials = new WP_Query(array(
                        'post_type' => 'testimonial',
                        'posts_per_page' => -1
                    ));

                    if ($testimonials->have_posts()) :
                        while ($testimonials->have_posts()) : $testimonials->the_post();
                    ?>
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>
                        </div>
                        <p class="testimonial-text"><?php the_content(); ?></p>
                        <p class="testimonial-author">— <?php the_title(); ?></p>
                        <div class="testimonial-stars">
                            <?php 
                            $rating = get_post_meta(get_the_ID(), '_rating', true);
                            echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                            ?>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            
            <!-- Formulaire d'ajout de témoignage -->
            <div class="testimonial-form-section">
                <h3 class="form-title"><?php _e('Partagez votre expérience', 'artika'); ?></h3>
                <form class="testimonial-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                    <input type="hidden" name="action" value="submit_testimonial">
                    <?php wp_nonce_field('submit_testimonial_nonce'); ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="<?php _e('Votre nom', 'artika'); ?>" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="<?php _e('Votre email', 'artika'); ?>" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="comment" placeholder="<?php _e('Votre commentaire...', 'artika'); ?>" class="form-textarea" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="rating-label"><?php _e('Votre note :', 'artika'); ?></label>
                        <div class="star-rating">
                            <input type="radio" name="rating" value="5" id="star5"><label for="star5">★</label>
                            <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
                            <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
                            <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
                            <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><?php _e('Envoyer mon avis', 'artika'); ?></button>
                </form>
            </div>
        </div>
    </section>

<?php get_footer(); ?>