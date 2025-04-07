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
        $perPage = $request->query('per_page', 8);

        $productsQuery = Product::query();

        if ($category && $category !== '0') {
            $productsQuery->where('category_id', $category);
        }

        $products = $productsQuery->paginate($perPage);

        $products->getCollection()->transform(function ($product) {
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
