// Compte admin prédéfini
const compteAdmin = {
    email: 'admin@gmail.com',
    nomUtilisateur: 'admin',
    motdepasse: '12345'
};

document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'affichage/masquage des mots de passe
    const iconesMotDePasse = document.querySelectorAll('.afficher-password');
    
    iconesMotDePasse.forEach(icone => {
        icone.addEventListener('click', function() {
            const conteneurParent = this.parentElement;
            const champMotDePasse = conteneurParent.querySelector('.controle-formulaire');
            
            if (champMotDePasse.type === 'password') {
                champMotDePasse.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                champMotDePasse.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });

    // Récupération des éléments du formulaire
    const formulaire = document.querySelector('form');
    const champEmail = document.getElementById('email');
    const champNomUtilisateur = document.getElementById('nom-utilisateur');
    const champMotDePasse = document.getElementById('motdepasse');
    const champConfirmerMotDePasse = document.getElementById('confirmer-motdepasse');
    const boutonInscription = document.querySelector('button[type="submit"]');

    // Validation en temps réel de la correspondance des mots de passe
    champConfirmerMotDePasse.addEventListener('input', function() {
        verifierCorrespondanceMotsDePasse();
    });

    champMotDePasse.addEventListener('input', function() {
        if (champConfirmerMotDePasse.value) {
            verifierCorrespondanceMotsDePasse();
        }
    });

    // Fonction pour vérifier si les mots de passe correspondent
    function verifierCorrespondanceMotsDePasse() {
        const conteneurConfirmation = champConfirmerMotDePasse.parentElement;
        const messageErreur = conteneurConfirmation.querySelector('.message-erreur');
        
        if (champMotDePasse.value !== champConfirmerMotDePasse.value && champConfirmerMotDePasse.value !== '') {
            champConfirmerMotDePasse.classList.add('error');
            if (messageErreur) {
                messageErreur.textContent = 'Les mots de passe ne correspondent pas';
            }
            return false;
        } else {
            champConfirmerMotDePasse.classList.remove('error');
            if (messageErreur) {
                messageErreur.textContent = '';
            }
            return true;
        }
    }

    // Fonction pour valider le format de l'email
    function validerFormatEmail(email) {
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regexEmail.test(email);
    }

    // Fonction pour vérifier si l'email existe déjà
    function emailDejaUtilise(email) {
        return email.toLowerCase() === compteAdmin.email.toLowerCase();
    }

    // Fonction pour vérifier si le nom d'utilisateur existe déjà
    function nomUtilisateurDejaUtilise(nomUtilisateur) {
        return nomUtilisateur.toLowerCase() === compteAdmin.nomUtilisateur.toLowerCase();
    }

    // Fonction pour afficher un message d'erreur
    function afficherMessageErreur(champ, texteErreur) {
        const conteneurChamp = champ.parentElement;
        const messageErreur = conteneurChamp.querySelector('.message-erreur');
        
        champ.classList.add('error');
        if (messageErreur) {
            messageErreur.textContent = texteErreur;
        }
    }

    // Fonction pour effacer un message d'erreur
    function effacerMessageErreur(champ) {
        const conteneurChamp = champ.parentElement;
        const messageErreur = conteneurChamp.querySelector('.message-erreur');
        
        champ.classList.remove('error');
        if (messageErreur) {
            messageErreur.textContent = '';
        }
    }

    // Fonction pour afficher le chargement
    function afficherChargement() {
        boutonInscription.disabled = true;
        boutonInscription.style.cursor = 'not-allowed';
        boutonInscription.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    }

    // Fonction pour masquer le chargement
    function masquerChargement() {
        boutonInscription.disabled = false;
        boutonInscription.style.cursor = 'pointer';
        boutonInscription.innerHTML = 'Créer un compte';
    }

    // Gestion de la soumission du formulaire
    formulaire.addEventListener('submit', function(evenement) {
        evenement.preventDefault();
        
        // Réinitialiser toutes les erreurs
        effacerMessageErreur(champNomUtilisateur);
        effacerMessageErreur(champEmail);
        effacerMessageErreur(champMotDePasse);
        effacerMessageErreur(champConfirmerMotDePasse);

        let formulaireEstValide = true;

        // Validation du nom d'utilisateur
        const valeurNomUtilisateur = champNomUtilisateur.value.trim();
        if (!valeurNomUtilisateur) {
            afficherMessageErreur(champNomUtilisateur, 'Le nom d\'utilisateur est requis');
            formulaireEstValide = false;
        } else if (nomUtilisateurDejaUtilise(valeurNomUtilisateur)) {
            afficherMessageErreur(champNomUtilisateur, 'Ce nom d\'utilisateur est déjà utilisé');
            formulaireEstValide = false;
        }

        // Validation de l'email
        const valeurEmail = champEmail.value.trim();
        if (!valeurEmail) {
            afficherMessageErreur(champEmail, 'L\'adresse e-mail est requise');
            formulaireEstValide = false;
        } else if (!validerFormatEmail(valeurEmail)) {
            afficherMessageErreur(champEmail, 'Adresse e-mail invalide');
            formulaireEstValide = false;
        } else if (emailDejaUtilise(valeurEmail)) {
            afficherMessageErreur(champEmail, 'Cette adresse e-mail est déjà utilisée');
            formulaireEstValide = false;
        }

        // Validation du mot de passe
        const valeurMotDePasse = champMotDePasse.value;
        if (!valeurMotDePasse) {
            afficherMessageErreur(champMotDePasse, 'Le mot de passe est requis');
            formulaireEstValide = false;
        }

        // Validation de la confirmation du mot de passe
        const valeurConfirmation = champConfirmerMotDePasse.value;
        if (!valeurConfirmation) {
            afficherMessageErreur(champConfirmerMotDePasse, 'Veuillez confirmer votre mot de passe');
            formulaireEstValide = false;
        } else if (valeurMotDePasse !== valeurConfirmation) {
            afficherMessageErreur(champConfirmerMotDePasse, 'Les mots de passe ne correspondent pas');
            formulaireEstValide = false;
        }

        // Si tout est valide, afficher le chargement et rediriger
        if (formulaireEstValide) {
            // Afficher le chargement
            afficherChargement();
            
            // Simuler un délai de 2 secondes
            setTimeout(function() {
                alert('Compte créé avec succès ! Redirection vers la page de connexion...');
                window.location.href = 'login.html';
            }, 2000);
        }
    });
});