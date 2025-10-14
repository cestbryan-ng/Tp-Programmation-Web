// Script pour gérer l'ajout au panier
document.addEventListener('DOMContentLoaded', function() {
    const btnAddToCart = document.querySelector('.btn-primary');
    const cartCount = document.querySelector('.cart-count');
    
    btnAddToCart.addEventListener('click', function() {
        // Récupérer la valeur actuelle du panier
        let currentCount = parseInt(cartCount.textContent);
        
        // Incrémenter de 1
        currentCount++;
        
        // Mettre à jour l'affichage
        cartCount.textContent = currentCount;
        
        // Animation visuelle (optionnel)
        cartCount.style.transform = 'scale(1.3)';
        setTimeout(function() {
            cartCount.style.transform = 'scale(1)';
        }, 300);
        
        // Feedback visuel sur le bouton (optionnel)
        btnAddToCart.textContent = '✓ Ajouté au panier';
        setTimeout(function() {
            btnAddToCart.textContent = 'Ajouter au panier';
        }, 1500);
    });
});