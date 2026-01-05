<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Tests\TestCase;
class OrderControllerTest extends TestCase
{
    use RefreshDatabase; // refresh the db
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function it_can_list_all_orders()
    {
        Order::factory()->count(3)->create();

        $response = $this->get('/api/orders');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function it_can_create_an_order()
    {
        $orderData = [
            'customer_name' => 'Adrià Jordà',
            'product' => 'Libro de Laravel',
            'quantity' => 2,
            'total_price' => 49.99,
            'order_date' => '2026-01-05',
            'status' => 'pendiente',
        ];

        $response = $this->post('/api/orders', $orderData);

        $response->assertStatus(201)
                 ->assertJson($orderData);
    }

    public function it_can_show_an_order()
    {
        $order = Order::factory()->create();

        $response = $this->get("/api/orders/{$order->id}");

        $response->assertStatus(200)
                 ->assertJson($order->toArray());
    }

     public function it_can_update_an_order()
    {
        $order = Order::factory()->create();

        $updatedData = [
            'customer_name' => 'Adrià Jordà (Actualizado)',
            'product' => 'Libro de Laravel (Actualizado)',
            'quantity' => 3,
            'total_price' => 74.99,
            'order_date' => '2026-01-06',
            'status' => 'completado',
        ];

        $response = $this->put("/api/orders/{$order->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJson($updatedData);
    }

    public function it_can_delete_an_order()
    {
        $order = Order::factory()->create();

        $response = $this->delete("/api/orders/{$order->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
