<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Là où l'art prend vie</h1>
        <p>Notre mission est de vous offrir bien plus qu'une simple vente. Nous vous présentons des œuvres de qualité exceptionnelle et inédites, créées par des artistes passionnés qui sauront vous inspirer et vous émerveiller.</p>
    </div>
</section>

<!-- Section Collections -->
<section class="collections" id="collections">
    <div class="container">
        <h2 class="section-title">Nos Collections</h2>
        
        <div class="collections-grid">
            
            <div class="collection-card">
                <div class="collection-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/peintures.jpg" alt="Peintures">
                    <div class="collection-overlay">
                        <a href="<?php echo get_permalink(get_page_by_path('peintures')); ?>" class="collection-link">Explorer</a>
                    </div>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Peintures</h3>
                    <p class="collection-desc">Découvrez des œuvres uniques qui célèbrent la créativité et l'expression artistique.</p>
                </div>
            </div>
            
            <div class="collection-card">
                <div class="collection-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/materiel.jpg" alt="Accessoires">
                    <div class="collection-overlay">
                        <a href="<?php echo get_permalink(get_page_by_path('accessoires')); ?>" class="collection-link">Explorer</a>
                    </div>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Accessoires</h3>
                    <p class="collection-desc">Tout le matériel nécessaire pour donner vie à vos créations artistiques.</p>
                </div>
            </div>
            
            <div class="collection-card">
                <div class="collection-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/sculptures.jpg" alt="Dessins de beaux arts">
                    <div class="collection-overlay">
                        <a href="<?php echo get_permalink(get_page_by_path('dessins')); ?>" class="collection-link">Explorer</a>
                    </div>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Dessins de beaux arts</h3>
                    <p class="collection-desc">L'art du dessin dans toute sa splendeur, du portrait à l'aquarelle.</p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Section Produits Vedettes -->
<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Œuvres Vedettes</h2>
        
        <div class="products-grid">
            <?php
            // Afficher les produits vedettes WooCommerce
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 4,
                'meta_key' => '_featured',
                'meta_value' => 'yes'
            );
            
            $featured_products = new WP_Query($args);
            
            if ($featured_products->have_posts()) {
                while ($featured_products->have_posts()) {
                    $featured_products->the_post();
                    global $product;
                    ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php the_post_thumbnail('medium'); ?>
                            <?php if ($product->is_on_sale()) : ?>
                                <span class="product-badge badge-promo">-<?php echo round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100); ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <h4 class="product-name"><?php the_title(); ?></h4>
                            <p class="product-artist"><?php echo get_the_author(); ?></p>
                            <p class="product-price"><?php echo $product->get_price_html(); ?></p>
                            <a href="<?php echo $product->add_to_cart_url(); ?>" class="btn-add-cart">Ajouter au panier</a>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>