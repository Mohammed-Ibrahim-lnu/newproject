<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../cart_logic.php';
require_once __DIR__ . '/../db.php'; // Required for DB connection

class CartTest extends TestCase
{
    protected $session;

    protected function setUp(): void
    {
        $this->session = ['cart' => []]; // Empty array for clean start every test
    }

    private function getProductFromDb($productId, $category) // Fetches the tables ex. products_gpu with prod title and price.
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

    public function testAddProductFromDatabase() // Simulates a user add-to-cart function of a product by id and category.
    {
        $productId = 1;
        $category = 'gpu';

        $post = [
            'action' => 'add',
            'product_id' => $productId,
            'category' => $category
        ];

        $response = handleCartAction($post, $this->session);

        $this->assertTrue($response['success']);
        $this->assertArrayHasKey($productId, $this->session['cart']);

        $item = $this->session['cart'][$productId];
        $product = $this->getProductFromDb($productId, $category);

        $this->assertEquals($product['title'], $item['name']);
        $this->assertEquals(floatval($product['price']), floatval($item['price']));
        $this->assertEquals(1, $item['quantity']);
    }

    public function testUpdateQuantity() // Sets a product in the cart, checks quantity function.
    {
        $productId = 1;
        $category = 'gpu';
        $product = $this->getProductFromDb($productId, $category);
        $price = floatval($product['price']);

        $this->session['cart'][$productId] = [
            'name' => $product['title'],
            'price' => $price,
            'quantity' => 1
        ];

        $post = [
            'action' => 'update',
            'product_id' => $productId,
            'quantity' => 3
        ];

        $response = handleCartAction($post, $this->session);

        $this->assertTrue($response['success']);
        $this->assertEquals(3, $this->session['cart'][$productId]['quantity']);
        $this->assertEquals($price * 3, $response['total']);
    }

    public function testRemoveProduct() // Adds a fake product to the cart, then sends a remove action.
    {
        $this->session['cart'][1] = [
            'name' => 'RTX 6700 XT',
            'price' => 150.00,
            'quantity' => 1
        ];

        $post = [
            'action' => 'remove',
            'product_id' => 1
        ];

        $response = handleCartAction($post, $this->session);

        $this->assertTrue($response['success']);
        $this->assertArrayNotHasKey(1, $this->session['cart']);
        $this->assertEquals(0, $response['total']);
    }
}
