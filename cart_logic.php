<?php
function handleCartAction($post, &$session)
{
    if (!isset($session['cart'])) {
        $session['cart'] = [];
    }

    $action = $post['action'] ?? null;
    $productKey = $post['product_id'] ?? '';
    $response = ['success' => false];
    [$category, $id] = explode('_', $productKey);

    switch ($action) {
        case 'add':
            require 'db.php';
            $table = $category === 'cpu' ? 'products_cpu' : 'products_gpu';

            $stmt = $conn->prepare("SELECT title, price FROM `$table` WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if ($product) {
                if (isset($session['cart'][$productKey])) {
                    $session['cart'][$productKey]['quantity'] += 1;
                } else {
                    $session['cart'][$productKey] = [
                        'id' => $id,
                        'category' => $category,
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
                unset($session['cart'][$productKey]);
            } else {
                if (isset($session['cart'][$productKey])) {
                    $session['cart'][$productKey]['quantity'] = $quantity;
                }
            }
            break;

        case 'remove':
            unset($session['cart'][$productKey]);
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
