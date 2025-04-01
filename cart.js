document.addEventListener("DOMContentLoaded", function () {
    const cartItemsContainer = document.getElementById("cart-items");
    const totalPriceElement = document.getElementById("total-price");
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Function to update the cart UI
    function updateCart() {
        cartItemsContainer.innerHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            total += item.price * item.quantity;

            const cartItemElement = document.createElement('div');
            cartItemElement.classList.add('cart-item');
            
            cartItemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-item-details">
                    <p><strong>${item.name}</strong></p>
                    <p>₹${item.price} x ${item.quantity}</p>
                </div>
                <div class="cart-item-actions">
                    <input type="number" value="${item.quantity}" min="1" class="item-quantity" data-index="${index}">
                    <button class="remove-btn" data-index="${index}">Remove</button>
                </div>
            `;
            cartItemsContainer.appendChild(cartItemElement);
        });

        totalPriceElement.textContent = total;
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    // Event listener for adding items to cart
    if (addToCartButtons.length > 0) {
        addToCartButtons.forEach(button => {
            button.addEventListener("click", function () {
                const name = this.dataset.name;
                const price = parseFloat(this.dataset.price);
                const image = this.dataset.image;
                
                const existingItem = cart.find(item => item.name === name);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({ name, price, image, quantity: 1 });
                }
                
                localStorage.setItem("cart", JSON.stringify(cart));
                alert(`${name} added to cart!`);
            });
        });
    }

    // Event listener for removing items from cart
    cartItemsContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-btn")) {
            const index = e.target.dataset.index;
            cart.splice(index, 1);
            updateCart();
        }
    });

    // Event listener for updating quantity
    cartItemsContainer.addEventListener("change", function (e) {
        if (e.target.classList.contains("item-quantity")) {
            const index = e.target.dataset.index;
            cart[index].quantity = parseInt(e.target.value);
            updateCart();
        }
    });

    // Initial call to populate the cart UI
    if (cartItemsContainer) {
        updateCart();
    }

    
});
