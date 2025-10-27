<?php
/* Template single product */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        $post_id = get_the_ID();
        $price = get_post_meta( $post_id, '_themeartika_price', true );
        $stock = get_post_meta( $post_id, '_themeartika_stock', true );
        $image = get_the_post_thumbnail_url( $post_id, 'large' );
        if ( ! $image ) {
            $image = get_template_directory_uri() . '/images/accueil/hero.jpg';
        }
        $content = get_the_content();
        $artist = get_the_author();

        $partial = get_template_directory() . '/htm/partials/description.html';
        if ( file_exists( $partial ) ) {
            $html = file_get_contents( $partial );
            if ( $html !== false ) {
                // Load fragment and replace nodes by class
                libxml_use_internal_errors(true);
                $doc = new DOMDocument();
                // Ensure proper encoding
                $doc->loadHTML('<?xml encoding="utf-8" ?><div id="partial-root">' . $html . '</div>');
                $xpath = new DOMXPath( $doc );

                // product title
                $nodes = $xpath->query("//*[contains(@class,'product-title')]");
                foreach ( $nodes as $n ) {
                    while ( $n->hasChildNodes() ) { $n->removeChild( $n->firstChild ); }
                    $n->appendChild( $doc->createTextNode( get_the_title() ) );
                }

                // artist
                $nodes = $xpath->query("//*[contains(@class,'artist-link')]");
                foreach ( $nodes as $n ) {
                    while ( $n->hasChildNodes() ) { $n->removeChild( $n->firstChild ); }
                    $n->appendChild( $doc->createTextNode( $artist ) );
                }

                // price
                $nodes = $xpath->query("//*[contains(@class,'product-price')]");
                foreach ( $nodes as $n ) {
                    while ( $n->hasChildNodes() ) { $n->removeChild( $n->firstChild ); }
                    $price_text = $price ? number_format_i18n( intval( $price ), 0 ) . ' FCFA' : 'Prix sur demande';
                    $n->appendChild( $doc->createTextNode( $price_text ) );
                }

                // main image
                $nodes = $xpath->query("//img[contains(@src,'assets/images') or contains(@class,'main-image') or contains(@class,'image-placeholder')]");
                if ( $nodes->length > 0 ) {
                    // replace first encountered img src
                    $img = $nodes->item(0);
                    $img->setAttribute( 'src', esc_url( $image ) );
                } else {
                    // try more specific
                    $nodes = $xpath->query("//*[contains(@class,'main-image')]//img");
                    if ( $nodes->length > 0 ) {
                        $nodes->item(0)->setAttribute( 'src', esc_url( $image ) );
                    }
                }

                // description-section
                $nodes = $xpath->query("//*[contains(@class,'description-section')]");
                foreach ( $nodes as $n ) {
                    // replace innerHTML with post content
                    // remove children
                    while ( $n->hasChildNodes() ) { $n->removeChild( $n->firstChild ); }
                    // create a fragment from the content
                    $frag = $doc->createDocumentFragment();
                    $frag->appendXML( wp_kses_post( apply_filters( 'the_content', $content ) ) );
                    $n->appendChild( $frag );
                }

                // Related products: we'll let the static partial remain

                // Output processed fragment (inner of #partial-root)
                $root = $doc->getElementById('partial-root');
                $out = '';
                if ( $root ) {
                    foreach ( $root->childNodes as $child ) {
                        $out .= $doc->saveHTML( $child );
                    }
                }

                // Ensure asset paths are fixed (convert relative to theme URI)
                if ( function_exists( 'themeartika_process_html_content' ) ) {
                    echo themeartika_process_html_content( $out );
                } else {
                    echo $out;
                }

                libxml_clear_errors();

            } else {
                // fallback
                ?>
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title(); ?>" style="max-width:300px;">
                    <div class="price"><?php echo $price ? number_format_i18n( intval( $price ), 0 ) . ' FCFA' : 'Prix sur demande'; ?></div>
                    <div class="description"><?php the_content(); ?></div>
                </div>
                <?php
            }
        } else {
            // partial not found: fallback to simple layout
            ?>
            <div class="container product-single">
                <div class="product-left">
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title(); ?>" style="width:100%;max-width:600px;">
                </div>
                <div class="product-right">
                    <h1><?php the_title(); ?></h1>
                    <p class="artist"><?php echo esc_html( $artist ); ?></p>
                    <div class="price"><?php echo $price ? number_format_i18n( intval( $price ), 0 ) . ' FCFA' : 'Prix sur demande'; ?></div>
                    <div class="stock">Stock: <?php echo intval( $stock ); ?></div>
                    <div class="description"><?php the_content(); ?></div>
                </div>
            </div>
            <?php
        }

    endwhile;
endif;

get_footer();
