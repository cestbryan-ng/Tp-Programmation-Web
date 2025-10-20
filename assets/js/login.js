// Compte admin prédéfini
const compteAdmin = {
    email: 'admin@gmail.com',
    motdepasse: '12345'
};

document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'affichage/masquage du mot de passe
    const iconeMotDePasse = document.querySelector('.afficher-password');
    
    if (iconeMotDePasse) {
        iconeMotDePasse.addEventListener('click', function() {
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
    }

    // Récupération des éléments du formulaire
    const formulaire = document.querySelector('form');
    const champEmail = document.getElementById('email');
    const champMotDePasse = document.getElementById('motdepasse');
    const boutonConnexion = document.querySelector('button[type="submit"]');

    // Fonction pour valider le format de l'email
    function validerFormatEmail(email) {
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regexEmail.test(email);
    }

    // Fonction pour vérifier si l'email existe
    function verifierEmailExiste(email) {
        return email.toLowerCase() === compteAdmin.email.toLowerCase();
    }

    // Fonction pour vérifier le mot de passe
    function verifierMotDePasse(motdepasse) {
        return motdepasse === compteAdmin.motdepasse;
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

    // Fonction pour effacer toutes les erreurs
    function effacerToutesLesErreurs() {
        effacerMessageErreur(champEmail);
        effacerMessageErreur(champMotDePasse);
    }

    // Fonction pour afficher le chargement
    function afficherChargement() {
        boutonConnexion.disabled = true;
        boutonConnexion.style.cursor = 'not-allowed';
        boutonConnexion.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    }

    // Fonction pour masquer le chargement
    function masquerChargement() {
        boutonConnexion.disabled = false;
        boutonConnexion.innerHTML = 'Me connecter';
    }

    // Gestion de la soumission du formulaire
    formulaire.addEventListener('submit', function(evenement) {
        evenement.preventDefault();
        
        // Réinitialiser toutes les erreurs
        effacerToutesLesErreurs();

        let formulaireEstValide = true;

        // Validation de l'email
        const valeurEmail = champEmail.value.trim();
        if (!valeurEmail) {
            afficherMessageErreur(champEmail, 'L\'adresse e-mail est requise');
            formulaireEstValide = false;
        } else if (!validerFormatEmail(valeurEmail)) {
            afficherMessageErreur(champEmail, 'Adresse e-mail invalide');
            formulaireEstValide = false;
        }

        // Validation du mot de passe
        const valeurMotDePasse = champMotDePasse.value;
        if (!valeurMotDePasse) {
            afficherMessageErreur(champMotDePasse, 'Le mot de passe est requis');
            formulaireEstValide = false;
        }

        // Si les champs sont valides, vérifier les identifiants
        if (formulaireEstValide) {
            // Vérifier d'abord si l'email existe
            if (!verifierEmailExiste(valeurEmail)) {
                afficherMessageErreur(champEmail, 'Compte inexistant');
            } 
            // Si l'email existe, vérifier le mot de passe
            else if (!verifierMotDePasse(valeurMotDePasse)) {
                afficherMessageErreur(champMotDePasse, 'Mot de passe incorrect');
            } 
            // Si tout est correct
            else {
                // Afficher le chargement
                afficherChargement();
                
                // Simuler un délai de 2 secondes
                setTimeout(function() {
                    // Redirection vers la page d'accueil
                    window.location.href = 'artika.html';
                }, 2000);
            }
        }
    });
});