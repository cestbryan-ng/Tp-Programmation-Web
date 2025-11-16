<?php
/**
 * Cart Page - Page Panier personnalisée
 * 
 * Ce fichier doit être placé dans :
 * wp-content/themes/artika/woocommerce/cart/cart.php
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="cart-page-container">
    <h1 class="cart-page-title">Mon Panier</h1>
    
    <?php if (WC()->cart->is_empty()) : ?>
        
        <div class="cart-empty">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
                <circle cx="60" cy="60" r="58" stroke="#E5E5E5" stroke-width="4"/>
                <path d="M30 30l60 60M30 90l60-60" stroke="#E5E5E5" stroke-width="4" stroke-linecap="round"/>
            </svg>
            <h2>Votre panier est vide</h2>
            <p>Découvrez nos magnifiques œuvres d'art</p>
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn-continuer-shopping">
                Découvrir nos œuvres
            </a>
        </div>
        
    <?php else : ?>
        
        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>

            <div class="cart-items-wrapper">
                <table class="shop_table cart woocommerce-cart-form__contents">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Image</th>
                            <th class="product-name">Produit</th>
                            <th class="product-price">Prix</th>
                            <th class="product-quantity">Quantité</th>
                            <th class="product-subtotal">Total</th>
                            <th class="product-remove"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action('woocommerce_before_cart_contents'); ?>

                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                ?>
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                    <td class="product-thumbnail">
                                        <?php
                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                        if (!$product_permalink) {
                                            echo $thumbnail;
                                        } else {
                                            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                        }
                                        ?>
                                    </td>

                                    <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                        <?php
                                        if (!$product_permalink) {
                                            echo wp_kses_post($_product->get_name());
                                        } else {
                                            echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                        }
                                        
                                        // Afficher l'artiste si disponible
                                        $artist = get_post_meta($product_id, '_artist_name', true);
                                        if ($artist) {
                                            echo '<span class="product-artist">Par ' . esc_html($artist) . '</span>';
                                        }
                                        ?>
                                    </td>

                                    <td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                        <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                                    </td>

                                    <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                        <?php
                                        if ($_product->is_sold_individually()) {
                                            $min_quantity = 1;
                                            $max_quantity = 1;
                                        } else {
                                            $min_quantity = 0;
                                            $max_quantity = $_product->get_max_purchase_quantity();
                                        }

                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $max_quantity,
                                                'min_value'    => $min_quantity,
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );

                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                        ?>
                                    </td>

                                    <td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                                        <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                    </td>

                                    <td class="product-remove">
                                        <?php
                                        echo apply_filters(
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M15 5L5 15M5 5L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </a>',
                                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                esc_html__('Remove this item', 'woocommerce'),
                                                esc_attr($product_id),
                                                esc_attr($_product->get_sku())
                                            ),
                                            $cart_item_key
                                        );
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php do_action('woocommerce_cart_contents'); ?>

                        <tr>
                            <td colspan="6" class="actions">
                                <button type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
                                    <?php esc_html_e('Mettre à jour le panier', 'woocommerce'); ?>
                                </button>

                                <?php do_action('woocommerce_cart_actions'); ?>

                                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                            </td>
                        </tr>

                        <?php do_action('woocommerce_after_cart_contents'); ?>
                    </tbody>
                </table>
            </div>

            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>

        <div class="cart-collaterals">
            <div class="cart-totals-wrapper">
                <?php woocommerce_cart_totals(); ?>
                
                <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button button alt wc-forward">
                    Procéder au paiement
                </a>
                
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="continue-shopping">
                    ← Continuer mes achats
                </a>
            </div>
        </div>

    <?php endif; ?>

    <?php do_action('woocommerce_after_cart'); ?>
</div>

<style>
/* Styles pour la page panier */
.cart-page-container {
    max-width: 1200px;
    margin: 150px auto 60px;
    padding: 0 40px;
}

.cart-page-title {
    font-size: 36px;
    font-weight: 500;
    margin-bottom: 40px;
    text-align: center;
    letter-spacing: 1px;
}

