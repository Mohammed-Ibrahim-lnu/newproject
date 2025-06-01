function setupCartUI() {
    const cartIcon = document.querySelector('#cart-icon');
    const cart = document.querySelector('.cart');
    const closeCart = document.querySelector('#close-cart');
    const cartContent = document.querySelector('.cart-content');

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
            const id = button.dataset.id;
            const category = button.dataset.category;
            const cartKey = `${category}_${id}`;
            sendCartAction('add', cartKey, '', category);

            if (!cart.classList.contains('active')) {
                cart.classList.add('active');
            }
        });
    });

    if (cartContent) {
        cartContent.addEventListener('click', event => {
            const btn = event.target;
            const id = btn.dataset.id;
            const category = btn.dataset.category;
            const cartKey = `${category}_${id}`;

            if (btn.classList.contains('qty-plus')) {
                const input = btn.closest('.cart-quantity').querySelector('.qty-input');
                const newQuantity = parseInt(input.value) + 1;
                sendCartAction('update', cartKey, newQuantity, category);
            }

            if (btn.classList.contains('qty-minus')) {
                const input = btn.closest('.cart-quantity').querySelector('.qty-input');
                const newQuantity = parseInt(input.value) - 1;
                sendCartAction('update', cartKey, newQuantity, category);
            }

            if (btn.classList.contains('cart-remove')) {
                sendCartAction('remove', cartKey, '', category);
            }
        });

        cartContent.addEventListener('input', event => {
            const input = event.target;
            if (input.classList.contains('qty-input')) {
                const id = input.dataset.id;
                const category = input.dataset.category;
                const cartKey = `${category}_${id}`;
                let newQuantity = parseInt(input.value);
                if (isNaN(newQuantity) || newQuantity < 1) {
                    newQuantity = 1;
                    input.value = 1;
                }
                sendCartAction('update', cartKey, newQuantity, category);
            }
        });
    }

    fetch('get_cart.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                updateCartUI(data.cart, data.total);
            }
        })
        .catch(err => console.error('Error loading cart:', err));
}

function sendCartAction(action, productKey, quantity = '', category = '') {
    let body = `action=${action}&product_id=${productKey}`;
    if (action === 'add') {
        body += `&category=${category}`;
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

    for (const key in cart) {
        const item = cart[key];
        const div = document.createElement('div');
        div.className = 'cart-box';
        div.innerHTML = `
            <div class='cart-product-title'>${item.name}</div>
            <div class='cart-quantity'>
                <input type='text' inputmode='numeric' class='qty-input' 
                    data-id='${item.id}' data-category='${item.category}' value='${item.quantity}' readonly>
                <div class='qty-buttons'>
                    <button class='qty-plus' data-id='${item.id}' data-category='${item.category}'>+</button>
                    <button class='qty-minus' data-id='${item.id}' data-category='${item.category}'>-</button>
                </div>
            </div>
            <div class='cart-price'>$${parseFloat(item.price).toFixed(2)}</div>
            <i class='bx bxs-trash-alt cart-remove' data-id='${item.id}' data-category='${item.category}'></i>
        `;
        cartContent.appendChild(div);
    }

    totalPrice.textContent = `$${total.toFixed(2)}`;
}

// Export for testing in Node.js, Jest
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = { setupCartUI, sendCartAction, updateCartUI };
}

if (typeof window !== 'undefined') {
    window.addEventListener('DOMContentLoaded', setupCartUI);
}
