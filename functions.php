<?php
/**
 * themeartika functions.php
 * Enqueue styles and provide helper to include static HTML from htm/ with corrected asset paths.
 */

if ( ! function_exists( 'themeartika_enqueue_styles' ) ) {
    function themeartika_enqueue_styles() {
        // Main stylesheet
        $style_path = get_template_directory() . '/style.css';
        if ( file_exists( $style_path ) ) {
            wp_enqueue_style( 'themeartika-style', get_stylesheet_uri(), array(), filemtime( $style_path ) );
        } else {
            wp_enqueue_style( 'themeartika-style', get_stylesheet_uri() );
        }

        // Enqueue any other .css files in theme root (except style.css)
        foreach ( glob( get_template_directory() . '/*.css' ) as $css_file ) {
            if ( basename( $css_file ) === 'style.css' ) {
                continue;
            }
            $handle = 'themeartika-' . preg_replace( '/[^a-z0-9_\-]+/i', '-', basename( $css_file, '.css' ) );
            wp_enqueue_style( $handle, get_template_directory_uri() . '/' . basename( $css_file ), array( 'themeartika-style' ), filemtime( $css_file ) );
        }
    }
    add_action( 'wp_enqueue_scripts', 'themeartika_enqueue_styles' );
}


    // --------- Product CPT & Metaboxes ----------
    if ( ! function_exists( 'themeartika_register_product_cpt' ) ) {
        function themeartika_register_product_cpt() {
            $labels = array(
                'name'               => 'Produits',
                'singular_name'      => 'Produit',
                'menu_name'          => 'Produits',
                'name_admin_bar'     => 'Produit',
                'add_new'            => 'Ajouter',
                'add_new_item'       => 'Ajouter un produit',
                'new_item'           => 'Nouveau produit',
                'edit_item'          => 'Modifier le produit',
                'view_item'          => 'Voir le produit',
                'all_items'          => 'Tous les produits',
                'search_items'       => 'Rechercher des produits',
                'not_found'          => 'Aucun produit trouvé',
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'has_archive'        => true,
                'rewrite'            => array( 'slug' => 'produits' ),
                'show_in_rest'       => true,
                'supports'           => array( 'title', 'editor', 'thumbnail' ),
                'menu_position'      => 5,
                'menu_icon'          => 'dashicons-products',
            );

            register_post_type( 'product', $args );

            // taxonomy for categories
            $tax_labels = array(
                'name' => 'Catégories produit',
                'singular_name' => 'Catégorie produit',
                'search_items' => 'Rechercher des catégories',
                'all_items' => 'Toutes les catégories',
                'edit_item' => 'Modifier la catégorie',
                'update_item' => 'Mettre à jour',
                'add_new_item' => 'Ajouter une catégorie',
                'new_item_name' => 'Nouvelle catégorie',
                'menu_name' => 'Catégories',
            );

            register_taxonomy( 'product_cat', array( 'product' ), array(
                'hierarchical' => true,
                'labels' => $tax_labels,
                'show_ui' => true,
                'show_in_rest' => true,
                'rewrite' => array( 'slug' => 'categorie-produit' ),
            ) );
        }
        add_action( 'init', 'themeartika_register_product_cpt' );
    }

    // Support miniatures
    add_action( 'after_setup_theme', function() {
        add_theme_support( 'post-thumbnails' );
    } );

    // Metaboxes: price, stock
    function themeartika_add_product_metaboxes() {
        add_meta_box( 'themeartika_product_details', 'Détails produit', 'themeartika_render_product_metabox', 'product', 'normal', 'high' );
    }
    add_action( 'add_meta_boxes', 'themeartika_add_product_metaboxes' );

    function themeartika_render_product_metabox( $post ) {
        wp_nonce_field( 'themeartika_save_product', 'themeartika_product_nonce' );
        $price = get_post_meta( $post->ID, '_themeartika_price', true );
        $stock = get_post_meta( $post->ID, '_themeartika_stock', true );
        ?>
        <p>
            <label for="themeartika_price">Prix (en FCFA)</label><br>
            <input type="number" step="1" min="0" name="themeartika_price" id="themeartika_price" value="<?php echo esc_attr( $price ); ?>" style="width:200px;">
        </p>
        <p>
            <label for="themeartika_stock">Stock</label><br>
            <input type="number" step="1" min="0" name="themeartika_stock" id="themeartika_stock" value="<?php echo esc_attr( $stock ); ?>" style="width:200px;">
        </p>
        <p>Utilisez l'image mise en avant pour l'image du produit.</p>
        <?php
    }

    function themeartika_save_product( $post_id ) {
        if ( ! isset( $_POST['themeartika_product_nonce'] ) ) {
            return;
        }
        if ( ! wp_verify_nonce( $_POST['themeartika_product_nonce'], 'themeartika_save_product' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( isset( $_POST['post_type'] ) && 'product' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        if ( isset( $_POST['themeartika_price'] ) ) {
            $price = intval( $_POST['themeartika_price'] );
            update_post_meta( $post_id, '_themeartika_price', $price );
        }
        if ( isset( $_POST['themeartika_stock'] ) ) {
            $stock = intval( $_POST['themeartika_stock'] );
            update_post_meta( $post_id, '_themeartika_stock', $stock );
        }
    }
    add_action( 'save_post', 'themeartika_save_product' );


if ( ! function_exists( 'themeartika_get_processed_html' ) ) {
    /**
     * Retourne le contenu HTML d'un fichier `htm/{slug}.html` en remplaçant
     * les chemins relatifs d'assets (images/, css/, pots/, tubes/, etc.) par
     * l'URL absolue du thème (get_template_directory_uri()).
     * Remplace aussi les liens vers `*.html` par des URLs WP (home_url('/slug')).
     *
     * @param string $slug
     * @return string|false Contenu traité ou false si fichier introuvable
     */
    /**
     * Traite une chaîne HTML : préfixe les src/href relatifs par l'URL du thème
     * et convertit les liens *.html en permaliens WP.
     *
     * @param string $content
     * @return string
     */
    function themeartika_process_html_content( $content ) {
        $base_uri = get_template_directory_uri();

        // 1) Préfixer les src/href relatifs (ne commençant pas par http(s):// ou /) par get_template_directory_uri()
        $content = preg_replace_callback('#(src|href)=([\'\"])(?!https?://|/)([^\'\"]+)\2#i', function( $m ) use ( $base_uri ) {
            $attr = $m[1];
            $quote = $m[2];
            $path = $m[3];
            // Retirer ./ ou ../ en tête
            $path = preg_replace('#^(\./|\.\./)+#', '', $path);
            return $attr . '=' . $quote . $base_uri . '/' . $path . $quote;
        }, $content );

        // 2) Remplacer les liens vers des fichiers .html par l'URL du slug correspondant
        $content = preg_replace_callback('#href=([\'\"])([^\'\"]+?)\.html([\'\"])#i', function( $m ) {
            $slug = basename( $m[2] );
            return 'href="' . esc_url( home_url( '/' . $slug ) ) . '"';
        }, $content );

        return $content;
    }

    function themeartika_get_processed_html( $slug ) {
        $file = get_template_directory() . '/htm/' . $slug . '.html';
        if ( ! file_exists( $file ) ) {
            return false;
        }
        $content = file_get_contents( $file );
        if ( $content === false ) {
            return false;
        }

        return themeartika_process_html_content( $content );
    }
}
