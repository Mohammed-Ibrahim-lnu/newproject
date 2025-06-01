<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../cart_logic.php';
require_once __DIR__ . '/../db.php'; // Required for DB connection

class CartTest extends TestCase
{
    protected $session;

    protected function setUp(): void
    {
        $this->session = ['cart' => []];
    }

    private function getProductFromDb($productId, $category)
    {
        require __DIR__ . '/../db.php';
        $table = $category === 'cpu' ? 'products_cpu' : 'products_gpu';
        $stmt = $conn->prepare("SELECT title, price FROM `$table` WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $product;
    }

    public function testAddProductFromDatabase()
    {
        $productId = 1;
        $category = 'gpu';
        $compositeKey = "{$category}_{$productId}";

        $post = [
            'action' => 'add',
            'product_id' => $compositeKey
        ];

        $response = handleCartAction($post, $this->session);

        $this->assertTrue($response['success']);
        $this->assertArrayHasKey($compositeKey, $this->session['cart']);

        $item = $this->session['cart'][$compositeKey];
        $product = $this->getProductFromDb($productId, $category);

        $this->assertEquals($product['title'], $item['name']);
        $this->assertEquals(floatval($product['price']), floatval($item['price']));
        $this->assertEquals(1, $item['quantity']);
    }

    public function testUpdateQuantity()
    {
        $productId = 1;
        $category = 'gpu';
        $compositeKey = "{$category}_{$productId}";

        $product = $this->getProductFromDb($productId, $category);
        $price = floatval($product['price']);

        $this->session['cart'][$compositeKey] = [
            'id' => $productId,
            'category' => $category,
            'name' => $product['title'],
            'price' => $price,
            'quantity' => 1
        ];

        $post = [
            'action' => 'update',
            'product_id' => $compositeKey,
            'quantity' => 3
        ];

        $response = handleCartAction($post, $this->session);

        $this->assertTrue($response['success']);
        $this->assertEquals(3, $this->session['cart'][$compositeKey]['quantity']);
        $this->assertEquals($price * 3, $response['total']);
    }

    public function testRemoveProduct()
    {
        $productId = 1;
        $category = 'gpu';
        $compositeKey = "{$category}_{$productId}";

        $this->session['cart'][$compositeKey] = [
            'id' => $productId,
            'category' => $category,
            'name' => 'RTX 6700 XT',
            'price' => 150.00,
            'quantity' => 1
        ];

        $post = [
            'action' => 'remove',
            'product_id' => $compositeKey
        ];

        $response = handleCartAction($post, $this->session);

        $this->assertTrue($response['success']);
        $this->assertArrayNotHasKey($compositeKey, $this->session['cart']);
        $this->assertEquals(0, $response['total']);
    }
}
