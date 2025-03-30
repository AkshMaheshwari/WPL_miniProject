document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", function () {
            let name = this.dataset.name;
            let price = parseInt(this.dataset.price);
            let image = this.dataset.image;

            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            // Check if the item already exists
            let existingItem = cart.find(item => item.name === name);
            if (existingItem) {
                alert("Item is already in the cart!");
            } else {
                cart.push({ name, price, image });
                localStorage.setItem("cart", JSON.stringify(cart));
                alert("Item added to cart!");
            }
        });
    });
});
