<?php
/**
 * Template Name: Page Login
 * Description: Template personnalisé pour la page de connexion
 */

get_header(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artika | Connexion</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/login.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
</head>
<body>
    <!-- Conteneur principal -->
    <div class="conteneur-principal">
      <div class="conteneur-centre">
        <div class="rangee-centre">
          <!-- Formulaire de connexion -->
          <div class="bloc-formulaire">
            <div class="panneau-formulaire">
              <div class="conteneur-formulaire">
                <!-- En-tête du formulaire : logo et slogan -->
                <div class="entete-formulaire">
                  <img
                    class="logo-principal"
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/ARTIKA_blk.png"
                    alt="Logo Artika"
                  />
                  <p>Là où l'art africain prend vie</p>
                </div>
                <div class="zone-formulaire">
                  <!-- Formulaire de connexion -->
                  <form method="post" action="">
                    <?php wp_nonce_field('artika_login_action', 'artika_login_nonce'); ?>
                    
                    <!-- Champ e-mail -->
                    <div class="groupe-champs">
                      <div class="champ-conteneur">
                        <input
                          type="text"
                          id="email"
                          name="email"
                          class="controle-formulaire"
                          required
                        />
                        <label class="etiquette-flottante" for="email"
                          >Adresse e-mail*</label
                        >
                        <small class="message-erreur"></small>
                      </div>
                      <!-- Champ mot de passe -->
                      <div class="champ-conteneur">
                        <input
                          type="password"
                          id="motdepasse"
                          name="motdepasse"
                          class="controle-formulaire"
                          required
                        />
                        <label class="etiquette-flottante" for="motdepasse"
                          >Mot de passe*</label
                        >
                        <i class="fa-regular fa-eye afficher-password"></i>
                        <small class="message-erreur"></small>
                      </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <button
                      class="bouton bouton-principal bouton-pleine-largeur"
                      type="submit"
                      name="login_submit"
                    >
                      Me connecter
                    </button>
                  </form>

                  <!-- Lien vers l'inscription -->
                  <div class="texte-secondaire">
                    Nouveau client ?
                    <a class="lien-gras" href="<?php echo home_url('/signup'); ?>">Créer un compte</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/login.js"></script>
</body>
</html>

<?php get_footer(); ?>