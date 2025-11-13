console.log('Script "countpayer.js" chargé !');

window.addEventListener('load', function() {
    const btnAddToCart = document.querySelector('.btn-primary');
    const cartCount = document.querySelector('.cart-count');
    
    console.log('Bouton trouvé:', btnAddToCart);
    console.log('Compteur trouvé:', cartCount);

    // Mettre à jour le compteur au chargement (basé sur le localStorage)
    try {
        const existingCart = JSON.parse(localStorage.getItem("cartItems")) || [];
        if (existingCart.length > 0) {
            const totalQty = existingCart.reduce((sum, item) => sum + item.qty, 0);
            cartCount.textContent = totalQty;
        }
    } catch (e) {
        console.error("Erreur en lisant le localStorage:", e);
    }
    
    if (btnAddToCart && cartCount) {
        btnAddToCart.addEventListener('click', function() {
            console.log('Clic détecté !');

            // --- CORRECTION MAJEURE ---
            // On lit les infos depuis les ID (remplis par description.js)
            // au lieu des classes.
            const productTitle = document.getElementById("product-title")?.textContent.trim();
            const productPriceText = document.getElementById("product-price")?.textContent.trim() || "0";
            const productImage = document.getElementById("product-image")?.getAttribute("src");
            const productArtist = document.getElementById("product-artist")?.textContent.trim();

            // Vérification (très importante)
            if (!productTitle || !productPriceText || !productImage || productTitle === "Chargement...") {
                console.error("ERREUR: Impossible de lire les infos du produit ! Vérifiez que les ID #product-title, #product-price, et #product-image sont bien remplis par description.js.");
                alert("Erreur : Impossible d'ajouter le produit. Les informations sont manquantes.");
                return; // Arrête le script ici
            }

            // Nettoyer le prix (enlever "FCFA" et les espaces)
            const productPrice = parseInt(productPriceText.replace(/\D/g, "")) || 0;

            // Le reste de votre script (sauvegarde localStorage) est correct
            let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
            const existingItem = cartItems.find(item => item.name === productTitle);

            if (existingItem) {
                existingItem.qty += 1;
            } else {
                cartItems.push({
                    name: productTitle,
                    artist: productArtist, // Ajout de l'artiste
                    price: productPrice,   // Prix unitaire
                    qty: 1,
                    image: productImage
                });
            }

            // Sauvegarder dans le localStorage
            localStorage.setItem("cartItems", JSON.stringify(cartItems));

            // Mettre à jour le compteur visuel
            const totalQty = cartItems.reduce((sum, item) => sum + item.qty, 0);
            cartCount.textContent = totalQty;
            
            console.log('Produit ajouté. Panier actuel:', cartItems);
            alert(`"${productTitle}" a été ajouté au panier !`);
        });
    } else {
        console.error('Éléments non trouvés sur la page ! (btn-primary ou cart-count)');
    }
});