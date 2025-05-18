function setupCartUI() {
    const cartIcon = document.querySelector('#cart-icon');
    const cart = document.querySelector('.cart');
    const closeCart = document.querySelector('#close-cart');
    const cartContent = document.querySelector('.cart-content');
    const totalPrice = document.querySelector('.total-price');

    if (cartIcon && cart) {
        cartIcon.addEventListener('click', () => {
            cart.classList.add("active");
        });
    }

    if (closeCart && cart) {
        closeCart.addEventListener('click', () => {
            cart.classList.remove("active");
        });
    }

    document.querySelectorAll('.add-cart').forEach(button => {
        button.addEventListener('click', () => {
            const { id, name, price } = button.dataset;
            sendCartAction('add', id, name, price);
        });
    });

    // Event delegation for quantity, remove, and input actions
    if (cartContent) {
        cartContent.addEventListener('click', event => {
            const btn = event.target;
            const id = btn.dataset.id;

            if (btn.classList.contains('qty-plus')) {
                const input = btn.closest('.cart-quantity').querySelector('.qty-input');
                const newQuantity = parseInt(input.value) + 1;
                sendCartAction('update', id, '', '', newQuantity);
            }

            if (btn.classList.contains('qty-minus')) {
                const input = btn.closest('.cart-quantity').querySelector('.qty-input');
                let newQuantity = parseInt(input.value) - 1;
                if (newQuantity >= 1) {
                    sendCartAction('update', id, '', '', newQuantity);
                }
            }

            if (btn.classList.contains('cart-remove')) {
                sendCartAction('remove', id);
            }
        });

        cartContent.addEventListener('input', event => {
            const input = event.target;
            if (input.classList.contains('qty-input')) {
                const id = input.dataset.id;
                let newQuantity = parseInt(input.value);
                if (isNaN(newQuantity) || newQuantity < 1) {
                    newQuantity = 1;
                    input.value = 1;
                }
                sendCartAction('update', id, '', '', newQuantity);
            }
        });
    }

    // Load initial cart
    fetch('get_cart.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                updateCartUI(data.cart, data.total);
            }
        })
        .catch(err => console.error('Error loading cart:', err));
}

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
        body
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                updateCartUI(data.cart, data.total);
            }
        })
        .catch(err => console.error('Error:', err));
}

function updateCartUI(cart, total) {
    const cartContent = document.querySelector('.cart-content');
    const totalPrice = document.querySelector('.total-price');

    if (!cartContent || !totalPrice) return;

    cartContent.innerHTML = '';

    for (let id in cart) {
        const item = cart[id];
        const div = document.createElement('div');
        div.className = 'cart-box';
        div.innerHTML = `
            <div class='cart-product-title'>${item.name}</div>
            <div class='cart-quantity'>
                <input type='text' inputmode='numeric' class='qty-input' data-id='${id}' value='${item.quantity}' readonly>
                <div class='qty-buttons'>
                    <button class='qty-plus' data-id='${id}'>+</button>
                    <button class='qty-minus' data-id='${id}'>-</button>
                </div>
            </div>
            <div class='cart-price'>$${parseFloat(item.price).toFixed(2)}</div>
            <i class='bx bxs-trash-alt cart-remove' data-id='${id}'></i>
        `;
        cartContent.appendChild(div);
    }

    totalPrice.textContent = `$${total.toFixed(2)}`;
}

// Export for testing
if (typeof module !== 'undefined') {
    module.exports = { setupCartUI, sendCartAction, updateCartUI };
} else {
    window.addEventListener('DOMContentLoaded', setupCartUI);
}
