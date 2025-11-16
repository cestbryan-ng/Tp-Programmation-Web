<?php
/**
 * Page Inscription
 */

get_header(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artika | Inscription</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/signup.css" />
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
          <!-- Formulaire d'inscription -->
          <div class="bloc-formulaire">
            <div class="panneau-formulaire">
              <div class="conteneur-formulaire">
                <!-- En-tête du formulaire -->
                <div class="entete-formulaire">
                  <img
                    class="logo-principal"
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/ARTIKA_blk.png"
                    alt="Logo Artika"
                  />
                  <p>Là où l'art africain prend vie</p>
                </div>
                <div class="zone-formulaire">
                  <!-- Formulaire -->
                  <form method="post" action="">
                    <?php wp_nonce_field('artika_signup_action', 'artika_signup_nonce'); ?>
                    
                    <div class="groupe-champs">
                      <!-- Champ nom -->
                      <div class="champ-conteneur">
                        <input
                          type="text"
                          id="nom"
                          name="nom"
                          class="controle-formulaire"
                          required
                        />
                        <label class="etiquette-flottante" for="nom">Nom*</label>
                        <small class="message-erreur"></small>
                      </div>
                      
                      <!-- Champ prénom -->
                      <div class="champ-conteneur">
                        <input
                          type="text"
                          id="prenom"
                          name="prenom"
                          class="controle-formulaire"
                          required
                        />
                        <label class="etiquette-flottante" for="prenom">Prénom*</label>
                        <small class="message-erreur"></small>
                      </div>
                      
                      <!-- Champ e-mail -->
                      <div class="champ-conteneur">
                        <input
                          type="email"
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
                      
                      <!-- Champ confirmation de mot de passe -->
                      <div class="champ-conteneur">
                        <input
                          type="password"
                          id="confirmer-motdepasse"
                          name="confirmer-motdepasse"
                          class="controle-formulaire"
                          required
                        />
                        <label
                          class="etiquette-flottante"
                          for="confirmer-motdepasse"
                          >Confirmer le mot de passe*</label
                        >
                        <i class="fa-regular fa-eye afficher-password"></i>
                        <small class="message-erreur"></small>
                      </div>
                    </div>

                    <!-- Bouton d'inscription -->
                    <button
                      class="bouton bouton-principal bouton-pleine-largeur"
                      type="submit"
                      name="signup_submit"
                    >
                      Créer un compte
                    </button>
                  </form>

                  <!-- Lien vers la connexion -->
                  <div class="texte-secondaire">
                    Déjà client ?
                    <a class="lien-gras" href="<?php echo home_url('/login'); ?>">Se connecter</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/signup.js"></script>
</body>
</html>

<?php get_footer(); ?>