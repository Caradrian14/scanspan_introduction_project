<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $order = Product::create($request->all());
        return response()->json($order, 201);
    }

    public function show(string $id)
    {
        return Product::findOrFail($id);
        // Obtener productos con precio mayor a 50, ordenados por nombre
            // $products = Product::where('price', '>', 50)
            //        ->orderBy('name')
            //        ->get();
            // Obtener productos con sus categorías (relación muchos a muchos)
        // $products = Product::with('categories')->get();

        //Ejemplo mas complejo
        $customer = Customer::with(['orders.products'])->find(1);

    // foreach ($customer->orders as $order) {
    //     echo "Pedido #" . $order->id . ":<br>";
    //     foreach ($order->products as $product) {
    //         echo "- " . $product->name . " (Precio: " . $product->price . ")<br>";
    //     }
    // }
    }

    public function update(Request $request, string $id)
    {
        $order = Product::findOrFail($id);
        $order->update($request->all());
        return response()->json($order, 200);
    }

    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(null, 204);
        // Ejemplo distinto: eliminar todos los productos con precio menor a 10
        // Product::where('price', '<', 10)->delete();
    }
}
