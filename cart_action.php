<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $productId = $_POST['product_id'];

    if ($action === 'add') {
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$productId] = [
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => 1
            ];
        }
    }

    if ($action === 'update') {
        $quantity = intval($_POST['quantity']);
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
        }
    }

    if ($action === 'remove') {
        unset($_SESSION['cart'][$productId]);
    }

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    echo json_encode([
        'success' => true,
        'cart' => $_SESSION['cart'],
        'total' => $total
    ]);
}
