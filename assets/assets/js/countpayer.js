console.log('Script chargé !');
    
window.addEventListener('load', function() {
        const btnAddToCart = document.querySelector('.btn-primary');
        const cartCount = document.querySelector('.cart-count');
        
        console.log('Bouton trouvé:', btnAddToCart);
        console.log('Compteur trouvé:', cartCount);
        
        if (btnAddToCart && cartCount) {
            btnAddToCart.addEventListener('click', function() {
                console.log('Clic détecté !');
                let currentCount = parseInt(cartCount.textContent);
                currentCount++;
                cartCount.textContent = currentCount;
                console.log('Nouveau compteur:', currentCount);
            });
        } else {
            console.error('Éléments non trouvés !');
        }
});