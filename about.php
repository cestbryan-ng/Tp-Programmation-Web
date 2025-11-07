<?php
/**
 * Template Name: Page À Propos
 * Description: Template personnalisé pour la page À propos
 */

get_header(); ?>

    <!-- BannIÃ¨re Promotionnelle -->
    <div class="promo-banner">
        <p><?php echo get_theme_mod('promo_banner_text', 'Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.'); ?></p>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1><?php echo get_theme_mod('about_hero_title', 'Là où l\'art prend vie'); ?></h1>
            <p><?php echo get_theme_mod('about_hero_text', 'Notre mission est de vous offrir bien plus qu\'une simple vente. Nous vous présentons des œuvres de qualité exceptionnelle et inédites, créées par des artistes passionnés qui sauront vous inspirer et vous émerveiller.'); ?></p>
        </div>
    </section>

    <!-- A propos Section 1 -->
    <section class="about-section">
        <div class="about-text">
            <h2><?php _e('Notre Histoire', 'artika'); ?></h2>
            <?php
            $about_section_1 = get_theme_mod('about_section_1', '
                <p>Fondée par des passionnés d\'art, notre galerie est née d\'une question simple : comment rendre l\'art authentique accessible à tous ? Nous avons découvert que la réponse résidait dans la création d\'une plateforme où les artistes talentueux peuvent partager leurs créations avec le monde.</p>
                <p>Chaque œuvre sur notre site est le fruit d\'un travail minutieux, d\'une vision unique et d\'une passion débordante. Nous garantissons l\'authenticité et l\'originalité de chaque création.</p>
            ');
            echo wp_kses_post($about_section_1);
            ?>
        </div>
        <div class="about-image">
            <span>
                <img src="<?php echo get_theme_mod('about_image_1', get_template_directory_uri() . '/assets/images/ji.jpeg'); ?>" alt="<?php _e('Notre galerie d\'art et nos artistes', 'artika'); ?>">
            </span>
        </div>
    </section>

    <!-- A propos Section 2 -->
    <section class="about-section reverse">
        <div class="about-text">
            <h2><?php _e('Des œuvres Uniques et Originales', 'artika'); ?></h2>
            <?php
            $about_section_2 = get_theme_mod('about_section_2', '
                <p>Nous croyons que l\'art doit être unique et authentique. C\'est pourquoi nous travaillons exclusivement avec des artistes qui créent des œuvres originales, jamais plagiées ou reproduites.</p>
                <p>Chaque pièce de notre collection est soigneusement sélectionnée pour sa qualité artistique, son originalité et l\'émotion qu\'elle véhicule. Nous vous offrons l\'assurance d\'acquérir une œuvre authentique qui enrichira votre collection.</p>
            ');
            echo wp_kses_post($about_section_2);
            ?>
        </div>
        <div class="about-image">
            <span>
                <img src="<?php echo get_theme_mod('about_image_2', get_template_directory_uri() . '/assets/images/jn.jpeg'); ?>" alt="<?php _e('œuvres d\'art uniques et originales', 'artika'); ?>">
            </span>
        </div>
    </section>

    <!-- Section statistiques -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-item">
                <h3><?php echo get_theme_mod('stat_1_number', '100%'); ?></h3>
                <p><?php echo get_theme_mod('stat_1_text', 'œuvres originales garanties sans plagiat'); ?></p>
            </div>
            <div class="stat-item">
                <h3><?php echo get_theme_mod('stat_2_number', '200+'); ?></h3>
                <p><?php echo get_theme_mod('stat_2_text', 'Artistes talentueux dans notre réseau'); ?></p>
            </div>
            <div class="stat-item">
                <h3><?php echo get_theme_mod('stat_3_number', '1500+'); ?></h3>
                <p><?php echo get_theme_mod('stat_3_text', 'œuvres d\'art uniques disponibles'); ?></p>
            </div>
        </div>
    </section>

    <!-- A propos Section 3 -->
    <section class="about-section">
        <div class="about-text">
            <h2><?php _e('Transparence et Authenticité', 'artika'); ?></h2>
            <?php
            $about_section_3 = get_theme_mod('about_section_3', '
                <p>Nous croyons en la transparence totale. Chaque œuvre est accompagnée d\'un certificat d\'authenticité et d\'informations détaillées sur l\'artiste, les matériaux utilisés et l\'histoire de la création.</p>
                <p>De l\'atelier de l\'artiste à votre intérieur, nous vous accompagnons à chaque étape pour garantir une expérience d\'achat exceptionnelle.</p>
            ');
            echo wp_kses_post($about_section_3);
            ?>
        </div>
        <div class="about-image">
            <span>
                <img src="<?php echo get_theme_mod('about_image_3', get_template_directory_uri() . '/assets/images/jo.jpeg'); ?>" alt="<?php _e('œuvres d\'art uniques et originales', 'artika'); ?>">
            </span>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <h2><?php _e('Nos Valeurs Fondamentales', 'artika'); ?></h2>
        <div class="values-grid">
            <?php
            $values = array(
                array(
                    'title' => get_theme_mod('value_1_title', 'Authenticité Absolue'),
                    'text' => get_theme_mod('value_1_text', 'Nous garantissons que chaque œuvre est 100% originale, créée par des artistes passionnés et jamais plagiée.')
                ),
                array(
                    'title' => get_theme_mod('value_2_title', 'Excellence Artistique'),
                    'text' => get_theme_mod('value_2_text', 'Nous sélectionnons uniquement des œuvres de haute qualité qui témoignent d\'un savoir-faire exceptionnel.')
                ),
                array(
                    'title' => get_theme_mod('value_3_title', 'Transparence Totale'),
                    'text' => get_theme_mod('value_3_text', 'Nous partageons l\'histoire de chaque artiste et de chaque œuvre pour que vous sachiez exactement ce que vous achetez.')
                )
            );

            foreach ($values as $value) :
            ?>
            <div class="value-card">
                <h3><?php echo esc_html($value['title']); ?></h3>
                <p><?php echo esc_html($value['text']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

<?php get_footer(); ?>