/* Panier vide */
.cart-empty {
    text-align: center;
    padding: 80px 20px;
}

.cart-empty svg {
    margin-bottom: 30px;
}

.cart-empty h2 {
    font-size: 28px;
    font-weight: 500;
    margin-bottom: 15px;
    color: #1a1a1a;
}

.cart-empty p {
    font-size: 16px;
    color: #666;
    margin-bottom: 30px;
}

.btn-continuer-shopping {
    display: inline-block;
    padding: 16px 40px;
    background: #1a1a1a;
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    transition: all 0.3s ease;
}

.btn-continuer-shopping:hover {
    background: #333;
    transform: translateY(-2px);
}

/* Tableau du panier */
.cart-items-wrapper {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.shop_table {
    width: 100%;
    border-collapse: collapse;
}

.shop_table thead {
    background: #f8f9fa;
}

.shop_table thead th {
    padding: 20px 15px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #1a1a1a;
}

.shop_table tbody tr {
    border-bottom: 1px solid #e5e5e5;
}

.shop_table tbody td {
    padding: 25px 15px;
    vertical-align: middle;
}

.product-thumbnail img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 6px;
}

.product-name {
    font-size: 16px;
    font-weight: 500;
}

.product-name a {
    color: #1a1a1a;
    text-decoration: none;
}

.product-name a:hover {
    color: #666;
}

.product-artist {
    display: block;
    font-size: 13px;
    color: #999;
    font-style: italic;
    margin-top: 5px;
}

.product-price,
.product-subtotal {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
}

.product-quantity input {
    width: 60px;
    padding: 8px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.product-remove .remove {
    color: #999;
    transition: color 0.3s ease;
}

.product-remove .remove:hover {
    color: #e74c3c;
}

.actions {
    background: #f8f9fa;
    padding: 20px !important;
}

.update-cart {
    padding: 12px 30px;
    background: #1a1a1a;
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.update-cart:hover {
    background: #333;
    transform: translateY(-2px);
}

/* Totaux du panier */
.cart-collaterals {
    display: flex;
    justify-content: flex-end;
}

.cart-totals-wrapper {
    width: 100%;
    max-width: 500px;
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.cart_totals h2 {
    font-size: 22px;
    font-weight: 500;
    margin-bottom: 20px;
}

.cart_totals table {
    width: 100%;
    margin-bottom: 25px;
}

.cart_totals th,
.cart_totals td {
    padding: 12px 0;
    border-bottom: 1px solid #e5e5e5;
}

.cart_totals th {
    text-align: left;
    font-weight: 500;
}

.cart_totals td {
    text-align: right;
    font-weight: 600;
}

.order-total th,
.order-total td {
    font-size: 20px;
    padding-top: 20px;
    border-bottom: none;
}

.checkout-button {
    display: block;
    width: 100%;
    padding: 18px;
    background: #1a1a1a !important;
    color: white !important;
    text-align: center;
    text-decoration: none;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.checkout-button:hover {
    background: #333 !important;
    transform: translateY(-2px);
}

.continue-shopping {
    display: block;
    text-align: center;
    color: #666;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.continue-shopping:hover {
    color: #1a1a1a;
}

/* Responsive */
@media (max-width: 768px) {
    .cart-page-container {
        padding: 0 20px;
        margin-top: 120px;
    }
    
    .shop_table thead {
        display: none;
    }
    
    .shop_table tbody tr {
        display: block;
        margin-bottom: 20px;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 15px;
    }
    
    .shop_table tbody td {
        display: block;
        padding: 10px 0;
        border: none;
        text-align: left;
    }
    
    .shop_table tbody td:before {
        content: attr(data-title) ": ";
        font-weight: 600;
        display: inline-block;
        margin-right: 10px;
    }
    
    .product-thumbnail {
        text-align: center;
        margin-bottom: 15px;
    }
    
    .cart-collaterals {
        justify-content: center;
    }
    
    .cart-totals-wrapper {
        max-width: 100%;
    }
}
</style>