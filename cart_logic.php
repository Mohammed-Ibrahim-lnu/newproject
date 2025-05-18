<?php
function handleCartAction($post, &$session)
{
    if (!isset($session['cart'])) {
        $session['cart'] = [];
    }

    $action = $post['action'] ?? null;
    $productId = $post['product_id'] ?? '';
    $response = ['success' => false];

    if ($action === 'add') {
        $session['cart'][$productId] = [
            'name' => $post['product_name'],
            'price' => $post['product_price'],
            'quantity' => 1
        ];
        $response = ['success' => true, 'cart' => $session['cart']];
    }

    return $response;
}
