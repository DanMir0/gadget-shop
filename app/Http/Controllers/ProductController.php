<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();
        $userFavorites = $user ? $user->favorites()->pluck('product_id')->toArray() : [];

        $products->getCollection()->transform(function ($product) use ($userFavorites) {
            $cleanImagePath = ltrim(trim($product->image, " \t\n\r\0\x0B\"'"), '/');

            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'image' => asset('storage/' . $cleanImagePath),
                'is_favorite' => in_array($product->id, $userFavorites),
            ];
        });

        return response()->json($products);
    }
}
