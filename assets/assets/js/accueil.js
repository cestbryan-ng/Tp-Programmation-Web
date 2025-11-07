// Tableau pour stocker les produits du panier (en mémoire)
let panier = [];

// Classe Produit
class Produit {
    constructor(id, nom, artiste, prix, image) {
        this.id = id;
        this.nom = nom;
        this.artiste = artiste;
        this.prix = prix;
        this.image = image;
        this.quantite = 1;
    }
}

// Fonction pour ajouter un produit au panier
function ajouterAuPanier(id, nom, artiste, prix, image) {
    // Vérifier si le produit existe déjà dans le panier
    const produitExistant = panier.find(p => p.id === id);
    
    if (produitExistant) {
        // Si le produit existe, augmenter la quantité
        produitExistant.quantite++;
        afficherNotification(`${nom} (x${produitExistant.quantite}) ajouté au panier`);
    } else {
        // Sinon, créer un nouveau produit
        const nouveauProduit = new Produit(id, nom, artiste, prix, image);
        panier.push(nouveauProduit);
        afficherNotification(`${nom} ajouté au panier`);
    }
    
    // Mettre à jour l'affichage
    mettreAJourCompteurPanier();
    afficherMiniPanier();
}

// Fonction pour supprimer un produit du panier
function supprimerDuPanier(id) {
    const index = panier.findIndex(p => p.id === id);
    if (index > -1) {
        const produitSupprime = panier[index];
        panier.splice(index, 1);
        afficherNotification(`${produitSupprime.nom} retiré du panier`);
        mettreAJourCompteurPanier();
        afficherMiniPanier();
    }
}

// Fonction pour calculer le total du panier
function calculerTotal() {
    return panier.reduce((total, produit) => {
        return total + (produit.prix * produit.quantite);
    }, 0);
}

// Fonction pour mettre à jour le compteur du panier
function mettreAJourCompteurPanier() {
    const compteur = document.querySelector('.cart-count');
    const totalArticles = panier.reduce((total, p) => total + p.quantite, 0);
    
    if (compteur) {
        compteur.textContent = totalArticles;
        
        // Animation du compteur
        compteur.style.transform = 'scale(1.3)';
        setTimeout(() => {
            compteur.style.transform = 'scale(1)';
        }, 200);
    }
}

// Fonction pour afficher le mini-panier
function afficherMiniPanier() {
    const miniPanier = document.getElementById('miniPanier');
    const listeProduits = document.getElementById('listeProduitsPanier');
    const totalElement = document.getElementById('totalPanier');
    const panierVide = document.getElementById('panierVide');
    const panierContenu = document.getElementById('panierContenu');
    
    if (!miniPanier) return;
    
    // Vider la liste
    listeProduits.innerHTML = '';
    
    if (panier.length === 0) {
        // Afficher message panier vide
        panierVide.style.display = 'block';
        panierContenu.style.display = 'none';
    } else {
        // Afficher les produits
        panierVide.style.display = 'none';
        panierContenu.style.display = 'block';
        
        panier.forEach(produit => {
            const itemHTML = `
                <div class="mini-panier-item">
                    <img src="${produit.image}" alt="${produit.nom}" class="mini-panier-img">
                    <div class="mini-panier-info">
                        <h4>${produit.nom}</h4>
                        <p>${produit.artiste}</p>
                        <p class="mini-panier-prix">${formatPrix(produit.prix)} x ${produit.quantite}</p>
                    </div>
                    <button class="mini-panier-supprimer" onclick="supprimerDuPanier('${produit.id}')">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            `;
            listeProduits.innerHTML += itemHTML;
        });
        
        // Mettre à jour le total
        totalElement.textContent = formatPrix(calculerTotal());
    }
}

// Fonction pour formater le prix
function formatPrix(prix) {
    return prix.toLocaleString('fr-FR') + ' FCFA';
}

