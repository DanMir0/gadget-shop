<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductStatusController extends Controller
{
    public function getNewProducts(Request $request)
    {
        $status = ProductStatus::where('name', 'new')->first();
        $perPage = $request->query('per_page', 4);

        $productsQuery = Product::where('status_id', $status->id);

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
