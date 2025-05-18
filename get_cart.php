<?php
session_start();
require 'cart_logic.php';

$response = handleCartAction($_POST, $_SESSION);
echo json_encode($response);

$total = 0;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

foreach ($_SESSION['cart'] as $id => $item) {
    $_SESSION['cart'][$id]['price'] = floatval($item['price']);
    $_SESSION['cart'][$id]['quantity'] = intval($item['quantity']);
    $total += $item['price'] * $item['quantity'];
}

echo json_encode([
    'success' => true,
    'cart' => $_SESSION['cart'],
    'total' => $total
]);
