<?php
function handleCartAction($post, &$session)
{
    if (!isset($session['cart'])) {
        $session['cart'] = [];
    }

    $action = $post['action'] ?? null;
    $productId = $post['product_id'] ?? '';
    $response = ['success' => false];

    switch ($action) {
        case 'add':
            require 'db.php';

            $category = $post['category'] ?? 'gpu';
            $table = $category === 'cpu' ? 'products_cpu' : 'products_gpu';

            $stmt = $conn->prepare("SELECT title, price FROM `$table` WHERE id = ?");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if ($product) {
                if (isset($session['cart'][$productId])) {
                    $session['cart'][$productId]['quantity'] += 1;
                } else {
                    $session['cart'][$productId] = [
                        'name' => $product['title'],
                        'price' => floatval($product['price']),
                        'quantity' => 1
                    ];
                }
            }

            $stmt->close();
            $conn->close();
            break;


        case 'update':
            $quantity = intval($post['quantity'] ?? 1);
            if ($quantity <= 0) {
                unset($session['cart'][$productId]);
            } else {
                if (isset($session['cart'][$productId])) {
                    $session['cart'][$productId]['quantity'] = $quantity;
                }
            }
            break;

        case 'remove':
            unset($session['cart'][$productId]);
            break;
    }

    $total = 0;
    foreach ($session['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $response = [
        'success' => true,
        'cart' => $session['cart'],
        'total' => $total
    ];

    return $response;
}
