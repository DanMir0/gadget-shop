<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getProducts(Request $request)
    {
        $category = $request->query('category');

        $productsQuery = Product::query();
        if ($category && $category !== '0') {
            $productsQuery->where('category_id', $category);
        }

        $products = $productsQuery->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'image' => asset('storage/' . $product->image), // ✅ Формируем URL изображения
            ];
        });

        return response()->json($products);
    }
}
