// Données simulées - compte existant
const compteExistant = {
  prenom: "",
  nom: "",
  dateNaissance: "",
  email: "admin@gmail.com",
};

// Fonction pour afficher le chargement
function afficherChargement(bouton) {
  bouton.disabled = true;
  bouton.style.cursor = "not-allowed";
  bouton.style.opacity = "0.6";
  bouton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
}

// Fonction pour masquer le chargement
function masquerChargement(bouton, texteOriginal) {
  bouton.disabled = false;
  bouton.style.cursor = "pointer";
  bouton.style.opacity = "1";
  bouton.innerHTML = texteOriginal;
}

// Afficher l'erreur sur un champ
function afficherErreur(input, message) {
  const champConteneur =
    input.closest(".form-group") || input.closest(".form-group-mdp");
  const messageErreur =
    champConteneur.querySelector(".message-erreur") ||
    creerMessageErreur(champConteneur);

  // Ajouter la classe d'erreur à l'input
  input.classList.add("input-erreur");

  // Afficher le message d'erreur
  messageErreur.textContent = message;
  messageErreur.style.display = "block";
}

// Retirer l'erreur d'un champ
function retirerErreur(input) {
  const champConteneur =
    input.closest(".form-group") || input.closest(".form-group-mdp");
  const messageErreur = champConteneur.querySelector(".message-erreur");

  // Retirer la classe d'erreur
  input.classList.remove("input-erreur");

  // Cacher le message d'erreur
  if (messageErreur) {
    messageErreur.textContent = "";
    messageErreur.style.display = "none";
  }
}

// Créer un élément pour le message d'erreur s'il n'existe pas
function creerMessageErreur(conteneur) {
  const messageErreur = document.createElement("small");
  messageErreur.className = "message-erreur";
  messageErreur.style.display = "none";
  conteneur.appendChild(messageErreur);
  return messageErreur;
}

// Valider l'email
function validerEmail(input) {
  const valeur = input.value.trim();
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!regexEmail.test(valeur)) {
    afficherErreur(input, "L'adresse e-mail n'est pas valide");
    return false;
  }

  // Vérifier si l'email est déjà utilisé (sauf si c'est l'email actuel)
  if (valeur === 'root@gmail.com') {
    afficherErreur(input, "Cette adresse e-mail est déjà utilisée");
    return false;
  }

  retirerErreur(input);
  return true;
}

// Valider la date de naissance
function validerDateNaissance(input) {
  const valeur = input.value;
  const dateNaissance = new Date(valeur);
  const dateAujourdhui = new Date();

  // Réinitialiser l'heure pour comparer uniquement les dates
  dateAujourdhui.setHours(0, 0, 0, 0);

  if (dateNaissance >= dateAujourdhui) {
    afficherErreur(
      input,
      "La date de naissance est incorrecte"
    );
    return false;
  }

  // Vérifier l'âge minimum
  const age = dateAujourdhui.getFullYear() - dateNaissance.getFullYear();
  if (age < 13) {
    afficherErreur(input, "Vous devez avoir au moins 13 ans");
    return false;
  }

  retirerErreur(input);
  return true;
}

// Valider le mot de passe actuel
function validerMotDePasseActuel(input) {
  const valeur = input.value.trim();

  if (valeur === "") {
    afficherErreur(input, "Le mot de passe actuel est requis");
    return false;
  }

  retirerErreur(input);
  return true;
}

// Valider le nouveau mot de passe
function validerNouveauMotDePasse(input) {
  const valeur = input.value.trim();

  if (valeur === "") {
    afficherErreur(input, "Le nouveau mot de passe est requis");
    return false;
  }

  retirerErreur(input);
  return true;
}

// Valider la confirmation du mot de passe
function validerConfirmationMotDePasse(input) {
  const valeur = input.value.trim();
  const nouveauMotDePasse = document
    .getElementById("new-password")
    .value.trim();

  if (valeur === "") {
    afficherErreur(input, "La confirmation du mot de passe est requise");
    return false;
  }

  if (valeur !== nouveauMotDePasse) {
    afficherErreur(input, "Les mots de passe ne correspondent pas");
    return false;
  }

  retirerErreur(input);
  return true;
}