// Fonction pour afficher une notification
function afficherNotification(message) {
    // Créer l'élément notification
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animation d'apparition
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Supprimer après 3 secondes
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Fonction pour basculer l'affichage du mini-panier
function toggleMiniPanier() {
    const miniPanier = document.getElementById('miniPanier');
    const overlay = document.getElementById('miniPanierOverlay');
    
    if (miniPanier && overlay) {
        const isOpen = miniPanier.classList.contains('open');
        
        if (isOpen) {
            fermerMiniPanier();
        } else {
            miniPanier.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
}

// Fonction pour fermer le mini-panier
function fermerMiniPanier() {
    const miniPanier = document.getElementById('miniPanier');
    const overlay = document.getElementById('miniPanierOverlay');
    
    if (miniPanier && overlay) {
        miniPanier.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
}


// Gestion du formulaire et ajout dynamique


// Fonction pour valider le formulaire de témoignages
function validerFormulaireTemoignage(event) {
    event.preventDefault();
    
    // Récupérer les valeurs
    const nom = document.querySelector('.testimonial-form input[type="text"]').value.trim();
    const email = document.querySelector('.testimonial-form input[type="email"]').value.trim();
    const commentaire = document.querySelector('.testimonial-form textarea').value.trim();
    const note = document.querySelector('.testimonial-form input[name="rating"]:checked');
    
    // Validation
    let erreurs = [];
    
    if (nom === '') {
        erreurs.push('Le nom est requis');
    }
    
    if (email === '') {
        erreurs.push('L\'email est requis');
    } else if (!validerEmail(email)) {
        erreurs.push('L\'email n\'est pas valide');
    }
    
    if (commentaire === '') {
        erreurs.push('Le commentaire est requis');
    } else if (commentaire.length < 10) {
        erreurs.push('Le commentaire doit contenir au moins 10 caractères');
    }
    
    if (!note) {
        erreurs.push('Veuillez sélectionner une note');
    }
    
    // Afficher les erreurs ou soumettre
    if (erreurs.length > 0) {
        afficherErreursFormulaire(erreurs);
    } else {
        // Ajouter le témoignage au carousel
        const noteValue = note.value;
        ajouterTemoignage(nom, commentaire, noteValue);
        
        // Afficher message de confirmation
        afficherConfirmation('Merci ! Votre avis a été ajouté avec succès.');
        
        // Réinitialiser le formulaire
        document.querySelector('.testimonial-form').reset();
    }
}

// Fonction pour valider le format d'email
function validerEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Fonction pour afficher les erreurs du formulaire
function afficherErreursFormulaire(erreurs) {
    const messagesHTML = erreurs.map(e => `<p>• ${e}</p>`).join('');
    
    // Créer ou mettre à jour le conteneur d'erreurs
    let erreurDiv = document.querySelector('.formulaire-erreurs');
    
    if (!erreurDiv) {
        erreurDiv = document.createElement('div');
        erreurDiv.className = 'formulaire-erreurs';
        const formulaire = document.querySelector('.testimonial-form');
        formulaire.insertBefore(erreurDiv, formulaire.firstChild);
    }
    
    erreurDiv.innerHTML = `
        <div class="erreur-content">
            <strong>Erreurs de validation :</strong>
            ${messagesHTML}
        </div>
    `;
    
    // Scroll vers les erreurs
    erreurDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    // Supprimer après 5 secondes
    setTimeout(() => {
        erreurDiv.remove();
    }, 5000);
}

// Fonction pour afficher un message de confirmation
function afficherConfirmation(message) {
    const confirmation = document.createElement('div');
    confirmation.className = 'formulaire-confirmation';
    confirmation.innerHTML = `
        <div class="confirmation-content">
             ${message}
        </div>
    `;
    
    const formulaire = document.querySelector('.testimonial-form');
    formulaire.insertBefore(confirmation, formulaire.firstChild);
    
    // Animation
    setTimeout(() => {
        confirmation.classList.add('show');
    }, 10);
    
    // Supprimer après 4 secondes
    setTimeout(() => {
        confirmation.classList.remove('show');
        setTimeout(() => {
            confirmation.remove();
        }, 300);
    }, 4000);
}

// Fonction pour générer les étoiles
function genererEtoiles(note) {
    let etoiles = '';
    for (let i = 1; i <= 5; i++) {
        etoiles += i <= note ? '★' : '☆';
    }
    return etoiles;
}

// Fonction pour ajouter un témoignage au carousel
function ajouterTemoignage(nom, commentaire, note) {
    const track = document.querySelector('.testimonial-track');
    
    if (!track) return;
    
    // Créer le nouvel élément
    const nouveauTemoignage = document.createElement('div');
    nouveauTemoignage.className = 'testimonial-card nouveau-temoignage';
    nouveauTemoignage.innerHTML = `
        <div class="testimonial-avatar">
            <div class="avatar-placeholder">
                ${nom.charAt(0).toUpperCase()}
            </div>
        </div>
        <p class="testimonial-text">"${commentaire}"</p>
        <p class="testimonial-author">— ${nom}</p>
        <div class="testimonial-stars">${genererEtoiles(parseInt(note))}</div>
    `;
    
    // Ajouter au début du track (avant les doublons)
    const premierElement = track.firstElementChild;
    track.insertBefore(nouveauTemoignage, premierElement);
    
    // Animation d'apparition
    setTimeout(() => {
        nouveauTemoignage.classList.add('apparition');
    }, 10);
    
    // Scroll vers le nouveau témoignage
    setTimeout(() => {
        nouveauTemoignage.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
    }, 500);
}


// INITIALISATION AU CHARGEMENT DE LA PAGE


document.addEventListener('DOMContentLoaded', function() {
    
    // PANIER 
    
    // Ajouter les événements sur tous les boutons "Ajouter au panier"
    const boutonsAjoutPanier = document.querySelectorAll('.btn-add-cart');
    
    boutonsAjoutPanier.forEach((bouton, index) => {
        bouton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Récupérer les infos du produit depuis la carte parent
            const carte = this.closest('.product-card');
            const nom = carte.querySelector('.product-name').textContent;
            const artiste = carte.querySelector('.product-artist').textContent;
            const prixText = carte.querySelector('.product-price').textContent;
            const prix = parseInt(prixText.replace(/\s/g, '').replace('FCFA', ''));
            const image = carte.querySelector('.product-image img').src;
            const id = 'produit-' + index;
            
            // Ajouter au panier
            ajouterAuPanier(id, nom, artiste, prix, image);
        });
    });
    
    // Événement sur l'icône panier pour ouvrir/fermer
    const iconePanier = document.querySelector('.cart-icon');
    if (iconePanier) {
        iconePanier.addEventListener('click', function(e) {
            e.preventDefault();
            toggleMiniPanier();
        });
    }
    
    // Événement sur l'overlay pour fermer le mini-panier
    const overlay = document.getElementById('miniPanierOverlay');
    if (overlay) {
        overlay.addEventListener('click', fermerMiniPanier);
    }
    
    //  TÉMOIGNAGES 
    
    // Ajouter l'événement sur le formulaire de témoignages
    const formulaireTemoignage = document.querySelector('.testimonial-form');
    if (formulaireTemoignage) {
        formulaireTemoignage.addEventListener('submit', validerFormulaireTemoignage);
    }
    
    // Initialiser le compteur du panier
    mettreAJourCompteurPanier();
});