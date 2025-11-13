document.addEventListener("DOMContentLoaded", () => {
    const totalDisplay = document.querySelector(".cart-summary h3");
    const checkoutBtn = document.querySelector(".checkout-btn");
    const cartContainer = document.querySelector(".cart-items");

    // 1. NOUVELLE FONCTION : Charger et afficher les articles depuis localStorage
    function loadCartItems() {
        const items = JSON.parse(localStorage.getItem("cartItems")) || [];
        cartContainer.innerHTML = ''; // Vider le conteneur

        if (items.length === 0) {
            cartContainer.innerHTML = '<p class="empty-cart-message">Votre panier est vide.</p>';
            updateTotal(); // S'assurer que le total est à 0
            return;
        }

        items.forEach(item => {
            // Calculer le sous-total pour cet article
            const subtotal = item.qty * item.price;
            const formattedSubtotal = subtotal.toLocaleString('fr-FR');
            
            // Créer le HTML pour l'article (basé sur votre structure)
            const cartItemHTML = `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="item-info">
                        <h3>${item.name}</h3>
                        <p>Quantité: ${item.qty}</p>
                        <p>Prix: ${formattedSubtotal} FCFA</p>
                    </div>
                    <button class="remove-btn" data-name="${item.name}">Supprimer</button>
                </div>
            `;
            // Ajouter le nouvel article au conteneur
            cartContainer.innerHTML += cartItemHTML;
        });
    }

    // 2. FONCTION DE MISE À JOUR DU TOTAL (Votre code [cite: 544-546])
    // (Elle lit maintenant les sous-totaux que nous venons de générer)
    function updateTotal() {
        let total = 0;
        const items = [];
        
        document.querySelectorAll(".cart-item").forEach(item => {
            const name = item.querySelector("h3").textContent;
            const qtyText = item.querySelector("p:nth-of-type(1)").textContent;
            const qty = parseInt(qtyText.replace(/\D/g, "")) || 1;
            
            const priceText = item.querySelector("p:nth-of-type(2)").textContent;
            const price = parseInt(priceText.replace(/\D/g, "")) || 0;
            
            total += price; // Ajoute le sous-total de l'article
            items.push({ name, qty, price });
        });
        
        totalDisplay.textContent = `Total : ${total.toLocaleString('fr-FR')} FCFA`;
        return items;
    }

    // 3. NOUVELLE FONCTION : Attacher les écouteurs de suppression
    function attachRemoveListeners() {
        document.querySelectorAll(".remove-btn").forEach(button => {
            button.addEventListener("click", e => {
                const itemName = e.target.dataset.name; // Récupère le nom de l'article
                
                // Supprimer du DOM
                e.target.closest(".cart-item").remove();
                
                // Mettre à jour localStorage
                let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
                cartItems = cartItems.filter(item => item.name !== itemName);
                localStorage.setItem("cartItems", JSON.stringify(cartItems));
                
                // Mettre à jour le total
                updateTotal();

                // Vérifier si le panier est vide après suppression
                if (cartItems.length === 0) {
                     cartContainer.innerHTML = '<p class="empty-cart-message">Votre panier est vide.</p>';
                }
            });
        });
    }

    // 4. LOGIQUE DE PAIEMENT (Votre code [cite: 547])
    checkoutBtn.addEventListener("click", () => {
        const items = updateTotal(); // Récupère les articles à jour
        // Note: 'items' contient maintenant le PRIX TOTAL de la ligne, pas le prix unitaire
        // C'est OK si 'achat.html' s'attend à cela.
        localStorage.setItem("cartItems", JSON.stringify(items));
        window.location.href = "achat.html";
    });

    // --- ÉTAPES D'INITIALISATION ---
    loadCartItems();         // 1. Charger les articles
    updateTotal();           // 2. Calculer le total
    attachRemoveListeners(); // 3. Rendre les boutons "Supprimer" cliquables
});