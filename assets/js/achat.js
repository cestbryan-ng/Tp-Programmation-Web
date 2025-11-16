document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const paymentOptions = document.querySelectorAll("input[name='paiement']");
    const productsContainer = document.getElementById("products-container");

    const items = JSON.parse(localStorage.getItem("cartItems")) || [];
    if (items.length > 0) {
        items.forEach(item => {
            const productCard = document.createElement("div");
            productCard.className = "product-card";

            const img = document.createElement("img");
            img.src = `assets/images/${item.name.replace(/\s/g, "")}.JPG`;
            img.alt = item.name;

            const info = document.createElement("div");
            info.className = "product-info";

            const h2 = document.createElement("h2");
            h2.textContent = item.name;

            const pQty = document.createElement("p");
            pQty.textContent = `Quantité: ${item.qty}`;

            const pPrice = document.createElement("p");
            pPrice.textContent = `Prix: ${item.price.toLocaleString()} FCFA`;

            info.appendChild(h2);
            info.appendChild(pQty);
            info.appendChild(pPrice);

            productCard.appendChild(img);
            productCard.appendChild(info);

            productsContainer.appendChild(productCard);
        });
    }

    paymentOptions.forEach(option => {
        option.addEventListener("change", e => {
            console.log(`Mode de paiement choisi : ${e.target.value}`);
        });
    });

    form.addEventListener("submit", e => {
        const selectedPayment = document.querySelector("input[name='paiement']:checked");
        if (!selectedPayment) {
            e.preventDefault();
            alert("Veuillez sélectionner une méthode de paiement !");
        } else {
            alert(`Vous avez choisi : ${selectedPayment.value}. Paiement en cours...`);
        }
    });
});
