document.addEventListener("DOMContentLoaded", function () {
    // Gestion de l'affichage/masquage du mot de passe
    const iconeMotDePasse = document.querySelector(".afficher-password");

    if (iconeMotDePasse) {
        iconeMotDePasse.addEventListener("click", function () {
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
    }

    // Récupération des éléments du formulaire
    const formulaire = document.getElementById("form-connexion");
    const champEmail = document.getElementById("email");
    const champMotDePasse = document.getElementById("motdepasse");
    const boutonConnexion = document.querySelector('button[type="submit"]');

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
        boutonConnexion.disabled = true;
        boutonConnexion.style.cursor = "not-allowed";
        boutonConnexion.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    }

    // Fonction pour masquer le chargement
    function masquerChargement() {
        boutonConnexion.disabled = false;
        boutonConnexion.style.cursor = "pointer";
        boutonConnexion.innerHTML = "Me connecter";
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
        effacerMessageErreur(champEmail);
        effacerMessageErreur(champMotDePasse);

        let formulaireEstValide = true;

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

        // Si tout est valide, envoyer la requête
        if (formulaireEstValide) {
            afficherChargement();

            try {
                const response = await fetch(
                    "http://localhost:8000/api/connexion",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                        },
                        body: JSON.stringify({
                            email: valeurEmail,
                            mot_de_passe: valeurMotDePasse,
                        }),
                    }
                );

                if (response.status === 200) {
                    const data = await response.json();
                    // Stocker les infos utilisateur
                    localStorage.setItem("utilisateur", JSON.stringify(data));
                    localStorage.setItem("token", data.token);

                    window.location.href = "/profil";
                } else if (response.status === 301) {
                    afficherMessageErreur(
                        champMotDePasse,
                        "Mot de passe incorrect"
                    );
                } else if (response.status === 304) {
                    afficherMessageErreur(champEmail, "Compte inexistant");
                } else {
                    alert("Une erreur est survenue. Veuillez réessayer.");
                }
            } catch (error) {
                console.error("Erreur:", error);

                if (erreurReseau) {
                    erreurReseau.textContent =
                        "Erreur réseau. Veuillez réessayer.";
                    erreurReseau.style.display = "block";
                }
            } finally {
                masquerChargement();
            }
        }
    });
});
