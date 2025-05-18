<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../cart_logic.php';

class CartActionTest extends TestCase
{
    public function testAddItemAction()
    {
        $post = [
            'action' => 'add',
            'product_id' => '1',
            'product_name' => 'Test Product',
            'product_price' => '9.99'
        ];
        $session = [];

        $response = handleCartAction($post, $session);

        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('1', $response['cart']);
        $this->assertEquals('Test Product', $response['cart']['1']['name']);
    }
}
