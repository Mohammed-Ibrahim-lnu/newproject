let cartIcon = document.querySelector('#cart-icon');
let cart = document.querySelector('.cart');
let closeCart = document.querySelector('#close-cart');

cartIcon.onclick = () => {
    cart.classList.add("active");
};

closeCart.onclick = () => {
    cart.classList.remove("active");
};

document.querySelectorAll('.add-cart').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.dataset.id;
        const productName = this.dataset.name;
        const productPrice = this.dataset.price;

        sendCartAction('add', productId, productName, productPrice);
    });
});

function sendCartAction(action, productId, productName = '', productPrice = '', quantity = '') {
    let body = `action=${action}&product_id=${productId}`;
    if (action === 'add') {
        body += `&product_name=${encodeURIComponent(productName)}&product_price=${productPrice}`;
    }
    if (action === 'update') {
        body += `&quantity=${quantity}`;
    }

    fetch('cart_action.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: body
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartUI(data.cart, data.total);
        }
    })
    .catch(error => console.error('Error:', error));
}

function updateCartUI(cart, total) {
    const cartContent = document.querySelector('.cart-content');
    const totalPrice = document.querySelector('.total-price');
    cartContent.innerHTML = '';

    for (let id in cart) {
        const item = cart[id];
        const div = document.createElement('div');
        div.className = 'cart-box';
        div.innerHTML = `
            <div class='cart-product-title'>${item.name}</div>
            <div class='cart-quantity'>
                <input type='number' min='1' class='qty-input' data-id='${id}' value='${item.quantity}'>
                <div class='qty-buttons'>
                    <button class='qty-plus' data-id='${id}'>+</button>
                    <button class='qty-minus' data-id='${id}'>-</button>
                </div>
            </div>
            <div class='cart-price'>$${parseFloat(item.price).toFixed(2)}</div>
            <button class='cart-remove' data-id='${id}'>Remove</button>
        `;
        cartContent.appendChild(div);
    }

    totalPrice.textContent = `$${total.toFixed(2)}`;

    attachCartEventListeners(cart);
}

function attachCartEventListeners(cart) {
    document.querySelectorAll('.qty-plus').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const newQuantity = parseInt(cart[id].quantity) + 1;
            sendCartAction('update', id, '', '', newQuantity);
        });
    });

    document.querySelectorAll('.qty-minus').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const newQuantity = parseInt(cart[id].quantity) - 1;
            if (newQuantity >= 1) {
                sendCartAction('update', id, '', '', newQuantity);
            }
        });
    });

    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('change', function () {
            const id = this.dataset.id;
            let newQuantity = parseInt(this.value);
            if (isNaN(newQuantity) || newQuantity < 1) {
                newQuantity = 1;
                this.value = 1;
            }
            sendCartAction('update', id, '', '', newQuantity);
        });
    });

    document.querySelectorAll('.cart-remove').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            sendCartAction('remove', id);
        });
    });
}

// Load cart on page load
window.addEventListener('DOMContentLoaded', () => {
    fetch('get_cart.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartUI(data.cart, data.total);
        }
    })
    .catch(error => console.error('Error loading cart:', error));
});
