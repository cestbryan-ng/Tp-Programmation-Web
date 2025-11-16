document.addEventListener("DOMContentLoaded", () => {
    const removeButtons = document.querySelectorAll(".remove-btn");
    const totalDisplay = document.querySelector(".cart-summary h3");
    const checkoutBtn = document.querySelector(".checkout-btn");

    function updateTotal() {
        let total = 0;
        const items = [];
        document.querySelectorAll(".cart-item").forEach(item => {
            const name = item.querySelector("h3").textContent;
            const qty = parseInt(item.querySelector("p:nth-of-type(1)").textContent.replace(/\D/g, ""));
            const price = parseInt(item.querySelector("p:nth-of-type(2)").textContent.replace(/\D/g, ""));
            total += price;
            items.push({ name, qty, price });
        });
        totalDisplay.textContent = `Total : ${total.toLocaleString()} FCFA`;
        return items;
    }

    removeButtons.forEach(button => {
        button.addEventListener("click", e => {
            e.target.closest(".cart-item").remove();
            updateTotal();
        });
    });

    updateTotal();

    checkoutBtn.addEventListener("click", () => {
        const items = updateTotal();
        localStorage.setItem("cartItems", JSON.stringify(items));
        window.location.href = "achat.html";
    });
});
