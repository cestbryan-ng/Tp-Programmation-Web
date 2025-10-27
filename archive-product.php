<?php
/* Archive produits */
get_header();

// Query for products
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'paged' => $paged,
);
$loop = new WP_Query( $args );
?>
<div class="container">
    <h1>Nos produits</h1>
    <div class="products-grid">
    <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <div class="product-card">
            <a href="<?php the_permalink(); ?>">
                <div class="product-image">
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } else { ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/accueil/peintures.jpg' ); ?>" alt="<?php the_title(); ?>">
                    <?php } ?>
                </div>
                <div class="product-info">
                    <h3><?php the_title(); ?></h3>
                    <div class="price"><?php echo get_post_meta( get_the_ID(), '_themeartika_price', true ) ? number_format_i18n( intval( get_post_meta( get_the_ID(), '_themeartika_price', true ) ), 0 ) . ' FCFA' : 'Prix sur demande'; ?></div>
                </div>
            </a>
        </div>
    <?php endwhile; wp_reset_postdata(); else: ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>
    </div>

    <?php
    // Pagination
    the_posts_pagination();
    ?>
</div>

<?php get_footer();
