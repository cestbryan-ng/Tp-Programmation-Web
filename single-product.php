<?php
/**
 * The Template for displaying single products
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

    <div class="promo-banner">
        <p><?php echo get_theme_mod('promo_banner_text', 'Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.'); ?></p>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <?php woocommerce_breadcrumb(); ?>
    </div>

    <?php while (have_posts()) : the_post(); global $product; ?>

    <!-- Product Section -->
    <div class="product-wrapper">
        <div class="product-container">
            <!-- Gallery -->
            <div class="product-gallery">
                <div class="main-image-container">
                    <div class="main-image">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('large');
                        } else {
                            echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
                        }
                        ?>
                    </div>
                </div>
                <div class="thumbnail-grid">
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ($attachment_ids) {
                        $i = 0;
                        foreach ($attachment_ids as $attachment_id) {
                            $active_class = ($i == 0) ? 'active' : '';
                            echo '<div class="thumbnail ' . $active_class . '">';
                            echo wp_get_attachment_image($attachment_id, 'thumbnail');
                            echo '</div>';
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <?php 
                $artist_name = get_post_meta(get_the_ID(), '_artist_name', true);
                if ($artist_name) :
                ?>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="artist-link">
                        <?php echo esc_html($artist_name); ?>
                    </a>
                <?php endif; ?>

                <h1 class="product-title"><?php the_title(); ?></h1>
                
                <?php 
                $product_subtitle = get_post_meta(get_the_ID(), '_product_subtitle', true);
                if ($product_subtitle) :
                ?>
                    <p class="product-subtitle"><?php echo esc_html($product_subtitle); ?></p>
                <?php endif; ?>
                
                <div class="product-price">
                    <?php echo $product->get_price_html(); ?>
                    <div class="price-info"><?php _e('TVA incluse • Livraison gratuite', 'artika'); ?></div>
                </div>

                <!-- Specs -->
                <div class="specs-grid">
                    <?php
                    $specs = array(
                        '_dimensions' => __('Dimensions', 'artika'),
                        '_technique' => __('Technique', 'artika'),
                        '_support' => __('Support', 'artika'),
                        '_year' => __('Année', 'artika'),
                        '_signature' => __('Signature', 'artika'),
                        '_authenticity' => __('Authenticité', 'artika')
                    );

                    foreach ($specs as $meta_key => $label) {
                        $value = get_post_meta(get_the_ID(), $meta_key, true);
                        if ($value) :
                    ?>
                        <div class="spec-item">
                            <span class="spec-label"><?php echo esc_html($label); ?></span>
                            <span class="spec-value"><?php echo esc_html($value); ?></span>
                        </div>
                    <?php 
                        endif;
                    }
                    ?>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

                <!-- Shipping Info -->
                <div class="info-box">
                    <h4><?php _e('Livraison & Retour', 'artika'); ?></h4>
                    <ul>
                        <li><?php _e('Livraison gratuite en France métropolitaine', 'artika'); ?></li>
                        <li><?php _e('Expédition sécurisée sous 3-5 jours ouvrés', 'artika'); ?></li>
                        <li><?php _e('Retour gratuit sous 14 jours', 'artika'); ?></li>
                        <li><?php _e('Emballage professionnel garanti', 'artika'); ?></li>
                    </ul>
                </div>

                <!-- Description -->
                <div class="description-section">
                    <h3><?php _e('Description de l\'œuvre', 'artika'); ?></h3>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <section class="related-section">
        <h2><?php _e('œuvres similaires', 'artika'); ?></h2>
        <div class="related-grid">
            <?php
            $related_products = wc_get_related_products($product->get_id(), 4);
            if ($related_products) :
                foreach ($related_products as $related_product_id) :
                    $related_product = wc_get_product($related_product_id);
                    if (!$related_product) continue;
            ?>
            <div class="related-item">
                <div class="related-image">
                    <a href="<?php echo get_permalink($related_product_id); ?>">
                        <?php echo $related_product->get_image('medium'); ?>
                    </a>
                </div>
                <div class="related-info">
                    <div class="related-artist"><?php echo get_post_meta($related_product_id, '_artist_name', true); ?></div>
                    <div class="related-title">
                        <a href="<?php echo get_permalink($related_product_id); ?>">
                            <?php echo $related_product->get_name(); ?>
                        </a>
                    </div>
                    <div class="related-price"><?php echo $related_product->get_price_html(); ?></div>
                </div>
            </div>
            <?php 
                endforeach;
            endif;
            ?>
        </div>
    </section>

    <?php endwhile; ?>

<?php
get_footer('shop');