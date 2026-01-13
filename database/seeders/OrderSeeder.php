<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        $products = Product::all();

        // Crear 15 pedidos
        Order::factory()->count(15)->create()->each(function ($order) use ($products) {
            // Asociar entre 1 y 5 productos aleatorios a cada pedido
            $randomProducts = $products->random(rand(1, 5));

            foreach ($randomProducts as $product) {
                $quantity = rand(1, 3);
                $order->products()->attach($product, [
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                ]);
            }
        });
    }
}
