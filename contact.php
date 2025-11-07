<?php get_header(); ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contactez-nous</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <div class="promo-banner">
        <p><?php echo get_theme_mod('promo_banner_text', 'Livraison gratuite pour les commandes de plus de 75 000 FCFA. Retours faciles.'); ?></p>
    </div>

    <div class="page-content">
        <!-- Hero Section -->
        <section class="contact-hero">
            <h1><?php _e('Contactez-nous', 'artika'); ?></h1>
            <p><?php _e('Une question, une suggestion ou besoin d\'aide ? Notre équipe est là pour vous accompagner.', 'artika'); ?></p>
        </section>

        <!-- Contact Main Content -->
        <div class="contact-main">
            <div class="contact-grid">
                <!-- Formulaire de contact -->
                <div class="form-card">
                    <h2><?php _e('Envoyez-nous un message', 'artika'); ?></h2>
                    
                    <?php
                    // Afficher les messages de succès ou d'erreur
                    if (isset($_GET['contact']) && $_GET['contact'] == 'success') {
                        echo '<div class="alert alert-success">' . __('Votre message a été envoyé avec succès !', 'artika') . '</div>';
                    } elseif (isset($_GET['contact']) && $_GET['contact'] == 'error') {
                        echo '<div class="alert alert-error">' . __('Une erreur s\'est produite. Veuillez réessayer.', 'artika') . '</div>';
                    }
                    ?>
                    
                    <form id="contactForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="submit_contact_form">
                        <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                        
                        <div class="form-group">
                            <label for="name"><?php _e('Nom complet', 'artika'); ?></label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email"><?php _e('Email', 'artika'); ?></label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject"><?php _e('Sujet', 'artika'); ?></label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message"><?php _e('Message', 'artika'); ?></label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn-submit"><?php _e('Envoyer le message', 'artika'); ?></button>
                    </form>
                </div>

                <!-- Informations de contact -->
                <div class="info-cards">
                    <div class="info-card">
                        <h3><?php _e('Nos coordonnées', 'artika'); ?></h3>
                        <div class="info-item">
                            <div class="info-label"><?php _e('Adresse', 'artika'); ?></div>
                            <div class="info-value">
                                <?php 
                                echo get_theme_mod('contact_address', 'Quartier Bastos<br>Yaoundé, Cameroun'); 
                                ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><?php _e('Téléphone', 'artika'); ?></div>
                            <div class="info-value">
                                <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '+237123456789')); ?>">
                                    <?php echo get_theme_mod('contact_phone_display', '+237 123 456 789'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><?php _e('Email', 'artika'); ?></div>
                            <div class="info-value">
                                <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'contact@artika.com')); ?>">
                                    <?php echo get_theme_mod('contact_email', 'contact@artika.com'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3><?php _e('Horaires d\'ouverture', 'artika'); ?></h3>
                        <div class="info-item">
                            <div class="info-label"><?php _e('Lundi - Vendredi', 'artika'); ?></div>
                            <div class="info-value"><?php echo get_theme_mod('hours_weekday', '9h00 - 18h00'); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><?php _e('Samedi', 'artika'); ?></div>
                            <div class="info-value"><?php echo get_theme_mod('hours_saturday', '10h00 - 16h00'); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><?php _e('Dimanche', 'artika'); ?></div>
                            <div class="info-value"><?php echo get_theme_mod('hours_sunday', 'Fermé'); ?></div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3><?php _e('Questions fréquentes', 'artika'); ?></h3>
                        <div class="faq-list">
                            <?php
                            // Récupérer les FAQ depuis un Custom Post Type ou options
                            $faqs = array(
                                array(
                                    'question' => __('Comment passer commande ?', 'artika'),
                                    'answer' => __('Parcourez notre catalogue, sélectionnez vos œuvres favorites et ajoutez-les au panier. Finalisez votre commande en quelques clics.', 'artika')
                                ),
                                array(
                                    'question' => __('Quels sont les modes de paiement acceptés ?', 'artika'),
                                    'answer' => __('Nous acceptons les cartes bancaires, Mobile Money et les virements bancaires.', 'artika')
                                ),
                                array(
                                    'question' => __('Livrez-vous à l\'international ?', 'artika'),
                                    'answer' => __('Oui, nous livrons dans le monde entier. Les frais de livraison varient selon la destination.', 'artika')
                                )
                            );

                            foreach ($faqs as $faq) :
                            ?>
                            <div class="faq-item">
                                <div class="faq-question"><?php echo esc_html($faq['question']); ?></div>
                                <div class="faq-answer"><?php echo esc_html($faq['answer']); ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>