document.addEventListener("DOMContentLoaded", function () {
  const token = localStorage.getItem("token");
  const utilisateur = JSON.parse(localStorage.getItem("utilisateur") || "{}");

  const iconLogin = document.querySelector(".icon-login");
  const profileDropdownWrapper = document.querySelector(".profile-dropdown-wrapper");

  // Si connecté, afficher le dropdown et cacher le bouton login
  if (token && utilisateur.nom_utilisateur) {
    if (iconLogin) iconLogin.style.display = "none";
    if (profileDropdownWrapper) {
      profileDropdownWrapper.style.display = "block";
      
      // Afficher le nom d'utilisateur
      const nomUtilisateurDropdown = document.getElementById("nom-utilisateur-dropdown");
      if (nomUtilisateurDropdown) {
        nomUtilisateurDropdown.textContent = utilisateur.nom_utilisateur;
      }
    }
  } 
  // Si non connecté, cacher le dropdown et afficher le bouton login
  else {
    if (iconLogin) iconLogin.style.display = "flex";
    if (profileDropdownWrapper) profileDropdownWrapper.style.display = "none";
  }

  // Toggle dropdown
  const profileBtn = document.querySelector(".profile-btn");
  const profileDropdown = document.querySelector(".profile-dropdown");

  if (profileBtn && profileDropdown) {
    profileBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      const isVisible = profileDropdown.style.display === "block";
      profileDropdown.style.display = isVisible ? "none" : "block";
    });

    // Fermer dropdown si clic ailleurs
    document.addEventListener("click", function () {
      profileDropdown.style.display = "none";
    });

    // Empêcher fermeture si clic dans le dropdown
    profileDropdown.addEventListener("click", function (e) {
      e.stopPropagation();
    });
  }

  // Déconnexion
  const btnDeconnexion = document.getElementById("btn-deconnexion");
  if (btnDeconnexion) {
    btnDeconnexion.addEventListener("click", async function () {
      if (token) {
        try {
          await fetch("http://localhost:8000/api/deconnexion", {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
              "Authorization": `Bearer ${token}`
            }
          });
        } catch (error) {
          console.error("Erreur déconnexion:", error);
        }
      }
      
      // Supprimer les données locales
      localStorage.removeItem("token");
      localStorage.removeItem("utilisateur");
      
      // Rediriger vers login
      window.location.href = "/login";
    });
  }
});