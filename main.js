// Cart variables
let cartIcon = document.querySelector('#cart-icon');
let cart = document.querySelector('.cart');
let closeCart = document.querySelector('#close-cart');
let cartContent = document.querySelector('.cart-content');
let totalPriceEl = document.querySelector('.total-price');

// Cart array to store products
let cartItems = [];

// Open cart
cartIcon.onclick = () => {
    cart.classList.add("active");
}

// Close cart
closeCart.onclick = () => {
    cart.classList.remove("active");
}

// Add to cart functionality
document.querySelectorAll('.add-cart').forEach((btn, index) => {
    btn.onclick = () => {
        let productBox = btn.closest('.product-box');
        let title = productBox.querySelector('.product-title').textContent;
        let price = parseFloat(productBox.querySelector('.price').textContent.replace('$', ''));
        let imgSrc = productBox.querySelector('.product-img').src;

        // Check if product already exists in cart
        let existingProduct = cartItems.find(item => item.title === title);
        
        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cartItems.push({ title, price, imgSrc, quantity: 1 });
        }
        renderCart();

        // Automatically open the cart after adding an item
        cart.classList.add("active");
    }
});

// Render cart items
function renderCart() {
    cartContent.innerHTML = ''; // Clear current cart content
    let total = 0;

    cartItems.forEach((item, index) => {
        total += item.price * item.quantity;

        let cartItem = document.createElement('div');
        cartItem.classList.add('cart-box');
        cartItem.innerHTML = `
            <img src="${item.imgSrc}" class="cart-img" />
            <div class="detail-box">
                <div class="cart-product-title">${item.title}</div>
                <div class="cart-price">$${item.price}</div>
                <input type="number" value="${item.quantity}" class="cart-quantity" data-index="${index}" />
            </div>
            <i class='bx bxs-trash-alt cart-remove' data-index="${index}"></i>
        `;
        cartContent.appendChild(cartItem);
    });

    // Update total price
    totalPriceEl.textContent = `$${total.toFixed(2)}`;

    // Attach event listeners to quantity change
    document.querySelectorAll('.cart-quantity').forEach(input => {
        input.addEventListener('change', (e) => {
            let index = e.target.getAttribute('data-index');
            let newQuantity = parseInt(e.target.value) || 1;
            cartItems[index].quantity = newQuantity;
            renderCart();
        });
    });

    // Attach event listeners to remove item
    document.querySelectorAll('.cart-remove').forEach(btn => {
        btn.onclick = (e) => {
            let index = e.target.getAttribute('data-index');
            cartItems.splice(index, 1); // Remove item from cart
            renderCart();
        }
    });
}

// Add initial render on page load
renderCart();
