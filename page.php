<?php
/**
 * page.php
 * Template générique : si un fichier `htm/{slug}.html` existe, l'inclut
 * et remplace les chemins d'assets via themeartika_get_processed_html().
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        $slug = get_post_field( 'post_name', get_post() );
        $static = false;

        // Prefer partial generated in htm/partials/{slug}.html (body only)
        $partial_path = get_template_directory() . '/htm/partials/' . $slug . '.html';
        if ( file_exists( $partial_path ) ) {
            $content = file_get_contents( $partial_path );
            if ( $content !== false && function_exists( 'themeartika_process_html_content' ) ) {
                $static = themeartika_process_html_content( $content );
            } else {
                $static = $content;
            }
        } else {
            if ( function_exists( 'themeartika_get_processed_html' ) ) {
                $static = themeartika_get_processed_html( $slug );
            }
        }

        if ( $static !== false ) {
            // Afficher le contenu statique traité
            echo $static;
        } else {
            // Fallback : afficher le contenu WP classique
            ?>
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
        }
    endwhile;
endif;

get_footer();
