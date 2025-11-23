document.addEventListener("DOMContentLoaded", () => {
    // 1. Lire les paramètres de l'URL
    const params = new URLSearchParams(window.location.search);
    const productId = params.get("id"); // ex: "1"
    const category = params.get("category"); // ex: "artAbstrait"

    if (!productId || !category) {
        document.getElementById("product-title").textContent = "Produit non trouvé.";
        console.error("ID ou catégorie manquant dans l'URL");
        return;
    }

    // 2. Trouver la base de données correspondante
    const categoryDatabase = masterDatabase[category];
    if (!categoryDatabase) {
        document.getElementById("product-title").textContent = "Catégorie non valide.";
        console.error("Catégorie inconnue:", category);
        return;
    }

    // 3. Trouver le produit par son ID
    // (Note: l'ID de l'URL est un string, l'ID de la DB est un nombre, d'où le ==)
    const product = categoryDatabase.find(item => item.id == productId);

    if (!product) {
        document.getElementById("product-title").textContent = "Produit introuvable.";
        console.error("Produit non trouvé avec ID:", productId, "dans", category);
        return;
    }

    // 4. Remplir la page HTML avec les données du produit
    // (Utilise les ID que nous avons ajoutés au HTML)
    document.title = `${product.title} - Artika`; // Met à jour l'onglet du navigateur
    
    document.getElementById("product-image").src = product.image;
    document.getElementById("product-image").alt = product.title;
    
    document.getElementById("product-artist").textContent = product.artist;
    document.getElementById("product-title").textContent = product.title;
    
    // Remplissage des champs (certains peuvent être undefined, on met "N/A")
    document.getElementById("product-subtitle").textContent = product.technique || product.style || "Oeuvre originale";
    document.getElementById("product-dimensions").textContent = product.dimensions || "N/A";
    document.getElementById("product-technique").textContent = product.technique || product.style || "N/A";
    document.getElementById("product-description").textContent = product.description || `Découvrez "${product.title}", une magnifique oeuvre de ${product.artist}.`;

    // Formatez le prix
    const formattedPrice = product.price.toLocaleString('fr-FR');
    document.getElementById("product-price").textContent = `${formattedPrice} FCFA`;

    // C'est crucial : il faut aussi remplir les éléments
    // que votre script 'produits.js' [cite: 271-272] utilise pour l'ajout au panier.
    // Heureusement, ce sont les mêmes que ceux que nous venons de remplir.
    // (Juste pour être sûr, on met à jour les classes qu'il recherche)
    document.querySelector(".product-title").textContent = product.title;
    document.querySelector(".artist-link").textContent = product.artist;
    // Le script [cite: 271] cherche .product-price, qui contient maintenant notre span
    document.querySelector(".main-image img").src = product.image;
    
    // Bonus : Remplir la miniature
    const thumbnailGrid = document.getElementById("thumbnail-grid");
    thumbnailGrid.innerHTML = `
        <div class="thumbnail active">
            <img src="${product.image}" alt="Miniature de ${product.title}">
        </div>
    `;
    // (Vous pouvez ajouter d'autres images ici si votre BDD les contient)
});