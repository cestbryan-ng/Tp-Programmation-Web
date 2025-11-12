document.addEventListener("DOMContentLoaded", function () {
    // Gestion de l'affichage/masquage des mots de passe
    const iconesMotDePasse = document.querySelectorAll(".afficher-password");

    iconesMotDePasse.forEach((icone) => {
        icone.addEventListener("click", function () {
            const conteneurParent = this.parentElement;
            const champMotDePasse = conteneurParent.querySelector(
                ".controle-formulaire"
            );

            if (champMotDePasse.type === "password") {
                champMotDePasse.type = "text";
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            } else {
                champMotDePasse.type = "password";
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            }
        });
    });

    // Récupération des éléments du formulaire
    const formulaire = document.getElementById("form-inscription");
    const champEmail = document.getElementById("email");
    const champNomUtilisateur = document.getElementById("nom-utilisateur");
    const champMotDePasse = document.getElementById("motdepasse");
    const champConfirmerMotDePasse = document.getElementById(
        "confirmer-motdepasse"
    );
    const boutonInscription = document.querySelector('button[type="submit"]');

    // Validation en temps réel de la correspondance des mots de passe
    champConfirmerMotDePasse.addEventListener("input", function () {
        verifierCorrespondanceMotsDePasse();
    });

    champMotDePasse.addEventListener("input", function () {
        if (champConfirmerMotDePasse.value) {
            verifierCorrespondanceMotsDePasse();
        }
    });

    // Fonction pour vérifier si les mots de passe correspondent
    function verifierCorrespondanceMotsDePasse() {
        const conteneurConfirmation = champConfirmerMotDePasse.parentElement;
        const messageErreur =
            conteneurConfirmation.querySelector(".message-erreur");

        if (
            champMotDePasse.value !== champConfirmerMotDePasse.value &&
            champConfirmerMotDePasse.value !== ""
        ) {
            champConfirmerMotDePasse.classList.add("error");
            if (messageErreur) {
                messageErreur.textContent =
                    "Les mots de passe ne correspondent pas";
            }
            return false;
        } else {
            champConfirmerMotDePasse.classList.remove("error");
            if (messageErreur) {
                messageErreur.textContent = "";
            }
            return true;
        }
    }

    // Fonction pour valider le format de l'email
    function validerFormatEmail(email) {
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regexEmail.test(email);
    }

    // Fonction pour afficher un message d'erreur
    function afficherMessageErreur(champ, texteErreur) {
        const conteneurChamp = champ.parentElement;
        const messageErreur = conteneurChamp.querySelector(".message-erreur");

        champ.classList.add("error");
        if (messageErreur) {
            messageErreur.textContent = texteErreur;
        }
    }

    // Fonction pour effacer un message d'erreur
    function effacerMessageErreur(champ) {
        const conteneurChamp = champ.parentElement;
        const messageErreur = conteneurChamp.querySelector(".message-erreur");

        champ.classList.remove("error");
        if (messageErreur) {
            messageErreur.textContent = "";
        }
    }

    // Fonction pour afficher le chargement
    function afficherChargement() {
        boutonInscription.disabled = true;
        boutonInscription.style.cursor = "not-allowed";
        boutonInscription.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    }

    // Fonction pour masquer le chargement
    function masquerChargement() {
        boutonInscription.disabled = false;
        boutonInscription.style.cursor = "pointer";
        boutonInscription.innerHTML = "Créer un compte";
    }

    // Gestion de la soumission du formulaire
    formulaire.addEventListener("submit", async function (evenement) {
        evenement.preventDefault();

        // Masquer l'erreur réseau
        const erreurReseau = document.getElementById("erreur-reseau");
        if (erreurReseau) {
            erreurReseau.style.display = "none";
            erreurReseau.textContent = "";
        }

        // Réinitialiser toutes les erreurs
        effacerMessageErreur(champNomUtilisateur);
        effacerMessageErreur(champEmail);
        effacerMessageErreur(champMotDePasse);
        effacerMessageErreur(champConfirmerMotDePasse);

        let formulaireEstValide = true;

        // Validation du nom d'utilisateur
        const valeurNomUtilisateur = champNomUtilisateur.value.trim();
        if (!valeurNomUtilisateur) {
            afficherMessageErreur(
                champNomUtilisateur,
                "Le nom d'utilisateur est requis"
            );
            formulaireEstValide = false;
        }

        // Validation de l'email
        const valeurEmail = champEmail.value.trim();
        if (!valeurEmail) {
            afficherMessageErreur(champEmail, "L'adresse e-mail est requise");
            formulaireEstValide = false;
        } else if (!validerFormatEmail(valeurEmail)) {
            afficherMessageErreur(champEmail, "Adresse e-mail invalide");
            formulaireEstValide = false;
        }

        // Validation du mot de passe
        const valeurMotDePasse = champMotDePasse.value;
        if (!valeurMotDePasse) {
            afficherMessageErreur(
                champMotDePasse,
                "Le mot de passe est requis"
            );
            formulaireEstValide = false;
        }

        // Validation de la confirmation du mot de passe
        const valeurConfirmation = champConfirmerMotDePasse.value;
        if (!valeurConfirmation) {
            afficherMessageErreur(
                champConfirmerMotDePasse,
                "Veuillez confirmer votre mot de passe"
            );
            formulaireEstValide = false;
        } else if (valeurMotDePasse !== valeurConfirmation) {
            afficherMessageErreur(
                champConfirmerMotDePasse,
                "Les mots de passe ne correspondent pas"
            );
            formulaireEstValide = false;
        }

        // Si tout est valide, envoyer la requête
        if (formulaireEstValide) {
            afficherChargement();

            try {
                const response = await fetch(
                    "http://localhost:8000/api/inscription",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                        },
                        body: JSON.stringify({
                            nom_utilisateur: valeurNomUtilisateur,
                            email: valeurEmail,
                            mot_de_passe: valeurMotDePasse,
                        }),
                    }
                );

                if (response.status === 200) {
                    window.location.href = "/login";
                } else if (response.status === 301) {
                    afficherMessageErreur(
                        champNomUtilisateur,
                        "Ce nom d'utilisateur est déjà utilisé"
                    );
                } else if (response.status === 304) {
                    afficherMessageErreur(
                        champEmail,
                        "Cette adresse e-mail est déjà utilisée"
                    );
                } else {
                    alert("Une erreur est survenue. Veuillez réessayer.");
                }
            } catch (error) {
                masquerChargement();
                console.error("Erreur:", error);

                const erreurReseau = document.getElementById("erreur-reseau");
                erreurReseau.textContent = "Erreur réseau. Veuillez réessayer.";
                erreurReseau.style.display = "block";
            } finally {
                masquerChargement();
            }
        }
    });
});
