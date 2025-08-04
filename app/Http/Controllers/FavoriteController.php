<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        return response()->json($user->favorites);
    }

    public function toggle(Request $request, Product $product)
    {
        $user = $request->user();

        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            return response()->json(['favorited' => false]);
        } else {
            $user->favorites()->attach($product->id);
            return response()->json(['favorited' => true]);
        }
    }


    public function getProductsWithCategories(Request $request)
    {
        $user = $request->user();
        $lang = $request->query('lang', 'ru');
        // Загружаем избранные товары с категорией
        $favorites = $user->favorites()->with('category')->get();

        // Группируем по названию категории
        $grouped = $favorites->groupBy(function ($product) {
            return $product->category->slug ?? '';
        });

        // Преобразуем в нужный формат
        $result = $grouped->map(function ($products, $categorySlug) use ($lang) {
            return [
                'category' => $categorySlug,
                'products' => $products->map(function ($product) use ($lang) {
                    $cleanImagePath = ltrim(trim($product->image, " \t\n\r\0\x0B\"'"), '/');
                    return [
                        'id' => $product->id,
                        'name' => $product->name[$lang] ?? $product->name['ru'] ?? '',
                        'description' => $product->description[$lang] ?? $product->description['ru'] ?? '',
                        'price' => $product->price,
                        'stock' => $product->stock,
                        'image' => asset('storage/' . $cleanImagePath),
                        'is_favorite' => true,
                    ];
                })->values()
            ];
        })->values();

        return response()->json($result);
    }

}
