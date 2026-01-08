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
    }
}
