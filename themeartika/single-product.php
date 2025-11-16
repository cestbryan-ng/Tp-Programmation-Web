<?php
/**
 * Template pour afficher un produit individuel
 * Correspond à la page de détail d'une œuvre
 */

get_header();
?>

<div class="product-detail-container">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <?php global $product; ?>
        
        <div class="product-detail-wrapper">
            
            <!-- Images du produit -->
            <div class="product-detail-images">
                <?php
                // Galerie d'images WooCommerce
                woocommerce_show_product_images();
                ?>
            </div>
            
            <!-- Informations du produit -->
            <div class="product-detail-info">
                
                <div class="product-breadcrumb">
                    <?php woocommerce_breadcrumb(); ?>
                </div>
                
                <h1 class="product-detail-title"><?php the_title(); ?></h1>
                
                <?php
                $artist = get_post_meta(get_the_ID(), '_artist_name', true);
                if ($artist) :
                ?>
                <p class="product-detail-artist">Par <?php echo esc_html($artist); ?></p>
                <?php endif; ?>
                
                <div class="product-detail-price">
                    <?php echo $product->get_price_html(); ?>
                </div>
                
                <?php
                $dimensions = get_post_meta(get_the_ID(), '_dimensions', true);
                if ($dimensions) :
                ?>
                <div class="product-detail-dimensions">
                    <strong>Dimensions :</strong> <?php echo esc_html($dimensions); ?>
                </div>
                <?php endif; ?>
                
                <!-- Description courte -->
                <div class="product-detail-short-description">
                    <?php echo $product->get_short_description(); ?>
                </div>
                
                <!-- Attributs (Taille, Technique, Couleurs) -->
                <div class="product-detail-attributes">
                    <?php
                    $attributes = $product->get_attributes();
                    
                    if (!empty($attributes)) :
                        foreach ($attributes as $attribute) :
                            $attribute_name = wc_attribute_label($attribute->get_name());
                            $attribute_values = wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
                    ?>
                    <div class="attribute-row">
                        <span class="attribute-label"><?php echo esc_html($attribute_name); ?> :</span>
                        <span class="attribute-value"><?php echo implode(', ', $attribute_values); ?></span>
                    </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                
                <!-- Formulaire d'ajout au panier -->
                <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
                    <?php do_action('woocommerce_before_add_to_cart_button'); ?>
                    
                    <?php
                    if (!$product->is_sold_individually()) {
                        woocommerce_quantity_input(array(
                            'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                            'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                            'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                        ));
                    }
                    ?>
                    
                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt btn-add-cart">
                        <?php echo esc_html($product->single_add_to_cart_text()); ?>
                    </button>
                    
                    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
                </form>
                
                <!-- Informations supplémentaires -->
                <div class="product-detail-meta">
                    <?php if ($product->get_sku()) : ?>
                        <span class="sku-wrapper">
                            <strong>SKU :</strong> <?php echo esc_html($product->get_sku()); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php
                    $categories = get_the_terms($product->get_id(), 'product_cat');
                    if ($categories && !is_wp_error($categories)) :
                    ?>
                    <span class="category-wrapper">
                        <strong>Catégorie :</strong>
                        <?php
                        $category_names = array();
                        foreach ($categories as $category) {
                            $category_names[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                        }
                        echo implode(', ', $category_names);
                        ?>
                    </span>
                    <?php endif; ?>
                </div>
                
            </div>
            
        </div>
        
        <!-- Onglets (Description, Informations complémentaires, Avis) -->
        <div class="product-tabs-wrapper">
            <?php woocommerce_output_product_data_tabs(); ?>
        </div>
        
        <!-- Produits similaires -->
        <div class="related-products-wrapper">
            <?php woocommerce_output_related_products(); ?>
        </div>
        
    <?php endwhile; ?>
    
</div>

<style>
/* Styles pour la page produit détaillée */
.product-detail-container {
    max-width: 1400px;
    margin: 120px auto 60px;
    padding: 0 40px;
}

.product-detail-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-bottom: 60px;
}

.product-detail-images {
    position: sticky;
    top: 140px;
    height: fit-content;
    max-width: 500px;
}

.product-detail-images img {
    max-height: 600px;
    width: 100%;
    object-fit: contain;
    border-radius: 8px;
}

.product-detail-info {
    padding-top: 20px;
}

.product-breadcrumb {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

.product-detail-title {
    font-size: 36px;
    font-weight: 500;
    margin-bottom: 15px;
    color: #1a1a1a;
    letter-spacing: 1px;
}

.product-detail-artist {
    font-size: 18px;
    color: #666;
    font-style: italic;
    margin-bottom: 25px;
}

.product-detail-price {
    font-size: 32px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 20px;
}

.product-detail-dimensions {
    font-size: 16px;
    color: #333;
    margin-bottom: 25px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
}

.product-detail-short-description {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
}

.product-detail-attributes {
    border-top: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    padding: 25px 0;
    margin-bottom: 30px;
}

.attribute-row {
    display: flex;
    margin-bottom: 12px;
    font-size: 15px;
}

.attribute-label {
    font-weight: 600;
    min-width: 120px;
    color: #333;
}

.attribute-value {
    color: #666;
}

form.cart {
    margin-bottom: 30px;
}

.quantity {
    display: inline-block;
    margin-right: 15px;
}

.quantity input {
    width: 60px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-align: center;
}

.btn-add-cart {
    padding: 16px 40px !important;
    background-color: #1a1a1a !important;
    color: white !important;
    border: none !important;
    border-radius: 30px !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
}

.btn-add-cart:hover {
    background-color: #333 !important;
    transform: translateY(-2px);
}

.product-detail-meta {
    font-size: 14px;
    color: #666;
    padding: 20px 0;
    border-top: 1px solid #e0e0e0;
}

.product-detail-meta span {
    display: block;
    margin-bottom: 10px;
}

.product-tabs-wrapper {
    margin: 60px 0;
}

.related-products-wrapper {
    margin-top: 80px;
}

/* Responsive */
@media (max-width: 968px) {
    .product-detail-wrapper {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .product-detail-images {
        position: relative;
        top: 0;
    }
    
    .product-detail-title {
        font-size: 28px;
    }
    
    .product-detail-price {
        font-size: 26px;
    }
}
</style>

<?php get_footer(); ?>