document.addEventListener("DOMContentLoaded", function () {
  const formuInfosPerso = document.querySelector(
    ".profile-section:first-of-type .profile-form"
  );
  const inputPrenom = document.getElementById("prenom");
  const inputNom = document.getElementById("nom");
  const inputEmail = document.getElementById("email");
  const inputDateNaissance = document.getElementById("date-naissance");

  // Pré-remplir les champs avec les données existantes
  if (inputEmail) inputEmail.value = compteExistant.email;

  // Validation en temps réel pour les informations personnelles
  if (inputEmail) {
    inputEmail.addEventListener("blur", function () {
      validerEmail(this);
    });

    inputEmail.addEventListener("input", function () {
      if (this.classList.contains("input-erreur")) {
        validerEmail(this);
      }
    });
  }

  if (inputDateNaissance) {
    inputDateNaissance.addEventListener("blur", function () {
      validerDateNaissance(this);
    });

    inputDateNaissance.addEventListener("change", function () {
      validerDateNaissance(this);
    });
  }

  // Soumission du formulaire d'informations personnelles
  if (formuInfosPerso) {
    formuInfosPerso.addEventListener("submit", function (e) {
      e.preventDefault();

      // Valider tous les champs
      const emailValide = validerEmail(inputEmail);
      const dateNaissanceValide = validerDateNaissance(inputDateNaissance);

      // Si tous les champs sont valides
      if (emailValide && dateNaissanceValide) {
        const bouton = formuInfosPerso.querySelector(".btn-submit");
        const texteOriginal = bouton.innerHTML;

        // Afficher le chargement
        afficherChargement(bouton);

        // Simuler un délai de 2 secondes
        setTimeout(() => {
          // Mettre à jour les données simulées
          compteExistant.prenom = inputPrenom.value.trim();
          compteExistant.nom = inputNom.value.trim();
          compteExistant.email = inputEmail.value.trim();
          compteExistant.dateNaissance = inputDateNaissance.value;

          // Masquer le chargement
          masquerChargement(bouton, texteOriginal);
        }, 2000);
      } else {
        // Scroller vers la première erreur
        const premiereErreur = document.querySelector(".input-erreur");
        if (premiereErreur) {
          premiereErreur.scrollIntoView({
            behavior: "smooth",
            block: "center",
          });
          premiereErreur.focus();
        }
      }
    });
  }

  const formuMotDePasse = document.querySelector(
    ".profile-section:last-of-type .profile-form"
  );
  const inputMotDePasseActuel = document.getElementById("current-password");
  const inputNouveauMotDePasse = document.getElementById("new-password");
  const inputConfirmationMotDePasse =
    document.getElementById("confirm-password");

  // Validation en temps réel pour le mot de passe
  if (inputMotDePasseActuel) {
    inputMotDePasseActuel.addEventListener("blur", function () {
      validerMotDePasseActuel(this);
    });

    inputMotDePasseActuel.addEventListener("input", function () {
      if (this.classList.contains("input-erreur")) {
        validerMotDePasseActuel(this);
      }
    });
  }

  if (inputNouveauMotDePasse) {
    inputNouveauMotDePasse.addEventListener("blur", function () {
      validerNouveauMotDePasse(this);
    });

    inputNouveauMotDePasse.addEventListener("input", function () {
      if (this.classList.contains("input-erreur")) {
        validerNouveauMotDePasse(this);
      }
      // Revalider la confirmation si elle a déjà été remplie
      if (inputConfirmationMotDePasse.value !== "") {
        validerConfirmationMotDePasse(inputConfirmationMotDePasse);
      }
    });
  }

  if (inputConfirmationMotDePasse) {
    inputConfirmationMotDePasse.addEventListener("blur", function () {
      validerConfirmationMotDePasse(this);
    });

    inputConfirmationMotDePasse.addEventListener("input", function () {
      if (this.classList.contains("input-erreur")) {
        validerConfirmationMotDePasse(this);
      }
    });
  }

  // Soumission du formulaire de mot de passe
  if (formuMotDePasse) {
    formuMotDePasse.addEventListener("submit", function (e) {
      e.preventDefault();

      // Valider tous les champs
      const motDePasseActuelValide = validerMotDePasseActuel(
        inputMotDePasseActuel
      );
      const nouveauMotDePasseValide = validerNouveauMotDePasse(
        inputNouveauMotDePasse
      );
      const confirmationValide = validerConfirmationMotDePasse(
        inputConfirmationMotDePasse
      );

      // Si tous les champs sont valides
      if (
        motDePasseActuelValide &&
        nouveauMotDePasseValide &&
        confirmationValide
      ) {
        const bouton = formuMotDePasse.querySelector(".btn-submit");
        const texteOriginal = bouton.innerHTML;

        // Afficher le chargement
        afficherChargement(bouton);

        // Simuler un délai de 2 secondes
        setTimeout(() => {
          // Réinitialiser le formulaire
          formuMotDePasse.reset();

          // Masquer le chargement
          masquerChargement(bouton, texteOriginal);
        }, 2000);
      } else {
        // Scroller vers la première erreur
        const premiereErreur = document.querySelector(".input-erreur");
        if (premiereErreur) {
          premiereErreur.scrollIntoView({
            behavior: "smooth",
            block: "center",
          });
          premiereErreur.focus();
        }
      }
    });
  }
});
