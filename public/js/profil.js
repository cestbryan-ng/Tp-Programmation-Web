document.addEventListener("DOMContentLoaded", function () {
    // Récupérer le token et les infos utilisateur
    const token = localStorage.getItem("token");
    const utilisateur = JSON.parse(localStorage.getItem("utilisateur") || "{}");
    console.log(utilisateur);

    // Rediriger vers login si pas de token
    if (!token) {
        window.location.href = "/login";
        return;
    }

    // FORMULAIRE INFORMATIONS PERSONNELLES
    const formuInfosPerso = document.querySelector(
        ".profile-section:first-of-type .profile-form"
    );
    const inputPrenom = document.getElementById("prenom");
    const inputNom = document.getElementById("nom");
    const inputEmail = document.getElementById("email");
    const inputDateNaissance = document.getElementById("date-naissance");

    // Pré-remplir les champs avec les données de l'utilisateur
    if (utilisateur.prenom) inputPrenom.value = utilisateur.prenom;
    if (utilisateur.nom) inputNom.value = utilisateur.nom;
    if (utilisateur.date_naissance)
        inputDateNaissance.value = utilisateur.date_naissance;
    if (inputEmail) inputEmail.value = utilisateur.email || "";

    // Fonctions de validation (garder toutes tes fonctions existantes)
    function afficherErreur(input, message) {
        const champConteneur =
            input.closest(".form-group") || input.closest(".form-group-mdp");
        const messageErreur =
            champConteneur.querySelector(".message-erreur") ||
            creerMessageErreur(champConteneur);
        input.classList.add("input-erreur");
        messageErreur.textContent = message;
        messageErreur.style.display = "block";
    }

    function retirerErreur(input) {
        const champConteneur =
            input.closest(".form-group") || input.closest(".form-group-mdp");
        const messageErreur = champConteneur.querySelector(".message-erreur");
        input.classList.remove("input-erreur");
        if (messageErreur) {
            messageErreur.textContent = "";
            messageErreur.style.display = "none";
        }
    }

    function creerMessageErreur(conteneur) {
        const messageErreur = document.createElement("small");
        messageErreur.className = "message-erreur";
        messageErreur.style.display = "none";
        conteneur.appendChild(messageErreur);
        return messageErreur;
    }

    function validerEmail(input) {
        const valeur = input.value.trim();
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (valeur === "") {
            afficherErreur(input, "L'adresse e-mail est requise");
            return false;
        }
        if (!regexEmail.test(valeur)) {
            afficherErreur(input, "L'adresse e-mail n'est pas valide");
            return false;
        }
        retirerErreur(input);
        return true;
    }

    function validerDateNaissance(input) {
        const valeur = input.value;
        if (!valeur) return true; // Optionnel
        const dateNaissance = new Date(valeur);
        const dateAujourdhui = new Date();
        dateAujourdhui.setHours(0, 0, 0, 0);
        if (dateNaissance >= dateAujourdhui) {
            afficherErreur(input, "La date de naissance est incorrecte");
            return false;
        }
        const age = dateAujourdhui.getFullYear() - dateNaissance.getFullYear();
        if (age < 13) {
            afficherErreur(input, "Vous devez avoir au moins 13 ans");
            return false;
        }
        retirerErreur(input);
        return true;
    }

    function afficherChargement(bouton) {
        bouton.disabled = true;
        bouton.style.cursor = "not-allowed";
        bouton.style.opacity = "0.6";
        bouton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    }

    function masquerChargement(bouton, texteOriginal) {
        bouton.disabled = false;
        bouton.style.cursor = "pointer";
        bouton.style.opacity = "1";
        bouton.innerHTML = texteOriginal;
    }

    // Validation en temps réel
    if (inputEmail) {
        inputEmail.addEventListener("blur", () => validerEmail(inputEmail));
        inputEmail.addEventListener("input", function () {
            if (this.classList.contains("input-erreur")) validerEmail(this);
        });
    }

    if (inputDateNaissance) {
        inputDateNaissance.addEventListener("blur", () =>
            validerDateNaissance(inputDateNaissance)
        );
        inputDateNaissance.addEventListener("change", () =>
            validerDateNaissance(inputDateNaissance)
        );
    }

    // Soumission formulaire infos perso
    if (formuInfosPerso) {
        formuInfosPerso.addEventListener("submit", async function (e) {
            e.preventDefault();

            // Masquer erreur réseau
            const erreurReseau = document.getElementById("erreur-reseau-infos");
            if (erreurReseau) {
                erreurReseau.style.display = "none";
                erreurReseau.textContent = "";
            }

            const emailValide = validerEmail(inputEmail);
            const dateNaissanceValide =
                validerDateNaissance(inputDateNaissance);

            if (emailValide && dateNaissanceValide) {
                const bouton = formuInfosPerso.querySelector(".btn-submit");
                const texteOriginal = bouton.innerHTML;
                afficherChargement(bouton);

                try {
                    const response = await fetch(
                        "http://localhost:8000/api/modifier_infos",
                        {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                Authorization: `Bearer ${token}`,
                            },
                            body: JSON.stringify({
                                nom: inputNom.value.trim(),
                                prenom: inputPrenom.value.trim(),
                                email: inputEmail.value.trim(),
                                date_naissance: inputDateNaissance.value,
                            }),
                        }
                    );

                    if (response.status === 200) {
                        // Mettre à jour localStorage
                        utilisateur.nom = inputNom.value.trim();
                        utilisateur.prenom = inputPrenom.value.trim();
                        localStorage.setItem(
                            "utilisateur",
                            JSON.stringify(utilisateur)
                        );
                        window.location.reload();
                    } else if (response.status === 301) {
                        alert("Session expirée. Veuillez vous reconnecter.");
                        window.location.href = "/login";
                    } else {
                        alert("Une erreur est survenue.");
                    }
                } catch (error) {
                    console.error("Erreur:", error);
                    if (erreurReseau) {
                        erreurReseau.textContent =
                            "Erreur réseau. Veuillez réessayer.";
                        erreurReseau.style.display = "block";
                    }
                } finally {
                    masquerChargement(bouton, texteOriginal);
                }
            }
        });
    }

    // FORMULAIRE MOT DE PASSE
    const formuMotDePasse = document.querySelector(
        ".profile-section:last-of-type .profile-form"
    );
    const inputMotDePasseActuel = document.getElementById("current-password");
    const inputNouveauMotDePasse = document.getElementById("new-password");
    const inputConfirmationMotDePasse =
        document.getElementById("confirm-password");

    function validerMotDePasseActuel(input) {
        if (input.value.trim() === "") {
            afficherErreur(input, "Le mot de passe actuel est requis");
            return false;
        }
        retirerErreur(input);
        return true;
    }

    function validerNouveauMotDePasse(input) {
        if (input.value.trim() === "") {
            afficherErreur(input, "Le nouveau mot de passe est requis");
            return false;
        }
        retirerErreur(input);
        return true;
    }

    function validerConfirmationMotDePasse(input) {
        const valeur = input.value.trim();
        const nouveauMotDePasse = inputNouveauMotDePasse.value.trim();
        if (valeur === "") {
            afficherErreur(
                input,
                "La confirmation du mot de passe est requise"
            );
            return false;
        }
        if (valeur !== nouveauMotDePasse) {
            afficherErreur(input, "Les mots de passe ne correspondent pas");
            return false;
        }
        retirerErreur(input);
        return true;
    }

    // Validation en temps réel
    if (inputMotDePasseActuel) {
        inputMotDePasseActuel.addEventListener("blur", () =>
            validerMotDePasseActuel(inputMotDePasseActuel)
        );
        inputMotDePasseActuel.addEventListener("input", function () {
            if (this.classList.contains("input-erreur"))
                validerMotDePasseActuel(this);
        });
    }

    if (inputNouveauMotDePasse) {
        inputNouveauMotDePasse.addEventListener("blur", () =>
            validerNouveauMotDePasse(inputNouveauMotDePasse)
        );
        inputNouveauMotDePasse.addEventListener("input", function () {
            if (this.classList.contains("input-erreur"))
                validerNouveauMotDePasse(this);
            if (inputConfirmationMotDePasse.value !== "") {
                validerConfirmationMotDePasse(inputConfirmationMotDePasse);
            }
        });
    }

    if (inputConfirmationMotDePasse) {
        inputConfirmationMotDePasse.addEventListener("blur", () =>
            validerConfirmationMotDePasse(inputConfirmationMotDePasse)
        );
        inputConfirmationMotDePasse.addEventListener("input", function () {
            if (this.classList.contains("input-erreur"))
                validerConfirmationMotDePasse(this);
        });
    }

    // Soumission formulaire mot de passe
    if (formuMotDePasse) {
        formuMotDePasse.addEventListener("submit", async function (e) {
            e.preventDefault();

            // Masquer erreur réseau
            const erreurReseau = document.getElementById("erreur-reseau-mdp");
            if (erreurReseau) {
                erreurReseau.style.display = "none";
                erreurReseau.textContent = "";
            }

            const motDePasseActuelValide = validerMotDePasseActuel(
                inputMotDePasseActuel
            );
            const nouveauMotDePasseValide = validerNouveauMotDePasse(
                inputNouveauMotDePasse
            );
            const confirmationValide = validerConfirmationMotDePasse(
                inputConfirmationMotDePasse
            );

            if (
                motDePasseActuelValide &&
                nouveauMotDePasseValide &&
                confirmationValide
            ) {
                const bouton = formuMotDePasse.querySelector(".btn-submit");
                const texteOriginal = bouton.innerHTML;
                afficherChargement(bouton);

                try {
                    const response = await fetch(
                        "http://localhost:8000/api/modifier_mdp",
                        {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                Authorization: `Bearer ${token}`,
                            },
                            body: JSON.stringify({
                                mot_de_passe:
                                    inputNouveauMotDePasse.value.trim(),
                            }),
                        }
                    );

                    if (response.status === 200) {
                        formuMotDePasse.reset();
                        window.location.reload();
                    } else if (response.status === 301) {
                        alert("Session expirée. Veuillez vous reconnecter.");
                        window.location.href = "/login";
                    } else if (response.status === 307) {
                        afficherErreur(
                            inputNouveauMotDePasse,
                            "Le mot de passe ne peut pas être vide"
                        );
                    } else {
                        alert("Une erreur est survenue.");
                    }
                } catch (error) {
                    console.error("Erreur:", error);
                    if (erreurReseau) {
                        erreurReseau.textContent =
                            "Erreur réseau. Veuillez réessayer.";
                        erreurReseau.style.display = "block";
                    }
                } finally {
                    masquerChargement(bouton, texteOriginal);
                }
            }
        });
    }
});
